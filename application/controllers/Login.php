<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->view('login');
	}
	public function check()
	{	
		session_start();
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$q = $this->db->query("SELECT * FROM user WHERE username='$username' AND password='$password'");
		if($q->num_rows()>0){
			$data = $q->row_array();
			// var_dump($data);
			$_SESSION['role'] = $data['role'];
			$_SESSION['nama'] = $data['nama'];
			header("location:../DashboardNoc");
		}else{
			header("location:../Login?msg=wrong");
		}
		
	}
	public function logout()
	{
		session_start();
		session_destroy();
		header("location:../Login");	
	}
}
