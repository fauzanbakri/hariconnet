<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListOlt extends CI_Controller {
	public function index()
	{
		$q['olt'] = $this->db->query("SELECT * FROM olt")->result();
		$q['tim'] = $this->db->query("SELECT * FROM tim")->result();
		session_start();
		if(
			$_SESSION['role']=='Superadmin' || 
			$_SESSION['role']=='NOC Ritel' || 
			$_SESSION['role']=='Team Leader' || 
			$_SESSION['role']=='Pemeliharaan Ritel'
			){
				$this->load->view('navbar');
				$this->load->view('listOlt', $q);
		}else{
			header('location: ./DashboardNoc');
		}
		
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
		$hostname = $this->input->post('hostname');
		$upe = $this->input->post('upe');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$tim = $this->input->post('tim');
		$prov = $this->input->post('prov');
		$kabupaten = $this->input->post('kabupaten');
		$kecamatan = $this->input->post('kecamatan');
		$kelurahan = $this->input->post('kelurahan');
		if($hostname!=''){
			$q = $this->db->query("INSERT INTO 
			olt(
			idOlt,
			lat,
			longi,
			upe,
			serpo,
			kelurahan,
			kecamatan,
			kabupaten,
			provinsi
			) 
			VALUES(
				'$hostname',
				'$latitude',
				'$longitude',
				'$upe',
				'$tim',
				'$kelurahan',
				'$kecamatan',
				'$kabupaten',
				'$prov'
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
		$hostname = $this->input->post('hostname');
		$upe = $this->input->post('upe');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$tim = $this->input->post('tim');
		$prov = $this->input->post('prov');
		$kabupaten = $this->input->post('kabupaten');
		$kecamatan = $this->input->post('kecamatan');
		$kelurahan = $this->input->post('kelurahan');
		if($hostname!=''){
			$q = $this->db->query("UPDATE olt SET
				lat='$latitude',
				longi='$longitude',
				upe='$upe',
				serpo='$tim',
				kelurahan='$kelurahan',
				kecamatan='$kecamatan',
				kabupaten='$kabupaten',
				provinsi='$prov'
				WHERE idOlt='$hostname'
				");
			if($q){
				echo 'success';
			}else{
				$error = $this->db->error();
				echo $error['message'];
			}	
		}else{
			echo 'Hostname Cannot Empty';
		}
			
	}
}
