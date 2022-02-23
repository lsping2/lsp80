<?
include_once('./common.php');

if ( !$start) $start =0; 
$sql = " select * from User_Info limit $start, 2 ";
$result = sql_query($sql);
 for($i=0; $i<$row=sql_fetch_array($result); $i++)  {
	$list_append .=  "<li><a href='#'>".$row[user_id]."-".$i."</a></li><br>"; 
 }

 echo $list_append;
?>
