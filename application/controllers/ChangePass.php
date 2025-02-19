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
}
