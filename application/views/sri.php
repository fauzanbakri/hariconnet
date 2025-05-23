<?php
// Inisialisasi variabel
$json_input = '';
$error_msg = '';
$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_input = $_POST['json_input'] ?? '';

    // Parsing JSON
    $data = json_decode($json_input, true);

    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        $error_msg = "JSON tidak valid: " . json_last_error_msg();
        $data = [];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>JSON to Table Converter</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        textarea { width: 100%; height: 200px; font-family: monospace; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; }
        th { background-color: #eee; text-align: left; }
        .error { color: red; }
    </style>
</head>
<body>

<h2>Paste JSON data di bawah ini:</h2>
<form method="post">
    <textarea name="json_input" placeholder="Paste JSON di sini..."><?= htmlspecialchars($json_input) ?></textarea>
    <br>
    <button type="submit">Convert ke Tabel</button>
</form>

<?php if ($error_msg): ?>
    <p class="error"><?= $error_msg ?></p>
<?php endif; ?>

<?php if ($data && is_array($data)): ?>
    <h3>Hasil Tabel</h3>
    <table>
        <thead>
            <tr>
                <?php
                // Ambil header tabel dari keys array (asumsi $data adalah associative array)
                foreach (array_keys($data) as $header) {
                    echo "<th>" . htmlspecialchars($header) . "</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                // Tampilkan nilai field per kolom
                foreach ($data as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                ?>
            </tr>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
