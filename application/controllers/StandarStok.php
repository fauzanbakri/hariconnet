<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StandarStok extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        $title['title'] = "Standar Stok";

        // Fetch rows from standarStok table (assumes table exists)
        $data['rows'] = [];
        if ($this->db->table_exists('standarStok')) {
            $this->db->order_by('idStandarStok', 'DESC');
            $data['rows'] = $this->db->get('standarStok')->result();
        }

        $this->load->view('navbar', $title);
        $this->load->view('standar_stok', $data);
    }
}
