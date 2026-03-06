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
		session_start();
        // Fetch rows from standarStok table (assumes table exists)
            $data['rows'] = [];
            if ($this->db->table_exists('standarStok')) {
                $this->db->order_by('idStandarStok', 'DESC');
                $data['rows'] = $this->db->get('standarStok')->result();
            }

            // fetch basecamp list for dropdown (sloc)
            $data['basecamp'] = [];
            if ($this->db->table_exists('basecamp')) {
                $this->db->select('idBc, sloc');
                $this->db->from('basecamp');
                $this->db->order_by('sloc', 'ASC');
                $data['basecamp'] = $this->db->get()->result();
            }

        $this->load->view('navbar', $title);
        $this->load->view('standar_stok', $data);
    }
}
    
    public function insertData()
    {
        // minimal server-side validation
        $idBc = $this->input->post('idBc');
        if (!$idBc) {
            echo 'Basecamp wajib dipilih';
            return;
        }

        $payload = [
            'idBc' => $idBc,
            'ont_huawei' => $this->input->post('ont_huawei') ?: 0,
            'ont_fiberhome' => $this->input->post('ont_fiberhome') ?: 0,
            'ont_zte' => $this->input->post('ont_zte') ?: 0,
            'ont_raisecom' => $this->input->post('ont_raisecom') ?: 0,
            'ont_bdcom' => $this->input->post('ont_bdcom') ?: 0,
            'dw_50' => $this->input->post('dw_50') ?: 0,
            'dw_100' => $this->input->post('dw_100') ?: 0,
            'dw_150' => $this->input->post('dw_150') ?: 0,
            'dw_250' => $this->input->post('dw_250') ?: 0,
            'dw_300' => $this->input->post('dw_300') ?: 0,
            'dw_1000' => $this->input->post('dw_1000') ?: 0,
            'adss_6c' => $this->input->post('adss_6c') ?: 0,
            'adss_24c' => $this->input->post('adss_24c') ?: 0,
            'adss_48c' => $this->input->post('adss_48c') ?: 0,
            'adss_96c' => $this->input->post('adss_96c') ?: 0
        ];

        if ($this->db->insert('standarStok', $payload)) {
            echo 'success';
        } else {
            $e = $this->db->error();
            echo isset($e['message']) ? $e['message'] : 'Gagal menyimpan';
        }
    }
