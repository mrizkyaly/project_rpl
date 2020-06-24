<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

	// Load Model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jenis_model');
		// proteksi halam admin dengan fungsi cek_lign yang ada di simple login
		$this->simple_login->cek_login();
	}

	// View Jenis
	public function index()
	{
		$jenis = $this->jenis_model->listing();

		$data = array(	'title'		=> 'Data Jenis',
						'jenis'		=> $jenis,
						'isi'		=> 'admin/jenis/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Tambah Jenis
	public function tambah()
	{
		// Validasi Input
		$valid = $this->form_validation;

		$valid->set_rules('nama_jenis','Nama_jenis','required|min_length[5]|max_length[32]|is_unique[jenis.nama_jenis]',
			array(	'required'			=>'%s harus diisi',
				  	'min_length'		=>'%s minimal 5 karakter',
				  	'max_length'		=>'%s maksimal 32 karakter',
				    'is_unique'			=>'%s sudah ada.buat jenisname baru.'));

		if($valid->run()===FALSE) {
		// end validasi

		$data = array(	'title'		=> 'Tambah Jenis',
						'isi'		=> 'admin/jenis/tambah'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);

		// Masuk database
		}else{
			$i = $this->input;
			$data = array(	'nama_jenis'		=> $i->post('nama_jenis'));
			$this->jenis_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/jenis'),'refresh');
		}
		// End Masuk Database
	}

	// edit Jenis
	public function edit($id_jenis)
	{
		$jenis = $this->jenis_model->detail($id_jenis);

		// Validasi Input
		$valid = $this->form_validation;

		$valid->set_rules('nama_jenis','Nama_jenis','required|min_length[5]|max_length[32]|is_unique[jenis.nama_jenis]',
			array(	'required'			=>'%s harus diisi',
				  	'min_length'		=>'%s minimal 6 karakter',
				  	'max_length'		=>'%s maksimal 32 karakter',
				    'is_unique'			=>'%s sudah ada.buat jenisname baru.'));

		if($valid->run()===FALSE) {
		// end validasi

		$data = array(	'title'		=> 'Edit Jenis',
						'jenis'		=>	$jenis,
						'isi'		=> 'admin/jenis/edit'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);

		// Masuk database
		}else{
			$i = $this->input;
			$data = array(	'id_jenis'			=> $id_jenis,
							'nama_jenis'		=> $i->post('nama_jenis')
						);
			$this->jenis_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/jenis'),'refresh');
		}
		// End Masuk Database
	}

	// Delete Jenis
	public function delete($id_jenis)
	{
		$data = array('id_jenis'	=> $id_jenis);
		$this->jenis_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/jenis'),'refresh');
	}
}

/* End of file Jenis.php */
/* Location: ./application/controllers/admin/Jenis.php */