<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FatDetail extends CI_Controller {

    public function index()
    {
        $title['title'] = 'Detail FAT';

        session_start();
        if(
            $_SESSION['role']=='Superadmin' || 
            $_SESSION['role']=='NOC Ritel' || 
            $_SESSION['role']=='Team Leader' || 
            $_SESSION['role']=='Pemeliharaan Ritel' ||
            $_SESSION['role']=='Guest 1'
        ){
            $odp = trim((string)$this->input->get('odp'));
            $url = "https://docs.google.com/spreadsheets/d/1yIdP6i17Q8WHF2LvVMhQgBqOnDwQrtIZnbcWpmr36Xw/gviz/tq?tqx=out:csv&sheet=MY%20MAPS";
            $csvData = @file_get_contents($url);
            $data = [];
            $header = [];
            $jumlahPort = 8;

            if ($csvData) {
                $rows = array_map('str_getcsv', explode("\n", $csvData));
                $header = array_shift($rows);

                foreach ($rows as $row) {
                    if (count($row) !== count($header)) continue;
                    $rowAssoc = array_combine($header, $row);
                    if (isset($rowAssoc['ID ODP']) && trim($rowAssoc['ID ODP']) === trim($odp)) {
                        $data = $rowAssoc;
                        break;
                    }
                }

                if (!empty($data['KAPASITAS SPLITTER']) && strpos($data['KAPASITAS SPLITTER'], '1:16') !== false) {
                    $jumlahPort = 16;
                }
            }

            $viewData = [
                'odp' => $odp,
                'data' => $data,
                'header' => $header,
                'jumlahPort' => $jumlahPort,
                'title' => $title['title'],
            ];

            $this->load->view('navbar', $title);
            $this->load->view('fatdetail', $viewData);
        } else {
            header('location: ./DashboardNoc');
        }
    }
}
