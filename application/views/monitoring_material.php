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
