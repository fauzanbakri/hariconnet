<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardCs extends CI_Controller {
	public function index()
	{
		$title['title']="Dashboard CS";
		session_start();
		if(isset($_SESSION['role'])){
			if(
				$_SESSION['role']=='Superadmin' || 
				$_SESSION['role']=='NOC Ritel' || 
				$_SESSION['role']=='Team Leader' || 
				$_SESSION['role']=='Pemeliharaan Ritel' || 
				$_SESSION['role']=='Resepsionis' 
				){
				$this->load->view('navbar', $title);
				$this->load->view('dashboardCs');
			}else{
				header('location: ./DashboardNoc');
			}
		}else{
			header('location: Login');

		}
	}
	public function hardcomplain()
	{
		$id = $this->input->get('id');
		$q = $this->db->query("UPDATE tiket SET prioritas='High' WHERE idTiket='$id'");
		if($q){
			echo 'success';
		}else{
			$error = $this->db->error();
			echo $error['message'];
		}	
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
				if ($row["urutan"]==0){
					$ke = "Belum Ada Tim";
					$antrian = "Belum Ada Estimasi";
				}else{
					$ke = $row["urutan"];
					if ($row["urutan"]/$estimasihari<2){
						$antrian = "Hari Ini";
					}else{
						$calc = intval($row["urutan"]/$estimasihari)-1;
						$antrian = $calc." Hari";
					}
				}

				
				echo '
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title mb-3 flex">Detail</h5>
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <button id="hardcomplain" type="button" data-id="'.$row["idInsiden"].'" class="btn rounded-pill btn-danger waves-effect waves-light">Hard Complain</button>
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
                                <th class="ps-0" scope="row">SID :</th>
                                <td class="text-muted">'.$row["sid"].'
                                </td>
                            </tr>
							<tr>
                                <th class="ps-0" scope="row">Alamat :</th>
                                <td class="text-muted">'.$row["alamat"].'</td>
                            </tr>
							<tr>
                                <th class="ps-0" scope="row">Kabupaten :</th>
                                <td class="text-muted">'.$row["kabupaten"].'</td>
                            </tr>
							<tr>
                                <th class="ps-0" scope="row">Tim :</th>
                                <td class="text-muted">'.$row["tim"].'</td>
                            </tr>
							
                            <tr>
                                <th class="ps-0" scope="row">Antrian ke :</th>
                                <td class="text-muted">'.$ke.'</td>
                            </tr>
							<tr>
                                <th class="ps-0" scope="row">Estimasi :</th>
                                <td class="text-muted">'.$antrian.'</td>
                            </tr>
							<tr>
                                <th class="ps-0" scope="row">Keterangan :</th>
                                <td class="text-muted">'.$row["keterangan"].'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
				<script>
					document.getElementById("hardcomplain") && document.getElementById("hardcomplain").addEventListener("click", function() {
						Swal.fire({
							title: "Are you sure?",
							text: "Ticket Priority Will Set to High!",
							icon: "warning",
							showCancelButton: !0,
							customClass: {
								confirmButton: "btn btn-primary w-xs me-2 mt-2",
								cancelButton: "btn btn-danger w-xs mt-2"
							},
							confirmButtonText: "Yes",
							buttonsStyling: !1,
							showCloseButton: !0
						}).then(function(t) {
							console.log(t.value);
							var response;
							if(t.value){
								$.ajax({
									url: "DashboardCs/hardcomplain?id='.$row["idTiket"].'",
									type: "GET",
									success: function(res) {
										console.log(res);
										if (res=="success"){
											Swal.fire({
												title: "Success!",
												text: "Priority Changed Successfully.",
												icon: "success",
												customClass: {
													confirmButton: "btn btn-primary w-xs mt-2"
												},
												buttonsStyling: !1
											}) 
										}else{
											Swal.fire({
												title: "Error!",
												text: "Unknown Error Occured.",
												icon: "warning",
												customClass: {
													confirmButton: "btn btn-primary w-xs mt-2"
												},
												buttonsStyling: !1
											})
										}
									}
								})
								
							}
						})
					})
				</script>
                ';
				break;
			}
		} else {
			echo "Data tidak ditemukan.";
		}
		// $q = $this->db->query("SELECT * FROM tiket WHERE $param LIKE '%$key%' LIMIT 1;")->result();
	}
}
