<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EditTicket extends CI_Controller {
	public function index()
	{
		$data['id'] = $this->input->get('id'); 
		$this->load->view('navbar');
		$this->load->view('editTicket', $data);
	}
}
