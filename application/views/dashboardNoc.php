        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Dashboard NOC</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">NOC</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-xxl-5">
                            <div class="d-flex flex-column h-100">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <a href="Tickets" class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Total Incident</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?php foreach($total as $row){echo $row->total;}?>"></span></h2>
                                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0"> Closed </span> <?php foreach($close as $row){echo $row->close;}?> Tickets</p>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i data-feather="users" class="text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
    </a><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <a href="OverSLA" class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Tiket Above 3 Days</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $sla[0]->sla;?>"></span></h2>
                                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">  Total </span> <?= $total[0]->total;?> Tickets</p>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i data-feather="ri-alert-line" class="text-info ri-alert-line"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                            </a> <!-- end card-->
                                    </div> <!-- end col-->
                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <a href="ListTeam" class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Tiket Impact Feeder</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $total_feeder[0]->total_feeder;?>"></span></h2>
                                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-2"> </span></p>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i class="text-info mdi mdi-account-hard-hat"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                    <!-- <div class="col-md-6">
                                        <div class="card card-animate">
                                            <a href="ListTeam" class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Total Team</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="//$total_tim[0]->total_tim;?>"></span></h2>
                                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-2"> </span></p>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i class="text-info mdi mdi-account-hard-hat"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            <!-- </a>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <a href="ListOlt" class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Total OLT</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $olt[0]->olt;?>"></span></h2>
                                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0"> </p>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i class="mdi mdi-router-network text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">Tiket by Month</h4>
                                            </div><!-- end card header -->
                                            <div class="card-body">
                                                <div id="tiketmonth" data-colors='["--vz-primary"]' class="apex-charts" dir="ltr"></div>
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div>
                                    <!-- end col -->
                                <!-- end col -->
                                </div> <!-- end row-->
                            </div>
                        </div> <!-- end col-->
                        <div class="col-xxl-7">
                            <div class="row h-100">
                                
                                <div class="col-xl-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Tiket by Kabupaten</h4>
                                        </div>
                                        <div class="card-body ">
                                            <div>
                                                <div id="kabupaten_chart" class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div> <!-- end col-->
                                <div class="col-xl-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Tiket by Tim</h4>
                                        </div>
                                        <div class="card-body p-0">
                                            <div>
                                                <div id="tim_chart" data-colors='["--vz-info", "--vz-info", "--vz-info", "--vz-info", "--vz-danger", "--vz-info", "--vz-info", "--vz-info", "--vz-info", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div> <!-- end col-->
                            </div> <!-- end row-->
                        </div><!-- end col -->
                    </div> <!-- end row-->
                        <!-- end col -->
                    <div class="row" hidden>
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Total Penangangan Gangguan Rekap </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                        </div>
                     </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Top 10 Aging Ticket</h4>
                                    <div class="flex-shrink-0">
                                        <a href="OverSLA" type="button" class="btn btn-soft-info btn-sm">
                                            <i class="ri-file-list-3-line align-middle"></i> All Over SLA
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th scope="col">Incident</th>
                                                    <th scope="col">Tim</th>
                                                    <th scope="col">Kabupaten</th>
                                                    <th scope="col">Durasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    date_default_timezone_set('Asia/Makassar');
                                                    $no = 1;
                                                    foreach ($top as $datas){
                                                        $tanggalSekarang = new DateTime();
                                                        $durasi1 = new DateTime($datas->tanggal);
                                                        $selisih = $durasi1->diff($tanggalSekarang);
                                                        $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                                        if ($selisih->d == 3 || $selisih->d == 4){
                                                            $class="badge bg-warning";
                                                        }else if ($selisih->d == 5 || $selisih->d == 6){
                                                            $class="badge bg-danger";
                                                        }else if ($selisih->d > 6){
                                                            $class="badge bg-dark";
                                                        }else{
                                                            $class="badge bg-info";
                                                        }
                                                        echo'
                                                        <tr>
                                                            <td>'.$no.'</td>
                                                            <td>'.$datas->idInsiden.'</td>
                                                            <td>'.$datas->tim.'</td>
                                                            <td>'.$datas->kabupaten.'</td>
                                                            <td><span class="'.$class.'">'.$durasi.'</span></span></td>
                                                        </tr>
                                                        ';
                                                        $no++;  
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Top 10 Aging Feeder</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th scope="col">Incident</th>
                                                    <th scope="col">Tipe</th>
                                                    <th scope="col">Tim</th>
                                                    <th scope="col">Deskripsi</th>
                                                    <th scope="col">Jumlah Tiket</th>
                                                    <th scope="col">Durasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    date_default_timezone_set('Asia/Makassar');
                                                    $no = 1;
                                                    foreach ($topf as $rows){
                                                        $tanggalSekarang = new DateTime();
                                                        $durasi1 = new DateTime($rows->downtime);
                                                        $selisih = $durasi1->diff($tanggalSekarang);
                                                        $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                                        if ($selisih->d == 3 || $selisih->d == 4){
                                                            $class="badge bg-warning";
                                                        }else if ($selisih->d == 5 || $selisih->d == 6){
                                                            $class="badge bg-danger";
                                                        }else if ($selisih->d > 6){
                                                            $class="badge bg-dark";
                                                        }else{
                                                            $class="badge bg-info";
                                                        }

                                                        if($rows->tipe=="FTTH BACKBONE"){
                                                            $a = '<span class="badge border border-danger text-danger">FTTH BACKBONE</span>';
                                                        }elseif($rows->tipe=="FTTH FEEDER"){
                                                            $a = '<span class="badge border border-warning text-warning">FTTH FEEDER</span>';
                                                        }else{
                                                            $a = '<span class="badge border border-info text-info">FTTH DISTRIBUSI</span>';
                                                        }
                                                        echo'
                                                        <tr>
                                                            <td>'.$no.'</td>
                                                            <td>'.$rows->idInsiden.'</td>
                                                            <td>'.$a.'</td>
                                                            <td>'.$rows->tim.'</td>
                                                            <td>'.$rows->idOlt.' '.$rows->gangguan.'</td>
                                                            <td>'.$rows->jumlahTiket.'</td>
                                                            <td><span class="'.$class.'">'.$durasi.'</span></span></td>
                                                        </tr>
                                                        ';
                                                        $no++;  
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                    </div>
                    <div class="row">
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Monthly Total Penangangan Gangguan SIBT</h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging2_" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Weekly Total Penangangan Gangguan SIBT</h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div>
                                        <label for="startDate">Start Date:</label>
                                        <input type="date" id="startDate" name="startDate">

                                        <label for="endDate">End Date:</label>
                                        <input type="date" id="endDate" name="endDate">

                                        <button class="btn btn-sm btn-primary" onclick="applyDateFilter()">Apply Filter</button>
                                    </div>
                                    <div id="chartaging_combined" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Monthly Total Penangangan Gangguan Makassar </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging_makassar_" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Weekly Total Penangangan Gangguan Makassar </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging_makassar" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Monthly Total Penangangan Gangguan Mamuju </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging_mamuju_" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Weekly Total Penangangan Gangguan Mamuju </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging_mamuju" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Monthly Total Penangangan Gangguan Palu </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging_palu_" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Weekly Total Penangangan Gangguan Palu </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging_palu" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Monthly Total Penangangan Gangguan Kendari </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging_kendari_" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Weekly Total Penangangan Gangguan Kendari </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging_kendari" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Monthly Total Penangangan Gangguan Gorontalo </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging_gorontalo_" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Weekly Total Penangangan Gangguan Gorontalo </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging_gorontalo" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Monthly Total Penangangan Gangguan Manado </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging_manado_" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="row">
                        <div class="card card-height-100">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Weekly Total Penangangan Gangguan Manado </h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartaging_manado" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © fauzanbakri.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    
    <!-- <script src="assets/js/plugins.js"></script> -->

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/apexcharts-line.init.js"></script>


    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-analytics.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script>
        window.onload = function() {
        var kabupatenData = <?php echo json_encode($data); ?>;
        var kabupaten = kabupatenData.map(function(item) {
        return item.kabupaten;
        }).filter(function(item) {
            return item !== null;
        });
        var count = kabupatenData.map(function(item) {
            return item.count;
        }).filter(function(item, index) {
            return kabupaten[index] !== null; 
        });
        // console.log(kabupaten); 
        // console.log(count);   
        var options = {
            series: [{
                name: "Jumlah Tiket",
                data: count 
            }],
            chart: {
                type: "bar",
                height: 700,
                toolbar: {
                    show: true
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 3,
                    horizontal: true, 
                    distributed: true,
                    dataLabels: {
                        position: "top"
                    }
                }
            },
            colors: ['#405189'],
            dataLabels: {
                enabled: true,
                offsetX: 32,
                style: {
                    fontSize: "12px",
                    fontWeight: 400,
                    colors: ["#adb5bd"]
                }
            },
            legend: {
                show: false
            },
            grid: {
                show: false
            },
            xaxis: {
                categories: kabupaten,
            }
        };
        var chart = new ApexCharts(document.querySelector("#kabupaten_chart"), options);
        chart.render();

        var timData = <?php echo json_encode($tim); ?>;
        var tim = timData.map(function(item) {
        return item.tim;
        }).filter(function(item) {
            return item !== null;
        });
        var count = timData.map(function(item) {
            return item.count;
        }).filter(function(item, index) {
            return tim[index] !== null; 
        });
        // console.log(tim); 
        // console.log(count);   
        var options = {
            series: [{
                name: "Jumlah Tiket",
                data: count 
            }],
            chart: {
                type: "bar",
                height: 700,
                toolbar: {
                    show: true
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 3,
                    horizontal: true, 
                    distributed: true,
                    dataLabels: {
                        position: "top"
                    }
                }
            },
            colors: ['#405189'],
            dataLabels: {
                enabled: true,
                offsetX: 32,
                style: {
                    fontSize: "12px",
                    fontWeight: 400,
                    colors: ["#adb5bd"]
                }
            },
            legend: {
                show: false
            },
            grid: {
                show: false
            },
            xaxis: {
                categories: tim,
            }
        };
        var chart = new ApexCharts(document.querySelector("#tim_chart"), options);
        chart.render();

        };      
    </script>
    <script>
        var queryResult = <?php echo json_encode($month); ?>;
        var ticketsData = queryResult.map(function(record) {
            var date = new Date(record.year, record.month - 1, 1).getTime();
            return { x: date, y: record.total_tiket };
        });
        var linechartBasicColors = getChartColorsArray("tiketmonth"),
            linechartZoomColors = (linechartBasicColors && (options = {
                series: [{
                    name: "Total Tiket",
                    data: ticketsData
                }],
                chart: {
                    height: 400,
                    type: "line",
                    zoom: {
                        enabled: true
                    },
                    toolbar: {
                        show: true
                    }
                },
                markers: {
                    size: 4
                },
                dataLabels: {
                    enabled: true
                },
                stroke: {
                    curve: "straight"
                },
                colors: linechartBasicColors,
                title: {
                    text: "Total Tiket by Month",
                    align: "left",
                    style: {
                        fontWeight: 500
                    }
                },
                xaxis: {
                    type: "datetime",
                    labels: {
                        formatter: function (value) {
                            return new Date(value).toLocaleString("default", { month: "short", year: "numeric" });
                        }
                    }
                }
            }, 
            (chart = new ApexCharts(document.querySelector("#tiketmonth"), options)).render()));
    </script>
    <script>
    // Data
    const target = 62;
    // const data1 = <?php //echo $datapercent; ?>; // Pastikan menggunakan json_encode
    // const options2 = {
    //   series: [
    //     {
    //       name: "Less than 1 Day (%)",
    //       data: data1.percent_more_than_1_day
    //     },
    //     {
    //       name: "More than 3 Days (%)",
    //       data: data1.percent_more_than_3_days
    //     }
    //   ],
    //   chart: {
    //     type: 'bar',
    //     height: 350
    //   },
    //   plotOptions: {
    //     bar: {
    //       horizontal: false,
    //       columnWidth: '20%',
    //       endingShape: 'rounded'
    //     },
    //   },
    //   colors: ['#4CAF50', '#F44336'], // Warna bar: Hijau untuk Less than 1 Day, Merah untuk More than 3 Days
    //   dataLabels: {
    //     enabled: false
    //   },
    //   stroke: {
    //     show: true,
    //     width: 2,
    //     colors: ['transparent']
    //   },
    //   xaxis: {
    //     categories: data1.categories
    //   },
    //   yaxis: {
    //     title: {
    //       text: 'Persentase (%)'
    //     }
    //   },
    //   fill: {
    //     opacity: 1
    //   },
    //   annotations: {
    //     yaxis: [
    //       {
    //         y: target,
    //         borderColor: '#FF0000',
    //         label: {
    //           borderColor: '#FF0000',
    //           style: {
    //             color: '#fff',
    //             background: '#FF0000'
    //           },
    //           text: `Target: ${target}%`
    //         }
    //       }
    //     ]
    //   },
    //   tooltip: {
    //     y: {
    //       formatter: function (val) {
    //         return val + "%";
    //       }
    //     }
    //   }
    // };

    // const chart2 = new ApexCharts(document.querySelector("#chartaging"), options2);
    // chart2.render();
</script>

<script>
    // Combine all data
    const datamks = <?php echo $datapercent_makassar; ?>;
    const datammj = <?php echo $datapercent_mamuju; ?>;
    const datapal = <?php echo $datapercent_palu; ?>;
    const datakdi = <?php echo $datapercent_kendari; ?>;
    const datagto = <?php echo $datapercent_gorontalo; ?>;
    const datamnd = <?php echo $datapercent_manado; ?>;
    console.log(<?php vardump($datapercent_makassar); ?>)
    // Combined series
    const combinedSeries = [
        {
            name: "Makassar - Less than 1 Day (%)",
            data: datamks.percent_more_than_1_day,
            color: '#347892'
        },
        {
            name: "Makassar - More than 3 Days (%)",
            data: datamks.percent_more_than_3_days,
            color: '#ffc107'
        },
        {
            name: "Mamuju - Less than 1 Day (%)",
            data: datammj.percent_more_than_1_day,
            color: '#28a745'
        },
        {
            name: "Mamuju - More than 3 Days (%)",
            data: datammj.percent_more_than_3_days,
            color: '#dc3545'
        },
        {
            name: "Palu - Less than 1 Day (%)",
            data: datapal.percent_more_than_1_day,
            color: '#007bff'
        },
        {
            name: "Palu - More than 3 Days (%)",
            data: datapal.percent_more_than_3_days,
            color: '#ffc107'
        },
        {
            name: "Kendari - Less than 1 Day (%)",
            data: datakdi.percent_more_than_1_day,
            color: '#6f42c1'
        },
        {
            name: "Kendari - More than 3 Days (%)",
            data: datakdi.percent_more_than_3_days,
            color: '#fd7e14'
        },
        {
            name: "Gorontalo - Less than 1 Day (%)",
            data: datagto.percent_more_than_1_day,
            color: '#6610f2'
        },
        {
            name: "Gorontalo - More than 3 Days (%)",
            data: datagto.percent_more_than_3_days,
            color: '#e83e8c'
        },
        {
            name: "Manado - Less than 1 Day (%)",
            data: datamnd.percent_more_than_1_day,
            color: '#20c997'
        },
        {
            name: "Manado - More than 3 Days (%)",
            data: datamnd.percent_more_than_3_days,
            color: '#fd3f43'
        }
    ];

    // Function to apply the date filter and update the chart
    function applyDateFilter() {
        const startDate = document.getElementById("startDate").value;
        const endDate = document.getElementById("endDate").value;

        if (!startDate || !endDate) {
            alert('Please select both start date and end date.');
            return;
        }

        // Convert the start and end dates to week numbers
        const startWeek = convertDateToWeek(startDate);
        const endWeek = convertDateToWeek(endDate);

        console.log('Start Week:', startWeek);
        console.log('End Week:', endWeek);

        // Filter data based on the week range
        const filteredData = filterDataByWeek(startWeek, endWeek);

        // Log the filtered data for debugging
        console.log('Filtered Data:', filteredData);
        console.log('Categories:', filteredData.categories);  // Check the filtered categories
        console.log('Makassar Data:', filteredData['makassar_-_less_than_1_day_%']);
        console.log('Mamuju Data:', filteredData['mamuju_-_less_than_1_day_%']);

        // If no data is found, alert the user
        if (filteredData.categories.length === 0) {
            alert("No data found for the selected week range.");
            return;
        }

        // Calculate the average data for SIBT
        const sibtData = calculateSIBT(filteredData);

        // Create the updated series for the chart
        const updatedSeries = createUpdatedSeries(filteredData, sibtData);

        // Update chart options and data
        chartCombined.updateOptions({
            series: updatedSeries,
            xaxis: {
                categories: filteredData.categories
            }
        });
    }

    // Calculate the average data for each week
    function calculateSIBT(filteredData) {
        const sibtData = [];
        const weeks = filteredData.categories;

        for (let i = 0; i < weeks.length; i++) {
            let sum = 0;
            let count = 0;

            // Sum up data for "Less than 1 Day (%)" and "More than 3 Days (%)" across all cities
            combinedSeries.forEach(series => {
                const dataKey = series.name.toLowerCase().replace(/ /g, "_");
                if (filteredData[dataKey] && filteredData[dataKey][i] !== undefined) {
                    sum += filteredData[dataKey][i];
                    count++;
                }
            });

            // Calculate average
            sibtData.push(sum / count);
        }

        return sibtData;
    }

    // Create the updated series for the chart
    function createUpdatedSeries(filteredData, sibtData) {
        return [
            {
                name: "Makassar - Less than 1 Day (%)",
                data: filteredData['makassar_-_less_than_1_day_%'] || [],
                color: '#347892'
            },
            {
                name: "Makassar - More than 3 Days (%)",
                data: filteredData['makassar_-_more_than_3_days_%'] || [],
                color: '#ffc107'
            },
            {
                name: "Mamuju - Less than 1 Day (%)",
                data: filteredData['mamuju_-_less_than_1_day_%'] || [],
                color: '#28a745'
            },
            {
                name: "Mamuju - More than 3 Days (%)",
                data: filteredData['mamuju_-_more_than_3_days_%'] || [],
                color: '#dc3545'
            },
            {
                name: "Palu - Less than 1 Day (%)",
                data: filteredData['palu_-_less_than_1_day_%'] || [],
                color: '#007bff'
            },
            {
                name: "Palu - More than 3 Days (%)",
                data: filteredData['palu_-_more_than_3_days_%'] || [],
                color: '#ffc107'
            },
            {
                name: "Kendari - Less than 1 Day (%)",
                data: filteredData['kendari_-_less_than_1_day_%'] || [],
                color: '#6f42c1'
            },
            {
                name: "Kendari - More than 3 Days (%)",
                data: filteredData['kendari_-_more_than_3_days_%'] || [],
                color: '#fd7e14'
            },
            {
                name: "Gorontalo - Less than 1 Day (%)",
                data: filteredData['gorontalo_-_less_than_1_day_%'] || [],
                color: '#6610f2'
            },
            {
                name: "Gorontalo - More than 3 Days (%)",
                data: filteredData['gorontalo_-_more_than_3_days_%'] || [],
                color: '#e83e8c'
            },
            {
                name: "Manado - Less than 1 Day (%)",
                data: filteredData['manado_-_less_than_1_day_%'] || [],
                color: '#20c997'
            },
            {
                name: "Manado - More than 3 Days (%)",
                data: filteredData['manado_-_more_than_3_days_%'] || [],
                color: '#fd3f43'
            },
            {
                name: "SIBT - Average (%)",
                data: sibtData,
                color: '#17a2b8'
            }
        ];
    }

    // Convert a date (yyyy-mm-dd) to a week number
    function convertDateToWeek(dateStr) {
        const date = new Date(dateStr);
        const startOfYear = new Date(date.getFullYear(), 0, 1);
        const daysPassed = Math.floor((date - startOfYear) / (24 * 60 * 60 * 1000));
        const weekNumber = Math.ceil((daysPassed + 1) / 7); // Week starts from 1
        return `Week ${weekNumber}`;
    }

    function filterDataByWeek(startWeek, endWeek) {
    const filteredCategories = [];
    const filteredData = {};

    // Inisialisasi filtered data untuk setiap kategori
    combinedSeries.forEach(series => {
        filteredData[series.name.toLowerCase().replace(/ /g, "_")] = [];
    });

    // Ekstrak nomor minggu dari kategori
    const startWeekNum = extractWeekNumber(startWeek);
    const endWeekNum = extractWeekNumber(endWeek);

    console.log("Start Week Num:", startWeekNum, "End Week Num:", endWeekNum);

    // Log seluruh kategori untuk memeriksa data sebelum filter
    console.log("Categories Before Filtering:", datamks.categories);

    for (let i = 0; i < datamks.categories.length; i++) {
        const categoryWeekNum = extractWeekNumber(datamks.categories[i]);

        console.log('Checking Category:', datamks.categories[i], 'Week Number:', categoryWeekNum);

        // Bandingkan minggu yang dipilih dengan minggu data
        if (categoryWeekNum >= startWeekNum && categoryWeekNum <= endWeekNum) {
            filteredCategories.push(datamks.categories[i]);

            console.log('Adding data for week:', datamks.categories[i]);
            
            // Menambahkan data untuk setiap kategori
            combinedSeries.forEach(series => {
                const dataKey = series.name.toLowerCase().replace(/ /g, "_");

                // Periksa apakah data ada, jika tidak, tambahkan 0
                if (datamks[dataKey] && datamks[dataKey][i] !== undefined) {
                    console.log(`Data for ${series.name} on Week ${datamks.categories[i]}:`, datamks[dataKey][i]);
                    filteredData[dataKey].push(datamks[dataKey][i]);
                } else {
                    console.log(`No data for ${series.name} on Week ${datamks.categories[i]}`);
                    filteredData[dataKey].push(0);  // Masukkan nilai 0 jika data tidak ada
                }
            });
        }
    }

    // Kembalikan data yang sudah difilter
    return {
        categories: filteredCategories,
        ...filteredData
    };
}



    // Function to extract the week number from a string like "Week 1", "Week 2", etc.
    function extractWeekNumber(weekLabel) {
        const match = weekLabel.match(/Week (\d+)/);
        return match ? parseInt(match[1]) : -1;  // Return -1 if no valid week number found
    }

    // Chart options
    const optionsCombined = {
        series: combinedSeries,
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '90%',
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: datamks.categories // Assuming all categories are the same across datasets
        },
        yaxis: {
            title: {
                text: 'Persentase (%)'
            },
            min: 0,
            max: 100,
        },
        fill: {
            opacity: 1
        },
        annotations: {
            yaxis: [
                {
                    y: target,
                    borderColor: '#f44336',
                    label: {
                        borderColor: '#f44336',
                        style: {
                            color: '#fff',
                            background: '#f44336'
                        },
                        text: `Target: ${target}%`
                    }
                }
            ]
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + "%";
                }
            }
        }
    };

    // Initialize the chart
    const chartCombined = new ApexCharts(document.querySelector("#chartaging_combined"), optionsCombined);
    chartCombined.render();
