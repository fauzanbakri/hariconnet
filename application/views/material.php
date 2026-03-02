
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

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Daftar Material</h5><br>
                                    <!-- Base Buttons -->
                                     <!-- Grids in modals -->
                                    <!-- Grids in modals -->
                                     <div class="row">
                                        <div class="col-md-3">
                                            <?php
                                                if(
                                                    $_SESSION['role']=='Superadmin' ||
                                                    $_SESSION['role']=='Team Leader'
                                                    ){
                                                        echo '
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#materialModal" onclick="resetForm()">
                                                            Tambah Material
                                                            </button>';
                                                    }
                                            ?>
                                            <button hidden type="button" data-toast data-toast-text="" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" id="toast" class="btn btn-light w-xs"></button>
                                        </div>
                                     </div>
                                     <div class="row mt-3">
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
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-info" onclick="applyFilters()">
                                            Filter
                                        </button>
                                        <button class="btn btn-sm btn-secondary" onclick="resetFilters()">
                                            Reset
                                        </button>
                                    </div>
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
                                                            <div>
                                                                <label class="form-label">Tanggal</label>
                                                                <input type="date" class="form-control" name="tanggal" id="tanggal" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Kategori</label>
                                                                <select class="form-select" name="kategori" id="kategori" aria-label="Default select example">
                                                                    <option value="">Pilih Kategori</option>
                                                                    <option value="FOC">FOC</option>
                                                                    <option value="FOT">FOT</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Kode Material</label>
                                                                <input type="text" class="form-control" name="kode_material" id="kode_material" autocomplete="off" placeholder="Kode Material">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">SN</label>
                                                                <input type="text" class="form-control" name="sn" id="sn" autocomplete="off" placeholder="SN">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">SN Terpakai</label>
                                                                <input type="text" class="form-control" name="sn_terpakai" id="sn_terpakai" autocomplete="off" placeholder="SN Terpakai">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Merk</label>
                                                                <input type="text" class="form-control" name="merk" id="merk" autocomplete="off" placeholder="Merk">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Tim</label>
                                                                <select class="form-select" name="idtim" id="idtim" aria-label="Default select example">
                                                                    <option value="">Pilih Tim</option>
                                                                    <?php foreach ($tims as $tim) { ?>
                                                                    <option value="<?php echo $tim->idTim; ?>"><?php echo $tim->nama; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3">
                                                            <div>
                                                                <label class="form-label">Satuan</label>
                                                                <input type="text" class="form-control" name="satuan" id="satuan" autocomplete="off" placeholder="Satuan">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3">
                                                            <div>
                                                                <label class="form-label">QTY</label>
                                                                <input type="number" class="form-control" name="qty" id="qty" autocomplete="off" placeholder="QTY">
                                                            </div>
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
                                                            <div>
                                                                <label class="form-label">Status Terpakai</label>
                                                                <input type="text" class="form-control" name="status_terpakai" id="status_terpakai" autocomplete="off" placeholder="Status Terpakai">
                                                            </div>
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
                                                            <div>
                                                                <label class="form-label">Keterangan</label>
                                                                <textarea type="text" class="form-control" name="ket" id="ket" autocomplete="off" placeholder="Keterangan"></textarea>
                                                            </div>
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
                                                            <div>
                                                                <label class="form-label">Tanggal</label>
                                                                <input type="date" class="form-control" name="editTanggal" id="editTanggal" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Kategori</label>
                                                                <select class="form-select" name="editKategori" id="editKategori" aria-label="Default select example">
                                                                    <option value="">Pilih Kategori</option>
                                                                    <option value="FOC">FOC</option>
                                                                    <option value="FOT">FOT</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Kode Material</label>
                                                                <input type="text" class="form-control" name="editKodeMaterial" id="editKodeMaterial" autocomplete="off" placeholder="Kode Material">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">SN</label>
                                                                <input type="text" class="form-control" name="editSn" id="editSn" autocomplete="off" placeholder="SN">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">SN Terpakai</label>
                                                                <input type="text" class="form-control" name="editSnTerpakai" id="editSnTerpakai" autocomplete="off" placeholder="SN Terpakai">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Merk</label>
                                                                <input type="text" class="form-control" name="editMerk" id="editMerk" autocomplete="off" placeholder="Merk">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Tim</label>
                                                                <select class="form-select" name="editIdtim" id="editIdtim" aria-label="Default select example">
                                                                    <option value="">Pilih Tim</option>
                                                                    <?php foreach ($tims as $tim) { ?>
                                                                    <option value="<?php echo $tim->idTim; ?>"><?php echo $tim->nama; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3">
                                                            <div>
                                                                <label class="form-label">Satuan</label>
                                                                <input type="text" class="form-control" name="editSatuan" id="editSatuan" autocomplete="off" placeholder="Satuan">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3">
                                                            <div>
                                                                <label class="form-label">QTY</label>
                                                                <input type="number" class="form-control" name="editQty" id="editQty" autocomplete="off" placeholder="QTY">
                                                            </div>
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
                                                            <div>
                                                                <label class="form-label">Status Terpakai</label>
                                                                <input type="text" class="form-control" name="editStatusTerpakai" id="editStatusTerpakai" autocomplete="off" placeholder="Status Terpakai">
                                                            </div>
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
                                                            <div>
                                                                <label class="form-label">Keterangan</label>
                                                                <textarea type="text" class="form-control" name="editKet" id="editKet" autocomplete="off" placeholder="Keterangan"></textarea>
                                                            </div>
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
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Kategori</th>
                                                <th>Kode Material</th>
                                                <th>SN</th>
                                                <th>SN Terpakai</th>
                                                <th>Merk</th>
                                                <th>Tim</th>
                                                <th>Satuan</th>
                                                <th>QTY</th>
                                                <th>Status Reservasi</th>
                                                <th>Status Terpakai</th>
                                                <th>Status Pengiriman</th>
                                                <th>Keterangan</th>
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
                                                        <td>".date('d-m-Y', strtotime($material->tanggal))."</td>
                                                        <td><span class='badge bg-info'>".$material->kategori."</span></td>
                                                        <td>".$material->kode_material."</td>
                                                        <td>".$material->sn."</td>
                                                        <td>".$material->sn_terpakai."</td>
                                                        <td>".$material->merk."</td>
                                                        <td>".$material->nama."</td>
                                                        <td>".$material->satuan."</td>
                                                        <td>".$material->qty."</td>
                                                        <td><span class='badge ".(($material->status_reservasi == 'Sudah') ? 'bg-success' : 'bg-warning')."'>".$material->status_reservasi."</span></td>
                                                        <td>".$material->status_terpakai."</td>
                                                        <td><span class='badge ".(($material->status_pengiriman == 'Dalam Pengiriman') ? 'bg-primary' : 'bg-secondary')."'>".$material->status_pengiriman."</span></td>
                                                        <td>".substr($material->ket, 0, 30).(strlen($material->ket) > 30 ? '...' : '')."</td>";
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
                                                                        <a href='#' class='dropdown-item edit-item-btn' data-idmaterial='".$material->idmaterial."' data-tanggal='".$material->tanggal."' data-kategori='".$material->kategori."' data-kode_material='".$material->kode_material."' data-sn='".$material->sn."' data-sn_terpakai='".$material->sn_terpakai."' data-merk='".$material->merk."' data-idtim='".$material->idtim."' data-satuan='".$material->satuan."' data-qty='".$material->qty."' data-status_reservasi='".$material->status_reservasi."' data-status_terpakai='".$material->status_terpakai."' data-status_pengiriman='".$material->status_pengiriman."' data-ket='".$material->ket."'>
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
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

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
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

<script>
const button = document.getElementById('toast');
const baseUrl = '<?php echo base_url(); ?>';

function resetForm() {
    document.getElementById('idmaterial').value = '';
    document.getElementById('tanggal').value = '<?php echo date('Y-m-d'); ?>';
    document.getElementById('kategori').value = '';
    document.getElementById('kode_material').value = '';
    document.getElementById('sn').value = '';
    document.getElementById('sn_terpakai').value = '';
    document.getElementById('merk').value = '';
    document.getElementById('idtim').value = '';
    document.getElementById('satuan').value = '';
    document.getElementById('qty').value = '';
    document.getElementById('status_reservasi').value = '';
    document.getElementById('status_terpakai').value = '';
    document.getElementById('status_pengiriman').value = '';
    document.getElementById('ket').value = '';
}

function saveMaterial() {
    const formData = {
        tanggal: $('#tanggal').val(),
        kategori: $('#kategori').val(),
        kode_material: $('#kode_material').val(),
        sn: $('#sn').val(),
        sn_terpakai: $('#sn_terpakai').val(),
        merk: $('#merk').val(),
        idtim: $('#idtim').val(),
        satuan: $('#satuan').val(),
        qty: $('#qty').val(),
        status_reservasi: $('#status_reservasi').val(),
        status_terpakai: $('#status_terpakai').val(),
        status_pengiriman: $('#status_pengiriman').val(),
        ket: $('#ket').val()
    };

    if (!formData.kode_material || !formData.sn || !formData.merk || !formData.kategori || !formData.idtim || !formData.status_reservasi || !formData.status_pengiriman) {
        button.setAttribute('data-toast-text', 'Semua field yang wajib harus diisi!');
        button.click();
        return;
    }

    $.ajax({
        url: baseUrl + 'Material/insertData',
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
        tanggal: $('#editTanggal').val(),
        kategori: $('#editKategori').val(),
        kode_material: $('#editKodeMaterial').val(),
        sn: $('#editSn').val(),
        sn_terpakai: $('#editSnTerpakai').val(),
        merk: $('#editMerk').val(),
        idtim: $('#editIdtim').val(),
        satuan: $('#editSatuan').val(),
        qty: $('#editQty').val(),
        status_reservasi: $('#editStatusReservasi').val(),
        status_terpakai: $('#editStatusTerpakai').val(),
        status_pengiriman: $('#editStatusPengiriman').val(),
        ket: $('#editKet').val()
    };

    if (!formData.kode_material || !formData.sn || !formData.merk || !formData.kategori || !formData.idtim || !formData.status_reservasi || !formData.status_pengiriman) {
        button.setAttribute('data-toast-text', 'Semua field yang wajib harus diisi!');
        button.click();
        return;
    }

    $.ajax({
        url: baseUrl + 'Material/editData',
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

    let url = baseUrl + 'Material?';
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

    window.location.href = baseUrl + 'Material';
}

$(document).ready(function () {
    document.addEventListener('DOMContentLoaded', function () {
        const modalElement = document.getElementById('editMaterialModal');
        const modal = new bootstrap.Modal(modalElement);
        document.querySelectorAll('.edit-item-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const data = this.dataset;
                document.getElementById('editIdmaterial').value = data.idmaterial;
                document.getElementById('editTanggal').value = data.tanggal;
                document.getElementById('editKategori').value = data.kategori;
                document.getElementById('editKodeMaterial').value = data.kode_material;
                document.getElementById('editSn').value = data.sn;
                document.getElementById('editSnTerpakai').value = data.sn_terpakai;
                document.getElementById('editMerk').value = data.merk;
                document.getElementById('editIdtim').value = data.idtim;
                document.getElementById('editSatuan').value = data.satuan;
                document.getElementById('editQty').value = data.qty;
                document.getElementById('editStatusReservasi').value = data.status_reservasi;
                document.getElementById('editStatusTerpakai').value = data.status_terpakai;
                document.getElementById('editStatusPengiriman').value = data.status_pengiriman;
                document.getElementById('editKet').value = data.ket;
                modal.show();
            });
        });
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
                        url: baseUrl + 'Material/deleteRow?id='+idMaterial,
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

    new DataTable('#example1', {
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
