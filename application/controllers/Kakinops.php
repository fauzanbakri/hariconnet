<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kakinops extends CI_Controller {
	public function index()
	{
		$title['title']="Kakin Ops";
		$q['data'] = $this->db->query("
			SELECT * FROM kakin;
		")->result();
		$q['olt'] = $this->db->query("SELECT * FROM olt")->result();
		session_start();
		if(
			$_SESSION['role']=='Superadmin' || 
			$_SESSION['role']=='CusEx' || 
			$_SESSION['role']=='Team Leader' || 
			$_SESSION['role']=='Pemeliharaan Ritel'			
			){
				$this->load->view('navbar', $title);
				$this->load->view('kakinops', $q);
		}else{
			header('location: ./DashboardNoc');
		}
	}
	public function deleteRow()
	{
		$id = $this->input->get('id');
		if ($this->db->delete('kakin', ['id' => $id])) {
			echo true;
		} else {
			echo false;
		}
	}
	public function insertData(){
		date_default_timezone_set('Asia/Makassar');
		session_start();
		function cleanInput($input) {
			return str_replace(['"', "'"], '', $input);
		}

		$tanggal = cleanInput($this->input->post('tanggal'));
		$nama = $this->input->post('nama');
		$progress = cleanInput($this->input->post('progress'));
		$jabatan = cleanInput($this->input->post('jabatan'));
		$area = cleanInput($this->input->post('area'));
		$olt = cleanInput($this->input->post('olt'));
		$idname = cleanInput($this->input->post('idname'));
		$status = cleanInput($this->input->post('status'));
		echo $tanggal.$nama.$progress.$jabatan.$area.$olt.$idname.$status;
		if($tanggal != ''){
			// Gunakan prepared statement untuk keamanan yang lebih baik
			$sql = "INSERT INTO kakin 
				(nama,tanggal,jabatan,progress,area,olt,idName,status) 
				VALUES (?,?,?,?,?,?,?,?,?,?)";
			
			$result = $this->db->query($sql, [
				$nama, $tanggal, $jabatan, $progress, $area, $olt, $idname, $status
			]);
	
			if($result){
				echo 'success';
			}else{
				$error = $this->db->error();
				echo $error['message'];
			}
		} else {
			echo 'Nama Cannot Be Empty';
		}
	}
	
	public function editData(){
		function cleanInput($input) {
			return str_replace(['"', "'"], '', $input);
		}
		date_default_timezone_set('Asia/Makassar');
		session_start();
		$id = cleanInput($this->input->post('id'));
		$tanggal = cleanInput($this->input->post('tanggal'));
		$nama = $this->input->post('nama');
		$progress = cleanInput($this->input->post('progress'));
		$jabatan = cleanInput($this->input->post('jabatan'));
		$area = cleanInput($this->input->post('area'));
		$olt = cleanInput($this->input->post('olt'));
		$idname = cleanInput($this->input->post('idname'));
		$status = cleanInput($this->input->post('status'));
		if($nama!=''){
			$q = $this->db->query("UPDATE kakin SET
				tanggal ='$tanggal',
				nama ='$nama',
				progress='$progress',
				jabatan='$jabatan',
				area='$area',
				olt='$olt',
				idname='$idname',
				status='$status'
				WHERE id='$id'
				");
			if($q){
				echo 'success';
			}else{
				$error = $this->db->error();
				echo $error['message'];
			}	
		}else{
			echo 'Nama Cannot Empty';
		}
			
	}
}
