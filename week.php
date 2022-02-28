<?php 
include_once('./_common.php'); 
// 선택옵션으로 인해 셀합치기가 가변적으로 변함 
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨 
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0); 
?>

<script src="http://young2.iceserver.co.kr/js/jquery-1.12.4.min.js?ver=191202"></script>
<?

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php'); 
?>
<!--
if	(!$_GET['Ymd'])	{
	$Ymd	=	DATE("Ymd");
}

if($Ymd) { 
	$mode = 3; 
	$Ymd = $Ymd + 0; 
} 
$add_class = $yoil = array(); 
$yoil[1] = '월요일'; 
$yoil[2] = '화요일'; 
$yoil[3] = '수요일'; 
$yoil[4] = '목요일'; 
$yoil[5] = '금요일'; 
$yoil[6] = '토요일'; 
$yoil[7] = '일요일'; 
if(!$mode) $mode = 2; 

$this_year = date("Y", G5_SERVER_TIME); 
$this_month = date("m", G5_SERVER_TIME); 
$this_day = date("d", G5_SERVER_TIME); 
$this_yoilnum = date("N", G5_SERVER_TIME); 
$this_weeknum = date("W", G5_SERVER_TIME); 
$today = date('Ymd', G5_SERVER_TIME); 
$end_i = 7; 
if($mode == 1) { // 월요일부터 시작 
$k = 1; // 시작요일 
$tmp_day = $this_yoilnum - 1; 
	$start_time = G5_SERVER_TIME-($tmp_day*60*60*24); 
} else if($mode == 2) { // 어제 부터 시작 
$k = $this_yoilnum - 1; 
	if(!$k) $k = 7; 
	$tmp_day = 1; 
	$start_time = G5_SERVER_TIME-($tmp_day*60*60*24); 
	$end_i = 8; 
} else if($mode == 3) { // 특정일/주 선택 
$k = 1; 
	$select_time = strtotime($Ymd); 
	$yoilnum = date("N", $select_time); 
	$tmp_day = $yoilnum - 1; 
	$start_time = $select_time-($tmp_day*60*60*24); 
	$weeknum = date("W", $start_time); 
} 

$s_year = date("Y", $start_time); 
$s_month = date("m", $start_time); 
$s_day = date("d", $start_time); 
$start_Ymd = date("Ymd", $start_time); 
$end_Ymd = date("Ymd", $start_time + (7*60*60*24)); 

?> 

<a href="<?php echo $_SERVER['PHP_SELF']?>" class="btn_b02">오늘</a>  
<a href="<?php echo $_SERVER['PHP_SELF'].'?Ymd='.date("Ymd", mktime(0,0,0, $s_month, $s_day-7, $s_year)) ?>" class="btn_b01">전주</a> 
<a href="<?php echo $_SERVER['PHP_SELF'].'?Ymd='.date("Ymd", mktime(0,0,0, $s_month, $s_day+7, $s_year)) ?>" class="btn_b01">다음주</a> 


<table border=1>
<tr>
<? for($i = 0; $i < $end_i; $i++) { ?>
<?
	if($Ymd < $today) $add_class[$Ymd] .= ' past'; 
	$Ymd = date("Y-m-d", $start_time+($i*60*60*24)); 
?>
	<td class="<?php echo $add_class[$Ymd] ?>"><a href="javascript:;" onClick="tab_it('<?=$Ymd?>')"><?=$Ymd?></a></td>
<? }?>
</tr>
</table>
-->
<?
$Ymd = date('Y-m-d');
?>

<?
$arr_date = array();
for($i=1; $i<14; $i++){
 $arr_date[$i-1] = date("Y-m-d", strtotime($Ymd . "+{$i} days"));
}

for($i=0; $i<count($arr_date); $i++){
?>
	<a href="javascript:;" onClick="tab_it('<?=$arr_date[$i]?>')"><?=$arr_date[$i]?></a><br>
<?
}
?>
<div class="sch_list" id="favorite_it"></div>

<script>

function tab_it(Ymd){
	//ajax load
	$("#favorite_it").load('./ball.php?Ymd='+Ymd);
}

$(document).ready(function(){ 
   tab_it('');
});
</script>


<!-- 
<div class="board_week_wrap"> 
	<?php 
	for($i = 0; $i < $end_i; $i++) { 
	if($k == 8) { 
	$k = 1; 
	} 
	$Ymd = date("Ymd", $start_time+($i*60*60*24)); 
	if($k == 6) $add_class[$Ymd] .= 'blue'; 
	if($k == 7) $add_class[$Ymd] .= 'red'; 
	if($Ymd < $today) $add_class[$Ymd] .= ' past'; 
	?> 
	<dl class="<?php echo $add_class[$Ymd] ?>"> 
	<dt> 
	<?php echo $yoil[$k] ?> 
	<p><?php echo date("Y년m월d일", $start_time+($i*60*60*24)); ?></p> 
	</dt> 
	<dd class="info_list"> 
	<?=$Ymd?> 
	</dd> 
	<div style="clear:both"></div> 
	</dl> 
	<?php 
	$k++; 
	} // end for 
	?> 
	</div>

 -->
