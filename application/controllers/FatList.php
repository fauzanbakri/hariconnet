<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FatList extends CI_Controller {

    public function index()
    {
        $title['title'] = 'List FAT';

        session_start();
        if(
            $_SESSION['role']=='Superadmin' || 
            $_SESSION['role']=='NOC Ritel' || 
            $_SESSION['role']=='Team Leader' || 
            $_SESSION['role']=='Pemeliharaan Ritel' ||
            $_SESSION['role']=='Guest 1'
        ){
            // Fetch CSV data from Google Sheets
            $url = "https://docs.google.com/spreadsheets/d/1yIdP6i17Q8WHF2LvVMhQgBqOnDwQrtIZnbcWpmr36Xw/export?format=csv&edit?gid=766942970#gid=766942970";
            
            $csvData = @file_get_contents($url);
            $data = [];
            
            if ($csvData) {
                $rows = array_map("str_getcsv", explode("\n", $csvData));
                $header = array_shift($rows);
                
                $columnsToShow = ['STATUS', 'ID ODP', 'AREA', 'KOORDINAT', 'HOSTNAME OLT', 'CLUSTER', 'KAPASITAS SPLITTER'];
                $namaAwalList = [];
                $totalData = 0;
                
                foreach ($rows as $row) {
                    if (!isset($row[1]) || !isset($row[2])) continue;
                    if (count($row) != count($header)) continue;
                    
                    $idOdp = trim($row[1]);
                    $area = trim($row[2]);
                    
                    if (!$idOdp) continue;
                    
                    $prefix = preg_replace('/[\d\s\-]+$/', '', $idOdp);
                    if ($prefix) {
                        $prefix = strtoupper($prefix);
                        $namaAwalList[$prefix]['area'] = $area;
                        $namaAwalList[$prefix]['count'] = (isset($namaAwalList[$prefix]['count']) ? $namaAwalList[$prefix]['count'] : 0) + 1;
                        $totalData++;
                    }
                }
                
                ksort($namaAwalList);
                
                // Handle search
                $idCari = $this->input->get('id');
                $filteredRows = [];
                
                if ($idCari) {
                    $filteredRows = array_filter($rows, function($row) use ($idCari) {
                        return isset($row[1]) && stripos(trim($row[1]), trim($idCari)) !== false;
                    });
                }
                
                $data['header'] = $header;
                $data['columnsToShow'] = $columnsToShow;
                $data['namaAwalList'] = $namaAwalList;
                $data['totalData'] = $totalData;
                $data['idCari'] = $idCari;
                $data['filteredRows'] = $filteredRows;
                $data['rows'] = $rows;
            } else {
                $data['error'] = 'Gagal mengambil data dari sumber.';
                $data['header'] = [];
                $data['columnsToShow'] = [];
                $data['namaAwalList'] = [];
                $data['totalData'] = 0;
                $data['idCari'] = '';
                $data['filteredRows'] = [];
            }
            
            $this->load->view('navbar', $title);
            $this->load->view('fatlist', $data);
        } else {
            header('location: ./DashboardNoc');
        }
    }
}
