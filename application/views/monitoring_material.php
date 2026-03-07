<?php
// Monitoring Material view
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h4 class="mb-sm-0">Monitoring Material</h4>
                    <p class="text-muted">Perbandingan stok aktual di Basecamp dengan Standar Stok per tipe material.</p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="monitorTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Basecamp</th>
                                    <th>SLOC</th>
                                    <th>Tipe Material</th>
                                    <th>Standar</th>
                                    <th>Aktual</th>
                                    <th>Status</th>
                                    <?php if (isset($_GET['debug']) && $_GET['debug']=='1') { ?>
                                    <th>Total Qty</th>
                                    <th>Total Used</th>
                                    <th>Material Sample</th>
                                    <th>Pemakaian Sample</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach (($monitor ?? []) as $m) { foreach ($m['items'] as $it) { $i++; ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo htmlspecialchars($m['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($m['sloc']); ?></td>
                                    <td><?php echo htmlspecialchars($it['tipe']); ?></td>
                                    <td><?php echo htmlspecialchars($it['standard']); ?></td>
                                    <td><?php echo htmlspecialchars($it['actual']); ?></td>
                                    <td>
                                        <?php if ($it['status']=='red') { ?>
                                            <span style="display:inline-block;width:14px;height:14px;border-radius:50%;background:#e74c3c"></span>
                                        <?php } elseif ($it['status']=='yellow') { ?>
                                            <span style="display:inline-block;width:14px;height:14px;border-radius:50%;background:#f1c40f"></span>
                                        <?php } else { ?>
                                            <span style="display:inline-block;width:14px;height:14px;border-radius:50%;background:#2ecc71"></span>
                                        <?php } ?>
                                    </td>
                                    <?php if (isset($_GET['debug']) && $_GET['debug']=='1') { ?>
                                    <td><?php echo htmlspecialchars($it['total_qty']); ?></td>
                                    <td><?php echo htmlspecialchars($it['total_used']); ?></td>
                                    <td><pre style="max-height:120px;overflow:auto"><?php echo htmlspecialchars(json_encode($it['materials_sample'], JSON_PRETTY_PRINT)); ?></pre></td>
                                    <td><pre style="max-height:120px;overflow:auto"><?php echo htmlspecialchars(json_encode($it['pemakaian_sample'], JSON_PRETTY_PRINT)); ?></pre></td>
                                    <?php } ?>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        if (window.DataTable) {
            new DataTable('#monitorTable', { responsive: true, order: [] });
        }
    });
</script>

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
