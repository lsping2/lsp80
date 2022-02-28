<?php

$year = $_GET["year"];
$month = $_GET["month"];

$last_day = date("t",mktime(0,0,0,$month,1,$year));
$first_day = date("w",mktime(0,0,0,$month,1,$year));



?>


	<span class="btn_before"> 
		<a href="javascript:void(0);" onclick="<?php if ($month == 1) { $year_pre=$year-1; $month_pre=12; } else {$year_pre=$year; $month_pre=$month-1;} ?>javascript:change_it('<?php echo $year_pre?>','<?php echo $month_pre?>');">◀</a>
	</span>

<b><?php echo "$year. &nbsp;".sprintf("%02d",$month); ?></b>

	<span class="btn_next">
		<a href="javascript:void(0);" onclick="<?php if ($month == 12) { $year_pre=$year+1; $month_pre=1; } else {$year_pre=$year; $month_pre=$month+1;} ?>javascript:change_it('<?php echo $year_pre?>','<?php echo $month_pre?>');">▶</a>
	</span>
	
<br><br><br>

<span class="year_text">

		<a href="javascript:void(0);" title="오늘로" onclick="javascript:change_it('<?php echo date("Y",time())?>','<?php echo date("n",time())?>');"><?php echo "$year. &nbsp;".sprintf("%02d",$month); ?></a>
	</span>


<table border=0 bgcolor=#DBDBDB>
<tr>
	<td>
		<table border=0 leftmargin=0 topmargin=0 cellpadding=2 cellspacing=1> 
		<tr height=25>
			<td bgcolor=#FFFFFF align="center"><span style="font-family:tahoma; font-size:8pt; color=#FF0000"><b>일요일</b></span></td>
			<td bgcolor=#FFFFFF align="center"><span style="font-family:tahoma; font-size:8pt;"><b>월요일</b></span></td>
			<td bgcolor=#FFFFFF align="center"><span style="font-family:tahoma; font-size:8pt;"><b>화요일</b></span></td>
			<td bgcolor=#FFFFFF align="center"><span style="font-family:tahoma; font-size:8pt;"><b>수요일</b></span></td>
			<td bgcolor=#FFFFFF align="center"><span style="font-family:tahoma; font-size:8pt;"><b>목요일</b></span></td>
			<td bgcolor=#FFFFFF align="center"><span style="font-family:tahoma; font-size:8pt;"><b>금요일</b></span></td>
			<td bgcolor=#FFFFFF align="center"><span style="font-family:tahoma; font-size:8pt;"><b>토요일</b></span></td>
		</tr>
		<tr>

		<tr>

		<?

			for($loop=0 ; $loop<$first_day ; $loop++)
			{
				echo "<td bgcolor=#FFFFFF>&nbsp;</td>";
			}

			for($loop=1 ; $loop<=$last_day ; $loop++)
			{
				 $week_day		= date( "w", mktime( 0, 0, 0, $month, $loop, $year ) );
				 $selday	= "{$year}-" . sprintf( "%02d-%02d", $month,$loop ); 
				 $cday = $year.sprintf( "%02d%02d", $month,$loop ); 
		
		?>
			<td valign=top  bgcolor=#FFFFFF class ="cday <?=$cday?>" onClick="set_it('<?=$selday?>')"> 
			
<!--  달력 한칸 start---->
				<?=$loop?>
		<!--  달력 한칸 end---->	


			 </td>
	
			<? IF($week_day == 6) : ?>
				</tr><tr>
			<? ENDIF?>

<?
		} // end of for($loop=1 ; $loop<=$last_day ; $loop++)


	for($loop=$week_day ; $loop<6 ; $loop++)
	{
		echo "<td bgcolor=#FFFFFF>&nbsp;</td>";
	}

?>
				
		</tr>
		</table>
	</td>
</table>

<?
$next_year = date("Y",strtotime('+1 month', strtotime($year."-".$month."-"."01") ));
$next_month = date("m",strtotime('+1 month', strtotime($year."-".$month."-"."01") ));
?>
<script>



change_it2('<?=$next_year?>','<?=$next_month?>');   
 
</script>