<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Detail FAT</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tools</a></li>
                                <li class="breadcrumb-item"><a href="FatList">List FAT</a></li>
                                <li class="breadcrumb-item active">Detail FAT</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">Detail ODP: <?php echo htmlspecialchars($odp); ?></h5>
                            </div>
                            <a href="FatList" class="btn btn-secondary btn-sm">
                                <i class="ri-arrow-left-line"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($data)): ?>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <div class="border rounded p-3">
                                            <strong>ID ODP</strong>
                                            <div><?php echo htmlspecialchars($data['ID ODP'] ?? '-'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="border rounded p-3">
                                            <strong>Area</strong>
                                            <div><?php echo htmlspecialchars($data['AREA'] ?? '-'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="border rounded p-3">
                                            <strong>Koordinat</strong>
                                            <div><?php echo htmlspecialchars($data['KOORDINAT'] ?? '-'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <div class="border rounded p-3">
                                            <strong>Hostname OLT</strong>
                                            <div><?php echo htmlspecialchars($data['HOSTNAME OLT'] ?? '-'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="border rounded p-3">
                                            <strong>Cluster</strong>
                                            <div><?php echo htmlspecialchars($data['CLUSTER'] ?? '-'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="border rounded p-3">
                                            <strong>Kapasitas Splitter</strong>
                                            <div><?php echo htmlspecialchars($data['KAPASITAS SPLITTER'] ?? '-'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 text-center mb-4">
                                    <?php for ($i = 1; $i <= $jumlahPort; $i++):
                                        $port = 'PORT '.$i;
                                        $value = strtoupper(trim($data[$port] ?? ''));
                                        $isFilled = $value && $value !== 'IDLE';
                                        $colorClass = $isFilled ? 'bg-danger' : 'bg-success';
                                    ?>
                                    <div class="col-3 col-sm-2">
                                        <button type="button" class="rounded-circle text-white <?php echo $colorClass; ?> d-flex align-items-center justify-content-center mx-auto border-0" style="width: 55px; height: 55px;" data-bs-toggle="modal" data-bs-target="#portModal" data-port="<?php echo $i; ?>" data-value="<?php echo htmlspecialchars($value); ?>">
                                            P<?php echo $i; ?>
                                        </button>
                                        <div class="mt-2 small text-truncate"><?php echo $isFilled ? 'Terisi' : 'Kosong'; ?></div>
                                    </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="border-top pt-3">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted">Total Pending</span>
                                                <strong><?php echo htmlspecialchars($data['STATUS'] ?? '-'); ?></strong>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted">Oldest Data</span>
                                                <strong><?php echo htmlspecialchars($data['ID ODP'] ?? '-'); ?></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning mb-0">
                                    Data untuk ODP <strong><?php echo htmlspecialchars($odp); ?></strong> tidak ditemukan.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    
    <!-- <script src="assets/js/plugins.js"></script> -->

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/apexcharts-line.init.js"></script>


    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-analytics.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>