</script>

<!-- =================================MONTHLY================================== -->

<script>
const datasibt = <?php echo $monthlyall; ?>;
const optionssibt = {
  series: [
    {
      name: "Less than 1 Day (%)",
      data: datasibt.percent_more_than_1_day
    },
    {
      name: "More than 3 Days (%)",
      data: datasibt.percent_more_than_3_days
    }
  ],
  chart: {
    type: 'bar',
    height: 350
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '50%',
      endingShape: 'rounded'
    },
  },
  colors: ['#347892', '#ffc107', '#0f9d58', '#ff7043'],
  dataLabels: {
    enabled: true
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent', 'transparent', '#0f9d58', '#ff7043']
  },
  xaxis: {
    categories: datasibt.categories
  },
  yaxis: {
    title: {
      text: 'Persentase (%)'
    },
    min: 0,
    max: 100,
  },
  fill: {
    opacity: 1
  },
  annotations: {
    yaxis: [
      {
        y: target,
        borderColor: '#f44336',
        label: {
          borderColor: '#f44336',
          style: {
            color: '#fff',
            background: '#f44336'
          },
          text: `Target: ${target}%`
        }
      }
    ]
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return val + "%";
      }
    }
  }
};

const chartsibt = new ApexCharts(document.querySelector("#chartaging2_"), optionssibt);
chartsibt.render();
</script>

