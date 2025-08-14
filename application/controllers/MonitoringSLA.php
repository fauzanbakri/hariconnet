<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringSLA extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('session');
		session_start();
        $this->load->database();
    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Gate opsional:
        // if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], array('Superadmin','NOC Ritel'))) {
        //     redirect('DashboardNoc'); return;
        // }
        $this->load->view('navbar');
        $this->load->view('monitoringSLA');
    }

    public function upload()
    {
		session_start();
        // ====== 0) Validasi presence file ======
        if (!isset($_FILES['excel_file']) || $_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
            $this->session->set_flashdata('error', 'File tidak ditemukan atau gagal diunggah.');
            redirect('MonitoringSLA'); return;
        }

        // ====== 1) Simpan file secara MANUAL (bypass CI Upload lib) ======
        $origName = $_FILES['excel_file']['name'];
        $tmpPath  = $_FILES['excel_file']['tmp_name'];

        // Ekstensi dari nama file
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));

        // Kalau ekstensi tidak termasuk xls/xlsx/csv, coba sniff signature
        $allowed = array('xls','xlsx','csv');
        if (!in_array($ext, $allowed, true)) {
            $sig4 = '';
            if (is_readable($tmpPath)) {
                $fh = fopen($tmpPath, 'rb');
                if ($fh) { $sig4 = bin2hex(fread($fh, 4)); fclose($fh); }
            }
            // XLS (OLE) = D0 CF 11 E0
            if (strpos($sig4, 'd0cf11e0') === 0)      { $ext = 'xls'; }
            // XLSX (ZIP) = 50 4B 03 04
            elseif (strpos($sig4, '504b0304') === 0)  { $ext = 'xlsx'; }
            else                                      { $ext = 'csv'; }
        }

        // Pastikan folder upload ada
        $destDir = FCPATH.'application/uploads';
        if (!is_dir($destDir)) { @mkdir($destDir, 0755, true); }

        // Nama file tujuan
        $dest = $destDir . '/' . uniqid('xl_', true) . '.' . $ext;

        if (!@move_uploaded_file($tmpPath, $dest)) {
            $this->session->set_flashdata('error', 'Gagal menyimpan file upload.');
            redirect('MonitoringSLA'); return;
        }

        // ====== 2) Baca file (PHPExcel tanpa Composer) ======
        require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';
        require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php';

        try {
            // Pilih reader dari ekstensi
            if ($ext === 'xls') {
                $reader = PHPExcel_IOFactory::createReader('Excel5');
            } elseif ($ext === 'xlsx') {
                $reader = PHPExcel_IOFactory::createReader('Excel2007');
            } else { // csv
                $reader = PHPExcel_IOFactory::createReader('CSV');
                $reader->setDelimiter(',');
                $reader->setEnclosure('"');
                $reader->setReadDataOnly(true);
            }

            // Anonymous ValueBinder: hindari notice boolean
            $binder = new class extends PHPExcel_Cell_DefaultValueBinder {
                public function bindValue(PHPExcel_Cell $cell, $value = null) {
                    if (is_bool($value)) {
                        $cell->setValueExplicit($value ? 1 : 0, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        return true;
                    }
                    return parent::bindValue($cell, $value);
                }
            };
            PHPExcel_Cell::setValueBinder($binder);

            // Buffer output liar dari library
            ob_start();
            $objPHPExcel = $reader->load($dest);
            $noise = ob_get_clean();
            if (!empty($noise)) {
                log_message('error', 'PHPExcel output suppressed: '.substr(preg_replace('/\s+/', ' ', $noise), 0, 1000));
            }

            $sheet = $objPHPExcel->getActiveSheet();
            $rows  = $sheet->toArray(null, true, true, true); // keys: A,B,C,...

            if (count($rows) < 1) {
                throw new Exception('File kosong atau tidak ada data.');
            }

            // ====== 3) Header mapping + fallback posisi ======
            $header = array_shift($rows);
            try {
                $map = $this->buildHeaderMap($header);
            } catch (Exception $e) {
                // Fallback: tak ada header → pakai urutan kolom sesuai skema DB kamu
                array_unshift($rows, $header);

                $positional = array(
                    'idtiket','idpelanggan','idinsiden','namapelanggan','sidbaru','sidlama','idpln',
                    'namakelompok','namakondisi','namasbu','namakp','telepon','namapelapor','isilaporan',
                    'tanggapan','status','waktugangguan','penerimalaporan','produk','posisitiket','idolt',
                    'brandolt','idsplitter','penyebab','penyebabdetail','namamitra','petugaslapangan',
                    'tipetiket','laporanberulang','gangguanke','namasumber','segmenicon','waktulapor',
                    'waktugangguan2','waktulaporanselesai','durasilaporan','durasilaporanmenit',
                    'waktugangguanselesai','durasigangguan','durasigangguanmenit','durasistopclock',
                    'durasigangguaminusstopclock','endcustomer','durasistopclockpelanggan',
                    'durasigangguanminusstopclockpelanggan','keteranganclose','segmenpelanggan',
                    'bandwidth','lastkomen','latlongpelanggan','provinsipelanggan','kabupatenpelanggan',
                    'kecamatanpelanggan','kelurahanpelanggan','latlongsplitter','provinsisplitter',
                    'kabupatensplitter','kecamatansplitter','kelurahansplitter','vip','tanggalinsiden'
                );

                $firstRow = reset($rows);
                $cols     = array_keys($firstRow); // ex: ['A','B','C',...]
                $map      = array();

                $max = min(count($cols), count($positional));
                for ($i = 0; $i < $max; $i++) {
                    $map[$cols[$i]] = $positional[$i];
                }

                if (!in_array('idtiket', $map, true)) {
                    throw new Exception('Header tidak dikenali dan fallback posisi gagal menemukan "idtiket".');
                }
            }

            // ====== 4) Bangun data & normalisasi ======
            $batch = array();
            foreach ($rows as $r) {
                $rec = $this->mapRowToRecord($r, $map);

                // NOT NULL untuk waktugangguan2 (DB kamu set NOT NULL)
                if (empty($rec['waktugangguan2'])) {
                    if (!empty($rec['waktugangguan']))      $rec['waktugangguan2'] = $rec['waktugangguan'];
                    elseif (!empty($rec['waktulapor']))      $rec['waktugangguan2'] = $rec['waktulapor'];
                    else                                     $rec['waktugangguan2'] = '1970-01-01 00:00:00';
                }

                if (!isset($rec['idtiket']) || $rec['idtiket'] === '') continue;
                $batch[] = $rec;
            }

            if (empty($batch)) {
                throw new Exception('Tidak ada baris valid untuk diimpor.');
            }

            // ====== 5) UPSERT batch ======
            $total = 0;
            foreach (array_chunk($batch, 300) as $ck) {
                $total += $this->upsert_batch($ck, 'listTicketing', 'idtiket');
            }

            $this->session->set_flashdata('success', 'Import selesai. Diproses: '.$total);
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Gagal memproses: '.$e->getMessage());
        }

        // Beres: hapus file + tutup koneksi
        if (is_file($dest)) { @unlink($dest); }
        if (isset($this->db)) { $this->db->close(); }

        redirect('MonitoringSLA');
    }

    /* ======================== Helpers ======================== */

    private function buildHeaderMap($headerRow)
    {
        // Kolom sesuai skema yang kamu kirim
        $valid = array(
            'idtiket','idpelanggan','idinsiden','namapelanggan','sidbaru','sidlama','idpln',
            'namakelompok','namakondisi','namasbu','namakp','telepon','namapelapor','isilaporan',
            'tanggapan','status','waktugangguan','penerimalaporan','produk','posisitiket','idolt',
            'brandolt','idsplitter','penyebab','penyebabdetail','namamitra','petugaslapangan',
            'tipetiket','laporanberulang','gangguanke','namasumber','segmenicon','waktulapor',
            'waktugangguan2','waktulaporanselesai','durasilaporan','durasilaporanmenit',
            'waktugangguanselesai','durasigangguan','durasigangguanmenit','durasistopclock',
            'durasigangguaminusstopclock','endcustomer','durasistopclockpelanggan',
            'durasigangguanminusstopclockpelanggan','keteranganclose','segmenpelanggan',
            'bandwidth','lastkomen','latlongpelanggan','provinsipelanggan','kabupatenpelanggan',
            'kecamatanpelanggan','kelurahanpelanggan','latlongsplitter','provinsisplitter',
            'kabupatensplitter','kecamatansplitter','kelurahansplitter','vip','tanggalinsiden'
        );

        $aliases = array(
            'id tiket'=>'idtiket','id pelanggan'=>'idpelanggan','id insiden'=>'idinsiden',
            'nama pelanggan'=>'namapelanggan','sid baru'=>'sidbaru','sid lama'=>'sidlama',
            'id pln'=>'idpln','nama kelompok'=>'namakelompok','nama kondisi'=>'namakondisi',
            'nama sbu'=>'namasbu','nama kp'=>'namakp','telepon pelanggan'=>'telepon',
            'nama pelapor'=>'namapelapor','isi laporan'=>'isilaporan','posisi tiket'=>'posisitiket',
            'id olt'=>'idolt','brand olt'=>'brandolt','id splitter'=>'idsplitter',
            'penyebab detail'=>'penyebabdetail','petugas lapangan'=>'petugaslapangan',
            'tipe tiket'=>'tipetiket','laporan berulang'=>'laporanberulang','gangguan ke'=>'gangguanke',
            'nama sumber'=>'namasumber','segmen icon'=>'segmenicon','waktu lapor'=>'waktulapor',
            'waktu gangguan'=>'waktugangguan',
            'waktu gangguan 2'=>'waktugangguan2','waktu gangguan kedua'=>'waktugangguan2',
            'waktu laporan selesai'=>'waktulaporanselesai','durasi laporan'=>'durasilaporan',
            'durasi laporan (menit)'=>'durasilaporanmenit','waktu gangguan selesai'=>'waktugangguanselesai',
            'durasi gangguan'=>'durasigangguan','durasi gangguan (menit)'=>'durasigangguanmenit',
            'durasi stopclock'=>'durasistopclock','durasi gangguan minus stopclock'=>'durasigangguaminusstopclock',
            'end customer'=>'endcustomer','durasi stopclock pelanggan'=>'durasistopclockpelanggan',
            'durasi gangguan minus stopclock pelanggan'=>'durasigangguanminusstopclockpelanggan',
            'keterangan close'=>'keteranganclose','segmen pelanggan'=>'segmenpelanggan',
            'last komen'=>'lastkomen','lat/long pelanggan'=>'latlongpelanggan',
            'provinsi pelanggan'=>'provinsipelanggan','kabupaten pelanggan'=>'kabupatenpelanggan',
            'kecamatan pelanggan'=>'kecamatanpelanggan','kelurahan pelanggan'=>'kelurahanpelanggan',
            'lat/long splitter'=>'latlongsplitter','provinsi splitter'=>'provinsisplitter',
            'kabupaten splitter'=>'kabupatensplitter','kecamatan splitter'=>'kecamatansplitter',
            'kelurahan splitter'=>'kelurahansplitter','tanggal insiden'=>'tanggalinsiden',
        );

        $map = array();
        foreach ($headerRow as $col => $label) {
            $norm   = $this->normalize($label);
            $target = isset($aliases[$norm]) ? $aliases[$norm] : $norm;
            if (in_array($target, $valid, true)) {
                $map[$col] = $target;
            }
        }
        if (empty($map) || !in_array('idtiket', $map, true)) {
            throw new Exception('Header tidak dikenali atau kolom "idtiket" tidak ada.');
        }
        return $map;
    }

    private function normalize($s)
    {
        $s = strtolower(trim((string)$s));
        $s = preg_replace('/\s+/', ' ', $s);
        return $s;
    }

    private function mapRowToRecord($row, $map)
    {
        $rec = array();
        foreach ($map as $col => $dbCol) {
            $val = isset($row[$col]) ? trim((string)$row[$col]) : null;

            if (in_array($dbCol, array(
                'waktugangguan','waktulapor','waktugangguan2','waktulaporanselesai',
                'waktugangguanselesai','tanggalinsiden'
            ), true)) {
                $rec[$dbCol] = $this->toDatetime($val);
            } elseif (in_array($dbCol, array('durasilaporanmenit','durasigangguanmenit','laporanberulang','gangguanke'), true)) {
                $rec[$dbCol] = ($val === '' ? null : (int)preg_replace('/[^\d\-]+/', '', $val));
            } else {
                $rec[$dbCol] = ($val === '' ? null : $val);
            }
        }
        return $rec;
    }

    private function toDatetime($v)
    {
        if ($v === null || $v === '') return null;

        // Excel serial number?
        if (is_numeric($v)) {
            $unix = ($v - 25569) * 86400; // 25569 = 1970-01-01
            return gmdate('Y-m-d H:i:s', (int)$unix);
        }

        $s = trim((string)$v);
        // ubah "14.59" -> "14:59" di akhir
        $s = preg_replace('/(\d{1,2})\.(\d{2})(?=$)/', '$1:$2', $s);

        $fmts = array(
            'd/m/y H:i','d/m/Y H:i','d-m-y H:i','d-m-Y H:i',
            'Y-m-d H:i','Y-m-d H:i:s','d/m/y H:i:s','d/m/Y H:i:s'
        );
        foreach ($fmts as $f) {
            $dt = DateTime::createFromFormat($f, $s);
            if ($dt instanceof DateTime) return $dt->format('Y-m-d H:i:s');
        }
        $ts = strtotime($s);
        return $ts ? date('Y-m-d H:i:s', $ts) : null;
    }

    /**
     * UPSERT batch (ON DUPLICATE KEY UPDATE) langsung dari controller
     */
    private function upsert_batch(array $rows, $table, $uniqueKey = 'idtiket')
    {
        if (empty($rows)) return 0;

        $columns = array_keys($rows[0]);

        $values = array();
        $binds  = array();
        foreach ($rows as $r) {
            $place = array();
            foreach ($columns as $c) {
                $place[] = '?';
                $binds[] = array_key_exists($c, $r) ? $r[$c] : null;
            }
            $values[] = '('.implode(',', $place).')';
        }

        $updates = array();
        foreach ($columns as $c) {
            if ($c === $uniqueKey) continue;
            $updates[] = "`$c` = VALUES(`$c`)";
        }

        $sql = "INSERT INTO `{$table}` (`".implode('`,`', $columns)."`) VALUES "
             . implode(',', $values)
             . " ON DUPLICATE KEY UPDATE ".implode(',', $updates);

        $this->db->query($sql, $binds);
        return $this->db->affected_rows();
    }
}
