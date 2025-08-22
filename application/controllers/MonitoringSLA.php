<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringSLA extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->database();
    }

    public function index()
    {
        session_start();
        // if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], array('Superadmin','NOC Ritel'))) {
        //     redirect('DashboardNoc'); return;
        // }
        $this->load->view('navbar');
        $this->load->view('monitoringSLA');
    }

    public function upload()
    {
        session_start();

        // 0) Validasi presence file
        if (!isset($_FILES['excel_file']) || $_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
            echo 'File tidak ditemukan atau gagal diunggah.';
            redirect('MonitoringSLA'); return;
        }

        // 1) Simpan file manual
        $origName = $_FILES['excel_file']['name'];
        $tmpPath  = $_FILES['excel_file']['tmp_name'];
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
        $allowed = array('xls','xlsx','csv');
        if (!in_array($ext, $allowed, true)) {
            $sig4 = '';
            if (is_readable($tmpPath)) {
                $fh = fopen($tmpPath, 'rb');
                if ($fh) { $sig4 = bin2hex(fread($fh, 4)); fclose($fh); }
            }
            if (strpos($sig4, 'd0cf11e0') === 0)      { $ext = 'xls'; }
            elseif (strpos($sig4, '504b0304') === 0)  { $ext = 'xlsx'; }
            else                                      { $ext = 'csv'; }
        }

        $destDir = FCPATH.'application/uploads';
        if (!is_dir($destDir)) { @mkdir($destDir, 0755, true); }
        $dest = $destDir . '/' . uniqid('xl_', true) . '.' . $ext;

        if (!@move_uploaded_file($tmpPath, $dest)) {
            echo 'Gagal menyimpan file upload.';
            redirect('MonitoringSLA'); return;
        }

        // 2) Baca file (PHPExcel tanpa Composer)
        require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';
        require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php';

        try {
            if ($ext === 'xls') {
                $reader = PHPExcel_IOFactory::createReader('Excel5');
            } elseif ($ext === 'xlsx') {
                $reader = PHPExcel_IOFactory::createReader('Excel2007');
            } else {
                $reader = PHPExcel_IOFactory::createReader('CSV');
                $reader->setDelimiter(',');
                $reader->setEnclosure('"');
                $reader->setReadDataOnly(true);
            }

            // Binder boolean → numeric 0/1
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

            ob_start();
            $objPHPExcel = $reader->load($dest);
            $noise = ob_get_clean();
            if (!empty($noise)) {
                log_message('error', 'PHPExcel output suppressed: '.substr(preg_replace('/\s+/', ' ', $noise), 0, 1000));
            }

            $sheet = $objPHPExcel->getActiveSheet();
            $rows  = $sheet->toArray(null, true, true, true);
            if (count($rows) < 1) throw new Exception('File kosong atau tidak ada data.');

            // DEBUG header mentah (opsional)
            // $__hdr = reset($rows); log_message('error', 'HEADER MENTAH: '.json_encode($__hdr));

            // 3) Header mapping + fallback positional
            $header = array_shift($rows);
            try {
                $map = $this->buildHeaderMap($header);
            } catch (Exception $e) {
                // Fallback: tidak ada header → pakai urutan kolom
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
                    'kabupatensplitter','kecamatansplitter','kelurahansplitter','vip','tanggalinsiden',
                    'tanggalsendnoc'
                );
                $firstRow = reset($rows);
                $cols     = array_keys($firstRow);
                $map      = array();
                $max = min(count($cols), count($positional));
                for ($i = 0; $i < $max; $i++) {
                    $map[$cols[$i]] = $positional[$i];
                }
                if (!in_array('idtiket', $map, true)) {
                    throw new Exception('Header tidak dikenali dan fallback posisi gagal menemukan "idtiket".');
                }
            }

            // 4) Bangun data & normalisasi
            $batch = array();
            foreach ($rows as $r) {
                $rec = $this->mapRowToRecord($r, $map);

                // NOT NULL untuk waktugangguan2
                if (empty($rec['waktugangguan2'])) {
                    if (!empty($rec['waktugangguan']))      $rec['waktugangguan2'] = $rec['waktugangguan'];
                    elseif (!empty($rec['waktulapor']))      $rec['waktugangguan2'] = $rec['waktulapor'];
                    else                                     $rec['waktugangguan2'] = '1970-01-01 00:00:00';
                }

                if (!isset($rec['idtiket']) || $rec['idtiket'] === '') continue;
                $batch[] = $rec;
            }
            if (empty($batch)) throw new Exception('Tidak ada baris valid untuk diimpor.');

            // (Opsional) preview 5 record di log
            // log_message('error', 'PREVIEW RECORD: '.json_encode(array_slice($batch,0,5)));

            // 5) UPSERT batch
            $total = 0;
            foreach (array_chunk($batch, 300) as $ck) {
                $total += $this->upsert_batch($ck, 'listTicketing', 'idtiket');
            }
            // echo 'Import selesai. Diproses: '.$total;

        } catch (Exception $e) {
            echo 'Gagal memproses: '.$e->getMessage(); die;
        }

        // Beres
        if (is_file($dest)) { @unlink($dest); }
        if (isset($this->db)) { $this->db->close(); }

        header('location:../MonitoringSLA');
    }

    /* ======================== Helpers ======================== */

    private function buildHeaderMap($headerRow)
    {
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
            'kabupatensplitter','kecamatansplitter','kelurahansplitter','vip','tanggalinsiden',
            'tanggalsendnoc'
        );

        $aliases = array(
            'id tiket'=>'idtiket','id pelanggan'=>'idpelanggan','id insiden'=>'idinsiden',
            'nama pelanggan'=>'namapelanggan','sid baru'=>'sidbaru','sid lama'=>'sidlama',
            'id pln'=>'idpln','nama kelompok'=>'namakelompok','nama kondisi'=>'namakondisi',
            'nama sbu'=>'namasbu','nama kp'=>'namakp','telepon'=>'telepon',
            'telepon pelanggan'=>'telepon','nama pelapor'=>'namapelapor','isi laporan'=>'isilaporan',
            'tanggapan'=>'tanggapan','status'=>'status','waktu gangguan'=>'waktugangguan',
            'penerima laporan'=>'penerimalaporan','produk'=>'produk','posisi tiket'=>'posisitiket',
            'id olt'=>'idolt','brand olt'=>'brandolt','id splitter'=>'idsplitter',
            'penyebab'=>'penyebab','penyebab detail'=>'penyebabdetail','nama mitra'=>'namamitra',
            'petugas lapangan'=>'petugaslapangan','tipe tiket'=>'tipetiket','laporan berulang'=>'laporanberulang',
            'gangguan ke'=>'gangguanke','nama sumber'=>'namasumber','segmen icon'=>'segmenicon',
            'segmen ikon'=>'segmenicon','waktu lapor'=>'waktulapor','waktu gangguan 2'=>'waktugangguan2',
            'waktu gangguan kedua'=>'waktugangguan2','waktu laporan selesai'=>'waktulaporanselesai',
            'durasi laporan'=>'durasilaporan','durasi laporan menit'=>'durasilaporanmenit',
            'waktu gangguan selesai'=>'waktugangguanselesai','durasi gangguan'=>'durasigangguan',
            'durasi gangguan menit'=>'durasigangguanmenit','durasi stopclock'=>'durasistopclock',
            'durasi gangguan minus stopclock'=>'durasigangguaminusstopclock','end customer'=>'endcustomer',
            'durasi stopclock pelanggan'=>'durasistopclockpelanggan',
            'durasi gangguan minus stopclock pelanggan'=>'durasigangguanminusstopclockpelanggan',
            'keterangan close'=>'keteranganclose','segmen pelanggan'=>'segmenpelanggan','bandwidth'=>'bandwidth',
            'last komen'=>'lastkomen','lat long pelanggan'=>'latlongpelanggan','lat/long pelanggan'=>'latlongpelanggan',
            'provinsi pelanggan'=>'provinsipelanggan','kabupaten pelanggan'=>'kabupatenpelanggan',
            'kecamatan pelanggan'=>'kecamatanpelanggan','kelurahan pelanggan'=>'kelurahanpelanggan',
            'lat long splitter'=>'latlongsplitter','lat/long splitter'=>'latlongsplitter',
            'provinsi splitter'=>'provinsisplitter','kabupaten splitter'=>'kabupatensplitter',
            'kecamatan splitter'=>'kecamatansplitter','kelurahan splitter'=>'kelurahansplitter',
            'tanggal insiden'=>'tanggalinsiden','tanggal send noc'=>'tanggalsendnoc',
            'tgl send noc'=>'tanggalsendnoc','tgl kirim noc'=>'tanggalsendnoc'
        );

        $map  = array();
        $seen = array(); // untuk hitung duplikasi "waktugangguan"

        foreach ($headerRow as $col => $label) {
            $norm = $this->normalize($label);
            $base = isset($aliases[$norm]) ? $aliases[$norm] : $norm;

            // duplikasi 'waktugangguan' → kemunculan ke-2 jadi 'waktugangguan2'
            if ($base === 'waktugangguan') {
                $count = isset($seen['waktugangguan']) ? $seen['waktugangguan'] + 1 : 1;
                $seen['waktugangguan'] = $count;
                if ($count >= 2) $base = 'waktugangguan2';
            }

            if (in_array($base, $valid, true)) {
                $map[$col] = $base;
            }
        }

        if (empty($map) || !in_array('idtiket', $map, true)) {
            throw new Exception('Header tidak dikenali atau kolom "idtiket" tidak ada.');
        }

        // log_message('error', 'HEADER MAP: '.json_encode($map));
        return $map;
    }

    private function normalize($s)
    {
        $s = strtolower(trim((string)$s));
        $s = preg_replace('/[^\p{L}\p{N}\s]+/u', ' ', $s); // hapus tanda baca → spasi
        $s = preg_replace('/\s+/', ' ', $s);               // satukan spasi
        if (strpos($s, 'no ') === 0 || strpos($s, 'nomor ') === 0) {
            $s = preg_replace('/^(no|nomor)\s+/','id ',$s);
        }
        return $s;
    }

    private function mapRowToRecord($row, $map)
    {
        $rec = array();
        foreach ($map as $col => $dbCol) {
            $val = isset($row[$col]) ? trim((string)$row[$col]) : null;

            // kolom waktu yang harus distandardkan
            if (in_array($dbCol, array(
                'waktugangguan','waktulapor','waktulaporanselesai',
                'waktugangguan2','waktugangguanselesai','tanggalinsiden','tanggalsendnoc'
            ), true)) {
                $rec[$dbCol] = $this->toDatetime($val);

            } elseif (in_array($dbCol, array('durasilaporanmenit','durasigangguanmenit','laporanberulang','gangguanke'), true)) {
                $rec[$dbCol] = ($val === '' ? null : (int)preg_replace('/[^\d\-]+/', '', $val));

            } else {
                // Simpan '-' sebagai NULL bila perlu (opsional):
                // if ($val === '-' ) { $val = null; }
                $rec[$dbCol] = ($val === '' ? null : $val);
            }
        }
        return $rec;
    }

    private function toDatetime($v)
    {
        if ($v === null || $v === '') return null;

        // 1) Excel serial number (numeric) → pakai date() (bukan gmdate) agar tidak geser TZ
        if (is_numeric($v)) {
            $unix = ($v - 25569) * 86400; // 25569 = 1970-01-01
            return date('Y-m-d H:i:s', (int)$unix);
        }

        // Normalisasi string
        $s = (string)$v;
        // ganti NBSP ke spasi, trim
        $s = str_replace("\xC2\xA0", ' ', $s);
        $s = trim($s);

        // 2) Normalisasi jam "08.38" atau "08.38.21" → "08:38" / "08:38:21"
        $s = preg_replace('/\b(\d{1,2})\.(\d{2})(?:\.(\d{2}))?\b/', '$1:$2' . '${3:+:$3}', $s);

        // === PARSER *STRICT* D/M/Y ===
        // Terima: dd/mm/yy(yy) HH:MM[:SS] atau dd-mm-yy(yy) HH:MM[:SS]
        if (preg_match(
            '/^(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{2,4})(?:\s+(\d{1,2}):(\d{2})(?::(\d{2}))?)?$/',
            $s,
            $m
        )) {
            $d  = (int)$m[1];   // H A R U S dianggap hari
            $mo = (int)$m[2];   // H A R U S dianggap bulan
            $y  = (int)$m[3];
            $H  = isset($m[4]) ? (int)$m[4] : 0;
            $i  = isset($m[5]) ? (int)$m[5] : 0;
            $S  = isset($m[6]) ? (int)$m[6] : 0;

            // Tahun 2 digit → 2000–2069 atau 1970–1999 (aturan PHP)
            if ($y < 100) { $y += ($y <= 69) ? 2000 : 1900; }

            if (checkdate($mo, $d, $y)) {
                return sprintf('%04d-%02d-%02d %02d:%02d:%02d', $y, $mo, $d, $H, $i, $S);
            } else {
                // Jika tanggal tidak valid (mis. 31/02/25), kembalikan null
                return null;
            }
        }

        // === Fallback HANYA untuk format yang TIDAK AMBIGU ===
        // ISO atau variasi jelas (YYYY-mm-dd ...)
        $fmts_clear = array(
            'Y-m-d H:i:s','Y-m-d H:i','Y/m/d H:i:s','Y/m/d H:i',
            'Y-m-d','Y/m/d',
            // juga izinkan d-m-Y / d/m/Y tapi TETAP DMY (4 digit tahun tidak ambigu di ID)
            'd-m-Y H:i:s','d-m-Y H:i','d/m/Y H:i:s','d/m/Y H:i','d-m-Y','d/m/Y'
        );
        foreach ($fmts_clear as $f) {
            $dt = DateTime::createFromFormat($f, $s);
            if ($dt instanceof DateTime) {
                return $dt->format('Y-m-d H:i:s');
            }
        }

        // Terakhir: JANGAN pakai strtotime() untuk format ambigu—bisa kebalik lagi.
        return null;
    }


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