<script>
    // Data Makassar
    const datamks_ = <?php echo $monthlymks; ?>;
    const optionsmks_ = {
      series: [
        {
          name: "Less than 1 Day (%)",
          data: datamks_.percent_more_than_1_day
        },
        {
          name: "More than 3 Days (%)",
          data: datamks_.percent_more_than_3_days
        }
      ],
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '50%',
          endingShape: 'rounded'
        },
      },
      colors: ['#347892', '#ffc107'],
      dataLabels: {
        enabled: true
      },
      stroke: {
        show: true,
        width: 0,
        colors: ['transparent']
      },
      xaxis: {
        categories: datamks_.categories
      },
      yaxis: {
        title: {
          text: 'Persentase (%)'
        },
        min: 0,
        max: 100,
      },
      fill: {
        opacity: 1
      },
      annotations: {
        yaxis: [
          {
            y: target,
            borderColor: '#f44336',
            label: {
              borderColor: '#f44336',
              style: {
                color: '#fff',
                background: '#f44336'
              },
              text: `Target: ${target}%`
            }
          }
        ]
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + "%";
          }
        }
      }
    };

    const chartmks_ = new ApexCharts(document.querySelector("#chartaging_makassar_"), optionsmks_);
    chartmks_.render();
</script>

<script>
    // Data mamuju
    const datammj_ = <?php echo $monthlymmj; ?>;
    const optionsmmj_ = {
      series: [
        {
          name: "Less than 1 Day (%)",
          data: datammj_.percent_more_than_1_day
        },
        {
          name: "More than 3 Days (%)",
          data: datammj_.percent_more_than_3_days
        }
      ],
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '50%',
          endingShape: 'rounded'
        },
      },
      colors: ['#347892', '#ffc107'],
      dataLabels: {
        enabled: true
      },
      stroke: {
        show: true,
        width: 0,
        colors: ['transparent']
      },
      xaxis: {
        categories: datammj_.categories
      },
      yaxis: {
        title: {
          text: 'Persentase (%)'
        },
        min: 0,
        max: 100,
      },
      fill: {
        opacity: 1
      },
      annotations: {
        yaxis: [
          {
            y: target,
            borderColor: '#f44336',
            label: {
              borderColor: '#f44336',
              style: {
                color: '#fff',
                background: '#f44336'
              },
              text: `Target: ${target}%`
            }
          }
        ]
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + "%";
          }
        }
      }
    };

    const chartmmj_ = new ApexCharts(document.querySelector("#chartaging_mamuju_"), optionsmmj_);
    chartmmj_.render();
