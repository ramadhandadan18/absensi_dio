<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile_mo_m extends CI_Model
{

    public function get_data()
    {
        $dt = $this->db
            ->from('data_log a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            ->join('master_area c', 'a.id_area = c.id_area', 'left')
            ->order_by('a.log_id', 'ASC')
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

    public function get_data_by_id($id)
    {

        $qy = "
            SELECT
                *
            from
                data_log
            where 
                id_log = '" . $id . "'
        ";
        $result = $this->db->query($qy)->row();
        return $result;
    }

    public function get_data_user()
    {
        $dt = $this->db
            ->from('users a')
            ->where('a.id_pegawai', $_SESSION['id_pegawai'])
            ->get()
            ->result_array();
        // echo $this->db->last_query();
        // die;
        return $dt;
    }

    public function save_edit($data, $id_edit)
    {
        $this->db->where('id', $id_edit);
        $result = $this->db->update('users', $data);
        return $result;
    }
}
