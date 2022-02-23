<meta charset="utf-8">
<?
function parsing_data($url, $data) {
    
	$buffer = "<iframe src=".$url." width='100%' height='1500px' frameborder='0'></iframe>";
	return $buffer;

}

echo  parsing_data($wr_subject, "");

?>