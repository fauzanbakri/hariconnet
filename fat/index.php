<?php   
$url = "https://docs.google.com/spreadsheets/d/1yIdP6i17Q8WHF2LvVMhQgBqOnDwQrtIZnbcWpmr36Xw/export?format=csv&edit?gid=766942970#gid=766942970";
$idCari = $_GET['id'] ?? '';
$filteredRows = [];
$header = [];
$columnsToShow = ['STATUS', 'ID ODP', 'AREA', 'KOORDINAT', 'HOSTNAME OLT', 'CLUSTER', 'KAPASITAS SPLITTER'];
$csvData = @file_get_contents($url);
if (!$csvData) {
    die("Gagal mengambil data dari sumber.");
}
$rows = array_map("str_getcsv", explode("\n", $csvData));
$header = array_shift($rows);
$totalData = 0;
$namaAwalList = [];
foreach ($rows as $row) {
    if (!isset($row[1]) || !isset($row[2])) continue;
    if (count($row) != count($header)) continue;
    $idOdp = trim($row[1]);
    $area  = trim($row[2]);
    if (!$idOdp) continue;
    $prefix = preg_replace('/[\d\s\-]+$/', '', $idOdp);
    if ($prefix) {
        $prefix = strtoupper($prefix);
        $namaAwalList[$prefix]['area'] = $area;
        $namaAwalList[$prefix]['count'] = ($namaAwalList[$prefix]['count'] ?? 0) + 1;
        $totalData++;
    }
}
ksort($namaAwalList);
if ($idCari) {
    $filteredRows = array_filter($rows, function($row) use ($idCari) {
        return isset($row[1]) && stripos(trim($row[1]), trim($idCari)) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Cari Data ODP</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    background: white;
    overflow-x: hidden;
}
body {
    display: flex;
    flex-direction: column;
}
main {
    flex: 1;
    overflow: auto;
}
.navbar {
    background-color: #203a43;
}
.card-header {
    background-color: #203a43 !important;
}
.card {
    border-radius: 1rem;
}
.btn-primary {
    background-color: #203a43;
    border: none;
}
footer {
    background: #203a43;
    color: white;
    padding: 1rem;
    text-align: center;
    margin-top: auto;
}
.sidebar-sticky {
    position: sticky;
    top: 20px;
    max-height: calc(100vh - 120px);
    display: flex;
    flex-direction: column;
}
.scroll-container {
    flex: 1;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: .5rem;
    padding: .5rem 0;
}
.badge-odp {
    display: block;
    background: #f8f9fa;
    color: #333;
    padding: .5rem;
    border-radius: .5rem;
    text-align: center;
    box-shadow: 0 0 3px rgba(0,0,0,0.1);
    transition: background 0.2s ease;
    text-decoration: none;
}
.badge-odp:hover {
    background: #e9ecef;
}
.badge-odp strong {
    display: block;
}
.badge-odp small {
    color: #555;
}
.small-text {
    font-size: 0.75rem;
    color: #fff;
}
.ui-autocomplete {
    max-height: 200px;
    overflow-y: auto;
    overflow-x: hidden;
    z-index: 1050;
}
.result-scroll {
    max-height: calc(100vh - 250px);
    overflow-y: auto;
    overflow-x: auto;
    padding-bottom: 1rem;
    scrollbar-gutter: stable both-edges;
}
.result-scroll .table {
    min-width: 1000px;
}
.result-scroll::-webkit-scrollbar {
    height: 16px;
    width: 16px;
}
.result-scroll::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}
.result-scroll::-webkit-scrollbar-track {
    background: #eee;
}
.result-scroll {
    scrollbar-width: auto;
    scrollbar-color: #888 #eee;
}
@media (max-width: 992px) {
  .sidebar-sticky {
    position: static;
    max-height: none;
  }
}
@media (max-width: 576px) {
  .result-scroll {
    max-height: none;
  }
  .card-body {
    padding: 1rem;
  }
  h4, h5 {
    font-size: 1.1rem;
  }
  .badge-odp {
    font-size: 0.85rem;
    padding: .4rem;
  }
  .row > div[class^="col-"] {
    padding-left: 0;
    padding-right: 0;
  }
}
</style>
</head>
<body class="h-100 d-flex flex-column">
<nav class="navbar navbar-expand-lg shadow">
  <div class="container">
    <a class="navbar-brand text-white" href="#"><i class="fas fa-bolt"></i> ODP CHECKER</a>
  </div>
</nav>
<main class="container-fluid my-4 px-4">
<div class="row">
    <!-- Form pencarian -->
    <div class="col-lg-9 col-md-9 col-12 mb-3">
      <div class="card shadow-lg animate__animated animate__fadeIn h-100">
        <div class="card-header text-white">
          <h4 class="mb-0"><i class="fas fa-search"></i> Cari Data ODP</h4>
        </div>
        <div class="card-body">
          <form method="get" action="">
            <div class="input-group">
              <input type="text" name="id" id="odp-input" class="form-control" placeholder="Masukkan ID ODP..." value="<?= htmlspecialchars($idCari) ?>">
              <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
            </div>
          </form>

<?php if ($idCari): ?>
<hr>
<?php if (!empty($filteredRows)): ?>
<div class="result-scroll mt-3 animate__animated animate__fadeIn">
  <table class="table table-hover table-bordered table-striped mb-0">
    <thead class="table-dark">
      <tr>
        <?php foreach ($columnsToShow as $col) echo "<th>".htmlspecialchars($col)."</th>"; ?>
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
            <td><?= htmlspecialchars($rowAssoc[$col] ?? '') ?></td>
          <?php endforeach; ?>
          <td><a href="detail.php?odp=<?= urlencode($rowAssoc['ID ODP']) ?>" class="btn btn-warning btn-sm animate__animated animate__pulse"><i class="fas fa-eye"></i> Detail</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php else: ?>
  <div class="alert alert-warning text-center mt-4 animate__animated animate__shakeX">
    <i class="fas fa-exclamation-circle"></i> Data dengan ID <strong><?= htmlspecialchars($idCari) ?></strong> tidak ditemukan.
  </div>
<?php endif; ?>
<?php endif; ?>
        </div>
      </div>
    </div>
    <!-- Sidebar -->
    <div class="col-lg-3 col-md-3 col-12">
      <div class="card shadow animate__animated animate__fadeIn sidebar-sticky">
        <div class="card-header text-white">
          <h5 class="mb-0"><i class="fas fa-tags"></i> Kode ODP <small class="small-text"><?= $totalData ?> data</small></h5>
        </div>
        <div class="card-body scroll-container">
        <?php foreach ($namaAwalList as $nama => $data): ?>
          <a href="?id=<?= urlencode($nama) ?>" class="badge-odp animate__animated animate__fadeIn">
            <strong><?= htmlspecialchars($nama) ?></strong>
            <small><?= htmlspecialchars($data['area']) ?></small>
            <small><?= $data['count'] ?> data</small>
          </a>
        <?php endforeach; ?>
        </div>
      </div>
    </div>
</div>
</main>
<footer>
  <small>&copy; <?= date('Y') ?> fauzanbakri</small>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(function(){
    $("#odp-input").autocomplete({
        source: "suggest.php",
        minLength: 1
    });
});
</script>
</body>
</html>
