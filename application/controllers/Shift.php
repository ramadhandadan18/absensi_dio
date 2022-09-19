<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shift extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Shift_m');

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

        $this->load->view('view_Shift');
        $this->load->view('templates/footer');
    }

    public function get_data()
    {
        $date_start = '2022-09-01';
        $start = $month = strtotime($date_start);
        $end = date("Y-m-t", strtotime($date_start));
        $end_date = date("Y-m-d", strtotime($end . '+1 day'));

        // echopre($end_date);
        $period = new DatePeriod(
            new DateTime($date_start),
            new DateInterval('P1D'),
            new DateTime($end_date)
        );

        foreach ($period as $key => $value) {
            $date_arr[$key]['date'] = $value->format('d');
            $date_arr[$key]['day'] = $value->format('D');
        }

        $data = [
            "date" => $date_arr
        ];

        $object = json_decode(json_encode($data), FALSE);
        echo json_encode(array('response' => $object));
    }

    public function getHeaderDate()
    {
        $date_start = '2022-09-01';
        $start = $month = strtotime($date_start);
        $end = date("Y-m-t", strtotime($date_start));
        $end_date = date("Y-m-d", strtotime($end . '+1 day'));

        // echopre($end_date);
        $period = new DatePeriod(
            new DateTime($date_start),
            new DateInterval('P1D'),
            new DateTime($end_date)
        );

        foreach ($period as $key => $value) {
            $date_arr[$key]['date'] = $value->format('d');
            $date_arr[$key]['day'] = $value->format('D');
        }

        $data = [
            "date" => $date_arr
        ];

        $object = json_decode(json_encode($data), FALSE);
        echo json_encode($object);
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
