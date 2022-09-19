<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Divisi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Divisi_m');

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

        $this->load->view('view_Divisi');
        $this->load->view('templates/footer');
    }

    public function get_data()
    {
        $Divisi = $this->Divisi_m->get_data();
        $i = 0;
        if (!empty($Divisi)) {
            foreach ($Divisi as $k => $v) {
                $dt_final[$i]['id_div'] = $v['id_div'];
                $dt_final[$i]['nama_div'] = strtoupper($v['nama_div']);
                $i++;
            }
        } else {
            $dt_final[$i]['id_div'] = '';
            $dt_final[$i]['nama_div'] = '';
        }
        $object = json_decode(json_encode($dt_final), FALSE);
        echo json_encode(array('response' => $object));
    }

    public function save_add()
    {
        $data = array(
            'nama_div' => $_POST['nama_div'],
        );

        $result = $this->Divisi_m->save_add($data);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function get_data_by_id($id)
    {

        $Divisi = $this->Divisi_m->get_data_by_id($id);
        foreach ($Divisi as $key => $value) {
            $data['id_div'] = $value['id_div'];
            $data['nama_div'] = $value['nama_div'];
        }
        $data_obj = (object)$data;
        echo json_encode($data_obj);
    }

    public function save_edit()
    {
        $id_div = $_POST['id_div'];
        $data = array(
            'nama_div' => $_POST['nama_div'],
        );
        $result = $this->Divisi_m->save_edit($data, $id_div);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function save_delete()
    {
        $id_div = $_POST['id_div'];
        $result = $this->Divisi_m->deleted_data($id_div);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
}
