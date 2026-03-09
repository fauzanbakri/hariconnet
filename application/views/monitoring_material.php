<?php
// Monitoring Material view
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <style>
                .status-dot{display:inline-block;width:14px;height:14px;border-radius:50%;box-shadow:0 0 0 3px rgba(0,0,0,0.03)}
                .card .progress {background:#e9ecef}
            </style>
            <div class="row">
                <div class="col-12">
                    <h4 class="mb-sm-0">Monitoring Material</h4>
                    <p class="text-muted">Perbandingan stok aktual di Basecamp dengan Standar Stok per tipe material.</p>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <?php $card_i = 0; foreach (($monitor ?? []) as $m) { $card_i++; ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-0" style="font-size:1rem"><?php echo htmlspecialchars($m['nama'] ?: '-'); ?></h5>
                                <small class="text-muted"><?php echo htmlspecialchars($m['sloc'] ?: ''); ?></small>
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
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div>
                                            <strong><?php echo htmlspecialchars($it['tipe']); ?></strong>
                                            <div class="small text-muted">Standar: <?php echo htmlspecialchars($it['standard']); ?> &nbsp;•&nbsp; Aktual: <?php echo htmlspecialchars($it['actual']); ?></div>
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
                                    <div class="progress" style="height:8px">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $ratio; ?>%;" aria-valuenow="<?php echo $ratio; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <?php if (isset($_GET['debug']) && $_GET['debug']=='1') { ?>
                                        <details class="mt-1">
                                            <summary class="small">Debug: show samples</summary>
                                            <div class="small mt-2">
                                                <strong>Total Qty:</strong> <?php echo htmlspecialchars($it['total_qty']); ?><br>
                                                <strong>Total Used:</strong> <?php echo htmlspecialchars($it['total_used']); ?><br>
                                                <strong>Materials:</strong>
                                                <pre style="max-height:150px;overflow:auto;background:#f8f9fa;padding:8px;border-radius:4px"><?php echo htmlspecialchars(json_encode($it['materials_sample'], JSON_PRETTY_PRINT)); ?></pre>
                                                <strong>Pemakaian:</strong>
                                                <pre style="max-height:150px;overflow:auto;background:#f8f9fa;padding:8px;border-radius:4px"><?php echo htmlspecialchars(json_encode($it['pemakaian_sample'], JSON_PRETTY_PRINT)); ?></pre>
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
