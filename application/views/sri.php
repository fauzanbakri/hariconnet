<?php
session_start();

$json_input = $_SESSION['json_input'] ?? '';
$error_msg = '';
$data_rows = [];
$headers = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_input = $_POST['json_input'] ?? '';
    $_SESSION['json_input'] = $json_input;

    $decoded = json_decode($json_input, true);

    if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
        $error_msg = "JSON tidak valid: " . json_last_error_msg();
    } else {
        if (isset($decoded['data']['data']) && is_array($decoded['data']['data'])) {
            $data_rows = $decoded['data']['data'];
            if (count($data_rows) > 0) {
                $headers = array_keys($data_rows[0]);
            }
        } else {
            $error_msg = "Format JSON tidak sesuai, tidak ditemukan properti data->data berupa array";
        }
    }
} else {
    if ($json_input) {
        $decoded = json_decode($json_input, true);
        if (isset($decoded['data']['data']) && is_array($decoded['data']['data'])) {
            $data_rows = $decoded['data']['data'];
            if (count($data_rows) > 0) {
                $headers = array_keys($data_rows[0]);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>JSON ke Tabel dan Export CSV</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        textarea { width: 100%; height: 250px; font-family: monospace; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #444; padding: 6px 10px; }
        th { background-color: #f0f0f0; }
        .error { color: red; }
        button, input[type="submit"] {
            margin-top: 10px;
            padding: 10px 15px;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<h2>Paste JSON dengan struktur data -> data -> data</h2>

<form method="post">
    <textarea name="json_input" placeholder="Paste JSON di sini..."><?= htmlspecialchars($json_input) ?></textarea><br>
    <input type="submit" value="Convert ke Tabel" />
</form>

<?php if ($error_msg): ?>
    <p class="error"><?= htmlspecialchars($error_msg) ?></p>
<?php endif; ?>

<?php if (!empty($data_rows)): ?>
    <h3>Hasil Tabel Data (<?= count($data_rows) ?> baris)</h3>
    <table id="data-table">
        <thead>
            <tr>
                <?php foreach ($headers as $header): ?>
                    <th><?= htmlspecialchars($header) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_rows as $row): ?>
                <tr>
                    <?php foreach ($headers as $header): ?>
                        <td><?= isset($row[$header]) ? htmlspecialchars($row[$header]) : '' ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Tombol export CSV -->
    <form method="post" action="Sri/esport" style="margin-top:20px;">
        <button type="submit" name="export_csv">Download CSV</button>
    </form>
<?php endif; ?>

</body>
</html>
