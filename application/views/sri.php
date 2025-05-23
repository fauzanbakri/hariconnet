<?php
// Cek apakah form disubmit
$input_text = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_text = $_POST['input_code'] ?? '';
    // Bersihkan dari XSS
    $input_text = htmlspecialchars($input_text);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Convert Code to Table</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        textarea { width: 100%; height: 200px; font-family: monospace; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>

<h2>Tempel Kode JavaScript di bawah ini</h2>
<form method="post">
    <textarea name="input_code" placeholder="Tempel kode JavaScript di sini..."><?= $input_text ?></textarea>
    <br />
    <button type="submit">Convert ke Tabel</button>
</form>

<?php if ($input_text): ?>
    <h3>Hasil Convert ke Tabel</h3>
    <table>
        <thead>
            <tr><th>No</th><th>Baris Kode</th></tr>
        </thead>
        <tbody>
            <?php
            $lines = explode("\n", $input_text);
            foreach ($lines as $index => $line) {
                $line = trim($line);
                if ($line === '') continue;
                echo '<tr>';
                echo '<td>'.($index + 1).'</td>';
                echo '<td><pre style="margin:0;">' . $line . '</pre></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
