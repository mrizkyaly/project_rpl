<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pelanggan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// View all pelanggan
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->order_by('id_pelanggan', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail pelanggan
	public function detail($id_pelanggan)
	{
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->order_by('id_pelanggan', 'asc');
		$query = $this->db->get();
		return $query->row();
	}

	// login pealnggan
	public function login($username,$password)
	{
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->where(array( 'username'	=> $username,
								'password'	=> SHA1($password)));
		$this->db->order_by('id_pelanggan', 'asc');
		$query = $this->db->get();
		return $query->row();
	}
	
	// tambah data pelanggan
	public function tambah($data)
	{
		$this->db->insert('pelanggan', $data);
	}

	// edit data
	public function edit($data)
	{
		$this->db->where('id_pelanggan', $data['id_pelanggan']);
		$this->db->update('pelanggan',$data);
	}

	// Delete data pelanggan
	public function delete($data)
	{
		$this->db->where('id_pelanggan', $data['id_pelanggan']);
		$this->db->delete('pelanggan',$data);
	}
}

/* End of file pelanggan_model.php */
/* Location: ./application/models/pelanggan_model.php */