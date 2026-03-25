<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringInternal extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function resolveTableName()
    {
        $candidates = ['pencapaianInternal', 'monitoring_internal', 'monitoringinternal', 'internal'];
        foreach ($candidates as $table) {
            if ($this->db->table_exists($table)) {
                return $table;
            }
        }
        return false;
    }

    private function buildPayloadFromPost($table)
    {
        $payload = [
            'nama' => trim((string)$this->input->post('nama')),
            'segmen' => trim((string)$this->input->post('segmen')),
            'incident' => trim((string)$this->input->post('incident')),
            'tanggal' => trim((string)$this->input->post('tanggal')),
        ];

        $fields = $this->db->list_fields($table);
        return array_intersect_key($payload, array_flip($fields));
    }

    public function index()
    {
        session_start();
        $title['title'] = 'Monitoring Internal';

        if (
            $_SESSION['role'] == 'Superadmin' ||
            $_SESSION['role'] == 'NOC Ritel' ||
            $_SESSION['role'] == 'Team Leader' ||
            $_SESSION['role'] == 'Pemeliharaan Ritel' ||
            $_SESSION['role'] == 'Guest 1'
        ) {
            $table = $this->resolveTableName();
            $data['table_name'] = $table;
            $data['table_missing'] = ($table === false);
            $data['rows'] = [];

            if ($table !== false) {
                $this->db->from($table);
                $fields = $this->db->list_fields($table);
                if (in_array('tanggal', $fields, true)) {
                    $this->db->order_by('tanggal', 'DESC');
                }
                if (in_array('id', $fields, true)) {
                    $this->db->order_by('id', 'DESC');
                }
                $data['rows'] = $this->db->get()->result();
            }

            $this->load->view('navbar', $title);
            $this->load->view('monitoring_internal', $data);
        } else {
            header('location: ./DashboardNoc');
        }
    }

    public function insertData()
    {
        $table = $this->resolveTableName();
        if ($table === false) {
            echo 'Tabel Monitoring Internal belum tersedia';
            return;
        }

        $data = $this->buildPayloadFromPost($table);
        if (empty($data['nama']) || empty($data['segmen']) || empty($data['incident']) || empty($data['tanggal'])) {
            echo 'Harap isi semua field';
            return;
        }

        $ok = $this->db->insert($table, $data);
        echo $ok ? 'success' : 'Gagal menambahkan data';
    }

    public function editData()
    {
        $table = $this->resolveTableName();
        if ($table === false) {
            echo 'Tabel Monitoring Internal belum tersedia';
            return;
        }

        $id = (int)$this->input->post('id');
        if (!$id) {
            echo 'ID tidak valid';
            return;
        }

        $data = $this->buildPayloadFromPost($table);
        if (empty($data['nama']) || empty($data['segmen']) || empty($data['incident']) || empty($data['tanggal'])) {
            echo 'Harap isi semua field';
            return;
        }

        $ok = $this->db->where('id', $id)->update($table, $data);
        echo $ok ? 'success' : 'Gagal mengubah data';
    }

    public function deleteRow()
    {
        $table = $this->resolveTableName();
        if ($table === false) {
            echo 'Tabel Monitoring Internal belum tersedia';
            return;
        }

        $id = (int)$this->input->get_post('id');
        if (!$id) {
            echo 'ID tidak valid';
            return;
        }

        $ok = $this->db->where('id', $id)->delete($table);
        echo $ok ? 'success' : 'Gagal menghapus data';
    }
}
