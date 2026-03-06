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
                            <label class="form-label">Filter Material</label>
                            <select id="filterMaterial" class="form-select form-select-sm">
                                <option value="">Semua</option>
                                <?php
                                $mat_list = [];
                                if (!empty($materials)) {
                                    if (is_object($materials) && method_exists($materials, 'result')) {
                                        $mat_list = $materials->result();
                                    } elseif (is_array($materials)) {
                                        $mat_list = $materials;
                                    } elseif (is_object($materials)) {
                                        try { $mat_list = iterator_to_array($materials); } catch (Exception $e) { $mat_list = [(object)$materials]; }
                                    } else {
                                        $mat_list = (array)$materials;
                                    }
                                }

                                foreach ($mat_list as $m) {
                                    $mid = '';
                                    $kode = '';
                                    $name = '';
                                    if (is_object($m)) {
                                        $mid = isset($m->idmaterial) ? $m->idmaterial : (isset($m->id) ? $m->id : '');
                                        $kode = isset($m->kode_material) ? $m->kode_material : (isset($m->kode) ? $m->kode : '');
                                        $name = isset($m->nama) ? $m->nama : (isset($m->namaAkun) ? $m->namaAkun : '');
                                    } elseif (is_array($m)) {
                                        $mid = isset($m['idmaterial']) ? $m['idmaterial'] : (isset($m['id']) ? $m['id'] : '');
                                        $kode = isset($m['kode_material']) ? $m['kode_material'] : (isset($m['kode']) ? $m['kode'] : '');
                                        $name = isset($m['nama']) ? $m['nama'] : (isset($m['namaAkun']) ? $m['namaAkun'] : '');
                                    } else {
                                        $mid = (string)$m;
                                    }
                                    $mid_esc = htmlspecialchars($mid);
                                    $selected = ($this->input->get('idmaterial') == $mid) ? 'selected' : '';
                                    $label = trim(($kode ?: $mid_esc) . ' - ' . ($name ?: '-'));
                                    echo '<option value="'.$mid_esc.'" '.$selected.'>'.htmlspecialchars($label).'</option>';
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
                                <th>ID Pemakaian</th>
                                <th>Kode Material</th>
                                <th>Kode Material Terpakai</th>
                                <th>Nama Basecamp</th>
                                <th>SN</th>
                                <th>SN Terpakai</th>
                                <th>Incident</th>
                                <th>Tanggal</th>
                                <th>QTY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; foreach (($usages ?? []) as $u) { $i++; ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo isset($u->idPemakaianMaterial) ? $u->idPemakaianMaterial : (isset($u->idPemakaian) ? $u->idPemakaian : '-'); ?></td>
                                <td><?php echo isset($u->kode_material) ? $u->kode_material : '-'; ?></td>
                                <td><?php echo isset($u->kode_material_terpakai) ? $u->kode_material_terpakai : (isset($u->kode_material_terpakai) ? $u->kode_material_terpakai : '-'); ?></td>
                                <td><?php echo isset($u->nama) ? $u->nama : '-'; ?></td>
                                <td><?php echo isset($u->sn_original) ? $u->sn_original : (isset($u->sn) ? $u->sn : '-'); ?></td>
                                <td><?php echo isset($u->sn_terpakai) ? $u->sn_terpakai : '-'; ?></td>
                                <td><?php echo isset($u->incident) ? $u->incident : '-'; ?></td>
                                <td><?php echo isset($u->tanggal) ? $u->tanggal : (isset($u->tanggal_penggunaan) ? $u->tanggal_penggunaan : '-'); ?></td>
                                <td><?php echo isset($u->qty) ? $u->qty : (isset($u->qty_terpakai) ? $u->qty_terpakai : '-'); ?></td>
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
        const m = $('#filterMaterial').val();
        let url = 'PemakaianMaterial?';
        if (s) url += 'start_date='+s+'&';
        if (e) url += 'end_date='+e+'&';
        if (m) url += 'idmaterial='+m+'&';
        window.location.href = url;
    });
    $('#resetFilters').on('click', function(){ location.href='PemakaianMaterial'; });
});
</script>
