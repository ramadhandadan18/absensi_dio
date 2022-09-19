<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Area extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Area_m');

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

        $this->load->view('view_Area');
        $this->load->view('templates/footer');
    }

    public function get_data()
    {
        $Area = $this->Area_m->get_data();
        $i = 0;
        if (!empty($Area)) {
            foreach ($Area as $k => $v) {
                $dt_final[$i]['id_area'] = $v['id_area'];
                $dt_final[$i]['nama_area'] = strtoupper($v['nama_area']);
                $dt_final[$i]['longitude'] = $v['longitude'];
                $dt_final[$i]['latitude'] = $v['latitude'];
                $dt_final[$i]['radius'] = $v['radius'];
                $i++;
            }
        } else {
            $dt_final[$i]['id_area'] = '';
            $dt_final[$i]['nama_area'] = '';
            $dt_final[$i]['longitude'] = '';
            $dt_final[$i]['latitude'] = '';
            $dt_final[$i]['radius'] = '';
        }
        $object = json_decode(json_encode($dt_final), FALSE);
        echo json_encode(array('response' => $object));
    }

    public function save_add()
    {
        $data = array(
            'nama_area' => $_POST['nama_area'],
            'longitude' => $_POST['longitude'],
            'latitude' => $_POST['latitude'],
            'radius' => $_POST['radius'],
        );

        $result = $this->Area_m->save_add($data);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function get_data_by_id($id)
    {

        $Area = $this->Area_m->get_data_by_id_2($id);
        foreach ($Area as $key => $value) {
            $data['id_area'] = $value['id_area'];
            $data['nama_area'] = $value['nama_area'];
            $data['longitude'] = $value['longitude'];
            $data['latitude'] = $value['latitude'];
            $data['radius'] = $value['radius'];
        }
        $data_obj = (object)$data;
        echo json_encode($data_obj);
    }

    public function save_edit()
    {
        $id_area = $_POST['id_area'];
        $data = array(
            'nama_area' => $_POST['nama_area'],
            'longitude' => $_POST['longitude'],
            'latitude' => $_POST['latitude'],
            'radius' => $_POST['radius'],
        );
        $result = $this->Area_m->save_edit($data, $id_area);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function save_delete()
    {
        $id_area = $_POST['id_area'];
        $result = $this->Area_m->deleted_data($id_area);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function get_table_pegawai($id_area)
    {
        $Pegawai = $this->Area_m->get_data_pegawai($id_area);
        $i = 0;
        if (!empty($Pegawai)) {
            foreach ($Pegawai as $k => $v) {
                $dt_final[$i]['nama_pegawai'] = strtoupper($v['nama_pegawai']);
                $dt_final[$i]['nama_div'] = $v['nama_div'];
                $dt_final[$i]['no_pegawai'] = $v['no_pegawai'];
                $i++;
            }
        } else {
            $dt_final[$i]['nama_pegawai'] = 'Data is null';
            $dt_final[$i]['nama_div'] = '';
            $dt_final[$i]['no_pegawai'] = '';
        }
        $object = json_decode(json_encode($dt_final), FALSE);
        echo json_encode(array('response' => $object));
    }
}
