<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Php_excel extends CI_Controller {


	public function index()
	{
        echo "Welcome to php";
		//$this->load->view('welcome_message');
	}
    public function test()
    {
        $this->load->library('phpexcel');
        //$this->load->library('PHPExcel/IOFactory.php');
		$xl_obj = new PHPExcel();
		$reader = PHPExcel_IOFactory::createReader('Excel2007');
		$reader->setReadDataOnly(true);
		$excel = $reader->load(FCPATH.'upload/excel_file/test.xlsx');
        //echo "All is fine";

		$sheet = $excel->getActiveSheet()->toArray(null,true,true,true);
		//pre($excel->getActiveSheet());die;
		pre($sheet);die;
        $arrayCount = count($sheet); 
        for($i=2;$i<=$arrayCount;$i++)
        {                   
           // echo $sheet[$i]["A"].$sheet[$i]["B"].$sheet[$i]["C"];
        }
    }
	public function test2()
	{
		//require 'vendor/autoload.php';

		//use PhpOffice\PhpSpreadsheet\Spreadsheet;
		//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
		$this->load->library('PhpSpreadsheet\Spreadsheet');
		$this->load->library('PhpSpreadsheet\Writer\Xlsx');

		$spreadsheet = new Spreadsheet();
		$activeWorksheet = $spreadsheet->getActiveSheet();
		$activeWorksheet->setCellValue('A1', 'Hello World !');

		$writer = new Xlsx($spreadsheet);
		$writer->save('hello world.xlsx');
	}
	public function test3()
	{
		$this->load->library('excel');

		$xl_obj = new PHPExcel();
		$reader = PHPExcel_IOFactory::createReader('Excel2007');
		$reader->setReadDataOnly(true);
		$excel = $reader->load(FCPATH.'upload/excel_file/test.xlsx');
        //echo "All is fine";

		$sheet = $excel->getActiveSheet()->toArray(null,true,true,true);
		//pre($excel->getActiveSheet());die;
		pre($sheet);die;

	}
}
