<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringSLA extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->model('ListTicketing_model', 'ticketModel');
    }

    public function index()
    {
        $this->load->view('ticketing_upload_form'); // form sederhana di atas
    }

    public function upload()
    {
        $this->load->library('session');

        // ---- KONFIG UPLOAD ----
        $config = array(
            'upload_path'   => FCPATH.'application/uploads',
            'allowed_types' => 'xls|xlsx',
            'encrypt_name'  => TRUE,
            'max_size'      => 10240,
            // Jika masih ditolak mime-type:
            // 'detect_mime' => FALSE,
        );
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('excel_file')) {
            $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
            redirect('MonitoringSLA');
            return;
        }

        $fileData = $this->upload->data();
        $path     = $fileData['full_path'];

        // ---- LOAD PHPExcel TANPA COMPOSER ----
        require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';
        require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php';

        try {
            $objPHPExcel = PHPExcel_IOFactory::load($path);
            $sheet       = $objPHPExcel->getActiveSheet();
            $rows        = $sheet->toArray(null, true, true, true);

            if (count($rows) < 2) {
                throw new Exception('File kosong atau tidak ada data.');
            }

            // --- HEADER ---
            $header = array_shift($rows); // baris 1
            $map    = $this->buildHeaderMap($header);

            // --- DATA ---
            $batch = array();
            foreach ($rows as $r) {
                $rec = $this->mapRowToRecord($r, $map);
                if (!isset($rec['idtiket']) || $rec['idtiket'] === '') continue;
                $batch[] = $rec;
            }

            if (empty($batch)) {
                throw new Exception('Tidak ada baris valid untuk diimpor.');
            }

            $total  = 0;
            $chunks = array_chunk($batch, 500);
            foreach ($chunks as $ck) {
                $total += $this->ticketModel->upsert_batch($ck, 'idtiket');
            }

            $this->session->set_flashdata('success', 'Import selesai. Diproses: '.$total);
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Gagal memproses: '.$e->getMessage());
        }

        if (is_file($path)) { @unlink($path); }
        redirect('MonitoringSLA');
    }

    private function buildHeaderMap($headerRow)
    {
        $valid = array(
            'idtiket','idpelanggan','idinsiden','namapelanggan','sidbaru','sidlama','idpln',
            'namakelompok','namakondisi','namasbu','namakp','telepon','namapelapor','isilaporan',
            'tanggapan','status','waktugangguan','penerimalaporan','produk','posisitiket','idolt',
            'brandolt','idsplitter','penyebab','penyebabdetail','namamitra','petugaslapangan',
            'tipetiket','laporanberulang','gangguanke','namasumber','segmenicon','waktulapor',
            'waktulaporanselesai','durasilaporan','durasilaporanmenit','waktugangguanselesai',
            'durasigangguan','durasigangguanmenit','durasistopclock','durasigangguaminusstopclock',
            'endcustomer','durasistopclockpelanggan','durasigangguanminusstopclockpelanggan',
            'keteranganclose','segmenpelanggan','bandwidth','lastkomen','latlongpelanggan',
            'provinsipelanggan','kabupatenpelanggan','kecamatanpelanggan','kelurahanpelanggan',
            'latlongsplitter','provinsisplitter','kabupatensplitter','kecamatansplitter',
            'kelurahansplitter','vip','tanggalinsiden','tanggalsendnoc'
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
            'tanggal send noc'=>'tanggalsendnoc'
        );

        $map = array();
        foreach ($headerRow as $col => $label) {
            $norm   = $this->normalize($label);
            $target = isset($aliases[$norm]) ? $aliases[$norm] : $norm;
            if (in_array($target, $valid, true)) $map[$col] = $target;
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
                'waktugangguan','waktulapor','waktulaporanselesai',
                'waktugangguanselesai','tanggalinsiden','tanggalsendnoc'
            ), true)) {
                $rec[$dbCol] = $this->toDatetime($val);
            } elseif (in_array($dbCol, array('durasilaporanmenit','durasigangguanmenit'), true)) {
                $rec[$dbCol] = ($val === '' ? null : (int)preg_replace('/\D+/', '', $val));
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
            // PHPExcel pakai basis 1900; 25569 = 1970-01-01
            $unix = ($v - 25569) * 86400;
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
}
