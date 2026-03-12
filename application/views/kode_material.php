
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Kode Material</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">List Kode Material</h5><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalgrid">Add New Kode Material</button>
                                    <button hidden type="button" data-toast data-toast-text="" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" id="toast" class="btn btn-light w-xs"></button>
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalgridLabel">New Kode Material</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-xxl-6">
                                                    <div>
                                                        <label class="form-label">Kode Material</label>
                                                        <input type="text" class="form-control" name="kode_material" id="kode_material" autocomplete="off" placeholder="Kode Material">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6">
                                                    <div>
                                                        <label class="form-label">Deskripsi</label>
                                                        <input type="text" class="form-control" name="deskripsi_material" id="deskripsi_material" autocomplete="off" placeholder="Deskripsi">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6">
                                                    <div>
                                                        <label class="form-label">Kategori</label>
                                                        <input type="text" class="form-control" name="kategori" id="kategori" autocomplete="off" placeholder="Kategori">
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
                                            <h5 class="modal-title" id="exampleModalgridEditLabel">Edit Kode Material</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-xxl-6">
                                                    <div>
                                                        <input type="hidden" id="editkode_material" name="editkode_material">
                                                        <label class="form-label">Kode Material</label>
                                                        <input type="text" class="form-control" name="editkode_material_display" id="editkode_material_display" autocomplete="off" placeholder="Kode Material" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6">
                                                    <div>
                                                        <label class="form-label">Deskripsi</label>
                                                        <input type="text" class="form-control" name="editdeskripsi_material" id="editdeskripsi_material" autocomplete="off" placeholder="Deskripsi">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6">
                                                    <div>
                                                        <label class="form-label">Kategori</label>
                                                        <input type="text" class="form-control" name="editkategori" id="editkategori" autocomplete="off" placeholder="Kategori">
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
                            <table id="datakm" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Deskripsi</th>
                                        <th>Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($kode_material as $row){
                                        $escDesc = htmlspecialchars($row->deskripsi_material, ENT_QUOTES);
                                        $escKat = htmlspecialchars($row->kategori, ENT_QUOTES);
                                        echo "<tr>";
                                        echo "<td>" . $row->kode_material . "</td>";
                                        echo "<td>" . $escDesc . "</td>";
                                        echo "<td>" . $escKat . "</td>";
                                        $dataAttrs = "data-kode_material='" . htmlspecialchars($row->kode_material, ENT_QUOTES) . "' " .
                                                     "data-deskripsi_material='" . $escDesc . "' " .
                                                     "data-kategori='" . $escKat . "'";
                                        echo "<td>\n  <div class='dropdown d-inline-block'>\n    <button class='btn btn-soft-secondary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>\n      <i class='ri-more-fill align-middle'></i>\n    </button>\n    <ul class='dropdown-menu dropdown-menu-end'>\n      <li><a href='#' class='dropdown-item edit-item-btn ' " . $dataAttrs . "><i class='ri-pencil-fill align-bottom me-2 text-muted'></i> Edit</a></li>\n      <li><a href='#' class='dropdown-item remove-item-btn' data-id='" . $row->kode_material . "'><i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Delete</a></li>\n    </ul>\n  </div>\n</td>";
                                        echo "</tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
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
$(document).ready(function(){
    var table = $('#datakm').DataTable({
        lengthMenu: [[10,25,50,-1],[10,25,50,'All']],
        pageLength: 10,
        responsive: true
    });

    $('#submitBtn').on('click', function(e){
        e.preventDefault();
        var formData = {
            kode_material: $('#kode_material').val(),
            deskripsi_material: $('#deskripsi_material').val(),
            kategori: $('#kategori').val()
        };
        if(!formData.kode_material){ alert('Kode wajib diisi'); return; }
        $.post('KodeMaterial/insertData', formData, function(res){ if(res=='success'){ location.reload(); } else { alert('Gagal menyimpan'); } });
    });

    $(document).on('click', '.edit-item-btn', function(e){
        e.preventDefault();
        var d = $(this).data();
        $('#editkode_material').val(d.kode_material);
        $('#editkode_material_display').val(d.kode_material);
        $('#editdeskripsi_material').val(d.deskripsi_material);
        $('#editkategori').val(d.kategori);
        new bootstrap.Modal(document.getElementById('exampleModalgridEdit')).show();
    });

    $('#editsubmitBtn').on('click', function(e){
        e.preventDefault();
        var formData = {
            kode_material: $('#editkode_material').val(),
            deskripsi_material: $('#editdeskripsi_material').val(),
            kategori: $('#editkategori').val()
        };
        if(!formData.kode_material){ alert('Invalid id'); return; }
        $.post('KodeMaterial/editData', formData, function(res){ if(res=='success'){ location.reload(); } else { alert('Gagal update'); } });
    });

    $(document).on('click', '.remove-item-btn', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if(!confirm('Hapus kode material ini?')) return;
        $.get('KodeMaterial/deleteRow?id='+encodeURIComponent(id), function(res){
            try{ var j = JSON.parse(res); if(j.success){ location.reload(); } else { alert('Gagal hapus'); } }catch(e){ alert('Gagal hapus'); }
        });
    });
});
</script>

*** End Patch