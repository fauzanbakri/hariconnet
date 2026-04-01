<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringTimSerpo extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function addCount(&$stats, $teamName, $source, $statusText, $count)
    {
        $team = trim((string)$teamName);
        if ($team === '') return;

        $status = strtoupper(trim((string)$statusText));
        $pendingStatuses = ['OPEN', 'NEW', 'ANTRIAN', 'STOPCLOCK'];

        if (!isset($stats[$team])) {
            $stats[$team] = [
                'tim' => $team,
                'feeder_pending' => 0,
                'retail_pending' => 0,
                'corporate_pending' => 0,
                'feeder_onprogress' => 0,
                'retail_onprogress' => 0,
                'corporate_onprogress' => 0,
                'total_pending' => 0,
                'total_onprogress' => 0,
            ];
        }

        if (in_array($status, $pendingStatuses, true)) {
            if ($source === 'feeder') $stats[$team]['feeder_pending'] += (int)$count;
            if ($source === 'retail') $stats[$team]['retail_pending'] += (int)$count;
            if ($source === 'corporate') $stats[$team]['corporate_pending'] += (int)$count;
            $stats[$team]['total_pending'] += (int)$count;
        }

        if ($status === 'ON PROGRESS') {
            if ($source === 'feeder') $stats[$team]['feeder_onprogress'] += (int)$count;
            if ($source === 'retail') $stats[$team]['retail_onprogress'] += (int)$count;
            if ($source === 'corporate') $stats[$team]['corporate_onprogress'] += (int)$count;
            $stats[$team]['total_onprogress'] += (int)$count;
        }
    }

    public function index()
    {
        session_start();
        $title['title'] = 'Monitoring Tim Serpo';

        if (
            $_SESSION['role']=='Superadmin' ||
            $_SESSION['role']=='NOC Ritel' ||
            $_SESSION['role']=='Team Leader' ||
            $_SESSION['role']=='Pemeliharaan Ritel' ||
            $_SESSION['role']=='Guest 1'
        ) {
            $stats = [];

            if ($this->db->table_exists('feeder')) {
                $feederRows = $this->db->query("SELECT TRIM(tim) AS tim, UPPER(TRIM(status)) AS status, COUNT(*) AS jumlah
                                               FROM feeder
                                               WHERE tim IS NOT NULL AND TRIM(tim) <> ''
                                               GROUP BY TRIM(tim), UPPER(TRIM(status))")->result();
                foreach ($feederRows as $r) {
                    $this->addCount($stats, $r->tim, 'feeder', $r->status, $r->jumlah);
                }
            }

            if ($this->db->table_exists('tiket')) {
                $retailRows = $this->db->query("SELECT TRIM(tim) AS tim, UPPER(TRIM(status)) AS status, COUNT(*) AS jumlah
                                               FROM tiket
                                               WHERE tim IS NOT NULL AND TRIM(tim) <> ''
                                               GROUP BY TRIM(tim), UPPER(TRIM(status))")->result();
                foreach ($retailRows as $r) {
                    $this->addCount($stats, $r->tim, 'retail', $r->status, $r->jumlah);
                }
            }

            if ($this->db->table_exists('tiketCorporate') && $this->db->table_exists('tim')) {
                $corpRows = $this->db->query("SELECT TRIM(t.nama) AS tim, UPPER(TRIM(tc.status)) AS status, COUNT(*) AS jumlah
                                             FROM tiketCorporate tc
                                             LEFT JOIN tim t ON tc.idTim = t.idTim
                                             WHERE t.nama IS NOT NULL AND TRIM(t.nama) <> ''
                                             GROUP BY TRIM(t.nama), UPPER(TRIM(tc.status))")->result();
                foreach ($corpRows as $r) {
                    $this->addCount($stats, $r->tim, 'corporate', $r->status, $r->jumlah);
                }
            }

            $result = [];
            foreach ($stats as $item) {
                if ((int)$item['total_pending'] > 0 && (int)$item['total_onprogress'] === 0) {
                    $result[] = $item;
                }
            }

            usort($result, function($a, $b){
                if ((int)$b['total_pending'] === (int)$a['total_pending']) {
                    return strcmp($a['tim'], $b['tim']);
                }
                return (int)$b['total_pending'] - (int)$a['total_pending'];
            });

            $data['rows'] = $result;
            $data['total_teams'] = count($result);

            $this->load->view('navbar', $title);
            $this->load->view('monitoring_tim_serpo', $data);
        } else {
            header('location: ./DashboardNoc');
        }
    }
}
