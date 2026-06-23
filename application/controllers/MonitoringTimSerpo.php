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

    private function buildStats()
    {
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

        // Fetch a sample "on progress" description and incident for feeder and corporate per team
        foreach ($result as &$item) {
            $teamName = $this->db->escape_str(trim((string)$item['tim']));
            $item['feeder_onprogress_desc'] = '';
            $item['feeder_onprogress_incident'] = '';
            $item['corporate_onprogress_desc'] = '';
            $item['corporate_onprogress_incident'] = '';

            if ((int)$item['feeder_onprogress'] > 0 && $this->db->table_exists('feeder')) {
                $row = $this->db->query("SELECT idInsiden, tipe, kode, idOlt, gangguan FROM feeder WHERE TRIM(tim) = '".$teamName."' AND UPPER(TRIM(status)) = 'ON PROGRESS' LIMIT 1")->row();
                if ($row) {
                    $idInsiden = trim((string)($row->idInsiden ?? ''));
                    $tipe = trim((string)($row->tipe ?? ''));
                    $kode = trim((string)($row->kode ?? ''));
                    $idOlt = trim((string)($row->idOlt ?? ''));
                    $gangguan = trim((string)($row->gangguan ?? ''));

                    if ($tipe === 'FTTH BACKBONE') {
                        $v = 'OLT TO UPLINK';
                    } elseif ($tipe === 'FTTH FEEDER') {
                        $v = 'FDT TO OLT';
                    } else {
                        $v = 'FAT TO FDT';
                    }

                    $descParts = array_filter([
                        'INSIDEN NO. ' . $idInsiden,
                        $tipe . '_' . $kode,
                        '[PROAKTIF NOC SBU]_' . $v,
                        $idOlt,
                        $gangguan,
                    ], function($s){ return strlen(trim((string)$s)) > 0; });

                    $item['feeder_onprogress_desc'] = trim(implode(' ', $descParts));
                    $item['feeder_onprogress_incident'] = $idInsiden;
                }
            }

            if ((int)$item['corporate_onprogress'] > 0 && $this->db->table_exists('tiketCorporate')) {
                $row = $this->db->query("SELECT tc.incident, tc.keterangan FROM tiketCorporate tc LEFT JOIN tim t ON tc.idTim = t.idTim WHERE TRIM(t.nama) = '".$teamName."' AND UPPER(TRIM(tc.status)) = 'ON PROGRESS' LIMIT 1")->row();
                if ($row) {
                    if (isset($row->keterangan)) $item['corporate_onprogress_desc'] = trim((string)$row->keterangan);
                    $item['corporate_onprogress_incident'] = trim((string)($row->incident ?? ''));
                }
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

        return $result;
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
            $_SESSION['role']=='NOC Corpo' ||
            $_SESSION['role']=='Helpdesk' ||
            $_SESSION['role']=='Guest 1'
        ) {
            $data['incident_teams'] = $this->buildStats();
            $data['total_teams'] = count($data['incident_teams']);

            $this->load->view('navbar', $title);
            $this->load->view('monitoring_tim_serpo', $data);
        } else {
            header('location: ./DashboardNoc');
        }
    }

    public function stats()
    {
        session_start();
        if (
            $_SESSION['role']=='Superadmin' ||
            $_SESSION['role']=='NOC Ritel' ||
            $_SESSION['role']=='Team Leader' ||
            $_SESSION['role']=='Pemeliharaan Ritel' ||
            $_SESSION['role']=='Guest 1'
        ) {
            // Disable all caching for real-time updates
            header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
            header('Pragma: no-cache');
            header('Expires: 0');
            header('Content-Type: application/json');
            echo json_encode([
                'incident_teams' => $this->buildStats(),
                'timestamp' => date('c'),
            ]);
            return;
        }

        header('HTTP/1.1 403 Forbidden');
        header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
        echo json_encode(['error' => 'Forbidden']);
    }
}
