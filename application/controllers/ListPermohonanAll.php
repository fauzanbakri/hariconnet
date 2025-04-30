<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListPermohonanAll extends CI_Controller {
	public function index()
	{
		$title['title']="List Permohonan All";
		$data['data'] = $this->db->query("SELECT * FROM dismantle")->result();
		$this->load->view('navbar',$title);
		$this->load->view('listPermohonanAll', $data);
	}

	public function deleteRow()
	{
		$idTiket = $this->input->get('id');
		if ($this->db->delete('tiket', ['idTiket' => $idTiket])) {
			echo true;
		} else {
			echo false;
		}
	}
	public function insertData(){
		date_default_timezone_set('Asia/Makassar');
		session_start();
		$idTiket = $this->input->post('tiket');
		$idInsiden = $this->input->post('incident');
		$rawtanggal = $this->input->post('tanggal');
		$timestamps = strtotime(str_replace('/', '-', $rawtanggal));
		$tanggal = date('Y-m-d H:i', $timestamps);
		$sid = $this->input->post('sid');
		$telepon = $this->input->post('telepon');
		$nama = $this->input->post('nama');
		$keluhan = $this->input->post('keluhan');
		$alamat = $this->input->post('alamat');
		$idOlt = $this->input->post('olt');
		$sn = $this->input->post('sn');
		$tim = $this->input->post('tim');
		$keterangan = $this->input->post('keterangan');
		$status = 'NEW';
		$prioritas = $this->input->post('prioritas');
		$createby = $_SESSION['nama'];
		$timestamp = date("Y-m-d H:i:s");
		// die();
		if($idTiket!=''){
			$q = $this->db->query("INSERT INTO tiket VALUES(
				'$idTiket',
				'$idInsiden',
				'$tanggal',
				'$sid',
				'$telepon',
				'$nama',
				'$keluhan',
				'$alamat',
				'$idOlt',
				'$sn',
				'$tim',
				'$keterangan',
				'$status',
				'$prioritas',
				'$createby',
				'$timestamp'
				)");
			if($q){
				echo 'success';
			}else{
				$error = $this->db->error();
				echo $error['message'];
			}	
		}else{
			echo 'Tiket Cannot Empty';
		}
			
	}
}