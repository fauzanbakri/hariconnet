<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TicketClose extends CI_Controller {
	public function index()
	{
		$q['data'] = $this->db->query("
			SELECT 
			prioritas,
			idInsiden,
			idTiket,
			tanggal,
			olt.idOlt,
			sid,
			nama,
			alamat,
			telepon,
			sn,
			status,
			keluhan,
			keterangan,
			kabupaten,
			provinsi,
			tim,
			createby
		FROM 
			tiketClose
		LEFT JOIN 
			olt ON olt.idOlt = tiketClose.idOlt
		")->result();
		$q['olt'] = $this->db->query("SELECT * FROM olt")->result();
		session_start();
		if(
			$_SESSION['role']=='Superadmin' ||
			$_SESSION['role']=='NOC Ritel' ||
			$_SESSION['role']=='Team Leader'
			){
				$this->load->view('navbar');
				$this->load->view('ticketClose', $q);
		}else{
			header('location: ./DashboardNoc');
		}
	}
	public function autoTim(){
		$olt = $this->input->get('olt');
		$q = $this->db->query("SELECT * FROM olt where idOlt='$olt'")->result();
		foreach($q as $row){
			echo $row->serpo;
		}
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
	public function editData(){
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
		$status = $this->input->post('status');
		$prioritas = $this->input->post('prioritas');
		$createby = $_SESSION['nama'];
		$timestamp = date("Y-m-d H:i:s");
		// die();
		if($idTiket!=''){
			$q = $this->db->query("UPDATE tiket SET
				idInsiden='$idInsiden',
				tanggal='$tanggal',
				sid='$sid',
				telepon='$telepon',
				nama='$nama',
				keluhan='$keluhan',
				alamat='$alamat',
				idOlt='$idOlt',
				sn='$sn',
				tim='$tim',
				keterangan='$keterangan',
				status='$status',
				prioritas='$prioritas',
				createby='$createby',
				timestamp='$timestamp'
				WHERE idTiket='$idTiket'
				");
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
		$data = $this->db->query("SELECT * FROM tiket WHERE status='closed'")->result();
		$data2 = $this->db->query("SELECT * FROM feeder WHERE status='closed'")->result();
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
			'',
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
		foreach ($data2 as $row){
			$id = $row->id;
			$idInsiden = $row->idInsiden;
			$downtime = $row->downtime;
			$tipe = $row->tipe;
			$kp = $row->kp;
			$kode = $row->kode;
			$idOlt = $row->idOlt;
			$gangguan = $row->gangguan;
			$tim = $row->tim;
			$status = $row->status;
			$keterangan = $row->keterangan;
			$jumlahTiket = $row->jumlahTiket;
			$tipePenyebab = $row->tipePenyebab;
			$createby = $row->createby;
			$timestamp = $row->timestamp;
			$this->db->query("INSERT INTO feederClose VALUES(
			'$idTiket',
			'$idInsiden',
			'$downtime',
			'$tipe',
			'$kp',
			'$kode',
			'$idOlt',
			'$gangguan',
			'$tim',
			'$status',
			'$keterangan',
			'$jumlahTiket',
			'$tipePenyebab',
			'$createby',
			'$timestamp'
			)");
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}
		else{
			$this->db->trans_commit();
			$data = $this->db->query("SELECT * FROM tiket WHERE status='closed'")->result();
			$data2 = $this->db->query("SELECT * FROM feeder WHERE status='closed'")->result();
			$this->db->trans_start();
			foreach ($data as $row){
				$idTiket = $row->idTiket;
				$this->db->query("DELETE FROM tiket WHERE idTiket='$idTiket'");
			}
			foreach ($data2 as $row){
				$id = $row->id;
				$this->db->query("DELETE FROM feeder WHERE id='$id'");
			}
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
			}
			else{
				$this->db->trans_commit();
				$this->db->query("UPDATE tiket SET status='OPEN' WHERE status='NEW'");
				echo 'success';
			}
		}
	}
}
