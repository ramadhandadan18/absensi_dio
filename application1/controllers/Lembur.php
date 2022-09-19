<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lembur extends CI_Controller
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        parent::__construct();
        $this->load->model('lembur_m');
        if (!$this->session->userdata('is_login') == true) {
            redirect('login');
        }
    }

    function echopre($dt)
    {
        echo "<pre>";
        print_r($dt);
        echo "</pre>";
    }

    public function index()
    {
        $this->load->view('mobile/header');
        $username = $_SESSION['username'];
        $my_data = $this->lembur_m->get_my_data($username);
        $id_pegawai = $my_data[0]['id_pegawai'];

        $this->load->view('mobile/view_Lembur');
        for ($a = 0; $a <= 4; $a++) {
            $fill['bar_fill_' . $a] = 'currentColor';
            $fill['bar_text_' . $a] = '';
        }
        $fill['bar_fill_1'] = 'white';
        $fill['bar_text_1'] = 'white';
        $this->load->view('mobile/footer', $fill);
    }

    public function get_data_lembur($date = '')
    {
        $lembur = $this->lembur_m->get_data($date);
        // echopre($lembur);
        $i = 0;
        if (!empty($lembur)) {
            foreach ($lembur as $k => $v) {
                $dt_final[$i]['id_lembur'] = $v['id_lembur'];
                $dt_final[$i]['tgl_lembur'] = $v['tgl_lembur'];
                if ($v['lembur_status'] == 0) {
                    $dt_final[$i]['lembur_flag'] = '1';
                    $dt_final[$i]['lembur_status'] = '<span class="label label-warning float-center">Waiting Approve</span>';
                } else if ($v['lembur_status'] == 1) {
                    $dt_final[$i]['lembur_flag'] = '0';
                    $dt_final[$i]['lembur_status'] = '<span class="label label-success float-center">Approve</span>';
                } else if ($v['lembur_status'] == 2) {
                    $dt_final[$i]['lembur_flag'] = '0';
                    $dt_final[$i]['lembur_status'] = '<span class="label label-danger float-center">Reject</span>';
                }
                $dt_final[$i]['shift'] = $v['shift'];
                $dt_final[$i]['jam_fr'] = $v['jam_fr'];
                $dt_final[$i]['jam_to'] = $v['jam_to'];
                $dt_final[$i]['jumlah_jam'] = $v['jumlah_jam'] . ' jam';
                $dt_final[$i]['pekerjaan'] = $v['pekerjaan'];
                $i++;
            }
        } else {
            $dt_final[$i]['id_lembur'] = '';
            $dt_final[$i]['tgl_lembur'] = 'Data is null';
            $dt_final[$i]['shift'] = '';
            $dt_final[$i]['jam_fr'] = '';
            $dt_final[$i]['jam_to'] = '';
            $dt_final[$i]['pekerjaan'] = '';
            $dt_final[$i]['jumlah_jam'] = '';
            $dt_final[$i]['lembur_status'] = '';
            $dt_final[$i]['lembur_flag'] = '';
        }
        $object = json_decode(json_encode($dt_final), FALSE);
        echo json_encode(array('response' => $object));
    }

    public function save_add()
    {
        $tgl_lembur = $_POST['tgl_lembur'];
        // echopre($tgl_lembur);
        // die;
        $cek_jam = $this->lembur_m->cek_jam($tgl_lembur, $_SESSION['id_pegawai']);
        // echopre($cek_jam);
        // die;
        if ($cek_jam + $_POST['jumlah_jam'] > 56) {
            $result = false;
        } else {
            $data = array();
            $data = array(
                'id_pegawai' => $_SESSION['id_pegawai'],
                'jam_fr' => $_POST['jam_fr'],
                'jam_to' => $_POST['jam_to'],
                'tgl_lembur' => $_POST['tgl_lembur'],
                'pekerjaan' => $_POST['pekerjaan'],
                'jumlah_jam' => $_POST['jumlah_jam'],
                'shift' => $_POST['shift'],
                'lembur_status' => '0',
            );
            $result = $this->lembur_m->save_add($data);
        }
        // $data = array();
        // $data = array(
        //     'id_pegawai' => $_SESSION['id_pegawai'],
        //     'jam_fr' => $_POST['jam_fr'],
        //     'jam_to' => $_POST['jam_to'],
        //     'tgl_lembur' => $_POST['tgl_lembur'],
        //     'pekerjaan' => $_POST['pekerjaan'],
        //     'jumlah_jam' => $_POST['jumlah_jam'],
        //     'shift' => $_POST['shift'],
        //     'lembur_status' => '0',
        // );

        //$result = $this->lembur_m->save_add($data);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode('Jam lembur lebih dari 56 Jam');
        }
    }

    public function get_data_by_id($id)
    {

        $lembur = $this->lembur_m->get_data_by_id($id);
        foreach ($lembur as $key => $value) {
            $data['id_lembur'] = $value['id_lembur'];
            $data['id_pegawai'] = $value['id_pegawai'];
            $data['no_pegawai'] = $value['no_pegawai'];
            $data['jam_fr'] = $value['jam_fr'];
            $data['jam_to'] = $value['jam_to'];
            $data['pekerjaan'] = $value['pekerjaan'];
            $data['shift'] = $value['shift'];
            $data['tgl_lembur'] = $value['tgl_lembur'];
            $data['jumlah_jam'] = $value['jumlah_jam'];
            $data['id_div'] = $value['id_div'];
            $data['lembur_status'] = $value['lembur_no_hp_2'];
        }
        $data_obj = (object)$data;
        echo json_encode($data_obj);
    }

    public function save_delete()
    {
        $id_lembur = $_POST['id_lembur'];
        $result = $this->lembur_m->deleted_data($id_lembur);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
}
