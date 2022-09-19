<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat_m extends CI_Model
{

    public function get_data($dt)
    {
        if ($dt['fill_tanggal'] != 'ALL') {
            $curr_date = $dt['fill_tanggal'];
            $this->db->where('DATE(a.log_time)', $curr_date);
        }

        if ($dt['fill_divisi'] != 'ALL') {
            $this->db->where('b.id_div', $dt['fill_divisi']);
        }

        $data = $this->db
            ->select('a.*,b.*,c.*,DATE(a.log_time) as tanggal')
            ->from('data_log a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            ->join('master_area c', 'a.id_area = c.id_area', 'left')
            ->order_by('a.log_time', 'ASC')
            ->order_by('a.id_pegawai', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $data;
    }

    public function get_data1($dt)
    {

        if ($dt['fill_bulan'] != 'ALL') {
            $tahun = $dt['fill_tahun'];
            $bulan = $dt['fill_bulan'];
            $curr_date = $tahun . '-' . $bulan;
            $this->db->where('substr(a.log_time,1,7)', $curr_date);
        }

        if ($dt['fill_divisi'] != 'ALL') {
            $this->db->where('b.id_div', $dt['fill_divisi']);
        }

        $data = $this->db
            ->select('a.*,b.*,c.*,d.nama_div, e.nama_sub_div, DATE(a.log_time) as tanggal')
            ->from('data_log a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            ->join('master_area c', 'a.id_area = c.id_area', 'left')
            ->join('master_divisi d', 'd.id_div = b.id_div', 'left')
            ->join('master_sub_divisi e', 'e.id_sub_div = b.id_sub_div', 'left')
            ->order_by('a.log_time', 'ASC')
            ->order_by('a.id_pegawai', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();
        // die;
        return $data;
    }

    public function get_data_lembur($dt)
    {

        if ($dt['fill_bulan'] != 'ALL') {
            $tahun = $dt['fill_tahun'];
            $bulan = $dt['fill_bulan'];
            $curr_date = $tahun . '-' . $bulan;
            $this->db->where('substr(a.tgl_lembur,1,7)', $curr_date);
        }

        if ($dt['fill_divisi'] != 'ALL') {
            $this->db->where('b.id_div', $dt['fill_divisi']);
        }

        $data = $this->db
            ->select('a.id_pegawai, sum(a.jumlah_jam) AS jumlah_lembur, b.nama_pegawai')
            ->from('lembur a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            // ->join('data_log c', 'a.id_pegawai = c.id_pegawai', 'left')
            ->where('a.lembur_status = 1')
            ->group_by('a.id_pegawai', 'ASC')
            ->group_by('b.nama_pegawai', 'ASC')
            ->order_by('a.id_pegawai', 'ASC')
            ->order_by('a.tgl_lembur', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();
        // die;
        return $data;
    }

    public function get_data_pegawai($dt)
    {
        if ($dt['fill_tanggal'] != 'ALL') {
            $curr_date = $dt['fill_tanggal'];
            $this->db->where('DATE(a.log_time)', $curr_date);
        }

        if ($dt['fill_divisi'] != 'ALL') {
            $this->db->where('b.id_div', $dt['fill_divisi']);
        }

        // if ($dt['kategori'] != 'ALL') {
        //     $this->db->where('b.kategori', $dt['kategori']);
        // }
        $data = $this->db
            ->select('a.id_pegawai,DATE(a.log_time) as tanggal')
            ->from('data_log a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            ->order_by('a.log_time', 'ASC')
            ->group_by('a.id_pegawai,DATE(a.log_time)')
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $data;
    }

    public function get_data_report($dt)
    {
        if ($dt['fill_tanggal'] != 'ALL') {
            $curr_date = $dt['fill_tanggal'];
            $this->db->where('DATE(a.log_time)', $curr_date);
            $this->db->or_where("(DATE(a.log_time) = DATE_ADD('" . $curr_date . "', INTERVAL 1 DAY) AND a.keterangan = 'CHECK OUT')");
        } else {
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
            $this->db->where('DATE(a.log_time)', $curr_date);
            $this->db->or_where("(DATE(a.log_time) = DATE_ADD('" . $curr_date . "', INTERVAL 1 DAY) AND a.keterangan = 'CHECK OUT')");
        }

        if ($dt['fill_divisi'] != 'ALL') {
            $this->db->where('b.id_div', $dt['fill_divisi']);
        }

        $data = $this->db
            ->select('a.*,b.*,c.*,DATE(a.log_time) as tanggal')
            ->from('data_log a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            ->join('master_area c', 'a.id_area = c.id_area', 'left')
            ->order_by('a.log_time', 'ASC')
            ->order_by('a.id_pegawai', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();
        // die;
        return $data;
    }

    public function get_data_report_bulanan($dt)
    {
        if ($dt['fill_bulan'] != 'ALL') {
            $tahun = $dt['fill_tahun'];
            $bulan = $dt['fill_bulan'];
            $curr_date = $tahun . '-' . $bulan;
            $this->db->where('substr(a.log_time,1,7)', $curr_date);
            // $this->db->or_where("(DATE(a.log_time) = DATE_ADD('" . $tahun . '-' . ($bulan + 1) . "-01') AND A.keterangan = 'CHECK OUT')");
        }

        if ($dt['fill_divisi'] != 'ALL') {
            $this->db->where('b.id_div', $dt['fill_divisi']);
        }

        $data = $this->db
            ->select('a.*,b.nama_pegawai,b.no_pegawai,c.*,DATE(a.log_time) as tanggal,d.jumlah_jam')
            ->from('data_log a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            ->join('master_area c', 'a.id_area = c.id_area', 'left')
            ->join('lembur d', 'DATE(a.log_time) = d.tgl_lembur', 'left')
            ->where('b.del', '0')
            ->order_by('a.log_time', 'ASC')
            ->order_by('a.id_pegawai', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();
        // die;
        return $data;
    }

    public function get_jam_chek_out($dt)
    {
        $this->db->where("DATE(a.log_time) = DATE_ADD('" . $dt['tanggal'] . "', INTERVAL 1 DAY)");
        $this->db->where('a.id_pegawai', $dt['id_pegawai']);
        $this->db->where('a.keterangan', 'CHECK OUT');
        $data = $this->db
            ->select('a.*, d.jumlah_jam')
            ->from('data_log a')
            ->join('lembur d', 'DATE(a.log_time) = d.tgl_lembur', 'left')
            ->order_by('a.log_time', 'ASC')
            ->order_by('a.id_pegawai', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();
        // die;
        return $data;
    }

    public function get_data_pegawai_report($dt)
    {
        if ($dt['fill_divisi'] != 'ALL') {
            $this->db->where('a.id_div', $dt['fill_divisi']);
        }

        $data = $this->db
            ->select('a.id_pegawai,a.nama_pegawai,a.no_pegawai')
            ->from('master_pegawai a')
            ->order_by('a.id_pegawai', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $data;
    }

    public function get_data_pegawai_report_bulanan($dt)
    {
        if ($dt['fill_divisi'] != 'ALL') {
            $this->db->where('b.id_div', $dt['fill_divisi']);
        }

        if ($dt['fill_bulan'] != 'ALL') {
            $tahun = $dt['fill_tahun'];
            $bulan = $dt['fill_bulan'];
            $curr_date = $tahun . '-' . $bulan;
            $this->db->where('substr(a.log_time,1,7)', $curr_date);
        }

        $data = $this->db
            ->select('b.no_pegawai,b.nama_pegawai,DATE(a.log_time) as tanggal')
            ->from('data_log a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            ->where('a.keterangan', 'CHECK IN')
            ->where('b.del', '0')
            ->order_by('a.log_time', 'ASC')
            ->order_by('a.id_pegawai', 'ASC')
            ->group_by('b.no_pegawai,b.nama_pegawai,tanggal')
            ->get()
            ->result_array();
        //echopre($this->db);
        return $data;
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

    public function get_data_absen($dt)
    {
        $data = $this->db
            ->select('a.*,b.*,c.*,DATE(a.log_time) as tanggal')
            ->from('data_log a')
            ->join('master_pegawai b', 'a.id_pegawai = b.id_pegawai', 'left')
            ->join('master_area c', 'a.id_area = c.id_area', 'left')
            ->order_by('a.log_time', 'ASC')
            ->order_by('a.id_pegawai', 'ASC')
            ->get()
            ->result_array();
        // echo $this->db->last_query();die;
        return $data;
    }

    public function save_edit($data, $id)
    {
        $this->db->where('id_log', $id);
        $result = $this->db->update('data_log', $data);
        return $result;
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
}
