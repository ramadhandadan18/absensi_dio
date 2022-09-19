<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Divisi_m extends CI_Model
{

    public function get_data()
    {
        $dt = $this->db
            ->from('master_divisi A')
            ->order_by('A.id_div', 'ASC')
            ->get()
            ->result_array();
        // echo ($this->db->last_query());
        // die;
        return $dt;
    }

    public function save_add($data)
    {
        $result = $this->db->insert('master_divisi', $data);
        return $result;
    }

    public function get_data_by_id($id)
    {

        $qy = "
            SELECT
                *
            from
                master_divisi
            where 
                id_div = '" . $id . "'
        ";
        $result = $this->db->query($qy)->result_array();
        return $result;
    }

    public function save_edit($data, $id)
    {
        $this->db->where('id_div', $id);
        $result = $this->db->update('master_divisi', $data);
        return $result;
    }

    public function deleted_data($id)
    {
        $this->db->where('id_div', $id);
        return $this->db->delete('master_divisi');
    }
}
