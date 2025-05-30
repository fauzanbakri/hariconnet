
    
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
                                <h4 class="mb-sm-0">List Permohonan All</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Permohonan</a></li>
                                        <li class="breadcrumb-item active">List Permohonan All</li>
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
                                    <h5 class="card-title mb-0">List Permohonan All</h5><br>
                                    <!-- Base Buttons -->
                                     <!-- Grids in modals -->
                                <!-- Grids in modals -->
                                 <div class="row">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                                            Add New
                                        </button>
                                    </div>
                                    <div class="col-md-9 d-flex flex-row-reverse">
                                        <button hidden type="button" data-toast data-toast-text="" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" id="toast" class="btn btn-light w-xs"></button>
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
                                                                <label for="lastName" class="form-label">Tiket</label>
                                                                <input type="text" class="form-control" name="tiket" id="lastName" autocomplete="off" placeholder="Tiket">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Tanggal</label>
                                                                <input type="text" class="form-control" name="tanggal" id="lastName" autocomplete="off" placeholder="Tanggal">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">SID</label>
                                                                <input type="text" class="form-control" name="sid" id="lastName" autocomplete="off" placeholder="SID">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Telepon</label>
                                                                <input type="text" class="form-control" name="telepon" id="lastName" autocomplete="off" placeholder="Telepon">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Nama</label>
                                                                <input type="text" class="form-control" name="nama" id="lastName" autocomplete="off" placeholder="Nama Pelanggan">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Keluhan</label>
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
                                                                <label for="lastName" class="form-label">Alamat</label>
                                                                <input type="text" class="form-control" name="alamat" id="lastName" autocomplete="off" placeholder="Alamat">
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
                                                                <label for="lastName" class="form-label">Serial Number</label>
                                                                <input type="text" class="form-control" id="lastName" name="sn" autocomplete="off" placeholder="Serial Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Tim</label>
                                                                <input type="text" class="form-control" id="tim" name="tim" autocomplete="off" placeholder="Tim Serpo">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Keterangan</label>
                                                                <input type="text" class="form-control" id="lastName" name="keterangan" autocomplete="off" placeholder="Keterangan">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Prioritas</label>
                                                            <select class="form-select mb-3" aria-label="Default select example" name="prioritas" >
                                                                <option value="Normal">Normal</option>
                                                                <option value="High">High</option>
                                                                <option value="Low">Low</option>
                                                            </select>
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
                                                            <label for="lastName" class="form-label">Tiket</label>
                                                            <input type="text" class="form-control" name="edittiket" disabled id="edittiket" autocomplete="off" placeholder="Tiket">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label for="lastName" class="form-label">Tanggal</label>
                                                            <input type="text" class="form-control" name="edittanggal" id="edittanggal" autocomplete="off" placeholder="Tanggal">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label for="lastName" class="form-label">SID</label>
                                                            <input type="text" class="form-control" name="editsid" id="editsid" autocomplete="off" placeholder="SID">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label for="lastName" class="form-label">Telepon</label>
                                                            <input type="text" class="form-control" name="edittelepon" id="edittelepon" autocomplete="off" placeholder="Telepon">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label for="lastName" class="form-label">Nama</label>
                                                            <input type="text" class="form-control" name="editnama" id="editnama" autocomplete="off" placeholder="Nama Pelanggan">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <label for="lastName" class="form-label">Keluhan</label>
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
                                                            <label for="lastName" class="form-label">Alamat</label>
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
                                                            <label for="lastName" class="form-label">Serial Number</label>
                                                            <input type="text" class="form-control" id="editsn" name="editsn" autocomplete="off" placeholder="Serial Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label for="lastName" class="form-label">Tim</label>
                                                            <input type="text" class="form-control" id="edittim" name="edittim" autocomplete="off" placeholder="Tim Serpo">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label for="lastName" class="form-label">Keterangan</label>
                                                            <input type="text" class="form-control" id="editketerangan" name="editketerangan" autocomplete="off" placeholder="Keterangan">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <label for="lastName" class="form-label">Prioritas</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="editprioritas" id="editprioritas">
                                                            <option value="Normal">Normal</option>
                                                            <option value="High">High</option>
                                                            <option value="Low">Low</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Status</label>
                                                            <select class="form-select mb-3" aria-label="Default select example" id="editstatus" name="editstatus" >
                                                                <option value="NEW">NEW</option>
                                                                <option value="OPEN">OPEN</option>
                                                                <option value="ON PROGRESS">ON PROGRESS</option>
                                                                <option value="SOLVED (ICRM OPEN)">SOLVED (ICRM OPEN)</option>
                                                                <option value="CLOSED">CLOSED</option>
                                                                <option value="EARLY">EARLY</option>
                                                            </select>
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
                                    <table id="tabelpermohonan" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID Permohonan</th>
                                                <th>Tanggal Permohonan</th>
                                                <th>Nama Pemohon</th>
                                                <th>Aging</th>
                                                <th>Status</th>
                                                <th>No Telepon</th>
                                                <th>Alamat</th>
                                                <th>Daerah</th>
                                                <th>PIC</th>
                                                <th>Koordinat Pemohon</th>
                                                <th>ID PA</th>
                                                <th>Produk</th>
                                                <th>Nama PTL</th>
                                                <th>Mitra Agen</th>
                                                <th>Nama Agen</th>
                                                <th>Posisi Agen</th>
                                                <th>Mitra Aktivasi</th>
                                                <th>Petugas Lapangan</th>
                                                <th>Koordinat Splitter</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Tanggal Disposisi</th>
                                                <th>OLT</th>
                                                <th>Regional</th>
                                                <th>Kantor Perwakilan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            date_default_timezone_set('Asia/Makassar');
                                            
                                            foreach ($permohonan as $row) {
                                                $tanggalSekarang = new DateTime();
                                                $durasi1 = new DateTime($row->tgl_permohonan);;
                                                $selisih = $durasi1->diff($tanggalSekarang);
                                                $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                                echo "
                                                <tr>
                                                    <td>{$row->id_permohonan}</td>
                                                    <td>{$row->tgl_permohonan}</td>
                                                    <td>{$row->nama_pemohon}</td>
                                                    <td>{$durasi}</td>
                                                    <td><span class='badge bg-" . ($row->status == 'CLOSED' ? 'success' : ($row->status == 'ON PROGRESS' ? 'info' : ($row->status == 'NEW' ? 'primary' : 'secondary'))) . "'>{$row->status}</span></td>
                                                    <td>{$row->no_telepon}</td>
                                                    <td>{$row->alamat}</td>
                                                    <td>{$row->daerah}</td>
                                                    <td>{$row->pic}</td>
                                                    <td>{$row->lat_pemohon}, {$row->long_pemohon}</td>
                                                    <td>{$row->id_pa}</td>
                                                    <td>{$row->produk}</td>
                                                    <td>{$row->nama_ptl}</td>
                                                    <td>{$row->mitra_agen}</td>
                                                    <td>{$row->nama_agen}</td>
                                                    <td>{$row->posisi_agen}</td>
                                                    <td>{$row->mitra_aktivasi}</td>
                                                    <td>{$row->petugas_lapangan}</td>
                                                    <td>{$row->lat_splitter}, {$row->long_splitter}</td>
                                                    <td>{$row->tgl_pembayaran}</td>
                                                    <td>{$row->tgl_disposisi}</td>
                                                    <td>{$row->olt}</td>
                                                    <td>{$row->regional}</td>
                                                    <td>{$row->kantor_perwakilan}</td>
                                                    <td>
                                                        <div class='dropdown d-inline-block'>
                                                            <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                                <i class='ri-more-fill align-middle'></i>
                                                            </button>
                                                            <ul class='dropdown-menu dropdown-menu-end'>
                                                                <li><a href='/ListPermohonanAll/edit/{$row->id_permohonan}' class='dropdown-item'><i class='ri-pencil-fill align-bottom me-2 text-muted'></i> Edit</a></li>
                                                                <li><a href='/ListPermohonanAll/delete/{$row->id_permohonan}' class='dropdown-item' onclick='return confirm(\"Apakah Anda yakin ingin menghapus permohonan ini?\");'><i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Delete</a></li>
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
                'editolt', 'editsn', 'editketerangan', 'editprioritas', 'edittim', 'editstatus', 'editkabupaten', 'editprovinsi', 'editurutan', 'edittimestamp'
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
</body>


<!-- Mirrored from Srisyaha.com/velzon/html/default/tables-datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:19:48 GMT -->
</html>