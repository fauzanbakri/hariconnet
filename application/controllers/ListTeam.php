<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListTeam extends CI_Controller {

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
		$q['tim'] = $this->db->query("
		SELECT * FROM tim")->result();
		// $q['olt'] = $this->db->query("
		// SELECT * FROM tim")->result();
		session_start();
		if(
			$_SESSION['role']=='Superadmin' || 
			$_SESSION['role']=='NOC Ritel' || 
			$_SESSION['role']=='Team Leader' || 
			$_SESSION['role']=='Pemeliharaan Ritel'
			){
				$this->load->view('navbar');
				$this->load->view('listTeam', $q);
		}else{
			header('location: ./DashboardNoc');
		}
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
		if ($this->db->delete('tim', ['idTim' => $idTiket])) {
			echo true;
		} else {
			echo false;
		}
	}
	public function insertData(){
		// date_default_timezone_set('Asia/Makassar');
		// session_start();
		$namatim = $this->input->post('namatim');
		$lat = $this->input->post('lat');
		$longi = $this->input->post('longi');
		$chatid = $this->input->post('chatid');
		$segmen = $this->input->post('segmen');
		if($namatim!=''){
			$q = $this->db->query("INSERT INTO 
			tim(
			nama,
			lat,
			longi,
			segmen,
			chatId
			) 
			VALUES(
				'$namatim',
				'$lat',
				'$longi',
				'$segmen',
				'$chatid'
				)");
			if($q){
				echo 'success';
			}else{
				$error = $this->db->error();
				echo $error['message'];
			}	
		}else{
			echo 'Nama Tim Cannot Empty';
		}
	
	}

	public function editData(){
		// date_default_timezone_set('Asia/Makassar');
		// session_start();
		$id = $this->input->post('idtim');
		$namatim = $this->input->post('namatim');
		$lat = $this->input->post('lat');
		$longi = $this->input->post('longi');
		$chatid = $this->input->post('chatid');
		$segmen = $this->input->post('segmen');
		if($namatim!=''){
			$q = $this->db->query("UPDATE tim SET
				nama='$namatim',
				lat='$lat',
				longi='$longi',
				segmen='$segmen',
				chatId='$chatid'
				WHERE idTim='$id'
				");
			if($q){
				echo 'success';
			}else{
				$error = $this->db->error();
				echo $error['message'];
			}	
		}else{
			echo 'Nama Tim Cannot Empty';
		}
			
	}
}
