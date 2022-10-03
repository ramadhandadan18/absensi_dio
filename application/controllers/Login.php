<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_m');
		if ($this->session->userdata('is_login')) {
			redirect('Pegawai');
		}
	}

	public function index()
	{
		$this->load->view('view_Login');
	}

	public function do_login()
	{
		$data = $this->input->post(null, true);
		$is_login = $this->Login_m->authorize($data['username'], hash('md5', $data['password']));
		if ($is_login) {
			$session_set = array(
				'is_login' => true,
				'user_id' => $is_login->id_pegawai,
				'username' => $is_login->username,
				'id_pegawai' => $is_login->id_pegawai,
				'role' => $is_login->role,
			);

			$this->session->set_userdata($session_set);
			if ($is_login->role == '1')
				redirect("Pegawai");
			else if ($is_login->role == '2')
				redirect("Absensi");
			else if ($is_login->role == '3')
				redirect("R_absensi");
			else
				redirect("Absensi");
		} else {
			$redirect = base_url() . 'Login';
			echo "<script>
			alert('Username atau password salah');
			window.location.href='$redirect';
			</script>";
		}
	}
}
