<div class="main-content">
    <link href="js/cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
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

            <?php
                $totalRows = 0;
                $uniqueNames = [];
                $segmentCounts = [];
                $nameIncidentCounts = [];
                $ikrCounts = [];
                $feederCounts = [];
                foreach (($rows ?? []) as $summaryRow) {
                    $summaryName = trim((string)($summaryRow->nama ?? ''));
                    $summarySegmen = trim((string)($summaryRow->segmen ?? ''));
                    $summaryStatus = strtolower(trim((string)($summaryRow->status ?? 'not yet')));
                    if ($summaryStatus !== 'done') {
                        continue;
                    }
                    $totalRows++;
                    if ($summaryName !== '') {
                        $uniqueNames[$summaryName] = true;
                        $nameIncidentCounts[$summaryName] = ($nameIncidentCounts[$summaryName] ?? 0) + 1;
                    }
                    if ($summarySegmen !== '') {
                        $segmentCounts[$summarySegmen] = ($segmentCounts[$summarySegmen] ?? 0) + 1;
                        // IKR: hanya dari FTTH AKSES
                        if ($summarySegmen === 'FTTH AKSES') {
                            $ikrCounts[$summaryName] = ($ikrCounts[$summaryName] ?? 0) + 1;
                        }
                        // Feeder: selain FTTH AKSES
                        if ($summarySegmen !== 'FTTH AKSES') {
                            $feederCounts[$summaryName] = ($feederCounts[$summaryName] ?? 0) + 1;
                        }
                    }
                }
                arsort($segmentCounts);
                arsort($nameIncidentCounts);
                arsort($ikrCounts);
                arsort($feederCounts);
                $chartCategories = array_slice(array_keys($nameIncidentCounts), 0, 10);
                $chartSeries = [];
                foreach ($chartCategories as $chartName) {
                    $chartSeries[] = $nameIncidentCounts[$chartName];
                }
                $ikrCategories = array_slice(array_keys($ikrCounts), 0, 10);
                $ikrSeries = [];
                foreach ($ikrCategories as $ikrName) {
                    $ikrSeries[] = $ikrCounts[$ikrName];
                }
                $feederCategories = array_slice(array_keys($feederCounts), 0, 10);
                $feederSeries = [];
                foreach ($feederCategories as $feederName) {
                    $feederSeries[] = $feederCounts[$feederName];
                }
            ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Data Monitoring Internal</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
                        </div>
                        <div class="card-body">
                            <form method="get" class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label mb-1">Tanggal Dari</label>
                                    <input type="date" class="form-control" name="start_date" value="<?php echo htmlspecialchars($filter_start_date ?? ''); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label mb-1">Sampai Tanggal</label>
                                    <input type="date" class="form-control" name="end_date" value="<?php echo htmlspecialchars($filter_end_date ?? ''); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label mb-1">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="" <?php echo (($filter_status ?? '') === '') ? 'selected' : ''; ?>>Semua Status</option>
                                        <option value="not yet" <?php echo (($filter_status ?? '') === 'not yet') ? 'selected' : ''; ?>>Not Yet</option>
                                        <option value="done" <?php echo (($filter_status ?? '') === 'done') ? 'selected' : ''; ?>>Done</option>
                                    </select>
                                </div>
                                <div class="col-12 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                    <a href="MonitoringInternal" class="btn btn-light btn-sm">Reset</a>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table id="monitoringInternalTable" class="table table-bordered table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width:60px;">No</th>
                                            <th>Nama</th>
                                            <th>Segmen</th>
                                            <th>Incident</th>
                                            <th class="text-center">Status</th>
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
                                                <td class="text-center align-middle">
                                                    <?php $statusVal = strtolower(trim((string)($row->status ?? 'not yet'))); ?>
                                                    <?php if ($statusVal === 'done') { ?>
                                                        <span class="badge bg-success">Done</span>
                                                    <?php } else { ?>
                                                        <span class="badge bg-warning text-white">Not Yet</span>
                                                    <?php } ?>
                                                </td>
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
                                                                data-status="<?php echo htmlspecialchars($row->status ?? 'not yet', ENT_QUOTES); ?>"
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Ringkasan</h5>
                            <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">Input Baru</button>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <div class="p-3 rounded border bg-light">
                                        <div class="text-muted small">Total Done</div>
                                        <div class="fs-4 fw-semibold"><?php echo (int)$totalRows; ?></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 rounded border bg-light">
                                        <div class="text-muted small">Nama Done</div>
                                        <div class="fs-4 fw-semibold"><?php echo count($uniqueNames); ?></div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="text-uppercase text-muted fs-12 mb-2">Incident per Nama</h6>
                            <div id="incidentPerNameChart" style="min-height: 320px;"></div>


                            <h6 class="text-uppercase text-muted fs-12 mb-2">Incident IKR (FTTH AKSES)</h6>
                            <div id="incidentIkrChart" style="min-height: 320px;"></div>

                            <h6 class="text-uppercase text-muted fs-12 mb-2">Incident Feeder (Non-FTTH AKSES)</h6>
                            <div id="incidentFeederChart" style="min-height: 320px;"></div>

                            <h6 class="text-uppercase text-muted fs-12 mb-2">Petunjuk Input</h6>
                            <ul class="ps-3 mb-0 text-muted">
                                <li>Pilih beberapa nama sekaligus di form tambah data.</li>
                                <li>Isi incident satu per baris untuk membuat banyak kombinasi data.</li>
                                <li>Gunakan tombol action pada tabel untuk edit atau hapus data.</li>
                            </ul>

                            <h6 class="text-uppercase text-muted fs-12 mb-2">Segmen Terbanyak</h6>
                            <?php if (!empty($segmentCounts)) { ?>
                                <div class="list-group list-group-flush mb-3">
                                    <?php $segmentShown = 0; foreach ($segmentCounts as $segmentLabel => $segmentTotal) { if ($segmentShown >= 5) break; ?>
                                        <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                            <span><?php echo htmlspecialchars($segmentLabel); ?></span>
                                            <span class="badge bg-primary rounded-pill"><?php echo (int)$segmentTotal; ?></span>
                                        </div>
                                    <?php $segmentShown++; } ?>
                                </div>
                            <?php } else { ?>
                                <p class="text-muted mb-3">Belum ada data segmen untuk ditampilkan.</p>
                            <?php } ?>
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
                    <select class="form-select" id="addNama" multiple>
                        <option value="Jibrail Husbar">Jibrail Husbar</option>
                        <option value="Birman">Birman</option>
                        <option value="Tahir">Tahir</option>
                        <option value="Zulkifli">Zulkifli</option>
                        <option value="Asril">Asril</option>
                        <option value="M. Rifki Irwansyah">M. Rifki Irwansyah</option>
                        <option value="Ihdinamsyah">Ihdinamsyah</option>
                        <option value="Hasrianto Nurlang">Hasrianto Nurlang</option>
                        <option value="Nurhadi">Nurhadi</option>
                        <option value="Rizal Dg Tinri">Rizal Dg Tinri</option>
                        <option value="Ady">Ady</option>
                    </select>
                    <small class="text-muted">Ketik untuk mencari nama, lalu pilih beberapa nama.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Segmen</label>
                    <select class="form-select" id="addSegmen">
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
                <div class="mb-3">
                    <label class="form-label">Incident</label>
                    <textarea class="form-control" id="addIncident" rows="4" placeholder="Satu incident per baris"></textarea>
                    <small class="text-muted">Pisahkan incident dengan Enter (baris baru).</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="addStatus">
                        <option value="not yet" selected>Not Yet</option>
                        <option value="done">Done</option>
                    </select>
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
                    <select class="form-select" id="editSegmen">
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
                <div class="mb-3">
                    <label class="form-label">Incident</label>
                    <input type="text" class="form-control" id="editIncident" placeholder="Incident">
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="editStatus">
                        <option value="not yet">Not Yet</option>
                        <option value="done">Done</option>
                    </select>
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
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    
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
    var chartCategories = <?php echo json_encode($chartCategories); ?>;
    var chartSeries = <?php echo json_encode($chartSeries); ?>;
    var ikrCategories = <?php echo json_encode($ikrCategories); ?>;
    var ikrSeries = <?php echo json_encode($ikrSeries); ?>;
    var feederCategories = <?php echo json_encode($feederCategories); ?>;
    var feederSeries = <?php echo json_encode($feederSeries); ?>;

    if ($.fn.select2) {
        $('#addNama').select2({
            placeholder: 'Pilih Nama',
            width: '100%'
        });
    }

    if (document.querySelector('#incidentPerNameChart')) {
        if (chartCategories.length > 0) {
            var chartOptions = {
                chart: {
                    type: 'bar',
                    height: Math.max(320, chartCategories.length * 38),
                    toolbar: { show: false }
                },
                series: [{
                    name: 'Jumlah Incident',
                    data: chartSeries
                }],
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 4,
                        barHeight: '60%'
                    }
                },
                dataLabels: {
                    enabled: true
                },
                xaxis: {
                    categories: chartCategories,
                    title: { text: 'Jumlah Incident' }
                },
                yaxis: {
                    title: { text: 'Nama' }
                },
                colors: ['#405189'],
                grid: {
                    borderColor: '#e9ebec'
                },
                noData: {
                    text: 'Tidak ada data'
                }
            };
            new ApexCharts(document.querySelector('#incidentPerNameChart'), chartOptions).render();
        } else {
            document.querySelector('#incidentPerNameChart').innerHTML = '<div class="text-muted small">Tidak ada data untuk grafik pada rentang tanggal ini.</div>';
        }
    }

    if (document.querySelector('#incidentIkrChart')) {
        if (ikrCategories.length > 0) {
            var ikrOptions = {
                chart: {
                    type: 'bar',
                    height: Math.max(320, ikrCategories.length * 38),
                    toolbar: { show: false }
                },
                series: [{
                    name: 'Jumlah Incident',
                    data: ikrSeries
                }],
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 4,
                        barHeight: '60%'
                    }
                },
                dataLabels: {
                    enabled: true
                },
                xaxis: {
                    categories: ikrCategories,
                    title: { text: 'Jumlah Incident' }
                },
                yaxis: {
                    title: { text: 'Nama' }
                },
                colors: ['#3a9f5d'],
                grid: {
                    borderColor: '#e9ebec'
                },
                noData: {
                    text: 'Tidak ada data'
                }
            };
            new ApexCharts(document.querySelector('#incidentIkrChart'), ikrOptions).render();
        } else {
            document.querySelector('#incidentIkrChart').innerHTML = '<div class="text-muted small">Tidak ada data IKR untuk grafik pada rentang tanggal ini.</div>';
        }
    }

    if (document.querySelector('#incidentFeederChart')) {
        if (feederCategories.length > 0) {
            var feederOptions = {
                chart: {
                    type: 'bar',
                    height: Math.max(320, feederCategories.length * 38),
                    toolbar: { show: false }
                },
                series: [{
                    name: 'Jumlah Incident',
                    data: feederSeries
                }],
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 4,
                        barHeight: '60%'
                    }
                },
                dataLabels: {
                    enabled: true
                },
                xaxis: {
                    categories: feederCategories,
                    title: { text: 'Jumlah Incident' }
                },
                yaxis: {
                    title: { text: 'Nama' }
                },
                colors: ['#f59e0b'],
                grid: {
                    borderColor: '#e9ebec'
                },
                noData: {
                    text: 'Tidak ada data'
                }
            };
            new ApexCharts(document.querySelector('#incidentFeederChart'), feederOptions).render();
        } else {
            document.querySelector('#incidentFeederChart').innerHTML = '<div class="text-muted small">Tidak ada data Feeder untuk grafik pada rentang tanggal ini.</div>';
        }
    }

    if ($.fn.DataTable) {
        $('#monitoringInternalTable').DataTable({
            pageLength: 25,
            order: [[5, 'desc']]
        });
    }

    function validatePayload(payload){
        return payload.nama && payload.segmen && payload.incident && payload.status && payload.tanggal;
    }

    function validateAddPayload(payload){
        return (payload.nama_list && payload.nama_list.length > 0) && payload.segmen && payload.incident_list && payload.status && payload.tanggal;
    }

    $('#saveAddBtn').on('click', function(){
        var payload = {
            nama_list: $('#addNama').val() || [],
            segmen: $('#addSegmen').val().trim(),
            incident_list: $('#addIncident').val(),
            status: ($('#addStatus').val() || '').trim(),
            tanggal: $('#addTanggal').val()
        };

        if (!validateAddPayload(payload)) {
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
        $('#editStatus').val((($el.data('status') || 'not yet')+'').toLowerCase());
        $('#editTanggal').val($el.data('tanggal'));
        new bootstrap.Modal(document.getElementById('editModal')).show();
    });

    $('#saveEditBtn').on('click', function(){
        var payload = {
            id: $('#editId').val(),
            nama: $('#editNama').val().trim(),
            segmen: $('#editSegmen').val().trim(),
            incident: $('#editIncident').val().trim(),
            status: ($('#editStatus').val() || '').trim(),
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
