<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemakaianMaterial_model extends CI_Model {

    protected $table = 'pemakaian_material';

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_all()
    {
        // join with material to show details
        $this->db->select('pm.*, m.kode_material, m.sn, m.merk, m.nama as tim_name');
        $this->db->from($this->table.' pm');
        $this->db->join('material m', 'pm.idMaterial = m.idmaterial', 'left');
        $this->db->order_by('pm.tanggal', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
