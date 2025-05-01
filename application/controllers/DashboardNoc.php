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
		$q['total_feeder'] = $this->db->query("SELECT SUM(jumlahTiket) AS total_feeder FROM feeder")->result();
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
		// $query = $this->db->query("SELECT bulan, 
        //     SUM(more_than_1_day) AS more_than_1_day, 
        //     SUM(more_than_3_days) AS more_than_3_days,
        //     CASE 
        //         WHEN SUM(total_tickets_month) > 0 
        //         THEN (SUM(more_than_1_day) / SUM(total_tickets_month)) * 100 
        //         ELSE 0 
        //     END AS percent_more_than_1_day,
        //     CASE 
        //         WHEN SUM(total_tickets_month) > 0 
        //         THEN (SUM(more_than_3_days) / SUM(total_tickets_month)) * 100 
        //         ELSE 0 
        //     END AS percent_more_than_3_days
        //     FROM (
        //         SELECT DATE_FORMAT(tanggal, '%b') AS bulan,
        //             YEAR(tanggal) AS tahun,
        //             COUNT(CASE WHEN TIMESTAMPDIFF(DAY, tanggal, timestamp) < 1 THEN 1 END) AS more_than_1_day,
        //             COUNT(CASE WHEN TIMESTAMPDIFF(DAY, tanggal, timestamp) > 3 THEN 1 END) AS more_than_3_days,
        //             COALESCE(
        //                 (SELECT COUNT(*) FROM tiket WHERE YEAR(tiket.tanggal) = YEAR(t.tanggal) AND MONTH(tiket.tanggal) = MONTH(t.tanggal)), 0) + 
        //             COALESCE(
        //                 (SELECT COUNT(*) FROM tiketClose WHERE YEAR(tiketClose.tanggal) = YEAR(t.tanggal) AND MONTH(tiketClose.tanggal) = MONTH(t.tanggal)), 0) 
        //             AS total_tickets_month
        //         FROM (
        //             SELECT idTiket, tanggal, timestamp FROM tiket WHERE status='CLOSED'
        //             UNION ALL
        //             SELECT idTiket, tanggal, timestamp FROM tiketClose WHERE status='CLOSED'
        //         ) AS t
        //         GROUP BY YEAR(tanggal), MONTH(tanggal)
        //     ) AS grouped_data
        //     GROUP BY bulan, tahun
        //     ORDER BY tahun, STR_TO_DATE(bulan, '%b');");

        // $result = $query->result_array();

        // if (empty($result)) {
        //     echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
        //     return;
        // }

        // $data = [
        //     "categories" => array_column($result, 'bulan'),
        //     "more_than_1_day" => array_map('intval', array_column($result, 'more_than_1_day')),
        //     "more_than_3_days" => array_map('intval', array_column($result, 'more_than_3_days')),
        //     "percent_more_than_1_day" => array_map('floatval', array_column($result, 'percent_more_than_1_day')),
        //     "percent_more_than_3_days" => array_map('floatval', array_column($result, 'percent_more_than_3_days'))
        // ];

        // $q['datapercent']= json_encode($data);

		$query = $this->db->query("SELECT bulan, 
		SUM(more_than_1_day) AS more_than_1_day, 
		SUM(more_than_3_days) AS more_than_3_days,
		(SUM(more_than_1_day) / SUM(total_tickets_month)) * 100 AS percent_more_than_1_day,
		(SUM(more_than_3_days) / SUM(total_tickets_month)) * 100 AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND status='TICKET CLOSE' AND namakelompok='GANGGUAN') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN'
			GROUP BY YEAR(waktulapor), MONTH(waktulapor)
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
	$q['datapercent2']= json_encode($data);
	

	$query = $this->db->query("
            SELECT 
                CONCAT('Week ', minggu) AS minggu,
                tahun,
                SUM(more_than_1_day) AS more_than_1_day, 
                SUM(more_than_3_days) AS more_than_3_days,
                ROUND((SUM(more_than_1_day) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_1_day,
    			ROUND((SUM(more_than_3_days) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_3_days
            FROM (
                SELECT 
                    WEEK(r.waktulapor, 1) AS minggu,
                    YEAR(r.waktulapor) AS tahun,
                    COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
                    COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
                    (SELECT COUNT(*) FROM rawicrm 
                    WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
                    AND WEEK(rawicrm.waktulapor, 1) = WEEK(r.waktulapor, 1) 
                    AND status='TICKET CLOSE' 
                    AND namakelompok='GANGGUAN') 
                    AS total_tickets_week
                FROM rawicrm r
                WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN'
                GROUP BY tahun, minggu
            ) AS grouped_data
            GROUP BY minggu, tahun
ORDER BY tahun, CAST(minggu AS UNSIGNED);



        ");
        
        $result = $query->result_array();
        
        if (empty($result)) {
            echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
            return;
        }
        
        $data = [
            "categories" => array_column($result, 'minggu'),
            "more_than_1_day" => array_map('intval', array_column($result, 'more_than_1_day')),
            "more_than_3_days" => array_map('intval', array_column($result, 'more_than_3_days')),
            "percent_more_than_1_day" => array_map('floatval', array_column($result, 'percent_more_than_1_day')),
            "percent_more_than_3_days" => array_map('floatval', array_column($result, 'percent_more_than_3_days'))
        ];
        
        $q['datapercent'] = json_encode($data);
        //------------------------------------------------------------------
        $query = $this->db->query("
                    SELECT 
                        CONCAT('Week ', minggu) AS minggu,
                        tahun,
                        SUM(more_than_1_day) AS more_than_1_day, 
                        SUM(more_than_3_days) AS more_than_3_days,
						ROUND((SUM(more_than_1_day) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_1_day,
						ROUND((SUM(more_than_3_days) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_3_days
                    FROM (
                        SELECT 
                            WEEK(r.waktulapor, 1) AS minggu,
                            YEAR(r.waktulapor) AS tahun,
                            COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
                            COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
                            (SELECT COUNT(*) FROM rawicrm 
                            WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
                            AND WEEK(rawicrm.waktulapor, 1) = WEEK(r.waktulapor, 1) 
                            AND status='TICKET CLOSE' 
                            AND namakelompok='GANGGUAN') 
                            AS total_tickets_week
                        FROM rawicrm r
                        WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN'
                        GROUP BY tahun, minggu
                    ) AS grouped_data
                    GROUP BY minggu, tahun
ORDER BY tahun, CAST(minggu AS UNSIGNED);
                ");
                
                $result = $query->result_array();
                
                if (empty($result)) {
                    echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
                    return;
                }
                
                $data = [
                    "categories" => array_column($result, 'minggu'),
                    "more_than_1_day" => array_map('intval', array_column($result, 'more_than_1_day')),
                    "more_than_3_days" => array_map('intval', array_column($result, 'more_than_3_days')),
                    "percent_more_than_1_day" => array_map('floatval', array_column($result, 'percent_more_than_1_day')),
                    "percent_more_than_3_days" => array_map('floatval', array_column($result, 'percent_more_than_3_days'))
                ];
                
                $q['datapercent'] = json_encode($data);
                //------------------------------------------------------------------
                $query = $this->db->query("
                SELECT 
                    CONCAT('Week ', minggu) AS minggu,
                    tahun,
                    SUM(more_than_1_day) AS more_than_1_day, 
                    SUM(more_than_3_days) AS more_than_3_days,
					ROUND((SUM(more_than_1_day) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_1_day,
    				ROUND((SUM(more_than_3_days) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_3_days
                FROM (
                    SELECT 
                        WEEK(r.waktulapor, 1) AS minggu,
                        YEAR(r.waktulapor) AS tahun,
                        COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
                        COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
                        (SELECT COUNT(*) FROM rawicrm 
                        WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
                        AND WEEK(rawicrm.waktulapor, 1) = WEEK(r.waktulapor, 1) 
                        AND status='TICKET CLOSE' 
                        AND namakelompok='GANGGUAN'
                        AND provinsipelanggan='SULAWESI SELATAN') 
                        AS total_tickets_week
                    FROM rawicrm r
                    WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI SELATAN'
                    GROUP BY tahun, minggu
                ) AS grouped_data
                GROUP BY minggu, tahun
ORDER BY tahun, CAST(minggu AS UNSIGNED);
            ");
            
            $result1 = $query->result_array();
            
            if (empty($result1)) {
                echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
                return;
            }
            
            $data1 = [
                "categories" => array_column($result1, 'minggu'),
                "more_than_1_day" => array_map('intval', array_column($result1, 'more_than_1_day')),
                "more_than_3_days" => array_map('intval', array_column($result1, 'more_than_3_days')),
                "percent_more_than_1_day" => array_map('floatval', array_column($result1, 'percent_more_than_1_day')),
                "percent_more_than_3_days" => array_map('floatval', array_column($result1, 'percent_more_than_3_days'))
            ];
            
            // $q['datapercent_makassar'] = json_encode($data1);
            echo json_encode($data1); die();

            //------------------------------------------------------------------
            $query = $this->db->query("
                SELECT 
                    CONCAT('Week ', minggu) AS minggu,
                    tahun,
                    SUM(more_than_1_day) AS more_than_1_day, 
                    SUM(more_than_3_days) AS more_than_3_days,
					ROUND((SUM(more_than_1_day) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_1_day,
    				ROUND((SUM(more_than_3_days) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_3_days
                FROM (
                    SELECT 
                        WEEK(r.waktulapor, 1) AS minggu,
                        YEAR(r.waktulapor) AS tahun,
                        COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
                        COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
                        (SELECT COUNT(*) FROM rawicrm 
                        WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
                        AND WEEK(rawicrm.waktulapor, 1) = WEEK(r.waktulapor, 1) 
                        AND status='TICKET CLOSE' 
                        AND namakelompok='GANGGUAN'
                        AND provinsipelanggan='SULAWESI BARAT') 
                        AS total_tickets_week
                    FROM rawicrm r
                    WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI BARAT'
                    GROUP BY tahun, minggu
                ) AS grouped_data
                GROUP BY minggu, tahun
ORDER BY tahun, CAST(minggu AS UNSIGNED);
            ");
            
            $result2 = $query->result_array();
            
            if (empty($result2)) {
                echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
                return;
            }
            
            $data2 = [
                "categories" => array_column($result2, 'minggu'),
                "more_than_1_day" => array_map('intval', array_column($result2, 'more_than_1_day')),
                "more_than_3_days" => array_map('intval', array_column($result2, 'more_than_3_days')),
                "percent_more_than_1_day" => array_map('floatval', array_column($result2, 'percent_more_than_1_day')),
                "percent_more_than_3_days" => array_map('floatval', array_column($result2, 'percent_more_than_3_days'))
            ];
            
            $q['datapercent_mamuju'] = json_encode($data2);

             //------------------------------------------------------------------
             $query = $this->db->query("
                SELECT 
                    CONCAT('Week ', minggu) AS minggu,
                    tahun,
                    SUM(more_than_1_day) AS more_than_1_day, 
                    SUM(more_than_3_days) AS more_than_3_days,
					ROUND((SUM(more_than_1_day) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_1_day,
    				ROUND((SUM(more_than_3_days) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_3_days
                FROM (
                    SELECT 
                        WEEK(r.waktulapor, 1) AS minggu,
                        YEAR(r.waktulapor) AS tahun,
                        COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
                        COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
                        (SELECT COUNT(*) FROM rawicrm 
                        WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
                        AND WEEK(rawicrm.waktulapor, 1) = WEEK(r.waktulapor, 1) 
                        AND status='TICKET CLOSE' 
                        AND namakelompok='GANGGUAN'
                        AND provinsipelanggan='SULAWESI TENGAH') 
                        AS total_tickets_week
                    FROM rawicrm r
                    WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI TENGAH'
                    GROUP BY tahun, minggu
                ) AS grouped_data
                GROUP BY minggu, tahun
ORDER BY tahun, CAST(minggu AS UNSIGNED);
            ");
            
            $result3 = $query->result_array();
            
            if (empty($result3)) {
                echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
                return;
            }
            
            $data3 = [
                "categories" => array_column($result3, 'minggu'),
                "more_than_1_day" => array_map('intval', array_column($result3, 'more_than_1_day')),
                "more_than_3_days" => array_map('intval', array_column($result3, 'more_than_3_days')),
                "percent_more_than_1_day" => array_map('floatval', array_column($result3, 'percent_more_than_1_day')),
                "percent_more_than_3_days" => array_map('floatval', array_column($result3, 'percent_more_than_3_days'))
            ];
            
            $q['datapercent_palu'] = json_encode($data3);
            //------------------------------------------------------------------
            $query = $this->db->query("
            SELECT 
                CONCAT('Week ', minggu) AS minggu,
                tahun,
                SUM(more_than_1_day) AS more_than_1_day, 
                SUM(more_than_3_days) AS more_than_3_days,
				ROUND((SUM(more_than_1_day) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_1_day,
   				ROUND((SUM(more_than_3_days) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_3_days
            FROM (
                SELECT 
                    WEEK(r.waktulapor, 1) AS minggu,
                    YEAR(r.waktulapor) AS tahun,
                    COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
                    COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
                    (SELECT COUNT(*) FROM rawicrm 
                    WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
                    AND WEEK(rawicrm.waktulapor, 1) = WEEK(r.waktulapor, 1) 
                    AND status='TICKET CLOSE' 
                    AND namakelompok='GANGGUAN'
                    AND provinsipelanggan='SULAWESI TENGGARA') 
                    AS total_tickets_week
                FROM rawicrm r
                WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI TENGGARA'
                GROUP BY tahun, minggu
            ) AS grouped_data
            GROUP BY minggu, tahun
ORDER BY tahun, CAST(minggu AS UNSIGNED);
        ");
        
        $result4 = $query->result_array();
        
        if (empty($result4)) {
            echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
            return;
        }
        
        $data4 = [
            "categories" => array_column($result4, 'minggu'),
            "more_than_1_day" => array_map('intval', array_column($result4, 'more_than_1_day')),
            "more_than_3_days" => array_map('intval', array_column($result4, 'more_than_3_days')),
            "percent_more_than_1_day" => array_map('floatval', array_column($result4, 'percent_more_than_1_day')),
            "percent_more_than_3_days" => array_map('floatval', array_column($result4, 'percent_more_than_3_days'))
        ];
        
        $q['datapercent_kendari'] = json_encode($data4);
         //------------------------------------------------------------------
         $query = $this->db->query("
         SELECT 
             CONCAT('Week ', minggu) AS minggu,
             tahun,
             SUM(more_than_1_day) AS more_than_1_day, 
             SUM(more_than_3_days) AS more_than_3_days,
			ROUND((SUM(more_than_1_day) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_1_day,
    		ROUND((SUM(more_than_3_days) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_3_days
         FROM (
             SELECT 
                 WEEK(r.waktulapor, 1) AS minggu,
                 YEAR(r.waktulapor) AS tahun,
                 COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
                 COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
                 (SELECT COUNT(*) FROM rawicrm 
                 WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
                 AND WEEK(rawicrm.waktulapor, 1) = WEEK(r.waktulapor, 1) 
                 AND status='TICKET CLOSE' 
                 AND namakelompok='GANGGUAN'
                 AND provinsipelanggan='GORONTALO') 
                 AS total_tickets_week
             FROM rawicrm r
             WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='GORONTALO'
             GROUP BY tahun, minggu
         ) AS grouped_data
         GROUP BY minggu, tahun
ORDER BY tahun, CAST(minggu AS UNSIGNED);
     ");
     
     $result5 = $query->result_array();
     
     if (empty($result5)) {
         echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
         return;
     }
     
     $data5 = [
         "categories" => array_column($result5, 'minggu'),
         "more_than_1_day" => array_map('intval', array_column($result5, 'more_than_1_day')),
         "more_than_3_days" => array_map('intval', array_column($result5, 'more_than_3_days')),
         "percent_more_than_1_day" => array_map('floatval', array_column($result5, 'percent_more_than_1_day')),
         "percent_more_than_3_days" => array_map('floatval', array_column($result5, 'percent_more_than_3_days'))
     ];
     
     $q['datapercent_gorontalo'] = json_encode($data5);


     //------------------------------------------------------------------
     $query = $this->db->query("
        SELECT 
            CONCAT('Week ', minggu) AS minggu,
            tahun,
            SUM(more_than_1_day) AS more_than_1_day, 
            SUM(more_than_3_days) AS more_than_3_days,
            ROUND((SUM(more_than_1_day) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_1_day,
    		ROUND((SUM(more_than_3_days) / SUM(total_tickets_week)) * 100, 2) AS percent_more_than_3_days
        FROM (
            SELECT 
                WEEK(r.waktulapor, 1) AS minggu,
                YEAR(r.waktulapor) AS tahun,
                COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
                COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
                (SELECT COUNT(*) FROM rawicrm 
                WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
                AND WEEK(rawicrm.waktulapor, 1) = WEEK(r.waktulapor, 1) 
                AND status='TICKET CLOSE' 
                AND namakelompok='GANGGUAN'
                AND provinsipelanggan='SULAWESI UTARA') 
                AS total_tickets_week
            FROM rawicrm r
            WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI UTARA'
            GROUP BY tahun, minggu
        ) AS grouped_data
        GROUP BY minggu, tahun
ORDER BY tahun, CAST(minggu AS UNSIGNED);
    ");
    
    $result6 = $query->result_array();
    
    if (empty($result6)) {
        echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
        return;
    }
    
    $data6 = [
        "categories" => array_column($result6, 'minggu'),
        "more_than_1_day" => array_map('intval', array_column($result6, 'more_than_1_day')),
        "more_than_3_days" => array_map('intval', array_column($result6, 'more_than_3_days')),
        "percent_more_than_1_day" => array_map('floatval', array_column($result6, 'percent_more_than_1_day')),
        "percent_more_than_3_days" => array_map('floatval', array_column($result6, 'percent_more_than_3_days'))
    ];
    
    $q['datapercent_manado'] = json_encode($data6);
    
    //------------------------------------------------------------
    $query = $this->db->query("SELECT bulan, 
		SUM(more_than_1_day) AS more_than_1_day, 
		SUM(more_than_3_days) AS more_than_3_days,
		ROUND((SUM(more_than_1_day) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_1_day,
		ROUND((SUM(more_than_3_days) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND status='TICKET CLOSE' AND namakelompok='GANGGUAN') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN'
			GROUP BY YEAR(waktulapor), MONTH(waktulapor)
		) AS grouped_data
		GROUP BY bulan, tahun
		ORDER BY tahun, STR_TO_DATE(bulan, '%b');");

	$result7 = $query->result_array();

	if (empty($result7)) {
		echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
		return;
	}

	$data7 = [
		"categories" => array_column($result7, 'bulan'),
		"more_than_1_day" => array_map('intval', array_column($result7, 'more_than_1_day')),
		"more_than_3_days" => array_map('intval', array_column($result7, 'more_than_3_days')),
		"percent_more_than_1_day" => array_map('floatval', array_column($result7, 'percent_more_than_1_day')),
		"percent_more_than_3_days" => array_map('floatval', array_column($result7, 'percent_more_than_3_days'))
	];

    // Hitung YTD values
    $total_days_ytd = count($result7);
    $sum_percent_more_than_1_day = array_sum(array_column($result7, 'percent_more_than_1_day'));
    $sum_percent_more_than_3_days = array_sum(array_column($result7, 'percent_more_than_3_days'));

    $ytd_percent_more_than_1_day = round($sum_percent_more_than_1_day / $total_days_ytd, 2);
    $ytd_percent_more_than_3_days = round($sum_percent_more_than_3_days / $total_days_ytd, 2);

    // Tambahkan ke data grafik sebagai bulan "YTD"
    $data7['categories'][] = 'YTD';
    $data7['percent_more_than_1_day'][] = $ytd_percent_more_than_1_day;
    $data7['percent_more_than_3_days'][] = $ytd_percent_more_than_3_days;
    $data7['more_than_1_day'][] = null; // placeholder jika tidak ditampilkan
    $data7['more_than_3_days'][] = null;

	$q['monthlyall']= json_encode($data7);

    //------------------------------------------------------------
    $query = $this->db->query("SELECT bulan, 
		SUM(more_than_1_day) AS more_than_1_day, 
		SUM(more_than_3_days) AS more_than_3_days,
		ROUND((SUM(more_than_1_day) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_1_day,
		ROUND((SUM(more_than_3_days) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI SELATAN') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI SELATAN'
			GROUP BY YEAR(waktulapor), MONTH(waktulapor)
		) AS grouped_data
		GROUP BY bulan, tahun
		ORDER BY tahun, STR_TO_DATE(bulan, '%b');");

	$result8 = $query->result_array();

	if (empty($result8)) {
		echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
		return;
	}

	$data8 = [
		"categories" => array_column($result8, 'bulan'),
		"more_than_1_day" => array_map('intval', array_column($result8, 'more_than_1_day')),
		"more_than_3_days" => array_map('intval', array_column($result8, 'more_than_3_days')),
		"percent_more_than_1_day" => array_map('floatval', array_column($result8, 'percent_more_than_1_day')),
		"percent_more_than_3_days" => array_map('floatval', array_column($result8, 'percent_more_than_3_days'))
	];
	$q['monthlymks']= json_encode($data8);


    //------------------------------------------------------------
    $query = $this->db->query("SELECT bulan, 
		SUM(more_than_1_day) AS more_than_1_day, 
		SUM(more_than_3_days) AS more_than_3_days,
		ROUND((SUM(more_than_1_day) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_1_day,
		ROUND((SUM(more_than_3_days) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI BARAT') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI BARAT'
			GROUP BY YEAR(waktulapor), MONTH(waktulapor)
		) AS grouped_data
		GROUP BY bulan, tahun
		ORDER BY tahun, STR_TO_DATE(bulan, '%b');");

	$result9 = $query->result_array();

	if (empty($result8)) {
		echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
		return;
	}

	$data9 = [
		"categories" => array_column($result9, 'bulan'),
		"more_than_1_day" => array_map('intval', array_column($result9, 'more_than_1_day')),
		"more_than_3_days" => array_map('intval', array_column($result9, 'more_than_3_days')),
		"percent_more_than_1_day" => array_map('floatval', array_column($result9, 'percent_more_than_1_day')),
		"percent_more_than_3_days" => array_map('floatval', array_column($result9, 'percent_more_than_3_days'))
	];
	$q['monthlymmj']= json_encode($data9);

//------------------------------------------------------------
    $query = $this->db->query("SELECT bulan, 
		SUM(more_than_1_day) AS more_than_1_day, 
		SUM(more_than_3_days) AS more_than_3_days,
		ROUND((SUM(more_than_1_day) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_1_day,
		ROUND((SUM(more_than_3_days) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI BARAT') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI BARAT'
			GROUP BY YEAR(waktulapor), MONTH(waktulapor)
		) AS grouped_data
		GROUP BY bulan, tahun
		ORDER BY tahun, STR_TO_DATE(bulan, '%b');");

	$result9 = $query->result_array();

	if (empty($result9)) {
		echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
		return;
	}

	$data9 = [
		"categories" => array_column($result9, 'bulan'),
		"more_than_1_day" => array_map('intval', array_column($result9, 'more_than_1_day')),
		"more_than_3_days" => array_map('intval', array_column($result9, 'more_than_3_days')),
		"percent_more_than_1_day" => array_map('floatval', array_column($result9, 'percent_more_than_1_day')),
		"percent_more_than_3_days" => array_map('floatval', array_column($result9, 'percent_more_than_3_days'))
	];
	$q['monthlymmj']= json_encode($data9);



    //------------------------------------------------------------
    $query = $this->db->query("SELECT bulan, 
		SUM(more_than_1_day) AS more_than_1_day, 
		SUM(more_than_3_days) AS more_than_3_days,
		ROUND((SUM(more_than_1_day) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_1_day,
		ROUND((SUM(more_than_3_days) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI TENGAH') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI TENGAH'
			GROUP BY YEAR(waktulapor), MONTH(waktulapor)
		) AS grouped_data
		GROUP BY bulan, tahun
		ORDER BY tahun, STR_TO_DATE(bulan, '%b');");

	$result10 = $query->result_array();

	if (empty($result10)) {
		echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
		return;
	}

	$data10 = [
		"categories" => array_column($result10, 'bulan'),
		"more_than_1_day" => array_map('intval', array_column($result10, 'more_than_1_day')),
		"more_than_3_days" => array_map('intval', array_column($result10, 'more_than_3_days')),
		"percent_more_than_1_day" => array_map('floatval', array_column($result10, 'percent_more_than_1_day')),
		"percent_more_than_3_days" => array_map('floatval', array_column($result10, 'percent_more_than_3_days'))
	];
	$q['monthlypal']= json_encode($data10);


    //------------------------------------------------------------
    $query = $this->db->query("SELECT bulan, 
		SUM(more_than_1_day) AS more_than_1_day, 
		SUM(more_than_3_days) AS more_than_3_days,
		ROUND((SUM(more_than_1_day) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_1_day,
		ROUND((SUM(more_than_3_days) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI TENGGARA') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI TENGGARA'
			GROUP BY YEAR(waktulapor), MONTH(waktulapor)
		) AS grouped_data
		GROUP BY bulan, tahun
		ORDER BY tahun, STR_TO_DATE(bulan, '%b');");

	$result11 = $query->result_array();

	if (empty($result11)) {
		echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
		return;
	}

	$data11 = [
		"categories" => array_column($result11, 'bulan'),
		"more_than_1_day" => array_map('intval', array_column($result11, 'more_than_1_day')),
		"more_than_3_days" => array_map('intval', array_column($result11, 'more_than_3_days')),
		"percent_more_than_1_day" => array_map('floatval', array_column($result11, 'percent_more_than_1_day')),
		"percent_more_than_3_days" => array_map('floatval', array_column($result11, 'percent_more_than_3_days'))
	];
	$q['monthlykdi']= json_encode($data11);


    //------------------------------------------------------------
    $query = $this->db->query("SELECT bulan, 
		SUM(more_than_1_day) AS more_than_1_day, 
		SUM(more_than_3_days) AS more_than_3_days,
		ROUND((SUM(more_than_1_day) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_1_day,
		ROUND((SUM(more_than_3_days) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='GORONTALO') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='GORONTALO'
			GROUP BY YEAR(waktulapor), MONTH(waktulapor)
		) AS grouped_data
		GROUP BY bulan, tahun
		ORDER BY tahun, STR_TO_DATE(bulan, '%b');");

	$result12 = $query->result_array();

	if (empty($result12)) {
		echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
		return;
	}

	$data12 = [
		"categories" => array_column($result12, 'bulan'),
		"more_than_1_day" => array_map('intval', array_column($result12, 'more_than_1_day')),
		"more_than_3_days" => array_map('intval', array_column($result12, 'more_than_3_days')),
		"percent_more_than_1_day" => array_map('floatval', array_column($result12, 'percent_more_than_1_day')),
		"percent_more_than_3_days" => array_map('floatval', array_column($result12, 'percent_more_than_3_days'))
	];
	$q['monthlygto']= json_encode($data12);


    //------------------------------------------------------------
    $query = $this->db->query("SELECT bulan, 
		SUM(more_than_1_day) AS more_than_1_day, 
		SUM(more_than_3_days) AS more_than_3_days,
		ROUND((SUM(more_than_1_day) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_1_day,
		ROUND((SUM(more_than_3_days) / SUM(total_tickets_month)) * 100,2) AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI UTARA') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI UTARA'
			GROUP BY YEAR(waktulapor), MONTH(waktulapor)
		) AS grouped_data
		GROUP BY bulan, tahun
		ORDER BY tahun, STR_TO_DATE(bulan, '%b');");

	$result13 = $query->result_array();

	if (empty($result13)) {
		echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
		return;
	}

	$data13 = [
		"categories" => array_column($result13, 'bulan'),
		"more_than_1_day" => array_map('intval', array_column($result13, 'more_than_1_day')),
		"more_than_3_days" => array_map('intval', array_column($result13, 'more_than_3_days')),
		"percent_more_than_1_day" => array_map('floatval', array_column($result13, 'percent_more_than_1_day')),
		"percent_more_than_3_days" => array_map('floatval', array_column($result13, 'percent_more_than_3_days'))
	];
	$q['monthlymnd']= json_encode($data13);

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
		$query = $this->db->query("
         SELECT 
             CONCAT('Week ', minggu) AS minggu,
             tahun,
             SUM(more_than_1_day) AS more_than_1_day, 
             SUM(more_than_3_days) AS more_than_3_days,
             (SUM(more_than_1_day) / SUM(total_tickets_week)) * 100 AS percent_more_than_1_day,
             (SUM(more_than_3_days) / SUM(total_tickets_week)) * 100 AS percent_more_than_3_days
         FROM (
             SELECT 
                 WEEK(r.waktulapor, 1) AS minggu,
                 YEAR(r.waktulapor) AS tahun,
                 COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
                 COUNT(CASE WHEN TIMESTAMPDIFF(DAY, r.waktulapor, r.waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
                 (SELECT COUNT(*) FROM rawicrm 
                 WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
                 AND WEEK(rawicrm.waktulapor, 1) = WEEK(r.waktulapor, 1) 
                 AND status='TICKET CLOSE' 
                 AND namakelompok='GANGGUAN'
                 AND provinsipelanggan='GORONTALO') 
                 AS total_tickets_week
             FROM rawicrm r
             WHERE status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='GORONTALO'
             GROUP BY tahun, minggu
         ) AS grouped_data
         GROUP BY minggu, tahun
ORDER BY tahun, CAST(minggu AS UNSIGNED);
     ");
     
     $result5 = $query->result_array();
     
     if (empty($result5)) {
         echo json_encode(["categories" => [], "more_than_1_day" => [], "more_than_3_days" => [], "percent_more_than_1_day" => [], "percent_more_than_3_days" => []]);
         return;
     }
     
     $data5 = [
         "categories" => array_column($result5, 'minggu'),
         "more_than_1_day" => array_map('intval', array_column($result5, 'more_than_1_day')),
         "more_than_3_days" => array_map('intval', array_column($result5, 'more_than_3_days')),
         "percent_more_than_1_day" => array_map('floatval', array_column($result5, 'percent_more_than_1_day')),
         "percent_more_than_3_days" => array_map('floatval', array_column($result5, 'percent_more_than_3_days'))
     ];
     
	 echo json_encode($data5);
	 
	}	
    
}