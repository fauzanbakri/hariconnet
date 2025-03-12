<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChangePass extends CI_Controller {
	public function index()
	{
		$title['title']="Change Password";
		session_start();
		$this->load->view('navbar',$title);
		$this->load->view('changePass');
	}
	public function change()
	{
		session_start();
		$oldPass = $this->input->post('oldPass');
		$newPass = $this->input->post('newPass');
		$idUser = $_SESSION['idUser'];
		$q = $this->db->query("SELECT * FROM user WHERE idUser='$idUser' AND password='$oldPass'");
		if($q->num_rows()>0){
			$n = $this->db->query("UPDATE user SET password='$newPass' WHERE idUser='$idUser'");
			if($n){
				echo 'success';
			}else{
				echo 'Faied';
			}
		}else{
			echo 'Wrong Password';
		}
	}
	
}
