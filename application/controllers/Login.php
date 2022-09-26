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

	public function get_mac()
	{
		ob_start();

		//Getting configuration details 
		system('ipconfig /all');

		//Storing output in a variable 
		$configdata = ob_get_contents();

		// Clear the buffer  
		ob_clean();

		//Extract only the physical address or Mac address from the output
		$mac = "Physical";
		$pmac = strpos($configdata, $mac);

		// Get Physical Address  
		$macaddr = substr($configdata, ($pmac + 36), 17);

		return $macaddr;
	}

	public function do_login()
	{
		$data = $this->input->post(null, true);
		$is_login = $this->Login_m->authorize($data['username'], hash('md5', $data['password']));
		$macaddr = $this->get_mac();
		//echopre($macaddr);
		if ($is_login) {
			if ($is_login->id_pegawai == 0) {
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
				// echopre($is_login);
				if ($is_login->macaddress == $macaddr) {
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
					alert('Device anda tidak sesuai yang di daftarkan');
					window.location.href='$redirect';
					</script>";
				}
			}
		} else {
			$redirect = base_url() . 'Login';
			echo "<script>
			alert('Username atau password salah');
			window.location.href='$redirect';
			</script>";
		}
		// if ($is_login->macaddress == $macaddr || $is_login->id_pegawai == 0) {

		// 	if ($is_login) {
		// 		$session_set = array(
		// 			'is_login' => true,
		// 			'user_id' => $is_login->id_pegawai,
		// 			'username' => $is_login->username,
		// 			'id_pegawai' => $is_login->id_pegawai,
		// 			'role' => $is_login->role,
		// 		);

		// 		$this->session->set_userdata($session_set);
		// 		if ($is_login->role == '1')
		// 			redirect("Pegawai");
		// 		else if ($is_login->role == '2')
		// 			redirect("Absensi");
		// 		else if ($is_login->role == '3')
		// 			redirect("R_absensi");
		// 		else
		// 			redirect("Absensi");
		// 	} else {
		// 		$redirect = base_url() . 'Login';
		// 		echo "<script>
		// alert('Username atau password salah');
		// window.location.href='$redirect';
		// </script>";
		// 	}
		// } else {
		// 	$redirect = base_url() . 'Login';
		// 	echo "<script>
		// alert('Device anda tidak sesuai yang di daftarkan');
		// window.location.href='$redirect';
		// </script>";
		// }
	}
}
