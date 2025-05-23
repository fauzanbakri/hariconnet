<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sri extends CI_Controller {

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
		$this->load->view('sri');
	}
	public function export() {
		session_start();

		if (!isset($_SESSION['json_input'])) {
			die('Tidak ada data untuk diexport. Silakan input JSON dulu.');
		}

		$json_input = $_SESSION['json_input'];
		$decoded = json_decode($json_input, true);

		if ($decoded === null || !isset($decoded['data']['data']) || !is_array($decoded['data']['data'])) {
			die('Data JSON tidak valid atau format tidak sesuai.');
		}

		$data_rows = $decoded['data']['data'];
		if (count($data_rows) === 0) {
			die('Data kosong, tidak ada yang diexport.');
		}

		// Ambil header dari key object pertama
		$headers = array_keys($data_rows[0]);

		// Set header HTTP untuk download CSV
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data_export.csv');

		// Buat file pointer output
		$output = fopen('php://output', 'w');

		// Tulis header CSV
		fputcsv($output, $headers);

		// Tulis data CSV baris per baris
		foreach ($data_rows as $row) {
			$line = [];
			foreach ($headers as $header) {
				$line[] = $row[$header] ?? '';
			}
			fputcsv($output, $line);
		}

		fclose($output);
		exit;
	}
}
