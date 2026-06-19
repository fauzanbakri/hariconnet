<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Report Shift Corpo</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Report</a></li>
                                <li class="breadcrumb-item active">Report Shift Corpo</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 me-2">Report Shift Corpo</h4>
                            <div class="flex-shrink-0 ms-auto">
                                <button type="button" class="btn btn-primary" id="copyReportBtn">Copy</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <div class="border rounded p-2 bg-light">
                                            <small class="text-muted">INC Corporate</small>
                                            <h5 class="mb-0">(<?php echo count($openRows ?? []); ?>)</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="border rounded p-2 bg-light">
                                            <small class="text-muted">Resolve</small>
                                            <h5 class="mb-0">(<?php echo count($resolveRows ?? []); ?>)</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border rounded p-2 bg-light">
                                            <small class="text-muted">Wilayah</small>
                                            <div class="small mb-0">
                                                <?php
                                                $wilayahText = [];
                                                foreach (($provinceList ?? []) as $item) {
                                                    $wilayahText[] = $item['province'] . ' :(' . $item['count'] . ')';
                                                }
                                                echo htmlspecialchars(count($wilayahText) ? implode(', ', $wilayahText) : '-');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <textarea id="reportShiftText" class="form-control" rows="30" style="font-family: monospace; white-space: pre-wrap; min-height: 500px;" readonly><?php echo htmlspecialchars($reportText ?? ''); ?></textarea>
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
<script>
    document.getElementById('copyReportBtn')?.addEventListener('click', function () {
        const textarea = document.getElementById('reportShiftText');
        if (!textarea) return;

        textarea.focus();
        textarea.select();

        const copyText = function () {
            const btn = document.getElementById('copyReportBtn');
            if (!btn) return;
            const original = btn.innerHTML;
            btn.innerHTML = 'Copied';
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-success');
            setTimeout(function () {
                btn.innerHTML = original;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-primary');
            }, 1500);
        };

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(textarea.value).then(copyText);
        } else {
            try {
                document.execCommand('copy');
                copyText();
            } catch (e) {
                alert('Gagal menyalin. Silakan pilih dan copy manual.');
            }
        }
    });
</script>
