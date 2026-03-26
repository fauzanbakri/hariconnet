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
            'status' => trim((string)$this->input->post('status')),
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
            $data['filter_start_date'] = trim((string)$this->input->get('start_date'));
            $data['filter_end_date'] = trim((string)$this->input->get('end_date'));
            $data['filter_status'] = strtolower(trim((string)$this->input->get('status')));

            if ($table !== false) {
                $fields = $this->db->list_fields($table);
                $this->db->from($table);
                if (in_array('tanggal', $fields, true)) {
                    if ($data['filter_start_date'] !== '') {
                        $this->db->where('tanggal >=', $data['filter_start_date']);
                    }
                    if ($data['filter_end_date'] !== '') {
                        $this->db->where('tanggal <=', $data['filter_end_date']);
                    }
                }
                if (in_array('status', $fields, true) && in_array($data['filter_status'], ['not yet', 'done'], true)) {
                    $this->db->where('LOWER(status)', $data['filter_status']);
                }
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

        $segmen = trim((string)$this->input->post('segmen'));
        $status = strtolower(trim((string)$this->input->post('status')));
        $tanggal = trim((string)$this->input->post('tanggal'));
        $fields = $this->db->list_fields($table);
        if ($status === '') {
            $status = 'not yet';
        }
        if (!in_array($status, ['not yet', 'done'], true)) {
            echo 'Status tidak valid';
            return;
        }

        // Multi input support
        $namaList = $this->input->post('nama_list');
        if (!is_array($namaList)) {
            $namaList = [];
        }
        $namaList = array_values(array_filter(array_map('trim', $namaList), function($v){ return $v !== ''; }));

        $incidentRaw = (string)$this->input->post('incident_list');
        $incidentLines = preg_split('/\r\n|\r|\n/', $incidentRaw);
        $incidentList = array_values(array_filter(array_map('trim', (array)$incidentLines), function($v){ return $v !== ''; }));

        // Fallback to single input mode for compatibility
        if (empty($namaList)) {
            $singleNama = trim((string)$this->input->post('nama'));
            if ($singleNama !== '') {
                $namaList = [$singleNama];
            }
        }
        if (empty($incidentList)) {
            $singleIncident = trim((string)$this->input->post('incident'));
            if ($singleIncident !== '') {
                $incidentList = [$singleIncident];
            }
        }

        if (empty($namaList) || empty($incidentList) || $segmen === '' || $status === '' || $tanggal === '') {
            echo 'Harap isi semua field';
            return;
        }

        $okAll = true;
        $inserted = 0;
        foreach ($namaList as $nama) {
            foreach ($incidentList as $incident) {
                $data = [
                    'nama' => $nama,
                    'segmen' => $segmen,
                    'incident' => $incident,
                    'status' => $status,
                    'tanggal' => $tanggal,
                ];
                $data = array_intersect_key($data, array_flip($fields));
                $ok = $this->db->insert($table, $data);
                if ($ok) {
                    $inserted++;
                } else {
                    $okAll = false;
                }
            }
        }

        if ($okAll && $inserted > 0) {
            echo 'success';
            return;
        }
        echo $inserted > 0 ? 'Sebagian data gagal disimpan' : 'Gagal menambahkan data';
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
        if (isset($data['status']) && $data['status'] !== '') {
            $data['status'] = strtolower($data['status']);
            if (!in_array($data['status'], ['not yet', 'done'], true)) {
                echo 'Status tidak valid';
                return;
            }
        }
        if (empty($data['nama']) || empty($data['segmen']) || empty($data['incident']) || empty($data['tanggal']) || (array_key_exists('status', $data) && empty($data['status']))) {
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
