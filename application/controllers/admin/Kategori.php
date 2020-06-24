<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	// Load Model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kategori_model');
		// proteksi halam admin dengan fungsi cek_lign yang ada di simple login
		$this->simple_login->cek_login();
	}

	// View Kategori
	public function index()
	{
		$kategori = $this->kategori_model->listing();

		$data = array(	'title'		=> 'Data Kategori',
						'kategori'		=> $kategori,
						'isi'		=> 'admin/kategori/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Tambah Kategori
	public function tambah()
	{
		// Validasi Input
		$valid = $this->form_validation;

		$valid->set_rules('nama_kategori','Nama_kategori','required|min_length[5]|max_length[32]|is_unique[kategori.nama_kategori]',
			array(	'required'			=>'%s harus diisi',
				  	'min_length'		=>'%s minimal 5 karakter',
				  	'max_length'		=>'%s maksimal 32 karakter',
				    'is_unique'			=>'%s sudah ada.buat kategoriname baru.'));

		if($valid->run()===FALSE) {
		// end validasi

		$data = array(	'title'		=> 'Tambah Kategori',
						'isi'		=> 'admin/kategori/tambah'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);

		// Masuk database
		}else{
			$i = $this->input;
			$data = array(	'nama_kategori'			=> $i->post('nama_kategori'));
			$this->kategori_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/kategori'),'refresh');
		}
		// End Masuk Database
	}

	// edit Kategori
	public function edit($id_kategori)
	{
		$kategori = $this->kategori_model->detail($id_kategori);

		// Validasi Input
		$valid = $this->form_validation;

		$valid->set_rules('nama_kategori','Nama_kategori','required|min_length[5]|max_length[32]|is_unique[kategori.nama_kategori]',
			array(	'required'			=>'%s harus diisi',
				  	'min_length'		=>'%s minimal 6 karakter',
				  	'max_length'		=>'%s maksimal 32 karakter',
				    'is_unique'			=>'%s sudah ada.buat kategoriname baru.'));

		if($valid->run()===FALSE) {
		// end validasi

		$data = array(	'title'		=> 'Edit Kategori',
						'kategori'		=>	$kategori,
						'isi'		=> 'admin/kategori/edit'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);

		// Masuk database
		}else{
			$i = $this->input;
			$data = array(	'id_kategori'			=>$id_kategori,
							'nama_kategori'			=>$i->post('nama_kategori')
						);
			$this->kategori_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/kategori'),'refresh');
		}
		// End Masuk Database
	}

	// Delete Kategori
	public function delete($id_kategori)
	{
		$data = array('id_kategori'	=> $id_kategori);
		$this->kategori_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/kategori'),'refresh');
	}
}

/* End of file Kategori.php */
/* Location: ./application/controllers/admin/Kategori.php */