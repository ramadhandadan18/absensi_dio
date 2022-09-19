<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat_2 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Riwayat_m');

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

        $this->load->view('view_Riwayat_2');
        $this->load->view('templates/footer');
    }

    public function index1()
    {
	    $this->load->view('templates/bar');

        $this->load->view('view_Riwayat_Bulanan');
        $this->load->view('templates/footer');
    }

    public function index2()
    {

        $this->load->view('templates/bar');

        $this->load->view('view_Rekap');
        $this->load->view('templates/footer');
    }


    public function get_data($fill_divisi, $fill_tanggal)
    {
        $_POST['fill_divisi'] = $fill_divisi;
        $_POST['fill_tanggal'] = $fill_tanggal;
        $Riwayat = $this->Riwayat_m->get_data($_POST);
        $i = 0;
        if (!empty($Riwayat)) {
            foreach ($Riwayat as $k => $v) {
                $dt_final[$i]['id_log'] = $v['id_log'];
                $dt_final[$i]['no_pegawai'] = $v['no_pegawai'];
                $dt_final[$i]['nama_pegawai'] = strtoupper($v['nama_pegawai']);
                if ($v['keterangan'] == 'CHECK IN')
                    $dt_final[$i]['keterangan'] = '<span class="label label-primary float-center">CHECK IN</span>';
                else if ($v['keterangan'] == 'CHECK OUT')
                    $dt_final[$i]['keterangan'] = '<span class="label label-danger float-center">CHECK OUT</span>';
                $dt_final[$i]['log_time'] = $v['log_time'];
                $dt_final[$i]['nama_area'] = $v['nama_area'];

                $i++;
            }
        } else {
            $dt_final[$i]['id_log'] = '';
            $dt_final[$i]['no_pegawai'] = '';
            $dt_final[$i]['nama_pegawai'] = 'Data Kosong';
            $dt_final[$i]['keterangan'] = '';
            $dt_final[$i]['log_time'] = '';
            $dt_final[$i]['nama_area'] = '';
            //$dt_final[$i]['status'] = '';
        }
        $object = json_decode(json_encode($dt_final), FALSE);
        echo json_encode(array('response' => $object));
    }

    public function get_data1($fill_divisi, $fill_tahun, $fill_bulan)
    {
        $_POST['fill_divisi'] = $fill_divisi;
        $_POST['fill_tahun'] = $fill_tahun;
        $_POST['fill_bulan'] = $fill_bulan;
        $Riwayat = $this->Riwayat_m->get_data1($_POST);
        $Riwayat_lmb = $this->Riwayat_m->get_data_lembur($_POST);
        //echopre($Riwayat_lmb);
        $Riwayat_CI = array();
        $Riwayat_tmp = array();

        foreach ($Riwayat as $k => $v) {
            if ($v['keterangan'] == 'CHECK IN') {
                $Riwayat_CI[$v['id_pegawai']][] = $v;
                $Riwayat_tmp[$v['id_pegawai']]['id_log'] = $v['id_log'];
                $Riwayat_tmp[$v['id_pegawai']]['no_pegawai'] = $v['no_pegawai'];
                $Riwayat_tmp[$v['id_pegawai']]['nama_pegawai'] = $v['nama_pegawai'];
                $Riwayat_tmp[$v['id_pegawai']]['nama_div'] = $v['nama_div'];
                $Riwayat_tmp[$v['id_pegawai']]['nama_sub_div'] = $v['nama_sub_div'];
                $Riwayat_tmp[$v['id_pegawai']]['kehadiran'] = 0;
                $Riwayat_tmp[$v['id_pegawai']]['lembur'] = 0;
                foreach ($Riwayat_lmb as $kk => $vv) {
                    //$Riwayat_CI[$vv['id_pegawai']][] = $vv;
                    $Riwayat_tmp[$vv['id_pegawai']]['lembur'] = $vv['jumlah_lembur'] . ' Jam';
                }
            }
        }

        foreach ($Riwayat_CI as $k => $v) {
            $Riwayat_tmp[$k]['kehadiran'] = count($v) . ' Hari';
        }

        //echopre($Riwayat_tmp);
        //die;

        $i = 0;
        if (!empty($Riwayat_tmp)) {
            foreach ($Riwayat_tmp as $k => $v) {
                $dt_final[$i]['id_log'] = $v['id_log'];
                $dt_final[$i]['no_pegawai'] = $v['no_pegawai'];
                $dt_final[$i]['nama_pegawai'] = strtoupper($v['nama_pegawai']);
                $dt_final[$i]['nama_div'] = $v['nama_div'];
                $dt_final[$i]['nama_sub_div'] = $v['nama_sub_div'];
                $dt_final[$i]['kehadiran'] = $v['kehadiran'];
                $dt_final[$i]['lembur'] = $v['lembur'];

                $i++;
            }
        } else {
            $dt_final[$i]['id_log'] = '';
            $dt_final[$i]['no_pegawai'] = '';
            $dt_final[$i]['nama_pegawai'] = 'Data Kosong';
            $dt_final[$i]['nama_div'] = '';
            $dt_final[$i]['nama_sub_div'] = '';
            $dt_final[$i]['kehadiran'] = '';
            $dt_final[$i]['lembur'] = '';
        }
        //echopre($dt_final);

        $object = json_decode(json_encode($dt_final), FALSE);
        echo json_encode(array('response' => $object));
    }


    public function get_data_bulanan($fill_divisi, $fill_tahun, $fill_bulan)
    {
        $_POST['fill_divisi'] = $fill_divisi;
        $_POST['fill_tahun'] = $fill_tahun;
        $_POST['fill_bulan'] = $fill_bulan;
        $Riwayat_pegawai = $this->Riwayat_m->get_data_pegawai_report_bulanan($_POST);
        $Riwayat = $this->Riwayat_m->get_data_report_bulanan($_POST);
        echopre($Riwayat_pegawai);
        $i = 0;
        if (!empty($Riwayat_pegawai)) {
            foreach ($Riwayat_pegawai as $k => $v) {
                $dt_final[$i]['no_pegawai'] = $v['no_pegawai'];
                $dt_final[$i]['nama_pegawai'] = strtoupper($v['nama_pegawai']);
                $dt_final[$i]['tanggal'] = '';
                $dt_final[$i]['check_in'] = 'Belum Check in';
                $dt_final[$i]['check_out'] = 'Belum Check out';
                $dt_final[$i]['status'] = 'Belum Check in';
                $dt_final[$i]['on_duty'] = '07:30';
                $dt_final[$i]['off_duty'] = '16:30';
                $dt_final[$i]['early'] = '';
                $dt_final[$i]['late'] = '';
                $dt_final[$i]['overtime'] = '';
                foreach ($Riwayat as $kk => $vv) {
                    if ($vv['no_pegawai'] == $v['no_pegawai'] && $vv['tanggal'] == $v['tanggal']) {
                        $dt_final[$i]['nama_pegawai'] = strtoupper($vv['nama_pegawai']);
                        //$checkout = false;
                        if ($vv['keterangan'] == 'CHECK IN') {
                            $checkout = true;
                            $dt_final[$i]['tanggal'] = substr($vv['log_time'], 0, 10);
                            if (substr($vv['log_time'], 11, 1) == '0') {
                                // echo "pagi";die;
                                $jam_masuk = substr($vv['log_time'], 12, 1);
                            } else {
                                $jam_masuk = substr($vv['log_time'], 11, 2);
                            }

                            $dt_final[$i]['check_in'] = substr($vv['log_time'], 11, 5);
                            if ($jam_masuk <= 13) {
                                $date = date_create($vv['log_time']);
                                $dt_final[$i]['status'] = 'Shift 1';
                                $dt_final[$i]['on_duty'] = '07:30';
                                if (!in_array(date_format($date, "l"), ['Friday'])) {
                                    $dt_final[$i]['off_duty'] = '16:30';
                                } else {
                                    $dt_final[$i]['off_duty'] = '17:00';
                                }
                            } else if ($jam_masuk > 14 && $jam_masuk <= 16) {
                                $dt_final[$i]['status'] = 'Shift 2';
                                $dt_final[$i]['on_duty'] = '15:30';
                                $dt_final[$i]['off_duty'] = '23:30';
                            } else {
                                $dt_final[$i]['status'] = 'Shift 3';
                                $dt_final[$i]['on_duty'] = '23:00';
                                $dt_final[$i]['off_duty'] = '07:30';
                                //pengambilan check out
                                $_fill['id_pegawai'] = $vv['id_pegawai'];
                                $_fill['tanggal'] = $vv['tanggal'];
                                $check_out_jam = $this->Riwayat_m->get_jam_chek_out($_fill);
                                foreach ($check_out_jam as $kkk => $vvv) {
                                    $dt_final[$i]['overtime'] = $vvv['jumlah_jam'] != '' ? $vvv['jumlah_jam'] . ' Jam' : '';
                                    $dt_final[$i]['check_out'] = substr($vvv['log_time'], 11, 5);
                                }
                            }

                            //late
                            $on_duty_ = substr($vv['log_time'], 0, 10) . ' ' . $dt_final[$i]['on_duty'] . ':00';
                            $on_duty = strtotime($on_duty_);
                            $masuk = strtotime($vv['log_time']);

                            $diff = $on_duty - $masuk;
                            $jam = floor($diff / (60 * 60));
                            $menit = $diff - $jam * (60 * 60);
                            if ($jam != 0 || $menit != 0)
                                $dt_final[$i]['late'] = $jam .  ' : ' . floor($menit / 60);
                            if (substr($dt_final[$i]['late'], 0, 1) == '-') {
                                $dt_final[$i]['late'] = $jam .  ' : ' . floor($menit / 60);
                                $dt_final[$i]['early'] = '';
                            } else {
                                $dt_final[$i]['late'] = '';
                                $dt_final[$i]['early'] = $jam .  ' : ' . floor($menit / 60);
                            }
                        }

                        if ($vv['keterangan'] == 'CHECK OUT' && $checkout) {
                            $dt_final[$i]['overtime'] = $vv['jumlah_jam'] != '' ? $vv['jumlah_jam'] . ' Jam' : '';
                            $dt_final[$i]['check_out'] = substr($vv['log_time'], 11, 5);
                        }
                        //echopre($dt_final);
                    }
                }
                $i++;
            }
        } else {
            $dt_final[$i]['no_pegawai'] = '';
            $dt_final[$i]['nama_pegawai'] = 'Data Kosong';
            $dt_final[$i]['tanggal'] = '';
            $dt_final[$i]['status'] = '';
            $dt_final[$i]['check_in'] = '';
            $dt_final[$i]['check_out'] = '';
            $dt_final[$i]['on_duty'] = '';
            $dt_final[$i]['off_duty'] = '';
            $dt_final[$i]['early'] = '';
            $dt_final[$i]['late'] = '';
            $dt_final[$i]['overtime'] = '';
        }
        //echopre($dt_final);
		
        $object = json_decode(json_encode($dt_final), FALSE);
        echo json_encode(array('response' => $object));
    }

    public function get_data_by_id($id)
    {
        $riwayat = $this->Riwayat_m->get_data_by_id($id);
        echo json_encode($riwayat);
    }

    public function get_data_tahun()
    {
        $years_dropdown = array();
        $y = date('Y') - 2;
        $y1 = $y + 4;
        $years_dropdown[0]['tahun'] = date('Y');
        $aa = 1;
        for ($i = $y; $i <= $y1; $i++) {
            $years_dropdown[$aa]['tahun'] = $i;
            $aa++;
        }
        $object = json_decode(json_encode($years_dropdown), FALSE);
        echo json_encode($object);
    }

    public function get_data_bulan($export = 0)
    {
        $data[0]['bulan'] = '01';
        $data[0]['bulan_desc'] = 'JANUARI';
        $data[1]['bulan'] = '02';
        $data[1]['bulan_desc'] = 'FEBRUARI';
        $data[2]['bulan'] = '03';
        $data[2]['bulan_desc'] = 'MARET';
        $data[3]['bulan'] = '04';
        $data[3]['bulan_desc'] = 'APRIL';
        $data[4]['bulan'] = '05';
        $data[4]['bulan_desc'] = 'MEI';
        $data[5]['bulan'] = '06';
        $data[5]['bulan_desc'] = 'JUNI';
        $data[6]['bulan'] = '07';
        $data[6]['bulan_desc'] = 'JULI';
        $data[7]['bulan'] = '08';
        $data[7]['bulan_desc'] = 'AGUSTUS';
        $data[8]['bulan'] = '09';
        $data[8]['bulan_desc'] = 'SEPTEMBER';
        $data[9]['bulan'] = '10';
        $data[9]['bulan_desc'] = 'OKTOBER';
        $data[10]['bulan'] = '11';
        $data[10]['bulan_desc'] = 'NOVEMBER';
        $data[11]['bulan'] = '12';
        $data[11]['bulan_desc'] = 'DESEMBER';

        if ($export != 0)
            return $data;
        $object = json_decode(json_encode($data), FALSE);
        echo json_encode($object);
    }

    public function save_edit()
    {
        $id_log = $_POST['id_log'];
        $data = array(
            'log_time' => $_POST['log_time'],
        );
        $result = $this->Riwayat_m->save_edit($data, $id_log);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
}
