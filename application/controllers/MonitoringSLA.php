<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringSLA extends CI_Controller {
	public function index()
	{
		$title['title']="Monitoring SLA";
		session_start();
		$this->load->view('navbar',$title);
		$this->load->view('monitoringSLA');
	}
}
