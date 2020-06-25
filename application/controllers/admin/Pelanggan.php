<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	// Load Model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelanggan_model');
		// proteksi halam admin dengan fungsi cek_lign yang ada di simple login
		$this->simple_login->cek_login();
	}

	// View Pelanggan
	public function index()
	{
		$pelanggan = $this->pelanggan_model->listing();

		$data = array(	'title'		=> 'Data Pelanggan',
						'pelanggan'		=> $pelanggan,
						'isi'		=> 'admin/pelanggan/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Tambah Pelanggan
	public function tambah()
	{
		// Validasi Input
		$valid = $this->form_validation;

		$valid->set_rules('nama_pelanggan','Nama Pelanggan','required',
			array(	'required'			=>'%s harus diisi'));

		$valid->set_rules('nomor','Nomor','required',
			array(	'required'			=>'%s harus diisi'));

		$valid->set_rules('alamat','Alamat','required',
			array(	'required'			=>'%s harus diisi'));

		$valid->set_rules('username','Username','required|min_length[5]|max_length[32]|is_unique[pelanggan.username]',
			array(	'required'			=>'%s harus diisi',
				  	'min_length'		=>'%s minimal 5 karakter',
				  	'max_length'		=>'%s maksimal 32 karakter',
				    'is_unique'			=>'%s sudah ada.buat pelangganname baru.'));

		$valid->set_rules('password','Password','required',
			array(	'required'			=>'%s harus diisi'));

		if($valid->run()===FALSE) {
		// end validasi

		$data = array(	'title'		=> 'Tambah Pelanggan',
						'isi'		=> 'admin/pelanggan/tambah'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);

		// Masuk database
		}else{
			$i = $this->input;
			$data = array(	'nama_pelanggan'		=>$i->post('nama_pelanggan'),
							'nomor'					=>$i->post('nomor'),
							'alamat'				=>$i->post('alamat'),
							'username'				=>$i->post('username'),
							'password'				=>SHA1($i->post('password'))
						);
			$this->pelanggan_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/pelanggan'),'refresh');
		}
		// End Masuk Database
	}

	// edit Pelanggan
	public function edit($id_pelanggan)
	{
		$pelanggan = $this->pelanggan_model->detail($id_pelanggan);

		// Validasi Input
		$valid = $this->form_validation;

		$valid->set_rules('nama_pelanggan','Nama Pelanggan','required',
			array(	'required'			=>'%s harus diisi'));

		$valid->set_rules('nomor','Nomor','required',
			array(	'required'			=>'%s harus diisi'));

		$valid->set_rules('alamat','Alamat','required',
			array(	'required'			=>'%s harus diisi'));

		$valid->set_rules('username','Username','required|min_length[5]|max_length[32]|is_unique[pelanggan.username]',
			array(	'required'			=>'%s harus diisi',
				  	'min_length'		=>'%s minimal 5 karakter',
				  	'max_length'		=>'%s maksimal 32 karakter',
				    'is_unique'			=>'%s sudah ada.buat pelangganname baru.'));

		$valid->set_rules('password','Password','required',
			array(	'required'			=>'%s harus diisi'));

		if($valid->run()===FALSE) {
		// end validasi

		$data = array(	'title'		=> 'Edit Pelanggan',
						'pelanggan'		=>	$pelanggan,
						'isi'		=> 'admin/pelanggan/edit'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);

		// Masuk database
		}else{
			$i = $this->input;
			$data = array(	'id_pelanggan'			=>$id_pelanggan,
							'nama_pelanggan'		=>$i->post('nama_pelanggan'),
							'nomor'					=>$i->post('nomor'),
							'alamat'				=>$i->post('alamat'),
							'username'				=>$i->post('username'),
							'password'				=>SHA1($i->post('password'))
						);
			$this->pelanggan_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/pelanggan'),'refresh');
		}
		// End Masuk Database
	}

	// Delete Pelanggan
	public function delete($id_pelanggan)
	{
		$data = array('id_pelanggan'	=> $id_pelanggan);
		$this->pelanggan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/pelanggan'),'refresh');
	}
}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/admin/Pelanggan.php */