<?php 
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($is_admin ) {
	$notice_fg = "";
		if( $notice == "1"){ // 전체공지
			$notice_fg = "Z";
		}else{   // 전체공지 해지시
			if( $wr_2){ // 개별공지가 있을경우
				$notice_fg = $wr_2;
			}else{
				$notice_fg = ""; // 전체 & 개별공지 없을경우
			}
		}
	$sql = " update $write_table set  
				wr_2		= '$notice_fg'
				where wr_id = '$wr_id' ";
	sql_query($sql);
}
?>