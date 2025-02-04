<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListOlt extends CI_Controller {
	public function index()
	{
		$q['olt'] = $this->db->query("SELECT * FROM olt")->result();
		$q['tim'] = $this->db->query("SELECT * FROM tim")->result();
		$this->load->view('navbar');
		$this->load->view('listOlt', $q);
	}
	public function deleteRow()
	{
		$idTiket = $this->input->get('id');
		if ($this->db->delete('olt', ['idOlt' => $idTiket])) {
			echo true;
		} else {
			echo false;
		}
	}
	public function insertData(){
		date_default_timezone_set('Asia/Makassar');
		session_start();
		$idInsiden = $this->input->post('incident');
		$rawtanggal = $this->input->post('downtime');
		$timestamps = strtotime(str_replace('/', '-', $rawtanggal));
		$downtime = date('Y-m-d H:i', $timestamps);
		$tipe = $this->input->post('tipe');
		$kp = $this->input->post('kp');
		$olt = $this->input->post('olt');
		$area = $this->input->post('area');
		$deskripsi = $this->input->post('deskripsi');
		$tim = $this->input->post('tim');
		// $gangguan = $this->input->post('status');
		$jumlahtiket = $this->input->post('jumlahtiket');
		$tipePenyebab = $this->input->post('tipePenyebab');
		$keterangan = $this->input->post('keterangan');
		$status = $this->input->post('status');
		$createby = $_SESSION['nama'];
		$timestamp = date("Y-m-d H:i:s");
		// die();
		if($deskripsi!=''){
			$q = $this->db->query("INSERT INTO 
			feeder(
			idInsiden,
			downtime,
			tipe,
			kp,
			kode,
			idOlt,
			gangguan,
			tim,
			status,
			keterangan,
			jumlahTiket,
			tipePenyebab,
			createby,
			timestamp
			) 
			VALUES(
				'$idInsiden',
				'$downtime',
				'$tipe',
				'$kp',
				'$area',
				'$olt',
				'$deskripsi',
				'$tim',
				'$status',
				'$keterangan',
				'$jumlahtiket',
				'$tipePenyebab',
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
			echo 'Deskripsi Cannot Empty';
		}
	
	}

	public function editData(){
		date_default_timezone_set('Asia/Makassar');
		session_start();
		$id = $this->input->post('id');
		$idInsiden = $this->input->post('incident');
		$rawtanggal = $this->input->post('downtime');
		$timestamp = strtotime(str_replace('/', '-', $rawtanggal));
		$downtime = date('Y-m-d H:i', $timestamp);
		$tipe = $this->input->post('tipe');
		$kp = $this->input->post('kp');
		$olt = $this->input->post('olt');
		$area = $this->input->post('area');
		$deskripsi = $this->input->post('deskripsi');
		$tim = $this->input->post('tim');
		$status = $this->input->post('status');
		$jumlahtiket = $this->input->post('jumlahtiket');
		$tipepenyebab = $this->input->post('tipePenyebab');
		$keterangan = $this->input->post('keterangan');
		$createby = $_SESSION['nama'];
		$timestamps = date("Y-m-d H:i:s");
		if($deskripsi!=''){
			$q = $this->db->query("UPDATE feeder SET
				idInsiden='$idInsiden',
				downtime='$downtime',
				tipe='$tipe',
				kp='$kp',
				kode='$area',
				gangguan='$deskripsi',
				tim='$tim',
				status='$status',
				jumlahTiket='$jumlahtiket',
				tipePenyebab='$tipepenyebab',
				keterangan='$keterangan',
				createby='$createby',
				timestamp='$timestamps'
				WHERE id='$id'
				");
			if($q){
				echo 'success';
			}else{
				$error = $this->db->error();
				echo $error['message'];
			}	
		}else{
			echo 'Deskripsi Cannot Empty';
		}
			
	}
}
