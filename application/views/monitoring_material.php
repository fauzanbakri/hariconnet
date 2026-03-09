<?php
// Monitoring Material view
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <style>
                /* compact monitoring cards */
                .status-dot{display:inline-block;width:10px;height:10px;border-radius:50%;box-shadow:0 0 0 2px rgba(0,0,0,0.03)}
                .card .progress {background:#e9ecef}
                .monitor-card .card-header {padding:0.5rem 0.75rem}
                .monitor-card .card-body {padding:0.5rem 0.75rem}
                .monitor-card .card-footer {padding:0.4rem 0.75rem;font-size:0.8rem}
                .monitor-card .card-title {font-size:0.9rem;margin:0}
                .monitor-card .small {font-size:0.72rem}
                .monitor-item {margin-bottom:0.4rem}
                .monitor-item .progress {height:6px}
            </style>
            <div class="row">
                <div class="col-12">
                    <h4 class="mb-sm-0">Monitoring Material</h4>
                    <p class="text-muted">Perbandingan stok aktual di Basecamp dengan Standar Stok per tipe material.</p>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <?php $card_i = 0; foreach (($monitor ?? []) as $m) { 
                    // skip basecamp cards that have no standar values (all items standar empty or zero)
                    $has_standard = false;
                    if (!empty($m['items']) && is_array($m['items'])) {
                        foreach ($m['items'] as $it_check) {
                            if (isset($it_check['standard']) && $it_check['standard'] !== '' && $it_check['standard'] !== null && floatval($it_check['standard']) > 0) { $has_standard = true; break; }
                        }
                    }
                    if (!$has_standard) continue;
                    $card_i++; ?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="card h-100 monitor-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-0"><?php echo htmlspecialchars($m['nama'] ?: '-'); ?></h5>
                                <small class="text-muted small"><?php echo htmlspecialchars($m['sloc'] ?: ''); ?></small>
                            </div>
                            <div>
                                <span class="badge bg-light text-dark">Items: <?php echo count($m['items']); ?></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (empty($m['items'])) { ?>
                                <p class="text-muted">Tidak ada data tipe material untuk basecamp ini.</p>
                            <?php } else { ?>
                                <?php foreach ($m['items'] as $it) { 
                                    $ratio = 0; if ($it['standard'] > 0) { $ratio = round(min(100, ($it['actual'] / $it['standard']) * 100)); }
                                ?>
                                <div class="monitor-item">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div>
                                            <strong class="small"><?php echo htmlspecialchars($it['tipe']); ?></strong>
                                            <div class="small text-muted">S: <?php echo htmlspecialchars($it['standard']); ?> • A: <?php echo htmlspecialchars($it['actual']); ?></div>
                                        </div>
                                        <div class="text-end">
                                            <?php if ($it['status']=='red') { ?>
                                                <span class="status-dot" style="background:#e74c3c" title="Kritis"></span>
                                            <?php } elseif ($it['status']=='yellow') { ?>
                                                <span class="status-dot" style="background:#f1c40f" title="Perhatian"></span>
                                            <?php } else { ?>
                                                <span class="status-dot" style="background:#2ecc71" title="OK"></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $ratio; ?>%;" aria-valuenow="<?php echo $ratio; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <?php if (isset($_GET['debug']) && $_GET['debug']=='1') { ?>
                                        <details class="mt-1">
                                            <summary class="small">Debug</summary>
                                            <div class="small mt-2">
                                                <strong>Total Qty:</strong> <?php echo htmlspecialchars($it['total_qty']); ?><br>
                                                <strong>Total Used:</strong> <?php echo htmlspecialchars($it['total_used']); ?><br>
                                            </div>
                                        </details>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="card-footer text-muted small">
                            <div class="d-flex justify-content-between">
                                <div>Basecamp ID: <?php echo htmlspecialchars($m['id'] ?? ''); ?></div>
                                <div>Updated: <?php echo date('Y-m-d'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- No DataTable needed for card view -->

<?php if (isset($_GET['debug']) && $_GET['debug']=='1') { ?>
<script>
    try {
        console.groupCollapsed('MonitoringMaterial debug');
        console.log('monitor data:', <?php echo json_encode($monitor ?? [], JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP); ?>);
        console.log('Note: material/pemakaian samples are included per item as `materials_sample` and `pemakaian_sample`.');
        console.groupEnd();
    } catch (e) { console.error('Debug JSON error', e); }
</script>
<?php } ?>
