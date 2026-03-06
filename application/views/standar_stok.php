
        <!-- Standar Stok View -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Standar Stok</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Material</a></li>
                                        <li class="breadcrumb-item active">Standar Stok</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Tabel Standar Stok</h5>
                                </div>
                                <div class="card-body">
                                    <table id="standarStokTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>ID BC</th>
                                                <th>ONT HUAWEI</th>
                                                <th>ONT FIBERHOME</th>
                                                <th>ONT ZTE</th>
                                                <th>ONT RAISECOM</th>
                                                <th>ONT BDCOM</th>
                                                <th>DW 50</th>
                                                <th>DW 100</th>
                                                <th>DW 150</th>
                                                <th>DW 250</th>
                                                <th>DW 300</th>
                                                <th>DW 1000</th>
                                                <th>ADSS 6C</th>
                                                <th>ADSS 24C</th>
                                                <th>ADSS 48C</th>
                                                <th>ADSS 96C</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($rows)) {
                                                $i = 0;
                                                foreach ($rows as $r) {
                                                    $i++;
                                                    echo '<tr>';
                                                    echo '<td>'.$i.'</td>';
                                                    echo '<td>'.(isset($r->idStandarStok)?$r->idStandarStok:'-').'</td>';
                                                    echo '<td>'.(isset($r->idBc)?$r->idBc:'-').'</td>';
                                                    echo '<td>'.(isset($r->ont_huawei)?$r->ont_huawei:'-').'</td>';
                                                    echo '<td>'.(isset($r->ont_fiberhome)?$r->ont_fiberhome:'-').'</td>';
                                                    echo '<td>'.(isset($r->ont_zte)?$r->ont_zte:'-').'</td>';
                                                    echo '<td>'.(isset($r->ont_raisecom)?$r->ont_raisecom:'-').'</td>';
                                                    echo '<td>'.(isset($r->ont_bdcom)?$r->ont_bdcom:'-').'</td>';
                                                    echo '<td>'.(isset($r->dw_50)?$r->dw_50:'-').'</td>';
                                                    echo '<td>'.(isset($r->dw_100)?$r->dw_100:'-').'</td>';
                                                    echo '<td>'.(isset($r->dw_150)?$r->dw_150:'-').'</td>';
                                                    echo '<td>'.(isset($r->dw_250)?$r->dw_250:'-').'</td>';
                                                    echo '<td>'.(isset($r->dw_300)?$r->dw_300:'-').'</td>';
                                                    echo '<td>'.(isset($r->dw_1000)?$r->dw_1000:'-').'</td>';
                                                    echo '<td>'.(isset($r->adss_6c)?$r->adss_6c:'-').'</td>';
                                                    echo '<td>'.(isset($r->adss_24c)?$r->adss_24c:'-').'</td>';
                                                    echo '<td>'.(isset($r->adss_48c)?$r->adss_48c:'-').'</td>';
                                                    echo '<td>'.(isset($r->adss_96c)?$r->adss_96c:'-').'</td>';
                                                    echo '</tr>';
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Standar Stok
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                SIBT
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new DataTable('#standarStokTable', {
            lengthMenu: [[-1,10,25,50], ['All',10,25,50]],
            responsive: true,
            order: []
        });
    });
</script>
