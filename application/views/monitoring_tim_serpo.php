<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Monitoring Tim Serpo</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Monitoring Tim Serpo</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="timSerpoCards">
                <?php foreach(($incident_teams ?? []) as $r){
                    $total_pending = (int)$r['total_pending'];
                    $total_onprogress = (int)$r['total_onprogress'];
                    if ($total_onprogress > 0 && $total_pending > 1) {
                        $borderClass = 'border-info';
                        $badgeClass = 'bg-info text-white';
                        $statusText = 'On Progress';
                    } elseif ($total_onprogress > 0 && $total_pending === 1) {
                        $borderClass = 'border-success';
                        $badgeClass = 'bg-success text-white';
                        $statusText = 'On Progress';
                    } elseif ($total_pending > 0 && $total_onprogress === 0) {
                        $borderClass = 'border-danger';
                        $badgeClass = 'bg-danger text-white';
                        $statusText = 'Pending';
                    } else {
                        $borderClass = 'border-secondary';
                        $badgeClass = 'bg-secondary text-white';
                        $statusText = 'Info';
                    }
                ?>
                <div class="col-md-4 col-lg-3 mb-2">
                    <div class="card shadow-sm border-0 border-top border-4 <?php echo $borderClass; ?> h-100">
                        <div class="card-body py-2 px-2 d-flex flex-column justify-content-between h-100">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <div>
                                        <h6 class="card-title mb-0 text-truncate">
                                            <?php if ($total_pending > 0 && $total_onprogress === 0) { ?>
                                                <span class="badge bg-danger text-white me-1 py-1 px-2">!</span>
                                            <?php } ?>
                                            <?php echo htmlspecialchars($r['tim']); ?>
                                        </h6>
                                    </div>
                                    <span class="badge <?php echo $badgeClass; ?> py-1 px-2 fs-7"><?php echo $statusText; ?></span>
                                </div>
                                <p class="fw-semibold mb-1 small">Pending Feeder + Corporate: <span class="text-dark"><?php echo (int)$r['feeder_pending'] + (int)$r['corporate_pending']; ?></span></p>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge bg-light text-dark py-1 fs-7">Feeder <?php echo (int)$r['feeder_pending']; ?></span>
                                    <span class="badge bg-light text-dark py-1 fs-7">IKR <?php echo (int)$r['retail_pending']; ?></span>
                                    <span class="badge bg-light text-dark py-1 fs-7">Corporate <?php echo (int)$r['corporate_pending']; ?></span>
                                </div>
                                <div class="d-flex flex-wrap gap-1 mt-2">
                                    <?php if ((int)$r['feeder_onprogress'] > 0): ?>
                                        <span class="badge bg-info text-white py-1 fs-7">Feeder On Progress</span>
                                    <?php elseif ((int)$r['feeder_pending'] > 0): ?>
                                        <span class="badge bg-danger text-white py-1 fs-7">Feeder Pending</span>
                                    <?php endif; ?>
                                    <?php if ((int)$r['retail_onprogress'] > 0): ?>
                                        <span class="badge bg-info text-white py-1 fs-7">IKR On Progress</span>
                                    <?php elseif ((int)$r['retail_pending'] > 0): ?>
                                        <span class="badge bg-danger text-white py-1 fs-7">IKR Pending</span>
                                    <?php endif; ?>
                                    <?php if ((int)$r['corporate_onprogress'] > 0): ?>
                                        <span class="badge bg-info text-white py-1 fs-7">Corporate On Progress</span>
                                    <?php elseif ((int)$r['corporate_pending'] > 0): ?>
                                        <span class="badge bg-danger text-white py-1 fs-7">Corporate Pending</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="pt-1 border-top">
                                <div class="d-flex justify-content-between align-items-center text-muted smaller">
                                    <span>Total Pending <strong><?php echo $total_pending; ?></strong></span>
                                    <span>On Progress <strong><?php echo $total_onprogress; ?></strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
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

    <!-- Realtime Tim Serpo -->
    <script>
        (function () {
            const cardsContainer = document.getElementById('timSerpoCards');
            const endpoint = 'MonitoringTimSerpo/stats';
            const refreshMs = 10000;

            function getStatusMeta(item) {
                const totalPending = parseInt(item.total_pending, 10) || 0;
                const totalOnprogress = parseInt(item.total_onprogress, 10) || 0;
                if (totalOnprogress > 0 && totalPending > 1) {
                    return { border: 'border-info', badge: 'bg-info text-white', text: 'On Progress' };
                }
                if (totalOnprogress > 0 && totalPending === 1) {
                    return { border: 'border-success', badge: 'bg-success text-white', text: 'On Progress' };
                }
                if (totalPending > 0 && totalOnprogress === 0) {
                    return { border: 'border-danger', badge: 'bg-danger text-white', text: 'Pending' };
                }
                return { border: 'border-secondary', badge: 'bg-secondary text-white', text: 'Info' };
            }

            function renderCards(teams) {
                if (!cardsContainer) return;
                if (!Array.isArray(teams) || teams.length === 0) {
                    cardsContainer.innerHTML = '<div class="col-12"><div class="alert alert-warning text-center">Tidak ada data tim.</div></div>';
                    return;
                }

                cardsContainer.innerHTML = teams.map(function (r) {
                    const meta = getStatusMeta(r);
                    const feederPending = parseInt(r.feeder_pending, 10) || 0;
                    const retailPending = parseInt(r.retail_pending, 10) || 0;
                    const corporatePending = parseInt(r.corporate_pending, 10) || 0;                        const feederOnprogress = parseInt(r.feeder_onprogress, 10) || 0;
                        const retailOnprogress = parseInt(r.retail_onprogress, 10) || 0;
                        const corporateOnprogress = parseInt(r.corporate_onprogress, 10) || 0;                    const totalPending = parseInt(r.total_pending, 10) || 0;
                    const totalOnprogress = parseInt(r.total_onprogress, 10) || 0;
                    return '\n                <div class="col-md-4 col-lg-3 mb-2">\n                    <div class="card shadow-sm border-0 border-top border-4 ' + meta.border + ' h-100">\n                        <div class="card-body py-2 px-2 d-flex flex-column justify-content-between h-100">\n                            <div>\n                                <div class="d-flex justify-content-between align-items-start mb-1">\n                                    <div>\n                                        <h6 class="card-title mb-0 text-truncate">' +
                                            (totalPending > 0 && totalOnprogress === 0 ? '<span class="badge bg-danger text-white me-1 py-1 px-2">!</span>' : '') +
                                            htmlspecialchars(r.tim) +
                                        '</h6>\n                                    </div>\n                                    <span class="badge ' + meta.badge + ' py-1 px-2 fs-7">' + meta.text + '</span>\n                                </div>\n                                <p class="fw-semibold mb-1 small">Pending Feeder + Corporate: <span class="text-dark">' + (feederPending + corporatePending) + '</span></p>\n                                <div class="d-flex flex-wrap gap-1">\n                                    <span class="badge bg-light text-dark py-1 fs-7">Feeder ' + feederPending + '</span>\n                                    <span class="badge bg-light text-dark py-1 fs-7">IKR ' + retailPending + '</span>\n                                    <span class="badge bg-light text-dark py-1 fs-7">Corporate ' + corporatePending + '</span>\n                                </div>\n                                <div class="d-flex flex-wrap gap-1 mt-2">\n                                    ' + (feederOnprogress > 0 ? '<span class="badge bg-info text-white py-1 fs-7">Feeder On Progress</span>' : (feederPending > 0 ? '<span class="badge bg-danger text-white py-1 fs-7">Feeder Pending</span>' : '')) +\n                                    ' ' + (retailOnprogress > 0 ? '<span class="badge bg-info text-white py-1 fs-7">IKR On Progress</span>' : (retailPending > 0 ? '<span class="badge bg-danger text-white py-1 fs-7">IKR Pending</span>' : '')) +\n                                    ' ' + (corporateOnprogress > 0 ? '<span class="badge bg-info text-white py-1 fs-7">Corporate On Progress</span>' : (corporatePending > 0 ? '<span class="badge bg-danger text-white py-1 fs-7">Corporate Pending</span>' : '')) +\n                                </div>\n                            </div>\n                            <div class="pt-1 border-top">\n                                <div class="d-flex justify-content-between align-items-center text-muted smaller">\n                                    <span>Total Pending <strong>' + totalPending + '</strong></span>\n                                    <span>On Progress <strong>' + totalOnprogress + '</strong></span>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>';
                }).join('');
            }

            function htmlspecialchars(value) {
                return String(value)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            function refresh() {
                fetch(endpoint, {cache: 'no-store'})
                    .then(function (response) {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(function (data) {
                        renderCards(data.incident_teams);
                    })
                    .catch(function (error) {
                        console.warn('Monitoring Tim Serpo refresh failed:', error);
                    });
            }

            if (cardsContainer) {
                setTimeout(refresh, 1000);
                setInterval(refresh, refreshMs);
            }
        })();
    </script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-analytics.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>


