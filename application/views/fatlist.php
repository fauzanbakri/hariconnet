<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">List FAT - ODP Checker</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tools</a></li>
                                <li class="breadcrumb-item active">List FAT</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (isset($error) && $error): ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <i class="ri-error-warning-line"></i> <?php echo htmlspecialchars($error); ?>
                    </div>
                </div>
            </div>
            <?php else: ?>

            <div class="row">
                <!-- Search Form -->
                <div class="col-lg-9 col-md-9 col-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="ri-search-line"></i> Cari Data ODP</h5>
                        </div>
                        <div class="card-body">
                            <form method="get" action="">
                                <div class="input-group">
                                    <input type="text" name="id" class="form-control" placeholder="Masukkan ID ODP..." value="<?php echo isset($idCari) ? htmlspecialchars($idCari) : ''; ?>">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-search-line"></i> Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Hasil Pencarian -->
                    <?php if ($idCari): ?>
                    <div class="card mt-3">
                        <div class="card-body" style="max-height: calc(100vh - 300px); overflow-y: auto;">
                            <?php if (!empty($filteredRows)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <?php foreach ($columnsToShow as $col): ?>
                                            <th><?php echo htmlspecialchars($col); ?></th>
                                            <?php endforeach; ?>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($filteredRows as $row): ?>
                                            <?php
                                            if (count($row) != count($header)) continue;
                                            $rowAssoc = array_combine($header, $row);
                                            ?>
                                            <tr>
                                                <?php foreach ($columnsToShow as $col): ?>
                                                <td><?php echo htmlspecialchars($rowAssoc[$col] ?? ''); ?></td>
                                                <?php endforeach; ?>
                                                <td>
                                                    <a href="../fat/detail.php?odp=<?php echo urlencode($rowAssoc['ID ODP'] ?? ''); ?>" class="btn btn-warning btn-sm" target="_blank">
                                                        <i class="ri-eye-line"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php else: ?>
                            <div class="alert alert-warning text-center" role="alert">
                                <i class="ri-alert-fill"></i> Data dengan ID <strong><?php echo htmlspecialchars($idCari); ?></strong> tidak ditemukan.
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar - Prefix List -->
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="ri-tags-line"></i> Kode ODP
                                <span class="badge bg-primary float-end"><?php echo isset($totalData) ? $totalData : 0; ?> data</span>
                            </h5>
                        </div>
                        <div class="card-body" style="max-height: calc(100vh - 300px); overflow-y: auto; display: flex; flex-direction: column; gap: 0.5rem;">
                            <?php if (!empty($namaAwalList)): ?>
                                <?php foreach ($namaAwalList as $nama => $data): ?>
                                <a href="?id=<?php echo urlencode($nama); ?>" class="btn btn-light text-start d-flex flex-column" style="padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem; text-decoration: none; color: #333;">
                                    <strong><?php echo htmlspecialchars($nama); ?></strong>
                                    <small class="text-muted"><?php echo htmlspecialchars($data['area']); ?></small>
                                    <small class="text-muted"><?php echo $data['count']; ?> data</small>
                                </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                            <p class="text-muted text-center">Tidak ada data</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php endif; ?>
        </div>
    </div>
</div>
