<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Area_m extends CI_Model
{

    public function get_data()
    {
        $dt = $this->db
            ->from('master_area A')
            ->order_by('A.id_area', 'ASC')
            ->get()
            ->result_array();
        // echo ($this->db->last_query());
        // die;
        return $dt;
    }

    public function get_data_pegawai($id_area)
    {
        $dt = $this->db
            ->from('data_area aa')
            ->join('master_pegawai a', 'aa.id_pegawai = a.id_pegawai', 'left')
            ->join('master_divisi b', 'a.id_div = b.id_div', 'left')
            ->join('master_sub_divisi c', 'a.id_sub_div = c.id_sub_div', 'left')
            ->where('aa.id_area', $id_area)
            ->order_by('aa.id_pegawai', 'ASC')
            ->get()
            ->result_array();
        // echo ($this->db->last_query());
        // die;
        return $dt;
    }

    public function save_add($data)
    {
        $result = $this->db->insert('master_area', $data);
        return $result;
    }

    public function get_data_by_id($id)
    {
        $ids = join("','", $id);
        // return $ids;

        $qy = "
            SELECT
                *
            from
                master_area
            where 
                id_area in ('$ids')
        ";
        $result = $this->db->query($qy)->result_array();
        return $result;
    }

    public function get_data_by_id_2($id)
    {
        $qy = "
            SELECT
                *
            from
                master_area
            where 
                id_area = '$id'
        ";
        $result = $this->db->query($qy)->result_array();
        return $result;
    }

    public function get_area_by_id_data($id)
    {

        $qy = "
            SELECT
                *
            from
                data_area
            where 
                id_pegawai = '" . $id . "'
        ";
        $result = $this->db->query($qy)->result_array();
        $id_area = [];
        foreach ($result as $k => $v) {
            $id_area[$k] = $v['id_area'];
        }
        return $id_area;
    }

    public function save_edit($data, $id)
    {
        $this->db->where('id_area', $id);
        $result = $this->db->update('master_area', $data);
        return $result;
    }

    public function deleted_data($id)
    {
        $this->db->where('id_area', $id);
        return $this->db->delete('master_area');
    }
}
