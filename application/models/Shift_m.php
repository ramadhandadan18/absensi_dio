<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shift_m extends CI_Model
{
    public function get_data($periode)
    {
        $dt = $this->db
            ->select('a.*, b.no_pegawai, b.nama_pegawai, b.no_telp, DATE_FORMAT(a.date, "%d") as date, DATE_FORMAT(a.date, "%Y-%m") as periode')
            ->from('tb_shift a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            ->where('b.del', '0')
            ->where('DATE_FORMAT(a.date, "%Y-%m") = ', $periode)
            // ->order_by('a.id_pegawai', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();
        // die;
        return $dt;
    }

    public function save_add($data)
    {
        $result = $this->db->insert('tb_shift', $data);
        
        return $result;
    }
}
