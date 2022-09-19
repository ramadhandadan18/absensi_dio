<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_m extends CI_Model
{

    public function get_data()
    {
        $dt = $this->db
            ->from('data_log a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            ->join('master_area c', 'a.id_area = c.id_area', 'left')
            ->order_by('a.id_log', 'ASC')
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

    public function get_my_data_log($id_pegawai)
    {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d ');

        $dt = $this->db
            ->from('data_log a')
            ->where('a.id_pegawai', $id_pegawai)
            ->where('DATE(a.log_time)', $curr_date)
            ->get()
            ->result_array();

        return $dt;
    }

    public function check_data_log($id_pegawai, $keterangan)
    {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d ');
        $dt = $this->db
            ->from('data_log a')
            ->where('a.id_pegawai', $id_pegawai)
            ->where('DATE(a.log_time)', $curr_date)
            ->where('a.keterangan', $keterangan)
            ->get()
            ->result_array();
        // echo $this->db->last_query();
        // die;
        return $dt;
    }

    public function check_data_log_check_out($id_pegawai, $keterangan)
    {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d ');

        $this->db->where('DATE(a.log_time)', $curr_date)
            ->where('a.keterangan', $keterangan)
            ->or_where("(DATE(a.log_time) = DATE_ADD('" . $curr_date . "', INTERVAL -1 DAY) AND a.keterangan = 'CHECK IN')");

        $dt = $this->db
            ->from('data_log a')
            ->where('a.id_pegawai', $id_pegawai)
            ->get()
            ->result_array();
        // echo $this->db->last_query();
        // die;
        return $dt;
    }

    public function get_data_by_id($id)
    {

        $qy = "
            SELECT
                A.*, B.*, C.*
            FROM
                data_log A
            LEFT JOIN master_pegawai B ON A.id_pegawai = B.id_pegawai
            LEFT JOIN master_area C ON A.id_area = C.id_area
            WHERE
                A.id_log = '" . $id . "'
        ";
        $result = $this->db->query($qy)->result_array();
        return $result;
    }

    public function save_log($data)
    {
        $result = $this->db->insert('data_log', $data);
        return $result;
    }
}
