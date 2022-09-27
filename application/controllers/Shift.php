<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shift extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Shift_m');
        $this->load->model('Pegawai_m');
        $this->load->library('PHPExcel');

        if (!$this->session->userdata('is_login') == true) {
            redirect('login');
        }

        if ($_SESSION['role'] != '1') {
            redirect('logout');
        }
    }

    public function index()
    {
        $periode = date('Y-m');
        $data = [
            "periode" => $periode
        ];

        $this->load->view('templates/bar');

        $this->load->view('view_Shift', $data);
        $this->load->view('templates/footer');
    }

    public function get_data()
    {
        // echopre($_GET);
        $date_arr = $this->getDateInMonth($_GET['periode']);
        // echopre($date_arr);
        $shift = $this->Shift_m->get_data($_GET['periode']);

        // echopre($shift);
        $shiftMap = [];
        foreach ($shift as $k => $v) {
            $shiftMap[$v['id_pegawai']]['no_pegawai'] = $v['no_pegawai'];
            $shiftMap[$v['id_pegawai']]['nama_pegawai'] = $v['nama_pegawai'];
            $shiftMap[$v['id_pegawai']]['no_telp'] = $v['no_telp'];
            $shiftMap[$v['id_pegawai']]['shift'][$v['date']] = $v['shift'];
            // foreach ($date_arr as $kk => $vv) {
            //     $shiftMap[$v['id_pegawai']][$vv['date']] = $v['date'] == $vv['date'] ? $v['shift'] : "";
            // }
        }
        // echopre(($shiftMap));
        $data_shift = [];
        $itr = 0;
        foreach ($shiftMap as $k => $v) {
            $data_shift[$itr]['no_pegawai'] = $v['no_pegawai'];
            $data_shift[$itr]['nama_pegawai'] = $v['nama_pegawai'];
            $data_shift[$itr]['no_telp'] = $v['no_telp'];
            foreach ($date_arr as $kk => $vv) {
                $data_shift[$itr][$vv['date']] = isset($v['shift'][$vv['date']]) ? $v['shift'][$vv['date']] : "";
            }
            $itr++;
        }

        // echopre($data_shift);

        $object = json_decode(json_encode($data_shift), FALSE);
        echo json_encode(array('response' => $object));
    }

    public function getHeaderDate()
    {
        $date_start = $_GET['periode'].'-01';
        $start = $month = strtotime($date_start.'-01');
        $end = date("Y-m-t", strtotime($date_start));
        $end_date = date("Y-m-d", strtotime($end . '+1 day'));

        // echopre($end_date);
        $period = new DatePeriod(
            new DateTime($date_start),
            new DateInterval('P1D'),
            new DateTime($end_date)
        );

        foreach ($period as $key => $value) {
            $date_arr[$key]['date'] = $value->format('d');
            $date_arr[$key]['day'] = $value->format('D');
        }

        $object = json_decode(json_encode($date_arr), FALSE);
        echo json_encode($object);
    }

    public function getDateInMonth($periode){
        $date_start = $periode.'-01';
        $start = $month = strtotime($date_start.'-01');
        $end = date("Y-m-t", strtotime($date_start));
        $end_date = date("Y-m-d", strtotime($end . '+1 day'));

        // echopre($end_date);
        $period = new DatePeriod(
            new DateTime($date_start),
            new DateInterval('P1D'),
            new DateTime($end_date)
        );

        foreach ($period as $key => $value) {
            $date_arr[$key]['date'] = $value->format('d');
            $date_arr[$key]['day'] = $value->format('D');
        }

        return $date_arr;
    }

    public function download_template_jadwal(){
        $date = $this->getDateInMonth($_GET['periode']);
        // echopre($date);
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('PT. Delta Indratama Orion')
             ->setLastModifiedBy('PT. Delta Indratama Orion')
             ->setTitle("Template Jadwal Shift")
             ->setSubject("Jadwal Shift Pegawai")
             ->setDescription("Template untuk upload jadwal shift pegawai");

        
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Template Jadwal Shift PT. Delta Indratama Orion"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:AI1'); // Set Merge Cell pada kolom A1 sampai F1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        $excel->setActiveSheetIndex(0)->setCellValue('A2', "Periode :");
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->setActiveSheetIndex(0)->setCellValue('B2', $_GET['periode']);

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->getActiveSheet()->mergeCells('A3:A4');
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA PEGAWAI"); // Set kolom B3 dengan tulisan "NIS"
        $excel->getActiveSheet()->mergeCells('B3:B4');
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "POSISI"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->getActiveSheet()->mergeCells('C3:C4');
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "TGL"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->getActiveSheet()->mergeCells('D3:E3');
        $excel->setActiveSheetIndex(0)->setCellValue('D4', "NO. TELP"); // Set kolom E3 dengan tulisan "TELEPON"
        $excel->setActiveSheetIndex(0)->setCellValue('E4', "NIK"); // Set kolom F3 dengan tulisan "ALAMAT"

        $startCol = range('A', 'Z');
        $continueCol = range('F', 'Z');
        $indexCol = 0;
        // echopre($date);
        foreach ($date as $k => $v) {
            if ($k > count($continueCol)-1) {
                if ($indexCol > count($continueCol)-1) {
                    $indexCol = 0;
                }
                $column = 'A'.$startCol[$indexCol];
            }else{
                $column = $continueCol[$indexCol];
            }
            // $testcolumn[]= $v['date'];
            
            $excel->setActiveSheetIndex(0)->setCellValue($column.'3', $v['date']); // Set kolom F3 dengan tulisan "ALAMAT"
            $excel->setActiveSheetIndex(0)->setCellValue($column.'4', $v['day']); // Set kolom F3 dengan tulisan "ALAMAT"

            $indexCol++;
        }
        // echopre($testcolumn);

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        foreach (range('A', 'E') as $key => $value) {
            for ($i=3; $i <= 4 ; $i++) { 
                $excel->getActiveSheet()->getStyle($value.$i)->applyFromArray($style_col);    
            }
        }

        $indexColStyle = 0;
        foreach ($date as $key => $value) {
            if ($key > count($continueCol)-1) {
                if ($indexColStyle > count($continueCol)-1) {
                    $indexColStyle = 0;
                }
                $columnStyle = 'A'.$startCol[$indexColStyle];
            }else{
                $columnStyle = $continueCol[$indexColStyle];
            }
            for ($i=3; $i <= 4 ; $i++) { 
                $excel->getActiveSheet()->getStyle($columnStyle.$i)->applyFromArray($style_col);    
            }
            $indexColStyle++;
        }
        // $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        // $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        // $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        // $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        // $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        // $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);

        // Set height baris ke 1, 2 dan 3
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);

        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Jadwal Shift");
        $excel->setActiveSheetIndex(0);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Template Jadwal Shift.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        ob_start();
        $write->save('php://output');
        // echopre($excel);
        $xlsData = ob_get_contents();
        ob_end_clean();

        $response =  array(
                'op' => 'ok',
                'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
            );

        die(json_encode($response));
    }

    public function save_add_data()
    {
        // load excel
        $file = $_FILES['file']['tmp_name'];
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray();

        // echopre($sheets[1]);

        $data = [];
        $periode = null;

        foreach ($sheets as $k => $v) {
            if($k == 1)
            $periode = $v[1]; 
            if($k >= 4)
            array_push($data, $v);
        }
        // echopre($periode);

        $itr = 0;
        foreach ($data as $k => $v) {
            $tgl = 1;
            foreach ($v as $kk => $vv) {
                if($kk >= 5){
                    $map[$itr]['nik'] = $v['4'];
                    $map[$itr]['date'] = $periode.'-'.$tgl;
                    $map[$itr]['shift'] = $vv;

                    $tgl++;
                    $itr++;
                }
            }
        }
        // $checkNip = $this->Pegawai_m->cek_id('001');
        // echopre($checkNip);
        $ins = 0;
        foreach ($map as $k => $v) {
            $checkNip = $this->Pegawai_m->cek_id($v['nik']);
            if(!empty($checkNip)){
                $dataIns = array(
                    'id_pegawai' => $checkNip,
                    'shift' => $v['shift'],
                    'date' => $v['date'],
                    
                );
                $insert = $this->Shift_m->save_add($dataIns);
                if($insert)
                $ins++;
            }
        }
        // $data_obj = (object)$ins;
        echo json_encode($ins);
    }

    public function get_data_by_id($id)
    {

        $Divisi = $this->Divisi_m->get_data_by_id($id);
        foreach ($Divisi as $key => $value) {
            $data['id_div'] = $value['id_div'];
            $data['nama_div'] = $value['nama_div'];
        }
        $data_obj = (object)$data;
        echo json_encode($data_obj);
    }

    public function save_edit()
    {
        $id_div = $_POST['id_div'];
        $data = array(
            'nama_div' => $_POST['nama_div'],
        );
        $result = $this->Divisi_m->save_edit($data, $id_div);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function save_delete()
    {
        $id_div = $_POST['id_div'];
        $result = $this->Divisi_m->deleted_data($id_div);

        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
}
