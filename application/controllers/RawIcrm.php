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
        $q['makassar'] = $this->db->query("
        SELECT 
            kabupatenpelanggan,

            -- Januari - Juni
            SUM(CASE WHEN MONTH(waktulapor) = 1 THEN 1 ELSE 0 END) AS total_jan,
            SUM(CASE WHEN MONTH(waktulapor) = 1 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_jan,
            ROUND((SUM(CASE WHEN MONTH(waktulapor) = 1 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) /
                NULLIF(SUM(CASE WHEN MONTH(waktulapor) = 1 THEN 1 ELSE 0 END), 0)) * 100, 2) AS percentage_less_1_day_jan,

            SUM(CASE WHEN MONTH(waktulapor) = 2 THEN 1 ELSE 0 END) AS total_feb,
            SUM(CASE WHEN MONTH(waktulapor) = 2 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_feb,
            ROUND((SUM(CASE WHEN MONTH(waktulapor) = 2 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) /
                NULLIF(SUM(CASE WHEN MONTH(waktulapor) = 2 THEN 1 ELSE 0 END), 0)) * 100, 2) AS percentage_less_1_day_feb,

            SUM(CASE WHEN MONTH(waktulapor) = 3 THEN 1 ELSE 0 END) AS total_mar,
            SUM(CASE WHEN MONTH(waktulapor) = 3 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_mar,
            ROUND((SUM(CASE WHEN MONTH(waktulapor) = 3 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) /
                NULLIF(SUM(CASE WHEN MONTH(waktulapor) = 3 THEN 1 ELSE 0 END), 0)) * 100, 2) AS percentage_less_1_day_mar,

            SUM(CASE WHEN MONTH(waktulapor) = 4 THEN 1 ELSE 0 END) AS total_apr,
            SUM(CASE WHEN MONTH(waktulapor) = 4 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_apr,
            ROUND((SUM(CASE WHEN MONTH(waktulapor) = 4 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) /
                NULLIF(SUM(CASE WHEN MONTH(waktulapor) = 4 THEN 1 ELSE 0 END), 0)) * 100, 2) AS percentage_less_1_day_apr,

            SUM(CASE WHEN MONTH(waktulapor) = 5 THEN 1 ELSE 0 END) AS total_may,
            SUM(CASE WHEN MONTH(waktulapor) = 5 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_may,
            ROUND((SUM(CASE WHEN MONTH(waktulapor) = 5 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) /
                NULLIF(SUM(CASE WHEN MONTH(waktulapor) = 5 THEN 1 ELSE 0 END), 0)) * 100, 2) AS percentage_less_1_day_may,

            SUM(CASE WHEN MONTH(waktulapor) = 6 THEN 1 ELSE 0 END) AS total_jun,
            SUM(CASE WHEN MONTH(waktulapor) = 6 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_jun,
            ROUND((SUM(CASE WHEN MONTH(waktulapor) = 6 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) /
                NULLIF(SUM(CASE WHEN MONTH(waktulapor) = 6 THEN 1 ELSE 0 END), 0)) * 100, 2) AS percentage_less_1_day_jun,

            -- Juli - Desember
            SUM(CASE WHEN MONTH(waktulapor) = 7 THEN 1 ELSE 0 END) AS total_jul,
            SUM(CASE WHEN MONTH(waktulapor) = 7 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_jul,
            ROUND((SUM(CASE WHEN MONTH(waktulapor) = 7 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) /
                NULLIF(SUM(CASE WHEN MONTH(waktulapor) = 7 THEN 1 ELSE 0 END), 0)) * 100, 2) AS percentage_less_1_day_jul,

            SUM(CASE WHEN MONTH(waktulapor) = 8 THEN 1 ELSE 0 END) AS total_aug,
            SUM(CASE WHEN MONTH(waktulapor) = 8 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_aug,
            ROUND((SUM(CASE WHEN MONTH(waktulapor) = 8 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) /
                NULLIF(SUM(CASE WHEN MONTH(waktulapor) = 8 THEN 1 ELSE 0 END), 0)) * 100, 2) AS percentage_less_1_day_aug,

            SUM(CASE WHEN MONTH(waktulapor) = 9 THEN 1 ELSE 0 END) AS total_sep,
            SUM(CASE WHEN MONTH(waktulapor) = 9 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_sep,
            ROUND((SUM(CASE WHEN MONTH(waktulapor) = 9 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) /
                NULLIF(SUM(CASE WHEN MONTH(waktulapor) = 9 THEN 1 ELSE 0 END), 0)) * 100, 2) AS percentage_less_1_day_sep,

            SUM(CASE WHEN MONTH(waktulapor) = 10 THEN 1 ELSE 0 END) AS total_oct,
            SUM(CASE WHEN MONTH(waktulapor) = 10 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_oct,
            ROUND((SUM(CASE WHEN MONTH(waktulapor) = 10 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) /
                NULLIF(SUM(CASE WHEN MONTH(waktulapor) = 10 THEN 1 ELSE 0 END), 0)) * 100, 2) AS percentage_less_1_day_oct,

            SUM(CASE WHEN MONTH(waktulapor) = 11 THEN 1 ELSE 0 END) AS total_nov,
            SUM(CASE WHEN MONTH(waktulapor) = 11 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_nov,
            ROUND((SUM(CASE WHEN MONTH(waktulapor) = 11 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) /
                NULLIF(SUM(CASE WHEN MONTH(waktulapor) = 11 THEN 1 ELSE 0 END), 0)) * 100, 2) AS percentage_less_1_day_nov,

            SUM(CASE WHEN MONTH(waktulapor) = 12 THEN 1 ELSE 0 END) AS total_dec,
            SUM(CASE WHEN MONTH(waktulapor) = 12 AND TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_dec,

            COUNT(*) AS total_semua_bulan,
            SUM(CASE WHEN TIMESTAMPDIFF(HOUR, waktulapor, waktulaporanselesai) < 24 THEN 1 ELSE 0 END) AS less_1_day_semua_bulan

        FROM rawicrm
        WHERE provinsipelanggan = 'SULAWESI SELATAN'
        GROUP BY kabupatenpelanggan
        ORDER BY kabupatenpelanggan;
        ")->result();
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