<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Monitoring Tim</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header"><h5 class="card-title mb-0">Summary Tim</h5></div>
                        <div class="card-body">
                            <ul class="list-group" id="team-summary">
                                <?php foreach($summary as $s){ ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center team-item" data-team="<?php echo htmlspecialchars($s->tim); ?>">
                                        <div class="me-2" style="display:grid;grid-template-columns:380px minmax(0,1fr);column-gap:.5rem;align-items:center;min-width:0;flex:1;">
                                            <span class="text-muted" style="display:block;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">
                                                <?php echo htmlspecialchars(trim(($s->provinsi ?: '') . (empty($s->kabupaten)?'':(' / ' . $s->kabupaten)))); ?>
                                            </span>
                                            <span class="team-name" style="display:block;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">
                                                <?php echo htmlspecialchars($s->tim); ?>
                                            </span>
                                        </div>
                                        <span class="badge bg-primary rounded-pill"><?php echo $s->total_incidents; ?></span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header"><h5 class="card-title mb-0">Incidents</h5></div>
                        <div class="card-body">
                            <div id="team-name" class="mb-2">Pilih tim untuk melihat incident</div>
                            <table id="incidents-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID Insiden</th>
                                        <th>ID Tiket</th>
                                        <th>Tanggal</th>
                                        <th>Durasi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
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
$(function(){
    function loadIncidents(team){
        $('#team-name').text('Tim: ' + team);
        $.getJSON('MonitoringTim/listIncidents', {team: team}, function(data){
            var tbody = $('#incidents-table tbody').empty();
            data.forEach(function(row){
                var status = row.status || '';
                // Determine button states
                var blocked = ['SOLVED (ICRM OPEN)','CLOSED','EARLY'];
                var onprogressAllowed = ['OPEN','NEW','STOPCLOCK'];
                var canOnProgress = onprogressAllowed.indexOf(status.toUpperCase()) >=0 && blocked.indexOf(status.toUpperCase())<0;
                var canAntrian = status.toUpperCase() === 'ON PROGRESS' && blocked.indexOf(status.toUpperCase())<0;

                var btnOn = '<button class="btn btn-sm btn-success btn-onprogress" data-id="'+row.idTiket+'" '+(canOnProgress?'':'disabled')+'>On Progress</button>';
                var btnAn = '<button class="btn btn-sm btn-secondary btn-antrian" data-id="'+row.idTiket+'" '+(canAntrian?'':'disabled')+'>Antrian</button>';

                function renderStatusBadge(statusText){
                    var s = (statusText||'').toUpperCase();
                    var cls = 'bg-light text-dark';
                    if (s.indexOf('SOLVED')>=0 || s.indexOf('CLOSED')>=0) cls = 'bg-success';
                    else if (s.indexOf('ON PROGRESS')>=0) cls = 'bg-secondary';
                    else if (s === 'OPEN') cls = 'bg-primary';
                    else if (s.indexOf('EARLY')>=0) cls = 'bg-warning';
                    else if (s === 'NEW' || s === 'STOPCLOCK') cls = 'bg-info';
                    return $('<span>').addClass('badge '+cls).text(statusText);
                }

                var tr = $('<tr>');
                tr.append($('<td>').text(row.idInsiden));
                tr.append($('<td>').text(row.idTiket));
                tr.append($('<td>').text(row.tanggal));
                tr.append($('<td>').text(row.duration));
                tr.append($('<td>').append(renderStatusBadge(status)));
                tr.append($('<td>').html(btnOn+' '+btnAn));
                tbody.append(tr);
            });
        });
    }

    $(document).on('click', '.team-item', function(){
        var team = $(this).data('team');
        loadIncidents(team);
    });

    // delegate action buttons
    $(document).on('click', '.btn-onprogress', function(){
        var id = $(this).data('id');
        $.post('MonitoringTim/updateStatus', {idTiket: id, action: 'onprogress'}, function(res){
            try{ var j = (typeof res === 'string')? JSON.parse(res): res; if(j.success){ $('.team-item[data-team]').first().click(); } else { alert(j.message||'Gagal'); }}catch(e){ alert('Error'); }
        });
    });

    $(document).on('click', '.btn-antrian', function(){
        var id = $(this).data('id');
        $.post('MonitoringTim/updateStatus', {idTiket: id, action: 'antrian'}, function(res){
            try{ var j = (typeof res === 'string')? JSON.parse(res): res; if(j.success){ $('.team-item[data-team]').first().click(); } else { alert(j.message||'Gagal'); }}catch(e){ alert('Error'); }
        });
    });
});
</script>
