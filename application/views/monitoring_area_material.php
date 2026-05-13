<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Monitoring Area Material</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Material Status by Area (Kabupaten)</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($monitor)): ?>
                            <div class="alert alert-info">No data available</div>
                        <?php else: ?>
                            <?php foreach ($monitor as $area => $items): ?>
                                <div class="mb-4">
                                    <h6 class="text-primary mb-3"><?= htmlspecialchars($area) ?></h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Tipe Material</th>
                                                    <th class="text-center">Standard</th>
                                                    <th class="text-center">Actual</th>
                                                    <th class="text-center">Percentage</th>
                                                    <th class="text-center">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($items as $item): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($item['tipe']) ?></td>
                                                        <td class="text-center"><?= $item['standard'] ?></td>
                                                        <td class="text-center"><?= $item['actual'] ?></td>
                                                        <td class="text-center"><?= $item['percentage'] ?>%</td>
                                                        <td class="text-center">
                                                            <?php if ($item['status'] === 'OK'): ?>
                                                                <span class="badge bg-success">OK</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-danger">LOW</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
