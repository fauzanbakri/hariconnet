<?php
// Pemakaian Material
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h4 class="mb-sm-0">Pemakaian Material</h4>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" id="filterStartDate" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" id="filterEndDate" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Filter Material</label>
                            <select id="filterMaterial" class="form-select form-select-sm">
                                <option value="">Semua</option>
                                <?php foreach (($materials ?? []) as $m) { ?>
                                <option value="<?php echo $m->idmaterial; ?>"><?php echo $m->kode_material.' - '.$m->nama; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3 align-self-end">
                            <button class="btn btn-sm btn-primary" id="applyFilters">Filter</button>
                            <button class="btn btn-sm btn-secondary" id="resetFilters">Reset</button>
                        </div>
                    </div>

                    <table id="pemakaianTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Penggunaan</th>
                                <th>Incident</th>
                                <th>Kode Material</th>
                                <th>SN</th>
                                <th>QTY Terpakai</th>
                                <th>Material</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; foreach (($usages ?? []) as $u) { $i++;
                                $mat = null;
                                if (!empty($materials)) {
                                    foreach ($materials as $mm) if ($mm->idmaterial == $u->idmaterial) { $mat = $mm; break; }
                                }
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo isset($u->tanggal) ? $u->tanggal : (isset($u->tanggal_penggunaan) ? $u->tanggal_penggunaan : '-'); ?></td>
                                <td><?php echo isset($u->incident) ? $u->incident : '-'; ?></td>
                                <td><?php echo $mat ? $mat->kode_material : '-'; ?></td>
                                <td><?php echo $mat ? $mat->sn_terpakai : '-'; ?></td>
                                <td><?php echo isset($u->qty) ? $u->qty : (isset($u->qty_terpakai) ? $u->qty_terpakai : '-'); ?></td>
                                <td><?php echo $mat ? $mat->nama : '-'; ?></td>
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
    $('#pemakaianTable').DataTable({
        responsive:true,
        order:[]
    });

    $('#applyFilters').on('click', function(){
        // simple client-side filter: reload page with query params (server-side can handle later)
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
