
    
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
                                <h4 class="mb-sm-0">Tickets</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tickets</a></li>
                                        <li class="breadcrumb-item active">Ticket</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Incident Feeder</h5><br>
                                    <!-- Base Buttons -->
                                     <!-- Grids in modals -->
                                <!-- Grids in modals -->
                                 <div class="row">
                                    <div class="col-md-3">
                                        <?php
                                            if(
                                                $_SESSION['role']=='Resepsionis' ||
                                                $_SESSION['role']=='Guest 1'
                                                ){
                                                    echo '';
                                                }else{
                                                    echo '
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                                                        Add New Incident
                                                        </button>';
                                                }
                                        ?>
                                        <button hidden type="button" data-toast data-toast-text="" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" id="toast" class="btn btn-light w-xs"></button>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-3">
                                            <label for="filterTipe" class="form-label">Tipe</label>
                                            <select id="filterTipe" class="form-select form-select-sm">
                                                <option value="">Semua</option>
                                                <?php
                                                    $tipeOptions = array_unique(array_column($data, 'tipe'));
                                                    foreach ($tipeOptions as $tipe) {
                                                        echo "<option value='{$tipe}'>{$tipe}</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="filterKP" class="form-label">KP</label>
                                            <select id="filterKP" class="form-select form-select-sm">
                                                <option value="">Semua</option>
                                                <?php
                                                    $kpOptions = array_unique(array_column($data, 'kp'));
                                                    foreach ($kpOptions as $kp) {
                                                        echo "<option value='{$kp}'>{$kp}</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="filterTim" class="form-label">Tim</label>
                                            <select id="filterTim" class="form-select form-select-sm">
                                                <option value="">Semua</option>
                                                <?php
                                                    $timOptions = array_unique(array_column($data, 'tim'));
                                                    foreach ($timOptions as $tims) {
                                                        echo "<option value='{$tims}'>{$tims}</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="filterStatus" class="form-label">Status</label>
                                            <select id="filterStatus" class="form-select form-select-sm">
                                                <option value="">Semua</option>
                                                <?php
                                                    $statusOptions = array_unique(array_column($data, 'status'));
                                                    foreach ($statusOptions as $status) {
                                                        echo "<option value='{$status}'>{$status}</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalgridLabel">New Feeder</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Incident</label>
                                                                <input type="text" class="form-control" name="incident" id="incident" autocomplete="off" placeholder="Incident">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Downtime</label>
                                                                <input type="text" class="form-control" name="downtime" id="downtime" autocomplete="off" placeholder="Tanggal">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Type</label>
                                                            <select class="form-select mb-3" name="tipe" id="tipe" aria-label="Default select example">
                                                                <option value="FTTH BACKBONE">FTTH BACKBONE</option>
                                                                <option value="FTTH FEEDER">FTTH FEEDER</option>
                                                                <option value="FTTH DISTRIBUSI">FTTH DISTRIBUSI</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">KP</label>
                                                            <select class="form-select mb-3" name="kp" id="kp" aria-label="Default select example">
                                                                <option value="MAKASSAR">MAKASSAR</option>
                                                                <option value="KENDARI">KENDARI</option>
                                                                <option value="MANADO">MANADO</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="autoCompleteFruit" class="text-muted">OLT</label>
                                                                <input id="olt" class="olt" type="text" name="olt" dir="ltr" spellcheck=false autocomplete="off" autocapitalize="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Kode Area</label>
                                                                <input type="text" class="form-control" id="area" name="area" autocomplete="off" placeholder="Kode Area">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Deskripsi</label>
                                                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" autocomplete="off" placeholder="Deskripsi">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            
                                                            <div>
                                                                    <label for="autoCompleteFruit" class="text-muted">Tim</label>
                                                                    <select id="tim" name="tim" class="form-select js-team-select" style="width:100%">
                                                                        <option value="">-- Pilih Tim --</option>
                                                                    </select>
                                                                </div>
                                                            
                                                            <!--  -->
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Status</label>
                                                            <select class="form-select mb-3" name="status" id="status1" aria-label="Default select example">
                                                                <option value="OPEN">OPEN</option>
                                                                <option value="ANTRIAN">ANTRIAN</option>
                                                                <option value="ON PROGRESS">ON PROGRESS</option>
                                                                <option value="SOLVED (ICRM OPEN)">SOLVED (ICRM OPEN)</option>
                                                                <option value="STOPCLOCK">STOPCLOCK</option>
                                                                <option value="CLOSED">CLOSED</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Jumlah Tiket</label>
                                                                <input type="text" class="form-control" id="jumlahtiket" name="jumlahtiket" autocomplete="off" placeholder="Jumlah Tiket">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Tipe Penyebab</label>
                                                            <select class="form-select mb-3" name="tipePenyebab" id="tipePenyebab" aria-label="Default select example">
                                                                <option value="Belum Diketahui">Belum Diketahui</option>
                                                                <option value="Putus Kabel">Putus Kabel</option>
                                                                <option value="Kabel Bending">Kabel Bending</option>
                                                                <option value="Putus Core">Putus Core</option>
                                                                <option value="FOC Konektor">FOC Konektor</option>
                                                                <option value="FOT Perangkat">FOT Perangkat</option>
                                                                <option value="Power Supply">Power Supply</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Keterangan</label>
                                                                <textarea type="text" class="form-control" id="keterangan" name="keterangan" autocomplete="off" placeholder="Keterangan"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" id="submitBtn">Submit</button>
                                                            </div>
                                                        </div><!--end col-->
                                                    </div><!--end row-->
                                                <!-- </form> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- modal edit -->
                                <div class="modal fade" id="exampleModalgrid1" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalgridLabel">Edit Feeder</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-xxl-6">
                                                            <input type="hidden" class="form-control" name="idfeeder" id="idfeeder" autocomplete="off" placeholder="Incident">
                                                            <div>
                                                                <label class="form-label">Incident</label>
                                                                <input type="text" class="form-control" name="editincident" id="editincident" autocomplete="off" placeholder="Incident">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Downtime</label>
                                                                <input type="text" class="form-control" name="editdowntime" id="editdowntime" autocomplete="off" placeholder="Tanggal">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Type</label>
                                                            <select class="form-select mb-3" name="edittipe" id="edittipe" aria-label="Default select example">
                                                                <option value="FTTH BACKBONE">FTTH BACKBONE</option>
                                                                <option value="FTTH FEEDER">FTTH FEEDER</option>
                                                                <option value="FTTH DISTRIBUSI">FTTH DISTRIBUSI</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">KP</label>
                                                            <select class="form-select mb-3" name="editkp" id="editkp" aria-label="Default select example">
                                                                <option value="MAKASSAR">MAKASSAR</option>
                                                                <option value="KENDARI">KENDARI</option>
                                                                <option value="MANADO">MANADO</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="olt" class="form-label">OLT</label>
                                                                <input type="text" class="form-control" name="editolt" id="editolt" autocomplete="off" placeholder="OLT">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Kode Area</label>
                                                                <input type="text" class="form-control" id="editarea" name="editarea" autocomplete="off" placeholder="Kode Area">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Deskripsi</label>
                                                                <input type="text" class="form-control" id="editdeskripsi" name="editdeskripsi" autocomplete="off" placeholder="Deskripsi">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Tim</label>
                                                            <select class="form-select js-team-select-edit" name="edittim" id="edittim" style="width:100%">
                                                                <option value="">-- Pilih Tim --</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Status</label>
                                                            <select class="form-select mb-3" name="editstatus" id="editstatus" aria-label="Default select example">
                                                                <option value="OPEN">OPEN</option>
                                                                <option value="ANTRIAN">ANTRIAN</option>
                                                                <option value="ON PROGRESS">ON PROGRESS</option>
                                                                <option value="SOLVED (ICRM OPEN)">SOLVED (ICRM OPEN)</option>
                                                                <option value="STOPCLOCK">STOPCLOCK</option>
                                                                <option value="CLOSED">CLOSED</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Jumlah Tiket</label>
                                                                <input type="text" class="form-control" id="editjumlahtiket" name="editjumlahtiket" autocomplete="off" placeholder="Jumlah Tiket">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Tipe Penyebab</label>
                                                            <select class="form-select mb-3" name="edittipepenyebab" id="edittipepenyebab" aria-label="Default select example">
                                                                <option value="Belum Diketahui">Belum Diketahui</option>
                                                                <option value="Putus Kabel">Putus Kabel</option>
                                                                <option value="Kabel Bending">Kabel Bending</option>
                                                                <option value="Putus Core">Putus Core</option>
                                                                <option value="FOC Konektor">FOC Konektor</option>
                                                                <option value="FOT Perangkat">FOT Perangkat</option>
                                                                <option value="Power Supply">Power Supply</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Keterangan</label>
                                                                <textarea type="text" class="form-control" id="editketerangan" name="editketerangan" autocomplete="off" placeholder="Keterangan"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" id="editsubmitBtn">Submit</button>
                                                            </div>
                                                        </div><!--end col-->
                                                    </div><!--end row-->
                                                <!-- </form> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered dt-responsive table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Insiden</th>
                                                <th>Downtime</th>
                                                <th>Durasi</th>
                                                <th>Tipe</th>
                                                <th>KP</th>
                                                <th>Kode Area</th>
                                                <th>OLT</th>
                                                <th>Deskripsi</th>
                                                <th>Tim</th>
                                                <th>Deskripsi Insiden</th>
                                                <th>Status</th>
                                                <th>Jumlah Tiket</th>
                                                <th>Tipe Penyebab</th>
                                                <th>ID</th>
                                                <th>Keterangan</th>
                                                <th>Last Update By</th>
                                                <th>Timestamp</th>
                                                <?php
                                                if(
                                                    $_SESSION['role']!='Resepsionis'
                                                    ){
                                                        echo "<th>Action</th>";
                                                }

                                                    
                                                ?>
                                            </tr>
                                        </thead>
                                        <!-- <span class="badge bg-danger">Danger</span> -->
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            foreach ($data as $row){
                                                date_default_timezone_set('Asia/Makassar');
                                                $tanggalSekarang = new DateTime();
                                                $durasi1 = new DateTime($row->downtime);
                                                $selisih = $durasi1->diff($tanggalSekarang);
                                                $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                                $count = $count + 1;
                                                if($row->tipe=="FTTH BACKBONE"){
                                                    $v = "OLT TO UPLINK";
                                                }elseif($row->tipe=="FTTH FEEDER"){
                                                    $v = "FDT TO OLT";
                                                }else{
                                                    $v = "FAT TO FDT";
                                                }

                                                if($row->tipe=="FTTH BACKBONE"){
                                                    $a = '<span class="badge border border-danger text-danger">FTTH BACKBONE</span>';
                                                }elseif($row->tipe=="FTTH FEEDER"){
                                                    $a = '<span class="badge border border-warning text-warning">FTTH FEEDER</span>';
                                                }else{
                                                    $a = '<span class="badge border border-info text-info">FTTH DISTRIBUSI</span>';
                                                }


                                                if($row->status=="CLOSED"){
                                                    $b = '<span class="badge bg-success">CLOSED</span>';
                                                }elseif($row->status=="ON PROGRESS"){
                                                    $b = '<span class="badge bg-info">ON PROGRESS</span>';
                                                }elseif($row->status=="SOLVED (ICRM OPEN)"){
                                                    $b = '<span class="badge border border-success text-success">SOLVED (ICRM OPEN)</span>';
                                                }elseif($row->status=="STOPCLOCK"){
                                                    $b = '<span class="badge bg-dark">STOPCLOCK</span>';
                                                }elseif($row->status=="ANTRIAN"){
                                                    $b = '<span class="badge bg-warning">ANTRIAN</span>';
                                                }else{
                                                    $b = '<span class="badge bg-primary">OPEN</span>';
                                                }

                                                if(
                                                    $_SESSION['role']=='Resepsionis'
                                                    ){
                                                        $s = "hidden";
                                                }else{
                                                        $s ="";
                                                }

                                                echo "
                                                <tr>
                                                    <td>".$count."</td>
                                                    <td>".$row->idInsiden."</td>
                                                    <td>".$row->downtime."</td>
                                                    <td>".$durasi."</td>
                                                    <td>".$a."</td>
                                                    <td>".$row->kp."</td>
                                                    <td>".$row->kode."</td>
                                                    <td>".$row->idOlt."</td>
                                                    <td>".$row->gangguan."</td>
                                                    <td>".$row->tim."</td>
                                                    <td>"."INSIDEN NO. ".$row->idInsiden." ".$row->tipe."_".$row->kode." [PROAKTIF NOC SBU]_".$v." ".$row->idOlt." ".$row->gangguan."</td>
                                                    <td>".$b."</td>
                                                    <td>".$row->jumlahTiket."</td>
                                                    <td>".$row->tipePenyebab."</td>
                                                    <td>".$row->id."</td>
                                                    <td>".$row->keterangan."</td>
                                                    <td>".$row->createby."</td>  
                                                    <td>".$row->timestamp."</td>  
                                                    <td ".$s.">
                                                        <div class='dropdown d-inline-block'>
                                                            <button class='btn btn-soft-secondary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                                <i class='ri-more-fill align-middle'></i>
                                                            </button>
                                                            <ul class='dropdown-menu dropdown-menu-end'>               
                                                                <li>
                                                                    <a href='#' class='dropdown-item edit-item-btn' data-idfeeder='".$row->id."' data-editarea='".$row->kode."' data-editdeskripsi='".$row->gangguan."' data-editincident='".$row->idInsiden."' data-editdowntime='".$row->downtime."' data-edittipe='".$row->tipe."' data-editkp='".$row->kp."' data-editkode='".$row->kode."' data-editolt='".$row->idOlt."' data-editgangguan='".$row->gangguan."' data-edittim='".$row->tim."' data-editstatus='".$row->status."' data-editketerangan='".$row->keterangan."' data-editjumlahTiket='".$row->jumlahTiket."' data-edittipepenyebab='".$row->tipePenyebab."'>
                                                                        <i class='ri-pencil-fill align-bottom me-2 text-muted'></i> Edit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href='#' class='dropdown-item remove-item-btn' data-id=".$row->id.">
                                                                        <i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Delete
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>  
                                                </tr>                                              
                                                ";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo date('Y'); ?> © fauzanbakri.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Srisyaha
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


    <!--datatable js-->
    <script src="js/cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="js/cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="js/cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="js/cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="js/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="js/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="js/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- <script src="assets/js/pages/sweetalerts.init.js"></script> -->

    <!-- multi.js -->
    <script src="assets/libs/multi.js/multi.min.js"></script>
    <!-- autocomplete js -->
    <script src="assets/libs/%40tarekraafat/autocomplete.js/autoComplete.min.js"></script>
    <script src="assets/js/pages/datatables.init.js"></script>
    <!-- core scripts (plugins/app) are included from navbar template -->


    <script>
        var multiSelectBasic2 = document.getElementById("multiselect-basic2"),
        multiSelectHeader2 = (multiSelectBasic2 && multi(multiSelectBasic2, {
            enable_search: !1
        }), document.getElementById("multiselect-header2")),
        multiSelectOptGroup2 = (multiSelectHeader2 && multi(multiSelectHeader2, {
            non_selected_header: "Cars",
            selected_header: "Favorite Cars"
        }), document.getElementById("multiselect-optiongroup2")),
        autoCompleteFruit2 = (multiSelectOptGroup2 && multi(multiSelectOptGroup2, {
            enable_search: !0
        }), new autoComplete({
            selector: "#olt",
            placeHolder: "Search for OLT...",
            data: {
                src: [
                    <?php 
                        foreach ($olt as $row){
                            echo "'".$row->idOlt."',";
                        }
                    ?>
                ],
                cache: !0
            },
            resultsList: {
                element: function(e, t) {
                    var l;
                    t.results.length || ((l = document.createElement("div")).setAttribute("class", "no_result"), l.innerHTML = '<span>Found No Results for "' + t.query + '"</span>', e.prepend(l))
                },
                noResults: !0
            },
            resultItem: {
                highlight: !0
            },
            events: {
                input: {
                    selection: function(e) {
                        e = e.detail.selection.value;
                        autoCompleteFruit2.input.value = e
                    }
                }
            }
        }));
    </script>
    <!-- Select2 for searchable team dropdown -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function loadTeamsByKP(kp, $select, selected) {
            if(!kp) {
                $select.html('<option value="">-- Pilih Tim --</option>');
                $select.val('');
                $select.trigger('change');
                return;
            }
            $.ajax({
                url: 'Feeder/getTimByKP?kp='+encodeURIComponent(kp),
                method: 'GET',
                success: function(res) {
                    let data = [];
                    try { data = JSON.parse(res); } catch(e) { data = res; }
                    $select.empty();
                    $select.append('<option value="">-- Pilih Tim --</option>');
                    data.forEach(function(item){
                        const text = '(' + (item.kendaraan || '') + ') ' + item.nama;
                        const opt = $('<option>').val(item.nama).text(text);
                        $select.append(opt);
                    });
                    if(selected) {
                        $select.val(selected);
                    }
                    $select.trigger('change');
                },
                error: function(){
                    $select.html('<option value="">-- Pilih Tim --</option>');
                }
            });
        }

        $(document).ready(function(){
            // init select2
            $('.js-team-select, .js-team-select-edit').select2({
                placeholder: '-- Pilih Tim --',
                allowClear: true,
                dropdownParent: $('#exampleModalgrid')
            });

            // ensure edit select uses correct modal parent
            $('.js-team-select-edit').each(function(){
                $(this).select2({
                    placeholder: '-- Pilih Tim --',
                    allowClear: true,
                    dropdownParent: $('#exampleModalgrid1')
                });
            });

            // when KP changes in add modal
            $('#kp').on('change', function(){
                const kp = $(this).val();
                loadTeamsByKP(kp, $('#tim'));
            });

            // when KP changes in edit modal
            $('#editkp').on('change', function(){
                const kp = $(this).val();
                loadTeamsByKP(kp, $('#edittim'));
            });
        });

        // handled by delegated click listener below (works after table redraws)
    </script>

    <script>
        var multiSelectBasic = document.getElementById("multiselect-basic"),
        multiSelectHeader = (multiSelectBasic && multi(multiSelectBasic, {
            enable_search: !1
        }), document.getElementById("multiselect-header")),
        multiSelectOptGroup = (multiSelectHeader && multi(multiSelectHeader, {
            non_selected_header: "Cars",
            selected_header: "Favorite Cars"
        }), document.getElementById("multiselect-optiongroup")),
        autoCompleteFruit = (multiSelectOptGroup && multi(multiSelectOptGroup, {
            enable_search: !0
        }), new autoComplete({
            selector: "#tim",
            placeHolder: "Search for Tim...",
            data: {
                src: [
                    <?php
                        // Defensive: if controller didn't provide $tim, avoid PHP notice
                        if (!empty($tim) && is_array($tim)){
                            foreach ($tim as $row){
                                // escape single quotes to avoid breaking JS
                                $name = isset($row->nama) ? addslashes($row->nama) : '';
                                if ($name !== '') echo "'".$name."',";
                            }
                        }
                    ?>
                ],
                cache: !0
            },
            resultsList: {
                element: function(e, t) {
                    var l;
                    t.results.length || ((l = document.createElement("div")).setAttribute("class", "no_result"), l.innerHTML = '<span>Found No Results for "' + t.query + '"</span>', e.prepend(l))
                },
                noResults: !0
            },
            resultItem: {
                highlight: !0
            },
            events: {
                input: {
                    selection: function(e) {
                        e = e.detail.selection.value;
                        autoCompleteFruit.input.value = e
                    }
                }
            }
        }));
    </script>

    <script>
        document.getElementById("sa-warning") && document.getElementById("sa-warning").addEventListener("click", function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                customClass: {
                    confirmButton: "btn btn-primary w-xs me-2 mt-2",
                    cancelButton: "btn btn-danger w-xs mt-2"
                },
                confirmButtonText: "Yes, Change Shift!",
                buttonsStyling: !1,
                showCloseButton: !0
            }).then(function(t) {
                console.log(t.value);
                var response;
                if(t.value){
                    $.ajax({
                        url: "Tickets/changeShift",
                        type: 'GET',
                        success: function(res) {
                            if (res=='success'){
                                Swal.fire({
                                    title: "Success!",
                                    text: "Shift Change Successfully.",
                                    icon: "success",
                                    customClass: {
                                        confirmButton: "btn btn-primary w-xs mt-2"
                                    },
                                    buttonsStyling: !1
                                }) 
                            }else{
                                Swal.fire({
                                    title: "Error!",
                                    text: "Failed to Change Shift",
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
    <script>
        $(document).ready(function () {
            $('#olt').on('click change keyup keydown', function () {
                let oltValue = $(this).val();
                console.log(oltValue);
                $.ajax({
                    url: 'Feeder/autoArea?area='+oltValue,
                    method: 'GET',
                    success: function (response) {
                        console.log('Response:', response);
                        $('#area').val(response);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error); 
                    }
                });
            });
        });
    </script>
    <script>
        const button = document.getElementById('toast');
        $(document).ready(function () {
            $('#submitBtn').on('click', function (e) {
                e.preventDefault();
                const formData = {
                    incident: $('[name="incident"]').val(),
                    downtime: $('[name="downtime"]').val(),
                    tipe: $('[name="tipe"]').val(),
                    kp: $('[name="kp"]').val(),
                    olt: $('[name="olt"]').val(),
                    area: $('[name="area"]').val(),
                    deskripsi: $('[name="deskripsi"]').val(),
                    tim: $('[name="tim"]').val(),
                    status: $('[name="status"]').val(),
                    jumlahtiket: $('[name="jumlahtiket"]').val(),
                    tipePenyebab: $('[name="tipePenyebab"]').val(),
                    keterangan: $('[name="keterangan"]').val()
                   
                };
                if (!formData.deskripsi) {
                    button.setAttribute('data-toast-text', 'Deskripsi Cannot Empty!');
                    button.setAttribute('data-toast-className', 'danger');
                    button.click();
                    return;
                }
                $.ajax({
                    url: 'Feeder/insertData',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log(response);
                        if(response=='success'){
                            button.setAttribute('data-toast-text', 'Data Saved!');
                            button.setAttribute('data-toast-className', 'success');
                            button.click();
                            location.reload();
                        }else{
                            button.setAttribute('data-toast-text', response);
                            button.setAttribute('data-toast-className', 'danger');
                            button.click();   
                        }
                    },
                    error: function (xhr, status, error) {
                        button.setAttribute('data-toast-text', error);
                        button.setAttribute('data-toast-className', 'danger');
                        button.click();
                    }
                });
                console.log('asdasdsadasd');
            });

            $('#editsubmitBtn').on('click', function (e) {
                e.preventDefault();
                const formData = {
                    id: $('[name="idfeeder"]').val(),
                    incident: $('[name="editincident"]').val(),
                    downtime: $('[name="editdowntime"]').val(),
                    tipe: $('[name="edittipe"]').val(),
                    kp: $('[name="editkp"]').val(),
                    olt: $('[name="editolt"]').val(),
                    area: $('[name="editarea"]').val(),
                    deskripsi: $('[name="editdeskripsi"]').val(),
                    tim: $('[name="edittim"]').val(),
                    status: $('[name="editstatus"]').val(),
                    jumlahtiket: $('[name="editjumlahtiket"]').val(),
                    tipePenyebab: $('[name="edittipepenyebab"]').val(),
                    keterangan: $('[name="editketerangan"]').val()
                };
                if (!formData.deskripsi) {
                    button.setAttribute('data-toast-text', 'Deskripsi Cannot Empty!');
                    button.setAttribute('data-toast-className', 'danger');
                    button.click();
                    return;
                }
                $.ajax({
                    url: 'Feeder/editData',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log(response);
                        if(response=='success'){
                            button.setAttribute('data-toast-text', 'Data Saved!');
                            button.setAttribute('data-toast-className', 'success');
                            button.click();
                            location.reload();
                        }else{
                            button.setAttribute('data-toast-text', response);
                            button.setAttribute('data-toast-className', 'danger');
                            button.click();   
                        }
                    },
                    error: function (xhr, status, error) {
                        button.setAttribute('data-toast-text', error);
                        button.setAttribute('data-toast-className', 'danger');
                        button.click();
                    }
                });
            });
        });
    </script>
    <script>
    // Delegated jQuery handlers for edit and delete actions (survive DataTable redraws)
    $(document).on('click', '.remove-item-btn', function(e){
        e.preventDefault();
        var idTiket = $(this).attr('data-id') || $(this).data('id');
        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-primary w-xs me-2 mt-2",
                cancelButton: "btn btn-danger w-xs mt-2"
            },
            confirmButtonText: "Yes, Delete it!",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result){
            if (!result.value) return;
            $.ajax({
                url: 'Feeder/deleteRow?id='+encodeURIComponent(idTiket),
                type: 'GET',
                success: function(response){
                    var res = response;
                    try { if (typeof response === 'string') res = JSON.parse(response); } catch(err) {}
                    if (res === 'success' || (res && (res.success || res.status === 'success'))) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "The data has been deleted.",
                            icon: "success",
                            customClass: { confirmButton: "btn btn-primary w-xs mt-2" },
                            buttonsStyling: false
                        }).then(function(){ location.reload(); });
                    } else {
                        Swal.fire({ title: "Error!", text: (res && (res.message || res.error)) || 'Failed to delete the data.', icon: 'error', customClass: { confirmButton: 'btn btn-primary w-xs mt-2' }, buttonsStyling: false });
                    }
                },
                error: function(){
                    Swal.fire({ title: "Error!", text: "An error occurred while processing the request.", icon: "error", customClass: { confirmButton: "btn btn-primary w-xs mt-2" }, buttonsStyling: false });
                }
            });
        });
    });

    $(document).on('click', '.edit-item-btn', function(e){
        e.preventDefault();
        var $btn = $(this);
        var fields = ['idfeeder','editincident','editdowntime','edittipe','editkp','editolt','editarea','editdeskripsi','edittim','editstatus','editjumlahtiket','edittipepenyebab','editketerangan'];
        fields.forEach(function(field){
            var attr = $btn.attr('data-' + field);
            if (typeof attr !== 'undefined') {
                var $inp = $('#' + field);
                if ($inp.length) $inp.val(attr);
            } else {
                // try camelCase data-* access as fallback
                var d = $btn.data(field);
                if (typeof d !== 'undefined') {
                    var $inp2 = $('#' + field);
                    if ($inp2.length) $inp2.val(d);
                }
            }
        });
        // load teams for editkp then set selected
        try {
            var kp = $btn.attr('data-editkp') || $btn.data('editkp') || '';
            var selectedTim = $btn.attr('data-edittim') || $btn.data('edittim') || '';
            if (typeof loadTeamsByKP === 'function') loadTeamsByKP(kp, $('#edittim'), selectedTim);
        } catch(err) {}
        var modalEl = document.getElementById('exampleModalgrid1');
        if (modalEl && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            try { bootstrap.Modal.getOrCreateInstance(modalEl).show(); } catch(err) {}
        }
    });
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const table = new DataTable('#example1', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
         columnDefs: [
            {
                targets: 0,
                className: 'priority-column',
                responsivePriority: 2,
                visible: true
            },
            {
                targets: 6,
                width: '40px' // smaller kode area
            },
            {
                targets: 10,
                responsivePriority: 1,
                width: '200px'
            },
            {
                targets: 12,
                width: '40px' // smaller jumlah tiket
            },
            {
                targets: 14,
                visible: false
            }
        ],
        responsive: false,  // disable auto-hiding
        scrollX: false,      // turn off horizontal scroll to fit on screen
        autoWidth: false,
        order: [],
    });
    const kolomTipe = 4;
    const kolomKP = 5;
    const kolomTim = 9;
    const kolomStatus = 11;

    ['#filterTipe', '#filterKP', '#filterTim', '#filterStatus'].forEach(function(selector) {
        document.querySelector(selector).addEventListener('change', function() {
            table.column(kolomTipe).search(document.getElementById('filterTipe').value).draw();
            table.column(kolomKP).search(document.getElementById('filterKP').value).draw();
            table.column(kolomTim).search(document.getElementById('filterTim').value).draw();
            table.column(kolomStatus).search(document.getElementById('filterStatus').value).draw();
        });
    });
});
</script>

    <script>
    // Ensure dropdown toggles inside the DataTable work even after redraws
    (function(){
        // Add dropdown-toggle class when an element with data-bs-toggle appears
        $(document).on('mouseenter', '#example1 [data-bs-toggle="dropdown"]', function(){
            $(this).addClass('dropdown-toggle');
        });

        // Fallback click handler that uses the Bootstrap Dropdown API to toggle menus
        $(document).on('click', '#example1 button[data-bs-toggle="dropdown"], #example1 .dropdown', function(e){
            // only handle clicks coming from the toggle button
            var btn = this;
            try{
                if (typeof bootstrap !== 'undefined' && bootstrap.Dropdown) {
                    e.preventDefault();
                    try{ bootstrap.Dropdown.getOrCreateInstance(btn).toggle(); }catch(err){}
                }
            }catch(err){}
        });
    })();
    </script>

    <style>
        /* allow table cells to wrap onto multiple lines and break long words */
        #example1 td, #example1 th {
            white-space: normal !important;
            word-break: break-word;
            max-width: 120px;
        }
    </style>

</body>


<!-- Mirrored from Srisyaha.com/velzon/html/default/tables-datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:19:48 GMT -->
</html>