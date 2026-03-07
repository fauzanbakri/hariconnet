<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringMaterial extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        session_start();
        $title['title'] = 'Monitoring Material';
        // load basecamp list
        $data['basecamp'] = [];
        if ($this->db->table_exists('basecamp')) {
            $this->db->select('idBc, namaAkun, sloc');
            $this->db->from('basecamp');
            $this->db->order_by('namaAkun','ASC');
            $data['basecamp'] = $this->db->get()->result();
        }

        // detect standarStok table name
        $candidates = ['standarStok','standar_stok','standarstok','standar_stoks','standarstok'];
        $table = null;
        foreach ($candidates as $t) {
            if ($this->db->table_exists($t)) { $table = $t; break; }
        }

        $standars = [];
        if ($table) {
            $rows = $this->db->from($table)->get()->result();
            foreach ($rows as $r) {
                // use idBc as key
                $key = isset($r->idBc) ? $r->idBc : (isset($r->id) ? $r->id : null);
                if ($key !== null) $standars[$key] = $r;
            }
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
        $bc_field = in_array('idBc', $mat_fields) ? 'idBc' : (in_array('idtim', $mat_fields) ? 'idtim' : null);
        // detect tipe field name
        $tipe_field = in_array('tipeMaterial', $mat_fields) ? 'tipeMaterial' : (in_array('tipematerial', $mat_fields)?'tipematerial':'tipeMaterial');
        $has_basecamp_col = in_array('basecamp', $mat_fields);
        $has_sloc_col = in_array('sloc', $mat_fields);

        // detect pemakaian table for used quantities
        $pem_candidates = ['pemakaian_material','pemakaianMaterial','pemakaianmaterial','pemakaian_materials','pemakaianmaterials'];
        $ptable = null;
        foreach ($pem_candidates as $t) { if ($this->db->table_exists($t)) { $ptable = $t; break; } }

        $monitor = [];
        $debug = $this->input->get('debug') == '1';
        foreach ($data['basecamp'] as $bc) {
            $bid = isset($bc->idBc) ? $bc->idBc : (isset($bc->id) ? $bc->id : null);
            if ($bid === null) continue;
            $items = [];
            foreach ($tipe_map as $tipe_label => $col) {
                $standard = 0;
                if (isset($standars[$bid]) && isset($standars[$bid]->$col)) {
                    $standard = (int)$standars[$bid]->$col;
                }
                if ($standard <= 0) continue; // skip as requested

                // compute actual stock at this basecamp for this tipe:
                // actual = SUM(material.qty) - SUM(pemakaian.qty)
                // total material quantity
                $this->db->select('COALESCE(SUM(material.qty),0) as total_qty', false);
                $this->db->from('material');
                if ($bc_field) $this->db->where('material.'.$bc_field, $bid);
                $this->db->where('material.'.$tipe_field, $tipe_label);
                $tot_row = $this->db->get()->row();
                $tot_sql = $this->db->last_query();
                $total_qty = isset($tot_row->total_qty) ? (int)$tot_row->total_qty : 0;

                // fallback: try matching by material.basecamp name or sloc, and normalize tipe text, if nothing found
                $used_fallback = false;
                if ($total_qty === 0 && ($has_basecamp_col || $has_sloc_col)) {
                    // try matching by basecamp name
                    if ($has_basecamp_col && !empty($bc->namaAkun)) {
                        $this->db->select('COALESCE(SUM(material.qty),0) as total_qty', false);
                        $this->db->from('material');
                        $this->db->where("UPPER(TRIM(material.basecamp)) = '".strtoupper(trim($bc->namaAkun))."'", NULL, FALSE);
                        $this->db->where("UPPER(TRIM(material.".$tipe_field.")) = '".strtoupper(trim($tipe_label))."'", NULL, FALSE);
                        $this->db->limit(1);
                        $r = $this->db->get()->row();
                        $fallback_sql = $this->db->last_query();
                        $fq = isset($r->total_qty)?(int)$r->total_qty:0;
                        if ($fq > 0) { $total_qty = $fq; $used_fallback = true; $tot_sql = $fallback_sql; }
                    }
                    // try matching by sloc
                    if (!$used_fallback && $has_sloc_col && isset($bc->sloc) && $bc->sloc !== '') {
                        $this->db->select('COALESCE(SUM(material.qty),0) as total_qty', false);
                        $this->db->from('material');
                        $this->db->where('material.sloc', $bc->sloc);
                        $this->db->where("UPPER(TRIM(material.".$tipe_field.")) = '".strtoupper(trim($tipe_label))."'", NULL, FALSE);
                        $this->db->limit(1);
                        $r2 = $this->db->get()->row();
                        $fallback_sql2 = $this->db->last_query();
                        $fq2 = isset($r2->total_qty)?(int)$r2->total_qty:0;
                        if ($fq2 > 0) { $total_qty = $fq2; $used_fallback = true; $tot_sql = $fallback_sql2; }
                    }
                }

                // total used from pemakaian table (if available)
                $total_used = 0;
                if ($ptable) {
                    $this->db->select('COALESCE(SUM('.$ptable.'.qty),0) as used', false);
                    $this->db->from($ptable);
                    $this->db->join('material', $ptable.'.idMaterial = material.idmaterial', 'inner');
                    if ($bc_field) $this->db->where('material.'.$bc_field, $bid);
                    $this->db->where('material.'.$tipe_field, $tipe_label);
                    $usedRow = $this->db->get()->row();
                    $used_sql = $this->db->last_query();
                    $total_used = isset($usedRow->used) ? (int)$usedRow->used : 0;
                    // fallback for pemakaian: if used==0, try joining with basecamp name / sloc
                    if ($total_used === 0 && ($has_basecamp_col || $has_sloc_col)) {
                        if ($has_basecamp_col && !empty($bc->namaAkun)) {
                            $this->db->select('COALESCE(SUM('.$ptable.'.qty),0) as used', false);
                            $this->db->from($ptable);
                            $this->db->join('material', $ptable.'.idMaterial = material.idmaterial', 'inner');
                            $this->db->where("UPPER(TRIM(material.basecamp)) = '".strtoupper(trim($bc->namaAkun))."'", NULL, FALSE);
                            $this->db->where("UPPER(TRIM(material.".$tipe_field.")) = '".strtoupper(trim($tipe_label))."'", NULL, FALSE);
                            $rused = $this->db->get()->row();
                            $used_sql2 = $this->db->last_query();
                            $tu = isset($rused->used)?(int)$rused->used:0;
                            if ($tu > 0) { $total_used = $tu; $used_sql = $used_sql2; }
                        }
                        if ($total_used === 0 && $has_sloc_col && isset($bc->sloc) && $bc->sloc !== '') {
                            $this->db->select('COALESCE(SUM('.$ptable.'.qty),0) as used', false);
                            $this->db->from($ptable);
                            $this->db->join('material', $ptable.'.idMaterial = material.idmaterial', 'inner');
                            $this->db->where('material.sloc', $bc->sloc);
                            $this->db->where("UPPER(TRIM(material.".$tipe_field.")) = '".strtoupper(trim($tipe_label))."'", NULL, FALSE);
                            $rused2 = $this->db->get()->row();
                            $used_sql3 = $this->db->last_query();
                            $tu2 = isset($rused2->used)?(int)$rused2->used:0;
                            if ($tu2 > 0) { $total_used = $tu2; $used_sql = $used_sql3; }
                        }
                    }
                }

                // debug samples
                $materials_sample = [];
                $pemakaian_sample = [];
                if ($debug) {
                    $this->db->select('material.*');
                    $this->db->from('material');
                    if ($bc_field) $this->db->where('material.'.$bc_field, $bid);
                    $this->db->where('material.'.$tipe_field, $tipe_label);
                    $this->db->limit(10);
                    $materials_sample = $this->db->get()->result();

                    if ($ptable) {
                        $this->db->select($ptable.'.*, material.kode_material, material.idmaterial');
                        $this->db->from($ptable);
                        $this->db->join('material', $ptable.'.idMaterial = material.idmaterial', 'inner');
                        if ($bc_field) $this->db->where('material.'.$bc_field, $bid);
                        $this->db->where('material.'.$tipe_field, $tipe_label);
                        $this->db->limit(10);
                        $pemakaian_sample = $this->db->get()->result();
                        $pemakaian_sql = $this->db->last_query();
                    }
                }

                if ($debug) {
                    $log = "[".date('c')."] basecamp=".$bid." tipe=".str_replace("\n"," ",$tipe_label)." total_qty=".$total_qty." total_used=".$total_used.PHP_EOL;
                    $log .= "SQL_TOTAL: ".trim(preg_replace('/\s+/', ' ', $tot_sql)).PHP_EOL;
                    if (isset($used_sql)) $log .= "SQL_USED: ".trim(preg_replace('/\s+/', ' ', $used_sql)).PHP_EOL;
                    if (isset($pemakaian_sql)) $log .= "SQL_PEMAKAIAN_SAMPLE: ".trim(preg_replace('/\s+/', ' ', $pemakaian_sql)).PHP_EOL;
                    $log .= "MATERIAL_SAMPLE_COUNT: ".count($materials_sample)." PEMAKAIAN_SAMPLE_COUNT: ".count($pemakaian_sample).PHP_EOL;
                    $log .= "---\n";
                    @file_put_contents('/tmp/monitor_debug.log', $log, FILE_APPEND | LOCK_EX);
                    // also write to application logs so hosted environments without /tmp access can read it via File Manager / FTP
                    $app_log = APPPATH . 'logs' . DIRECTORY_SEPARATOR . 'monitor_debug.log';
                    @file_put_contents($app_log, $log, FILE_APPEND | LOCK_EX);
                }

                $actual = $total_qty - $total_used;
                if ($actual < 0) $actual = 0;

                // determine status
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
                    'materials_sample' => $materials_sample,
                    'pemakaian_sample' => $pemakaian_sample,
                    'actual' => $actual,
                    'status' => $status
                ];
            }
            $monitor[] = [
                'idBc' => $bid,
                'nama' => isset($bc->namaAkun)?$bc->namaAkun:(isset($bc->nama)?$bc->nama:''),
                'sloc' => isset($bc->sloc)?$bc->sloc:'',
                'items' => $items
            ];
        }

        $data['monitor'] = $monitor;

        $this->load->view('navbar', $title);
        $this->load->view('monitoring_material', $data);
    }
}
