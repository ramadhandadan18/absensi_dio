<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_m extends CI_Model
{

    public function get_data()
    {
        $dt = $this->db
            ->select('a.*, b.nama_div, c.nama_sub_div')
            ->from('master_pegawai a')
            ->join('master_divisi b', 'a.id_div = b.id_div', 'left')
            ->join('master_sub_divisi c', 'a.id_sub_div = c.id_sub_div', 'left')
            ->where('del', '0')
            ->order_by('a.id_pegawai', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();
        // die;
        return $dt;
    }

    public function get_pegawai_area()
    {
        $dt = $this->db
            ->select('a.id_pegawai')
            ->from('data_area a')
            ->order_by('a.id_area', 'ASC')
            ->group_by('a.id_pegawai')
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $dt;
    }

    public function get_table_area($id_pegawai)
    {
        $dt = $this->db
            ->from('data_area a')
            ->join('master_area b', 'a.id_area = b.id_area', 'left')
            ->join('master_pegawai c', 'a.id_pegawai = c.id_pegawai', 'left')
            ->where('a.id_pegawai', $id_pegawai)
            ->order_by('a.id_area', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $dt;
    }

    public function last_no_regis()
    {
        $dt = $this->db
            ->from('master_pegawai')
            ->order_by('id_pegawai', 'DESC')
            ->limit(1)
            ->get()
            ->result_array();
        return $dt;
    }

    public function get_data_area()
    {
        $dt = $this->db
            ->from('master_area')
            ->order_by('id_area', 'ASC')
            ->get()
            ->result_array();
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

    public function get_data_sub_divisi($id_div)
    {
        if (!empty($id_div)) {
            $this->db->where('id_div', $id_div);
        }
        $dt = $this->db
            ->from('master_sub_divisi')
            ->order_by('id_sub_div', 'ASC')
            ->get()
            ->result_array();
        return $dt;
    }

    public function cek_id($nip)
    {
        $dt = $this->db
            ->select('id_pegawai')
            ->from('master_pegawai')
            ->where('no_pegawai', $nip)
            ->limit(1)
            ->get()
            ->row()->id_pegawai;
        return $dt;
    }

    public function save_add($data)
    {
        $result = $this->db->insert('master_pegawai', $data);
        return $result;
    }

    public function save_users($data)
    {
        $result = $this->db->insert('users', $data);
        return $result;
    }

    public function save_area($data)
    {
        $result = $this->db->insert('data_area', $data);
        return $result;
    }

    public function deleted_data_users($id)
    {
        $this->db->where('id_pegawai', $id);
        return $this->db->delete('users');
    }

    public function save_upd_users($data, $id)
    {
        $this->db->where('id_pegawai', $id);
        $result = $this->db->update('users', $data);
        return $result;
    }

    public function get_data_by_id($id)
    {

        $qy = "
            SELECT
                *
            from
                master_pegawai
            where 
                id_pegawai = '" . $id . "'
        ";
        $result = $this->db->query($qy)->result_array();
        return $result;
    }

    public function get_data_by_id_2($field, $table, $clause, $id)
    {

        $qy = "
            SELECT
                " . $field . "
            from
                " . $table . "
            where 
                " . $clause . " = '" . $id . "'
        ";
        $result = $this->db->query($qy)->row()->$field;
        return $result;
    }

    public function save_edit($data, $id)
    {
        $this->db->where('id_pegawai', $id);
        $result = $this->db->update('master_pegawai', $data);
        // echo $this->db->last_query();die;        
        return $result;
    }

    public function deleted_data($id)
    {
        $this->db->where('id_pegawai', $id);
        return $this->db->delete('master_pegawai');
    }

    public function deleted_data_area($id)
    {
        $this->db->where('id_data_area', $id);
        return $this->db->delete('data_area');
    }
}
