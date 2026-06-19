<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TicketsCorporate extends CI_Controller {

    public function index()
    {
        $title['title'] = "All Tickets Corporate";

        $q['data'] = $this->db->query("SELECT tc.id, tc.idTim, tc.segmen, tc.incident, tc.status, tc.keterangan, tc.tanggal,
                                              t.nama AS tim_nama,
                                              b.kp AS kp
                                       FROM tiketCorporate tc
                                       LEFT JOIN tim t ON tc.idTim = t.idTim
                                       LEFT JOIN basecamp b ON t.idBc = b.idBc
                                       ORDER BY tc.id DESC")->result();

        $q['tim'] = $this->db->query("SELECT t.idTim, t.nama, b.kendaraan
                                      FROM tim t
                                      LEFT JOIN basecamp b ON t.idBc = b.idBc
                                      ORDER BY t.nama ASC")->result();

        $q['segmen'] = array_values(array_unique(array_filter(array_map(function($r){ return isset($r->segmen) ? $r->segmen : ''; }, $q['data']))));
        sort($q['segmen']);

        $q['status'] = array_values(array_unique(array_filter(array_map(function($r){ return isset($r->status) ? $r->status : ''; }, $q['data']))));
        sort($q['status']);

        session_start();
        if(
            $_SESSION['role']=='Superadmin' || 
            $_SESSION['role']=='NOC Ritel' || 
            $_SESSION['role']=='Team Leader' || 
            $_SESSION['role']=='Pemeliharaan Ritel' || 
            $_SESSION['role']=='Resepsionis' ||
            $_SESSION['role']=='NOC Corpo' ||
            $_SESSION['role']=='Helpdesk' ||
            $_SESSION['role']=='Guest 1'
        ){
            $this->load->view('navbar', $title);
            $this->load->view('tickets_corporate', $q);
        } else {
            header('location: ./DashboardNoc');
        }
    }

    public function insertData()
    {
        $incident = trim((string)$this->input->post('incident'));
        $idTim = (int)$this->input->post('idTim');
        $segmen = trim((string)$this->input->post('segmen'));
        $status = trim((string)$this->input->post('status'));
        $keterangan = trim((string)$this->input->post('keterangan'));
        $tanggal = trim((string)$this->input->post('tanggal'));

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
        ]);

        echo $ok ? 'success' : 'Gagal menambah data';
    }

    public function editData()
    {
        $id = (int)$this->input->post('id');
        $incident = trim((string)$this->input->post('incident'));
        $idTim = (int)$this->input->post('idTim');
        $segmen = trim((string)$this->input->post('segmen'));
        $status = trim((string)$this->input->post('status'));
        $keterangan = trim((string)$this->input->post('keterangan'));
        $tanggal = trim((string)$this->input->post('tanggal'));

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
            'tanggal' => $tanggal,
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
