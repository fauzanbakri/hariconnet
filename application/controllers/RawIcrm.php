<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RawIcrm extends CI_Controller {

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
		$title['title']="RAW ICRM+";
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
                    AND penyebab!='NOT INCIDENT' 
                    AND status='TICKET CLOSE' 
                    AND namakelompok='GANGGUAN') 
                    AS total_tickets_week
                FROM rawicrm r
                WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN'
                GROUP BY tahun, minggu
            ) AS grouped_data
            GROUP BY minggu, tahun
            ORDER BY tahun, minggu;
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
                            AND penyebab!='NOT INCIDENT' 
                            AND status='TICKET CLOSE' 
                            AND namakelompok='GANGGUAN') 
                            AS total_tickets_week
                        FROM rawicrm r
                        WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN'
                        GROUP BY tahun, minggu
                    ) AS grouped_data
                    GROUP BY minggu, tahun
                    ORDER BY tahun, minggu;
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
                        AND penyebab!='NOT INCIDENT' 
                        AND status='TICKET CLOSE' 
                        AND namakelompok='GANGGUAN'
                        AND provinsipelanggan='SULAWESI SELATAN') 
                        AS total_tickets_week
                    FROM rawicrm r
                    WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI SELATAN'
                    GROUP BY tahun, minggu
                ) AS grouped_data
                GROUP BY minggu, tahun
                ORDER BY tahun, minggu;
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
            
            $q['datapercent_makassar'] = json_encode($data1);
            //------------------------------------------------------------------
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
                        AND penyebab!='NOT INCIDENT' 
                        AND status='TICKET CLOSE' 
                        AND namakelompok='GANGGUAN'
                        AND provinsipelanggan='SULAWESI BARAT') 
                        AS total_tickets_week
                    FROM rawicrm r
                    WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI BARAT'
                    GROUP BY tahun, minggu
                ) AS grouped_data
                GROUP BY minggu, tahun
                ORDER BY tahun, minggu;
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
                        AND penyebab!='NOT INCIDENT' 
                        AND status='TICKET CLOSE' 
                        AND namakelompok='GANGGUAN'
                        AND provinsipelanggan='SULAWESI TENGAH') 
                        AS total_tickets_week
                    FROM rawicrm r
                    WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI TENGAH'
                    GROUP BY tahun, minggu
                ) AS grouped_data
                GROUP BY minggu, tahun
                ORDER BY tahun, minggu;
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
                    AND penyebab!='NOT INCIDENT' 
                    AND status='TICKET CLOSE' 
                    AND namakelompok='GANGGUAN'
                    AND provinsipelanggan='SULAWESI TENGGARA') 
                    AS total_tickets_week
                FROM rawicrm r
                WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI TENGGARA'
                GROUP BY tahun, minggu
            ) AS grouped_data
            GROUP BY minggu, tahun
            ORDER BY tahun, minggu;
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
                 AND penyebab!='NOT INCIDENT' 
                 AND status='TICKET CLOSE' 
                 AND namakelompok='GANGGUAN'
                 AND provinsipelanggan='GORONTALO') 
                 AS total_tickets_week
             FROM rawicrm r
             WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='GORONTALO'
             GROUP BY tahun, minggu
         ) AS grouped_data
         GROUP BY minggu, tahun
         ORDER BY tahun, minggu;
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
                AND penyebab!='NOT INCIDENT' 
                AND status='TICKET CLOSE' 
                AND namakelompok='GANGGUAN'
                AND provinsipelanggan='SULAWESI UTARA') 
                AS total_tickets_week
            FROM rawicrm r
            WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI UTARA'
            GROUP BY tahun, minggu
        ) AS grouped_data
        GROUP BY minggu, tahun
        ORDER BY tahun, minggu;
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
		(SUM(more_than_1_day) / SUM(total_tickets_month)) * 100 AS percent_more_than_1_day,
		(SUM(more_than_3_days) / SUM(total_tickets_month)) * 100 AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN'
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
	$q['monthlyall']= json_encode($data7);

    //------------------------------------------------------------
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
				 AND penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI SELATAN') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI SELATAN'
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
		(SUM(more_than_1_day) / SUM(total_tickets_month)) * 100 AS percent_more_than_1_day,
		(SUM(more_than_3_days) / SUM(total_tickets_month)) * 100 AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI BARAT') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI BARAT'
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
		(SUM(more_than_1_day) / SUM(total_tickets_month)) * 100 AS percent_more_than_1_day,
		(SUM(more_than_3_days) / SUM(total_tickets_month)) * 100 AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI BARAT') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI BARAT'
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
		(SUM(more_than_1_day) / SUM(total_tickets_month)) * 100 AS percent_more_than_1_day,
		(SUM(more_than_3_days) / SUM(total_tickets_month)) * 100 AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI TENGAH') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI TENGAH'
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
		(SUM(more_than_1_day) / SUM(total_tickets_month)) * 100 AS percent_more_than_1_day,
		(SUM(more_than_3_days) / SUM(total_tickets_month)) * 100 AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI TENGGARA') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI TENGGARA'
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
		(SUM(more_than_1_day) / SUM(total_tickets_month)) * 100 AS percent_more_than_1_day,
		(SUM(more_than_3_days) / SUM(total_tickets_month)) * 100 AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='GORONTALO') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='GORONTALO'
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
		(SUM(more_than_1_day) / SUM(total_tickets_month)) * 100 AS percent_more_than_1_day,
		(SUM(more_than_3_days) / SUM(total_tickets_month)) * 100 AS percent_more_than_3_days
		FROM (
			SELECT DATE_FORMAT(waktulapor, '%b') AS bulan,
				YEAR(waktulapor) AS tahun,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) < 1 THEN 1 END) AS more_than_1_day,
				COUNT(CASE WHEN TIMESTAMPDIFF(DAY, waktulapor, waktulaporanselesai) > 3 THEN 1 END) AS more_than_3_days,
				(SELECT COUNT(*) FROM rawicrm WHERE YEAR(rawicrm.waktulapor) = YEAR(r.waktulapor) 
				 AND MONTH(rawicrm.waktulapor) = MONTH(r.waktulapor) 
				 AND penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI UTARA') 
				AS total_tickets_month
			FROM rawicrm r
			WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN' AND provinsipelanggan='SULAWESI UTARA'
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
				$this->load->view('rawIcrm', $q);
		}else{
			header('location: ./DashboardCs');
		}
		
	}


	public function getTicketData() {
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
                     AND penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN') 
                    AS total_tickets_month
                FROM rawicrm r
                WHERE penyebab!='NOT INCIDENT' AND status='TICKET CLOSE' AND namakelompok='GANGGUAN'
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

        echo json_encode($data);
    }
}