<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lembur_m extends CI_Model
{

    public function get_data($date)
    {
        if ($date == '') {
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
            $this->db->where('DATE(a.tgl_lembur)', $curr_date);
        } else {
            $curr_date = $date;
            $this->db->where('DATE(a.tgl_lembur)', $curr_date);
        }
        $this->db->where('a.id_pegawai', $_SESSION['id_pegawai']);
        $dt = $this->db
            ->from('lembur a')
            ->order_by('a.id_lembur', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();
        // die;
        return $dt;
    }

    public function cek_jam($date, $id_pegawai)
    {
        // if ($date == '') {
        //     $date = new DateTime("now");
        //     $curr_date = $date->format('Y-m');
        //     $this->db->where('DATE(a.tgl_lembur)', $curr_date);
        // } else {
        //     $date = new DateTime("now");
        //     $curr_date = $date->format('Y-m');
        //     //$this->db->where('id_pegawai', $id_pegawai);
        //     $this->db->where("DATE_FORMAT(tgl_lembur,'%Y-%m') = '" . $curr_date . "'");
        //}
        $date = new DateTime($date);
        $curr_date = $date->format('Y-m');
        $data = $this->db
            ->select('sum(a.jumlah_jam) AS jumlah_lembur')
            ->from('lembur a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            ->where('a.id_pegawai', $id_pegawai)
            ->where("DATE_FORMAT(tgl_lembur,'%Y-%m') = '" . $curr_date . "'")
            ->order_by('a.id_pegawai', 'ASC')
            ->order_by('a.tgl_lembur', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();
        // die;
        return isset($data[0]['jumlah_lembur']) ? $data[0]['jumlah_lembur'] : 0;
    }

    public function get_data_approval($date)
    {
        if ($date == '') {
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
            $this->db->where('DATE(a.tgl_lembur)', $curr_date);
        } else {
            $curr_date = $date;
            $this->db->where('DATE(a.tgl_lembur)', $curr_date);
        }
        $dt = $this->db
            ->select('a.*,c.nama_pegawai as pemohon')
            ->from('lembur a')
            ->join('master_pegawai c', 'a.id_pegawai = c.id_pegawai', 'left')
            ->order_by('a.id_lembur', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $dt;
    }

    public function get_my_data($username)
    {
        $dt = $this->db
            ->from('master_pegawai a')
            ->where('a.no_pegawai', $username)
            ->limit(1)
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $dt;
    }

    public function get_data_pegawai()
    {
        $dt = $this->db
            ->from('master_pegawai')
            ->order_by('id_pegawai', 'ASC')
            ->get()
            ->result_array();
        return $dt;
    }

    public function save_add($data)
    {
        $result = $this->db->insert('lembur', $data);
        return $result;
    }

    public function get_data_by_id($id)
    {

        $qy = "
            SELECT
                *
            from
                lembur
            where 
                id_lembur = '" . $id . "'
        ";
        $result = $this->db->query($qy)->result_array();
        return $result;
    }

    public function get_data_lembur($dt)
    {

        if ($dt['fill_bulan'] != 'ALL') {
            $tahun = $dt['fill_tahun'];
            $bulan = $dt['fill_bulan'];
            $curr_date = $tahun . '-' . $bulan;
            $this->db->where('substr(a.log_time,1,7)', $curr_date);
        }

        if ($dt['fill_divisi'] != 'ALL') {
            $this->db->where('b.id_div', $dt['fill_divisi']);
        }
        $data = $this->db
            ->select('a.*,b.*,c.*,d.nama_div, e.nama_sub_div, DATE(a.log_time) as tanggal')
            ->from('data_log a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            ->join('lembur c', 'a.id_lembur = b.id_lembur', 'left')
            ->join('master_divisi d', 'd.id_div = b.id_div', 'left')
            ->join('master_sub_divisi e', 'e.id_sub_div = b.id_sub_div', 'left')
            ->order_by('c.log_time', 'ASC')
            ->order_by('a.id_pegawai', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $data;
    }

    public function save_edit($data, $id)
    {
        $this->db->where('id_lembur', $id);
        $result = $this->db->update('lembur', $data);
        return $result;
    }

    public function deleted_data($id)
    {
        $this->db->where('id_lembur', $id);
        return $this->db->delete('lembur');
    }
}
