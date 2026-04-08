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
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">List Tim dengan Incident</h5>
                            <span class="badge bg-primary">Total Tim: <?php echo (int)($total_teams ?? 0); ?></span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach(($incident_teams ?? []) as $r){
                                    $total_pending = (int)$r['total_pending'];
                                    $total_onprogress = (int)$r['total_onprogress'];
                                    $card_class = 'bg-light';
                                    if ($total_onprogress > 0 && $total_pending > 1) {
                                        $card_class = 'bg-primary text-white';
                                    } elseif ($total_onprogress > 0 && $total_pending == 1) {
                                        $card_class = 'bg-success text-white';
                                    } elseif ($total_pending > 0 && $total_onprogress == 0) {
                                        $card_class = 'bg-danger text-white';
                                    }
                                ?>
                                <div class="col-md-3 mb-3">
                                    <div class="card <?php echo $card_class; ?>">
                                        <div class="card-body">
                                            <h6 class="card-title"><?php echo htmlspecialchars($r['tim']); ?></h6>
                                            <p class="card-text">
                                                Pending Feeder: <?php echo (int)$r['feeder_pending']; ?><br>
                                                Pending Retail: <?php echo (int)$r['retail_pending']; ?><br>
                                                Pending Corporate: <?php echo (int)$r['corporate_pending']; ?><br>
                                                Total Pending: <?php echo $total_pending; ?><br>
                                                Total On Progress: <?php echo $total_onprogress; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($no_incident_teams ?? [])) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">List Tim No Incident</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php foreach($no_incident_teams as $tim){ ?>
                                <li class="list-group-item"><?php echo htmlspecialchars($tim); ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>


