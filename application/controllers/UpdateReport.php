<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateReport extends CI_Controller {
	public function index()
	{
        $title['title']="Update Report";
        $q['terbanyak_makassar'] = $this->db->query("SELECT * FROM feeder LEFT JOIN olt ON feeder.idOlt = olt.idOlt WHERE olt.provinsi = 'Sulawesi Selatan' ORDER BY jumlahTiket DESC LIMIT 3;");
        $q['terbanyak_mamuju'] = $this->db->query("SELECT * FROM feeder LEFT JOIN olt ON feeder.idOlt = olt.idOlt WHERE olt.provinsi = 'Sulawesi Barat' ORDER BY jumlahTiket DESC LIMIT 3;");
        $q['terbanyak_palu'] = $this->db->query("SELECT * FROM feeder LEFT JOIN olt ON feeder.idOlt = olt.idOlt WHERE olt.provinsi = 'Sulawesi Tengah' ORDER BY jumlahTiket DESC LIMIT 3;");
        $q['terbanyak_kendari'] = $this->db->query("SELECT * FROM feeder LEFT JOIN olt ON feeder.idOlt = olt.idOlt WHERE olt.provinsi = 'Sulawesi Tenggara' ORDER BY jumlahTiket DESC LIMIT 3;");
        $q['terbanyak_gorontalo'] = $this->db->query("SELECT * FROM feeder LEFT JOIN olt ON feeder.idOlt = olt.idOlt WHERE olt.provinsi = 'Gorontalo' ORDER BY jumlahTiket DESC LIMIT 3;");
        $q['terbanyak_manado'] = $this->db->query("SELECT * FROM feeder LEFT JOIN olt ON feeder.idOlt = olt.idOlt WHERE olt.provinsi = 'Sulawesi Utara' ORDER BY jumlahTiket DESC LIMIT 3;");
        session_start();
        if(
			$_SESSION['role']=='Superadmin' || 
			$_SESSION['role']=='NOC Ritel'
			){
                $this->load->view('navbar', $title);
                $this->load->view('updateReport', $q);
		}else{
			header('location: ./DashboardNoc');
		}
	}
    public function makassar(){
         $q = $this->db->query("SELECT DISTINCT olt.kabupaten FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE provinsi='Sulawesi Selatan' ORDER BY kabupaten DESC;")->result();
        foreach($q as $kab){
            if ($kab->kabupaten!=''){
                echo "=====".$kab->kabupaten."=====<br><br>";
                $qn = $this->db->query("SELECT * FROM tiket LEFT JOIN olt ON olt.idOlt=tiket.idOlt WHERE kabupaten='$kab->kabupaten'  ORDER BY prioritas, tanggal ASC;")->result();
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
               $qn = $this->db->query("SELECT * FROM tiket LEFT JOIN olt ON olt.idOlt=tiket.idOlt WHERE kabupaten='$kab->kabupaten'  ORDER BY prioritas, tanggal ASC;")->result();
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
   public function manado(){
        $q = $this->db->query("SELECT DISTINCT olt.kabupaten FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt WHERE olt.provinsi IN ('Sulawesi Utara', 'Gorontalo') ORDER BY kabupaten DESC;")->result();
        foreach($q as $kab){
            if ($kab->kabupaten!=''){
                echo "=====".$kab->kabupaten."=====<br><br>";
                $qn = $this->db->query("SELECT * FROM tiket LEFT JOIN olt ON olt.idOlt=tiket.idOlt WHERE kabupaten='$kab->kabupaten' ORDER BY prioritas, tanggal ASC;")->result();
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

    public function test(){
        
    }
    public function totaltiket(){
        date_default_timezone_set('Asia/Makassar');
        $makassartotal = $this->input->post('makassartotal');
        $kendaritotal = $this->input->post('kendaritotal');
        $manadototal = $this->input->post('manadototal');

        $makassardivision = $this->input->post('makassardivision');
        $kendaridivision = $this->input->post('kendaridivision');
        $manadodivision = $this->input->post('manadodivision');

        $qm = $this->db->query("SELECT * FROM feeder WHERE tipe!='FTTH DISTRIBUSI' AND kp='MAKASSAR' AND status!='CLOSED'")->result();
        $qk = $this->db->query("SELECT * FROM feeder WHERE tipe!='FTTH DISTRIBUSI' AND kp='KENDARI' AND status!='CLOSED'")->result();
        $qn = $this->db->query("SELECT * FROM feeder WHERE tipe!='FTTH DISTRIBUSI' AND kp='MANADO' AND status!='CLOSED'")->result();

        $cm = $this->db->query("SELECT SUM(jumlahTiket) AS total FROM feeder WHERE tipe!='FTTH DISTRIBUSI' AND kp='MAKASSAR' AND status!='CLOSED'")->result();
        // echo $cm[0]->total;

        $ck = $this->db->query("SELECT SUM(jumlahTiket) AS total FROM feeder WHERE tipe!='FTTH DISTRIBUSI' AND kp='KENDARI' AND status!='CLOSED'")->result();
        // echo $ck[0]->total;
        
        $cn = $this->db->query("SELECT SUM(jumlahTiket) AS total FROM feeder WHERE tipe!='FTTH DISTRIBUSI' AND kp='MANADO' AND status!='CLOSED'")->result();
        // echo $cn[0]->total;
        
        $total = $makassartotal + $kendaritotal + $manadototal;
        $belummasukmakassar = $makassartotal - $makassardivision;
        $belummasukkendari = $kendaritotal - $kendaridivision;
        $belummasukmanado = $manadototal - $manadodivision;

        $tiketnonbbmakassar = $makassardivision - $cm[0]->total;
        $tiketnonbbkendari = $kendaridivision - $ck[0]->total;
        $tiketnonbbmanado = $manadodivision - $cn[0]->total;



        echo '
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">UPDATE TOTAL TIKET</h5>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th class="" scope="row">Hari/Tanggal :</th>
                                <td class="text-muted">'.date("d/m/Y").'</td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Waktu :</th>
                                <td class="text-muted">'.date("h:i").' WITA</td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Total :</th>
                                <td class="text-muted">'.$total.' Tiket</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Makassar :</th>
                                <td class="text-muted">'.$makassartotal.' Tiket</td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Tiket Non BB-FD-DT :</th>
                                <td class="text-muted">'.$tiketnonbbmakassar.' Tiket</td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Tiket Belum Masuk SBU :</th>
                                <td class="text-muted">'.$belummasukmakassar.' Tiket</td>
                            </tr>';
                            foreach ($qm as $row){
                                echo '
                                 <tr>
                                    <th class="" scope="row">'.$row->idOlt.' '.$row->gangguan.':</th>
                                    <td class="text-muted">'.$row->jumlahTiket.' Tiket</td>
                                </tr>
                                ';
                            }

                            echo '
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Kendari :</th>
                                <td class="text-muted">'.$kendaritotal.' Tiket</td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Tiket Non BB-FD-DT :</th>
                                <td class="text-muted">'.$tiketnonbbkendari.' Tiket</td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Tiket Belum Masuk SBU :</th>
                                <td class="text-muted">'.$belummasukkendari.' Tiket</td>
                            </tr>';
                            foreach ($qk as $row){
                                echo '
                                 <tr>
                                    <th class="" scope="row">'.$row->idOlt.' '.$row->gangguan.':</th>
                                    <td class="text-muted">'.$row->jumlahTiket.' Tiket</td>
                                </tr>
                                ';
                            }

                            echo'
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Manado :</th>
                                <td class="text-muted">'.$manadototal.' Tiket</td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Tiket Non BB-FD-DT :</th>
                                <td class="text-muted">'.$tiketnonbbmanado.' Tiket</td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Tiket Belum Masuk SBU :</th>
                                <td class="text-muted">'.$belummasukmanado.' Tiket</td>
                            </tr>';
                            foreach ($qn as $row){
                                echo '
                                 <tr>
                                    <th class="" scope="row">'.$row->idOlt.' '.$row->gangguan.':</th>
                                    <td class="text-muted">'.$row->jumlahTiket.' Tiket</td>
                                </tr>
                                ';
                            }
                            echo '
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        ';
    }
}
