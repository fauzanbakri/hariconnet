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
                                <?php foreach (($materials ?? []) as $m) { ?>
                                <option value="<?php echo $m->idmaterial; ?>" <?php echo ($this->input->get('idmaterial') == $m->idmaterial) ? 'selected' : ''; ?>><?php echo $m->kode_material.' - '.$m->nama; ?></option>
                                <?php } ?>
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
                                <th>Nama Material</th>
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
                                <td><?php echo isset($u->nama) ? $u->nama : '-'; ?></td>
                                <td><?php echo isset($u->sn_terpakai) ? $u->sn_terpakai : (isset($u->sn) ? $u->sn : '-'); ?></td>
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
