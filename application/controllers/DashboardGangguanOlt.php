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
        $insertRows = [];

        foreach ($data as $r) {
            $dev = isset($r[$colDevice]) ? trim((string)$r[$colDevice]) : '';
            $idins = isset($r[$colId]) ? trim((string)$r[$colId]) : '';
            $petugas = isset($r[$colPetugas]) ? trim((string)$r[$colPetugas]) : '';
            $peny = $colPenyebab ? trim((string)$r[$colPenyebab]) : '';
            $tglRaw = $colTanggal ? trim((string)$r[$colTanggal]) : '';

            if (strcasecmp($petugas, 'VIA NGAOSS') !== 0) continue;
            if ($dev === '' || $idins === '') continue;

            // prepare for DB insert
            $ts = 0;
            $tglDb = null;
            if ($tglRaw !== '') {
                if (is_numeric($tglRaw)) {
                    $unix = ($tglRaw - 25569) * 86400;
                    $ts = (int)$unix;
                } else {
                    $try = strtotime($tglRaw);
                    if ($try !== false) $ts = $try;
                }
            }
            if ($ts) $tglDb = date('Y-m-d H:i:s', $ts);

            $insertRows[] = [
                'id_insiden' => $idins,
                'devicename' => $dev,
                'nama_petugas' => $petugas,
                'tanggal_gangguan' => $tglDb,
                'penyebab' => $peny,
                'raw_row' => json_encode($r),
            ];

            if (!isset($counts[$dev])) $counts[$dev] = 0;
            $counts[$dev]++;

            if ($peny !== '') {
                if (!isset($causes[$dev])) $causes[$dev] = [];
                $causes[$dev][] = $peny;
            }

            if ($ts > $latestTimestamp) $latestTimestamp = $ts;
        }

        // persist: clear old data and insert new
        try {
            $this->db->trans_start();
            // use TRUNCATE to remove old rows
            $this->db->query('TRUNCATE TABLE gangguan_olt');
            if (!empty($insertRows)) {
                $this->db->insert_batch('gangguan_olt', $insertRows);
            }
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                $dbErr = $this->db->error();
                error_log("Database error in DashboardGangguanOlt/upload: " . print_r($dbErr, true));
            }
        } catch (Exception $e) {
            error_log("Exception in DashboardGangguanOlt/upload: " . $e->getMessage());
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
            'rows_inserted' => count($insertRows),
            'rows_filtered' => count($counts),
        ];

        header('Content-Type: application/json');
        echo json_encode($out);
    }
}
