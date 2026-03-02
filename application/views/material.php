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
                        <h4 class="mb-sm-0">Input Material</h4>
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
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="card-title mb-0">Daftar Material</h5>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#materialModal" onclick="resetForm()">
                                        <i class="mdi mdi-plus"></i> Tambah Material
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Section -->
                        <div class="card-body border-bottom">
                            <div class="row g-3">
                                <!-- Filter Date Range -->
                                <div class="col-md-3">
                                    <label for="filterStartDate" class="form-label">Tanggal Mulai</label>
                                    <input type="date" id="filterStartDate" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="filterEndDate" class="form-label">Tanggal Akhir</label>
                                    <input type="date" id="filterEndDate" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div>

                                <!-- Filter Status Reservasi -->
                                <div class="col-md-2">
                                    <label for="filterReservasi" class="form-label">Status Reservasi</label>
                                    <select id="filterReservasi" class="form-select form-select-sm">
                                        <option value="">Semua</option>
                                        <option value="Sudah">Sudah</option>
                                        <option value="Belum">Belum</option>
                                    </select>
                                </div>

                                <!-- Filter Status Terpakai -->
                                <div class="col-md-2">
                                    <label for="filterTerpakai" class="form-label">Status Terpakai</label>
                                    <select id="filterTerpakai" class="form-select form-select-sm">
                                        <option value="">Semua</option>
                                        <?php foreach ($status_terpakai_list as $status) { ?>
                                            <option value="<?php echo $status->status_terpakai; ?>"><?php echo $status->status_terpakai; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- Filter Status Pengiriman -->
                                <div class="col-md-2">
                                    <label for="filterPengiriman" class="form-label">Status Pengiriman</label>
                                    <select id="filterPengiriman" class="form-select form-select-sm">
                                        <option value="">Semua</option>
                                        <option value="Dalam Pengiriman">Dalam Pengiriman</option>
                                        <option value="On Loc">On Loc</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Filter Button -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-info" onclick="applyFilters()">
                                        <i class="mdi mdi-filter"></i> Filter
                                    </button>
                                    <button class="btn btn-sm btn-secondary" onclick="resetFilters()">
                                        <i class="mdi mdi-refresh"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Table Section -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="materialTable">
                                    <thead>
                                        <tr class="table-light">
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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if(!empty($materials)) {
                                            foreach ($materials as $material) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($material->tanggal)); ?></td>
                                            <td><span class="badge bg-info"><?php echo $material->kategori; ?></span></td>
                                            <td><?php echo $material->kode_material; ?></td>
                                            <td><?php echo $material->sn; ?></td>
                                            <td><?php echo $material->sn_terpakai; ?></td>
                                            <td><?php echo $material->merk; ?></td>
                                            <td><?php echo $material->nama_tim; ?></td>
                                            <td><?php echo $material->satuan; ?></td>
                                            <td><?php echo $material->qty; ?></td>
                                            <td>
                                                <span class="badge <?php echo $material->status_reservasi == 'Sudah' ? 'bg-success' : 'bg-warning'; ?>">
                                                    <?php echo $material->status_reservasi; ?>
                                                </span>
                                            </td>
                                            <td><?php echo $material->status_terpakai; ?></td>
                                            <td>
                                                <span class="badge <?php echo $material->status_pengiriman == 'Dalam Pengiriman' ? 'bg-primary' : 'bg-secondary'; ?>">
                                                    <?php echo $material->status_pengiriman; ?>
                                                </span>
                                            </td>
                                            <td><?php echo substr($material->ket, 0, 30) . (strlen($material->ket) > 30 ? '...' : ''); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" onclick="editMaterial(<?php echo $material->idmaterial; ?>)">
                                                    <i class="mdi mdi-pencil"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deleteMaterial(<?php echo $material->idmaterial; ?>)">
                                                    <i class="mdi mdi-delete"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        } else {
                                        ?>
                                        <tr>
                                            <td colspan="15" class="text-center text-muted py-3">Tidak ada data material</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form Material -->
<div class="modal fade" id="materialModal" tabindex="-1" aria-labelledby="materialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="materialModalLabel">Tambah Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="materialForm">
                    <input type="hidden" id="idmaterial" name="idmaterial">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="FOC">FOC</option>
                                <option value="FOT">FOT</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kode_material" class="form-label">Kode Material <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kode_material" name="kode_material" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sn" class="form-label">SN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="sn" name="sn" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sn_terpakai" class="form-label">SN Terpakai</label>
                            <input type="text" class="form-control" id="sn_terpakai" name="sn_terpakai">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="merk" class="form-label">Merk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="merk" name="merk" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="idtim" class="form-label">Tim <span class="text-danger">*</span></label>
                            <select class="form-select" id="idtim" name="idtim" required>
                                <option value="">Pilih Tim</option>
                                <?php foreach ($tims as $tim) { ?>
                                <option value="<?php echo $tim->idtim; ?>"><?php echo $tim->nama_tim; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="satuan" name="satuan" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="qty" class="form-label">QTY <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="qty" name="qty" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status_reservasi" class="form-label">Status Reservasi <span class="text-danger">*</span></label>
                            <select class="form-select" id="status_reservasi" name="status_reservasi" required>
                                <option value="">Pilih Status</option>
                                <option value="Sudah">Sudah</option>
                                <option value="Belum">Belum</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status_terpakai" class="form-label">Status Terpakai</label>
                            <input type="text" class="form-control" id="status_terpakai" name="status_terpakai">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status_pengiriman" class="form-label">Status Pengiriman <span class="text-danger">*</span></label>
                            <select class="form-select" id="status_pengiriman" name="status_pengiriman" required>
                                <option value="">Pilih Status</option>
                                <option value="Dalam Pengiriman">Dalam Pengiriman</option>
                                <option value="On Loc">On Loc</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="ket" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="ket" name="ket" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveMaterial()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast for notifications -->
<button hidden type="button" data-toast data-toast-text="" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" id="toast" class="btn btn-light w-xs"></button>

<script>
    const baseUrl = '<?php echo base_url(); ?>';

    // Reset form for add new
    function resetForm() {
        document.getElementById('materialForm').reset();
        document.getElementById('idmaterial').value = '';
        document.getElementById('tanggal').value = '<?php echo date('Y-m-d'); ?>';
        document.getElementById('materialModalLabel').textContent = 'Tambah Material';
    }

    // Save material (add or update)
    function saveMaterial() {
        const idmaterial = document.getElementById('idmaterial').value;
        const url = idmaterial ? baseUrl + 'Material/update' : baseUrl + 'Material/add';

        const formData = new FormData(document.getElementById('materialForm'));

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showToast(data.message, 'success');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showToast(data.message, 'error');
            }
        })
        .catch(error => {
            showToast('Terjadi kesalahan: ' + error, 'error');
        });
    }

    // Edit material
    function editMaterial(id) {
        fetch(baseUrl + 'Material/get_material/' + id)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('idmaterial').value = data.idmaterial;
                    document.getElementById('tanggal').value = data.tanggal;
                    document.getElementById('kategori').value = data.kategori;
                    document.getElementById('kode_material').value = data.kode_material;
                    document.getElementById('sn').value = data.sn;
                    document.getElementById('sn_terpakai').value = data.sn_terpakai;
                    document.getElementById('merk').value = data.merk;
                    document.getElementById('idtim').value = data.idtim;
                    document.getElementById('satuan').value = data.satuan;
                    document.getElementById('qty').value = data.qty;
                    document.getElementById('status_reservasi').value = data.status_reservasi;
                    document.getElementById('status_terpakai').value = data.status_terpakai;
                    document.getElementById('status_pengiriman').value = data.status_pengiriman;
                    document.getElementById('ket').value = data.ket;

                    document.getElementById('materialModalLabel').textContent = 'Edit Material';
                    const modal = new bootstrap.Modal(document.getElementById('materialModal'));
                    modal.show();
                }
            })
            .catch(error => {
                showToast('Gagal memuat data: ' + error, 'error');
            });
    }

    // Delete material
    function deleteMaterial(id) {
        if (confirm('Apakah Anda yakin ingin menghapus material ini?')) {
            fetch(baseUrl + 'Material/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showToast(data.message, 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showToast(data.message, 'error');
                }
            })
            .catch(error => {
                showToast('Terjadi kesalahan: ' + error, 'error');
            });
        }
    }

    // Apply filters
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

    // Reset filters
    function resetFilters() {
        document.getElementById('filterStartDate').value = '<?php echo date('Y-m-d'); ?>';
        document.getElementById('filterEndDate').value = '<?php echo date('Y-m-d'); ?>';
        document.getElementById('filterReservasi').value = '';
        document.getElementById('filterTerpakai').value = '';
        document.getElementById('filterPengiriman').value = '';

        window.location.href = baseUrl + 'Material';
    }

    // Show toast notification
    function showToast(message, type) {
        const toastEl = document.getElementById('toast');
        toastEl.setAttribute('data-toast-text', message);

        // Gunakan toast library yang sudah ada di project
        // Atau gunakan cara sederhana dengan alert
        if (type === 'success') {
            alert('✓ ' + message);
        } else {
            alert('✗ ' + message);
        }
    }
</script>
