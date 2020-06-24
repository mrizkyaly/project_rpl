<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// View all jenis
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('jenis');
		$this->db->order_by('id_jenis', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail jenis
	public function detail($id_jenis)
	{
		$this->db->select('*');
		$this->db->from('jenis');
		$this->db->where('id_jenis', $id_jenis);
		$this->db->order_by('id_jenis', 'asc');
		$query = $this->db->get();
		return $query->row();
	}

	// tambah data jenis
	public function tambah($data)
	{
		$this->db->insert('jenis', $data);
	}

	// edit data
	public function edit($data)
	{
		$this->db->where('id_jenis', $data['id_jenis']);
		$this->db->update('jenis',$data);
	}

	// Delete data jenis
	public function delete($data)
	{
		$this->db->where('id_jenis', $data['id_jenis']);
		$this->db->delete('jenis',$data);
	}
}

/* End of file Jenis_model.php */
/* Location: ./application/models/Jenis_model.php */