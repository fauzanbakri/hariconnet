<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TicketsCorporate extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar');
    }

    public function index()
    {
        $title['title'] = "All Tickets Corporate";

        $rows = $this->db->query("SELECT tc.id, tc.idTim, tc.segmen, tc.incident, tc.status, tc.keterangan, tc.tanggal,
                                              tc.ketUpdate, tc.lastUpdateBy, tc.timestamps,
                                              t.nama AS tim_nama,
                                              b.kp AS kp
                                       FROM tiketCorporate tc
                                       LEFT JOIN tim t ON tc.idTim = t.idTim
                                       LEFT JOIN basecamp b ON t.idBc = b.idBc
                                       ORDER BY tc.tanggal ASC, tc.id ASC")->result();

        foreach ($rows as $row) {
            $row->timestamps_utc8 = $this->formatUtc8($row->timestamps ?? '');
        }

        $q['data'] = $rows;

        $q['tim'] = $this->db->query("SELECT t.idTim, t.nama, b.kendaraan
                                      FROM tim t
                                      LEFT JOIN basecamp b ON t.idBc = b.idBc
                                      ORDER BY t.nama ASC")->result();

        $q['segmen'] = array_values(array_unique(array_filter(array_map(function($r){ return isset($r->segmen) ? $r->segmen : ''; }, $q['data']))));
        sort($q['segmen']);

        $q['status'] = array_values(array_unique(array_filter(array_map(function($r){ return isset($r->status) ? $r->status : ''; }, $q['data']))));
        sort($q['status']);

        session_start();
        $role = strtolower((string)($_SESSION['role'] ?? ''));
        if(
            $role=='superadmin' || 
            $role=='noc ritel' || 
            $role=='team leader' || 
            $role=='pemeliharaan ritel' || 
            $role=='resepsionis' ||
            $role=='noc corpo' ||
            $role=='helpdesk' ||
            $role=='guest 1' ||
            $role=='admin mitra'
        ){
            $this->load->view('navbar', $title);
            $this->load->view('tickets_corporate', $q);
        } else {
            header('location: ./DashboardNoc');
        }
    }

    private function formatUtc8($value)
    {
        if (empty($value)) {
            return '-';
        }

        try {
            $dt = new DateTime($value, new DateTimeZone('UTC'));
            $dt->setTimezone(new DateTimeZone('Asia/Makassar'));
            return $dt->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            return $value;
        }
    }

    public function insertData()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $incident = trim((string)$this->input->post('incident'));
        $idTim = (int)$this->input->post('idTim');
        $segmen = trim((string)$this->input->post('segmen'));
        $status = trim((string)$this->input->post('status'));
        $keterangan = trim((string)$this->input->post('keterangan'));
        $tanggal = trim((string)$this->input->post('tanggal'));
        $lastUpdateBy = isset($_SESSION['nama']) ? trim((string)$_SESSION['nama']) : '';
        $timestamps = (new DateTime('now', new DateTimeZone('Asia/Makassar')))->format('Y-m-d H:i:s');

        if ($incident === '' || $idTim <= 0 || $segmen === '' || $status === '') {
            echo 'Harap isi semua field wajib';
            return;
        }

        $existing = $this->db->get_where('tiketCorporate', [
            'idTim' => $idTim,
            'segmen' => $segmen,
            'incident' => $incident,
            'status' => $status,
            'keterangan' => $keterangan,
            'tanggal' => $tanggal,
        ])->num_rows();

        if ($existing > 0) {
            echo 'Data yang sama sudah ada';
            return;
        }

        $ok = $this->db->insert('tiketCorporate', [
            'idTim' => $idTim,
            'segmen' => $segmen,
            'incident' => $incident,
            'status' => $status,
            'keterangan' => $keterangan,
            'tanggal' => $tanggal,
            'ketUpdate' => 'Update',
            'lastUpdateBy' => $lastUpdateBy,
            'timestamps' => $timestamps,
        ]);

        echo $ok ? 'success' : 'Gagal menambah data';
    }

    public function editData()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $id = (int)$this->input->post('id');
        $incident = trim((string)$this->input->post('incident'));
        $idTim = (int)$this->input->post('idTim');
        $segmen = trim((string)$this->input->post('segmen'));
        $status = trim((string)$this->input->post('status'));
        $keterangan = trim((string)$this->input->post('keterangan'));
        $ketUpdate = trim((string)$this->input->post('ketUpdate'));
        $tanggal = trim((string)$this->input->post('tanggal'));
        $lastUpdateBy = isset($_SESSION['nama']) ? trim((string)$_SESSION['nama']) : '';
        $timestamps = (new DateTime('now', new DateTimeZone('Asia/Makassar')))->format('Y-m-d H:i:s');

        if ($id <= 0 || $incident === '' || $idTim <= 0 || $segmen === '' || $status === '') {
            echo 'Harap isi semua field wajib';
            return;
        }

        $ok = $this->db->where('id', $id)->update('tiketCorporate', [
            'idTim' => $idTim,
            'segmen' => $segmen,
            'incident' => $incident,
            'status' => $status,
            'keterangan' => $keterangan,
            'ketUpdate' => $ketUpdate,
            'tanggal' => $tanggal,
            'lastUpdateBy' => $lastUpdateBy,
            'timestamps' => $timestamps,
        ]);

        echo $ok ? 'success' : 'Gagal mengubah data';
    }

    public function deleteRow()
    {
        $id = (int)$this->input->get_post('id');
        if ($id <= 0) {
            echo false;
            return;
        }

        echo $this->db->delete('tiketCorporate', ['id' => $id]) ? true : false;
    }

    public function changeShift()
    {
        $this->db->trans_start();

        $closedRows = $this->db->query(
            "SELECT * FROM tiketCorporate WHERE LOWER(status) = 'closed'"
        )->result_array();

        foreach ($closedRows as $row) {
            $this->db->insert('tiketCorporateClose', $row);
        }

        $this->db->where("LOWER(status) = 'closed'")
                 ->delete('tiketCorporate');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo 'failed';
            return;
        }

        echo 'success';
    }
}
