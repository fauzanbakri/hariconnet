
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
                                    <div class="float-end">
                                        <button class="btn btn-primary btn-sm" id="btnAddStandar">Input Standar Stok</button>
                                    </div>
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

                        <!-- Modal Input Standar Stok -->
                        <div class="modal fade" id="modalInputStandar" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Input Standar Stok</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formInputStandar">
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <label class="form-label">Basecamp (SLOC)</label>
                                                    <select id="inputIdBc" class="form-select">
                                                        <option value="">Pilih Basecamp</option>
                                                        <?php
                                                        // Normalize basecamp input: support CI result objects, arrays, or single objects
                                                        $bc_list = [];
                                                        if (!empty($basecamp)) {
                                                            if (is_object($basecamp) && method_exists($basecamp, 'result')) {
                                                                $bc_list = $basecamp->result();
                                                            } elseif (is_array($basecamp)) {
                                                                $bc_list = $basecamp;
                                                            } elseif (is_object($basecamp)) {
                                                                // Try to convert traversable/object to array of objects
                                                                try {
                                                                    $bc_list = iterator_to_array($basecamp);
                                                                } catch (Exception $e) {
                                                                    $bc_list = [(object)$basecamp];
                                                                }
                                                            } else {
                                                                $bc_list = (array)$basecamp;
                                                            }
                                                        }

                                                        if (!empty($bc_list)) {
                                                            foreach ($bc_list as $bc) {
                                                                // support both object and associative-array items
                                                                $id = '';
                                                                $name = '';
                                                                $sloc = '';
                                                                if (is_object($bc)) {
                                                                    $id = isset($bc->idBc) ? $bc->idBc : (isset($bc->id) ? $bc->id : '');
                                                                    $name = isset($bc->namaAkun) ? $bc->namaAkun : (isset($bc->nama) ? $bc->nama : '');
                                                                    $sloc = isset($bc->sloc) ? $bc->sloc : '';
                                                                } elseif (is_array($bc)) {
                                                                    $id = isset($bc['idBc']) ? $bc['idBc'] : (isset($bc['id']) ? $bc['id'] : '');
                                                                    $name = isset($bc['namaAkun']) ? $bc['namaAkun'] : (isset($bc['nama']) ? $bc['nama'] : '');
                                                                    $sloc = isset($bc['sloc']) ? $bc['sloc'] : '';
                                                                } else {
                                                                    $id = (string)$bc;
                                                                }

                                                                $label = htmlspecialchars($name ?: $sloc ?: $id);
                                                                if (!empty($sloc)) $label .= ' ('.htmlspecialchars($sloc).')';
                                                                echo '<option value="'.htmlspecialchars($id).'">'.$label.'</option>';
                                                            }
                                                        } else {
                                                            echo '<option value="" disabled>Tidak ada Basecamp (SLOC) — tambahkan di menu Basecamp</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                        <?php if (!empty($bc_list)) { echo '<small class="text-muted">Jumlah basecamp: '.count($bc_list).'</small>'; } ?>
                                                        <?php if (isset($_GET['debug']) && $_GET['debug']=='1') { echo '<pre style="max-height:200px;overflow:auto;background:#fff;border:1px solid #ddd;padding:8px;margin-top:8px">'.htmlspecialchars(print_r($bc_list, true)).'</pre>'; } ?>
                                                    <div class="mt-2">
                                                        <a href="Basecamp" target="_blank" class="btn btn-sm btn-outline-primary">Tambah Basecamp</a>
                                                        <small class="text-muted ms-2">(buka halaman Basecamp untuk menambah SLOC)</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">ONT HUAWEI</label>
                                                    <input type="number" id="ont_huawei" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">ONT FIBERHOME</label>
                                                    <input type="number" id="ont_fiberhome" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">ONT ZTE</label>
                                                    <input type="number" id="ont_zte" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">ONT RAISECOM</label>
                                                    <input type="number" id="ont_raisecom" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">ONT BDCOM</label>
                                                    <input type="number" id="ont_bdcom" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">DW 50</label>
                                                    <input type="number" id="dw_50" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">DW 100</label>
                                                    <input type="number" id="dw_100" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">DW 150</label>
                                                    <input type="number" id="dw_150" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">DW 250</label>
                                                    <input type="number" id="dw_250" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">DW 300</label>
                                                    <input type="number" id="dw_300" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">DW 1000</label>
                                                    <input type="number" id="dw_1000" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">ADSS 6C</label>
                                                    <input type="number" id="adss_6c" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">ADSS 24C</label>
                                                    <input type="number" id="adss_24c" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">ADSS 48C</label>
                                                    <input type="number" id="adss_48c" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">ADSS 96C</label>
                                                    <input type="number" id="adss_96c" class="form-control" value="0">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary" id="saveStandarBtn">Simpan</button>
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

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>

    <script src="js/code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="js/cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="js/cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="js/cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="js/cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="js/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="js/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="js/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/app.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new DataTable('#standarStokTable', {
            lengthMenu: [[-1,10,25,50], ['All',10,25,50]],
            responsive: true,
            order: []
        });
    });
</script>
<script>
    $(function(){
        $('#btnAddStandar').on('click', function(){
            var modal = new bootstrap.Modal(document.getElementById('modalInputStandar'));
            modal.show();
        });

        $('#saveStandarBtn').on('click', function(){
            var payload = {
                idBc: $('#inputIdBc').val(),
                ont_huawei: $('#ont_huawei').val(),
                ont_fiberhome: $('#ont_fiberhome').val(),
                ont_zte: $('#ont_zte').val(),
                ont_raisecom: $('#ont_raisecom').val(),
                ont_bdcom: $('#ont_bdcom').val(),
                dw_50: $('#dw_50').val(),
                dw_100: $('#dw_100').val(),
                dw_150: $('#dw_150').val(),
                dw_250: $('#dw_250').val(),
                dw_300: $('#dw_300').val(),
                dw_1000: $('#dw_1000').val(),
                adss_6c: $('#adss_6c').val(),
                adss_24c: $('#adss_24c').val(),
                adss_48c: $('#adss_48c').val(),
                adss_96c: $('#adss_96c').val()
            };

            if (!payload.idBc) {
                alert('Pilih Basecamp (SLOC) terlebih dahulu');
                return;
            }

            $.ajax({
                url: 'StandarStok/insertData',
                type: 'POST',
                data: payload,
                success: function(resp){
                    if (resp === 'success') {
                        location.reload();
                    } else {
                        alert('Gagal: ' + resp);
                    }
                },
                error: function(xhr){ alert('Error: ' + xhr.responseText); }
            });
        });
    });
</script>
