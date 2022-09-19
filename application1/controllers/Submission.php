<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Submission extends CI_Controller
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        parent::__construct();
        $this->load->model('Submission_m');        
        if (!$this->session->userdata('is_login') == true) {
            redirect('login');
        }
    }

    public function index()
    {   
        $this->load->view('mobile/header');
        $username = $_SESSION['username'];        
        $my_data = $this->Submission_m->get_my_data($username);        
        $is_pic = $my_data[0]['is_pic'];
        $this->load->view('mobile/view_Submission');
        for ($a=0; $a<=4 ; $a++) { 
            $fill['bar_fill_'.$a] = 'currentColor';
            $fill['bar_text_'.$a] = '';
        }
        $fill['bar_fill_1'] = 'white';
        $fill['bar_text_1'] = 'white';
        if($is_pic == '1')
            $this->load->view('mobile/footer_2',$fill);
        else
            $this->load->view('mobile/footer',$fill);
    }

    public function get_data_Submission($date = '')
    {               
        $Submission = $this->Submission_m->get_data($date);
        $i = 0;
        if (!empty($Submission)) {
            foreach ($Submission as $k => $v) {
                $dt_final[$i]['submission_id'] = $v['submission_id'];                
                $dt_final[$i]['submission_tanggal'] = $v['submission_tanggal'];                
                if($v['submission_status'] == 0){
                    $dt_final[$i]['submission_flag'] = '1';
                    $dt_final[$i]['submission_status'] = '<span class="label label-warning float-center">Waiting Approve</span>';
                }
                else if($v['submission_status'] == 1){
                    $dt_final[$i]['submission_flag'] = '0';
                    $dt_final[$i]['submission_status'] = '<span class="label label-success float-center">Approve</span>';
                }
                else if($v['submission_status'] == 2){
                    $dt_final[$i]['submission_flag'] = '1';
                    $dt_final[$i]['submission_status'] = '<span class="label label-danger float-center">Reject</span>';            
                }
                $i++;
            }
        } else {
            $dt_final[$i]['submission_id'] = '';
            $dt_final[$i]['submission_tanggal'] = 'Data is null';
            $dt_final[$i]['submission_status'] = '';
            $dt_final[$i]['submission_flag'] = '';
        }                
        $object = json_decode(json_encode($dt_final), FALSE);
        echo json_encode(array('response' => $object));
    }

    public function get_data_pegawai()
    {
        $data = $this->Submission_m->get_data_pegawai();
        $i = 0;
        foreach ($data as $key => $value) {
            $dt[$i]['pegawai_id'] = $value['pegawai_id'];
            $dt[$i]['pegawai_nama'] = $value['pegawai_nama'];
            $i++;
        }

        $object = json_decode(json_encode($dt), FALSE);
        echo json_encode($object);
    }

    public function save_add()
    {   
        $data = array(
            'submission_ket' => $_POST['submission_ket'],
            'submission_tanggal' => $_POST['submission_tanggal'],
            'submission_tanggal_tukar' => $_POST['submission_tanggal_tukar'],
            'submission_pegawai' => $_POST['submission_pegawai'],
            'submission_jam_1' => $_POST['submission_jam_1'],
            'submission_jam_2' => $_POST['submission_jam_2'],
            'submission_tujuan' => $_POST['submission_tujuan'],
            'submission_no_hp' => $_POST['submission_no_hp'],
            'submission_no_hp_2' => $_POST['submission_no_hp_2'],
            'submission_status' => '0',
            'submission_create_by' => $_SESSION['pegawai_id'],
        );
        
        $result = $this->Submission_m->save_add($data);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function get_data_by_id($id)
    {

        $Submission = $this->Submission_m->get_data_by_id($id);
        foreach ($Submission as $key => $value) {
            $data['submission_id'] = $value['submission_id'];
            $data['submission_ket'] = $value['submission_ket'];
            $data['submission_tanggal'] = $value['submission_tanggal'];
            $data['submission_tanggal_tukar'] = $value['submission_tanggal_tukar'];
            $data['submission_pegawai'] = $value['submission_pegawai'];
            $data['submission_jam_1'] = $value['submission_jam_1'];
            $data['submission_jam_2'] = $value['submission_jam_2'];
            $data['submission_tujuan'] = $value['submission_tujuan'];
            $data['submission_no_hp'] = $value['submission_no_hp'];
            $data['submission_no_hp_2'] = $value['submission_no_hp_2'];
        }
        $data_obj = (object)$data;
        echo json_encode($data_obj);
    }

    public function save_edit()
    {   
        $submission_id = $_POST['submission_id'];
        $data = array(
            'submission_ket' => $_POST['submission_ket'],
            'submission_tanggal' => $_POST['submission_tanggal'],
            'submission_tanggal_tukar' => $_POST['submission_tanggal_tukar'],
            'submission_pegawai' => $_POST['submission_pegawai'],
            'submission_jam_1' => $_POST['submission_jam_1'],
            'submission_jam_2' => $_POST['submission_jam_2'],
            'submission_tujuan' => $_POST['submission_tujuan'],
            'submission_no_hp' => $_POST['submission_no_hp'],
            'submission_no_hp_2' => $_POST['submission_no_hp_2'],
            'submission_status' => '0'
        );
        $result = $this->Submission_m->save_edit($data, $submission_id);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function save_delete()
    {
        $submission_id = $_POST['submission_id'];
        $result = $this->Submission_m->deleted_data($submission_id);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
}
