<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feeder extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$q['data'] = $this->db->query("
			SELECT * FROM feeder")->result();
		$q['tim'] = $this->db->query("
		SELECT * FROM tim")->result();
		$q['olt'] = $this->db->query("
		SELECT * FROM olt")->result();
		$this->load->view('navbar');
		$this->load->view('feeder', $q);
	}
	public function autoArea(){
		$olt = $this->input->get('area');
		$q = $this->db->query("SELECT idOlt, kode FROM olt LEFT JOIN area ON olt.kabupaten = area.kabupaten WHERE idOlt='$olt'")->result();
		foreach($q as $row){
			echo $row->kode;
		}
	}
	public function deleteRow()
	{
		$idTiket = $this->input->get('id');
		if ($this->db->delete('feeder', ['id' => $idTiket])) {
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
		$timestamp = strtotime(str_replace('/', '-', $rawtanggal));
		$tanggal = date('Y-m-d H:i', $timestamp);
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
	public function changeShift(){
		$data = $this->db->query("SELECT * FROM tiket WHERE status='close'")->result();
		$this->db->trans_start();
		foreach ($data as $row){
			$idTiket = $row->idTiket;
			$idInsiden = $row->idInsiden;
			$tanggal = $row->tanggal;
			$sid = $row->sid;
			$telepon = $row->telepon;
			$nama = $row->nama;
			$keluhan = $row->keluhan;
			$alamat = $row->alamat;
			$idOlt = $row->idOlt;
			$sn = $row->sn;
			$tim = $row->tim;
			$keterangan = $row->keterangan;
			$status = $row->status;
			$prioritas = $row->prioritas;
			$createby = $row->createby;

			$this->db->query("INSERT INTO tiketClose VALUES(
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
			'$createby'
			)");
			// echo $row->idTiket;
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}
		else{
			$this->db->trans_commit();
			$data = $this->db->query("SELECT * FROM tiket WHERE status='close'")->result();
			$this->db->trans_start();
			foreach ($data as $row){
				$idTiket = $row->idTiket;
				$this->db->query("DELETE FROM tiket WHERE idTiket='$idTiket'");
			}
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
			}
			else{
				$this->db->trans_commit();
				echo 'success';
			}
		}
	}
}
