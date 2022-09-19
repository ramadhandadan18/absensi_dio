<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sub_divisi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sub_divisi_m');

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

        $this->load->view('view_Sub_divisi');
        $this->load->view('templates/footer');
    }

    public function get_data()
    {
        $Sub_divisi = $this->Sub_divisi_m->get_data();
        $i = 0;
        if (!empty($Sub_divisi)) {
            foreach ($Sub_divisi as $k => $v) {
                $dt_final[$i]['id_sub_div'] = $v['id_sub_div'];
                $dt_final[$i]['nama_div'] = strtoupper($v['nama_div']);
                $dt_final[$i]['nama_sub_div'] = strtoupper($v['nama_sub_div']);
                $i++;
            }
        } else {
            $dt_final[$i]['id_sub_div'] = '';
            $dt_final[$i]['nama_div'] = '';
            $dt_final[$i]['nama_sub_div'] = '';
        }
        $object = json_decode(json_encode($dt_final), FALSE);
        echo json_encode(array('response' => $object));
    }

    public function get_data_divisi()
    {
        $divisi = $this->Sub_divisi_m->get_data_divisi();
        $i = 0;
        foreach ($divisi as $key => $value) {
            $dt_divisi[$i]['id_div'] = $value['id_div'];
            $dt_divisi[$i]['nama_div'] = $value['nama_div'];
            $i++;
        }

        $object = json_decode(json_encode($dt_divisi), FALSE);
        echo json_encode($object);
    }

    public function save_add()
    {
        $data = array(
            'id_div' => $_POST['id_div'],
            'nama_sub_div' => $_POST['nama_sub_div'],
        );

        $result = $this->Sub_divisi_m->save_add($data);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function get_data_by_id($id)
    {

        $Sub_divisi = $this->Sub_divisi_m->get_data_by_id($id);
        foreach ($Sub_divisi as $key => $value) {
            $data['id_sub_div'] = $value['id_sub_div'];
            $data['nama_sub_div'] = $value['nama_sub_div'];
            $data['id_div'] = $value['id_div'];
        }
        $data_obj = (object)$data;
        echo json_encode($data_obj);
    }

    public function save_edit()
    {
        $id_sub_div = $_POST['id_sub_div'];
        $data = array(
            'nama_sub_div' => $_POST['nama_sub_div'],
            'id_div' => $_POST['id_div'],
        );
        $result = $this->Sub_divisi_m->save_edit($data, $id_sub_div);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function save_delete()
    {
        $id_sub_div = $_POST['id_sub_div'];
        $result = $this->Sub_divisi_m->deleted_data($id_sub_div);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
}
