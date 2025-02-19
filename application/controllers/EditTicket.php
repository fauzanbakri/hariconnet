<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EditTicket extends CI_Controller {
	public function index()
	{
		$title['title']="Edit Ticket";
		$data['id'] = $this->input->get('id'); 
		$this->load->view('navbar',$title);
		$this->load->view('editTicket', $data);
	}
}
