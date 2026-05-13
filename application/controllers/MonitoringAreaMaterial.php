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

        $data['groups'] = [];
        if ($this->db->table_exists('basecamp')) {
            $this->db->select('idBc, namaAkun, sloc, kabupaten');
            $this->db->from('basecamp');
            $this->db->order_by('kabupaten', 'ASC');
            $basecamps = $this->db->get()->result();

            foreach ($basecamps as $bc) {
                $kabupaten = trim((string)($bc->kabupaten ?? ''));
                if ($kabupaten === '') {
                    $kabupaten = '(Tidak Diketahui)';
                }
                $id = isset($bc->idBc) ? $bc->idBc : (isset($bc->id) ? $bc->id : null);
                if ($id === null) {
                    continue;
                }
                if (!isset($data['groups'][$kabupaten])) {
                    $data['groups'][$kabupaten] = [
                        'kabupaten' => $kabupaten,
                        'basecamps' => []
                    ];
                }
                $data['groups'][$kabupaten]['basecamps'][] = $bc;
            }
        }

        $candidates = ['standarStok','standar_stok','standarstok','standar_stoks','standarstok'];
        $table = null;
        foreach ($candidates as $t) {
            if ($this->db->table_exists($t)) { $table = $t; break; }
        }

        $standars = [];
        if ($table) {
            $rows = $this->db->from($table)->get()->result();
            foreach ($rows as $r) {
                $key = isset($r->idBc) ? $r->idBc : (isset($r->id) ? $r->id : null);
                if ($key !== null) {
                    $standars[$key] = $r;
                }
            }
        }

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

        $mat_fields = $this->db->list_fields('material');
        $bc_field = in_array('idBc', $mat_fields, true) ? 'idBc' : (in_array('idtim', $mat_fields, true) ? 'idtim' : null);
        $tipe_field = in_array('tipeMaterial', $mat_fields, true) ? 'tipeMaterial' : (in_array('tipematerial', $mat_fields, true) ? 'tipematerial' : 'tipeMaterial');
        $has_basecamp_col = in_array('basecamp', $mat_fields, true);
        $has_sloc_col = in_array('sloc', $mat_fields, true);

        $pem_candidates = ['pemakaian_material','pemakaianMaterial','pemakaianmaterial','pemakaian_materials','pemakaianmaterials'];
        $ptable = null;
        foreach ($pem_candidates as $t) {
            if ($this->db->table_exists($t)) { $ptable = $t; break; }
        }

        $monitor = [];
        foreach ($data['groups'] as $group) {
            $group_ids = array_map(function($bc){ return isset($bc->idBc) ? $bc->idBc : (isset($bc->id) ? $bc->id : null); }, $group['basecamps']);
            $group_ids = array_filter($group_ids, function($v){ return $v !== null && $v !== ''; });
            $group_basecamp_names = array_values(array_filter(array_map(function($bc){ return trim((string)($bc->namaAkun ?? '')); }, $group['basecamps']), function($v){ return $v !== ''; }));
            $group_slocs = array_values(array_filter(array_map(function($bc){ return trim((string)($bc->sloc ?? '')); }, $group['basecamps']), function($v){ return $v !== ''; }));

            $items = [];
            foreach ($tipe_map as $tipe_label => $col) {
                $standard = 0;
                foreach ($group_ids as $bid) {
                    if (isset($standars[$bid]) && isset($standars[$bid]->$col)) {
                        $standard += (int)$standars[$bid]->$col;
                    }
                }
                if ($standard <= 0) {
                    continue;
                }

                $this->db->select('COALESCE(SUM(CAST(material.qty AS UNSIGNED)),0) as total_qty', false);
                $this->db->from('material');
                if ($bc_field && !empty($group_ids)) {
                    $this->db->where_in('material.'.$bc_field, $group_ids);
                }
                $this->db->where("UPPER(TRIM(material.".$tipe_field.")) = '".strtoupper(trim($tipe_label))."'", NULL, FALSE);
                $tot_row = $this->db->get()->row();
                $total_qty = isset($tot_row->total_qty) ? (int)$tot_row->total_qty : 0;

                if ($total_qty === 0 && ($has_basecamp_col || $has_sloc_col)) {
                    if ($has_basecamp_col && !empty($group_basecamp_names)) {
                        $this->db->select('COALESCE(SUM(CAST(material.qty AS UNSIGNED)),0) as total_qty', false);
                        $this->db->from('material');
                        $where_clauses = array_map(function($name){ return "UPPER(TRIM(material.basecamp)) = '".strtoupper(trim($name))."'"; }, $group_basecamp_names);
                        $this->db->where('('.implode(' OR ', $where_clauses).')', NULL, FALSE);
                        $this->db->where("UPPER(TRIM(material.".$tipe_field.")) = '".strtoupper(trim($tipe_label))."'", NULL, FALSE);
                        $tot_row = $this->db->get()->row();
                        $total_qty = isset($tot_row->total_qty) ? (int)$tot_row->total_qty : 0;
                    }
                    if ($total_qty === 0 && $has_sloc_col && !empty($group_slocs)) {
                        $this->db->select('COALESCE(SUM(CAST(material.qty AS UNSIGNED)),0) as total_qty', false);
                        $this->db->from('material');
                        $this->db->where_in('material.sloc', $group_slocs);
                        $this->db->where("UPPER(TRIM(material.".$tipe_field.")) = '".strtoupper(trim($tipe_label))."'", NULL, FALSE);
                        $tot_row = $this->db->get()->row();
                        $total_qty = isset($tot_row->total_qty) ? (int)$tot_row->total_qty : 0;
                    }
                }

                $total_used = 0;
                if ($ptable) {
                    $this->db->select('COALESCE(SUM(CAST('.$ptable.'.qty AS UNSIGNED)),0) as used', false);
                    $this->db->from($ptable);
                    $this->db->join('material', $ptable.'.idMaterial = material.idmaterial', 'inner');
                    if ($bc_field && !empty($group_ids)) {
                        $this->db->where_in('material.'.$bc_field, $group_ids);
                    }
                    $this->db->where("UPPER(TRIM(material.".$tipe_field.")) = '".strtoupper(trim($tipe_label))."'", NULL, FALSE);
                    $usedRow = $this->db->get()->row();
                    $total_used = isset($usedRow->used) ? (int)$usedRow->used : 0;

                    if ($total_used === 0 && ($has_basecamp_col || $has_sloc_col)) {
                        if ($has_basecamp_col && !empty($group_basecamp_names)) {
                            $this->db->select('COALESCE(SUM(CAST('.$ptable.'.qty AS UNSIGNED)),0) as used', false);
                            $this->db->from($ptable);
                            $this->db->join('material', $ptable.'.idMaterial = material.idmaterial', 'inner');
                            $where_clauses = array_map(function($name){ return "UPPER(TRIM(material.basecamp)) = '".strtoupper(trim($name))."'"; }, $group_basecamp_names);
                            $this->db->where('('.implode(' OR ', $where_clauses).')', NULL, FALSE);
                            $this->db->where("UPPER(TRIM(material.".$tipe_field.")) = '".strtoupper(trim($tipe_label))."'", NULL, FALSE);
                            $usedRow = $this->db->get()->row();
                            $total_used = isset($usedRow->used) ? (int)$usedRow->used : 0;
                        }
                        if ($total_used === 0 && $has_sloc_col && !empty($group_slocs)) {
                            $this->db->select('COALESCE(SUM(CAST('.$ptable.'.qty AS UNSIGNED)),0) as used', false);
                            $this->db->from($ptable);
                            $this->db->join('material', $ptable.'.idMaterial = material.idmaterial', 'inner');
                            $this->db->where_in('material.sloc', $group_slocs);
                            $this->db->where("UPPER(TRIM(material.".$tipe_field.")) = '".strtoupper(trim($tipe_label))."'", NULL, FALSE);
                            $usedRow = $this->db->get()->row();
                            $total_used = isset($usedRow->used) ? (int)$usedRow->used : 0;
                        }
                    }
                }

                $actual = $total_qty - $total_used;
                if ($actual < 0) {
                    $actual = 0;
                }

                if ($actual < $standard) {
                    $status = 'red';
                } elseif ($actual == $standard || $actual == ($standard + 1)) {
                    $status = 'yellow';
                } else {
                    $status = 'green';
                }

                $items[] = [
                    'tipe' => $tipe_label,
                    'standard' => $standard,
                    'total_qty' => $total_qty,
                    'total_used' => $total_used,
                    'actual' => $actual,
                    'status' => $status
                ];
            }

            $monitor[] = [
                'kabupaten' => $group['kabupaten'],
                'basecamp_count' => count($group['basecamps']),
                'items' => $items
            ];
        }

        $data['monitor'] = $monitor;

        $this->load->view('navbar', $title);
        $this->load->view('monitoring_area_material', $data);
    }
}
