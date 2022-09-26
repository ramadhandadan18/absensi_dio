<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shift_m extends CI_Model
{
    public function save_add($data)
    {
        $result = $this->db->insert('tb_shift', $data);
        
        return $result;
    }
}
