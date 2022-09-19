<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_m');

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

        $this->load->view('view_Pegawai');
        $this->load->view('templates/footer');
    }

    public function get_data()
    {
        $pegawai = $this->Pegawai_m->get_data();
        $pegawai_area = $this->Pegawai_m->get_pegawai_area();
        $id_pegawai = [];
        if (!empty($pegawai_area)) {
            foreach ($pegawai_area as $key => $value) {
                $id_pegawai[] = $value['id_pegawai'];
            }
        }
        $i = 0;
        if (!empty($pegawai)) {
            foreach ($pegawai as $k => $v) {
                $dt_final[$i]['id_pegawai'] = $v['id_pegawai'];
                $dt_final[$i]['no_pegawai'] = $v['no_pegawai'];
                $dt_final[$i]['nama_pegawai'] = strtoupper($v['nama_pegawai']);
                $dt_final[$i]['lahir'] = $v['tempat_lahir'] . ', ' . $v['tanggal_lahir'];
                $dt_final[$i]['dusun'] = $v['dusun'];
                $dt_final[$i]['rt'] = $v['rt'] . ' / ' . $v['rw'];
                $dt_final[$i]['kelurahan'] = $v['kelurahan'];
                $dt_final[$i]['kecamatan'] = $v['kecamatan'];
                $dt_final[$i]['kabupaten'] = $v['kabupaten'];
                $dt_final[$i]['provinsi'] = $v['provinsi'];
                if ($v['jenis_kelamin'] == '1')
                    $dt_final[$i]['jenis_kelamin'] = 'Laki - Laki';
                else if ($v['jenis_kelamin'] == '2')
                    $dt_final[$i]['jenis_kelamin'] = 'Perempuan';
                $dt_final[$i]['no_ktp'] = $v['no_ktp'];
                $dt_final[$i]['no_telp'] = $v['no_telp'];
                $dt_final[$i]['email'] = $v['email'];
                $dt_final[$i]['no_telp'] = $v['no_telp'];
                $dt_final[$i]['nama_div'] = $v['nama_div'];
                $dt_final[$i]['nama_sub_div'] = $v['nama_sub_div'];
                $dt_final[$i]['email'] = $v['email'];
                $dt_final[$i]['status_area'] = in_array($v['id_pegawai'], $id_pegawai) ? '1' : '0';
                $i++;
            }
        } else {
            $dt_final[$i]['id_pegawai'] = '';
            $dt_final[$i]['no_pegawai'] = 'Data kosong';
            $dt_final[$i]['nama_pegawai'] = '';
            $dt_final[$i]['lahir'] = '';
            $dt_final[$i]['dusun'] = '';
            $dt_final[$i]['rt'] = '';
            $dt_final[$i]['kelurahan'] = '';
            $dt_final[$i]['kecamatan'] = '';
            $dt_final[$i]['kabupaten'] = '';
            $dt_final[$i]['provinsi'] = '';
            $dt_final[$i]['jenis_kelamin'] = '';
            $dt_final[$i]['no_ktp'] = '';
            $dt_final[$i]['no_telp'] = '';
            $dt_final[$i]['email'] = '';
            $dt_final[$i]['no_telp'] = '';
            $dt_final[$i]['nama_div'] = '';
            $dt_final[$i]['nama_sub_div'] = '';
            $dt_final[$i]['email'] = '';
            $dt_final[$i]['status_area'] = '';
        }
        // echopre($dt_final);
        $object = json_decode(json_encode($dt_final), FALSE);
        // $this->echopre($object);
        // die;
        echo json_encode(array('response' => $object));
    }

    public function get_table_area($id_pegawai)
    {
        $area = $this->Pegawai_m->get_table_area($id_pegawai);

        $i = 0;
        if (!empty($area)) {
            foreach ($area as $k => $v) {
                $dt_final[$i]['id_pegawai'] = $v['id_pegawai'];
                $dt_final[$i]['id_data_area'] = $v['id_data_area'];
                $dt_final[$i]['nama_area'] = strtoupper($v['nama_area']);
                $i++;
            }
        } else {
            $dt_final[$i]['id_pegawai'] = '';
            $dt_final[$i]['id_data_area'] = '';
            $dt_final[$i]['nama_area'] = '';
        }
        $object = json_decode(json_encode($dt_final), FALSE);
        // $this->echopre($object);
        // die;
        echo json_encode(array('response' => $object));
    }


    public function get_data_area()
    {
        $area = $this->Pegawai_m->get_data_area();
        $dt[0]['id_area'] = '';
        $dt[0]['nama_area'] = '';
        $i = 1;
        foreach ($area as $key => $value) {
            $dt[$i]['id_area'] = $value['id_area'];
            $dt[$i]['nama_area'] = $value['nama_area'];
            $i++;
        }

        $object = json_decode(json_encode($dt), FALSE);
        echo json_encode($object);
    }

    public function get_data_divisi()
    {
        $divisi = $this->Pegawai_m->get_data_divisi();
        $i = 0;
        foreach ($divisi as $key => $value) {
            $dt_divisi[$i]['id_div'] = $value['id_div'];
            $dt_divisi[$i]['nama_div'] = $value['nama_div'];
            $i++;
        }
        // echopre($dt_divisi);
        // die;
        $object = json_decode(json_encode($dt_divisi), FALSE);
        echo json_encode($object);
    }

    public function get_data_sub_divisi($id_div = null)
    {
        $sub_divisi = $this->Pegawai_m->get_data_sub_divisi($id_div);
        $i = 0;
        $dt_sub_divisi = [];
        foreach ($sub_divisi as $key => $value) {
            $dt_sub_divisi[$i]['id_sub_div'] = $value['id_sub_div'];
            $dt_sub_divisi[$i]['nama_sub_div'] = $value['nama_sub_div'];
            $i++;
        }
        //echopre($sub_divisi);
        //die;
        $object = json_decode(json_encode($dt_sub_divisi), FALSE);
        echo json_encode($object);
    }

    public function save_add()
    {
        $last_no_regis = $this->Pegawai_m->last_no_regis();
        if (empty($last_no_regis)) {
            $_POST['no_pegawai'] = '001';
        } else {
            $no_regis_nol = "0";
            foreach ($last_no_regis as $key => $value) {
                for ($aa = 0; $aa <= 2; $aa++) {
                    if (substr($value['no_pegawai'], $aa, 1) != '0') {
                        $no_regis = strval(substr($value['no_pegawai'], $aa)) + 1;
                        $no_regis_nol = $aa;
                    }
                }
            }
            if ($no_regis_nol != 0) {
                $no_regis_ = '';
                $_POST['no_pegawai'] = str_pad($no_regis_, $no_regis_nol, "0") . $no_regis;
            } else {
                $_POST['no_pegawai'] = $no_regis;
            }
        }
        // echopre($_POST);
        // die;


        $kd_register = $_POST['no_pegawai'];
        $kd_nip = $kd_register;

        $msg = "Error Input";
        $data = array(
            'no_pegawai' => $_POST['no_pegawai'],
            'nama_pegawai' => $_POST['nama_pegawai'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'tanggal_lahir' => $_POST['tanggal_lahir'],
            'dusun' => $_POST['dusun'],
            'rt' => $_POST['rt'],
            'rw' => $_POST['rw'],
            'kelurahan' => $_POST['kelurahan'],
            'kecamatan' => $_POST['kecamatan'],
            'kabupaten' => $_POST['kabupaten'],
            'provinsi' => $_POST['provinsi'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'no_ktp' => $_POST['no_ktp'],
            'no_telp' => $_POST['no_telp'],
            'email' => $_POST['email'],
            'no_telp' => $_POST['no_telp'],
            'id_div' => $_POST['id_div'],
            'id_sub_div' => $_POST['id_sub_div'],
            'email' => $_POST['email']
        );

        $result = $this->Pegawai_m->save_add($data);
        $id_pegawai = $this->Pegawai_m->cek_id($kd_nip);
        $data = [];
        $data = array(
            'username' => $kd_nip,
            'password' => hash('md5', $kd_nip),
            'role' => 2,
            'id_pegawai' => $id_pegawai
        );
        $this->Pegawai_m->save_users($data);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode($msg);
        }
    }

    public function save_edit_area()
    {
        $result = false;
        if (!empty($_POST['id_area'])) {
            $data = [];
            $data = array(
                'id_area' => $_POST['id_area'],
                'id_pegawai' => $_POST['id_pegawai']
            );
            $result = $this->Pegawai_m->save_area($data);
        } else {
            $msg = "Pilih area";
        }

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode($msg);
        }
    }

    public function save_edit_jam()
    {
        $msg = 'Input error';
        $id = $this->input->post('id_pegawai');
        $data = array(
            'in_day' => $_POST['in_day_jam'],
            'out_day' => $_POST['out_day_jam'],
            'in_day_off' => $_POST['in_day_off_jam'],
            'out_day_off' => $_POST['out_day_off_jam'],
        );
        $result = $this->Pegawai_m->save_edit($data, $id);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode($msg);
        }
    }

    public function get_data_by_id($id)
    {

        $pegawai = $this->Pegawai_m->get_data_by_id($id);
        foreach ($pegawai as $key => $value) {
            $data['id_pegawai'] = $value['id_pegawai'];
            $data['no_pegawai'] = $value['no_pegawai'];
            $data['nama_pegawai'] = strtoupper($value['nama_pegawai']);
            $data['tempat_lahir'] = $value['tempat_lahir'];
            $data['tanggal_lahir'] = $value['tanggal_lahir'];
            $data['dusun'] = $value['dusun'];
            $data['rt'] = $value['rt'];
            $data['rw'] = $value['rw'];
            $data['kelurahan'] = $value['kelurahan'];
            $data['kecamatan'] = $value['kecamatan'];
            $data['kabupaten'] = $value['kabupaten'];
            $data['provinsi'] = $value['provinsi'];
            $data['jenis_kelamin'] = $value['jenis_kelamin'];
            $data['no_ktp'] = $value['no_ktp'];
            $data['no_telp'] = $value['no_telp'];
            $data['email'] = $value['email'];
            $data['no_telp'] = $value['no_telp'];
            $data['id_div'] = $value['id_div'];
            $data['id_sub_div'] = $value['id_sub_div'];
            $data['email'] = $value['email'];
        }
        $data_obj = (object)$data;
        echo json_encode($data_obj);
    }

    public function save_edit()
    {
        $msg = "Error Edit";
        $id = $this->input->post('id_pegawai');
        $data = array(
            'no_ktp' => $_POST['no_ktp'],
            'nama_pegawai' => $_POST['nama_pegawai'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'tanggal_lahir' => $_POST['tanggal_lahir'],
            'dusun' => $_POST['dusun'],
            'rt' => $_POST['rt'],
            'rw' => $_POST['rw'],
            'kelurahan' => $_POST['kelurahan'],
            'kecamatan' => $_POST['kecamatan'],
            'kabupaten' => $_POST['kabupaten'],
            'provinsi' => $_POST['provinsi'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'no_ktp' => $_POST['no_ktp'],
            'no_telp' => $_POST['no_telp'],
            'email' => $_POST['email'],
            'no_telp' => $_POST['no_telp'],
            'id_div' => $_POST['id_div'],
            'id_sub_div' => $_POST['id_sub_div'],
            'email' => $_POST['email']
        );

        $result = $this->Pegawai_m->save_edit($data, $id);
        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode($msg);
        }
    }

    public function save_delete()
    {
        $id = $this->input->post('id');
        $users_delete = $this->Pegawai_m->deleted_data_users($id);
        $result = $this->Pegawai_m->deleted_data($id);
        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function save_delete_area()
    {
        $id = $this->input->post('id');
        $result = $this->Pegawai_m->deleted_data_area($id);
        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
}
