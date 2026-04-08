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
                        $badgeClass = 'bg-info text-white';
                        $statusText = 'On Progress';
                    } elseif ($total_onprogress > 0 && $total_pending === 1) {
                        $borderClass = 'border-success';
                        $badgeClass = 'bg-success text-white';
                        $statusText = 'On Progress';
                    } elseif ($total_pending > 0 && $total_onprogress === 0) {
                        $borderClass = 'border-danger';
                        $badgeClass = 'bg-danger text-white';
                        $statusText = 'Pending';
                    } else {
                        $borderClass = 'border-secondary';
                        $badgeClass = 'bg-secondary text-white';
                        $statusText = 'Info';
                    }
                ?>
                <div class="col-md-4 col-lg-3 mb-3">
                    <div class="card shadow-sm border-0 border-top border-4 <?php echo $borderClass; ?> h-100">
                        <div class="card-body py-2 px-3 d-flex flex-column justify-content-between h-100">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="card-title mb-1 text-truncate">
                                            <?php if ($total_pending > 0 && $total_onprogress === 0) { ?>
                                                <span class="badge bg-danger text-white me-1">!</span>
                                            <?php } ?>
                                            <?php echo htmlspecialchars($r['tim']); ?>
                                        </h6>
                                        <p class="text-muted fst-italic mb-1 small">Active incident</p>
                                    </div>
                                    <span class="badge <?php echo $badgeClass; ?> py-1 px-2 fs-7"><?php echo $statusText; ?></span>
                                </div>
                                <p class="fw-semibold mb-1 small">Pending Feeder + Corporate: <span class="text-dark"><?php echo (int)$r['feeder_pending'] + (int)$r['corporate_pending']; ?></span></p>
                                <div class="d-flex flex-wrap gap-1 mb-2">
                                    <span class="badge bg-light text-dark py-1 fs-7">Feeder <?php echo (int)$r['feeder_pending']; ?></span>
                                    <span class="badge bg-light text-dark py-1 fs-7">IKR <?php echo (int)$r['retail_pending']; ?></span>
                                    <span class="badge bg-light text-dark py-1 fs-7">Corporate <?php echo (int)$r['corporate_pending']; ?></span>
                                </div>
                            </div>
                            <div class="pt-2 border-top">
                                <div class="d-flex justify-content-between align-items-center text-muted small mb-1">
                                    <span>Total Pending</span>
                                    <strong><?php echo $total_pending; ?></strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center text-muted small">
                                    <span>On Progress</span>
                                    <strong><?php echo $total_onprogress; ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>


        </div>
    </div>
</div>


