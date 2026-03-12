<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KodeMaterial extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kode_material_model');
    }

    public function index()
    {
        $data['title'] = 'Kode Material';
        $data['kode_material'] = $this->Kode_material_model->getAll();
        $this->load->view('kode_material', $data);
    }

    public function insertData()
    {
        $post = $this->input->post();
        $ok = $this->Kode_material_model->insert($post);
        echo $ok ? 'success' : 'error';
    }

    public function editData()
    {
        $post = $this->input->post();
        $id = isset($post['kode_material']) ? $post['kode_material'] : null;
        if(!$id){ echo 'error'; return; }
        $data = [
            'deskripsi_material' => $post['deskripsi_material'] ?? '',
            'kategori' => $post['kategori'] ?? null
        ];
        $ok = $this->Kode_material_model->update($id, $data);
        echo $ok ? 'success' : 'error';
    }

    public function deleteRow()
    {
        $id = $this->input->get('id');
        $ok = $this->Kode_material_model->delete($id);
        echo $ok ? json_encode(['success' => true]) : json_encode(['success' => false]);
    }
}
