<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_m');

        if (!$this->session->userdata('is_login') == true) {
            redirect('login');
        }

        if ($_SESSION['role'] != '1') {
            redirect('logout');
        }
    }

    public function index()
    {

        $this->load->view('templates/bar');

        $this->load->view('view_Admin');
        $this->load->view('templates/footer');
    }

    public function get_data()
    {
        $Admin = $this->Admin_m->get_data();
        $i = 0;
        if (!empty($Admin)) {
            foreach ($Admin as $k => $v) {
                $dt_final[$i]['id'] = $v['id'];
                $dt_final[$i]['username'] = $v['username'];
                $dt_final[$i]['password'] = $v['password'];
                if ($v['role'] == 1)
                    $dt_final[$i]['role'] = '<span class="label label-primary float-center">ADMIN</span>';
                else
                    $dt_final[$i]['role'] = '<span class="label label-danger float-center">SIG</span>';
                $i++;
            }
        } else {
            $dt_final[$i]['id'] = '';
            $dt_final[$i]['username'] = '';
            $dt_final[$i]['password'] = '';
            $dt_final[$i]['role'] = '';
        }
        $object = json_decode(json_encode($dt_final), FALSE);
        echo json_encode(array('response' => $object));
    }

    public function get_data_by_id($id)
    {

        $admin = $this->Admin_m->get_data_by_id($id);
        foreach ($admin as $key => $value) {
            $data['id'] = $value['id'];
            $data['username'] = $value['username'];
            $data['password'] = '';
            $data['role'] = $value['role'];
        }
        $data_obj = (object)$data;
        echo json_encode($data_obj);
    }

    public function save_add()
    {
        $data = array(
            'username' => $_POST['username'],
            'password' => hash('md5', $_POST['password']),
            'role' => $_POST['role'],
        );

        // echopre($_POST);
        // die;

        $result = $this->Admin_m->save_add($data);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function save_edit()
    {
        $id = $_POST['id_edit'];
        // echopre($_POST);
        // die;
        if ($_POST['password'] == '') {
            $data = array(
                'username' => $_POST['username'],
                'role' => $_POST['role'],
            );
        } else {
            $data = array(
                'username' => $_POST['username'],
                'password' => hash('md5', $_POST['password']),
                'role' => $_POST['role'],
            );
        }
        $result = $this->Admin_m->save_edit($data, $id);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function save_delete()
    {
        $id = $_POST['id'];
        $result = $this->Admin_m->deleted_data($id);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
}
