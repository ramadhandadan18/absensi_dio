<?php

defined('BASEPATH') or exit('No direct script access allowed');

class R_absensi extends CI_Controller
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

        $this->load->view('view_R_absensi');
        $this->load->view('templates/footer');
    }

    public function get_data($fill_divisi, $fill_tanggal)
    {
        $_POST['fill_divisi'] = $fill_divisi;
        $_POST['fill_tanggal'] = $fill_tanggal;
        $_POST['kategori'] = 'ALL';
        $Riwayat = $this->Riwayat_m->get_data_report($_POST);
        $Riwayat_pegawai = $this->Riwayat_m->get_data_pegawai_report($_POST);
        $i = 0;
        if (!empty($Riwayat_pegawai)) {
            foreach ($Riwayat_pegawai as $k => $v) {
                $checkout = false;
                $keterangan = '';
                $dt_final[$i]['nama_pegawai'] = strtoupper($v['nama_pegawai']);
                $dt_final[$i]['check_in'] = 'Belum Check in';
                $dt_final[$i]['check_out'] = 'Belum Check out';
                $dt_final[$i]['status'] = 'Belum Check in';
                foreach ($Riwayat as $kk => $vv) {
                    if ($vv['id_pegawai'] == $v['id_pegawai']) {
                        $dt_final[$i]['nama_pegawai'] = strtoupper($vv['nama_pegawai']);
                        if ($vv['keterangan'] == 'CHECK IN') {
                            $checkout = true;
                            $keterangan = $vv['keterangan'] . ' (' . $vv['log_time'] . ')<br>';
                            $dt_final[$i]['check_in'] = $keterangan;
                            if (substr($vv['log_time'], 11, 1) == '0') {
                                // echo "pagi";die;
                                $jam_masuk = substr($vv['log_time'], 12, 1);
                            } else {
                                $jam_masuk = substr($vv['log_time'], 11, 2);
                            }
                            if ($jam_masuk <= 13)
                                $dt_final[$i]['status'] = 'Shift 1';
                            else if ($jam_masuk > 14 && $jam_masuk <= 16)
                                $dt_final[$i]['status'] = 'Shift 2';
                            else
                                $dt_final[$i]['status'] = 'Shift 3';
                        }

                        if ($vv['keterangan'] == 'CHECK OUT' && $checkout) {
                            $checkout = false;
                            $keterangan = $vv['keterangan'] . ' (' . $vv['log_time'] . ')<br>';
                            $dt_final[$i]['check_out'] = $keterangan;
                        }
                    }
                }
                $i++;
            }
        } else {
            $dt_final[$i]['nama_pegawai'] = 'Data Kosong';
            $dt_final[$i]['check_in'] = '';
            $dt_final[$i]['check_out'] = '';
            $dt_final[$i]['status'] = '';
        }

        $object = json_decode(json_encode($dt_final), FALSE);
        echo json_encode(array('response' => $object));
    }

    public function get_data_by_id($id)
    {

        $riwayat = $this->Riwayat_m->get_data_by_id($id);

        echo json_encode($riwayat);
    }

    public function get_data_divisi()
    {
        $divisi = $this->Riwayat_m->get_data_divisi();
        $i = 0;
        foreach ($divisi as $key => $value) {
            $dt_divisi[$i]['id_div'] = $value['id_div'];
            $dt_divisi[$i]['nama_div'] = $value['nama_div'];
            $i++;
        }

        $object = json_decode(json_encode($dt_divisi), FALSE);
        echo json_encode($object);
    }
}
