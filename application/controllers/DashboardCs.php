<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardCs extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('navbar');
		$this->load->view('dashboardCs');
	}
	public function search(){
		$estimasihari = 3;
		$param = $this->input->post('param');
		$key = $this->input->post('key');
		$q = $this->db->query("
			SELECT 
			prioritas,
			idInsiden,
			idTiket,
			tanggal,
			olt.idOlt,
			sid,
			nama,
			alamat,
			telepon,
			sn,
			status,
			keluhan,
			keterangan,
			kabupaten,
			provinsi,
			tim,
			createby,
			timestamp,
			@urutan := IF(
				status IN ('closed', 'Solved (ICRM Open)') OR tim = 'NO TIM', 
				0, 
				IF(@grup = tim, @urutan + 1, 1)
			) AS urutan,
			@grup := tim
		FROM 
			tiket
		LEFT JOIN 
			olt ON olt.idOlt = tiket.idOlt
		CROSS JOIN 
			(SELECT @urutan := 0, @grup := '') AS vars
		ORDER BY 
			tim, prioritas, tanggal ASC;
		")->result_array();
		$filteredData = array_filter($q, function($item) use ($param, $key) {
			return isset($item[$param]) && stripos($item[$param], $key) !== false;
		});

		if (!empty($filteredData)) {
			foreach ($filteredData as $row) {
				// echo $row['idInsiden'] . ' - ' . $row['nama'] . ' - ' . $row['urutan'] . "<br>";
				if ($row["urutan"]/$estimasihari<2){
					$antrian = "Hari Ini";
				}else{
					$calc = intval($row["urutan"]/$estimasihari)-1;
					$antrian = $calc." Hari";
				}
				echo '
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title mb-3 flex">Detail</h5>
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <button type="button" data-id="'.$row["idInsiden"].'" class="btn rounded-pill btn-danger waves-effect waves-light">Hard Complaint</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0" id="detail">
                        <tbody>
                            <tr>
                                <th class="ps-0" scope="row">Nama User :</th>
                                <td class="text-muted">'.$row["nama"].'</td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">No Telepon :</th>
                                <td class="text-muted">'.$row["telepon"].'</td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">Alamat :</th>
                                <td class="text-muted">'.$row["alamat"].'</td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">SID :</th>
                                <td class="text-muted">'.$row["sid"].'
                                </td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">Antrian ke</th>
                                <td class="text-muted">'.$row["urutan"].'</td>
                            </tr>
							<tr>
                                <th class="ps-0" scope="row">Estimasi</th>
                                <td class="text-muted">'.$antrian.'</td>
                            </tr>
							<tr>
                                <th class="ps-0" scope="row">Keterangan</th>
                                <td class="text-muted">'.$row["keterangan"].'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                ';
				break;
			}
		} else {
			echo "Data tidak ditemukan.";
		}
		// $q = $this->db->query("SELECT * FROM tiket WHERE $param LIKE '%$key%' LIMIT 1;")->result();
	}
}
