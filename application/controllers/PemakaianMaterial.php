<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemakaianMaterial extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Resolve the pemakaian table name in DB. Try common variants.
     * Returns table name string or false if not found.
     */
    private function get_pemakaian_table()
    {
        $candidates = [
            'pemakaian_material',
            'pemakaianMaterial',
            'pemakaianmaterial',
            'pemakaian_materials',
            'pemakaianmaterials'
        ];
        foreach ($candidates as $t) {
            if ($this->db->table_exists($t)) return $t;
        }
        return false;
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
        $ptable = $this->get_pemakaian_table();
        if ($ptable) {
            // Select usages and join material to get kode_material and nama
            $this->db->select("{$ptable}.*, material.kode_material, material.nama, material.sn_terpakai");
            $this->db->from($ptable);
            $this->db->join('material', "{$ptable}.idMaterial = material.idmaterial", 'left');

            if ($start_date) {
                $this->db->where("DATE({$ptable}.tanggal) >=", $start_date);
            }
            if ($end_date) {
                $this->db->where("DATE({$ptable}.tanggal) <=", $end_date);
            }
            if ($filter_material) {
                $this->db->where("{$ptable}.idMaterial", $filter_material);
            }
            $this->db->order_by("{$ptable}.tanggal", 'DESC');
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
        $ptable = $this->get_pemakaian_table();
        if (!$ptable) {
            echo json_encode(['status' => 'error', 'message' => 'Table pemakaian material tidak ditemukan in database']);
            return;
        }

        $this->db->insert($ptable, $insert);

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
