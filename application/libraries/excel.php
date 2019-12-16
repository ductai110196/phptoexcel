<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . "/third_party/PHPExcel/Classes/PHPExcel.php";
require_once APPPATH . "/third_party/PHPExcel/Classes/PHPExcel/IOFactory.php";

class Excel extends PHPExcel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function ExcelReader($file, $sheetnames)
	{
		$objRender = PHPExcel_IOFactory::createReaderForFile($file);
		$objRender->setLoadSheetsOnly($sheetnames);
		$objExcel = $objRender->load($file);
		$sheetData = $objExcel->getActiveSheet()->toArray("null", true, true, true);
		return $sheetData;
	}


	public function ListSheet($file)
	{
		$objRender = PHPExcel_IOFactory::createReaderForFile($file);
		$list = $objRender->listWorksheetNames($file);
		return $list;
	}


	public function getlenghtcolum($file)
	{
		$objRender = PHPExcel_IOFactory::createReaderForFile($file);
		$objExcel = $objRender->load($file);
		$columm = $objExcel->getActiveSheet()->getHighestColumn();
		return $columm;
	}

	public function loadexcel($file)
	{
		$objPHPExcel = PHPExcel_IOFactory::load($file);

		//get only the Cell Collection
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

		//extract to a PHP readable array format
		foreach ($cell_collection as $cell) {
			$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getCalculatedValue();
			//The header will/should be in row 1 only. of course, this can be modified to suit your need.
			/*if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }*/
			//$val[$row][$column] = $data_value > 25569 ? PHPExcel_Style_NumberFormat::toFormattedString($data_value, 'DD/MM/YYYY') : $data_value;
			$val[$row][$column] =  $data_value;
		}
		return  $val;
	}

	public function getrows($file)
	{
		$objRender = PHPExcel_IOFactory::createReaderForFile($file);
		$objExcel = $objRender->load($file);
		$sheet = $objExcel->getActiveSheet();
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		//  Loop through each row of the worksheet in turn
		$rowData = [];
		for ($row = 2; $row <= $highestRow; $row++) {
			//  Read a row of data into an array
			$rowData[] = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);
			//  Use foreach loop and insert data into Query
		}
		return $rowData;
	}


	public function renderexcel($file)
	{
		$objFile = PHPExcel_IOFactory::identify($file);
		$objData = PHPExcel_IOFactory::createReader($objFile);

		//Chỉ đọc dữ liệu
		$objData->setReadDataOnly(true);

		// Load dữ liệu sang dạng đối tượng
		$objPHPExcel = $objData->load($file);

		//Lấy ra số trang sử dụng phương thức getSheetCount();
		// Lấy Ra tên trang sử dụng getSheetNames();

		//Chọn trang cần truy xuất
		$sheet = $objPHPExcel->setActiveSheetIndex(0);

		//Lấy ra số dòng cuối cùng
		$Totalrow = $sheet->getHighestRow();
		//Lấy ra tên cột cuối cùng
		$LastColumn = $sheet->getHighestColumn();

		//Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
		$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

		//Tạo mảng chứa dữ liệu
		$data = [];

		//Tiến hành lặp qua từng ô dữ liệu
		//----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
		for ($i = 2; $i <= $Totalrow; $i++) {
			//----Lặp cột
			for ($j = 0; $j < $TotalCol; $j++) {
				// Tiến hành lấy giá trị của từng ô đổ vào mảng
				$data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();;
			}
		}
		return $data;
	}

	public function WriteExcel($filewrite)
	{
		// Loại file cần ghi là file excel phiên bản 2007 trở đi
		$fileType = 'Excel2007';
		// Tên file cần ghi
		$fileName = $filewrite;
		// Load file product_import.xlsx lên để tiến hành ghi file
		$objPHPExcel = PHPExcel_IOFactory::load($filewrite);
		// Giả sử chúng ta có mảng dữ liệu cần ghi như sau
		$array_data = array(
			0 => array('name' => 'Hieu', 'email' => 'hieu@gmail.com', 'phone' => '0123456789', 'address' => 'address 1'),
			1 => array('name' => 'Nam', 'email' => 'nam@gmail.com', 'phone' => '0124567892', 'address' => 'address 2'),
		);
		// Thiết lập tên các cột dữ liệu
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', "STT")
			->setCellValue('B1', "Name")
			->setCellValue('C1', "Email")
			->setCellValue('D1', "Phone")
			->setCellValue('E1', "Address");
		// Lặp qua các dòng dữ liệu trong mảng $array_data và tiến hành ghi dữ liệu vào file excel
		$i = 2;
		foreach ($array_data as $value) {
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A$i", "$i")
				->setCellValue("B$i", $value['name'])
				->setCellValue("C$i", $value['email'])
				->setCellValue("D$i", $value['phone'])
				->setCellValue("E$i", $value['address']);
			$i++;
		}
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
		// Tiến hành ghi file
		$objWriter->save($fileName);
	}
}
