<?php 
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가


$add_sql = "";

if( $member['mb_level'] < 10 ){
	$add_sql .= " and (wr_1 = '$member[mb_id]' or  mb_id = '$member[mb_id]' )";	
}

?>