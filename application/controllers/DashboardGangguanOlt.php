<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));

        // Parse file based on extension
        if ($ext === 'xlsx') {
            $data = $this->parseXLSX($tmp);
        } elseif ($ext === 'csv') {
            $data = $this->parseCSV($tmp);
        } elseif ($ext === 'xls') {
            // Try CSV fallback for XLS (many XLS can be read as text)
            $data = $this->parseCSV($tmp);
            if (!$data) {
                echo json_encode(['error'=>'Format XLS tidak didukung. Silakan convert ke XLSX atau CSV']);
                return;
            }
        } else {
            echo json_encode(['error'=>'File harus .xlsx, .csv, atau .xls']);
            return;
        }

        if (!$data || count($data) < 2) {
            error_log("Parse result: " . count($data ?? []) . " rows");
            echo json_encode(['error'=>'Spreadsheet contains no data or parsing failed']);
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

        $colDevice = $findCol(['devicename','deviceName']);
        $colId = $findCol(['idinsiden','idInsiden']);
        $colPetugas = $findCol(['namapetugasbuat','namaPetugasBuat']);
        $colTanggal = $findCol(['tanggalgangguan','tanggalGangguan']);
        $colPenyebab = $findCol(['penyebabdetail','penyebabDetail','penyebab']);

        // Debug: log all found columns
        error_log("Found headers: " . json_encode($headers));
        error_log("Columns - Device:$colDevice, ID:$colId, Petugas:$colPetugas, Tanggal:$colTanggal, Penyebab:$colPenyebab");

        if (!$colDevice || !$colId || !$colPetugas) {
            error_log("Columns not found. Device=$colDevice, ID=$colId, Petugas=$colPetugas");
            echo json_encode([
                'error'=>'Required columns not found (devicename, idinsiden, namaPetugasBuat)',
                'debug_headers' => $headers,
                'debug_raw_headers' => $headerRow,
            ]);
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

    private function parseCSV($filePath)
    {
        $rows = [];
        $handle = fopen($filePath, 'r');
        if (!$handle) {
            error_log("Failed to open file for CSV parsing");
            return null;
        }

        // Detect delimiter (try comma, semicolon, tab)
        $firstLine = fgets($handle);
        rewind($handle);

        $delimiter = ',';
        if (substr_count($firstLine, ';') > substr_count($firstLine, ',')) {
            $delimiter = ';';
        } elseif (substr_count($firstLine, "\t") > substr_count($firstLine, ',')) {
            $delimiter = "\t";
        }

        while (($data = fgetcsv($handle, 0, $delimiter)) !== false) {
            if (!empty(array_filter($data))) {
                $rows[] = $data;
            }
        }
        fclose($handle);

        error_log("CSV parsed: " . count($rows) . " rows with delimiter '$delimiter'");
        return $rows;
    }

    private function parseXLSX($filePath)
    {
        $zip = new ZipArchive();
        if ($zip->open($filePath) !== true) {
            error_log("Failed to open XLSX as ZIP");
            return null;
        }

        // Try sheet1.xml first, then look for other sheets
        $xml_string = null;
        for ($i = 1; $i <= 10; $i++) {
            $sheet_path = 'xl/worksheets/sheet' . $i . '.xml';
            if ($zip->locateName($sheet_path) !== false) {
                $xml_string = $zip->getFromName($sheet_path);
                if ($xml_string) break;
            }
        }
        $zip->close();

        if (!$xml_string) {
            error_log("No worksheet XML found in XLSX");
            return null;
        }

        // Parse XML
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xml_string);
        if (!$xml) {
            error_log("Failed to parse worksheet XML: " . implode("; ", array_map(function($e) { return $e->message; }, libxml_get_errors())));
            libxml_clear_errors();
            return null;
        }

        $rows = [];
        $sheetData = $xml->sheetData;

        if (!$sheetData) {
            error_log("No sheetData element found");
            return null;
        }

        foreach ($sheetData->row as $row) {
            $rowData = [];
            if (count($row->c) > 0) {
                foreach ($row->c as $cell) {
                    $val = '';
                    // Handle different cell value types
                    if (isset($cell->v)) {
                        $val = (string)$cell->v;
                    } elseif (isset($cell->is->t)) {
                        $val = (string)$cell->is->t;
                    } elseif (isset($cell->t)) {
                        // Some formats store text in different way
                        if ((string)$cell->t === 's') {
                            // Shared string reference
                            $val = (string)$cell->v;
                        }
                    }
                    $rowData[] = $val;
                }
            }
            // Keep all rows including empty, but track non-empty
            if (!empty(array_filter($rowData))) {
                $rows[] = $rowData;
            } elseif (count($rows) > 0) {
                // Keep empty rows after first data row to maintain structure
                $rows[] = $rowData;
            }
        }

        error_log("XLSX parsed: " . count($rows) . " rows");
        return $rows;
    }
}
