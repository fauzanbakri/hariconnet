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
                                        $borderClass = $isFilled ? 'border-danger' : 'border-success';
                                        $textClass = $isFilled ? 'text-danger' : 'text-success';
                                    ?>
                                    <div class="col-3 col-sm-2">
                                        <button type="button" class="port-button btn border border-3 <?php echo $borderClass; ?> <?php echo $textClass; ?> d-flex align-items-center justify-content-center mx-auto" style="width: 65px; height: 65px; background-color: #fff; border-radius: 0;" data-port="<?php echo $i; ?>" data-value="<?php echo htmlspecialchars($value); ?>">
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

<!-- Port detail modal -->
<div class="modal fade" id="portModal" tabindex="-1" aria-labelledby="portModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="portModalLabel">Detail Port</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="portSpinner" class="mb-3">
                    <div class="spinner-border" role="status"></div>
                    <p class="mt-2 mb-0">Memuat...</p>
                </div>
                <div id="portDetail" class="d-none">
                    <p class="mb-1"><strong>Port</strong>: <span id="portNumber"></span></p>
                    <p class="mb-1"><strong>Status</strong>: <span id="portStatus"></span></p>
                    <p class="mb-0"><strong>Info</strong>: <span id="portValue"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            var portModal = document.getElementById('portModal');
            var portNumber = portModal ? portModal.querySelector('#portNumber') : null;
            var portStatus = portModal ? portModal.querySelector('#portStatus') : null;
            var portValue = portModal ? portModal.querySelector('#portValue') : null;
            var detail = portModal ? portModal.querySelector('#portDetail') : null;
            var spinner = portModal ? portModal.querySelector('#portSpinner') : null;
            var bootstrapModal = portModal ? new bootstrap.Modal(portModal) : null;

            function openPortModal(button) {
                if (!portModal || !bootstrapModal || !detail || !spinner || !portNumber || !portStatus || !portValue) return;
                var port = button.getAttribute('data-port');
                var value = button.getAttribute('data-value') || '-';

                portNumber.textContent = port;
                portValue.textContent = value || '-';
                portStatus.textContent = (value.trim() && value !== 'IDLE') ? 'Terisi' : 'Kosong';

                spinner.classList.remove('d-none');
                detail.classList.add('d-none');

                bootstrapModal.show();

                setTimeout(function () {
                    spinner.classList.add('d-none');
                    detail.classList.remove('d-none');
                }, 300);
            }

            document.querySelectorAll('.port-button').forEach(function (button) {
                button.addEventListener('click', function () {
                    openPortModal(button);
                });
            });
        })();
    </script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    
    <!-- App js -->
    <script src="assets/js/app.js"></script>