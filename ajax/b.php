<?function html_cache_disable()
{

	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

	// HTTP/1.1
//	header("Cache-Control: no-store, no-cache, must-revalidate");
 
//	header("Cache-Control: no-store, private, must-revalidate");
	
	header("Cache-Control: post-check=0, pre-check=0", false);

	// HTTP/1.0
	header("Pragma: no-cache");

}
html_cache_disable();
?>
<?
   $conn = mysql_connect ("localhost", "lsp80", "lovelove")or die ("접속할 수 없습니다");
    mysql_select_db( "lsp80", $conn );


$SQL = "SELECT			b.bbs_uid ,
						b.bbs_depth ,
						b.user_id ,
						ui.user_name ,
						b.subject ,
						b.File_name ,
						b.File_size  ,
						b.show_count ,
						date_format( b.reg_date, '%Y-%m-%d' ) as reg_date
			FROM	book_bbs as b , User_Info  as ui
			WHERE	ui.user_id = b.user_id
			ORDER BY b.bbs_fid DESC , b.bbs_depth ASC";

$query = mysql_query($SQL,$conn);

while($row = mysql_fetch_array($query))
{
echo $row["subject"]."<br>";

//echo  date("Y-m-d-H-i-s", time());

}

?>

