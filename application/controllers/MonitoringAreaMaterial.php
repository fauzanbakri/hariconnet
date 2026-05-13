<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringAreaMaterial extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        session_start();
        $title['title'] = 'Monitoring Area Material';
        
        // load area (kabupaten) list from basecamp
        $data['areas'] = [];
        if ($this->db->table_exists('basecamp')) {
            $this->db->distinct();
            $this->db->select('kabupaten');
            $this->db->from('basecamp');
            $this->db->where('kabupaten IS NOT NULL', NULL, FALSE);
            $this->db->where("kabupaten != ''");
            $this->db->order_by('kabupaten','ASC');
            $areas = $this->db->get()->result();
            foreach ($areas as $a) {
                $data['areas'][] = $a->kabupaten;
            }
        }

        // detect standarStok table name
        $candidates = ['standarStok','standar_stok','standarstok','standar_stoks'];
        $table = null;
        foreach ($candidates as $t) {
            if ($this->db->table_exists($t)) { $table = $t; break; }
        }

        // mapping tipeMaterial -> standarStok column
        $tipe_map = [
            'ONT HUAWEI' => 'ont_huawei',
            'ONT FIBERHOME' => 'ont_fiberhome',
            'ONT ZTE' => 'ont_zte',
            'ONT RAISECOM' => 'ont_raisecom',
            'ONT BDCOM' => 'ont_bdcom',
            'DW 50' => 'dw_50',
            'DW 100' => 'dw_100',
            'DW 150' => 'dw_150',
            'DW 250' => 'dw_250',
            'DW 300' => 'dw_300',
            'DW 1000' => 'dw_1000',
            'ADSS 6C' => 'adss_6c',
            'ADSS 24C' => 'adss_24c',
            'ADSS 48C' => 'adss_48c',
            'ADSS 96C' => 'adss_96c'
        ];

        // detect material id field for basecamp relation
        $mat_fields = $this->db->list_fields('material');
        $tipe_field = in_array('tipeMaterial', $mat_fields) ? 'tipeMaterial' : (in_array('tipematerial', $mat_fields)?'tipematerial':'tipeMaterial');

        // detect pemakaian table for used quantities
        $pem_candidates = ['pemakaian_material','pemakaianMaterial','pemakaianmaterial','pemakaian_materials','pemakaianmaterials'];
        $ptable = null;
        foreach ($pem_candidates as $t) { if ($this->db->table_exists($t)) { $ptable = $t; break; } }

        // Build monitoring data grouped by area
        $monitor = [];
        foreach ($data['areas'] as $area) {
            $area_data = [];
            foreach ($tipe_map as $tipe_label => $col) {
                // Get standard for this area (average or use first basecamp)
                $standard = 0;
                if ($table) {
                    $this->db->select("COALESCE(AVG(CAST(".$table.".".$col." AS UNSIGNED)),0) as avg_std", false);
                    $this->db->from($table);
                    $this->db->where('kabupaten', $area);
                    $std_row = $this->db->get()->row();
                    $standard = isset($std_row->avg_std) ? (int)$std_row->avg_std : 0;
                }
                if ($standard <= 0) continue;

                // Get total material at this area for this tipe
                $this->db->select("COALESCE(SUM(CAST(material.qty AS UNSIGNED)),0) as total_qty", false);
                $this->db->from('material');
                $this->db->join('basecamp', 'material.idBc = basecamp.idBc', 'left');
                $this->db->where('basecamp.kabupaten', $area);
                $this->db->where("UPPER(TRIM(material.".$tipe_field.")) = '".strtoupper(trim($tipe_label))."'", NULL, FALSE);
                $tot_row = $this->db->get()->row();
                $total_qty = isset($tot_row->total_qty) ? (int)$tot_row->total_qty : 0;

                // Get used material at this area for this tipe
                $used_qty = 0;
                if ($ptable) {
                    $this->db->select("COALESCE(SUM(CAST(".$ptable.".qty AS UNSIGNED)),0) as used_qty", false);
                    $this->db->from($ptable);
                    $this->db->join('basecamp', $ptable.'.idBc = basecamp.idBc', 'left');
                    $this->db->where('basecamp.kabupaten', $area);
                    $this->db->where("UPPER(TRIM(".$ptable.".tipeBarang)) = '".strtoupper(trim($tipe_label))."'", NULL, FALSE);
                    $used_row = $this->db->get()->row();
                    $used_qty = isset($used_row->used_qty) ? (int)$used_row->used_qty : 0;
                }

                $actual = $total_qty - $used_qty;
                if ($actual < 0) $actual = 0;

                $status = 'OK';
                if ($actual < $standard) {
                    $status = 'LOW';
                }

                $area_data[] = [
                    'tipe' => $tipe_label,
                    'standard' => $standard,
                    'actual' => $actual,
                    'status' => $status,
                    'percentage' => $standard > 0 ? round(($actual / $standard) * 100, 1) : 0
                ];
            }
            if (count($area_data) > 0) {
                $monitor[$area] = $area_data;
            }
        }

        $data['monitor'] = $monitor;
        $this->load->view('navbar', $title);
        $this->load->view('monitoring_area_material', $data);
    }
}
