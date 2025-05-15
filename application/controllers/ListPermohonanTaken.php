<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ListPermohonanTaken extends CI_Controller {

    public function index() {
        session_start();
        $title['title'] = "List Permohonan";
        $name = $_SESSION['nama'];
        // Fetch all records from cusex
        $data['permohonan'] = $this->db->query("
            SELECT 
                id_permohonan,
                nama_pemohon,
                jenis_permohonan,
                no_telepon,
                id_pa,
                layanan,
                produk,
                nama_ptl,
                mitra_agen,
                nama_agen,
                posisi_agen,
                mitra_aktivasi,
                petugas_lapangan,
                lat_pemohon,
                long_pemohon,
                id_splitter,
                lat_splitter,
                long_splitter,
                tgl_permohonan,
                tgl_pembayaran,
                tgl_disposisi,
                aging,
                status,
                olt,
                alamat,
                daerah,
                regional,
                kantor_perwakilan
            FROM cusex WHERE pic='$name'
            ORDER BY tgl_permohonan DESC
        ")->result();
        if(isset($_SESSION['role']) && in_array($_SESSION['role'], ['Superadmin', 'NOC Ritel', 'Team Leader', 'Pemeliharaan Ritel'])) {
            $this->load->view('navbar', $title);
            $this->load->view('listPermohonanTaken', $data);
        } else {
            header('location: ./DashboardNoc');
            exit();
        }
    }

    public function delete($id) {
        if ($this->db->delete('cusex', ['id_permohonan' => $id])) {
            redirect('/ListPermohonanAll');
        } else {
            echo "Error: Gagal menghapus permohonan.";
        }
    }

    public function edit($id) {
        // Fetch the current data for the selected record
        $data['permohonan'] = $this->db->get_where('cusex', ['id_permohonan' => $id])->row();
        $title['title'] = "Edit Permohonan";

        // Load the edit form view
        $this->load->view('navbar', $title);
        $this->load->view('editPermohonan', $data);
    }
}
