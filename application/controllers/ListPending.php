<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListPending extends CI_Controller {
	public function index()
	{
        $title['title']="List Pending";
        $q['total'] = $this->db->query("SELECT COUNT(idTiket) as total FROM tiket; ")->row();
		$q['close'] = $this->db->query("SELECT COUNT(idTiket) as close FROM tiket WHERE status='CLOSED'")->row();
		$q['new'] = $this->db->query("SELECT COUNT(idTiket) as new FROM tiket WHERE status='NEW'")->row();
		$q['sulselC'] = $this->db->query("SELECT COUNT(*) AS sulselC FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Selatan' AND status='CLOSED';")->row();
		$q['sulbarC'] = $this->db->query("SELECT COUNT(*) AS sulbarC FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Barat' AND status='CLOSED';")->row();
		$q['sultraC'] = $this->db->query("SELECT COUNT(*) AS sultraC FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Tenggara' AND status='CLOSED';")->row();
		$q['sultengC'] = $this->db->query("SELECT COUNT(*) AS sultengC FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Tengah' AND status='CLOSED';")->row();
		$q['sulutC'] = $this->db->query("SELECT COUNT(*) AS sulutC FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Utara' AND status='CLOSED';")->row();
		$q['gorontaloC'] = $this->db->query("SELECT COUNT(*) AS gorontaloC FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Gorontalo' AND status='CLOSED';")->row();

        $q['sulselO'] = $this->db->query("SELECT COUNT(*) AS sulselO FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Selatan' AND status='NEW';")->row();
		$q['sulbarO'] = $this->db->query("SELECT COUNT(*) AS sulbarO FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Barat' AND status='NEW';")->row();
		$q['sultraO'] = $this->db->query("SELECT COUNT(*) AS sultraO FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Tenggara' AND status='NEW';")->row();
		$q['sultengO'] = $this->db->query("SELECT COUNT(*) AS sultengO FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Tengah' AND status='NEW';")->row();
		$q['sulutO'] = $this->db->query("SELECT COUNT(*) AS sulutO FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Utara' AND status='NEW';")->row();
		$q['gorontaloO'] = $this->db->query("SELECT COUNT(*) AS gorontaloO FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Gorontalo' AND status='NEW';")->row();
        
        $q['sulselT'] = $this->db->query("SELECT COUNT(*) AS sulselT FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Selatan';")->row();
		$q['sulbarT'] = $this->db->query("SELECT COUNT(*) AS sulbarT FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Barat';")->row();
		$q['sultraT'] = $this->db->query("SELECT COUNT(*) AS sultraT FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Tenggara';")->row();
		$q['sultengT'] = $this->db->query("SELECT COUNT(*) AS sultengT FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Tengah';")->row();
		$q['sulutT'] = $this->db->query("SELECT COUNT(*) AS sulutT FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Sulawesi Utara';")->row();
		$q['gorontaloT'] = $this->db->query("SELECT COUNT(*) AS gorontaloT FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi = 'Gorontalo';")->row();
        session_start();
        if(
			$_SESSION['role']=='Superadmin' || 
			$_SESSION['role']=='NOC Ritel' 
			){
                $this->load->view('navbar', $title);
                $this->load->view('listPending', $q);
		}else{
			header('location: ./DashboardNoc');
		}
	}
    public function makassar(){
         $q = $this->db->query("SELECT DISTINCT olt.kabupaten FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE provinsi='Sulawesi Selatan' ORDER BY kabupaten DESC;")->result();
        foreach($q as $kab){
            if ($kab->kabupaten!=''){
                echo "=====".$kab->kabupaten."=====<br><br>";
                $qn = $this->db->query("SELECT * FROM tiket LEFT JOIN olt ON olt.idOlt=tiket.idOlt WHERE kabupaten='$kab->kabupaten';")->result();
                $no = 1;
                foreach($qn as $d){
                    echo $no.".
                    NO INCIDENT: ".$d->idInsiden."<br>
                    TANGGAL MASUK: ".$d->tanggal."<br>
                    NO TIKET: ".$d->idTiket."<br>
                    SID/CRM ID: ".$d->sid."<br>
                    TELEPON: ".$d->telepon."<br>
                    NAMA: ".$d->nama."<br>
                    KELUHAN: ".$d->keluhan."<br>
                    ALAMAT: ".$d->alamat."<br>
                    TERMINATING: ".$d->idOlt."/".$d->sn."<br><br>
                    ";
                    $no++;
                }
            }
        }
    }
    public function kendari(){
        $q = $this->db->query("SELECT DISTINCT olt.kabupaten FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi IN ('Sulawesi Tenggara', 'Sulawesi Barat', 'Sulawesi Tengah') ORDER BY kabupaten DESC;")->result();
       foreach($q as $kab){
           if ($kab->kabupaten!=''){
               echo "=====".$kab->kabupaten."=====<br><br>";
               $qn = $this->db->query("SELECT * FROM tiket LEFT JOIN olt ON olt.idOlt=tiket.idOlt WHERE kabupaten='$kab->kabupaten';")->result();
               $no = 1;
               foreach($qn as $d){
                   echo $no.".
                   NO INCIDENT: ".$d->idInsiden."<br>
                   TANGGAL MASUK: ".$d->tanggal."<br>
                   NO TIKET: ".$d->idTiket."<br>
                   SID/CRM ID: ".$d->sid."<br>
                   TELEPON: ".$d->telepon."<br>
                   NAMA: ".$d->nama."<br>
                   KELUHAN: ".$d->keluhan."<br>
                   ALAMAT: ".$d->alamat."<br>
                   TERMINATING: ".$d->idOlt."/".$d->sn."<br><br>
                   ";
                   $no++;
               }
           }
       }
   }
   public function pending(){
        $q = $this->db->query("SELECT DISTINCT tiket.tim FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE tiket.status!='closed' ORDER BY tim ASC;")->result();
        foreach($q as $kab){
            if ($kab->tim!=''){
                echo '<span class="badge badge-label bg-secondary"><i class="mdi mdi-circle-medium"></i>'.$kab->tim.'</span><br><br>';
                $qn = $this->db->query("SELECT DISTINCT kabupaten FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE tiket.tim='$kab->tim' AND tiket.status!='closed' ORDER BY kabupaten DESC;")->result();
                foreach($qn as $d){
                    echo "=====".$d->kabupaten."=====<br><br>";
                    $qx = $this->db->query("SELECT * FROM tiket LEFT JOIN olt ON olt.idOlt=tiket.idOlt WHERE kabupaten='$d->kabupaten' AND tim='$kab->tim' AND tiket.status!='closed' ORDER BY prioritas, tanggal ASC;")->result();
                    $no = 1;
                    foreach ($qx as $c){
                        echo $no.".
                        NO INCIDENT: ".$c->idInsiden."<br>
                        TANGGAL MASUK: ".$c->tanggal."<br>
                        NO TIKET: ".$c->idTiket."<br>
                        SID/CRM ID: ".$c->sid."<br>
                        TELEPON: ".$c->telepon."<br>
                        NAMA: ".$c->nama."<br>
                        KELUHAN: ".$c->keluhan."<br>
                        ALAMAT: ".$c->alamat."<br>
                        KETERANGAN: ".$c->keterangan."<br>
                        TERMINATING: ".$c->idOlt."/".$c->sn."<br><br>
                        ";
                        $no++;
                    }
                }
            }
        }
    }
}
