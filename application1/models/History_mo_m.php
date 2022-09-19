<?php

defined('BASEPATH') or exit('No direct script access allowed');

class History_mo_m extends CI_Model
{

    public function get_data()
    {
        $dt = $this->db
            ->from('data_log a')
            ->join('master_pegawai b','a.id_pegawai = b.id_pegawai','left')
            ->join('master_area c','a.id_area = c.id_area','left')
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
            ->where('a.no_pegawai',$username)
            ->limit(1)
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $dt;
    }

    public function get_my_data_log($id_pegawai,$date = '')
    {   
        if($date == '')
        {
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d'); 
            $this->db->where('DATE(a.log_time)',$curr_date);
        }else{
            $curr_date = $date; 
            $this->db->where('DATE(a.log_time)',$curr_date);
        }
        $dt = $this->db
            ->from('data_log a')
            ->where('a.id_pegawai',$id_pegawai)
            ->limit(6)
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $dt;
    }
}
