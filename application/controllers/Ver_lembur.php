<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ver_lembur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('lembur_m');

        if (!$this->session->userdata('is_login') == true) {
            redirect('login');
        }

        if ($_SESSION['role'] == '2') {
            redirect('logout');
        }
    }

    public function index()
    {

        $this->load->view('templates/bar');

        $this->load->view('view_Ver_lembur');
        $this->load->view('templates/footer');
    }

    public function get_data($date = '')
    {
        $Ver_lembur = $this->lembur_m->get_data_approval($date);
        $i = 0;
        if (!empty($Ver_lembur)) {
            foreach ($Ver_lembur as $k => $v) {
                $dt_final[$i]['id_lembur'] = $v['id_lembur'];
                $dt_final[$i]['tgl_lembur'] = $v['tgl_lembur'];
                $dt_final[$i]['pemohon'] = $v['pemohon'];
                $dt_final[$i]['jam_fr'] = $v['jam_fr'];
                $dt_final[$i]['jam_to'] = $v['jam_to'];
                $dt_final[$i]['jumlah_jam'] = $v['jumlah_jam'] . ' jam';
                $status_ket = '';
                if ($v['lembur_status'] == '0')
                    $status_ket = '<span class="label label-warning float-center">Waiting Approve</span>';
                else if ($v['lembur_status'] == '1')
                    $status_ket = '<span class="label label-success float-center">Approve</span>';
                else if ($v['lembur_status'] == '2')
                    $status_ket = '<span class="label label-danger float-center">Reject</span>';
                $dt_final[$i]['lembur_status'] = $status_ket;
                $i++;
            }
        } else {
            $dt_final[$i]['id_lembur'] = '';
            $dt_final[$i]['tgl_lembur'] = 'Data Kosong';
            $dt_final[$i]['pemohon'] = '';
            $dt_final[$i]['jam_fr'] = '';
            $dt_final[$i]['jam_to'] = '';
            $dt_final[$i]['jumlah_jam'] = '';
            $dt_final[$i]['lembur_status'] = '';
        }
        $object = json_decode(json_encode($dt_final), FALSE);
        echo json_encode(array('response' => $object));
    }

    public function get_data_by_id($id)
    {

        $lembur = $this->lembur_m->get_data_by_id($id);
        foreach ($lembur as $key => $value) {
            $data['id_lembur'] = $value['id_lembur'];
        }
        $data_obj = (object)$data;
        echo json_encode($data_obj);
    }

    public function save_edit()
    {
        $id_lembur = $_POST['id_lembur'];
        $data = array(
            'lembur_note' => $_POST['lembur_note'],
            'lembur_status' => $_POST['lembur_status']
        );
        $result = $this->lembur_m->save_edit($data, $id_lembur);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
}
