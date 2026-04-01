<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Monitoring Tim Serpo</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Monitoring Tim Serpo</li>
                            </ol>
                        </div>
                    </div>
                    <p class="text-muted mb-3">Menampilkan tim yang memiliki pending incident (Feeder / Retail / Corporate) namun tidak memiliki incident berstatus <strong>ON PROGRESS</strong>.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">List Tim Tanpa On Progress</h5>
                            <span class="badge bg-primary">Total Tim: <?php echo (int)($total_teams ?? 0); ?></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="timSerpoTable" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-start">Tim</th>
                                            <th>Pending Feeder</th>
                                            <th>Pending Retail</th>
                                            <th>Pending Corporate</th>
                                            <th>Total Pending</th>
                                            <th>Total On Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach(($rows ?? []) as $r){ ?>
                                            <tr>
                                                <td class="text-start"><?php echo htmlspecialchars($r['tim']); ?></td>
                                                <td><?php echo (int)$r['feeder_pending']; ?></td>
                                                <td><?php echo (int)$r['retail_pending']; ?></td>
                                                <td><?php echo (int)$r['corporate_pending']; ?></td>
                                                <td><span class="badge bg-warning text-dark"><?php echo (int)$r['total_pending']; ?></span></td>
                                                <td><span class="badge bg-success"><?php echo (int)$r['total_onprogress']; ?></span></td>
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

<script>
$(document).ready(function(){
    if ($.fn.DataTable) {
        $('#timSerpoTable').DataTable({
            pageLength: 25,
            order: [[4, 'desc']]
        });
    }
});
</script>
