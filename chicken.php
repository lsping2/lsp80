<?
include_once('./_common.php'); 

$arr['positions'] = array(); 

$result = sql_query("select wr_3, wr_4 from g5_write_map"); 
for($i=0;$ary=sql_fetch_array($result);$i++) 
{ 
    $arr['positions'][$i]['lat'] = $ary['wr_3']; 
    $arr['positions'][$i]['lng'] = $ary['wr_4']; 
} 

header("Content-Type: application/json");
echo json_encode($arr); 

?>
