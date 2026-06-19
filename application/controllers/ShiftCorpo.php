<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShiftCorpo extends CI_Controller {

    public function index()
    {
        $this->showReport();
    }

    public function showReport()
    {
        date_default_timezone_set('Asia/Makassar');
        $title['title'] = "Report Shift Corpo";

        $query = $this->db->query(
            "SELECT tc.id, tc.incident, tc.keterangan, tc.tanggal, tc.status, tc.ketUpdate, tc.timestamps,
                    t.nama AS tim_nama, b.provinsi, b.kabupaten
             FROM tiketCorporate tc
             LEFT JOIN tim t ON tc.idTim = t.idTim
             LEFT JOIN basecamp b ON t.idBc = b.idBc
             ORDER BY tc.tanggal ASC"
        )->result();

        $openRows = [];
        $resolveRows = [];
        foreach ($query as $row) {
            $status = strtoupper(trim((string)($row->status ?? '')));
            if ($status === 'CLOSED' || $status === 'SOLVED (ICRM OPEN)') {
                $resolveRows[] = $row;
            } else {
                $openRows[] = $row;
            }
        }

        $provinceCounts = [];
        foreach ($openRows as $row) {
            $prov = trim((string)($row->provinsi ?? ''));
            if ($prov !== '') {
                if (!isset($provinceCounts[$prov])) {
                    $provinceCounts[$prov] = 0;
                }
                $provinceCounts[$prov]++;
            }
        }

        $provinceList = [];
        foreach ($provinceCounts as $prov => $count) {
            $provinceList[] = [
                'province' => $prov,
                'count' => $count
            ];
        }
        usort($provinceList, function($a, $b) {
            return strcmp($a['province'], $b['province']);
        });

        $reportText = "UPDATE INC Tanggal " . date('d F Y H:i') . " WITA\n";
        $reportText .= "INC KORPORATE :(" . count($openRows) . ")\n";
        $reportText .= "Resolve : (" . count($resolveRows) . ")\n";

        $wilayahParts = [];
        foreach ($provinceList as $item) {
            $wilayahParts[] = $item['province'] . ' :(' . $item['count'] . ')';
        }
        $reportText .= "Wilayah : " . (count($wilayahParts) ? implode(', ', $wilayahParts) : '-') . "\n";
        $reportText .= "MN : \n";
        $reportText .= "HD : \n\n";
        $reportText .= "--INC CORPORATE--\n\n";

        foreach ($provinceList as $item) {
            $reportText .= "==== " . $item['province'] . " ====\n\n";
            $grouped = [];
            foreach ($openRows as $row) {
                if (trim((string)($row->provinsi ?? '')) === $item['province']) {
                    $grouped[] = $row;
                }
            }

            foreach ($grouped as $idx => $row) {
                $keterangan = trim((string)($row->keterangan ?? ''));
                $tanggal = trim((string)($row->tanggal ?? ''));
                $incident = trim((string)($row->incident ?? ''));
                $timNama = trim((string)($row->tim_nama ?? ''));
                $update = trim((string)($row->ketUpdate ?? ''));

                $reportText .= ($idx + 1) . ". " . ($keterangan !== '' ? $keterangan : '-') . "\n";
                $reportText .= "open : " . ($tanggal !== '' ? date('d M Y', strtotime($tanggal)) : '-') . "\n";
                $reportText .= "INC ID : " . ($incident !== '' ? $incident : '-') . "\n";
                $reportText .= "Durasi : " . $this->formatDuration($tanggal) . "\n";
                $reportText .= "Problem : \n";
                $reportText .= "Progres : " . ($update !== '' ? $update : '-') . "\n";
                $reportText .= "Tim : " . ($timNama !== '' ? $timNama : '-') . "\n\n";
            }
        }

        $data = [
            'reportText' => $reportText,
            'openRows' => $openRows,
            'resolveRows' => $resolveRows,
            'provinceList' => $provinceList,
        ];

        session_start();
        if (
            $_SESSION['role'] == 'Superadmin' ||
            $_SESSION['role'] == 'NOC Ritel' ||
            $_SESSION['role'] == 'NOC Corpo' ||
            $_SESSION['role'] == 'Team Leader' ||
            $_SESSION['role'] == 'Helpdesk'
        ) {
            $this->load->view('navbar', $title);
            $this->load->view('report_shift_corporate', $data);
        } else {
            header('location: ./DashboardNoc');
        }
    }

    private function formatDuration($date)
    {
        if ($date === '') {
            return '-';
        }

        try {
            $start = new DateTime($date);
            $now = new DateTime();
            $diff = $start->diff($now);

            $days = (int)$diff->d;
            $hours = (int)$diff->h;
            $minutes = (int)$diff->i;

            return ($days > 0 ? $days . ' Hari ' : '') . $hours . ' Jam ' . $minutes . ' Menit';
        } catch (Exception $e) {
            return '-';
        }
    }
}