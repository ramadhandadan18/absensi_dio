<?php

defined('BASEPATH') or exit('No direct script access allowed');

class History_mo extends CI_Controller
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        parent::__construct();
        $this->load->model('History_mo_m');        
        if (!$this->session->userdata('is_login') == true) {
            redirect('login');
        }
    }

    public function index()
    {   
        $this->load->view('mobile/header');
        $username = $_SESSION['username'];        
        $my_data = $this->History_mo_m->get_my_data($username);        
        $this->load->view('mobile/view_History');
        for ($a=0; $a<=4 ; $a++) { 
            $fill['bar_fill_'.$a] = 'currentColor';
            $fill['bar_text_'.$a] = '';
        }
        $fill['bar_fill_2'] = 'white';
        $fill['bar_text_2'] = 'white';
        $this->load->view('mobile/footer',$fill);
    }

    public function get_data_absen($date = '')
    {
        $username = $_SESSION['username'];        
        $my_data = $this->History_mo_m->get_my_data($username);        
        $id_pegawai = $my_data[0]['id_pegawai'];
        $data_log = $this->History_mo_m->get_my_data_log($id_pegawai,$date);
        $i = 0;
        $dt = [];
        if(!empty($data_log)){
            foreach ($data_log as $key => $value) {
                $dt[$i]['id_log'] = "<button class='btn btn-primary' onclick='view(".$value['id_log'].")'>Detail</button>";
                $dt[$i]['log_time'] = $value['log_time'];
                if($value['keterangan'] == 'CHECK IN')
                    $dt[$i]['keterangan'] = "<b style=color:darkgreen;'>".$value['keterangan']."</b>";
                else
                    $dt[$i]['keterangan'] = "<b style=color:darkgoldenrod;'>".$value['keterangan']."</b>";
                $i++;
            }
        }else{
            $dt[$i]['id_log'] = '';
            $dt[$i]['log_time'] = 'Data is null';            
            $dt[$i]['keterangan'] = '';
        }
        $object = json_decode(json_encode($dt), FALSE);
        echo json_encode($object);
    }
}
