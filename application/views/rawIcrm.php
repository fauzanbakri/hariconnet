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
                                <h4 class="mb-sm-0">RAW ICRM</h4>

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
                        <div class="card">
                        <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#MakassarPage" role="tab">
                                                <i class="fas fa-home"></i> Makassar
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#MamujuPage" role="tab">
                                                <i class="far fa-user"></i> Mamuju
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#PaluPage" role="tab">
                                                <i class="far fa-envelope"></i> Palu
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#KendariPage" role="tab">
                                                <i class="far fa-envelope"></i> Kendari
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#GorontaloPage" role="tab">
                                                <i class="far fa-envelope"></i> Gorontalo
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#ManadoPage" role="tab">
                                                <i class="far fa-envelope"></i> Manado
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <div class="tab-pane active" id="MakassarPage" role="tabpanel">
                                <div class="table-responsive">
                                    <h5 class="mb-sm-4 mt-sm-4">PENCAPAIAN MTTR RITEL MAKASSAR – PER KABUPATEN</h5>
                                    <table class="table table-nowrap table-striped-columns mb-0">
                                        <thead class="table-primary">
                                        <tr>
                                            <th rowspan="2">Kabupaten/Kota</th>
                                            <th colspan="2">Januari</th>
                                            <th colspan="2">Februari</th>
                                            <th colspan="2">Maret</th>
                                            <th colspan="2">April</th>
                                            <th colspan="2">Mei</th>
                                            <th colspan="2">Juni</th>
                                            <th colspan="2">Juli</th>
                                            <th colspan="2">Agustus</th>
                                            <th colspan="2">September</th>
                                            <th colspan="2">Oktober</th>
                                            <th colspan="2">November</th>
                                            <th colspan="2">Desember</th>
                                            <th rowspan="2" class="highlight">Total Insiden</th>
                                            <th rowspan="2" class="highlight">MTTR</th>
                                        </tr>
                                        <tr>
                                            <th>Insiden</th><th>MTTR</th>
                                            <th>Insiden</th><th>MTTR</th>
                                            <th>Insiden</th><th>MTTR</th>
                                            <th>Insiden</th><th>MTTR</th>
                                            <th>Insiden</th><th>MTTR</th>
                                            <th>Insiden</th><th>MTTR</th>
                                            <th>Insiden</th><th>MTTR</th>
                                            <th>Insiden</th><th>MTTR</th>
                                            <th>Insiden</th><th>MTTR</th>
                                            <th>Insiden</th><th>MTTR</th>
                                            <th>Insiden</th><th>MTTR</th>
                                            <th>Insiden</th><th>MTTR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($makassar as $row){
                                                echo '
                                                <tr>
                                                    <td>'.$row->kabupatenpelanggan.'</td>
                                                    <td>'.$row->total_jan.'</td><td>'.$row->percentage_less_1_day_jan.'%</td>
                                                    <td>'.$row->total_feb.'</td><td>'.$row->percentage_less_1_day_feb.'%</td>
                                                    <td>'.$row->total_mar.'</td><td>'.$row->percentage_less_1_day_mar.'%</td>
                                                    <td>'.$row->total_apr.'</td><td>'.$row->percentage_less_1_day_apr.'%</td>
                                                    <td>'.$row->total_may.'</td><td>'.$row->percentage_less_1_day_may.'%</td>
                                                    <td>'.$row->total_jun.'</td><td>'.$row->percentage_less_1_day_jun.'%</td>
                                                    <td>'.$row->total_jul.'</td><td>'.$row->percentage_less_1_day_jul.'%</td>
                                                    <td>'.$row->total_aug.'</td><td>'.$row->percentage_less_1_day_aug.'%</td>
                                                    <td>'.$row->total_sep.'</td><td>'.$row->percentage_less_1_day_sep.'%</td>
                                                    <td>'.$row->total_oct.'</td><td>'.$row->percentage_less_1_day_oct.'%</td>
                                                    <td>'.$row->total_nov.'</td><td>'.$row->percentage_less_1_day_nov.'%</td>
                                                    <td>'.$row->total_dec.'</td><td>'.$row->percentage_less_1_day_dec.'%</td>
                                                    <td class="highlight">'.$row->total_semua_bulan.'</td>
                                                    <td class="highlight">'.$row->percentage_less_1_day_semua_bulan.'%</td>
                                                </tr>
                                                ';
                                            }
                                        ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                            <script>document.write(new Date().getFullYear())</script> © Velzon.
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
</body>
</html>