
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <!-- Tab panes -->
                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                        <div class="row">
                                            <!--end col-->
                                            <div class="col-xxl-12">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">  
                                                            <div class="card-header align-items-center d-flex">
                                                                <h4 class="card-title mb-0  me-2">Report</h4>
                                                                <div class="flex-shrink-0 ms-auto">
                                                                    <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" data-bs-toggle="tab" href="#makassar" role="tab">
                                                                                Report Hourly
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="tab-content text-muted">
                                                                    <div class="tab-pane active" id="makassar" role="tabpanel">
                                                                        TOP 3 HIGHLIGHT INSIDEN SBU SIBT <br>
                                                                        Tgl : 18 Maret 2025 <br>
                                                                        Pukul : 09:05 WITA <br>
                                                                        ⚠️ : Insiden Open <br>
                                                                        ✅ : Insiden Closed <br> <br>

                                                                        INSIDEN RITEL TIKET TERBANYAK MAKASSAR:   <br><br>
                                                                        <?php
                                                                        $tanggalSekarang = new DateTime();
                                                                        $no=1;
                                                                        foreach ($terbanyak_makassar as $row){
                                                                            if(count($terbanyak_makassar) > 0){
                                                                                if(!empty($row->idInsiden)){
                                                                                    $durasi1 = new DateTime($row->downtime);
                                                                                    $selisih = $durasi1->diff($tanggalSekarang);
                                                                                    $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                                                                    echo $no.'. '.$row->idInsiden.' ⚠<br>'.
                                                                                    '* '.$row->idOlt.' '.$row->gangguan.'<br>'.
                                                                                    '* tiket impact : '.$row->jumlahTiket.' tiket<br>'.
                                                                                    '* aging : '. $durasi.'<br>'.                                                                            
                                                                                    '* posisi tiket : <input name="mitra[]"><br>'.
                                                                                    '* update :  <input name="update[]"><br><br>';
                                                                                    $no=$no+1;
                                                                                }else{
                                                                                    echo 'NIHIL';
                                                                                }
                                                                            }else{
                                                                                echo 'NIHIL';
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <br><br>
                                                                        INSIDEN RITEL TIKET TERBANYAK MAMUJU:   <br><br>
                                                                        <?php
                                                                        $tanggalSekarang = new DateTime();
                                                                        $no=1;
                                                                        foreach ($terbanyak_mamuju as $row){
                                                                            if(count($terbanyak_mamuju) > 0){
                                                                                if(!empty($row->idInsiden)){
                                                                                    $durasi1 = new DateTime($row->downtime);
                                                                                    $selisih = $durasi1->diff($tanggalSekarang);
                                                                                    $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                                                                    echo $no.'. '.$row->idInsiden.' ⚠<br>'.
                                                                                    '* '.$row->idOlt.' '.$row->gangguan.'<br>'.
                                                                                    '* tiket impact : '.$row->jumlahTiket.' tiket<br>'.
                                                                                    '* aging : '. $durasi.'<br>'.                                                                            
                                                                                    '* posisi tiket : <input name="mitra[]"><br>'.
                                                                                    '* update :  <input name="update[]"><br><br>';
                                                                                    $no=$no+1;
                                                                                }else{
                                                                                    echo 'NIHIL';
                                                                                }
                                                                            }else{
                                                                                echo 'NIHIL';
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <br><br>
                                                                        INSIDEN RITEL TIKET TERBANYAK PALU:   <br><br>
                                                                        <?php
                                                                        $tanggalSekarang = new DateTime();
                                                                        $no=1;
                                                                        if(count($terbanyak_palu) > 0){
                                                                            if(!empty($row)){
                                                                                if(!empty($row->idInsiden)){
                                                                                    $durasi1 = new DateTime($row->downtime);
                                                                                    $selisih = $durasi1->diff($tanggalSekarang);
                                                                                    $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                                                                    echo $no.'. '.$row->idInsiden.' ⚠<br>'.
                                                                                    '* '.$row->idOlt.' '.$row->gangguan.'<br>'.
                                                                                    '* tiket impact : '.$row->jumlahTiket.' tiket<br>'.
                                                                                    '* aging : '. $durasi.'<br>'.                                                                            
                                                                                    '* posisi tiket : <input name="mitra[]"><br>'.
                                                                                    '* update :  <input name="update[]"><br><br>';
                                                                                    $no=$no+1;
                                                                                }else{
                                                                                    echo 'NIHIL';
                                                                                }
                                                                            }else{
                                                                                echo 'NIHIL';
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <br><br>
                                                                        INSIDEN RITEL TIKET TERBANYAK KENDARI:   <br><br>
                                                                        <?php
                                                                        $tanggalSekarang = new DateTime();
                                                                        $no=1;
                                                                        foreach ($terbanyak_kendari as $row){
                                                                            if(count($terbanyak_kendari) > 0){
                                                                                if(!empty($row->idInsiden)){
                                                                                    $durasi1 = new DateTime($row->downtime);
                                                                                    $selisih = $durasi1->diff($tanggalSekarang);
                                                                                    $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                                                                    echo $no.'. '.$row->idInsiden.' ⚠<br>'.
                                                                                    '* '.$row->idOlt.' '.$row->gangguan.'<br>'.
                                                                                    '* tiket impact : '.$row->jumlahTiket.' tiket<br>'.
                                                                                    '* aging : '. $durasi.'<br>'.                                                                            
                                                                                    '* posisi tiket : <input name="mitra[]"><br>'.
                                                                                    '* update :  <input name="update[]"><br><br>';
                                                                                    $no=$no+1;
                                                                                }else{
                                                                                    echo 'NIHIL';
                                                                                }
                                                                            }else{
                                                                                echo 'NIHIL';
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <br><br>
                                                                        INSIDEN RITEL TIKET TERBANYAK GORONTALO:   <br><br>
                                                                        <?php
                                                                        $tanggalSekarang = new DateTime();
                                                                        $no=1;
                                                                        foreach ($terbanyak_gorontalo as $row){
                                                                            if(count($terbanyak_gorontalo) > 0){
                                                                                if(!empty($row->idInsiden)){
                                                                                    $durasi1 = new DateTime($row->downtime);
                                                                                    $selisih = $durasi1->diff($tanggalSekarang);
                                                                                    $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                                                                    echo $no.'. '.$row->idInsiden.' ⚠<br>'.
                                                                                    '* '.$row->idOlt.' '.$row->gangguan.'<br>'.
                                                                                    '* tiket impact : '.$row->jumlahTiket.' tiket<br>'.
                                                                                    '* aging : '. $durasi.'<br>'.                                                                            
                                                                                    '* posisi tiket : <input name="mitra[]"><br>'.
                                                                                    '* update :  <input name="update[]"><br><br>';
                                                                                    $no=$no+1;
                                                                                }else{
                                                                                    echo 'NIHIL';
                                                                                }
                                                                            }else{
                                                                                echo 'NIHIL';
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <br><br>
                                                                        INSIDEN RITEL TIKET TERBANYAK MANADO:   <br><br>
                                                                        <?php
                                                                        echo count($terbanyak_mamuju);
                                                                        $tanggalSekarang = new DateTime();
                                                                        $no=1;
                                                                        foreach ($terbanyak_manado as $row){
                                                                            if(count($terbanyak_manado) > 0){
                                                                                if(!empty($row->idInsiden)){
                                                                                    $durasi1 = new DateTime($row->downtime);
                                                                                    $selisih = $durasi1->diff($tanggalSekarang);
                                                                                    $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                                                                    echo $no.'. '.$row->idInsiden.' ⚠<br>'.
                                                                                    '* '.$row->idOlt.' '.$row->gangguan.'<br>'.
                                                                                    '* tiket impact : '.$row->jumlahTiket.' tiket<br>'.
                                                                                    '* aging : '. $durasi.'<br>'.                                                                            
                                                                                    '* posisi tiket : <input name="mitra[]"><br>'.
                                                                                    '* update :  <input name="update[]"><br><br>';
                                                                                    $no=$no+1;
                                                                                }else{
                                                                                    echo 'NIHIL';
                                                                                }
                                                                            }else{
                                                                                echo 'NIHIL';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end card body -->
                                                        </div><!-- end card -->
                                                    </div><!-- end col -->
                                                </div><!-- end row -->
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <div class="tab-pane fade" id="activities" role="tabpanel">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">Activities</h5>
                                                <div class="acitivity-timeline">
                                                    <div class="acitivity-item d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Oliver Phillips <span class="badge bg-primary-subtle text-primary align-middle">New</span></h6>
                                                            <p class="text-muted mb-2">We talked about a project on linkedin.</p>
                                                            <small class="mb-0 text-muted">Today</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                            <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                                                N
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Nancy Martino <span class="badge bg-secondary-subtle text-secondary align-middle">In Progress</span></h6>
                                                            <p class="text-muted mb-2"><i class="ri-file-text-line align-middle ms-2"></i> Create new project Buildng product</p>
                                                            <div class="avatar-group mb-2">
                                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Christi">
                                                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs" />
                                                                </a>
                                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Frank Hook">
                                                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xs" />
                                                                </a>
                                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title=" Ruby">
                                                                    <div class="avatar-xs">
                                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                                            R
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="more">
                                                                    <div class="avatar-xs">
                                                                        <div class="avatar-title rounded-circle">
                                                                            2+
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <small class="mb-0 text-muted">Yesterday</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Natasha Carey <span class="badge bg-success-subtle text-success align-middle">Completed</span>
                                                            </h6>
                                                            <p class="text-muted mb-2">Adding a new event with attachments</p>
                                                            <div class="row">
                                                                <div class="col-xxl-4">
                                                                    <div class="row border border-dashed gx-2 p-2 mb-2">
                                                                        <div class="col-4">
                                                                            <img src="assets/images/small/img-2.jpg" alt="" class="img-fluid rounded" />
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-4">
                                                                            <img src="assets/images/small/img-3.jpg" alt="" class="img-fluid rounded" />
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-4">
                                                                            <img src="assets/images/small/img-4.jpg" alt="" class="img-fluid rounded" />
                                                                        </div>
                                                                        <!--end col-->
                                                                    </div>
                                                                    <!--end row-->
                                                                </div>
                                                            </div>
                                                            <small class="mb-0 text-muted">25 Nov</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Bethany Johnson</h6>
                                                            <p class="text-muted mb-2">added a new member to velzon dashboard</p>
                                                            <small class="mb-0 text-muted">19 Nov</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xs acitivity-avatar">
                                                                <div class="avatar-title rounded-circle bg-danger-subtle text-danger">
                                                                    <i class="ri-shopping-bag-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Your order is placed <span class="badge bg-danger-subtle text-danger align-middle ms-1">Out of Delivery</span></h6>
                                                            <p class="text-muted mb-2">These customers can rest assured their order has been placed.</p>
                                                            <small class="mb-0 text-muted">16 Nov</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Lewis Pratt</h6>
                                                            <p class="text-muted mb-2">They all have something to say
                                                                beyond the words on the page. They can come across as
                                                                casual or neutral, exotic or graphic. </p>
                                                            <small class="mb-0 text-muted">22 Oct</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xs acitivity-avatar">
                                                                <div class="avatar-title rounded-circle bg-info-subtle text-info">
                                                                    <i class="ri-line-chart-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Monthly sales report</h6>
                                                            <p class="text-muted mb-2">
  																<span class="text-danger">2 days left</span> notification to submit the monthly sales report. <a href="javascript:void(0);" class="link-warning text-decoration-underline">Reports Builder</a>
                                                            </p>
                                                            <small class="mb-0 text-muted">15 Oct</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-8.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">New ticket received <span class="badge bg-success-subtle text-success align-middle">Completed</span></h6>
                                                            <p class="text-muted mb-2">User <span class="text-secondary">Erica245</span> submitted a ticket.</p>
                                                            <small class="mb-0 text-muted">26 Aug</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end card-body-->
                                        </div>
                                        <!--end card-->
                                    </div>
                                    <!--end tab-pane-->
                                    <div class="tab-pane fade" id="projects" role="tabpanel">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="card profile-project-card shadow-none profile-project-warning">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex">
                                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Chat App Update</a></h5>
                                                                        <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">2 year Ago</span></p>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-2">
                                                                        <div class="badge bg-warning-subtle text-warning fs-10">Inprogress</div>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-grow-1">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div>
                                                                                <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                                            </div>
                                                                            <div class="avatar-group">
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                                                            J
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                        </div>
                                                        <!-- end card -->
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="card profile-project-card shadow-none profile-project-success">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex">
                                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">ABC Project Customization</a></h5>
                                                                        <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">2 month Ago</span></p>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-2">
                                                                        <div class="badge bg-primary-subtle text-primary fs-10"> Progress</div>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-grow-1">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div>
                                                                                <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                                            </div>
                                                                            <div class="avatar-group">
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <div class="avatar-title rounded-circle bg-primary">
                                                                                            2+
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                        </div>
                                                        <!-- end card -->
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="card profile-project-card shadow-none profile-project-info">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex">
                                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Client - Frank Hook</a></h5>
                                                                        <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">1 hr Ago</span></p>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-2">
                                                                        <div class="badge bg-info-subtle text-info fs-10">New</div>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-grow-1">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div>
                                                                                <h5 class="fs-12 text-muted mb-0"> Members :</h5>
                                                                            </div>
                                                                            <div class="avatar-group">
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                                                            M
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                        </div>
                                                        <!-- end card -->
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="card profile-project-card shadow-none profile-project-primary">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex">
                                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Velzon Project</a></h5>
                                                                        <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">11 hr Ago</span></p>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-2">
                                                                        <div class="badge bg-success-subtle text-success fs-10">Completed</div>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-grow-1">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div>
                                                                                <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                                            </div>
                                                                            <div class="avatar-group">
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                        </div>
                                                        <!-- end card -->
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="card profile-project-card shadow-none profile-project-danger">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex">
                                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Brand Logo Design</a></h5>
                                                                        <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">10 min Ago</span></p>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-2">
                                                                        <div class="badge bg-info-subtle text-info fs-10">New</div>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-grow-1">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div>
                                                                                <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                                            </div>
                                                                            <div class="avatar-group">
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                                                            E
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                        </div>
                                                        <!-- end card -->
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="card profile-project-card shadow-none profile-project-primary">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex">
                                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Chat App</a></h5>
                                                                        <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">8 hr Ago</span></p>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-2">
                                                                        <div class="badge bg-warning-subtle text-warning fs-10">Inprogress</div>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-grow-1">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div>
                                                                                <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                                            </div>
                                                                            <div class="avatar-group">
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                                                            R
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                        </div>
                                                        <!-- end card -->
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="card profile-project-card shadow-none profile-project-warning">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex">
                                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Project Update</a></h5>
                                                                        <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">48 min Ago</span></p>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-2">
                                                                        <div class="badge bg-warning-subtle text-warning fs-10">Inprogress</div>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-grow-1">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div>
                                                                                <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                                            </div>
                                                                            <div class="avatar-group">
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                        </div>
                                                        <!-- end card -->
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="card profile-project-card shadow-none profile-project-success">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex">
                                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Client - Jennifer</a></h5>
                                                                        <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">30 min Ago</span></p>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-2">
                                                                        <div class="badge bg-primary-subtle text-primary fs-10">Process</div>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-grow-1">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div>
                                                                                <h5 class="fs-12 text-muted mb-0"> Members :</h5>
                                                                            </div>
                                                                            <div class="avatar-group">
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                        </div>
                                                        <!-- end card -->
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="card profile-project-card shadow-none mb-xxl-0 profile-project-info">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex">
                                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Bsuiness Template - UI/UX design</a></h5>
                                                                        <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">7 month Ago</span></p>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-2">
                                                                        <div class="badge bg-success-subtle text-success fs-10">Completed</div>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-grow-1">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div>
                                                                                <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                                            </div>
                                                                            <div class="avatar-group">
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <div class="avatar-title rounded-circle bg-primary">
                                                                                            2+
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                        </div>
                                                        <!-- end card -->
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="card profile-project-card shadow-none mb-xxl-0  profile-project-success">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex">
                                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Update Project</a></h5>
                                                                        <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">1 month Ago</span></p>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-2">
                                                                        <div class="badge bg-info-subtle text-info fs-10">New</div>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-grow-1">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div>
                                                                                <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                                            </div>
                                                                            <div class="avatar-group">
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle img-fluid">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                                                            A
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end card body -->
                                                        </div><!-- end card -->
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="card profile-project-card shadow-none mb-sm-0  profile-project-danger">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex">
                                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Bank Management System</a></h5>
                                                                        <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">10 month Ago</span></p>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-2">
                                                                        <div class="badge bg-success-subtle text-success fs-10">Completed</div>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-grow-1">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div>
                                                                                <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                                            </div>
                                                                            <div class="avatar-group">
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <div class="avatar-title rounded-circle bg-primary">
                                                                                            2+
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end card body -->
                                                        </div><!-- end card -->
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-sm-6">
                                                        <div class="card profile-project-card shadow-none mb-0  profile-project-primary">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex">
                                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">PSD to HTML Convert</a></h5>
                                                                        <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">29 min Ago</span></p>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-2">
                                                                        <div class="badge bg-info-subtle text-info fs-10">New</div>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-grow-1">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <div>
                                                                                <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                                            </div>
                                                                            <div class="avatar-group">
                                                                                <div class="avatar-group-item">
                                                                                    <div class="avatar-xs">
                                                                                        <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle img-fluid" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end card body -->
                                                        </div><!-- end card -->
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="mt-4">
                                                            <ul class="pagination pagination-separated justify-content-center mb-0">
                                                                <li class="page-item disabled">
                                                                    <a href="javascript:void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                                                </li>
                                                                <li class="page-item active">
                                                                    <a href="javascript:void(0);" class="page-link">1</a>
                                                                </li>
                                                                <li class="page-item">
                                                                    <a href="javascript:void(0);" class="page-link">2</a>
                                                                </li>
                                                                <li class="page-item">
                                                                    <a href="javascript:void(0);" class="page-link">3</a>
                                                                </li>
                                                                <li class="page-item">
                                                                    <a href="javascript:void(0);" class="page-link">4</a>
                                                                </li>
                                                                <li class="page-item">
                                                                    <a href="javascript:void(0);" class="page-link">5</a>
                                                                </li>
                                                                <li class="page-item">
                                                                    <a href="javascript:void(0);" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end row-->
                                            </div>
                                            <!--end card-body-->
                                        </div>
                                        <!--end card-->
                                    </div>
                                    <!--end tab-pane-->
                                    <div class="tab-pane fade" id="documents" role="tabpanel">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-4">
                                                    <h5 class="card-title flex-grow-1 mb-0">Documents</h5>
                                                    <div class="flex-shrink-0">
                                                        <input class="form-control d-none" type="file" id="formFile">
                                                        <label for="formFile" class="btn btn-danger"><i class="ri-upload-2-fill me-1 align-bottom"></i> Upload File</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless align-middle mb-0">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th scope="col">File Name</th>
                                                                        <th scope="col">Type</th>
                                                                        <th scope="col">Size</th>
                                                                        <th scope="col">Upload Date</th>
                                                                        <th scope="col">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="avatar-sm">
                                                                                    <div class="avatar-title bg-primary-subtle text-primary rounded fs-20">
                                                                                        <i class="ri-file-zip-fill"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="ms-3 flex-grow-1">
                                                                                    <h6 class="fs-15 mb-0"><a href="javascript:void(0)">Artboard-documents.zip</a>
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>Zip File</td>
                                                                        <td>4.57 MB</td>
                                                                        <td>12 Dec 2021</td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink15" data-bs-toggle="dropdown" aria-expanded="true">
                                                                                    <i class="ri-equalizer-fill"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink15">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                                                    <li class="dropdown-divider"></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="avatar-sm">
                                                                                    <div class="avatar-title bg-danger-subtle text-danger rounded fs-20">
                                                                                        <i class="ri-file-pdf-fill"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="ms-3 flex-grow-1">
                                                                                    <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Bank Management System</a></h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>PDF File</td>
                                                                        <td>8.89 MB</td>
                                                                        <td>24 Nov 2021</td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                                                    <i class="ri-equalizer-fill"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                                                    <li class="dropdown-divider"></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="avatar-sm">
                                                                                    <div class="avatar-title bg-secondary-subtle text-secondary rounded fs-20">
                                                                                        <i class="ri-video-line"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="ms-3 flex-grow-1">
                                                                                    <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Tour-video.mp4</a></h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>MP4 File</td>
                                                                        <td>14.62 MB</td>
                                                                        <td>19 Nov 2021</td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink4" data-bs-toggle="dropdown" aria-expanded="true">
                                                                                    <i class="ri-equalizer-fill"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink4">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                                                    <li class="dropdown-divider"></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="avatar-sm">
                                                                                    <div class="avatar-title bg-success-subtle text-success rounded fs-20">
                                                                                        <i class="ri-file-excel-fill"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="ms-3 flex-grow-1">
                                                                                    <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Account-statement.xsl</a></h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>XSL File</td>
                                                                        <td>2.38 KB</td>
                                                                        <td>14 Nov 2021</td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink5" data-bs-toggle="dropdown" aria-expanded="true">
                                                                                    <i class="ri-equalizer-fill"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink5">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                                                    <li class="dropdown-divider"></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="avatar-sm">
                                                                                    <div class="avatar-title bg-info-subtle text-info rounded fs-20">
                                                                                        <i class="ri-folder-line"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="ms-3 flex-grow-1">
                                                                                    <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Project Screenshots Collection</a></h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>Floder File</td>
                                                                        <td>87.24 MB</td>
                                                                        <td>08 Nov 2021</td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink6" data-bs-toggle="dropdown" aria-expanded="true">
                                                                                    <i class="ri-equalizer-fill"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink6">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle"></i>View</a></li>
                                                                                    <li>
                                                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="avatar-sm">
                                                                                    <div class="avatar-title bg-danger-subtle text-danger rounded fs-20">
                                                                                        <i class="ri-image-2-fill"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="ms-3 flex-grow-1">
                                                                                    <h6 class="fs-15 mb-0">
                                                                                        <a href="javascript:void(0);">Velzon-logo.png</a>
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>PNG File</td>
                                                                        <td>879 KB</td>
                                                                        <td>02 Nov 2021</td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink7" data-bs-toggle="dropdown" aria-expanded="true">
                                                                                    <i class="ri-equalizer-fill"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink7">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle"></i>View</a></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle"></i>Download</a></li>
                                                                                    <li>
                                                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="text-center mt-3">
                                                            <a href="javascript:void(0);" class="text-success"><i class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load more </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end tab-pane-->
                                </div>
                                <!--end tab-content-->
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div><!-- container-fluid -->
            </div><!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © fauzanbakri.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Srisyaha
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div><!-- end main content-->

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
    <script src="assets/js/plugins.js"></script>
    <script src="js/code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- swiper js -->
    <script src="assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- profile init js -->
    <script src="assets/js/pages/profile.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script>
    $(document).ready(function() {
        // Lakukan AJAX request saat halaman dibuka
        $.ajax({
            url: 'Report/makassar', // URL yang akan dipanggil
            type: 'GET', // Tipe request (GET atau POST, tergantung kebutuhan)
            success: function(response) {
                $('#makassar-content').html(response);
                // console.log(response);
            },
            error: function(xhr, status, error) {
                $('#makassar-content').html('<p>Terjadi kesalahan saat memuat data.</p>');
            }
        });

        $.ajax({
            url: 'Report/kendari', // URL yang akan dipanggil
            type: 'GET', // Tipe request (GET atau POST, tergantung kebutuhan)
            success: function(response) {
                $('#kendari').html(response);
                // console.log(response);
            },
            error: function(xhr, status, error) {
                $('#makassar-content').html('<p>Terjadi kesalahan saat memuat data.</p>');
            }
        });

        $.ajax({
            url: 'Report/manado', // URL yang akan dipanggil
            type: 'GET', // Tipe request (GET atau POST, tergantung kebutuhan)
            success: function(response) {
                $('#manado').html(response);
                // console.log(response);
            },
            error: function(xhr, status, error) {
                $('#makassar-content').html('<p>Terjadi kesalahan saat memuat data.</p>');
            }
        });

        $('#copy-button').click(function() {
         var content = $('#makassar').text();
         var tempInput = document.createElement('input');
         tempInput.value = content;
         document.body.appendChild(tempInput);
         tempInput.select();
         document.execCommand('copy');
         document.body.removeChild(tempInput);
         alert('Konten telah disalin!');
        });

        $('#generate').on('click', function (e) {
            const formData = {
                makassartotal: $('[name="makassartotal"]').val(),
                makassardivision: $('[name="makassardivision"]').val(),
                kendaritotal: $('[name="kendaritotal"]').val(),
                kendaridivision: $('[name="kendaridivision"]').val(),
                manadototal: $('[name="manadototal"]').val(),
                manadodivision: $('[name="manadodivision"]').val()
            };
            $.ajax({
                url: 'Report/totaltiket',
                type: 'POST',
                data: formData,
                success: function (response) {
                    // console.log(response);
                    $('#totaltiket').html(response);
                }
            });
        });
    });
    </script>
</body>


<!-- Mirrored from Srisyaha.com/velzon/html/default/pages-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:17:37 GMT -->
</html>