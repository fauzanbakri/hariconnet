<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Material_model');
	}

	/**
	 * Resolve pemakaian table name variants
	 */
	private function get_pemakaian_table()
	{
		$candidates = [
			'pemakaian_material',
			'pemakaianMaterial',
			'pemakaianmaterial',
			'pemakaian_materials',
			'pemakaianmaterials'
		];
		foreach ($candidates as $t) {
			if ($this->db->table_exists($t)) return $t;
		}
		return false;
	}

	/**
	 * Display material list with filters
	 */
	public function index()
	{
		$title['title'] = "Input Material";
		session_start();

		// Check user role
		if(
			$_SESSION['role']=='Superadmin' ||
			$_SESSION['role']=='Team Leader'
		){
			// Get materials with filters
			$start_date = $this->input->get('start_date');
			$end_date = $this->input->get('end_date');
			$filter_tim = $this->input->get('filter_tim');
			$filter_kategori = $this->input->get('kategori');
			$status_reservasi = $this->input->get('status_reservasi');
			$status_terpakai = $this->input->get('status_terpakai');
			$status_pengiriman = $this->input->get('status_pengiriman');

			// Allow empty dates; only apply filters when any filter present
			if ($start_date || $end_date || $status_reservasi || $status_terpakai || $status_pengiriman || $filter_tim || $filter_kategori) {
				$data['materials'] = $this->Material_model->get_materials_filtered($start_date, $end_date, $status_reservasi, $status_terpakai, $status_pengiriman, $filter_tim, $filter_kategori);
			} else {
				$data['materials'] = $this->Material_model->get_all_materials();
			}

			// load basecamp list for selection
			$data['basecamps'] = [];
			if ($this->db->table_exists('basecamp')) {
				$this->db->select('idBc, namaAkun, sloc');
				$this->db->from('basecamp');
				$this->db->order_by('namaAkun','ASC');
				$data['basecamps'] = $this->db->get()->result();
			}
			// load kode_material lookup for descriptions
			if ($this->db->table_exists('kode_material')) {
				$this->db->select('kode_material, deskripsi_material');
				$data['kode_materials'] = $this->db->from('kode_material')->order_by('kode_material','ASC')->get()->result();
			} else {
				$data['kode_materials'] = [];
			}
			$data['status_reservasi_list'] = ['Sudah', 'Belum'];
			$data['status_terpakai_list'] = $this->Material_model->get_status_terpakai();
			$data['status_pengiriman_list'] = ['Dalam Pengiriman', 'On Loc'];

			// compute total used qty per material from pemakaian table if exists
			$data['used_sums'] = [];
			$ptable = $this->get_pemakaian_table();
			if ($ptable) {
				$this->db->select('idMaterial, SUM(qty) as used');
				$this->db->from($ptable);
				$this->db->group_by('idMaterial');
				$rows = $this->db->get()->result();
				foreach ($rows as $r) {
					$data['used_sums'][$r->idMaterial] = (int)$r->used;
				}
			}

			$this->load->view('navbar', $title);
			$this->load->view('material', $data);
		} else {
			header('location: ./DashboardNoc');
		}
	}

	/**
	 * Insert new material
	 */
	public function insertData()
	{
		date_default_timezone_set('Asia/Makassar');
		session_start();

		$tanggal = $this->input->post('tanggal');
		// incident removed from material table schema
		$tanggal = $this->input->post('tanggal');
		$kategori = $this->input->post('kategori');
		$tipeMaterial = $this->input->post('tipeMaterial');
		$kode_material = $this->input->post('kode_material');
		$sn = $this->input->post('sn');
		$sn_terpakai = $this->input->post('sn_terpakai');
		$kode_material_terpakai = $this->input->post('kode_material_terpakai');
		$merk = $this->input->post('merk');
		$idBc = $this->input->post('idBc');
		$satuan = $this->input->post('satuan');
		$qty = $this->input->post('qty');
		$status_reservasi = $this->input->post('status_reservasi');
		$status_terpakai = $this->input->post('status_terpakai');
		$status_pengiriman = $this->input->post('status_pengiriman');
		$ket = $this->input->post('ket');
		// new fields
		$no_reservasi = $this->input->post('no_reservasi');
		$no_gi = $this->input->post('no_gi');
		// new fields
		$no_reservasi = $this->input->post('no_reservasi');
		$no_gi = $this->input->post('no_gi');

		// Validation
		if($kode_material != '' && $sn != '' && $merk != '' && $kategori != '' && $idBc != '' && $status_reservasi != '' && $status_pengiriman != '' && $tanggal != '' && $satuan != '' && $qty != ''){
				$data = array(
				'tipeMaterial' => $tipeMaterial,
				'tanggal' => $tanggal,
				'kategori' => $kategori,
				'kode_material' => $kode_material,
				'sn' => $sn,
				'sn_terpakai' => $sn_terpakai,
				'kode_material_terpakai' => $kode_material_terpakai,
				'merk' => $merk,
				'idBc' => $idBc,
				'satuan' => $satuan,
				'qty' => $qty,
				'status_reservasi' => $status_reservasi,
				'status_terpakai' => $status_terpakai,
				'status_pengiriman' => $status_pengiriman,
				'ket' => $ket
			);
			if ($no_reservasi !== null) $data['no_reservasi'] = $no_reservasi;
			if ($no_gi !== null) $data['no_gi'] = $no_gi;
			// include new fields only if provided (model will filter by actual table fields)
			if ($no_reservasi !== null) $data['no_reservasi'] = $no_reservasi;
			if ($no_gi !== null) $data['no_gi'] = $no_gi;

			if ($this->Material_model->insert_material($data)) {
				echo 'success';
			} else {
				echo 'Gagal menambahkan material';
			}
		} else {
			echo 'Harap isi semua field yang wajib';
		}
	}

	/**
	 * Insert multiple materials using a list of SNs (one SN per item).
	 * Expects POST: kode_material, sn_list (JSON array or newline-separated), merk, kategori, idBc, satuan, status_reservasi, status_pengiriman, tanggal, tipeMaterial (optional), no_reservasi/no_gi (optional), ket (optional)
	 */
	public function insertMultipleData()
	{
		date_default_timezone_set('Asia/Makassar');
		session_start();

		$kode_material = $this->input->post('kode_material');
		$sn_list_raw = $this->input->post('sn_list');
		$merk = $this->input->post('merk');
		$kategori = $this->input->post('kategori');
		$idBc = $this->input->post('idBc');
		$satuan = $this->input->post('satuan');
		$status_reservasi = $this->input->post('status_reservasi');
		$status_pengiriman = $this->input->post('status_pengiriman');
		$tanggal = $this->input->post('tanggal');
		$tipeMaterial = $this->input->post('tipeMaterial');
		$no_reservasi = $this->input->post('no_reservasi');
		$no_gi = $this->input->post('no_gi');
		$ket = $this->input->post('ket');

		if (!$kode_material || !$merk || !$kategori || !$idBc || !$satuan || !$status_reservasi || !$status_pengiriman || !$tanggal) {
			echo json_encode(['status' => 'error', 'message' => 'Missing required fields for multiple insert']);
			return;
		}

		$sn_items = [];
		// accept JSON array or newline/comma/semicolon separated string
		if ($sn_list_raw) {
			// try json decode
			$json = json_decode($sn_list_raw, true);
			if (is_array($json)) {
				foreach ($json as $s) { $s = trim($s); if ($s !== '') $sn_items[] = $s; }
			} else {
				// split by newline, comma, semicolon
				$parts = preg_split('/[\r\n,;]+/', $sn_list_raw);
				foreach ($parts as $p) { $p = trim($p); if ($p !== '') $sn_items[] = $p; }
			}
		}

		if (empty($sn_items)) {
			echo json_encode(['status' => 'error', 'message' => 'No SN provided']);
			return;
		}

		$inserted = 0;
		foreach ($sn_items as $sn) {
			$data = [
				'tipeMaterial' => $tipeMaterial,
				'tanggal' => $tanggal,
				'kategori' => $kategori,
				'kode_material' => $kode_material,
				'sn' => $sn,
				'merk' => $merk,
				'idBc' => $idBc,
				// per-SN item, set qty = 1
				'satuan' => $satuan,
				'qty' => 1,
				'status_reservasi' => $status_reservasi,
				'status_pengiriman' => $status_pengiriman,
				'ket' => $ket
			];
			if ($no_reservasi !== null) $data['no_reservasi'] = $no_reservasi;
			if ($no_gi !== null) $data['no_gi'] = $no_gi;

			// use model to insert (it will filter fields)
			if ($this->Material_model->insert_material($data)) {
				$inserted++;
			}
		}

		if ($inserted > 0) {
			echo json_encode(['status' => 'success', 'inserted_count' => $inserted]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to insert items']);
		}
	}

	/**
	 * Get material data for edit
	 */
	public function getData()
	{
		$idmaterial = $this->input->get('id');
		$material = $this->Material_model->get_material_by_id($idmaterial);
		echo json_encode($material);
	}

	/**
	 * Update material
	 */
	public function editData()
	{
		date_default_timezone_set('Asia/Makassar');
		session_start();

		$idmaterial = $this->input->post('idmaterial');
		$tanggal = $this->input->post('tanggal');
		// incident removed from material table schema
		$tanggal = $this->input->post('tanggal');
		$kategori = $this->input->post('kategori');
		$tipeMaterial = $this->input->post('editTipeMaterial');
		$kode_material = $this->input->post('kode_material');
		$sn = $this->input->post('sn');
		$sn_terpakai = $this->input->post('sn_terpakai');
		$kode_material_terpakai = $this->input->post('kode_material_terpakai');
		$merk = $this->input->post('merk');
		$idBc = $this->input->post('idBc');
		$satuan = $this->input->post('satuan');
		$qty = $this->input->post('qty');
		$status_reservasi = $this->input->post('status_reservasi');
		$status_terpakai = $this->input->post('status_terpakai');
		$status_pengiriman = $this->input->post('status_pengiriman');
		$ket = $this->input->post('ket');

		// Validation
		if($kode_material != '' && $sn != '' && $merk != '' && $kategori != '' && $idBc != '' && $status_reservasi != '' && $status_pengiriman != '' && $tanggal != '' && $satuan != '' && $qty != ''){
				$data = array(
				'tipeMaterial' => $tipeMaterial,
				'tanggal' => $tanggal,
				'kategori' => $kategori,
				'kode_material' => $kode_material,
				'sn' => $sn,
				'sn_terpakai' => $sn_terpakai,
				'kode_material_terpakai' => $kode_material_terpakai,
				'merk' => $merk,
				'idBc' => $idBc,
				'satuan' => $satuan,
				'qty' => $qty,
				'status_reservasi' => $status_reservasi,
				'status_terpakai' => $status_terpakai,
				'status_pengiriman' => $status_pengiriman,
				'ket' => $ket
			);

			if ($this->Material_model->update_material($idmaterial, $data)) {
				echo 'success';
			} else {
				echo 'Gagal memperbarui material';
			}
		} else {
			echo 'Harap isi semua field yang wajib';
		}
	}

	/**
	 * Delete material
	 */
	public function deleteRow()
	{
		$idmaterial = $this->input->get('id');

		if ($this->Material_model->delete_material($idmaterial)) {
			echo 'success';
		} else {
			echo 'Gagal menghapus material';
		}
	}

	/**
	 * Get kode material detail from kode_material table
	 */
	public function getKodeMaterialDetail()
	{
		$kode = $this->input->get('kode');
		$this->db->select('kode_material, deskripsi_material, kategori');
		$this->db->from('kode_material');
		$this->db->where('kode_material', $kode);
		$result = $this->db->get()->row();
		echo json_encode($result);
	}

	/**
	 * Tandai material terpakai (AJAX)
	 */
	public function tandai_terpakai()
	{
		$idmaterial = $this->input->post('idmaterial');
		$kode_material_terpakai = $this->input->post('kode_material_terpakai');
		$sn_terpakai = $this->input->post('sn_terpakai');

		if (!$idmaterial) {
			echo json_encode(['status' => 'error', 'message' => 'ID material tidak valid']);
			return;
		}

		$data = [
			'kode_material_terpakai' => $kode_material_terpakai,
			'sn_terpakai' => $sn_terpakai,
			'status_terpakai' => 'Sudah'
		];

		if ($this->Material_model->update_material($idmaterial, $data)) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui material']);
		}
	}
}
