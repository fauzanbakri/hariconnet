<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardNoc extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$title['title']="Dashboard NOC";
		$q['total'] = $this->db->query("SELECT COUNT(idTiket) as total FROM tiket; ")->result();
		$q['close'] = $this->db->query("SELECT COUNT(idTiket) as close FROM tiket WHERE status='CLOSED'")->result();
		$q['olt'] = $this->db->query("SELECT COUNT(idOlt) as olt FROM olt")->result();
		$this->db->select('kabupaten, COUNT(*) as count');
        $this->db->from('tiket');
        $this->db->join('olt', 'olt.idOlt = tiket.idOlt', 'left');
        $this->db->group_by('kabupaten');
        $this->db->order_by('count', 'DESC');
        $query = $this->db->get();
        $q['data'] = $query->result_array();

		$this->db->select('tim, COUNT(*) as count');
        $this->db->from('tiket');
        $this->db->join('olt', 'olt.idOlt = tiket.idOlt', 'left');
        $this->db->group_by('tim');
        $this->db->order_by('count', 'DESC');
        $query = $this->db->get();
        $q['tim'] = $query->result_array();
		$q['total_tim'] = $this->db->query("SELECT COUNT(*) as total_tim FROM tim WHERE segmen='Retail'")->result();
		$q['sla'] = $this->db->query("SELECT COUNT(*) AS sla FROM tiket WHERE DATEDIFF(CURDATE(), STR_TO_DATE(tanggal, '%Y-%m-%d')) > 2;")->result();
		$q['month'] = $this->db->query("SELECT YEAR(tanggal) AS year, MONTH(tanggal) AS month, SUM(CASE WHEN table_name = 'tiket' THEN 1 ELSE 0 END) AS tiket_total, SUM(CASE WHEN table_name = 'tiketClose' THEN 1 ELSE 0 END) AS tiketClose_total, SUM(1) AS total_tiket FROM ( SELECT 'tiket' AS table_name, tanggal FROM tiket UNION ALL SELECT 'tiketClose' AS table_name, tanggal FROM tiketClose ) AS combined_tables GROUP BY YEAR(tanggal), MONTH(tanggal) ORDER BY year, month;")->result_array();
		$q['top'] = $this->db->query("
		SELECT prioritas, idInsiden, idTiket, tanggal, olt.idOlt, sid, nama, 
		alamat, telepon, sn, status, keluhan, keterangan, kabupaten, provinsi, 
		tim, createby, timestamp, 
		@urutan := IF( status IN ('closed', 'Solved (ICRM Open)') 
		OR 
		tim = 'NO TIM', 0, IF(@grup = tim, @urutan + 1, 1) ) AS urutan, 
		@grup := tim FROM tiket LEFT JOIN olt ON olt.idOlt = tiket.idOlt 
		CROSS JOIN (SELECT @urutan := 0, @grup := '') AS vars 
		WHERE tiket.status!='CLOSED' 
		ORDER BY tiket.tanggal ASC LIMIT 10;")->result();
		$q['topf'] = $this->db->query("SELECT * FROM feeder WHERE status!='CLOSED' ORDER BY downtime ASC LIMIT 10")->result();
		$query = $this->db->query("SELECT bulan, 
            SUM(more_than_1_day) AS more_than_1_day, 
            SUM(more_than_3_days) AS more_than_3_days,
            CASE 
                WHEN SUM(total_tickets_month) > 0 
                THEN (SUM(more_than_1_day) / SUM(total_tickets_month)) * 100 
                ELSE 0 
            END AS percent_more_than_1_day,
            CASE 
                WHEN SUM(total_tickets_month) > 0 
                THEN (SUM(more_than_3_days) / SUM(total_tickets_month)) * 100 
                ELSE 0 
            END AS percent_more_than_3_days
            FROM (
                SELECT DATE_FORMAT(tanggal, '%b') AS bulan,
                    YEAR(tanggal) AS tahun,
                    COUNT(CASE WHEN TIMESTAMPDIFF(DAY, tanggal, timestamp) < 1 THEN 1 END) AS more_than_1_day,
                    COUNT(CASE WHEN TIMESTAMPDIFF(DAY, tanggal, timestamp) > 3 THEN 1 END) AS more_than_3_days,
                    COALESCE(
                        (SELECT COUNT(*) FROM tiket WHERE YEAR(tiket.tanggal) = YEAR(t.tanggal) AND MONTH(tiket.tanggal) = MONTH(t.tanggal)), 0) + 
                    COALESCE(
                        (SELECT COUNT(*) FROM tiketClose WHERE YEAR(tiketClose.tanggal) = YEAR(t.tanggal) AND MONTH(tiketClose.tanggal) = MONTH(t.tanggal)), 0) 
                    AS total_tickets_month
                FROM (
                    SELECT idTiket, tanggal, timestamp FROM tiket WHERE status='CLOSED'
                    UNION ALL
                    SELECT idTiket, tanggal, timestamp FROM tiketClose WHERE status='CLOSED'
                ) AS t
                GROUP BY YEAR(tanggal), MONTH(tanggal)
            ) AS grouped_data
            GROUP BY bulan, tahun
            ORDER BY tahun, STR_TO_DATE(bulan, '%b');");

        $result = $query->result_array();

        if (empty($result)) {
            echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
            return;
        }

        $data = [
            "categories" => array_column($result, 'bulan'),
            "more_than_1_day" => array_map('intval', array_column($result, 'more_than_1_day')),
            "more_than_3_days" => array_map('intval', array_column($result, 'more_than_3_days')),
            "percent_more_than_1_day" => array_map('floatval', array_column($result, 'percent_more_than_1_day')),
            "percent_more_than_3_days" => array_map('floatval', array_column($result, 'percent_more_than_3_days'))
        ];

        $q['datapercent']= json_encode($data);
		session_start();
		if(
			$_SESSION['role']=='Superadmin' || 
			$_SESSION['role']=='NOC Ritel' || 
			$_SESSION['role']=='Team Leader' || 
			$_SESSION['role']=='Pemeliharaan Ritel'			
			){
				$this->load->view('navbar',$title);
				$this->load->view('dashboardNoc', $q);
		}else{
			header('location: ./DashboardCs');
		}
		
	}
	public function getTicketData() {
        $query = $this->db->query("SELECT bulan, 
            SUM(more_than_1_day) AS more_than_1_day, 
            SUM(more_than_3_days) AS more_than_3_days,
            CASE 
                WHEN SUM(total_tickets_month) > 0 
                THEN (SUM(more_than_1_day) / SUM(total_tickets_month)) * 100 
                ELSE 0 
            END AS percent_more_than_1_day,
            CASE 
                WHEN SUM(total_tickets_month) > 0 
                THEN (SUM(more_than_3_days) / SUM(total_tickets_month)) * 100 
                ELSE 0 
            END AS percent_more_than_3_days
            FROM (
                SELECT DATE_FORMAT(tanggal, '%b') AS bulan,
                    YEAR(tanggal) AS tahun,
                    COUNT(CASE WHEN TIMESTAMPDIFF(DAY, tanggal, timestamp) < 1 THEN 1 END) AS more_than_1_day,
                    COUNT(CASE WHEN TIMESTAMPDIFF(DAY, tanggal, timestamp) > 3 THEN 1 END) AS more_than_3_days,
                    COALESCE(
                        (SELECT COUNT(*) FROM tiket WHERE YEAR(tiket.tanggal) = YEAR(t.tanggal) AND MONTH(tiket.tanggal) = MONTH(t.tanggal)), 0) + 
                    COALESCE(
                        (SELECT COUNT(*) FROM tiketClose WHERE YEAR(tiketClose.tanggal) = YEAR(t.tanggal) AND MONTH(tiketClose.tanggal) = MONTH(t.tanggal)), 0) 
                    AS total_tickets_month
                FROM (
                    SELECT idTiket, tanggal, timestamp FROM tiket WHERE status='CLOSED'
                    UNION ALL
                    SELECT idTiket, tanggal, timestamp FROM tiketClose WHERE status='CLOSED'
                ) AS t
                GROUP BY YEAR(tanggal), MONTH(tanggal)
            ) AS grouped_data
            GROUP BY bulan, tahun
            ORDER BY tahun, STR_TO_DATE(bulan, '%b');");

        $result = $query->result_array();

        if (empty($result)) {
            echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
            return;
        }

        $data = [
            "categories" => array_column($result, 'bulan'),
            "more_than_1_day" => array_map('intval', array_column($result, 'more_than_1_day')),
            "more_than_3_days" => array_map('intval', array_column($result, 'more_than_3_days')),
            "percent_more_than_1_day" => array_map('floatval', array_column($result, 'percent_more_than_1_day')),
            "percent_more_than_3_days" => array_map('floatval', array_column($result, 'percent_more_than_3_days'))
        ];

        echo json_encode($data);
    }
}