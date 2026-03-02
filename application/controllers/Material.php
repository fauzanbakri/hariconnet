<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Material_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		session_start();
	}

	/**
	 * Display material list with filters
	 */
	public function index()
	{
		$title['title'] = "Input Material";

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
	 * Add new material
	 */
	public function add()
	{
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');
		$this->form_validation->set_rules('kode_material', 'Kode Material', 'required');
		$this->form_validation->set_rules('sn', 'SN', 'required');
		$this->form_validation->set_rules('merk', 'Merk', 'required');
		$this->form_validation->set_rules('idtim', 'Tim', 'required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'required');
		$this->form_validation->set_rules('qty', 'QTY', 'required');
		$this->form_validation->set_rules('status_reservasi', 'Status Reservasi', 'required');
		$this->form_validation->set_rules('status_pengiriman', 'Status Pengiriman', 'required');

		if ($this->form_validation->run() == FALSE) {
			$response['status'] = 'error';
			$response['message'] = validation_errors();
		} else {
			$data = array(
				'tanggal' => $this->input->post('tanggal'),
				'kategori' => $this->input->post('kategori'),
				'kode_material' => $this->input->post('kode_material'),
				'sn' => $this->input->post('sn'),
				'sn_terpakai' => $this->input->post('sn_terpakai'),
				'merk' => $this->input->post('merk'),
				'idtim' => $this->input->post('idtim'),
				'satuan' => $this->input->post('satuan'),
				'qty' => $this->input->post('qty'),
				'status_reservasi' => $this->input->post('status_reservasi'),
				'status_terpakai' => $this->input->post('status_terpakai'),
				'status_pengiriman' => $this->input->post('status_pengiriman'),
				'ket' => $this->input->post('ket')
			);

			if ($this->Material_model->insert_material($data)) {
				$response['status'] = 'success';
				$response['message'] = 'Material berhasil ditambahkan';
			} else {
				$response['status'] = 'error';
				$response['message'] = 'Gagal menambahkan material';
			}
		}

		echo json_encode($response);
	}

	/**
	 * Get material data for edit
	 */
	public function get_material($id)
	{
		$material = $this->Material_model->get_material_by_id($id);
		echo json_encode($material);
	}

	/**
	 * Update material
	 */
	public function update()
	{
		$id = $this->input->post('idmaterial');

		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');
		$this->form_validation->set_rules('kode_material', 'Kode Material', 'required');
		$this->form_validation->set_rules('sn', 'SN', 'required');
		$this->form_validation->set_rules('merk', 'Merk', 'required');
		$this->form_validation->set_rules('idtim', 'Tim', 'required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'required');
		$this->form_validation->set_rules('qty', 'QTY', 'required');
		$this->form_validation->set_rules('status_reservasi', 'Status Reservasi', 'required');
		$this->form_validation->set_rules('status_pengiriman', 'Status Pengiriman', 'required');

		if ($this->form_validation->run() == FALSE) {
			$response['status'] = 'error';
			$response['message'] = validation_errors();
		} else {
			$data = array(
				'tanggal' => $this->input->post('tanggal'),
				'kategori' => $this->input->post('kategori'),
				'kode_material' => $this->input->post('kode_material'),
				'sn' => $this->input->post('sn'),
				'sn_terpakai' => $this->input->post('sn_terpakai'),
				'merk' => $this->input->post('merk'),
				'idtim' => $this->input->post('idtim'),
				'satuan' => $this->input->post('satuan'),
				'qty' => $this->input->post('qty'),
				'status_reservasi' => $this->input->post('status_reservasi'),
				'status_terpakai' => $this->input->post('status_terpakai'),
				'status_pengiriman' => $this->input->post('status_pengiriman'),
				'ket' => $this->input->post('ket')
			);

			if ($this->Material_model->update_material($id, $data)) {
				$response['status'] = 'success';
				$response['message'] = 'Material berhasil diperbarui';
			} else {
				$response['status'] = 'error';
				$response['message'] = 'Gagal memperbarui material';
			}
		}

		echo json_encode($response);
	}

	/**
	 * Delete material
	 */
	public function delete()
	{
		$id = $this->input->post('id');

		if ($this->Material_model->delete_material($id)) {
			$response['status'] = 'success';
			$response['message'] = 'Material berhasil dihapus';
		} else {
			$response['status'] = 'error';
			$response['message'] = 'Gagal menghapus material';
		}

		echo json_encode($response);
	}
}
?>
