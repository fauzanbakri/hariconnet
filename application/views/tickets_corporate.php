<div class="main-content">
    <link href="js/cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">All Tickets Corporate</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tickets</a></li>
                                <li class="breadcrumb-item active">All Tickets Corporate</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Incident Corporate</h5><br>
                            <div class="row g-3 mb-2">
                                <div class="col-md-3">
                                    <?php if($_SESSION['role']!='Resepsionis' && $_SESSION['role']!='Guest 1'){ ?>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCorporateModal">Add New Incident</button>
                                    <?php } ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="filterSegmen" class="form-label">Segmen</label>
                                    <select id="filterSegmen" class="form-select form-select-sm">
                                        <option value="">Semua</option>
                                        <?php foreach(($segmen ?? []) as $s){ echo '<option value="'.htmlspecialchars($s).'">'.htmlspecialchars($s).'</option>'; } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="filterStatus" class="form-label">Status</label>
                                    <select id="filterStatus" class="form-select form-select-sm">
                                        <option value="">Semua</option>
                                        <?php foreach(($status ?? []) as $s){ echo '<option value="'.htmlspecialchars($s).'">'.htmlspecialchars($s).'</option>'; } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="filterTim" class="form-label">Tim</label>
                                    <select id="filterTim" class="form-select form-select-sm">
                                        <option value="">Semua</option>
                                        <?php
                                            $timOptions = [];
                                            foreach(($data ?? []) as $r){
                                                $nm = isset($r->tim_nama) ? $r->tim_nama : '';
                                                if($nm !== '') $timOptions[$nm] = true;
                                            }
                                            $timKeys = array_keys($timOptions);
                                            sort($timKeys);
                                            foreach($timKeys as $nm){ echo '<option value="'.htmlspecialchars($nm).'">'.htmlspecialchars($nm).'</option>'; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dataCorporate" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Incident</th>
                                        <th>Segmen</th>
                                        <th>KP</th>
                                        <th>Tim</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach(($data ?? []) as $row){ ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row->incident ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($row->segmen ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($row->kp ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($row->tim_nama ?? '-'); ?></td>
                                            <td>
                                                <?php
                                                    $statusText = strtoupper(trim((string)($row->status ?? '')));
                                                    $statusClass = 'bg-secondary';
                                                    if ($statusText === 'OPEN' || $statusText === 'ANTRIAN' || $statusText === 'NEW') {
                                                        $statusClass = 'bg-primary';
                                                    } elseif ($statusText === 'ON PROGRESS' || $statusText === 'STOPCLOCK') {
                                                        $statusClass = 'bg-warning text-dark';
                                                    } elseif (strpos($statusText, 'SOLVED') !== false || $statusText === 'CLOSED') {
                                                        $statusClass = 'bg-success';
                                                    }
                                                ?>
                                                <span class="badge <?php echo $statusClass; ?>"><?php echo htmlspecialchars($row->status ?? ''); ?></span>
                                            </td>
                                            <td><?php echo htmlspecialchars($row->keterangan ?? ''); ?></td>
                                            <td>
                                                <div class='dropdown d-inline-block'>
                                                    <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                        <i class='ri-more-fill align-middle'></i>
                                                    </button>
                                                    <ul class='dropdown-menu dropdown-menu-end'>
                                                        <li>
                                                            <a href='#' class='dropdown-item edit-item-btn'
                                                               data-id='<?php echo (int)($row->id ?? 0); ?>'
                                                               data-incident='<?php echo htmlspecialchars($row->incident ?? '', ENT_QUOTES); ?>'
                                                               data-idtim='<?php echo htmlspecialchars($row->idTim ?? '', ENT_QUOTES); ?>'
                                                               data-segmen='<?php echo htmlspecialchars($row->segmen ?? '', ENT_QUOTES); ?>'
                                                               data-status='<?php echo htmlspecialchars($row->status ?? '', ENT_QUOTES); ?>'
                                                               data-keterangan='<?php echo htmlspecialchars($row->keterangan ?? '', ENT_QUOTES); ?>'>
                                                                <i class='ri-pencil-fill align-bottom me-2 text-muted'></i> Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href='#' class='dropdown-item remove-item-btn' data-id='<?php echo (int)($row->id ?? 0); ?>'>
                                                                <i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Delete
                                                            </a>
                                                        </li>
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

<div class="modal fade" id="addCorporateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Corporate Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Incident</label>
                        <input type="text" class="form-control" id="incident" placeholder="Incident">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Segmen</label>
                        <select class="form-select" id="segmen">
                            <option value="">Pilih Segmen</option>
                            <option value="FTTH AKSES">FTTH AKSES</option>
                            <option value="FTTH DISTRIBUSI">FTTH DISTRIBUSI</option>
                            <option value="FTTH FEEDER">FTTH FEEDER</option>
                            <option value="FTTH BACKBONE">FTTH BACKBONE</option>
                            <option value="AKSES">AKSES</option>
                            <option value="DISTRIBUSI">DISTRIBUSI</option>
                            <option value="BACKBONE">BACKBONE</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Tim</label>
                        <select class="form-select" id="idTim">
                            <option value="">Pilih Tim</option>
                            <?php foreach(($tim ?? []) as $t){ echo '<option value="'.(int)$t->idTim.'">'.htmlspecialchars($t->nama.' ('.($t->kendaraan ?? '-').')').'</option>'; } ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="status1">
                            <option value="OPEN">OPEN</option>
                            <option value="ANTRIAN">ANTRIAN</option>
                            <option value="ON PROGRESS">ON PROGRESS</option>
                            <option value="SOLVED (ICRM OPEN)">SOLVED (ICRM OPEN)</option>
                            <option value="STOPCLOCK">STOPCLOCK</option>
                            <option value="CLOSED">CLOSED</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" placeholder="Keterangan"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="submitBtn">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editCorporateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Corporate Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <input type="hidden" id="editid">
                    <div class="col-12">
                        <label class="form-label">Incident</label>
                        <input type="text" class="form-control" id="editincident" placeholder="Incident">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Segmen</label>
                        <select class="form-select" id="editsegmen">
                            <option value="">Pilih Segmen</option>
                            <option value="FTTH AKSES">FTTH AKSES</option>
                            <option value="FTTH DISTRIBUSI">FTTH DISTRIBUSI</option>
                            <option value="FTTH FEEDER">FTTH FEEDER</option>
                            <option value="FTTH BACKBONE">FTTH BACKBONE</option>
                            <option value="AKSES">AKSES</option>
                            <option value="DISTRIBUSI">DISTRIBUSI</option>
                            <option value="BACKBONE">BACKBONE</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Tim</label>
                        <select class="form-select" id="editidTim">
                            <option value="">Pilih Tim</option>
                            <?php foreach(($tim ?? []) as $t){ echo '<option value="'.(int)$t->idTim.'">'.htmlspecialchars($t->nama.' ('.($t->kendaraan ?? '-').')').'</option>'; } ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="editstatus">
                            <option value="OPEN">OPEN</option>
                            <option value="ANTRIAN">ANTRIAN</option>
                            <option value="ON PROGRESS">ON PROGRESS</option>
                            <option value="SOLVED (ICRM OPEN)">SOLVED (ICRM OPEN)</option>
                            <option value="STOPCLOCK">STOPCLOCK</option>
                            <option value="CLOSED">CLOSED</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" id="editketerangan" placeholder="Keterangan"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="editsubmitBtn">Submit</button>
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
    <script src="js/cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
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
    if ($.fn.select2) {
        $('#idTim').select2({
            placeholder: 'Pilih Tim',
            width: '100%',
            dropdownParent: $('#addCorporateModal')
        });
        $('#editidTim').select2({
            placeholder: 'Pilih Tim',
            width: '100%',
            dropdownParent: $('#editCorporateModal')
        });
    }

    var table = $('#dataCorporate').DataTable({
        pageLength: 25
    });

    $('#filterSegmen, #filterStatus, #filterTim').on('change', function(){
        table.column(1).search($('#filterSegmen').val(), false, false);
        table.column(4).search($('#filterStatus').val(), false, false);
        table.column(3).search($('#filterTim').val(), false, false);
        table.draw();
    });

    $('#submitBtn').on('click', function(){
        var payload = {
            incident: $('#incident').val(),
            segmen: $('#segmen').val(),
            idTim: $('#idTim').val(),
            status: $('#status1').val(),
            keterangan: $('#keterangan').val()
        };

        if(!payload.incident || !payload.segmen || !payload.idTim || !payload.status){
            alert('Harap isi semua field wajib');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'TicketsCorporate/insertData',
            data: payload,
            success: function(res){
                if((res || '').toString().trim() === 'success'){
                    location.reload();
                } else {
                    alert(res || 'Gagal menyimpan data');
                }
            }
        });
    });

    $(document).on('click', '.edit-item-btn', function(e){
        e.preventDefault();
        var $btn = $(this);
        var rowId = ($btn.attr('data-id') || '').trim();
        var rowIncident = ($btn.attr('data-incident') || '').trim();
        var rowIdTim = ($btn.attr('data-idtim') || '').trim();
        var rowSegmen = ($btn.attr('data-segmen') || '').trim();
        var rowStatusAttr = ($btn.attr('data-status') || '').trim();
        var rowKeterangan = ($btn.attr('data-keterangan') || '').trim();

        $('#editid').val(rowId);
        $('#editincident').val(rowIncident);
        $('#editsegmen').val(rowSegmen);
        $('#editketerangan').val(rowKeterangan);

        var rawStatus = rowStatusAttr;
        var normalizedRaw = rawStatus.replace(/\s+/g, ' ').toUpperCase();
        var matchedValue = '';
        $('#editstatus option').each(function(){
            var optVal = (($(this).val() || '') + '').trim();
            if (optVal.replace(/\s+/g, ' ').toUpperCase() === normalizedRaw) {
                matchedValue = optVal;
                return false;
            }
        });

        var modalEl = document.getElementById('editCorporateModal');
        var modal = new bootstrap.Modal(modalEl);
        modal.show();

        setTimeout(function(){
            $('#editidTim').val(rowIdTim).trigger('change');
            $('#editstatus').val(matchedValue || rawStatus).trigger('change');
        }, 0);
    });

    $('#editsubmitBtn').on('click', function(){
        var payload = {
            id: $('#editid').val(),
            incident: $('#editincident').val(),
            segmen: $('#editsegmen').val(),
            idTim: $('#editidTim').val(),
            status: $('#editstatus').val(),
            keterangan: $('#editketerangan').val()
        };

        if(!payload.id || !payload.incident || !payload.segmen || !payload.idTim || !payload.status){
            alert('Harap isi semua field wajib');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'TicketsCorporate/editData',
            data: payload,
            success: function(res){
                if((res || '').toString().trim() === 'success'){
                    location.reload();
                } else {
                    alert(res || 'Gagal mengubah data');
                }
            }
        });
    });

    $(document).on('click', '.remove-item-btn', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if(!id) return;
        if(!confirm('Hapus data ini?')) return;

        $.ajax({
            type: 'POST',
            url: 'TicketsCorporate/deleteRow',
            data: {id:id},
            success: function(res){
                if((res === true) || (res === '1') || (res === 1) || ((res||'').toString().toLowerCase() === 'true')){
                    location.reload();
                } else {
                    alert('Gagal menghapus data');
                }
            }
        });
    });
});
</script>
