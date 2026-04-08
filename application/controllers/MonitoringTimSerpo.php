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

        $status = strtoupper(preg_replace('/\s+/', ' ', trim((string)$statusText)));
        $closedStatuses = ['CLOSED', 'SOLVED (ICRM OPEN)'];

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

        if (!in_array($status, $closedStatuses, true)) {
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
                if ((int)$item['total_pending'] > 0 || (int)$item['total_onprogress'] > 0) {
                    $result[] = $item;
                }
            }

            usort($result, function($a, $b){
                $feederCorpA = (int)$a['feeder_pending'] + (int)$a['corporate_pending'];
                $feederCorpB = (int)$b['feeder_pending'] + (int)$b['corporate_pending'];
                if ($feederCorpA === $feederCorpB) {
                    $pendingA = (int)$a['total_pending'];
                    $pendingB = (int)$b['total_pending'];
                    if ($pendingA === $pendingB) {
                        $onProgressA = (int)$a['total_onprogress'];
                        $onProgressB = (int)$b['total_onprogress'];
                        if ($onProgressA === $onProgressB) {
                            return strcmp($a['tim'], $b['tim']);
                        }
                        return $onProgressB - $onProgressA;
                    }
                    return $pendingB - $pendingA;
                }
                return $feederCorpB - $feederCorpA;
            });

            // Add incident detail for each team
            foreach ($result as &$team) {
                $teamName = $team['tim'];
                $onProgressNo = null;
                $oldestPendingNo = null;

                // Get latest on progress incident
                if ($this->db->table_exists('feeder')) {
                    $feederOnProgress = $this->db->query(
                        "SELECT id FROM feeder WHERE TRIM(tim) = ? AND UPPER(TRIM(status)) = 'ON PROGRESS' ORDER BY tglCreate DESC LIMIT 1",
                        [$teamName]
                    )->row();
                    if ($feederOnProgress) {
                        $onProgressNo = $feederOnProgress->id;
                    }
                }

                if (!$onProgressNo && $this->db->table_exists('tiket')) {
                    $retailOnProgress = $this->db->query(
                        "SELECT idTiket FROM tiket WHERE TRIM(tim) = ? AND UPPER(TRIM(status)) = 'ON PROGRESS' ORDER BY tglCreate DESC LIMIT 1",
                        [$teamName]
                    )->row();
                    if ($retailOnProgress) {
                        $onProgressNo = $retailOnProgress->idTiket;
                    }
                }

                if (!$onProgressNo && $this->db->table_exists('tiketCorporate')) {
                    $corpOnProgress = $this->db->query(
                        "SELECT idTiketCorporate FROM tiketCorporate tc LEFT JOIN tim t ON tc.idTim = t.idTim WHERE TRIM(t.nama) = ? AND UPPER(TRIM(tc.status)) = 'ON PROGRESS' ORDER BY tc.tglCreate DESC LIMIT 1",
                        [$teamName]
                    )->row();
                    if ($corpOnProgress) {
                        $onProgressNo = $corpOnProgress->idTiketCorporate;
                    }
                }

                // Get oldest pending incident
                if ($this->db->table_exists('feeder')) {
                    $feederPending = $this->db->query(
                        "SELECT id FROM feeder WHERE TRIM(tim) = ? AND UPPER(TRIM(status)) NOT IN ('CLOSED', 'SOLVED (ICRM OPEN)') AND UPPER(TRIM(status)) != 'ON PROGRESS' ORDER BY tglCreate ASC LIMIT 1",
                        [$teamName]
                    )->row();
                    if ($feederPending) {
                        $oldestPendingNo = $feederPending->id;
                    }
                }

                if (!$oldestPendingNo && $this->db->table_exists('tiket')) {
                    $retailPending = $this->db->query(
                        "SELECT idTiket FROM tiket WHERE TRIM(tim) = ? AND UPPER(TRIM(status)) NOT IN ('CLOSED', 'SOLVED (ICRM OPEN)') AND UPPER(TRIM(status)) != 'ON PROGRESS' ORDER BY tglCreate ASC LIMIT 1",
                        [$teamName]
                    )->row();
                    if ($retailPending) {
                        $oldestPendingNo = $retailPending->idTiket;
                    }
                }

                if (!$oldestPendingNo && $this->db->table_exists('tiketCorporate')) {
                    $corpPending = $this->db->query(
                        "SELECT idTiketCorporate FROM tiketCorporate tc LEFT JOIN tim t ON tc.idTim = t.idTim WHERE TRIM(t.nama) = ? AND UPPER(TRIM(tc.status)) NOT IN ('CLOSED', 'SOLVED (ICRM OPEN)') AND UPPER(TRIM(tc.status)) != 'ON PROGRESS' ORDER BY tc.tglCreate ASC LIMIT 1",
                        [$teamName]
                    )->row();
                    if ($corpPending) {
                        $oldestPendingNo = $corpPending->idTiketCorporate;
                    }
                }

                $team['latest_onprogress_no'] = $onProgressNo;
                $team['oldest_pending_no'] = $oldestPendingNo;
            }

            $data['incident_teams'] = $result;
            $data['total_teams'] = count($result);

            $this->load->view('navbar', $title);
            $this->load->view('monitoring_tim_serpo', $data);
        } else {
            header('location: ./DashboardNoc');
        }
    }
}
