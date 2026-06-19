<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title mb-1">Report Shift Corpo</h4>
                                <p class="text-muted mb-0">Copy hasil report corporate untuk dibagikan</p>
                            </div>
                            <button type="button" class="btn btn-primary" id="copyReportBtn">Copy</button>
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

                            <textarea id="reportShiftText" class="form-control" rows="30" style="font-family: monospace; white-space: pre-wrap;" readonly><?php echo htmlspecialchars($reportText ?? ''); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
