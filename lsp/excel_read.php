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

exec("rm -f $full_filename");	 //엑셀다운폴더아래 파일 모두 삭제 후에 올리려고한거 업로드함(적재방지)
copy($file1,$DOCUMENT_ROOT."/lsp/exceldown/$file1_name");	  


$_FILES['file1']['name'] =$file1_name;		//파