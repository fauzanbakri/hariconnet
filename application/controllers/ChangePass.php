<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChangePass extends CI_Controller {
	public function index()
	{
		session_start();
		$this->load->view('navbar');
		$this->load->view('changePass');
	}
}
