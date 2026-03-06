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
		$this->db->select('m.*, t.nama');
		$this->db->from('material m');
		$this->db->join('tim t', 'm.idtim = t.idTim', 'left');
		$this->db->order_by('m.idmaterial', 'DESC');
		return $this->db->get()->result();
	}

	/**
	 * Get materials by filters
	 */
	public function get_materials_filtered($start_date = null, $end_date = null, $status_reservasi = null, $status_terpakai = null, $status_pengiriman = null)
	{
		$this->db->select('m.*, t.nama');
		$this->db->from('material m');
		$this->db->join('tim t', 'm.idtim = t.idTim', 'left');

		if ($start_date && $end_date) {
			$this->db->where('DATE(m.tanggal) >=', $start_date);
			$this->db->where('DATE(m.tanggal) <=', $end_date);
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

		$this->db->order_by('m.idmaterial', 'DESC');
		return $this->db->get()->result();
	}

	/**
	 * Get material by ID
	 */
	public function get_material_by_id($id)
	{
		$this->db->select('m.*, t.nama');
		$this->db->from('material m');
		$this->db->join('tim t', 'm.idtim = t.idTim', 'left');
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
