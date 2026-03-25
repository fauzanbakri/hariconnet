<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Monitoring Internal</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Monitoring Internal</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($table_missing)) { ?>
                <div class="alert alert-warning" role="alert">
                    Tabel Monitoring Internal belum ditemukan. Gunakan salah satu nama tabel: <strong>monitoring_internal</strong>, <strong>monitoringinternal</strong>, atau <strong>internal</strong>.
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Data Monitoring Internal</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="monitoringInternalTable" class="table table-bordered table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width:60px;">No</th>
                                            <th>Nama</th>
                                            <th>Segmen</th>
                                            <th>Incident</th>
                                            <th>Tanggal</th>
                                            <th style="width:120px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach (($rows ?? []) as $row) { ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($row->nama ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($row->segmen ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($row->incident ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($row->tanggal ?? ''); ?></td>
                                                <td>
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a href="#" class="dropdown-item edit-item-btn"
                                                                data-id="<?php echo (int)($row->id ?? 0); ?>"
                                                                data-nama="<?php echo htmlspecialchars($row->nama ?? '', ENT_QUOTES); ?>"
                                                                data-segmen="<?php echo htmlspecialchars($row->segmen ?? '', ENT_QUOTES); ?>"
                                                                data-incident="<?php echo htmlspecialchars($row->incident ?? '', ENT_QUOTES); ?>"
                                                                data-tanggal="<?php echo htmlspecialchars($row->tanggal ?? '', ENT_QUOTES); ?>"
                                                            ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                                            <li><a href="#" class="dropdown-item remove-item-btn" data-id="<?php echo (int)($row->id ?? 0); ?>"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Monitoring Internal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" id="addNama" placeholder="Nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Segmen</label>
                    <input type="text" class="form-control" id="addSegmen" placeholder="Segmen">
                </div>
                <div class="mb-3">
                    <label class="form-label">Incident</label>
                    <input type="text" class="form-control" id="addIncident" placeholder="Incident">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="addTanggal" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveAddBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Monitoring Internal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editId">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" id="editNama" placeholder="Nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Segmen</label>
                    <input type="text" class="form-control" id="editSegmen" placeholder="Segmen">
                </div>
                <div class="mb-3">
                    <label class="form-label">Incident</label>
                    <input type="text" class="form-control" id="editIncident" placeholder="Incident">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="editTanggal">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveEditBtn">Update</button>
            </div>
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
(function($){
    if ($.fn.DataTable) {
        $('#monitoringInternalTable').DataTable({
            pageLength: 25,
            order: [[4, 'desc']]
        });
    }

    function validatePayload(payload){
        return payload.nama && payload.segmen && payload.incident && payload.tanggal;
    }

    $('#saveAddBtn').on('click', function(){
        var payload = {
            nama: $('#addNama').val().trim(),
            segmen: $('#addSegmen').val().trim(),
            incident: $('#addIncident').val().trim(),
            tanggal: $('#addTanggal').val()
        };

        if (!validatePayload(payload)) {
            alert('Harap isi semua field.');
            return;
        }

        $.post('MonitoringInternal/insertData', payload, function(res){
            if ((res || '').toString().trim() === 'success') {
                location.reload();
            } else {
                alert(res || 'Gagal menyimpan data');
            }
        });
    });

    $(document).on('click', '.edit-item-btn', function(e){
        e.preventDefault();
        var $el = $(this);
        $('#editId').val($el.data('id'));
        $('#editNama').val($el.data('nama'));
        $('#editSegmen').val($el.data('segmen'));
        $('#editIncident').val($el.data('incident'));
        $('#editTanggal').val($el.data('tanggal'));
        new bootstrap.Modal(document.getElementById('editModal')).show();
    });

    $('#saveEditBtn').on('click', function(){
        var payload = {
            id: $('#editId').val(),
            nama: $('#editNama').val().trim(),
            segmen: $('#editSegmen').val().trim(),
            incident: $('#editIncident').val().trim(),
            tanggal: $('#editTanggal').val()
        };

        if (!payload.id || !validatePayload(payload)) {
            alert('Harap isi semua field.');
            return;
        }

        $.post('MonitoringInternal/editData', payload, function(res){
            if ((res || '').toString().trim() === 'success') {
                location.reload();
            } else {
                alert(res || 'Gagal mengubah data');
            }
        });
    });

    $(document).on('click', '.remove-item-btn', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if (!id) return;
        if (!confirm('Hapus data ini?')) return;

        $.post('MonitoringInternal/deleteRow', {id:id}, function(res){
            if ((res || '').toString().trim() === 'success') {
                location.reload();
            } else {
                alert(res || 'Gagal menghapus data');
            }
        });
    });
})(jQuery);
</script>
