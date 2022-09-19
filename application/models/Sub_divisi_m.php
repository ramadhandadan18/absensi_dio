<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sub_divisi_m extends CI_Model
{

    public function get_data()
    {
        $dt = $this->db
            ->from('master_sub_divisi A')
            ->join('master_divisi B', 'A.id_div = B.id_div', 'left')
            ->order_by('A.id_sub_div', 'ASC')
            ->get()
            ->result_array();
        // echo ($this->db->last_query());
        // die;
        return $dt;
    }

    public function get_data_divisi()
    {
        $dt = $this->db
            ->from('master_divisi')
            ->order_by('id_div', 'ASC')
            ->get()
            ->result_array();
        return $dt;
    }

    public function save_add($data)
    {
        $result = $this->db->insert('master_sub_divisi', $data);
        return $result;
    }

    public function get_data_by_id($id)
    {

        $qy = "
            SELECT
                *
            from
                master_sub_divisi
            where 
                id_sub_div = '" . $id . "'
        ";
        $result = $this->db->query($qy)->result_array();
        return $result;
    }

    public function save_edit($data, $id)
    {
        $this->db->where('id_sub_div', $id);
        $result = $this->db->update('master_sub_divisi', $data);
        return $result;
    }

    public function deleted_data($id)
    {
        $this->db->where('id_sub_div', $id);
        return $this->db->delete('master_sub_divisi');
    }
}