</script>

<script>
    // Data palu
    const datapal_ = <?php echo $monthlypal; ?>;
    const optionspal_ = {
      series: [
        {
          name: "Less than 1 Day (%)",
          data: datapal_.percent_more_than_1_day
        },
        {
          name: "More than 3 Days (%)",
          data: datapal_.percent_more_than_3_days
        }
      ],
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '50%',
          endingShape: 'rounded'
        },
      },
      colors: ['#347892', '#ffc107'],
      dataLabels: {
        enabled: true
      },
      stroke: {
        show: true,
        width: 0,
        colors: ['transparent']
      },
      xaxis: {
        categories: datapal_.categories
      },
      yaxis: {
        title: {
          text: 'Persentase (%)'
        },
        min: 0,
        max: 100,
      },
      fill: {
        opacity: 1
      },
      annotations: {
        yaxis: [
          {
            y: target,
            borderColor: '#f44336',
            label: {
              borderColor: '#f44336',
              style: {
                color: '#fff',
                background: '#f44336'
              },
              text: `Target: ${target}%`
            }
          }
        ]
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + "%";
          }
        }
      }
    };

    const chartpal_ = new ApexCharts(document.querySelector("#chartaging_palu_"), optionspal_);
    chartpal_.render();
</script>

<script>
    // Data kendari
    const datakdi_ = <?php echo $monthlykdi; ?>;
    const optionskdi_ = {
      series: [
        {
          name: "Less than 1 Day (%)",
          data: datakdi_.percent_more_than_1_day
        },
        {
          name: "More than 3 Days (%)",
          data: datakdi_.percent_more_than_3_days
        }
      ],
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '50%',
          endingShape: 'rounded'
        },
      },
      colors: ['#347892', '#ffc107'],
      dataLabels: {
        enabled: true
      },
      stroke: {
        show: true,
        width: 0,
        colors: ['transparent']
      },
      xaxis: {
        categories: datakdi_.categories
      },
      yaxis: {
        title: {
          text: 'Persentase (%)'
        },
        min: 0,
        max: 100,
      },
      fill: {
        opacity: 1
      },
      annotations: {
        yaxis: [
          {
            y: target,
            borderColor: '#f44336',
            label: {
              borderColor: '#f44336',
              style: {
                color: '#fff',
                background: '#f44336'
              },
              text: `Target: ${target}%`
            }
          }
        ]
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + "%";
          }
        }
      }
    };

    const chartkdi_ = new ApexCharts(document.querySelector("#chartaging_kendari_"), optionskdi_);
    chartkdi_.render();
