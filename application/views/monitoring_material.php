<?php
// Monitoring Material view
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <style>
                /* compact monitoring cards */
                .status-dot{display:inline-block;width:12px;height:12px;border-radius:50%;box-shadow:0 0 0 2px rgba(0,0,0,0.03);vertical-align:middle}
                .card .progress {background:#eef2f6}
                .monitor-card {min-height:160px}
                .monitor-card .card-header {padding:0.6rem 0.9rem}
                .monitor-card .card-body {padding:0.6rem 0.9rem}
                .monitor-card .card-footer {padding:0.5rem 0.9rem;font-size:0.78rem}
                .monitor-card .card-title {font-size:0.95rem;margin:0}
                .monitor-card .small {font-size:0.75rem}
                .monitor-item {margin-bottom:0.55rem;padding-bottom:0.25rem;border-bottom:1px solid #f4f6f8}
                .monitor-item:last-child{border-bottom:0;margin-bottom:0}
                .monitor-item .meta{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px}
                .monitor-item .meta .left .type{font-weight:600}
                .monitor-item .meta .left .meta-small{font-size:0.78rem;color:#6c757d}
                .monitor-item .meta .right{display:flex;align-items:center;gap:8px}
                .monitor-item .meta .percent{font-weight:700;font-size:0.88rem}
                .monitor-item .progress{height:10px;border-radius:6px}
                .monitor-item .progress .progress-bar{border-radius:6px;transition:width .5s ease;background:#2ecc71}
                .monitor-legend{display:flex;gap:12px;align-items:center;margin-top:6px;margin-bottom:10px}
                .monitor-legend .legend-item{display:flex;align-items:center;gap:6px;font-size:0.85rem;color:#495057}
                .monitor-legend .legend-dot{width:12px;height:12px;border-radius:50%}
            </style>
            <div class="row">
                <div class="col-12">
                    <h4 class="mb-sm-0">Monitoring Material</h4>
                    <p class="text-muted">Perbandingan stok aktual di Basecamp dengan Standar Stok per tipe material.</p>
                    <div class="monitor-legend">
                        <div class="legend-item"><div class="monitor-legend-dot legend-dot" style="background:#2ecc71;border:1px solid rgba(0,0,0,0.05)"></div> <div>>= Standar (OK)</div></div>
                        <div class="legend-item"><div class="monitor-legend-dot legend-dot" style="background:#f1c40f;border:1px solid rgba(0,0,0,0.05)"></div> <div>< Standard (Perhatian)</div></div>
                        <div class="legend-item"><div class="monitor-legend-dot legend-dot" style="background:#e74c3c;border:1px solid rgba(0,0,0,0.05)"></div> <div>= 0 (Kritis)</div></div>
                    </div>
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
                                    $standard = isset($it['standard']) ? floatval($it['standard']) : 0;
                                    $actual = isset($it['actual']) ? floatval($it['actual']) : 0;
                                    if ($standard > 0) {
                                        $ratio = round(min(100, ($actual / $standard) * 100));
                                    } else {
                                        $ratio = ($actual > 0) ? 100 : 0;
                                    }
                                    if ($actual == 0) {
                                        $status = 'red';
                                        $dot_color = '#e74c3c';
                                        $bar_color = '#e74c3c';
                                        $status_label = 'Kritis';
                                    } elseif ($standard > 0 && $actual >= $standard) {
                                        $status = 'green';
                                        $dot_color = '#2ecc71';
                                        $bar_color = '#2ecc71';
                                        $status_label = 'OK';
                                    } else {
                                        $status = 'yellow';
                                        $dot_color = '#f1c40f';
                                        $bar_color = '#f1c40f';
                                        $status_label = 'Perhatian';
                                    }
                                ?>
                                <div class="monitor-item">
                                    <div class="meta">
                                        <div class="left">
                                            <div class="type"><?php echo htmlspecialchars($it['tipe']); ?></div>
                                            <div class="meta-small">S: <?php echo htmlspecialchars($it['standard']); ?> • A: <?php echo htmlspecialchars($it['actual']); ?></div>
                                        </div>
                                        <div class="right">
                                            <div class="percent"><?php echo $ratio; ?>%</div>
                                            <div style="display:flex;align-items:center;gap:6px"><span class="status-dot" style="background:<?php echo $dot_color; ?>" title="<?php echo $status_label; ?>"></span><small class="text-muted"><?php echo $status_label; ?></small></div>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $ratio; ?>%; background: <?php echo $bar_color; ?>;" aria-valuenow="<?php echo $ratio; ?>" aria-valuemin="0" aria-valuemax="100"></div>
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
