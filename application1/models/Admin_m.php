<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_m extends CI_Model
{

    public function get_data()
    {
        $dt = $this->db
            ->from('users')
            ->where_in('role', ['1', '3'])
            ->order_by('id', 'ASC')
            ->get()
            ->result_array();
        // echo ($this->db->last_query());
        // die;
        return $dt;
    }

    public function get_data_by_id($id)
    {
        $qy = "
            SELECT
                *
            from
                users
            where 
                id = '$id'
        ";
        $result = $this->db->query($qy)->result_array();
        return $result;
    }

    public function save_add($data)
    {
        $result = $this->db->insert('users', $data);
        return $result;
    }

    public function deleted_data_users($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function save_edit($data, $id)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('users', $data);
        return $result;
    }

    public function deleted_data($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
}
