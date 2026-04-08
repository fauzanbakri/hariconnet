<?php
//$url = "https://docs.google.com/spreadsheets/d/1wcbEoLbagheJz8rZof2yzW-XIesqJOTh/export?format=csv";
$url = "https://docs.google.com/spreadsheets/d/1yIdP6i17Q8WHF2LvVMhQgBqOnDwQrtIZnbcWpmr36Xw/export?format=csv&edit?gid=766942970#gid=766942970";

$odp = $_GET['odp'] ?? '';

$csvData = file_get_contents($url);
$rows = array_map("str_getcsv", explode("\n", $csvData));
$header = array_shift($rows);

$data = [];
foreach ($rows as $row) {
    if (count($row) !== count($header)) continue;
    $rowAssoc = array_combine($header, $row);
    if (isset($rowAssoc['ID ODP']) && trim($rowAssoc['ID ODP']) === trim($odp)) {
        $data = $rowAssoc;
        break;
    }
}

// Tentukan jumlah port dari kapasitas splitter
$jumlahPort = 8;
if (!empty($data['KAPASITAS SPLITTER']) && strpos($data['KAPASITAS SPLITTER'], '1:16') !== false) {
    $jumlahPort = 16;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail ODP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    body {
      display: flex;
      flex-direction: column;
      background: #f5f7fa;
      font-family: system-ui, sans-serif;
    }
    main {
      flex: 1;
    }
    .card-header {
      background-color: #1e2a38;
      color: white;
    }
    .port {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .85rem;
      font-weight: bold;
      color: white;
      margin: 10px auto;
      cursor: pointer;
    }
    .port-red { background-color: #e74c3c; }
    .port-green { background-color: #27ae60; }

    .status-badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: .85rem;
      color: white;
      margin: 0 6px;
      display: inline-block;
    }
    .status-terisi { background-color: #e74c3c; }
    .status-kosong { background-color: #27ae60; }

    footer {
      background: #1e2a38;
      color: white;
      padding: 1rem 0;
      text-align: center;
    }
  </style>
</head>
<body>

<main class="container my-4">
  <div class="card shadow-sm">
    <div class="card-header">
      <h5 class="mb-0 text-center">Detail ODP: <?= htmlspecialchars($odp) ?></h5>
    </div>
    <div class="card-body">

    <?php if (!empty($data)): ?>

      <div class="mb-3">
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>ID ODP:</strong> <?= htmlspecialchars($data['ID ODP']) ?></li>
          <li class="list-group-item"><strong>Area:</strong> <?= htmlspecialchars($data['AREA']) ?></li>
          <li class="list-group-item"><strong>Koordinat:</strong> <?= htmlspecialchars($data['KOORDINAT']) ?></li>
          <li class="list-group-item"><strong>Hostname OLT:</strong> <?= htmlspecialchars($data['HOSTNAME OLT']) ?></li>
          <li class="list-group-item"><strong>Cluster:</strong> <?= htmlspecialchars($data['CLUSTER']) ?></li>
          <li class="list-group-item"><strong>Kapasitas Splitter:</strong> <?= htmlspecialchars($data['KAPASITAS SPLITTER']) ?></li>
        </ul>
      </div>

      <div class="text-center mb-3">
        <span class="status-badge status-terisi"><i class="fas fa-circle"></i> Terisi</span>
        <span class="status-badge status-kosong"><i class="fas fa-circle"></i> Kosong</span>
      </div>

      <div class="row text-center">
        <?php for ($i = 1; $i <= $jumlahPort; $i++): 
          $port = "PORT $i";
          $value = strtoupper(trim($data[$port] ?? ''));
          $isFilled = $value && $value !== 'IDLE';
          $color = $isFilled ? 'port-red' : 'port-green';
        ?>
        <div class="col-3">
          <div class="port <?= $color ?>" data-bs-toggle="modal" data-bs-target="#portModal" data-port="<?= $i ?>" data-value="<?= htmlspecialchars($value) ?>">
            Port <?= $i ?>
          </div>
        </div>
        <?php endfor; ?>
      </div>

    <?php else: ?>
      <div class="alert alert-warning text-center mt-4">
        Data untuk ODP <strong><?= htmlspecialchars($odp) ?></strong> tidak ditemukan.
      </div>
    <?php endif; ?>

      <div class="text-center mt-4">
        <a href="index.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
      </div>

    </div>
  </div>
</main>

<!-- MODAL -->
<div class="modal fade" id="portModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Port</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <div id="portSpinner">
          <div class="spinner-border" role="status"></div>
          <p class="mt-2">Memuat...</p>
        </div>
        <p id="portDetail" class="d-none"></p>
      </div>
    </div>
  </div>
</div>

<footer>
  <small>&copy; <?= date('Y') ?> fauzanbakri</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const portModal = document.getElementById('portModal');
  portModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const port = button.getAttribute('data-port');
    const value = button.getAttribute('data-value') || '';
    const detail = portModal.querySelector('#portDetail');
    const spinner = portModal.querySelector('#portSpinner');

    spinner.classList.remove('d-none');
    detail.classList.add('d-none');

    setTimeout(() => {
      spinner.classList.add('d-none');
      detail.classList.remove('d-none');
      const status = value.trim() && value !== 'IDLE' ? "Terisi" : "Kosong";
      detail.innerHTML = `<strong>Port ${port}</strong>: ${status}<br>Info: ${value || '-'}`;
    }, 500);
  });
</script>
</body>
</html>
