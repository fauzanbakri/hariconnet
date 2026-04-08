<?php
header('Content-Type: application/json');
$url = "https://docs.google.com/spreadsheets/d/1wcbEoLbagheJz8rZof2yzW-XIesqJOTh/export?format=csv";

$keyword = strtolower($_GET['term'] ?? '');
if (!$keyword) {
    echo json_encode([]);
    exit;
}

$csvData = file_get_contents($url);
$rows = array_map("str_getcsv", explode("\n", $csvData));
array_shift($rows);

$suggestions = [];
foreach ($rows as $row) {
    if (!isset($row[1])) continue;
    if (stripos($row[1], $keyword) !== false) {
        $suggestions[$row[1]] = true;
    }
}
echo json_encode(array_keys($suggestions));
