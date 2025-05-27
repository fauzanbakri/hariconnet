
    
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
                                                            <label for="lastName" class="form-label">Tim</label>
                                                            <select class="form-select mb-3" aria-label="Default select example" name="tim" id="tim" >
                                                                <option value="">Select</option>
                                                                <?php 
                                                                    foreach ($tim as $row){
                                                                        echo '
                                                                            <option value="'.$row->nama.'">'.$row->nama.'</option>
                                                                        ';
                                                                    }
                                                                ?>
                                                            </select>
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
                                                            <input class="form-control mb-3" aria-label="Default select example" name="edittim" id="edittim" >
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
                                    <table id="example1" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
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
                                                            <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
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

    <script src="js/code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
    <script src="assets/js/plugins.js"></script>

    <script src="assets/js/app.js"></script>   


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
            selector: ".olt",
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
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.remove-item-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const idTiket = this.getAttribute('data-id');
                    console.log(idTiket);
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
                    }).then(function(result) {
                        if (result.value) {
                            $.ajax({
                                url: 'Feeder/deleteRow?id='+idTiket,
                                type: 'GET',
                                success: function(response) {
                                    console.log(response.success);
                                    if (response) {
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: "The data has been deleted.",
                                            icon: "success",
                                            customClass: {
                                                confirmButton: "btn btn-primary w-xs mt-2"
                                            },
                                            buttonsStyling: false
                                        }).then(() => {
                                            location.reload(); 
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "Error!",
                                            text: response.message || "Failed to delete the data.",
                                            icon: "error",
                                            customClass: {
                                                confirmButton: "btn btn-primary w-xs mt-2"
                                            },
                                            buttonsStyling: false
                                        });
                                    }
                                },
                                error: function() {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "An error occurred while processing the request.",
                                        icon: "error",
                                        customClass: {
                                            confirmButton: "btn btn-primary w-xs mt-2"
                                        },
                                        buttonsStyling: false
                                    });
                                }
                            });
                        }
                    });
                });
            });
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalElement = document.getElementById('exampleModalgrid1');
        const modal = new bootstrap.Modal(modalElement);
        document.querySelectorAll('.edit-item-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const ticketData = this.dataset;
                console.log(ticketData);
                const fields = [
                    'idfeeder', 'editincident', 'editdowntime', 'edittipe', 'editkp', 'editolt', 'editarea', 'editdeskripsi', 'edittim',
                    'editstatus', 'editjumlahtiket', 'edittipepenyebab', 'editketerangan'
                ];
                fields.forEach(field => {
                    const inputElement = document.getElementById(field);
                    if (inputElement) {
                        console.log(`Setting ${field} with value:`, ticketData[field]);
                        inputElement.value = ticketData[field] || ''; // Set value or empty if no data
                    }
                });
                modal.show();
            });
        });
    });
    </script>
</body>


<!-- Mirrored from Srisyaha.com/velzon/html/default/tables-datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:19:48 GMT -->
</html>