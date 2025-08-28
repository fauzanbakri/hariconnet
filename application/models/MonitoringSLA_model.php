<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringSLA_model extends CI_Model
{
    /**
     * Upsert batch menggunakan ON DUPLICATE KEY UPDATE
     * $uniqueKey: kolom unik/PK (contoh: 'idtiket')
     * return: jumlah baris yang diproses (affected_rows bersifat indikatif)
     */
    public function upsert_batch(array $rows, $uniqueKey = 'idtiket')
    {
        if (empty($rows)) return 0;

        // Ambil daftar kolom dari elemen pertama
        $columns = array_keys($rows[0]);

        // Siapkan bagian VALUES
        $values = [];
        $binds  = [];
        foreach ($rows as $r) {
            $place = [];
            foreach ($columns as $c) {
                $place[] = '?';
                $binds[] = array_key_exists($c, $r) ? $r[$c] : null;
            }
            $values[] = '('.implode(',', $place).')';
        }

        // Bagian ON DUPLICATE KEY UPDATE (semua kolom kecuali uniqueKey)
        $updates = [];
        foreach ($columns as $c) {
            if ($c === $uniqueKey) continue;
            $updates[] = "`$c`=VALUES(`$c`)";
        }

        $sql = "INSERT INTO `listTicketing` (`".implode('`,`', $columns)."`) VALUES "
             . implode(',', $values)
             . " ON DUPLICATE KEY UPDATE ".implode(',', $updates);

        $this->db->query($sql, $binds);
        return $this->db->affected_rows();
    }
}
