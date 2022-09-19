<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        parent::__construct();
        $this->load->model('Absensi_m');
        $this->load->model('Area_m');

        if (!$this->session->userdata('is_login') == true) {
            redirect('login');
        }
    }

    public function index()
    {
        $checkArea = 0;
        $area = $this->getArea($this->session->userdata('id_pegawai'));
        if (count($area)) {
            $checkArea = 1;
        }

        $data = [
            "area" => $area,
            "checkArea" => $checkArea
        ];

        $this->load->view('mobile/header');
        $username = $_SESSION['username'];
        $my_data = $this->Absensi_m->get_my_data($username);
        $id_pegawai = $my_data[0]['id_pegawai'];
        $data['my_name'] = $my_data[0]['nama_pegawai'];

        $data['today'] = date('d F Y');
        $data['month'] = 'Absensi bulan ' . date('F Y');

        $this->load->view('mobile/view_Absensi', $data);
        for ($a = 0; $a <= 4; $a++) {
            $fill['bar_fill_' . $a] = 'currentColor';
            $fill['bar_text_' . $a] = '';
        }
        $fill['bar_fill_1'] = 'white';
        $fill['bar_text_1'] = 'white';
        $this->load->view('mobile/footer', $fill);
    }


    public function get_data_absen($date = '')
    {
        $username = $_SESSION['username'];
        $my_data = $this->Absensi_m->get_my_data($username);
        $id_pegawai = $my_data[0]['id_pegawai'];
        $data_log = $this->Absensi_m->get_my_data_log($id_pegawai);
        $i = 0;
        $dt = [];
        if (!empty($data_log)) {
            foreach ($data_log as $key => $value) {
                $dt[$i]['id_log'] = "<button class='btn btn-primary' onclick='view(" . $value['id_log'] . ")'>Detail</button>";
                $dt[$i]['log_time'] = $value['log_time'];
                if ($value['keterangan'] == 'CHECK IN')
                    $dt[$i]['keterangan'] = "<b style=color:darkgreen;'>" . $value['keterangan'] . "</b>";
                else
                    $dt[$i]['keterangan'] = "<b style=color:darkgoldenrod;'>" . $value['keterangan'] . "</b>";
                $i++;
            }
        } else {
            $dt[$i]['id_log'] = '';
            $dt[$i]['log_time'] = 'Data is null';
            $dt[$i]['keterangan'] = '';
        }
        $object = json_decode(json_encode($dt), FALSE);
        echo json_encode($object);
    }

    public function get_data_by_id($id)
    {

        $Absensi = $this->Absensi_m->get_data_by_id($id);
        foreach ($Absensi as $key => $value) {
            $data['id_log'] = $value['id_log'] . str_replace(array(' ', '-', ':'), '', $value['log_time']);
            $data['log_time'] = $value['log_time'];
            $data['nama_area'] = $value['nama_area'];
            $data['nama_pegawai'] = $value['nama_pegawai'];
            //$data['log_foto'] = $value['log_foto'];
            $data['keterangan'] = $value['keterangan'];
            if ($value['status'] == '1')
                $data['status'] = 'Approve';
            else if ($value['status'] == '2')
                $data['status'] = 'Reject';
            else
                $data['status'] = 'Waiting Approve';
        }
        $data_obj = (object)$data;
        echo json_encode($data_obj);
    }

    public function getArea($id)
    {
        $data_area = $this->Area_m->get_area_by_id_data($id);
        $Area = $this->Area_m->get_data_by_id($data_area);
        $data = [];
        foreach ($Area as $key => $value) {
            $data[$key]['id_area'] = $value['id_area'];
            $data[$key]['nama_area'] = $value['nama_area'];
            $data[$key]['longitude'] = $value['longitude'];
            $data[$key]['latitude'] = $value['latitude'];
            $data[$key]['radius'] = $value['radius'];
        }
        $data_obj = (object)$data;
        return $data;
    }

    public function checkInOut()
    {
        $id_pegawai = $this->session->userdata('id_pegawai');
        // $log_time = $_POST['log_time'];
        $log_time = date('Y-m-d H:i:s');
        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];
        $status = "0";
        $id_area = $_POST['id_area'];
        $keterangan = $_POST['keterangan'];

        $msg = "Error";
        $check_data_log = $this->Absensi_m->check_data_log($id_pegawai, $keterangan);
        // echopre($check_data_log);
        if ($check_data_log == [] || COUNT($check_data_log) == 1) {
            if ($keterangan == "CHECK OUT") {
                $check_data_in = $this->Absensi_m->check_data_log_check_out($id_pegawai, "CHECK IN");
                if ($check_data_in == []) {
                    $result = false;
                    $msg = "Anda Belum melakukan check in";
                } else {
                    $data = array(
                        'id_pegawai' => $id_pegawai,
                        'log_time' => $log_time,
                        'log_longtitude' => $longitude,
                        'log_latitude' => $latitude,
                        'status' => $status,
                        'id_area' => $id_area,
                        'keterangan' => $keterangan,
                        //'log_foto' => $image
                    );
                    $result = $this->Absensi_m->save_log($data);
                }
            } else {
                $data = array(
                    'id_pegawai' => $id_pegawai,
                    'log_time' => $log_time,
                    'log_longtitude' => $longitude,
                    'log_latitude' => $latitude,
                    'status' => $status,
                    'id_area' => $id_area,
                    'keterangan' => $keterangan,
                    //'log_foto' => $image
                );
                $result = $this->Absensi_m->save_log($data);
            }
        } else {
            $result = false;
            $msg = "Anda sudah melakukan " . $keterangan . " hari ini";
        }

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode($msg);
        }
    }
}
