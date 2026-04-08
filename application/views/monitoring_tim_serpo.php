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
                    <p class="text-muted mb-3">Menampilkan tim yang memiliki pending incident (Feeder / Retail / Corporate), termasuk yang juga memiliki incident berstatus <strong>ON PROGRESS</strong>.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-1">List Tim dengan Incident</h5>
                                <p class="text-muted mb-0">Ringkasan tim yang memiliki pending incident dan status On Progress.</p>
                            </div>
                            <span class="badge bg-primary py-2 px-3">Total Tim: <?php echo (int)($total_teams ?? 0); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php foreach(($incident_teams ?? []) as $r){
                    $total_pending = (int)$r['total_pending'];
                    $total_onprogress = (int)$r['total_onprogress'];
                    if ($total_onprogress > 0 && $total_pending > 1) {
                        $borderClass = 'border-info';
                        $badgeClass = 'badge-info';
                        $statusText = 'On Progress';
                    } elseif ($total_onprogress > 0 && $total_pending === 1) {
                        $borderClass = 'border-success';
                        $badgeClass = 'bg-success';
                        $statusText = 'On Progress';
                    } elseif ($total_pending > 0 && $total_onprogress === 0) {
                        $borderClass = 'border-danger';
                        $badgeClass = 'bg-danger';
                        $statusText = 'Pending';
                    } else {
                        $borderClass = 'border-secondary';
                        $badgeClass = 'bg-secondary';
                        $statusText = 'Info';
                    }
                ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm border-start border-4 <?php echo $borderClass; ?> h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title mb-1 text-truncate"><?php echo htmlspecialchars($r['tim']); ?></h5>
                                    <p class="text-muted small mb-0">Total Pending <?php echo $total_pending; ?> · On Progress <?php echo $total_onprogress; ?></p>
                                </div>
                                <span class="badge <?php echo $badgeClass; ?> text-white py-2 px-3"><?php echo $statusText; ?></span>
                            </div>
                            <div class="text-muted small">
                                <div class="mb-2">Feeder: <strong><?php echo (int)$r['feeder_pending']; ?></strong></div>
                                <div class="mb-2">Retail: <strong><?php echo (int)$r['retail_pending']; ?></strong></div>
                                <div>Corporate: <strong><?php echo (int)$r['corporate_pending']; ?></strong></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

            <?php if (!empty($no_incident_teams ?? [])) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-start border-4 border-secondary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h5 class="card-title mb-1">List Tim No Incident</h5>
                                    <p class="text-muted mb-0">Tim yang saat ini tidak memiliki pending maupun on progress incident.</p>
                                </div>
                                <span class="badge bg-secondary py-2 px-3"><?php echo count($no_incident_teams); ?> Tim</span>
                            </div>
                            <div class="row">
                                <?php foreach($no_incident_teams as $tim){ ?>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <div class="card border rounded-3 py-2 px-3 h-100">
                                        <div class="card-body p-0">
                                            <p class="mb-0 text-truncate"><?php echo htmlspecialchars($tim); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>


