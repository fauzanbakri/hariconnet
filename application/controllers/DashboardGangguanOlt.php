<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;

class DashboardGangguanOlt extends CI_Controller {
    public function index()
    {
        $title['title'] = "Dashboard Gangguan OLT Berulang";
        session_start();
        if(isset($_SESSION['role'])){
            // Allow similar roles as other dashboards
            if(
                $_SESSION['role']=='Superadmin' || 
                $_SESSION['role']=='NOC Ritel' || 
                $_SESSION['role']=='Team Leader' || 
                $_SESSION['role']=='Pemeliharaan Ritel' || 
                $_SESSION['role']=='Resepsionis' 
            ){
                $this->load->view('navbar', $title);
                $this->load->view('dashboardGangguanOlt');
            }else{
                header('location: ./DashboardNoc');
            }
        }else{
            header('location: Login');

        }

    }

    public function upload()
    {
        if (!isset($_FILES['file'])){
            echo json_encode(['error'=>'No file uploaded']);
            return;
        }

        $f = $_FILES['file'];
        if ($f['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['error'=>'Upload error']);
            return;
        }

        $tmp = $f['tmp_name'];

        try {
            $spreadsheet = IOFactory::load($tmp);
        } catch (Exception $e) {
            echo json_encode(['error'=>'Unable to read spreadsheet: '.$e->getMessage()]);
            return;
        }

        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, true, true, true);
        if (count($data) < 2) {
            echo json_encode(['error'=>'Spreadsheet contains no data']);
            return;
        }

        // Header row
        $headerRow = array_shift($data);
        $headers = [];
        foreach ($headerRow as $col => $val) {
            $norm = strtolower(trim(preg_replace('/\s+/', '', (string)$val)));
            $headers[$col] = $norm;
        }

        // helper to find column by candidate substrings
        $findCol = function($candidates) use ($headers) {
            foreach ($headers as $col => $norm) {
                foreach ($candidates as $cand) {
                    if (strpos($norm, $cand) !== false) return $col;
                }
            }
            return null;
        };

        $colDevice = $findCol(['devicename','device','olt','devicename']);
        $colId = $findCol(['idinsiden','idinsiden','idins','idincident','id_insiden','id']);
        $colPetugas = $findCol(['namapetugasbuat','petugas','createdby','createby','namapetugas']);
        $colTanggal = $findCol(['tanggal','tanggalgangguan','date','tgl']);
        $colPenyebab = $findCol(['penyebab','cause','keterangan','description','reason']);

        if (!$colDevice || !$colId || !$colPetugas) {
            echo json_encode(['error'=>'Required columns not found (devicename, idinsiden, namaPetugasBuat)']);
            return;
        }

        $counts = [];
        $causes = [];
        $latestTimestamp = 0;

        foreach ($data as $r) {
            $dev = isset($r[$colDevice]) ? trim((string)$r[$colDevice]) : '';
            $idins = isset($r[$colId]) ? trim((string)$r[$colId]) : '';
            $petugas = isset($r[$colPetugas]) ? trim((string)$r[$colPetugas]) : '';
            $peny = $colPenyebab ? trim((string)$r[$colPenyebab]) : '';
            $tglRaw = $colTanggal ? trim((string)$r[$colTanggal]) : '';

            if (strcasecmp($petugas, 'VIA NGAOSS') !== 0) continue;
            if ($dev === '' || $idins === '') continue;

            if (!isset($counts[$dev])) $counts[$dev] = 0;
            $counts[$dev]++;

            if ($peny !== '') {
                if (!isset($causes[$dev])) $causes[$dev] = [];
                $causes[$dev][] = $peny;
            }

            // attempt parse date
            $ts = 0;
            if ($tglRaw !== '') {
                if (is_numeric($tglRaw)) {
                    // Excel serialized number -> convert to unix timestamp
                    $unix = ($tglRaw - 25569) * 86400;
                    $ts = (int)$unix;
                } else {
                    $try = strtotime($tglRaw);
                    if ($try !== false) $ts = $try;
                }
            }
            if ($ts > $latestTimestamp) $latestTimestamp = $ts;
        }

        // build result list
        $result = [];
        foreach ($counts as $dev => $cnt) {
            $detailCauses = [];
            if (isset($causes[$dev])) {
                $detailCauses = array_values(array_unique($causes[$dev]));
            }
            $result[] = [
                'devicename' => $dev,
                'count' => $cnt,
                'causes' => $detailCauses,
            ];
        }

        // sort by count desc
        usort($result, function($a,$b){return $b['count'] - $a['count'];});

        $out = [
            'data' => $result,
            'last_timestamp' => $latestTimestamp,
            'last_datetime' => $latestTimestamp ? date('Y-m-d H:i:s', $latestTimestamp) : null,
        ];

        header('Content-Type: application/json');
        echo json_encode($out);
    }
}
