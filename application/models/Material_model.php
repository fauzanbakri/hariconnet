<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Get all materials with tim data
	 */
	public function get_all_materials()
	{
		// Detect if material table uses idBc and basecamp table exists
		$material_fields = $this->db->list_fields('material');
		$select_extra = '';
		$join_table = '';
		if (in_array('idBc', $material_fields) && $this->db->table_exists('basecamp')) {
			// alias idBc to idtim so views/controllers expecting idtim keep working
			$select_extra = 'm.idBc as idtim, b.namaAkun as nama';
			$join_table = 'LEFT JOIN basecamp b ON m.idBc = b.idBc';
		} else {
			$select_extra = 't.nama';
			$join_table = 'LEFT JOIN tim t ON m.idtim = t.idTim';
		}

		$this->db->select('m.*' . ( $select_extra ? ', ' . $select_extra : '' ));
		$this->db->from('material m');
		if (in_array('idBc', $material_fields) && $this->db->table_exists('basecamp')) {
			$this->db->join('basecamp b', 'm.idBc = b.idBc', 'left');
		} else {
			$this->db->join('tim t', 'm.idtim = t.idTim', 'left');
		}
		$this->db->order_by('m.idmaterial', 'DESC');
		return $this->db->get()->result();
	}

	/**
	 * Get materials by filters
	 */
	public function get_materials_filtered($start_date = null, $end_date = null, $status_reservasi = null, $status_terpakai = null, $status_pengiriman = null, $filter_tim = null, $filter_kategori = null)
	{
		$material_fields = $this->db->list_fields('material');
		if (in_array('idBc', $material_fields) && $this->db->table_exists('basecamp')) {
			$select_extra = 'm.idBc as idtim, b.namaAkun as nama';
			$join_table = 'LEFT JOIN basecamp b ON m.idBc = b.idBc';
		} else {
			$select_extra = 't.nama';
			$join_table = 'LEFT JOIN tim t ON m.idtim = t.idTim';
		}

		$this->db->select('m.*' . ( $select_extra ? ', ' . $select_extra : '' ));
		$this->db->from('material m');
		if (in_array('idBc', $material_fields) && $this->db->table_exists('basecamp')) {
			$this->db->join('basecamp b', 'm.idBc = b.idBc', 'left');
		} else {
			$this->db->join('tim t', 'm.idtim = t.idTim', 'left');
		}

		if ($start_date && $end_date) {
			$this->db->where('DATE(m.tanggal) >=', $start_date);
			$this->db->where('DATE(m.tanggal) <=', $end_date);
		}

		// filter by tim/basecamp if provided
		if ($filter_tim !== null && $filter_tim !== '') {
			$material_fields = $this->db->list_fields('material');
			if (in_array('idBc', $material_fields) && $this->db->table_exists('basecamp')) {
				$this->db->where('m.idBc', $filter_tim);
			} else {
				$this->db->where('m.idtim', $filter_tim);
			}
		}

		if ($status_reservasi) {
			$this->db->where('m.status_reservasi', $status_reservasi);
		}

		if ($status_terpakai) {
			$this->db->where('m.status_terpakai', $status_terpakai);
		}

		if ($status_pengiriman) {
			$this->db->where('m.status_pengiriman', $status_pengiriman);
		}

		// filter by kategori if provided (FOC/FOT)
		if ($filter_kategori !== null && $filter_kategori !== '') {
			$this->db->where('m.kategori', $filter_kategori);
		}

		$this->db->order_by('m.idmaterial', 'DESC');
		return $this->db->get()->result();
	}

	/**
	 * Get material by ID
	 */
	public function get_material_by_id($id)
	{
		$material_fields = $this->db->list_fields('material');
		if (in_array('idBc', $material_fields) && $this->db->table_exists('basecamp')) {
			$select_extra = 'm.idBc as idtim, b.namaAkun as nama';
			$join_table = 'LEFT JOIN basecamp b ON m.idBc = b.idBc';
		} else {
			$select_extra = 't.nama';
			$join_table = 'LEFT JOIN tim t ON m.idtim = t.idTim';
		}

		$this->db->select('m.*' . ( $select_extra ? ', ' . $select_extra : '' ));
		$this->db->from('material m');
		if (in_array('idBc', $material_fields) && $this->db->table_exists('basecamp')) {
			$this->db->join('basecamp b', 'm.idBc = b.idBc', 'left');
		} else {
			$this->db->join('tim t', 'm.idtim = t.idTim', 'left');
		}
		$this->db->where('m.idmaterial', $id);
		return $this->db->get()->row();
	}

	/**
	 * Insert material
	 */
	public function insert_material($data)
	{
		$data = $this->filter_material_fields($data);
		return $this->db->insert('material', $data);
	}

	/**
	 * Update material
	 */
	public function update_material($id, $data)
	{
		$data = $this->filter_material_fields($data);
		$this->db->where('idmaterial', $id);
		return $this->db->update('material', $data);
	}

	/**
	 * Filter input array to only include columns that exist in `material` table
	 */
	private function filter_material_fields($data)
	{
		$fields = $this->db->list_fields('material');
		if (!is_array($data)) return [];
		$allowed = array_flip($fields);
		return array_intersect_key($data, $allowed);
	}

	/**
	 * Delete material
	 */
	public function delete_material($id)
	{
		$this->db->where('idmaterial', $id);
		return $this->db->delete('material');
	}

	/**
	 * Get all tim
	 */
	public function get_all_tim()
	{
		// If basecamp table exists, return its rows mapped to idTim/nama for compatibility
		if ($this->db->table_exists('basecamp')) {
			$rows = $this->db->select('idBc, namaAkun')->order_by('namaAkun','ASC')->get('basecamp')->result();
			// map to expected properties
			$result = [];
			foreach ($rows as $r) {
				$item = new stdClass();
				$item->idTim = $r->idBc;
				$item->nama = $r->namaAkun;
				$result[] = $item;
			}
			return $result;
		}
		return $this->db->get('tim')->result();
	}

	/**
	 * Get unique status reservasi
	 */
	public function get_status_reservasi()
	{
		$this->db->select('DISTINCT status_reservasi');
		$this->db->from('material');
		$this->db->where('status_reservasi !=', '');
		return $this->db->get()->result();
	}

	/**
	 * Get unique status terpakai
	 */
	public function get_status_terpakai()
	{
		$this->db->distinct();
		$this->db->select('status_terpakai');
		$this->db->from('material');
		$this->db->where('status_terpakai !=', '');
		return $this->db->get()->result();
	}

	/**
	 * Get unique status pengiriman
	 */
	public function get_status_pengiriman()
	{
		$this->db->distinct();
		$this->db->select('status_pengiriman');
		$this->db->from('material');
		$this->db->where('status_pengiriman !=', '');
		return $this->db->get()->result();
	}
}
