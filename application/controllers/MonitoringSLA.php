<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	use PhpOffice\PhpSpreadsheet\IOFactory;

	class MonitoringSLA extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->helper(['form', 'url']);
			$this->load->model('MonitoringSLA_model', 'ticketModel');
		}

		public function index()
		{
			$title['title']="Monitoring SLA";
			session_start();
			$this->load->view('navbar',$title);
			$this->load->view('monitoringSLA');
		}

		public function upload()
		{
			$this->load->library('session');
			// 1) Upload file
			$config = [
				'upload_path'   => FCPATH.'application/uploads',
				'allowed_types' => 'xls|xlsx',
				'encrypt_name'  => TRUE,
				'max_size'      => 10240, // 10 MB
			];
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('excel_file')) {
				$this->session->set_flashdata('error', $this->upload->display_errors('', ''));
				echo $this->upload->display_errors('', '').FCPATH.'application/uploads';die;
				return header('location:MonitoringSLA');
			}

			$fileData  = $this->upload->data();
			$fullPath  = $fileData['full_path'];

			try {
				// 2) Baca spreadsheet
				$spreadsheet = IOFactory::load($fullPath);
				$sheet       = $spreadsheet->getActiveSheet();
				$rows        = $sheet->toArray(null, true, true, true);

				if (count($rows) < 2) {
					throw new Exception('File kosong atau tidak ada data.');
				}

				// 3) Header -> mapping kolom DB
				$headerRow = array_shift($rows); // ambil baris header
				$headerMap = $this->buildHeaderMap($headerRow); // assoc: colIndex => dbColumn

				// 4) Konstruksi data untuk insert
				$dataToInsert = [];
				foreach ($rows as $r) {
					$item = $this->mapRowToRecord($r, $headerMap);

					// Abai baris kosong (tanpa idtiket)
					if (empty($item['idtiket'])) {
						continue;
					}
					$dataToInsert[] = $item;
				}

				if (empty($dataToInsert)) {
					throw new Exception('Tidak ada baris valid untuk diimpor.');
				}

				// 5) Upsert batch (ON DUPLICATE KEY UPDATE) per 500
				$chunk = 500;
				$total = 0;
				foreach (array_chunk($dataToInsert, $chunk) as $pack) {
					$total += $this->ticketModel->upsert_batch($pack, 'idtiket');
				}

				$this->session->set_flashdata('success', "Import selesai. Baris diproses: {$total}");
			} catch (Throwable $e) {
				$this->session->set_flashdata('error', 'Gagal memproses file: '.$e->getMessage());
			} finally {
				// Hapus file sementara
				if (is_file($fullPath)) { @unlink($fullPath); }
			}

			return redirect('import-ticket');
		}

		/**
		 * Normalisasi header excel -> nama kolom tabel.
		 * Header boleh: "ID Tiket" / "idtiket" / "IdTiket" dst.
		 */
		private function buildHeaderMap($headerRow)
		{
			// Kolom tabel yang valid (harus sama dengan struktur tabel Anda)
			$valid = [
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
			];

			// Pemetaan alias umum -> kolom tabel (kalau header file beda penulisan)
			$aliases = [
				'id tiket' => 'idtiket',
				'id pelanggan' => 'idpelanggan',
				'id insiden' => 'idinsiden',
				'nama pelanggan' => 'namapelanggan',
				'sid baru' => 'sidbaru',
				'sid lama' => 'sidlama',
				'id pln' => 'idpln',
				'nama kelompok' => 'namakelompok',
				'nama kondisi' => 'namakondisi',
				'nama sbu' => 'namasbu',
				'nama kp' => 'namakp',
				'telepon pelanggan' => 'telepon',
				'nama pelapor' => 'namapelapor',
				'isi laporan' => 'isilaporan',
				'posisi tiket' => 'posisitiket',
				'id olt' => 'idolt',
				'brand olt' => 'brandolt',
				'id splitter' => 'idsplitter',
				'penyebab detail' => 'penyebabdetail',
				'namamitra/pihak ketiga' => 'namamitra',
				'petugas lapangan' => 'petugaslapangan',
				'tipe tiket' => 'tipetiket',
				'laporan berulang' => 'laporanberulang',
				'gangguan ke' => 'gangguanke',
				'nama sumber' => 'namasumber',
				'segmen icon' => 'segmenicon',
				'waktu lapor' => 'waktulapor',
				'waktu laporan selesai' => 'waktulaporanselesai',
				'durasi laporan' => 'durasilaporan',
				'durasi laporan (menit)' => 'durasilaporanmenit',
				'waktu gangguan selesai' => 'waktugangguanselesai',
				'durasi gangguan' => 'durasigangguan',
				'durasi gangguan (menit)' => 'durasigangguanmenit',
				'durasi stopclock' => 'durasistopclock',
				'durasi gangguan minus stopclock' => 'durasigangguaminusstopclock',
				'end customer' => 'endcustomer',
				'durasi stopclock pelanggan' => 'durasistopclockpelanggan',
				'durasi gangguan minus stopclock pelanggan' => 'durasigangguanminusstopclockpelanggan',
				'keterangan close' => 'keteranganclose',
				'segmen pelanggan' => 'segmenpelanggan',
				'last komen' => 'lastkomen',
				'lat/long pelanggan' => 'latlongpelanggan',
				'provinsi pelanggan' => 'provinsipelanggan',
				'kabupaten pelanggan' => 'kabupatenpelanggan',
				'kecamatan pelanggan' => 'kecamatanpelanggan',
				'kelurahan pelanggan' => 'kelurahanpelanggan',
				'lat/long splitter' => 'latlongsplitter',
				'provinsi splitter' => 'provinsisplitter',
				'kabupaten splitter' => 'kabupatensplitter',
				'kecamatan splitter' => 'kecamatansplitter',
				'kelurahan splitter' => 'kelurahansplitter',
				'tanggal insiden' => 'tanggalinsiden',
				'tanggal send noc' => 'tanggalsendnoc',
			];

			$map = []; // 'A' => 'idtiket', dst.
			foreach ($headerRow as $col => $label) {
				$norm = $this->normalize($label);
				$target = $aliases[$norm] ?? $norm;
				if (in_array($target, $valid, true)) {
					$map[$col] = $target;
				}
			}

			if (empty($map) || !in_array('idtiket', $map, true)) {
				throw new Exception('Header tidak dikenali atau kolom "idtiket" tidak ditemukan.');
			}
			return $map;
		}

		private function normalize($s)
		{
			$s = strtolower(trim((string)$s));
			$s = preg_replace('/\s+/', ' ', $s);
			return $s;
		}

		private function mapRowToRecord($row, $headerMap)
		{
			$rec = [];
			foreach ($headerMap as $col => $dbCol) {
				$val = isset($row[$col]) ? trim((string)$row[$col]) : null;

				// Khusus kolom waktu -> konversi ke DATETIME (YYYY-mm-dd HH:ii:ss)
				if (in_array($dbCol, [
					'waktugangguan','waktulapor','waktulaporanselesai',
					'waktugangguanselesai','tanggalinsiden','tanggalsendnoc'
				], true)) {
					$rec[$dbCol] = $this->toDatetime($val);
				}
				// Kolom menit -> integer
				elseif (in_array($dbCol, ['durasilaporanmenit','durasigangguanmenit'], true)) {
					$rec[$dbCol] = ($val === '' ? null : (int)preg_replace('/\D+/', '', $val));
				}
				// idpln hex (contoh: 0x0200...) -> simpan apa adanya ke varchar/varbinary (tabel Anda varbinary)
				elseif ($dbCol === 'idpln') {
					$rec[$dbCol] = $val;
				}
				else {
					$rec[$dbCol] = ($val === '' ? null : $val);
				}
			}
			return $rec;
		}

		/**
		 * Menerima:
		 * - Excel date serial (numeric)
		 * - String: "29/07/25 14.59" atau "29/07/2025 14:59" atau "2025-07-29 14:59"
		 */
		private function toDatetime($v)
		{
			if ($v === null || $v === '') return null;

			// Numeric (Excel serial)
			if (is_numeric($v)) {
				// Konversi Excel serial ke DateTime (1900-based)
				$unix = ($v - 25569) * 86400; // 25569 = 1970-01-01
				return gmdate('Y-m-d H:i:s', (int)$unix);
			}

			$s = trim((string)$v);

			// 29/07/25 14.59 -> ganti titik jadi titik dua
			$s = preg_replace('/(\d{1,2})\.(\d{2})(?=$)/', '$1:$2', $s);

			// Coba beberapa format
			$fmts = [
				'd/m/y H:i', 'd/m/Y H:i', 'd-m-y H:i', 'd-m-Y H:i',
				'Y-m-d H:i', 'Y-m-d H:i:s', 'd/m/y H:i:s', 'd/m/Y H:i:s'
			];
			foreach ($fmts as $f) {
				$dt = DateTime::createFromFormat($f, $s);
				if ($dt) return $dt->format('Y-m-d H:i:s');
			}

			// Fallback: strtotime
			$ts = strtotime($s);
			return $ts ? date('Y-m-d H:i:s', $ts) : null;
		}
	}