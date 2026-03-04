<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basecamp extends CI_Controller {

    public function index()
    {
        $title['title'] = "List Basecamp";
        $q['basecamp'] = $this->db->query("SELECT * FROM basecamp")->result();
        session_start();
        if(isset($_SESSION['role']) && ($_SESSION['role']=='Superadmin' || $_SESSION['role']=='NOC Ritel')){
            $this->load->view('navbar', $title);
            $this->load->view('listBasecamp', $q);
        }else{
            header('location: ./DashboardNoc');
        }
    }

    public function insertData(){
        $kp = $this->input->post('kp');
        $mitra = $this->input->post('mitra');
        $lat = $this->input->post('lat');
        $longi = $this->input->post('longi');
        $sloc = $this->input->post('sloc');
        $namaAkun = $this->input->post('namaAkun');
        $kendaraan = $this->input->post('kendaraan');
        if($mitra!=''){
            $q = $this->db->query("INSERT INTO basecamp(kp, mitra, lat, longi, sloc, namaAkun, kendaraan) VALUES('$kp','$mitra','$lat','$longi','$sloc','$namaAkun','$kendaraan')");
            if($q) echo 'success'; else { $e = $this->db->error(); echo $e['message']; }
        }else{
            echo 'Mitra Cannot Empty';
        }
    }

    public function editData(){
        $id = $this->input->post('idBc');
        $kp = $this->input->post('kp');
        $mitra = $this->input->post('mitra');
        $lat = $this->input->post('lat');
        $longi = $this->input->post('longi');
        $sloc = $this->input->post('sloc');
        $namaAkun = $this->input->post('namaAkun');
        $kendaraan = $this->input->post('kendaraan');
        if($mitra!=''){
            $q = $this->db->query("UPDATE basecamp SET kp='$kp', mitra='$mitra', lat='$lat', longi='$longi', sloc='$sloc', namaAkun='$namaAkun', kendaraan='$kendaraan' WHERE idBc='$id'");
            if($q) echo 'success'; else { $e = $this->db->error(); echo $e['message']; }
        }else{
            echo 'Mitra Cannot Empty';
        }
    }

    public function deleteRow(){
        $id = $this->input->get('id');
        if ($this->db->delete('basecamp', ['idBc' => $id])) {
            echo true;
        } else {
            echo false;
        }
    }

}
