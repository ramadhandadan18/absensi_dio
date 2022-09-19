<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile_mo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profile_mo_m');
        if (!$this->session->userdata('is_login') == true) {
            redirect('login');
        }
    }

    public function index()
    {
        $this->load->view('mobile/header');
        $this->load->view('mobile/header');
        $username = $_SESSION['username'];
        $my_data = $this->Profile_mo_m->get_my_data($username);
        $id_pegawai = $my_data[0]['id_pegawai'];
        $data['my_nip'] = $my_data[0]['no_pegawai'];
        $data['my_name'] = $my_data[0]['nama_pegawai'];
        $data['my_email'] = $my_data[0]['email'];

        $this->load->view('mobile/view_Profile', $data);
        for ($a = 0; $a <= 4; $a++) {
            $fill['bar_fill_' . $a] = 'currentColor';
            $fill['bar_text_' . $a] = '';
        }
        $fill['bar_fill_3'] = 'white';
        $fill['bar_text_3'] = 'white';
        $this->load->view('mobile/footer', $fill);
    }

    public function get_data_user()
    {

        $user = $this->Profile_mo_m->get_data_user();
        foreach ($user as $key => $value) {
            $data['id'] = $value['id'];
            $data['username'] = $value['username'];
            $data['password'] = '';
            $data['id_pegawai'] = $value['id_pegawai'];
            $data['role'] = $value['role'];
        }
        // echopre($data);
        // die;
        $data_obj = (object)$data;
        echo json_encode($data_obj);
    }

    public function save_edit()
    {
        // echopre($_POST);
        // die;
        $id_edit = $_POST['id_edit'];
        $data = array(
            'password' => hash('md5', $_POST['password']),
        );
        $result = $this->Profile_mo_m->save_edit($data, $id_edit);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
}