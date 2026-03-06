<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemakaianMaterial extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        // load data for view
        $data = [];
        // materials for lookup
        $data['materials'] = $this->db->get('material')->result();

        // filters from query params
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $filter_material = $this->input->get('idmaterial');

        $data['usages'] = [];
        if ($this->db->table_exists('pemakaian_material')) {
            // Select usages and join material to get kode_material and nama
            $this->db->select('pemakaian_material.*, material.kode_material, material.nama, material.sn_terpakai');
            $this->db->from('pemakaian_material');
            $this->db->join('material', 'pemakaian_material.idMaterial = material.idmaterial', 'left');

            if ($start_date) {
                $this->db->where('DATE(pemakaian_material.tanggal) >=', $start_date);
            }
            if ($end_date) {
                $this->db->where('DATE(pemakaian_material.tanggal) <=', $end_date);
            }
            if ($filter_material) {
                $this->db->where('pemakaian_material.idMaterial', $filter_material);
            }
            $this->db->order_by('pemakaian_material.tanggal', 'DESC');
            $data['usages'] = $this->db->get()->result();
        }

        $this->load->view('pemakaian_material', $data);
    }

    public function insert()
    {
        // Expect POST: idmaterial, tanggal_penggunaan, incident, qty_terpakai, kode_material_terpakai, sn_terpakai
        $idmaterial = $this->input->post('idmaterial');
        $tanggal = $this->input->post('tanggal_penggunaan');
        $incident = $this->input->post('incident');
        $qty = $this->input->post('qty_terpakai');
        $kode_terpakai = $this->input->post('kode_material_terpakai');
        $sn_terpakai = $this->input->post('sn_terpakai');

        if (!$idmaterial || !$tanggal || !$qty) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
            return;
        }

        // insert into pemakaian_material (create table beforehand if needed)
        // table uses columns: idPemakaianMaterial, idMaterial, incident, tanggal, qty
        $insert = [
            'idMaterial' => $idmaterial,
            'tanggal' => $tanggal,
            'incident' => $incident,
            'qty' => $qty
        ];
        $this->db->insert('pemakaian_material', $insert);

        // update material record with kode/sn terpakai if provided
        $update = [];
        if ($kode_terpakai) $update['kode_material_terpakai'] = $kode_terpakai;
        if ($sn_terpakai) $update['sn_terpakai'] = $sn_terpakai;
        if (!empty($update)) {
            $this->db->where('idmaterial', $idmaterial)->update('material', $update);
        }

        echo json_encode(['status' => 'success']);
    }
}
