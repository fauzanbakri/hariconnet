
    
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
                                        <li class="breadcrumb-item active">All Tickets</li>
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
                                    <h5 class="card-title mb-0">Ticket</h5><br>
                                    <!-- Base Buttons -->
                                     <!-- Grids in modals -->
                                <!-- Grids in modals -->
                                <?php if($_SESSION['role']=='Guest 1'){
                                    $hide = 'hidden';
                                }else{
                                    $hide = '';
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <button <?php echo $hide;?> type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                                            Add New
                                        </button>
                                    </div>
                                    <div class="col-md-9 d-flex flex-row-reverse">
                                    <button  <?php echo $hide;?> type="button" class="btn btn-danger flex-row-reverse" id="sa-warning">
                                        Change Shift
                                    </button>
                                        <button hidden type="button" data-toast data-toast-text="" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" id="toast" class="btn btn-light w-xs"></button>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <label for="filterProvinsi" class="form-label">Provinsi</label>
                                        <select id="filterProvinsi" class="form-select form-select-sm">
                                            <option value="">Semua</option>
                                            <?php foreach ($provinsi as $item): ?>
                                                <option value="<?= $item ?>"><?= $item ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="filterKabupaten" class="form-label">Kabupaten</label>
                                        <select id="filterKabupaten" class="form-select form-select-sm">
                                            <option value="">Semua</option>
                                            <?php foreach ($kabupaten as $item): ?>
                                                <option value="<?= $item ?>"><?= $item ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="filterTim" class="form-label">Tim</label>
                                        <select id="filterTim" class="form-select form-select-sm">
                                            <option value="">Semua</option>
                                            <?php foreach ($tim as $item): ?>
                                                <option value="<?= $item ?>"><?= $item ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="filterStatus" class="form-label">Status</label>
                                        <select id="filterStatus" class="form-select form-select-sm">
                                            <option value="">Semua</option>
                                            <?php foreach ($status as $item): ?>
                                                <option value="<?= $item ?>"><?= $item ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                 </div>
                                <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalgridLabel">New Ticket</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Incident</label>
                                                                <input type="text" class="form-control" name="incident" autocomplete="off" placeholder="Incident">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label  class="form-label">Tiket</label>
                                                                <input type="text" class="form-control" name="tiket" autocomplete="off" placeholder="Tiket">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label  class="form-label">Tanggal</label>
                                                                <input type="text" class="form-control" name="tanggal" autocomplete="off" placeholder="Tanggal">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label  class="form-label">SID</label>
                                                                <input type="text" class="form-control" name="sid" autocomplete="off" placeholder="SID">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label  class="form-label">Telepon</label>
                                                                <input type="text" class="form-control" name="telepon" autocomplete="off" placeholder="Telepon">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label  class="form-label">Nama</label>
                                                                <input type="text" class="form-control" name="nama" autocomplete="off" placeholder="Nama Pelanggan">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label  class="form-label">Keluhan</label>
                                                            <select class="form-select mb-3" name="keluhan" aria-label="Default select example">
                                                                <option value="LINK LOSS">LINK LOSS</option>
                                                                <option value="ONT PROBLEM">ONT PROBLEM</option>
                                                                <option value="BAD RX">BAD RX</option>
                                                                <option value="SET VLAN">SET VLAN</option>
                                                                <option value="CABLE PROBLEM">CABLE PROBLEM</option>
                                                                <option value="SETTING PASSWORD">SETTING PASSWORD</option>
                                                                <option value="INTERNET DOWN/NO INTERNET">INTERNET DOWN/NO INTERNET</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label  class="form-label">Alamat</label>
                                                                <input type="text" class="form-control" name="alamat" autocomplete="off" placeholder="Alamat">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="autoCompleteFruit" class="text-muted">OLT</label>
                                                                <input id="olt" type="text" name="olt" dir="ltr" spellcheck=false autocomplete="off" autocapitalize="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label  class="form-label">Serial Number</label>
                                                                <input type="text" class="form-control" name="sn" autocomplete="off" placeholder="Serial Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label  class="form-label">Tim</label>
                                                                <input type="text" class="form-control" id="tim" name="tim" autocomplete="off" placeholder="Tim Serpo">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label  class="form-label">Keterangan</label>
                                                                <input type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="Keterangan">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label  class="form-label">Prioritas</label>
                                                            <select class="form-select mb-3" aria-label="Default select example" name="prioritas" >
                                                                <option value="Normal">Normal</option>
                                                                <option value="High">High</option>
                                                                <option value="Low">Low</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label  class="form-label">Kecamatan</label>
                                                                <input type="text" class="form-control" name="kec" autocomplete="off" required placeholder="Kecamatan">
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
                                                <h5 class="modal-title" id="exampleModalgridLabel">Edit Ticket</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label class="form-label">Incident</label>
                                                            <input type="text" class="form-control" name="editincident" id="editincident" autocomplete="off" placeholder="Incident">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label  class="form-label">Tiket</label>
                                                            <input type="text" class="form-control" name="edittiket" disabled id="edittiket" autocomplete="off" placeholder="Tiket">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label  class="form-label">Tanggal</label>
                                                            <input type="text" class="form-control" name="edittanggal" id="edittanggal" autocomplete="off" placeholder="Tanggal">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label  class="form-label">SID</label>
                                                            <input type="text" class="form-control" name="editsid" id="editsid" autocomplete="off" placeholder="SID">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label  class="form-label">Telepon</label>
                                                            <input type="text" class="form-control" name="edittelepon" id="edittelepon" autocomplete="off" placeholder="Telepon">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label  class="form-label">Nama</label>
                                                            <input type="text" class="form-control" name="editnama" id="editnama" autocomplete="off" placeholder="Nama Pelanggan">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <label  class="form-label">Keluhan</label>
                                                        <select class="form-select mb-3" name="editkeluhan" id="editkeluhan" aria-label="Default select example">
                                                            <option value="LINK LOSS">LINK LOSS</option>
                                                            <option value="ONT PROBLEM">ONT PROBLEM</option>
                                                            <option value="BAD RX">BAD RX</option>
                                                            <option value="SET VLAN">SET VLAN</option>
                                                            <option value="CABLE PROBLEM">CABLE PROBLEM</option>
                                                            <option value="SETTING PASSWORD">SETTING PASSWORD</option>
                                                            <option value="INTERNET DOWN/NO INTERNET">INTERNET DOWN/NO INTERNET</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label  class="form-label">Alamat</label>
                                                            <input type="text" class="form-control" name="editalamat" id="editalamat" autocomplete="off" placeholder="Alamat">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label for="olt" class="form-label">OLT</label>
                                                            <input type="text" class="form-control" name="editolt" id="editolt" autocomplete="off" placeholder="OLT">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label  class="form-label">Serial Number</label>
                                                            <input type="text" class="form-control" id="editsn" name="editsn" autocomplete="off" placeholder="Serial Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label  class="form-label">Tim</label>
                                                            <input type="text" class="form-control" id="edittim" name="edittim" autocomplete="off" placeholder="Tim Serpo">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label  class="form-label">Keterangan</label>
                                                            <input type="text" class="form-control" id="editketerangan" name="editketerangan" autocomplete="off" placeholder="Keterangan">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <label  class="form-label">Prioritas</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="editprioritas" id="editprioritas">
                                                            <option value="Normal">Normal</option>
                                                            <option value="High">High</option>
                                                            <option value="Low">Low</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                            <label  class="form-label">Status</label>
                                                            <select class="form-select mb-3" aria-label="Default select example" id="editstatus" name="editstatus" >
                                                                <option value="NEW">NEW</option>
                                                                <option value="OPEN">OPEN</option>
                                                                <option value="ON PROGRESS">ON PROGRESS</option>
                                                                <option value="SOLVED (ICRM OPEN)">SOLVED (ICRM OPEN)</option>
                                                                <option value="CLOSED">CLOSED</option>
                                                                <option value="EARLY">EARLY</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label  class="form-label">Kecamatan</label>
                                                                <input type="text" class="form-control" name="editkec" autocomplete="off" placeholder="Kecamatan">
                                                            </div>
                                                        </div>
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button class="btn btn-primary" id="editsubmitBtn">Submit</button>
                                                        </div>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                </div>
                                <div class="card-body">
                                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Priority</th>
                                                <th>Insiden</th>
                                                <th>Tiket</th>
                                                <th>Tanggal</th>
                                                <!-- <th>Durasi</th> -->
                                                <th>Durasi<br>
                                                    <select id="filterDurasi" class="form-select form-select-sm">
                                                        <option value="">Semua</option>
                                                        <option value="1">1 Hari</option>
                                                        <option value="2">2 Hari</option>
                                                        <option value="3">3 Hari</option>
                                                        <option value="4">4 Hari</option>
                                                        <option value="5">5 Hari</option>
                                                        <option value="6">6 Hari</option>
                                                        <option value="7">7 Hari</option>
                                                        <option value="8">8 Hari</option>
                                                        <option value="9">9 Hari</option>
                                                        <option value="10">10 Hari</option>
                                                    </select>
                                                </th>
                                                <th>SID</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th>OLT</th>
                                                <th>Keterangan</th>
                                                <th>Kendala</th>
                                                <th>Kabupaten
                                                    <!-- <br>
                                                    <select id="filterKabupaten" class="form-select form-select-sm">
                                                        <option value="">Semua</option>
                                                    </select> -->
                                                </th>
                                                <th>Serial Number</th>
                                                <th>Tim</th>
                                                <th>Posisi Antrian</th>
                                                <th>Provinsi</th>
                                                <th>Telepon</th>
                                                <th>Alamat</th>
                                                <th>Last Update By</th>
                                                <th>timestamp</th>
                                                <th  <?php echo $hide;?>>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            date_default_timezone_set('Asia/Makassar');
                                            foreach ($data as $row){
                                                if($row->status=="CLOSED"){
                                                    $a = '<span class="badge bg-success">CLOSED</span>';
                                                }elseif($row->status=="ON PROGRESS"){
                                                    $a = '<span class="badge border border-info text-info">ON PROGRESS</span>';
                                                }elseif($row->status=="NEW"){
                                                    $a = '<span class="badge border border-primary text-primary">NEW</span>';
                                                }elseif($row->status=="SOLVED (ICRM OPEN)"){
                                                    $a = '<span class="badge border border-success text-success">SOLVED (ICRM OPEN)</span>';
                                                }elseif($row->status=="EARLY"){
                                                    $a = '<span class="badge bg-danger">EARLY</span>';
                                                }else{
                                                    $a = '<span class="badge border border-dark text-body">OPEN</span>';
                                                }
                                                $tanggalSekarang = new DateTime();
                                                $durasi1 = new DateTime($row->tanggal);;
                                                $selisih = $durasi1->diff($tanggalSekarang);
                                                $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                                if($row->prioritas=="High"){
                                                    $p = '<span class="badge border border-danger text-danger">High</span>';
                                                }elseif($row->prioritas=="Low"){
                                                    $p = '<span class="badge border border-info text-success">Low</span>';
                                                }else{
                                                    $p = '<span class="badge border border-primary text-primary">Normal</span>';
                                                }
                                                echo "
                                                <tr> 
                                                    <td>".$p."</td>
                                                    <td>".$row->idInsiden."</td>
                                                    <td>".$row->idTiket."</td>
                                                    <td>".$row->tanggal."</td>
                                                    <td>".$durasi."</td>
                                                    <td>".$row->sid."</td>
                                                    <td>".$row->nama."</td>
                                                    <td>".$a."</td>
                                                    <td>".$row->idOlt."</td>
                                                    <td>".$row->keterangan."</td>
                                                    <td>".$row->keluhan."</td>
                                                    <td>".$row->kabupaten."</td>
                                                    <td>".$row->sn."</td>  
                                                    <td>".$row->tim."</td>
                                                    <td>".$row->urutan."</td>  
                                                    <td>".$row->provinsi."</td>
                                                    <td>".$row->telepon."</td> 
                                                    <td>".$row->alamat."</td>
                                                    <td>".$row->createby."</td>  
                                                    <td>".$row->timestamp."</td>  
                                                    <td  ".$hide.">
                                                        <div class='dropdown d-inline-block'>
                                                            <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                                <i class='ri-more-fill align-middle'></i>
                                                            </button>
                                                            <ul class='dropdown-menu dropdown-menu-end'>
                                                                <li><a href='#' class='dropdown-item copy-btn' data-row='".htmlspecialchars(json_encode($row))."'><i class='ri-file-fill align-bottom me-2 text-muted'></i> Copy</a></li>
                                                                <li><a href='#' class='dropdown-item telegram-btn' data-id='".htmlspecialchars(json_encode($row))."'><i class='ri-send-plane-fill align-bottom me-2 text-muted'></i> Telegram</a></li>
                                                                <li>
                                                                    <a href='#' class='dropdown-item edit-item-btn' data-id='".$row->idTiket."' data-editincident='".$row->idInsiden."' data-edittiket='".$row->idTiket."' data-edittanggal='".$row->tanggal."' data-editsid='".$row->sid."' data-edittelepon='".$row->telepon."' data-editnama='".$row->nama."' data-editkeluhan='".$row->keluhan."' data-editalamat='".$row->alamat."' data-editOlt='".$row->idOlt."' data-editsn='".$row->sn."' data-editketerangan='".$row->keterangan."' data-editprioritas='".$row->prioritas."' data-edittim='".$row->tim."' data-editcreateby='".$row->createby."' data-editkabupaten='".$row->kabupaten."' data-editkec='".$row->kecamatan."' data-editprovinsi='".$row->provinsi."' data-urutan='".$row->urutan."' data-timestamp='".$row->timestamp."' data-editstatus='".$row->status."'>
                                                                        <i class='ri-pencil-fill align-bottom me-2 text-muted'></i> Edit
                                                                    </a>
                                                                </li>
                                                                    <a href='#' class='dropdown-item remove-item-btn' data-id=".$row->idTiket.">
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

    <!-- Modal Edit Ticket -->



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
                    url: 'Tickets/autoTim?olt='+oltValue,
                    method: 'GET',
                    success: function (response) {
                        console.log('Response:', response);
                        $('#tim').val(response);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error); 
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
        var table = $('#example').DataTable();
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var selectedHari = $('#filterDurasi').val();
            var durasiText = data[4] || '';
            var match = durasiText.match(/^(\d+)\s+Hari/);
            var hari = match ? match[1] : "";
            return selectedHari === "" || hari === selectedHari;
        });
        $('#filterDurasi').on('change', function() {
            table.draw();
        });
    });
    </script>
    <script>
        // $('#filterKabupaten').on('change', function() {
        //     var table = $('#example').DataTable();
        //     $.fn.dataTable.ext.search.pop(); // Hapus filter lama
        //     $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        //         var selectedKabupaten = $('#filterKabupaten').val();
        //         var kabupatenText = data[11] || '';

        //         return selectedKabupaten === "" || kabupatenText === selectedKabupaten;
        //     });
        //     $('#filterKabupaten').on('change', function() {
        //         table.draw();
        //      });

        // });
    </script>
    <script>
        const button = document.getElementById('toast');
        $(document).ready(function () {
            $('#submitBtn').on('click', function (e) {
                e.preventDefault();
                const formData = {
                    incident: $('[name="incident"]').val(),
                    tiket: $('[name="tiket"]').val(),
                    tanggal: $('[name="tanggal"]').val(),
                    sid: $('[name="sid"]').val(),
                    telepon: $('[name="telepon"]').val(),
                    nama: $('[name="nama"]').val(),
                    keluhan: $('[name="keluhan"]').val(),
                    alamat: $('[name="alamat"]').val(),
                    olt: $('[name="olt"]').val(),
                    sn: $('[name="sn"]').val(),
                    tim: $('[name="tim"]').val(),
                    keterangan: $('[name="keterangan"]').val(),
                    prioritas: $('[name="prioritas"]').val(),
                    kec: $('[name="kec"]').val(),
                };
                if (!formData.incident || !formData.tiket || !formData.tanggal || !formData.sid || !formData.nama) {
                    button.setAttribute('data-toast-text', 'Incident, Ticket, Tanggal, SID, Telepon, Nama Cannot Empty!');
                    button.setAttribute('data-toast-className', 'danger');
                    button.click();
                    return;
                }
                $.ajax({
                    url: 'Tickets/insertData',
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
                console.log('asdasdsadasd');

                e.preventDefault();
                const formData = {
                    incident: $('[name="editincident"]').val(),
                    tiket: $('[name="edittiket"]').val(),
                    tanggal: $('[name="edittanggal"]').val(),
                    sid: $('[name="editsid"]').val(),
                    telepon: $('[name="edittelepon"]').val(),
                    nama: $('[name="editnama"]').val(),
                    keluhan: $('[name="editkeluhan"]').val(),
                    alamat: $('[name="editalamat"]').val(),
                    olt: $('[name="editolt"]').val(),
                    sn: $('[name="editsn"]').val(),
                    tim: $('[name="edittim"]').val(),
                    status: $('[name="editstatus"]').val(),
                    keterangan: $('[name="editketerangan"]').val(),
                    prioritas: $('[name="editprioritas"]').val(),
                    kec: $('[name="editkec"]').val(),
                };
                if (!formData.incident || !formData.tiket || !formData.tanggal || !formData.sid || !formData.nama) {
                    button.setAttribute('data-toast-text', 'Incident, Ticket, Tanggal, SID, Telepon, Nama Cannot Empty!');
                    button.setAttribute('data-toast-className', 'danger');
                    button.click();
                    return;
                }
                $.ajax({
                    url: 'Tickets/editData',
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
                                url: 'Tickets/deleteRow?id='+idTiket,
                                type: 'GET',
                                success: function(response) {
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
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Parse the data-row attribute as a JSON object
                const rowData = JSON.parse(this.getAttribute('data-row'));

const formattedText = `
NO. INCIDENT: ${rowData.idInsiden}
TANGGAL MASUK: ${rowData.tanggal}
NO TIKET: ${rowData.idTiket}
SID/CRM ID: ${rowData.sid}
TELEPON: ${rowData.telepon}
NAMA: ${rowData.nama}
KELUHAN: ${rowData.keluhan}
ALAMAT: ${rowData.alamat}
TERMINATING: ${rowData.idOlt}/${rowData.sn}
`;
                navigator.clipboard.writeText(formattedText).then(function() {
                    const formatt = `${rowData.idTiket} Copied!`
                    // alert("Data copied to clipboard!");
                    const button = document.getElementById('toast');
                    button.setAttribute('data-toast-text', formatt);
                    button.setAttribute('data-toast-className', 'success');
                    button.click();
                }, function(err) {
                    alert("Failed to copy text: " + err);
                });
            });
        });
    });
    </script>

<!-- Telegram -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.telegram-btn').forEach(button => {
            button.addEventListener('click', function() {
                const button1 = document.getElementById('toast');
                const rowData = JSON.parse(this.getAttribute('data-id'));

const formattedText = `
NEW AR

NO. INCIDENT: ${rowData.idInsiden}
TANGGAL MASUK: ${rowData.tanggal}
NO TIKET: ${rowData.idTiket}
SID/CRM ID: ${rowData.sid}
TELEPON: ${rowData.telepon}
NAMA: ${rowData.nama}
KELUHAN: ${rowData.keluhan}
ALAMAT: ${rowData.alamat}
TERMINATING: ${rowData.idOlt}/${rowData.sn}
`;
                // navigator.clipboard.writeText(formattedText).then(function() {
                    $.ajax({
                        url: 'Tickets/sendTelegram',
                        type: 'POST',
                        data: {'data':formattedText, 'tim':rowData.tim},
                        success: function (response) {
                            // console.log(response);
                            if(response){
                                button1.setAttribute('data-toast-text', 'Sent Success!');
                                button1.setAttribute('data-toast-className', 'success');
                                button1.click();
                                // location.reload();
                            }else{
                                button1.setAttribute('data-toast-text', 'Failed!');
                                button1.setAttribute('data-toast-className', 'danger');
                                button1.click();   
                            }
                        },
                        error: function (xhr, status, error) {
                            button1.setAttribute('data-toast-text', error);
                            button1.setAttribute('data-toast-className', 'danger');
                            button1.click();
                        }
                    });
                // }, function(err) {
                //     alert("Failed to copy text: " + err);
                // });
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
                'editincident', 'edittiket', 'edittanggal', 'editsid', 'edittelepon', 'editnama', 'editkeluhan', 'editalamat',
                'editolt', 'editsn', 'editketerangan', 'editprioritas', 'edittim', 'editstatus', 'editkabupaten', 'editkec', 'editprovinsi', 'editurutan', 'edittimestamp'
            ];
            fields.forEach(field => {
                const inputElement = document.getElementById(field);
                if (inputElement) {
                    console.log(`Setting ${field} with value:`, ticketData[field]);
                    inputElement.value = ticketData[field] || '';
                }
            });
            modal.show();
        });
    });
});

    </script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const table = new DataTable('#example', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
        order: [[19, 'desc']],
        columnDefs: [
            {
                targets: 20,
                className: 'priority-column',
                responsivePriority: 1
            },
        ],
        responsive: true
    });

    // Event filtering
    $('#filterProvinsi, #filterKabupaten, #filterTim, #filterStatus').on('change', function () {
        table.column(15).search($('#filterProvinsi').val(), false, false);
        table.column(11).search($('#filterKabupaten').val(), false, false);
        table.column(13).search($('#filterTim').val(), false, false);
        table.column(7).search($('#filterStatus').val(), false, false);
        table.draw();
    });
});
</script>
</body>


<!-- Mirrored from Srisyaha.com/velzon/html/default/tables-datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:19:48 GMT -->
</html>