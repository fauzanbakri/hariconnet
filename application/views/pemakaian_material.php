<?php
// Pemakaian Material view
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
                            <label for="filterStartDatePemakaian" class="form-label">Tanggal Mulai</label>
                            <input type="date" id="filterStartDatePemakaian" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="filterEndDatePemakaian" class="form-label">Tanggal Akhir</label>
                            <input type="date" id="filterEndDatePemakaian" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <div>
                                <button class="btn btn-sm btn-info" id="applyFilterPemakaian">Filter</button>
                                <button class="btn btn-sm btn-secondary" id="resetFilterPemakaian">Reset</button>
                            </div>
                        </div>
                    </div>

                    <table id="pemakaianTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>ID Material</th>
                                <th>Kode Material</th>
                                <th>SN</th>
                                <th>Merk</th>
                                <th>QTY</th>
                                <th>Incident</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    const table = $('#pemakaianTable').DataTable({
        ajax: {
            url: 'PemakaianMaterial/list',
            dataSrc: ''
        },
        columns: [
            { data: null },
            { data: 'tanggal' },
            { data: 'idMaterial' },
            { data: 'kode_material' },
            { data: 'sn' },
            { data: 'merk' },
            { data: 'qty' },
            { data: 'incident' }
        ],
        columnDefs: [{
            targets: 0,
            render: function(data, type, row, meta){ return meta.row + 1; }
        }],
        responsive: true,
        order: [[1, 'desc']]
    });

    $('#applyFilterPemakaian').on('click', function(){
        // simple client-side filter by date range
        table.ajax.reload();
    });
    $('#resetFilterPemakaian').on('click', function(){
        $('#filterStartDatePemakaian').val('<?php echo date('Y-m-d'); ?>');
        $('#filterEndDatePemakaian').val('<?php echo date('Y-m-d'); ?>');
        table.ajax.reload();
    });
});
</script>
