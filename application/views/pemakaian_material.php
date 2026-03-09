<?php
// Pemakaian Material
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h4 class="mb-sm-0">Pemakaian Material</h4>
                    <p class="text-muted">Lihat dan filter catatan pemakaian material. Gunakan filter tanggal dan material untuk menyaring data.</p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row g-3 mb-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" id="filterStartDate" class="form-control form-control-sm" value="<?php echo htmlentities($this->input->get('start_date') ?: date('Y-m-d')); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" id="filterEndDate" class="form-control form-control-sm" value="<?php echo htmlentities($this->input->get('end_date') ?: date('Y-m-d')); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Filter Basecamp</label>
                            <select id="filterBasecamp" class="form-select form-select-sm">
                                <option value="">Semua</option>
                                <?php
                                $bc_list = [];
                                if (!empty($basecamp)) {
                                    if (is_object($basecamp) && method_exists($basecamp, 'result')) {
                                        $bc_list = $basecamp->result();
                                    } elseif (is_array($basecamp)) {
                                        $bc_list = $basecamp;
                                    } elseif (is_object($basecamp)) {
                                        try { $bc_list = iterator_to_array($basecamp); } catch (Exception $e) { $bc_list = [(object)$basecamp]; }
                                    } else {
                                        $bc_list = (array)$basecamp;
                                    }
                                }

                                foreach ($bc_list as $bc) {
                                    $id = '';
                                    $name = '';
                                    $sloc = '';
                                    if (is_object($bc)) {
                                        $id = isset($bc->idBc) ? $bc->idBc : (isset($bc->id) ? $bc->id : '');
                                        $name = isset($bc->namaAkun) ? $bc->namaAkun : (isset($bc->nama) ? $bc->nama : '');
                                        $sloc = isset($bc->sloc) ? $bc->sloc : '';
                                    } elseif (is_array($bc)) {
                                        $id = isset($bc['idBc']) ? $bc['idBc'] : (isset($bc['id']) ? $bc['id'] : '');
                                        $name = isset($bc['namaAkun']) ? $bc['namaAkun'] : (isset($bc['nama']) ? $bc['nama'] : '');
                                        $sloc = isset($bc['sloc']) ? $bc['sloc'] : '';
                                    } else {
                                        $id = (string)$bc;
                                    }
                                    $selected = ($this->input->get('idbc') == $id || $this->input->get('idBc') == $id) ? 'selected' : '';
                                    $label = htmlspecialchars($name ?: $sloc ?: $id);
                                    if (!empty($sloc)) $label .= ' ('.htmlspecialchars($sloc).')';
                                    echo '<option value="'.htmlspecialchars($id).'" '.$selected.'>'.$label.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 text-end">
                            <div class="btn-group" role="group" aria-label="actions">
                                <button class="btn btn-sm btn-primary" id="applyFilters">Filter</button>
                                <button class="btn btn-sm btn-secondary" id="resetFilters">Reset</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                    <table id="pemakaianTable" class="table table-bordered table-hover nowrap table-striped align-middle" style="width:100%">
                        <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Material</th>
                                    <th>Kode Material Terpakai</th>
                                    <th>Nama Basecamp</th>
                                    <th>SN</th>
                                    <th>SN Terpakai</th>
                                    <th>Incident</th>
                                    <th>Tanggal</th>
                                    <th>QTY</th>
                                    <th>Action</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; foreach (($usages ?? []) as $u) { $i++; ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo isset($u->kode_material) ? $u->kode_material : '-'; ?></td>
                                <td><?php echo isset($u->kode_material_terpakai) ? $u->kode_material_terpakai : (isset($u->kode_material_terpakai) ? $u->kode_material_terpakai : '-'); ?></td>
                                <td><?php echo isset($u->nama) ? $u->nama : '-'; ?></td>
                                <td><?php echo isset($u->sn_original) ? $u->sn_original : (isset($u->sn) ? $u->sn : '-'); ?></td>
                                <td><?php echo isset($u->sn_terpakai) ? $u->sn_terpakai : '-'; ?></td>
                                <td><?php echo isset($u->incident) ? $u->incident : '-'; ?></td>
                                <td><?php echo isset($u->tanggal) ? $u->tanggal : (isset($u->tanggal_penggunaan) ? $u->tanggal_penggunaan : '-'); ?></td>
                                <td><?php echo isset($u->qty) ? $u->qty : (isset($u->qty_terpakai) ? $u->qty_terpakai : '-'); ?></td>
                                <?php
                                    // detect primary id field for this usage row (e.g., idPemakaianMaterial)
                                    $rowVars = get_object_vars($u);
                                    $id_field = null;
                                    foreach ($rowVars as $k => $v) {
                                        if (preg_match('/^id(?!Material)/i', $k) || preg_match('/^idPemakaian/i', $k) || (stripos($k, 'pemakaian') !== false && stripos($k, 'id') !== false)) {
                                            $id_field = $k; break;
                                        }
                                    }
                                    // fallback: find first property that starts with id and isn't idMaterial
                                    if (!$id_field) {
                                        foreach ($rowVars as $k => $v) {
                                            if (preg_match('/^id/i', $k) && strtolower($k) !== 'idmaterial') { $id_field = $k; break; }
                                        }
                                    }
                                    if (!$id_field) { $id_field = 'id'; }
                                    $id_val = isset($rowVars[$id_field]) ? $rowVars[$id_field] : (isset($u->$id_field) ? $u->$id_field : '');
                                ?>
                                <td class="text-center">
                                    <div class='dropdown d-inline-block'>
                                        <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                            <i class='ri-more-fill align-middle'></i>
                                        </button>
                                        <ul class='dropdown-menu dropdown-menu-end'>
                                            <li><a href='#' class='dropdown-item edit-usage-btn' data-idfield='<?php echo htmlspecialchars($id_field); ?>' data-id='<?php echo htmlspecialchars($id_val); ?>'><i class='ri-pencil-fill align-bottom me-2 text-muted'></i> Edit</a></li>
                                            <li><a href='#' class='dropdown-item delete-usage-btn' data-idfield='<?php echo htmlspecialchars($id_field); ?>' data-id='<?php echo htmlspecialchars($id_val); ?>'><i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Delete</a></li>
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

    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/app.js"></script>
<script>
$(document).ready(function(){
    var table = $('#pemakaianTable').DataTable({
        responsive:true,
        order:[],
        lengthMenu: [[-1,10,25,50], ['All',10,25,50]],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', className: 'btn btn-sm btn-outline-secondary' },
            { extend: 'csv', className: 'btn btn-sm btn-outline-secondary' },
            { extend: 'excel', className: 'btn btn-sm btn-outline-secondary' },
            { extend: 'print', className: 'btn btn-sm btn-outline-secondary' }
        ]
    });

    $('#applyFilters').on('click', function(){
        const s = $('#filterStartDate').val();
        const e = $('#filterEndDate').val();
        const bc = $('#filterBasecamp').val();
        let url = 'PemakaianMaterial?';
        if (s) url += 'start_date='+s+'&';
        if (e) url += 'end_date='+e+'&';
        if (bc) url += 'idbc='+bc+'&';
        window.location.href = url;
    });
    $('#resetFilters').on('click', function(){ location.href='PemakaianMaterial'; });
});
</script>
<script>
$(function(){
    // edit handler placeholder
    $(document).on('click', '.edit-usage-btn', function(e){
        e.preventDefault();
        alert('Edit pemakaian belum diimplementasikan.');
    });

    // delete usage from dropdown
    $(document).on('click', '.delete-usage-btn', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var id_field = $(this).data('idfield');
        if (!id || !id_field) return;
        if (!confirm('Hapus pemakaian ini?')) return;
        $.ajax({
            url: 'PemakaianMaterial/deleteUsage',
            method: 'POST',
            dataType: 'json',
            data: { id: id, id_field: id_field },
            success: function(res){
                if (res.status && res.status === 'success') {
                    // remove row
                    $('.delete-usage-btn[data-id="'+id+'"][data-idfield="'+id_field+'"]').closest('tr').remove();
                } else {
                    alert(res.message || 'Gagal menghapus');
                }
            },
            error: function(xhr){ alert('Error: '+xhr.responseText); }
        });
    });
});
</script>
