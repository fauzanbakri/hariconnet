<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemakaianMaterial extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // Load list data via AJAX in the view
        $this->load->view('pemakaian_material');
    }

    public function list()
    {
        $this->load->model('PemakaianMaterial_model');
        $rows = $this->PemakaianMaterial_model->get_all();
        echo json_encode(array_values($rows));
    }

    public function insert()
    {
        $this->load->model('PemakaianMaterial_model');
        $idMaterial = $this->input->post('idmaterial');
        $tanggal = $this->input->post('tanggal');
        $incident = $this->input->post('incident');
        $qty = $this->input->post('qty');

        if (!$idMaterial || !$tanggal || !$qty) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
            return;
        }

        $data = [
            'idMaterial' => $idMaterial,
            'tanggal' => $tanggal,
            'incident' => $incident,
            'qty' => $qty
        ];

        $insertId = $this->PemakaianMaterial_model->insert($data);
        if ($insertId) {
            echo json_encode(['status' => 'success', 'insert_id' => $insertId]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'DB insert failed']);
        }
    }
}
