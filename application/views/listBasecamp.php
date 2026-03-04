

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Basecamp</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">List Basecamp</h5><br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                                                Add New Basecamp
                                            </button>
                                            <button hidden type="button" data-toast data-toast-text="" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" id="toast" class="btn btn-light w-xs"></button>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalgridLabel">New Basecamp</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">KP</label>
                                                                <input type="text" class="form-control" name="kp" id="kp" autocomplete="off" placeholder="KP">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Mitra</label>
                                                                <input type="text" class="form-control" name="mitra" id="mitra" autocomplete="off" placeholder="Mitra">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Latitude</label>
                                                                <input type="text" class="form-control" name="lat" id="lat" autocomplete="off" placeholder="Latitude">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Longitude</label>
                                                                <input type="text" class="form-control" name="longi" id="longi" autocomplete="off" placeholder="Longitude">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">SLOC</label>
                                                                <input type="text" class="form-control" name="sloc" id="sloc" autocomplete="off" placeholder="SLOC">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Nama Akun</label>
                                                                <input type="text" class="form-control" name="namaAkun" id="namaAkun" autocomplete="off" placeholder="Nama Akun">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Kendaraan</label>
                                                                <input type="text" class="form-control" name="kendaraan" id="kendaraan" autocomplete="off" placeholder="Kendaraan">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" id="submitBtn">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- edit modal -->
                                    <div class="modal fade" id="exampleModalgridEdit" tabindex="-1" aria-labelledby="exampleModalgridEditLabel" aria-modal="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalgridEditLabel">Edit Basecamp</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <input type="hidden" class="form-control" name="editidBc" id="editidBc" autocomplete="off">
                                                                <label class="form-label">KP</label>
                                                                <input type="text" class="form-control" name="editkp" id="editkp" autocomplete="off" placeholder="KP">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Mitra</label>
                                                                <input type="text" class="form-control" name="editmitra" id="editmitra" autocomplete="off" placeholder="Mitra">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Latitude</label>
                                                                <input type="text" class="form-control" name="editlat" id="editlat" autocomplete="off" placeholder="Latitude">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Longitude</label>
                                                                <input type="text" class="form-control" name="editlongi" id="editlongi" autocomplete="off" placeholder="Longitude">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">SLOC</label>
                                                                <input type="text" class="form-control" name="editsloc" id="editsloc" autocomplete="off" placeholder="SLOC">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Nama Akun</label>
                                                                <input type="text" class="form-control" name="editnamaAkun" id="editnamaAkun" autocomplete="off" placeholder="Nama Akun">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Kendaraan</label>
                                                                <input type="text" class="form-control" name="editkendaraan" id="editkendaraan" autocomplete="off" placeholder="Kendaraan">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" id="editsubmitBtn">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <table id="databc" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>idBc</th>
                                                <th>KP</th>
                                                <th>Mitra</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>SLOC</th>
                                                <th>Nama Akun</th>
                                                <th>Kendaraan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($basecamp as $row){
                                                echo "<tr>";
                                                echo "<td>".$row->idBc."</td>";
                                                echo "<td>".$row->kp."</td>";
                                                echo "<td>".$row->mitra."</td>";
                                                echo "<td>".$row->lat."</td>";
                                                echo "<td>".$row->longi."</td>";
                                                echo "<td>".$row->sloc."</td>";
                                                echo "<td>".$row->namaAkun."</td>";
                                                echo "<td>".$row->kendaraan."</td>";
                                                echo "<td>\n                                                <div class='dropdown d-inline-block'>\n                                                    <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>\n                                                        <i class='ri-more-fill align-middle'></i>\n                                                    </button>\n                                                    <ul class='dropdown-menu dropdown-menu-end'>\n                                                        <li><a href='#' class='dropdown-item edit-item-btn' data-idBc='".$row->idBc."' data-kp='".$row->kp."' data-mitra='".$row->mitra."' data-lat='".$row->lat."' data-longi='".$row->longi."' data-sloc='".$row->sloc."' data-namaAkun='".$row->namaAkun."' data-kendaraan='".$row->kendaraan."'> <i class='ri-pencil-fill align-bottom me-2 text-muted'></i> Edit</a></li>\n                                                        <li><a href='#' class='dropdown-item remove-item-btn' data-idBc='".$row->idBc."'> <i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Delete</a></li>\n                                                    </ul>\n                                                </div>\n                                            </td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div>
        </div>

<script>
    const button = document.getElementById('toast');
    $(document).ready(function () {
        $('#submitBtn').on('click', function (e) {
            e.preventDefault();
            const formData = {
                kp: $('[name="kp"]').val(),
                mitra: $('[name="mitra"]').val(),
                lat: $('[name="lat"]').val(),
                longi: $('[name="longi"]').val(),
                sloc: $('[name="sloc"]').val(),
                namaAkun: $('[name="namaAkun"]').val(),
                kendaraan: $('[name="kendaraan"]').val()
            };
            if (!formData.mitra) {
                button.setAttribute('data-toast-text', 'Mitra Cannot Empty!');
                button.setAttribute('data-toast-className', 'danger');
                button.click();
                return;
            }
            $.ajax({
                url: 'Basecamp/insertData',
                type: 'POST',
                data: formData,
                success: function (response) {
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

        document.addEventListener('click', function (e) {
            if (e.target && e.target.matches('.remove-item-btn')) {
                e.preventDefault();
                const id = e.target.getAttribute('data-idBc');
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
                            url: 'Basecamp/deleteRow?id='+id,
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
            }
        });
    });
</script>
<script>
    // Initialize DataTable for Basecamp list
    $(document).ready(function(){
        if ($.fn.DataTable) {
            $('#databc').DataTable({
                lengthMenu: [[-1,10,25,50], ['All',10,25,50]],
                responsive: true
            });
        }
    });
</script>
    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>

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

    <!-- multi.js -->
    <script src="assets/libs/multi.js/multi.min.js"></script>
    <!-- autocomplete js -->
    <script src="assets/libs/%40tarekraafat/autocomplete.js/autoComplete.min.js"></script>
    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="assets/js/plugins.js"></script>

    <script src="assets/js/app.js"></script>
<script>
    // Edit basecamp handler
    document.addEventListener('click', function (e) {
        if (e.target && e.target.matches('.edit-item-btn')) {
            e.preventDefault();
            const el = e.target;
            const id = el.getAttribute('data-idBc');
            const kp = el.getAttribute('data-kp');
            const mitra = el.getAttribute('data-mitra');
            const lat = el.getAttribute('data-lat');
            const longi = el.getAttribute('data-longi');
            const sloc = el.getAttribute('data-sloc');
            const namaAkun = el.getAttribute('data-namaAkun');
            const kendaraan = el.getAttribute('data-kendaraan');
            $('#editidBc').val(id);
            $('#editkp').val(kp);
            $('#editmitra').val(mitra);
            $('#editlat').val(lat);
            $('#editlongi').val(longi);
            $('#editsloc').val(sloc);
            $('#editnamaAkun').val(namaAkun);
            $('#editkendaraan').val(kendaraan);
            var modal = new bootstrap.Modal(document.getElementById('exampleModalgridEdit'));
            modal.show();
        }
    });

    $(document).ready(function () {
        $('#editsubmitBtn').on('click', function (e) {
            e.preventDefault();
            const formData = {
                idBc: $('[name="editidBc"]').val(),
                kp: $('[name="editkp"]').val(),
                mitra: $('[name="editmitra"]').val(),
                lat: $('[name="editlat"]').val(),
                longi: $('[name="editlongi"]').val(),
                sloc: $('[name="editsloc"]').val(),
                namaAkun: $('[name="editnamaAkun"]').val(),
                kendaraan: $('[name="editkendaraan"]').val()
            };
            if (!formData.mitra) {
                const button = document.getElementById('toast');
                button.setAttribute('data-toast-text', 'Mitra Cannot Empty!');
                button.setAttribute('data-toast-className', 'danger');
                button.click();
                return;
            }
            $.ajax({
                url: 'Basecamp/editData',
                type: 'POST',
                data: formData,
                success: function (response) {
                    if(response=='success'){
                        const button = document.getElementById('toast');
                        button.setAttribute('data-toast-text', 'Data Updated!');
                        button.setAttribute('data-toast-className', 'success');
                        button.click();
                        location.reload();
                    }else{
                        const button = document.getElementById('toast');
                        button.setAttribute('data-toast-text', response);
                        button.setAttribute('data-toast-className', 'danger');
                        button.click();
                    }
                },
                error: function () {
                    const button = document.getElementById('toast');
                    button.setAttribute('data-toast-text', 'Error');
                    button.setAttribute('data-toast-className', 'danger');
                    button.click();
                }
            });
        });
    });
</script>
