<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardNoc extends CI_Controller {

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
		$q['total'] = $this->db->query("SELECT COUNT(idTiket) as total FROM tiket; ")->result();
		$q['close'] = $this->db->query("SELECT COUNT(idTiket) as close FROM tiket WHERE status='CLOSED'")->result();
		$q['olt'] = $this->db->query("SELECT COUNT(idOlt) as olt FROM olt")->result();
		$this->db->select('kabupaten, COUNT(*) as count');
        $this->db->from('tiket');
        $this->db->join('olt', 'olt.idOlt = tiket.idOlt', 'left');
        $this->db->group_by('kabupaten');
        $this->db->order_by('count', 'DESC');
        $query = $this->db->get();
        $q['data'] = $query->result_array();

		$this->db->select('tim, COUNT(*) as count');
        $this->db->from('tiket');
        $this->db->join('olt', 'olt.idOlt = tiket.idOlt', 'left');
        $this->db->group_by('tim');
        $this->db->order_by('count', 'DESC');
        $query = $this->db->get();
        $q['tim'] = $query->result_array();
		$q['total_tim'] = $this->db->query("SELECT COUNT(*) as total_tim FROM tim")->result();
		$q['sla'] = $this->db->query("SELECT COUNT(*) AS sla FROM tiket WHERE DATEDIFF(CURDATE(), STR_TO_DATE(tanggal, '%Y-%m-%d')) > 2;")->result();

		$this->load->view('navbar');
		$this->load->view('dashboardNoc', $q);
	}
}
