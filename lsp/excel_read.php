<?php

require_once "menu/include/include.php";
require_once 'Excel/reader.php';


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP949'); 

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting	
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/



$full_filename = $DOCUMENT_ROOT."/lsp/exceldown/*";

exec("rm -f $full_filename");	 //�����ٿ������Ʒ� ���� ��� ���� �Ŀ� �ø������Ѱ� ���ε���(�������)
copy($file1,$DOCUMENT_ROOT."/lsp/exceldown/$file1_name");	  


$_FILES['file1']['name'] =$file1_name;		//���