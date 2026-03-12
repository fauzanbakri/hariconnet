<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kode_material_model extends CI_Model {
    protected $table = 'kode_material';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('kode_material', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('kode_material', $id)->delete($this->table);
    }
}
