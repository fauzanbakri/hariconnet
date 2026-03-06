<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Material_model');
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
			$status_reservasi = $this->input->get('status_reservasi');
			$status_terpakai = $this->input->get('status_terpakai');
			$status_pengiriman = $this->input->get('status_pengiriman');

			if ($start_date || $end_date || $status_reservasi || $status_terpakai || $status_pengiriman) {
				$data['materials'] = $this->Material_model->get_materials_filtered($start_date, $end_date, $status_reservasi, $status_terpakai, $status_pengiriman);
			} else {
				$data['materials'] = $this->Material_model->get_all_materials();
			}

			$data['tims'] = $this->Material_model->get_all_tim();
			$data['status_reservasi_list'] = ['Sudah', 'Belum'];
			$data['status_terpakai_list'] = $this->Material_model->get_status_terpakai();
			$data['status_pengiriman_list'] = ['Dalam Pengiriman', 'On Loc'];

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
		$kode_material = $this->input->post('kode_material');
		$sn = $this->input->post('sn');
		$sn_terpakai = $this->input->post('sn_terpakai');
		$kode_material_terpakai = $this->input->post('kode_material_terpakai');
		$merk = $this->input->post('merk');
		$idtim = $this->input->post('idtim');
		$satuan = $this->input->post('satuan');
		$qty = $this->input->post('qty');
		$status_reservasi = $this->input->post('status_reservasi');
		$status_terpakai = $this->input->post('status_terpakai');
		$status_pengiriman = $this->input->post('status_pengiriman');
		$ket = $this->input->post('ket');

		// Validation
		if($kode_material != '' && $sn != '' && $merk != '' && $kategori != '' && $idtim != '' && $status_reservasi != '' && $status_pengiriman != '' && $tanggal != '' && $satuan != '' && $qty != ''){
				$data = array(
				'tanggal' => $tanggal,
				'kategori' => $kategori,
				'kode_material' => $kode_material,
				'sn' => $sn,
				'sn_terpakai' => $sn_terpakai,
				'kode_material_terpakai' => $kode_material_terpakai,
				'merk' => $merk,
				'idtim' => $idtim,
				'satuan' => $satuan,
				'qty' => $qty,
				'status_reservasi' => $status_reservasi,
				'status_terpakai' => $status_terpakai,
				'status_pengiriman' => $status_pengiriman,
				'ket' => $ket
			);

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
		$kode_material = $this->input->post('kode_material');
		$sn = $this->input->post('sn');
		$sn_terpakai = $this->input->post('sn_terpakai');
		$kode_material_terpakai = $this->input->post('kode_material_terpakai');
		$merk = $this->input->post('merk');
		$idtim = $this->input->post('idtim');
		$satuan = $this->input->post('satuan');
		$qty = $this->input->post('qty');
		$status_reservasi = $this->input->post('status_reservasi');
		$status_terpakai = $this->input->post('status_terpakai');
		$status_pengiriman = $this->input->post('status_pengiriman');
		$ket = $this->input->post('ket');

		// Validation
		if($kode_material != '' && $sn != '' && $merk != '' && $kategori != '' && $idtim != '' && $status_reservasi != '' && $status_pengiriman != '' && $tanggal != '' && $satuan != '' && $qty != ''){
				$data = array(
				'tanggal' => $tanggal,
				'kategori' => $kategori,
				'kode_material' => $kode_material,
				'sn' => $sn,
				'sn_terpakai' => $sn_terpakai,
				'kode_material_terpakai' => $kode_material_terpakai,
				'merk' => $merk,
				'idtim' => $idtim,
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