</script>
<script>
    // Data gorontalo
    const datagto_ = <?php echo $monthlygto; ?>;
    const optionsgto_ = {
      series: [
        {
          name: "Less than 1 Day (%)",
          data: datagto_.percent_more_than_1_day
        },
        {
          name: "More than 3 Days (%)",
          data: datagto_.percent_more_than_3_days
        }
      ],
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '50%',
          endingShape: 'rounded'
        },
      },
      colors: ['#347892', '#ffc107'],
      dataLabels: {
        enabled: true
      },
      stroke: {
        show: true,
        width: 0,
        colors: ['transparent']
      },
      xaxis: {
        categories: datagto_.categories
      },
      yaxis: {
        title: {
          text: 'Persentase (%)'
        },
        min: 0,
        max: 100,
      },
      fill: {
        opacity: 1
      },
      annotations: {
        yaxis: [
          {
            y: target,
            borderColor: '#f44336',
            label: {
              borderColor: '#f44336',
              style: {
                color: '#fff',
                background: '#f44336'
              },
              text: `Target: ${target}%`
            }
          }
        ]
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + "%";
          }
        }
      }
    };

    const chartgto_ = new ApexCharts(document.querySelector("#chartaging_gorontalo_"), optionsgto_);
    chartgto_.render();
