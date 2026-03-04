
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Inventory Material</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Material</a></li>
                                        <li class="breadcrumb-item active">Input Material</li>
                                    </ol>
                                </div>
                                <!-- Modal Tandai Terpakai -->
                                <div class="modal fade" id="tandaiTerpakaiModal" tabindex="-1" aria-labelledby="tandaiTerpakaiModalLabel" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tandaiTerpakaiModalLabel">Tandai Material Terpakai</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="tandaiTerpakaiForm">
                                                    <input type="hidden" id="tandaiIdMaterial">
                                                    <div class="mb-3">
                                                        <label for="tandaiKodeMaterialTerpakai" class="form-label">Kode Material Terpakai</label>
                                                        <input type="text" class="form-control" id="tandaiKodeMaterialTerpakai" placeholder="Kode Material Terpakai">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tandaiSnTerpakai" class="form-label">SN Terpakai</label>
                                                        <input type="text" class="form-control" id="tandaiSnTerpakai" placeholder="SN Terpakai">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-primary" id="simpanTandaiTerpakai">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Daftar Material</h5>
                                </div>

                                <div class="card-header">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <?php
                                                if(
                                                    $_SESSION['role']=='Superadmin' ||
                                                    $_SESSION['role']=='Team Leader'
                                                    ){
                                                        echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#materialModal" onclick="resetForm()">Tambah Material</button>';
                                                    }
                                            ?>
                                            <button hidden type="button" data-toast data-toast-text="" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" id="toast" class="btn btn-light w-xs"></button>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-3">
                                            <label for="filterStartDate" class="form-label">Tanggal Mulai</label>
                                            <input type="date" id="filterStartDate" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="filterEndDate" class="form-label">Tanggal Akhir</label>
                                            <input type="date" id="filterEndDate" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="filterReservasi" class="form-label">Status Reservasi</label>
                                            <select id="filterReservasi" class="form-select form-select-sm">
                                                <option value="">Semua</option>
                                                <option value="Sudah">Sudah</option>
                                                <option value="Belum">Belum</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="filterTerpakai" class="form-label">Status Terpakai</label>
                                            <select id="filterTerpakai" class="form-select form-select-sm">
                                                <option value="">Semua</option>
                                                <?php foreach ($status_terpakai_list as $status) { ?>
                                                    <option value="<?php echo $status->status_terpakai; ?>"><?php echo $status->status_terpakai; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="filterPengiriman" class="form-label">Status Pengiriman</label>
                                            <select id="filterPengiriman" class="form-select form-select-sm">
                                                <option value="">Semua</option>
                                                <option value="Dalam Pengiriman">Dalam Pengiriman</option>
                                                <option value="On Loc">On Loc</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-sm btn-info" onclick="applyFilters()">Filter</button>
                                            <button class="btn btn-sm btn-secondary" onclick="resetFilters()">Reset</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <table id="example2" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Incident</th>
                                                <th>Tanggal</th>
                                                <th>Kategori</th>
                                                <th>Kode Material</th>
                                                <th>SN</th>
                                                <th>SN Terpakai</th>
                                                <th>Kode Material Terpakai</th>
                                                <th>Merk</th>
                                                <th>Tim</th>
                                                <th>Satuan</th>
                                                <th>QTY</th>
                                                <th>Status Reservasi</th>
                                                <th>Status Terpakai</th>
                                                <th>Status Pengiriman</th>
                                                <th>Keterangan</th>
                                                <th>Tandai Terpakai</th>
                                                <?php
                                                if(
                                                    $_SESSION['role']=='Superadmin' ||
                                                    $_SESSION['role']=='Team Leader'
                                                    ){
                                                        echo "<th>Action</th>";
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            if(!empty($materials)) {
                                                foreach ($materials as $material) {
                                                    $count = $count + 1;
                                                    echo "
                                                    <tr>
                                                        <td>".$count."</td>
                                                        <td>".$material->incident."</td>
                                                        <td>".date('d-m-Y', strtotime($material->tanggal))."</td>
                                                        <td><span class='badge '.(($material->kategori == 'FOT') ? 'bg-primary' : 'bg-info').'>".$material->kategori."</span></td>
                                                        <td>".$material->kode_material."</td>
                                                        <td>".$material->sn."</td>
                                                        <td>".(($material->kategori == 'FOC') ? '' : $material->sn_terpakai)."</td>
                                                        <td>".(($material->kategori == 'FOC') ? '' : $material->kode_material_terpakai)."</td>
                                                        <td>".$material->merk."</td>
                                                        <td>".$material->nama."</td>
                                                        <td>".$material->satuan."</td>
                                                        <td>".$material->qty."</td>
                                                        <td><span class='badge ".(($material->status_reservasi == 'Sudah') ? 'bg-success' : 'bg-danger')."'>".$material->status_reservasi."</span></td>
                                                        <td><span class='badge ".(($material->status_terpakai == 'Sudah') ? 'bg-success' : 'bg-danger')."'>".$material->status_terpakai."</span></td>
                                                        <td><span class='badge '.(($material->status_pengiriman == 'On Loc') ? 'bg-primary' : 'bg-info').'>".$material->status_pengiriman."</span></td>
                                                        <td>".substr($material->ket, 0, 30).(strlen($material->ket) > 30 ? '...' : '')."</td>";
                                                        // Tombol Tandai Terpakai (disable jika sudah 'Sudah')
                                                        if (isset($material->status_terpakai) && $material->status_terpakai == 'Sudah') {
                                                            echo "<td><button class='btn btn-secondary btn-sm' disabled>Terpakai</button></td>";
                                                        } else {
                                                            echo "<td><button class='btn btn-success btn-sm tandai-terpakai-btn' data-idmaterial='".$material->idmaterial."' data-kategori='".$material->kategori."'>Tandai Terpakai</button></td>";
                                                        }
                                                        if(
                                                            $_SESSION['role']=='Superadmin' ||
                                                            $_SESSION['role']=='Team Leader'
                                                        ){
                                                            echo "<td>
                                                            <div class='dropdown d-inline-block'>
                                                                <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                                    <i class='ri-more-fill align-middle'></i>
                                                                </button>
                                                                <ul class='dropdown-menu dropdown-menu-end'>
                                                                    <li>
                                                                        <a href='#' class='dropdown-item edit-item-btn' data-idmaterial='".$material->idmaterial."' data-incident='".$material->incident."' data-tanggal='".$material->tanggal."' data-kategori='".$material->kategori."' data-kode_material='".$material->kode_material."' data-sn='".$material->sn."' data-sn_terpakai='".$material->sn_terpakai."' data-kode_material_terpakai='".$material->kode_material_terpakai."' data-merk='".$material->merk."' data-idtim='".$material->idtim."' data-satuan='".$material->satuan."' data-qty='".$material->qty."' data-status_reservasi='".$material->status_reservasi."' data-status_terpakai='".$material->status_terpakai."' data-status_pengiriman='".$material->status_pengiriman."' data-ket='".$material->ket."'>
                                                                            <i class='ri-pencil-fill align-bottom me-2 text-muted'></i> Edit
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href='#' class='dropdown-item remove-item-btn' data-id='".$material->idmaterial."'>
                                                                            <i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Delete
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>";
                                                        }
                                                        echo "
                                                    </tr>
                                                    ";
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
                            <script>document.write(new Date().getFullYear())</script> © Material Input System
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by SIBT
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Modal Add Material -->
        <div class="modal fade" id="materialModal" tabindex="-1" aria-labelledby="materialModalLabel" aria-modal="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="materialModalLabel">Tambah Material</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <label class="form-label">No Incident</label>
                                <input type="text" class="form-control" name="incident" id="incident" autocomplete="off" placeholder="No Incident">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Kategori</label>
                                <select class="form-select" name="kategori" id="kategori" aria-label="Default select example">
                                    <option value="">Pilih Kategori</option>
                                    <option value="FOC">FOC</option>
                                    <option value="FOT">FOT</option>
                                </select>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Kode Material</label>
                                <input type="text" class="form-control" name="kode_material" id="kode_material" autocomplete="off" placeholder="Kode Material">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">SN</label>
                                <input type="text" class="form-control" name="sn" id="sn" autocomplete="off" placeholder="SN">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Merk</label>
                                <input type="text" class="form-control" name="merk" id="merk" autocomplete="off" placeholder="Merk">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Tim</label>
                                <select class="form-select" name="idtim" id="idtim" aria-label="Default select example">
                                    <option value="">Pilih Tim</option>
                                    <?php foreach ($tims as $tim) { ?>
                                    <option value="<?php echo $tim->idTim; ?>"><?php echo $tim->nama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xxl-3">
                                <label class="form-label">QTY</label>
                                <input type="number" class="form-control" name="qty" id="qty" autocomplete="off" placeholder="QTY">
                            </div>
                            <div class="col-xxl-3">
                                <label class="form-label">Satuan</label>
                                <input type="text" class="form-control" name="satuan" id="satuan" autocomplete="off" placeholder="Satuan">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Status Reservasi</label>
                                <select class="form-select" name="status_reservasi" id="status_reservasi" aria-label="Default select example">
                                    <option value="">Pilih Status</option>
                                    <option value="Sudah">Sudah</option>
                                    <option value="Belum">Belum</option>
                                </select>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Status Terpakai</label>
                                <select class="form-select" name="status_terpakai" id="status_terpakai" aria-label="Default select example">
                                    <option value="">Pilih Status</option>
                                    <option value="Sudah">Sudah</option>
                                    <option value="Belum">Belum</option>
                                </select>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Status Pengiriman</label>
                                <select class="form-select" name="status_pengiriman" id="status_pengiriman" aria-label="Default select example">
                                    <option value="">Pilih Status</option>
                                    <option value="Dalam Pengiriman">Dalam Pengiriman</option>
                                    <option value="On Loc">On Loc</option>
                                </select>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Keterangan</label>
                                <textarea type="text" class="form-control" name="ket" id="ket" autocomplete="off" placeholder="Keterangan"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" id="submitBtn" onclick="saveMaterial()">Submit</button>
                                </div>
                            </div>
                            <input type="hidden" id="idmaterial" name="idmaterial" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Material -->
        <div class="modal fade" id="editMaterialModal" tabindex="-1" aria-labelledby="editMaterialModalLabel" aria-modal="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMaterialModalLabel">Edit Material</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <input type="hidden" id="editIdmaterial" name="editIdmaterial" value="">
                            <div class="col-xxl-6">
                                <label class="form-label">No Incident</label>
                                <input type="text" class="form-control" name="editIncident" id="editIncident" autocomplete="off" placeholder="No Incident">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="editTanggal" id="editTanggal" autocomplete="off">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Kategori</label>
                                <select class="form-select" name="editKategori" id="editKategori" aria-label="Default select example">
                                    <option value="">Pilih Kategori</option>
                                    <option value="FOC">FOC</option>
                                    <option value="FOT">FOT</option>
                                </select>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Kode Material</label>
                                <input type="text" class="form-control" name="editKodeMaterial" id="editKodeMaterial" autocomplete="off" placeholder="Kode Material">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">SN</label>
                                <input type="text" class="form-control" name="editSn" id="editSn" autocomplete="off" placeholder="SN">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">SN Terpakai</label>
                                <input type="text" class="form-control" name="editSnTerpakai" id="editSnTerpakai" autocomplete="off" placeholder="SN Terpakai">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Kode Material Terpakai</label>
                                <input type="text" class="form-control" name="editKodeMaterialTerpakai" id="editKodeMaterialTerpakai" autocomplete="off" placeholder="Kode Material Terpakai">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Merk</label>
                                <input type="text" class="form-control" name="editMerk" id="editMerk" autocomplete="off" placeholder="Merk">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Tim</label>
                                <select class="form-select" name="editIdtim" id="editIdtim" aria-label="Default select example">
                                    <option value="">Pilih Tim</option>
                                    <?php foreach ($tims as $tim) { ?>
                                    <option value="<?php echo $tim->idTim; ?>"><?php echo $tim->nama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xxl-3">
                                <label class="form-label">Satuan</label>
                                <input type="text" class="form-control" name="editSatuan" id="editSatuan" autocomplete="off" placeholder="Satuan">
                            </div>
                            <div class="col-xxl-3">
                                <label class="form-label">QTY</label>
                                <input type="number" class="form-control" name="editQty" id="editQty" autocomplete="off" placeholder="QTY">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Status Reservasi</label>
                                <select class="form-select" name="editStatusReservasi" id="editStatusReservasi" aria-label="Default select example">
                                    <option value="">Pilih Status</option>
                                    <option value="Sudah">Sudah</option>
                                    <option value="Belum">Belum</option>
                                </select>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Status Terpakai</label>
                                <select class="form-select" name="editStatusTerpakai" id="editStatusTerpakai" aria-label="Default select example">
                                    <option value="">Pilih Status</option>
                                    <option value="Sudah">Sudah</option>
                                    <option value="Belum">Belum</option>
                                </select>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Status Pengiriman</label>
                                <select class="form-select" name="editStatusPengiriman" id="editStatusPengiriman" aria-label="Default select example">
                                    <option value="">Pilih Status</option>
                                    <option value="Dalam Pengiriman">Dalam Pengiriman</option>
                                    <option value="On Loc">On Loc</option>
                                </select>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Keterangan</label>
                                <textarea type="text" class="form-control" name="editKet" id="editKet" autocomplete="off" placeholder="Keterangan"></textarea>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Kode Material</label>
                                <p id="editDisplayKodeMaterial">-</p>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Deskripsi Material</label>
                                <p id="editDisplayDeskripsiMaterial">-</p>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Kode Material Terpakai</label>
                                <p id="editDisplayKodeMaterialTerpakai">-</p>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label">Deskripsi Material Terpakai</label>
                                <p id="editDisplayDeskripsiMaterialTerpakai">-</p>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" id="editsubmitBtn" onclick="editSaveMaterial()">Submit</button>
                                </div>
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
// Modal & tombol Tandai Terpakai
$(document).on('click', '.tandai-terpakai-btn', function() {
    var idmaterial = $(this).data('idmaterial');
    var kategori = $(this).data('kategori');
    if (kategori === 'FOT') {
        $('#tandaiIdMaterial').val(idmaterial);
        $('#tandaiKodeMaterialTerpakai').val('');
        $('#tandaiSnTerpakai').val('');
        var modal = new bootstrap.Modal(document.getElementById('tandaiTerpakaiModal'));
        modal.show();
    } else {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Tandai material ini sebagai terpakai?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, tandai',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-primary w-xs me-2 mt-2',
                cancelButton: 'btn btn-light w-xs mt-2'
            },
            buttonsStyling: false
        }).then(function(result) {
            if (result.isConfirmed) {
                // langsung tandai terpakai tanpa kode/sn
                $.ajax({
                    url: 'Material/tandai_terpakai',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        idmaterial: idmaterial,
                        kode_material_terpakai: '',
                        sn_terpakai: ''
                    },
                    success: function(res) {
                        if (res.status && res.status === 'success') {
                            var row = $("button.tandai-terpakai-btn[data-idmaterial='" + idmaterial + "']").closest('tr');
                            row.children('td').eq(6).text('');
                            row.children('td').eq(7).text('');
                            row.children('td').eq(13).html("<span class='badge bg-success'>Sudah</span>");
                            var btn = row.find('.tandai-terpakai-btn');
                            btn.removeClass('btn-success').addClass('btn-secondary').text('Terpakai').prop('disabled', true);
                            Swal.fire('Berhasil', 'Material telah ditandai terpakai.', 'success');
                        } else {
                            Swal.fire('Error', res.message || 'Gagal memperbarui status.', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', 'Terjadi kesalahan: ' + error, 'error');
                    }
                });
            }
        });
    }
});

$('#simpanTandaiTerpakai').on('click', function() {
    // Ambil data
    var idmaterial = $('#tandaiIdMaterial').val();
    var kode_material_terpakai = $('#tandaiKodeMaterialTerpakai').val();
    var sn_terpakai = $('#tandaiSnTerpakai').val();
    if (!idmaterial) {
        Swal.fire('Error', 'ID material tidak ditemukan.', 'error');
        return;
    }

    $.ajax({
        url: 'Material/tandai_terpakai',
        type: 'POST',
        dataType: 'json',
        data: {
            idmaterial: idmaterial,
            kode_material_terpakai: kode_material_terpakai,
            sn_terpakai: sn_terpakai
        },
        success: function(res) {
            if (res.status && res.status === 'success') {
                // Update row in table
                var row = $("button.tandai-terpakai-btn[data-idmaterial='" + idmaterial + "']").closest('tr');
                // SN Terpakai (td index 6)
                row.children('td').eq(6).text(sn_terpakai);
                // Kode Material Terpakai (td index 7)
                row.children('td').eq(7).text(kode_material_terpakai);
                // Status Terpakai badge (td index 13)
                row.children('td').eq(13).html("<span class='badge bg-success'>Sudah</span>");
                // Disable button
                var btn = row.find('.tandai-terpakai-btn');
                btn.removeClass('btn-success').addClass('btn-secondary').text('Terpakai').prop('disabled', true);

                $('#tandaiTerpakaiModal').modal('hide');
                Swal.fire('Berhasil', 'Material telah ditandai terpakai.', 'success');
            } else {
                Swal.fire('Error', res.message || 'Gagal menyimpan', 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'Terjadi kesalahan: ' + error, 'error');
        }
    });
});
const button = document.getElementById('toast');

function resetForm() {
    document.getElementById('idmaterial').value = '';
    document.getElementById('incident').value = '';
    document.getElementById('tanggal').value = '<?php echo date('Y-m-d'); ?>';
    document.getElementById('kategori').value = '';
    document.getElementById('kode_material').value = '';
    document.getElementById('sn').value = '';
    document.getElementById('sn_terpakai').value = '';
    document.getElementById('kode_material_terpakai').value = '';
    document.getElementById('merk').value = '';
    document.getElementById('idtim').value = '';
    document.getElementById('satuan').value = '';
    document.getElementById('qty').value = '';
    document.getElementById('status_reservasi').value = '';
    document.getElementById('status_terpakai').value = '';
    document.getElementById('status_pengiriman').value = '';
    document.getElementById('ket').value = '';
    document.getElementById('displayKodeMaterial').textContent = '-';
    document.getElementById('displayDeskripsiMaterial').textContent = '-';
    document.getElementById('displayKodeMaterialTerpakai').textContent = '-';
    document.getElementById('displayDeskripsiMaterialTerpakai').textContent = '-';
}

function saveMaterial() {
    const formData = {
        incident: $('#incident').val(),
        tanggal: $('#tanggal').val(),
        kategori: $('#kategori').val(),
        kode_material: $('#kode_material').val(),
        sn: $('#sn').val(),
        sn_terpakai: $('#sn_terpakai').val(),
        kode_material_terpakai: $('#kode_material_terpakai').val(),
        merk: $('#merk').val(),
        idtim: $('#idtim').val(),
        satuan: $('#satuan').val(),
        qty: $('#qty').val(),
        status_reservasi: $('#status_reservasi').val(),
        status_terpakai: $('#status_terpakai').val(),
        status_pengiriman: $('#status_pengiriman').val(),
        ket: $('#ket').val()
    };

    if (!formData.kode_material || !formData.sn || !formData.merk || !formData.kategori || !formData.idtim || !formData.status_reservasi || !formData.status_pengiriman || !formData.tanggal || !formData.satuan || !formData.qty) {
        button.setAttribute('data-toast-text', 'Semua field yang wajib harus diisi!');
        button.click();
        return;
    }

    $.ajax({
        url: 'Material/insertData',
        type: 'POST',
        data: formData,
        success: function(response) {
            if(response=='success'){
                button.setAttribute('data-toast-text', 'Material berhasil ditambahkan!');
                button.click();
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }else{
                button.setAttribute('data-toast-text', response);
                button.click();
            }
        },
        error: function(xhr, status, error) {
            button.setAttribute('data-toast-text', error);
            button.click();
        }
    });
}

function editSaveMaterial() {
    const formData = {
        idmaterial: $('#editIdmaterial').val(),
        incident: $('#editIncident').val(),
        tanggal: $('#editTanggal').val(),
        kategori: $('#editKategori').val(),
        kode_material: $('#editKodeMaterial').val(),
        sn: $('#editSn').val(),
        sn_terpakai: $('#editSnTerpakai').val(),
        kode_material_terpakai: $('#editKodeMaterialTerpakai').val(),
        merk: $('#editMerk').val(),
        idtim: $('#editIdtim').val(),
        satuan: $('#editSatuan').val(),
        qty: $('#editQty').val(),
        status_reservasi: $('#editStatusReservasi').val(),
        status_terpakai: $('#editStatusTerpakai').val(),
        status_pengiriman: $('#editStatusPengiriman').val(),
        ket: $('#editKet').val()
    };

    if (!formData.kode_material || !formData.sn || !formData.merk || !formData.kategori || !formData.idtim || !formData.status_reservasi || !formData.status_pengiriman || !formData.tanggal || !formData.satuan || !formData.qty) {
        button.setAttribute('data-toast-text', 'Semua field yang wajib harus diisi!');
        button.click();
        return;
    }

    $.ajax({
        url: 'Material/editData',
        type: 'POST',
        data: formData,
        success: function(response) {
            if(response=='success'){
                button.setAttribute('data-toast-text', 'Material berhasil diperbarui!');
                button.click();
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }else{
                button.setAttribute('data-toast-text', response);
                button.click();
            }
        },
        error: function(xhr, status, error) {
            button.setAttribute('data-toast-text', error);
            button.click();
        }
    });
}

function applyFilters() {
    const startDate = document.getElementById('filterStartDate').value;
    const endDate = document.getElementById('filterEndDate').value;
    const statusReservasi = document.getElementById('filterReservasi').value;
    const statusTerpakai = document.getElementById('filterTerpakai').value;
    const statusPengiriman = document.getElementById('filterPengiriman').value;

    let url = 'Material?';
    if (startDate) url += 'start_date=' + startDate + '&';
    if (endDate) url += 'end_date=' + endDate + '&';
    if (statusReservasi) url += 'status_reservasi=' + statusReservasi + '&';
    if (statusTerpakai) url += 'status_terpakai=' + statusTerpakai + '&';
    if (statusPengiriman) url += 'status_pengiriman=' + statusPengiriman;

    window.location.href = url;
}

function resetFilters() {
    document.getElementById('filterStartDate').value = '<?php echo date('Y-m-d'); ?>';
    document.getElementById('filterEndDate').value = '<?php echo date('Y-m-d'); ?>';
    document.getElementById('filterReservasi').value = '';
    document.getElementById('filterTerpakai').value = '';
    document.getElementById('filterPengiriman').value = '';

    window.location.href = 'Material';
}

$(document).ready(function () {
    const modalElement = document.getElementById('editMaterialModal');
    const modal = new bootstrap.Modal(modalElement);

    $(document).on('click', '.edit-item-btn', function(e) {
        e.preventDefault();
        const data = this.dataset;
        document.getElementById('editIdmaterial').value = data.idmaterial;
        document.getElementById('editIncident').value = data.incident;
        document.getElementById('editTanggal').value = data.tanggal;
        document.getElementById('editKategori').value = data.kategori;
        document.getElementById('editKodeMaterial').value = data.kode_material;
        document.getElementById('editSn').value = data.sn;
        document.getElementById('editSnTerpakai').value = data.sn_terpakai;
        document.getElementById('editKodeMaterialTerpakai').value = data.kode_material_terpakai;
        document.getElementById('editMerk').value = data.merk;
        document.getElementById('editIdtim').value = data.idtim;
        document.getElementById('editSatuan').value = data.satuan;
        document.getElementById('editQty').value = data.qty;
        document.getElementById('editStatusReservasi').value = data.status_reservasi;
        document.getElementById('editStatusTerpakai').value = data.status_terpakai;
        document.getElementById('editStatusPengiriman').value = data.status_pengiriman;
        document.getElementById('editKet').value = data.ket;

        // Hide SN Terpakai and Kode Material Terpakai fields if kategori is FOC
        if (data.kategori === 'FOC') {
            $('#editSnTerpakai').closest('.col-xxl-6').hide();
            $('#editKodeMaterialTerpakai').closest('.col-xxl-6').hide();
            $('#editDisplayKodeMaterialTerpakai').closest('.col-xxl-6').hide();
            $('#editDisplayDeskripsiMaterialTerpakai').closest('.col-xxl-6').hide();
        } else {
            $('#editSnTerpakai').closest('.col-xxl-6').show();
            $('#editKodeMaterialTerpakai').closest('.col-xxl-6').show();
            $('#editDisplayKodeMaterialTerpakai').closest('.col-xxl-6').show();
            $('#editDisplayDeskripsiMaterialTerpakai').closest('.col-xxl-6').show();
        }

        // Fetch and display kode_material details
        const kodeMaterial = data.kode_material;
        if (kodeMaterial) {
            $.ajax({
                url: 'Material/getKodeMaterialDetail?kode=' + kodeMaterial,
                type: 'GET',
                success: function(response) {
                    const detailData = JSON.parse(response);
                    if (detailData && detailData.kode_material) {
                        $('#editDisplayKodeMaterial').text(detailData.kode_material);
                        $('#editDisplayDeskripsiMaterial').text(detailData.deskripsi_material ? detailData.deskripsi_material : '-');
                    } else {
                        $('#editDisplayKodeMaterial').text('-');
                        $('#editDisplayDeskripsiMaterial').text('-');
                    }
                },
                error: function() {
                    $('#editDisplayKodeMaterial').text('-');
                    $('#editDisplayDeskripsiMaterial').text('-');
                }
            });
        }

        // Fetch and display kode_material_terpakai details
        const kodeMaterialTerpakai = data.kode_material_terpakai;
        if (kodeMaterialTerpakai) {
            $.ajax({
                url: 'Material/getKodeMaterialDetail?kode=' + kodeMaterialTerpakai,
                type: 'GET',
                success: function(response) {
                    const detailData = JSON.parse(response);
                    if (detailData && detailData.kode_material) {
                        $('#editDisplayKodeMaterialTerpakai').text(detailData.kode_material);
                        $('#editDisplayDeskripsiMaterialTerpakai').text(detailData.deskripsi_material ? detailData.deskripsi_material : '-');
                    } else {
                        $('#editDisplayKodeMaterialTerpakai').text('-');
                        $('#editDisplayDeskripsiMaterialTerpakai').text('-');
                    }
                },
                error: function() {
                    $('#editDisplayKodeMaterialTerpakai').text('-');
                    $('#editDisplayDeskripsiMaterialTerpakai').text('-');
                }
            });
        }

        modal.show();
    });

    const deleteButtons = document.querySelectorAll('.remove-item-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const idMaterial = this.getAttribute('data-id');
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                customClass: {
                    confirmButton: "btn btn-primary w-xs me-2 mt-2",
                    cancelButton: "btn btn-danger w-xs mt-2"
                },
                confirmButtonText: "Ya, hapus!",
                buttonsStyling: false,
                showCloseButton: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: 'Material/deleteRow?id='+idMaterial,
                        type: 'GET',
                        success: function(response) {
                            if (response == 'success') {
                                Swal.fire({
                                    title: "Terhapus!",
                                    text: "Data material berhasil dihapus.",
                                    icon: "success",
                                    customClass: {
                                        confirmButton: "btn btn-primary w-xs mt-2"
                                    },
                                    buttonsStyling: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: response,
                                    icon: "error",
                                    customClass: {
                                        confirmButton: "btn btn-primary w-xs mt-2"
                                    },
                                    buttonsStyling: false
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                title: "Error!",
                                text: "Terjadi kesalahan saat menghapus data.",
                                icon: "error",
                                customClass: {
                                    confirmButton: "btn btn-primary w-xs mt-2"
                                },
                                buttonsStyling: false
                            });
                        }
                    });
                }
            });
        });
    });

    // Event listener for kode_material change in Add Material modal
    $('#kode_material').on('change keyup', function() {
        const kodeMaterial = $(this).val();
        if (kodeMaterial) {
            $.ajax({
                url: 'Material/getKodeMaterialDetail?kode=' + kodeMaterial,
                type: 'GET',
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data && data.kode_material) {
                        $('#displayKodeMaterial').text(data.kode_material);
                        $('#displayDeskripsiMaterial').text(data.deskripsi_material ? data.deskripsi_material : '-');
                    } else {
                        $('#displayKodeMaterial').text('-');
                        $('#displayDeskripsiMaterial').text('-');
                    }
                },
                error: function() {
                    $('#displayKodeMaterial').text('-');
                    $('#displayDeskripsiMaterial').text('-');
                }
            });
        } else {
            $('#displayKodeMaterial').text('-');
            $('#displayDeskripsiMaterial').text('-');
        }
    });

    // Event listener for kode_material change in Edit Material modal
    $('#editKodeMaterial').on('change keyup', function() {
        const kodeMaterial = $(this).val();
        if (kodeMaterial) {
            $.ajax({
                url: 'Material/getKodeMaterialDetail?kode=' + kodeMaterial,
                type: 'GET',
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data && data.kode_material) {
                        $('#editDisplayKodeMaterial').text(data.kode_material);
                        $('#editDisplayDeskripsiMaterial').text(data.deskripsi_material ? data.deskripsi_material : '-');
                    } else {
                        $('#editDisplayKodeMaterial').text('-');
                        $('#editDisplayDeskripsiMaterial').text('-');
                    }
                },
                error: function() {
                    $('#editDisplayKodeMaterial').text('-');
                    $('#editDisplayDeskripsiMaterial').text('-');
                }
            });
        } else {
            $('#editDisplayKodeMaterial').text('-');
            $('#editDisplayDeskripsiMaterial').text('-');
        }
    });

    // Event listener for kode_material_terpakai change in Add Material modal
    $('#kode_material_terpakai').on('change keyup', function() {
        const kodeMaterial = $(this).val();
        if (kodeMaterial) {
            $.ajax({
                url: 'Material/getKodeMaterialDetail?kode=' + kodeMaterial,
                type: 'GET',
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data && data.kode_material) {
                        $('#displayKodeMaterialTerpakai').text(data.kode_material);
                        $('#displayDeskripsiMaterialTerpakai').text(data.deskripsi_material ? data.deskripsi_material : '-');
                    } else {
                        $('#displayKodeMaterialTerpakai').text('-');
                        $('#displayDeskripsiMaterialTerpakai').text('-');
                    }
                },
                error: function() {
                    $('#displayKodeMaterialTerpakai').text('-');
                    $('#displayDeskripsiMaterialTerpakai').text('-');
                }
            });
        } else {
            $('#displayKodeMaterialTerpakai').text('-');
            $('#displayDeskripsiMaterialTerpakai').text('-');
        }
    });

    // Event listener for kode_material_terpakai change in Edit Material modal
    $('#editKodeMaterialTerpakai').on('change keyup', function() {
        const kodeMaterial = $(this).val();
        if (kodeMaterial) {
            $.ajax({
                url: 'Material/getKodeMaterialDetail?kode=' + kodeMaterial,
                type: 'GET',
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data && data.kode_material) {
                        $('#editDisplayKodeMaterialTerpakai').text(data.kode_material);
                        $('#editDisplayDeskripsiMaterialTerpakai').text(data.deskripsi_material ? data.deskripsi_material : '-');
                    } else {
                        $('#editDisplayKodeMaterialTerpakai').text('-');
                        $('#editDisplayDeskripsiMaterialTerpakai').text('-');
                    }
                },
                error: function() {
                    $('#editDisplayKodeMaterialTerpakai').text('-');
                    $('#editDisplayDeskripsiMaterialTerpakai').text('-');
                }
            });
        } else {
            $('#editDisplayKodeMaterialTerpakai').text('-');
            $('#editDisplayDeskripsiMaterialTerpakai').text('-');
        }
    });

    // Toggle SN/Kode Terpakai fields based on kategori selection in edit modal
    $('#editKategori').on('change', function() {
        var val = $(this).val();
        if (val === 'FOC') {
            $('#editSnTerpakai').closest('.col-xxl-6').hide();
            $('#editKodeMaterialTerpakai').closest('.col-xxl-6').hide();
            $('#editDisplayKodeMaterialTerpakai').closest('.col-xxl-6').hide();
            $('#editDisplayDeskripsiMaterialTerpakai').closest('.col-xxl-6').hide();
        } else {
            $('#editSnTerpakai').closest('.col-xxl-6').show();
            $('#editKodeMaterialTerpakai').closest('.col-xxl-6').show();
            $('#editDisplayKodeMaterialTerpakai').closest('.col-xxl-6').show();
            $('#editDisplayDeskripsiMaterialTerpakai').closest('.col-xxl-6').show();
        }
    });

    new DataTable('#example2', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
        responsive: true,
        order: [],
    });
});
</script>

</body>

<!-- Mirrored from Srisyaha.com/velzon/html/default/tables-datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:19:48 GMT -->
</html>
