<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Submission_m extends CI_Model
{

    public function get_data($date)
    {
        if($date == '')
        {
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d'); 
            $this->db->where('DATE(a.submission_tanggal)',$curr_date);
        }else{
            $curr_date = $date; 
            $this->db->where('DATE(a.submission_tanggal)',$curr_date);
        }
        $this->db->where('a.submission_create_by',$_SESSION['user_id']);
        $dt = $this->db
            ->from('data_submission a')            
            ->order_by('a.submission_id', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $dt;
    }

    public function get_data_approval($date)
    {
        if($date == '')
        {
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d'); 
            $this->db->where('DATE(a.submission_tanggal)',$curr_date);
        }else{
            $curr_date = $date; 
            $this->db->where('DATE(a.submission_tanggal)',$curr_date);
        }        
        $dt = $this->db
            ->select('a.*,b.pegawai_nama as pengganti,c.pegawai_nama as pemohon')
            ->from('data_submission a') 
            ->join('master_pegawai b','a.submission_pegawai = b.pegawai_id','left')
            ->join('master_pegawai c','a.submission_create_by = c.pegawai_id','left')
            ->order_by('a.submission_id', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $dt;
    }

    public function get_my_data($username)
    {
        $dt = $this->db
            ->from('master_pegawai a')
            ->where('a.nip_pegawai',$username)
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
            ->order_by('pegawai_id', 'ASC')
            ->get()
            ->result_array();
        return $dt;
    }

    public function save_add($data)
    {
        $result = $this->db->insert('data_submission', $data);
        return $result;
    }

    public function get_data_by_id($id)
    {

        $qy = "
            SELECT
                *
            from
                data_submission
            where 
                submission_id = '" . $id . "'
        ";
        $result = $this->db->query($qy)->result_array();
        return $result;
    }

    public function save_edit($data, $id)
    {
        $this->db->where('submission_id', $id);
        $result = $this->db->update('data_submission', $data);
        return $result;
    }

    public function deleted_data($id)
    {
        $this->db->where('submission_id', $id);
        return $this->db->delete('data_submission');
    }    
}
