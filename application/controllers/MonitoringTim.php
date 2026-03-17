<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringTim extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        session_start();
        $data['title'] = 'Monitoring Tim';
        // summary: count distinct idInsiden per tim
        // join tiket -> tim (by name) -> basecamp to get province
        $sql = "SELECT IFNULL(t.tnama, IFNULL(tiket.tim,'UNKNOWN')) AS tim, COUNT(DISTINCT tiket.idInsiden) AS total_incidents, COALESCE(b.provinsi,'') AS provinsi, COALESCE(b.kabupaten,'') AS kabupaten
            FROM tiket
            LEFT JOIN (SELECT nama AS tnama, idBc FROM tim) t ON tiket.tim = t.tnama
            LEFT JOIN basecamp b ON t.idBc = b.idBc
            GROUP BY t.tnama, tiket.tim, b.provinsi, b.kabupaten
            ORDER BY total_incidents DESC";
        $data['summary'] = $this->db->query($sql)->result();

        $this->load->view('navbar', $data);
        $this->load->view('monitoring_tim', $data);
    }

    // AJAX: return incidents for a given team
    public function listIncidents()
    {
        $team = $this->input->get_post('team');
        if ($team === null) { echo json_encode([]); return; }

        $sql = "SELECT idInsiden, idTiket, tanggal, status, prioritas, keluhan, nama
                FROM tiket
                WHERE tim = ?
                ORDER BY TIMESTAMPDIFF(SECOND, tanggal, NOW()) DESC";
        $rows = $this->db->query($sql, [$team])->result();
        // compute duration in human readable and seconds (UTC+8)
        $result = [];
        $tz = new DateTimeZone('Asia/Jakarta');
        foreach ($rows as $r) {
            try {
                $tsObj = new DateTime($r->tanggal, $tz);
                $nowObj = new DateTime('now', $tz);
                $diff = $nowObj->getTimestamp() - $tsObj->getTimestamp();
                $days = floor($diff / 86400);
                $hours = floor(($diff % 86400) / 3600);
                $mins = floor(($diff % 3600) / 60);
                $human = sprintf('%02d Hari %02d Jam %02d Menit', $days, $hours, $mins);
            } catch (Exception $e) {
                $diff = 0;
                $human = '00 Hari 00 Jam 00 Menit';
            }
            $result[] = [
                'idInsiden' => $r->idInsiden,
                'idTiket' => $r->idTiket,
                'tanggal' => $r->tanggal,
                'duration_seconds' => $diff,
                'duration' => $human,
                'status' => $r->status,
                'prioritas' => $r->prioritas,
                'keluhan' => $r->keluhan,
                'nama' => $r->nama
            ];
        }
        echo json_encode($result);
    }

    // AJAX: update status for a ticket (idTiket)
    public function updateStatus()
    {
        $id = $this->input->post('idTiket');
        $action = $this->input->post('action'); // 'antrian' or 'onprogress'
        if (!$id || !$action) { echo json_encode(['success'=>false,'message'=>'Missing params']); return; }

        // fetch current status
        $row = $this->db->get_where('tiket', ['idTiket' => $id])->row();
        if (!$row) { echo json_encode(['success'=>false,'message'=>'Not found']); return; }
        $cur = $row->status;

        // disallowed when SOLVED (ICRM OPEN), CLOSED, EARLY
        $blocked = ['SOLVED (ICRM OPEN)','CLOSED','EARLY'];
        if (in_array(strtoupper($cur), array_map('strtoupper',$blocked))) {
            echo json_encode(['success'=>false,'message'=>'Status tidak dapat diubah']); return;
        }

        if ($action === 'onprogress') {
            // allowed only if current in OPEN, NEW, STOPCLOCK
            $allowed = ['OPEN','NEW','STOPCLOCK'];
            if (!in_array(strtoupper($cur), array_map('strtoupper',$allowed))) {
                echo json_encode(['success'=>false,'message'=>'Transisi tidak diizinkan']); return;
            }
            $new = 'On Progress';
        } elseif ($action === 'antrian') {
            // allowed only if current is On Progress
            if (strtoupper($cur) !== strtoupper('On Progress')) {
                echo json_encode(['success'=>false,'message'=>'Transisi tidak diizinkan']); return;
            }
            $new = 'OPEN';
        } else {
            echo json_encode(['success'=>false,'message'=>'Unknown action']); return;
        }

        $ok = $this->db->where('idTiket',$id)->update('tiket', ['status' => $new]);
        echo json_encode(['success' => (bool)$ok]);
    }
}