</script>
<script>
    // Data manado
    const datamnd_ = <?php echo $monthlymnd; ?>;
    const optionsmnd_ = {
      series: [
        {
          name: "Less than 1 Day (%)",
          data: datamnd_.percent_more_than_1_day
        },
        {
          name: "More than 3 Days (%)",
          data: datamnd_.percent_more_than_3_days
        }
      ],
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '50%',
          endingShape: 'rounded'
        },
      },
      colors: ['#347892', '#ffc107'],
      dataLabels: {
        enabled: true
      },
      stroke: {
        show: true,
        width: 0,
        colors: ['transparent']
      },
      xaxis: {
        categories: datamnd_.categories
      },
      yaxis: {
        title: {
          text: 'Persentase (%)'
        },
        min: 0,
        max: 100,
      },
      fill: {
        opacity: 1
      },
      annotations: {
        yaxis: [
          {
            y: target,
            borderColor: '#f44336',
            label: {
              borderColor: '#f44336',
              style: {
                color: '#fff',
                background: '#f44336'
              },
              text: `Target: ${target}%`
            }
          }
        ]
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + "%";
          }
        }
      }
    };

    const chartmnd_ = new ApexCharts(document.querySelector("#chartaging_manado_"), optionsmnd_);
    chartmnd_.render();
</script>
</body>
</html>