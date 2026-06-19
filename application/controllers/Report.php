<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	public function index()
	{
        $title['title']="Report";
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
        $q['m'] = $this->db->query("SELECT SUM(jumlahTiket) AS total FROM feeder WHERE kp='MAKASSAR' AND status!='CLOSED'")->row();
        $q['k'] = $this->db->query("SELECT SUM(jumlahTiket) AS total FROM feeder WHERE kp='KENDARI' AND status!='CLOSED'")->row();
        $q['n'] = $this->db->query("SELECT SUM(jumlahTiket) AS total FROM feeder WHERE kp='MANADO' AND status!='CLOSED'")->row();  
        $q['fsulsel'] = $this->db->query("SELECT COALESCE(SUM(f.jumlahTiket), 0) AS total FROM feeder f LEFT JOIN area a ON f.kode = a.kode WHERE a.provinsi = 'Sulawesi Selatan';")->row();
        $q['fsulbar'] = $this->db->query("SELECT COALESCE(SUM(f.jumlahTiket), 0) AS total FROM feeder f LEFT JOIN area a ON f.kode = a.kode WHERE a.provinsi = 'Sulawesi Barat';")->row();
        $q['fsulteng'] = $this->db->query("SELECT COALESCE(SUM(f.jumlahTiket), 0) AS total FROM feeder f LEFT JOIN area a ON f.kode = a.kode WHERE a.provinsi = 'Sulawesi Tengah';")->row();
        $q['fsultra'] = $this->db->query("SELECT COALESCE(SUM(f.jumlahTiket), 0) AS total FROM feeder f LEFT JOIN area a ON f.kode = a.kode WHERE a.provinsi = 'Sulawesi Tenggara';")->row();
        $q['fgorontalo'] = $this->db->query("SELECT COALESCE(SUM(f.jumlahTiket), 0) AS total FROM feeder f LEFT JOIN area a ON f.kode = a.kode WHERE a.provinsi = 'Gorontalo';")->row();
        $q['fsulut'] = $this->db->query("SELECT COALESCE(SUM(f.jumlahTiket), 0) AS total FROM feeder f LEFT JOIN area a ON f.kode = a.kode WHERE a.provinsi = 'Sulawesi Utara';")->row();
        $q['qm'] = $this->db->query("SELECT * FROM feeder WHERE kp='MAKASSAR' AND status!='CLOSED'")->result();
        $q['qk'] = $this->db->query("SELECT * FROM feeder WHERE kp='KENDARI' AND status!='CLOSED'")->result();
        $q['qn'] = $this->db->query("SELECT * FROM feeder WHERE kp='MANADO' AND status!='CLOSED'")->result();
        
        session_start();
        if(
			$_SESSION['role']=='Superadmin' || 
			$_SESSION['role']=='NOC Ritel'
			){
                $this->load->view('navbar', $title);
                $this->load->view('report', $q);
		}else{
			header('location: ./DashboardNoc');
		}
	}

    public function shiftCorpo()
    {
        date_default_timezone_set('Asia/Makassar');
        $title['title'] = "Report Shift Corpo";

        $query = $this->db->query(
            "SELECT tc.id, tc.incident, tc.keterangan, tc.tanggal, tc.status, tc.ketUpdate, tc.timestamps,
                    t.nama AS tim_nama, b.provinsi, b.kabupaten
             FROM tiketCorporate tc
             LEFT JOIN tim t ON tc.idTim = t.idTim
             LEFT JOIN basecamp b ON t.idBc = b.idBc
             ORDER BY tc.tanggal ASC"
        )->result();

        $openRows = [];
        $resolveRows = [];
        foreach ($query as $row) {
            $status = strtoupper(trim((string)($row->status ?? '')));
            if ($status === 'CLOSED' || $status === 'SOLVED (ICRM OPEN)') {
                $resolveRows[] = $row;
            } else {
                $openRows[] = $row;
            }
        }

        $provinceCounts = [];
        foreach ($openRows as $row) {
            $prov = trim((string)($row->provinsi ?? ''));
            if ($prov !== '') {
                if (!isset($provinceCounts[$prov])) {
                    $provinceCounts[$prov] = 0;
                }
                $provinceCounts[$prov]++;
            }
        }

        $provinceList = [];
        foreach ($provinceCounts as $prov => $count) {
            $provinceList[] = [
                'province' => $prov,
                'count' => $count
            ];
        }
        usort($provinceList, function($a, $b) {
            return strcmp($a['province'], $b['province']);
        });

        $reportText = "UPDATE INC Tanggal " . date('d F Y H:i') . " WITA\n";
        $reportText .= "INC KORPORATE :(" . count($openRows) . ")\n";
        $reportText .= "Resolve : (" . count($resolveRows) . ")\n";

        $wilayahParts = [];
        foreach ($provinceList as $item) {
            $wilayahParts[] = $item['province'] . ' :(' . $item['count'] . ')';
        }
        $reportText .= "Wilayah : " . (count($wilayahParts) ? implode(', ', $wilayahParts) : '-') . "\n";
        $reportText .= "MN : \n";
        $reportText .= "HD : \n\n";
        $reportText .= "--INC CORPORATE--\n\n";

        foreach ($provinceList as $item) {
            $reportText .= "==== " . $item['province'] . " ====\n\n";
            $grouped = [];
            foreach ($openRows as $row) {
                if (trim((string)($row->provinsi ?? '')) === $item['province']) {
                    $grouped[] = $row;
                }
            }

            foreach ($grouped as $idx => $row) {
                $keterangan = trim((string)($row->keterangan ?? ''));
                $tanggal = trim((string)($row->tanggal ?? ''));
                $incident = trim((string)($row->incident ?? ''));
                $timNama = trim((string)($row->tim_nama ?? ''));
                $update = trim((string)($row->ketUpdate ?? ''));

                $reportText .= ($idx + 1) . ". " . ($keterangan !== '' ? $keterangan : '-') . "\n";
                $reportText .= "open : " . ($tanggal !== '' ? date('d M Y', strtotime($tanggal)) : '-') . "\n";
                $reportText .= "INC ID : " . ($incident !== '' ? $incident : '-') . "\n";
                $reportText .= "Durasi : " . $this->formatDuration($tanggal) . "\n";
                $reportText .= "Problem : \n";
                $reportText .= "Progres : " . ($update !== '' ? $update : '-') . "\n";
                $reportText .= "Tim : " . ($timNama !== '' ? $timNama : '-') . "\n\n";
            }
        }

        $data = [
            'reportText' => $reportText,
            'openRows' => $openRows,
            'resolveRows' => $resolveRows,
            'provinceList' => $provinceList,
        ];

        session_start();
        if (
            $_SESSION['role'] == 'Superadmin' ||
            $_SESSION['role'] == 'NOC Ritel' ||
            $_SESSION['role'] == 'NOC Corpo' ||
            $_SESSION['role'] == 'Team Leader' ||
            $_SESSION['role'] == 'Helpdesk'
        ) {
            $this->load->view('navbar', $title);
            $this->load->view('report_shift_corporate', $data);
        } else {
            header('location: ./DashboardNoc');
        }
    }

    private function formatDuration($date)
    {
        if ($date === '') {
            return '-';
        }

        try {
            $start = new DateTime($date);
            $now = new DateTime();
            $diff = $start->diff($now);

            $days = (int)$diff->d;
            $hours = (int)$diff->h;
            $minutes = (int)$diff->i;

            return ($days > 0 ? $days . ' Hari ' : '') . $hours . ' Jam ' . $minutes . ' Menit';
        } catch (Exception $e) {
            return '-';
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
                                <th class="" scope="row">Tiket IKR :</th>
                                <td class="text-muted">'.$tiketnonbbmakassar.' Tiket</td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Tiket Belum Masuk SBU :</th>
                                <td class="text-muted">'.$belummasukmakassar.' Tiket</td>
                            </tr>';
                            foreach ($qm as $row){
                                $tanggalSekarang = new DateTime();
                                $durasi1 = new DateTime($row->downtime);
                                $selisih = $durasi1->diff($tanggalSekarang);
                                $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                if($row->tipe=="FTTH BACKBONE"){
                                    $v = "OLT TO UPLINK";
                                }elseif($row->tipe=="FTTH FEEDER"){
                                    $v = "FDT TO OLT";
                                }else{
                                    $v = "FAT TO FDT";
                                }
                                echo '
                                 <tr>
                                    <th class="" scope="row">'.$row->idOlt.' '.$row->gangguan.':</th>
                                    <td class="text-muted">'.$row->jumlahTiket.' Tiket ('.$durasi.')</td>
                                </tr>
                                 <tr>
                                    <th class="" scope="row">Impact :</th>
                                    <td class="text-muted">'.$v.'</td>
                                </tr>
                                <tr>
                                    <th class="" scope="row">Status :</th>
                                    <td class="text-muted">'.$row->status.'</td>
                                </tr>
                                <tr>
                                    <th class="" scope="row">Estimasi UP :</th>
                                    <td class="text-muted"></td>
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
                                <th class="" scope="row">Tiket IKR :</th>
                                <td class="text-muted">'.$tiketnonbbkendari.' Tiket</td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Tiket Belum Masuk SBU :</th>
                                <td class="text-muted">'.$belummasukkendari.' Tiket</td>
                            </tr>';
                            foreach ($qk as $row){
                                $tanggalSekarang = new DateTime();
                                $durasi1 = new DateTime($row->downtime);
                                $selisih = $durasi1->diff($tanggalSekarang);
                                $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                if($row->tipe=="FTTH BACKBONE"){
                                    $v = "OLT TO UPLINK";
                                }elseif($row->tipe=="FTTH FEEDER"){
                                    $v = "FDT TO OLT";
                                }else{
                                    $v = "FAT TO FDT";
                                }
                                echo '
                                 <tr>
                                    <th class="" scope="row">'.$row->idOlt.' '.$row->gangguan.':</th>
                                    <td class="text-muted">'.$row->jumlahTiket.' Tiket ('.$durasi.')</td>
                                </tr>
                                 <tr>
                                    <th class="" scope="row">Impact :</th>
                                    <td class="text-muted">'.$v.'</td>
                                </tr>
                                <tr>
                                    <th class="" scope="row">Status :</th>
                                    <td class="text-muted">'.$row->status.'</td>
                                </tr>
                                <tr>
                                    <th class="" scope="row">Estimasi UP :</th>
                                    <td class="text-muted"></td>
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
                                <th class="" scope="row">Tiket IKR :</th>
                                <td class="text-muted">'.$tiketnonbbmanado.' Tiket</td>
                            </tr>
                            <tr>
                                <th class="" scope="row">Tiket Belum Masuk SBU :</th>
                                <td class="text-muted">'.$belummasukmanado.' Tiket</td>
                            </tr>';
                            foreach ($qn as $row){
                                $tanggalSekarang = new DateTime();
                                $durasi1 = new DateTime($row->downtime);
                                $selisih = $durasi1->diff($tanggalSekarang);
                                $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                if($row->tipe=="FTTH BACKBONE"){
                                    $v = "OLT TO UPLINK";
                                }elseif($row->tipe=="FTTH FEEDER"){
                                    $v = "FDT TO OLT";
                                }else{
                                    $v = "FAT TO FDT";
                                }
                                echo '
                                 <tr>
                                    <th class="" scope="row">'.$row->idOlt.' '.$row->gangguan.':</th>
                                    <td class="text-muted">'.$row->jumlahTiket.' Tiket ('.$durasi.')</td>
                                </tr>
                                 <tr>
                                    <th class="" scope="row">Impact :</th>
                                    <td class="text-muted">'.$v.'</td>
                                </tr>
                                <tr>
                                    <th class="" scope="row">Status :</th>
                                    <td class="text-muted">'.$row->status.'</td>
                                </tr>
                                <tr>
                                    <th class="" scope="row">Estimasi UP :</th>
                                    <td class="text-muted"></td>
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
