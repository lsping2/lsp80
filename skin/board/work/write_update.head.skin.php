<?php 
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ( !$is_admin){
	if( $w == 'r' || $w == ''){
		$wr_1 = $member['mb_id'];
	}
}
?>