<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_login
{
	protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
        // Load data model user
        $this->CI->load->model('pelanggan_model');
	}

	// Fugnsi Login
	public function login($username,$password)
	{
		$check = $this->CI->pelanggan_model->login($username,$password);
		// Jika ada data user,Maka create session
		if ($check) {
			$id_pelanggan		= $check->id_pelanggan;
			$nama_pelanggan		= $check->nama_pelanggan;
			// create session
			$this->CI->session->set_userdata('id_pelanggan',$id_pelanggan);
			$this->CI->session->set_userdata('nama_pelanggan',$nama_pelanggan);
			$this->CI->session->set_userdata('username',$username);
			// Redirect ke halaman admin yang diproteksi
			redirect(base_url('pelanggan/transaksi'),'refresh');
		}else{
			// Kalau tidak ada user maka atau username passwotd salah
			$this->CI->session->set_flashdata('warning','Username atau password salah');
			redirect(base_url('loginpelanggan'),'refresh');
		}
	}

	// fungsi cek login
	public function cek_login()
	{
		// Memeriksa apakah session sudah atau belum jika belum silahkan ke halaman login
		if ($this->CI->session->userdata('username') == "") {
			$this->CI->session->set_flashdata('warning','Anda belum login');
			redirect(base_url('loginpelanggan'),'refresh');
		}
	}

	// fungsi cek login
	public function logout()
	{
		// Membuanf semua session yang sudah diset pada saat login
		$this->CI->session->unset_userdata('id_pelanggan');
		$this->CI->session->unset_userdata('nama_pelanggan');
		$this->CI->session->unset_userdata('username');
		// Setelah session dibuang,makaa ridirect ke login
		$this->CI->session->set_flashdata('sukses','Anda berhasil logout');
		redirect(base_url('loginpelanggan'),'refresh');
	}


}

/* End of file Pelanggan_login.php */
/* Location: ./application/libraries/Pelanggan_login.php */
