<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemakaianMaterial extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Resolve the pemakaian table name in DB. Try common variants.
     * Returns table name string or false if not found.
     */
    private function get_pemakaian_table()
    {
        $candidates = [
            'pemakaian_material',
            'pemakaianMaterial',
            'pemakaianmaterial',
            'pemakaian_materials',
            'pemakaianmaterials'
        ];
        foreach ($candidates as $t) {
            if ($this->db->table_exists($t)) return $t;
        }
        return false;
    }

    public function index()
    {
        session_start();
        // load data for view
        $data = [];
        $title['title']="Pemakaian Material";
        // materials for lookup
        $data['materials'] = $this->db->get('material')->result();
        // basecamp list (if table exists) for filtering by basecamp
        if ($this->db->table_exists('basecamp')) {
            $data['basecamp'] = $this->db->get('basecamp')->result();
        } else {
            $data['basecamp'] = [];
        }

        // filters from query params
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $filter_material = $this->input->get('idmaterial');
        // support filtering by basecamp id (idbc) as well
        $filter_basecamp = $this->input->get('idbc') ?: $this->input->get('idBc');

        $data['usages'] = [];
        $ptable = $this->get_pemakaian_table();
        if ($ptable) {
            // Select usages and join material and either tim or basecamp to get kode_material and team/basecamp nama
            $material_fields = $this->db->list_fields('material');
            if (in_array('idBc', $material_fields) && $this->db->table_exists('basecamp')) {
                // select kode_material, kode_material_terpakai, sn (original), sn_terpakai (used), and basecamp name
                $this->db->select("{$ptable}.*, material.kode_material, material.kode_material_terpakai, material.sn as sn_original, material.sn_terpakai, b.namaAkun as nama");
            } else {
                $this->db->select("{$ptable}.*, material.kode_material, material.kode_material_terpakai, material.sn as sn_original, material.sn_terpakai, tim.nama as nama");
            }
            $this->db->from($ptable);
            $this->db->join('material', "{$ptable}.idMaterial = material.idmaterial", 'left');
            if (in_array('idBc', $material_fields) && $this->db->table_exists('basecamp')) {
                $this->db->join('basecamp b', 'material.idBc = b.idBc', 'left');
            } else {
                $this->db->join('tim', 'material.idtim = tim.idTim', 'left');
            }

            if ($start_date) {
                $this->db->where("DATE({$ptable}.tanggal) >=", $start_date);
            }
            if ($end_date) {
                $this->db->where("DATE({$ptable}.tanggal) <=", $end_date);
            }
            if ($filter_material) {
                $this->db->where("{$ptable}.idMaterial", $filter_material);
            }
            // if user filtered by basecamp, apply filter on material.idBc (or material.idtim if legacy)
            if ($filter_basecamp) {
                $material_fields = $this->db->list_fields('material');
                if (in_array('idBc', $material_fields)) {
                    $this->db->where('material.idBc', $filter_basecamp);
                } elseif (in_array('idtim', $material_fields)) {
                    // try to match with tim id if basecamp passed a tim id instead
                    $this->db->where('material.idtim', $filter_basecamp);
                }
            }
            $this->db->order_by("{$ptable}.tanggal", 'DESC');
            $data['usages'] = $this->db->get()->result();
        }
        $this->load->view('navbar', $title);
        $this->load->view('pemakaian_material', $data);
    }

    public function insert()
    {
        // Expect POST: idmaterial, tanggal_penggunaan, incident, qty_terpakai, kode_material_terpakai, sn_terpakai
        $idmaterial = $this->input->post('idmaterial');
        $tanggal = $this->input->post('tanggal_penggunaan');
        $incident = $this->input->post('incident');
        $qty = $this->input->post('qty_terpakai');
        $kode_terpakai = $this->input->post('kode_material_terpakai');
        $sn_terpakai = $this->input->post('sn_terpakai');

        if (!$idmaterial || !$tanggal || !$qty) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
            return;
        }

        // incident is required
        if (!$incident || trim($incident) === '') {
            echo json_encode(['status' => 'error', 'message' => 'Incident wajib diisi']);
            return;
        }

        $qty = (int)$qty;

        // check available quantity for material
        $ptable = $this->get_pemakaian_table();
        if (!$ptable) {
            echo json_encode(['status' => 'error', 'message' => 'Table pemakaian material tidak ditemukan in database']);
            return;
        }

        $mat = $this->db->get_where('material', ['idmaterial' => $idmaterial])->row();
        if (!$mat) {
            echo json_encode(['status' => 'error', 'message' => 'Material tidak ditemukan']);
            return;
        }

        $this->db->select('SUM(qty) as used');
        $this->db->from($ptable);
        $this->db->where('idMaterial', $idmaterial);
        $usedRow = $this->db->get()->row();
        $used = isset($usedRow->used) ? (int)$usedRow->used : 0;
        $available = (int)$mat->qty - $used;
        if ($available < 0) $available = 0;

        if ($qty > $available) {
            echo json_encode(['status' => 'error', 'message' => 'QTY terpakai melebihi tersedia ('.$available.')']);
            return;
        }

        // insert into pemakaian_material (create table beforehand if needed)
        // table uses columns: idPemakaianMaterial, idMaterial, incident, tanggal, qty
        $insert = [
            'idMaterial' => $idmaterial,
            'tanggal' => $tanggal,
            'incident' => $incident,
            'qty' => $qty
        ];
        // insert after validations
        $this->db->insert($ptable, $insert);

        // update material record with kode/sn terpakai if provided
        $update = [];
        if ($kode_terpakai) $update['kode_material_terpakai'] = $kode_terpakai;
        if ($sn_terpakai) $update['sn_terpakai'] = $sn_terpakai;
        if (!empty($update)) {
            $this->db->where('idmaterial', $idmaterial)->update('material', $update);
        }

        echo json_encode(['status' => 'success']);
    }

    /**
     * Update priority for a usage row
     * Expects POST: id, id_field, priority
     */
    public function updatePriority()
    {
        $id = $this->input->post('id');
        $id_field = $this->input->post('id_field');
        $priority = $this->input->post('priority');

        if (!$id || !$id_field) {
            echo json_encode(['status' => 'error', 'message' => 'Missing id or id_field']);
            return;
        }

        $ptable = $this->get_pemakaian_table();
        if (!$ptable) {
            echo json_encode(['status' => 'error', 'message' => 'Pemakaian table not found']);
            return;
        }

        // ensure id_field exists in the table
        $fields = $this->db->list_fields($ptable);
        if (!in_array($id_field, $fields)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid id_field']);
            return;
        }

        // add priority column if it doesn't exist? we'll refuse and return error
        if (!in_array('priority', $fields)) {
            echo json_encode(['status' => 'error', 'message' => 'Column `priority` not found in pemakaian table']);
            return;
        }

        $this->db->where($id_field, $id);
        $ok = $this->db->update($ptable, ['priority' => $priority]);
        if ($ok) echo json_encode(['status' => 'success']);
        else echo json_encode(['status' => 'error', 'message' => 'Failed to update']);
    }

    /**
     * Delete a pemakaian usage row
     * Accepts GET or POST: id and id_field
     */
    public function deleteUsage()
    {
        $id = $this->input->get_post('id');
        $id_field = $this->input->get_post('id_field');

        if (!$id || !$id_field) {
            echo json_encode(['status' => 'error', 'message' => 'Missing id or id_field']);
            return;
        }

        $ptable = $this->get_pemakaian_table();
        if (!$ptable) {
            echo json_encode(['status' => 'error', 'message' => 'Pemakaian table not found']);
            return;
        }

        $fields = $this->db->list_fields($ptable);
        if (!in_array($id_field, $fields)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid id_field']);
            return;
        }

        $this->db->where($id_field, $id);
        $ok = $this->db->delete($ptable);
        if ($ok) echo json_encode(['status' => 'success']);
        else echo json_encode(['status' => 'error', 'message' => 'Failed to delete']);
    }
}
