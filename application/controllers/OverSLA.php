<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OverSLA extends CI_Controller {
	public function index()
	{
		$title['title']="Ticket Over SLA";
		$q['data'] = $this->db->query("SELECT * FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt  WHERE status!='CLOSED' AND DATEDIFF(CURDATE(), STR_TO_DATE(tanggal, '%Y-%m-%d')) > 2 ORDER BY tanggal ASC")->result();
		session_start();
		$this->load->view('navbar',$title);
		$this->load->view('overSLA', $q);
	}
}
