<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once("$board_skin_path/moonday.php"); // 석봉운님의 음력날짜 함수


if (eregi('%', $width)) {
  $col_width = "14%"; //표의 가로 폭이 100보다 크면 픽셀값입력
} else{
  $col_width = round($width/7); //표의 가로 폭이 100보다 작거나 같으면 백분율 값을 입력
}
$col_height= 80 ;//내용 들어갈 사각공간의 세로길이를 가로 폭과 같도록
$today = getdate(); 
$b_mon = $today['mon']; 
$b_day = $today['mday']; 
$b_year = $today['year']; 
if ($year < 1) { // 오늘의 달력 일때
  $month = $b_mon;
  $mday = $b_day;
  $year = $b_year;
}

if(!$year) 	$year = date("Y");
$file_index = $board_skin_path."/day"; ### 기념일 폴더 위치 지정

### 양력 기념일 파일 지정 : 해당년도 파일이 없으면 기본파일(solar.txt)을 불러온다
if(file_exists($file_index."/".$year.".txt")) {
	$dayfile = file($file_index."/".$year.".txt");
} else { 
	$dayfile = file($file_index."/solar.txt");
}

$lastday=array(0,31,28,31,30,31,30,31,31,30,31,30,31);
if ($year%4 == 0) $lastday[2] = 29;
$dayoftheweek = date("w", mktime (0,0,0,$month,1,$year));

function yoil($no) {
		if($no =='0') $txt="<font color='red'>일</font>";
		if($no =='1') $txt="월";
		if($no =='2') $txt="화";
		if($no =='3') $txt="수";
		if($no =='4') $txt="목";
		if($no =='5') $txt="금";
		if($no =='6') $txt="<font color='blue'>토</font>";
			
		return $txt;
	}
?>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-3d.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>


<link rel="stylesheet" href="<?php echo $board_skin_url ?>/style.css">
<!-- 게시판 카테고리 시작 { -->
<?php if ($is_category) { ?>
<nav id="bo_cate">
    <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
    <ul id="bo_cate_ul">
        <?php echo $category_option ?>
    </ul>
</nav>
<?php } ?>
<!-- } 게시판 카테고리 끝 -->
<table width="<?=$width?>" border=0 cellpadding="0" cellspacing="0">
  <tr>
       <td width="23%" class="fg_title">&nbsp;</td>
       <td width="54%" height="30" align="center">
		<table border="0" cellspacing="5" cellpadding="0">
		<tr>
			<td><a href="<?php echo $_SERVER[PHP_SELF]."?bo_table=".$bo_table.$qstr."&"; ?><?if ($month == 1) { $year_pre=$year-1; $month_pre=$month; } else {$year_pre=$year-1; $month_pre=$month;} echo ("year=$year_pre&month=$month_pre&sc_no=$sc_no");?>"><img src="<?=$board_skin_url?>/img/y_prev.gif" border="0" alt="<?=$year_pre?>년"></a></td>
			<td><a href="<?php echo $_SERVER[PHP_SELF]."?bo_table=".$bo_table.$qstr."&"; ?><?if ($month == 1) { $year_pre=$year-1; $month_pre=12; } else {$year_pre=$year; $month_pre=$month-1;} echo ("year=$year_pre&month=$month_pre&sc_no=$sc_no");?>"><img src="<?=$board_skin_url?>/img/m_prev.gif" border="0" alt="<?=$month_pre?>월"></a></td>
			<td style="padding:0 10px;font-size:18px;font-weight:bold;"><a href="<?php echo $_SERVER[PHP_SELF]."?bo_table=".$bo_table; ?>" title="오늘로" onfocus="this.blur()"><? echo ("$year".년."&nbsp;$month".월); ?></a></td>
			<td><a href="<?php echo $_SERVER[PHP_SELF]."?bo_table=".$bo_table.$qstr."&"; ?><?if ($month == 12) { $year_pre=$year+1; $month_pre=1; } else {$year_pre=$year; $month_pre=$month+1;} echo ("year=$year_pre&month=$month_pre&sc_no=$sc_no");?>"><img src="<?=$board_skin_url?>/img/m_next.gif" border="0" alt="<?=$month_pre?>월"></a></td>
			<td><a href="<?php echo $_SERVER[PHP_SELF]."?bo_table=".$bo_table.$qstr."&"; ?><?if ($month == 12) { $year_pre=$year+1; $month_pre=$month; } else {$year_pre=$year+1; $month_pre=$month;} echo ("year=$year_pre&month=$month_pre&sc_no=$sc_no");?>"><img src="<?=$board_skin_url?>/img/y_next.gif" border="0" alt="<?=$year_pre?>년"></a></td>
		</tr>
		</table>			
	</td>
	<td width="23%" align="right">
        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin"><font color="#ffffff">관리자</font></a></li><?php } ?>
            <?php if ($write_href) { ?>

           	<li>
		     	<font color="blue">(단위 : 천원)</font>
            	  <a href="<?=$write_href?>" class="btn_b02">
            	
            		<font color="#ffffff">일일마감입력</font>
            	</a>
				
            </li>
            <?php } ?>
        </ul>
        <?php } ?>
</td>
  </tr>
</table>

<div id="bo_list">
<table width="<?=$width?>"  bgcolor="#e0e0e0" border="0" cellspacing="1" cellpadding="5">
<thead>
  <tr bgcolor="#f9f9f9" align="center">     
	<th style="color:red">SUN</th>
	<th>MON</th>
	<th>TUE</th>
	<th>WED</th>
	<th>THU</th>
	<th>FRI</th>
	<th style="color:blue">SAT</th>
  </tr>
</thead>
<tbody>
<?
$cday = 1;
$sel_mon = sprintf("%02d",$month);
	

$query = "SELECT * FROM $write_table WHERE left(wr_1,6) <= '$year$sel_mon' and left(wr_2,6) >= '$year$sel_mon' and mb_id = '$member[mb_id]' ORDER BY wr_id ASC";

$result = sql_query($query);
$j=0; // layer id
// 내용을 보여주는 부분
while ($row = mysql_fetch_array($result)) {  // 제목글 뽑아서 링크 문자열 만들기..
  if( substr($row[wr_1],0,6) <  $year.$sel_mon ) {
	 $start_day =1; 
	 $start_day= (int)$start_day;
  } else {
	 $start_day = substr($row[wr_1],6,2);
     $start_day= (int)$start_day;
  }

  if( substr($row[wr_2],0,6) >  $year.$sel_mon ) {
	 $end_day = $lastday[$month];
	 $end_day= (int)$end_day;
  } else {
	 $end_day = substr($row[wr_2],6,2);
	 $end_day= (int)$end_day;
  }


  for ($i = $start_day ; $i <= $end_day;  $i++) {

  

    $j++; // layer ID

    $list[comment_cnt] = " ".$row[wr_comment]; // row에 대하여 코멘트 카운터 정의
    if($row[wr_comment] == 0) {
      $list[comment_cnt] = null ;
    } else {
	  if($list[comment_cnt]!=null) $list[comment_cnt] = "<b><font color=#ff6600>".$list[comment_cnt]."</font></b>"; 
    }

    $row[wr_subject] = cut_str(get_text($row[wr_subject]),$board[bo_subject_len],"…"); // subject length cut

    $list['icon_new'] = '';
	if ($row['wr_datetime'] >= date("Y-m-d H:i:s", G5_SERVER_TIME - ($board['bo_new'] * 3600)))
      $list['icon_new'] = " <img src='$board_skin_url/img/icon_new.gif' align='absmiddle' alt='새글'>";

    if ($member[mb_level] < $board[bo_read_level]) {
      $showLayer="" ;
    } else { 
      $showLayer=" onmouseover=\"PopupShow('".$j."')\" onmouseout=\"PopupHide('".$j."')\" ";
    }
    $show_txt = "";
	 $show_txt = "
	 
		<table width='100%' border='0' align='center'>
		<tr>
			<td>마감자산</td>
			<td align='right' style='padding-right:5px'>".@number_format(substr($row['wr_3'],0,strlen($row['wr_3'])-3))."</td>
		</tr>
		<tr>
			<td><font color='green'>당일손익</font></td>
			<td align='right' style='padding-right:5px'>".@number_format(substr($row['wr_4'],0,strlen($row['wr_4'])-3))."</td>
		</tr>
		<tr>
			<td>보유잔고</td>
			<td align='right' style='padding-right:5px'>".@number_format(substr($row['wr_5'],0,strlen($row['wr_5'])-3))."</td>
		</tr>
		<tr>
			<td>평가손익</td>
			<td align='right' style='padding-right:5px'>".@number_format(substr($row['wr_6'],0,strlen($row['wr_6'])-3))."</td>
		</tr>
		</table>

		

	 ";
    $qstr = '&ptype='.$ptype.'&mp='.$mp.'&mv='.$mv;
	$link_url = G5_BBS_URL."/board.php?bo_table=".$bo_table."&year=".$year."&month=".$month."&wr_id=".$row[wr_id]."&sc_no=".$sc_no.$qstr;
	 
	$html_day[$i].= "<br /><a href=".$link_url." id='subject_".$j."' ".$showLayer.">".$show_txt."</a>".$list[icon_new].$list[comment_cnt];    	

?>
    <!-- 뷰 팝업레이어 -->
    <DIV ID="popup_<?=$j?>" class="popup_layer"> 
<?
    $html = 0;
    if (strstr($row[wr_option], "html1"))
      $html = 1;
    else if (strstr($row[wr_option], "html2"))
      $html = 2;

      $viewlist = cut_str(conv_content($row[wr_content], $html),200,"…");
	  echo "( 작성자 : ".$row[wr_name]." )<br />";
     // echo $viewlist;
?>
    </DIV>
<?
		//오늘 스케줄 구하기
		if ($row[wr_id] != $sc_id && date('Ymd', strtotime($row[wr_1])) <= date(Ymd) && date('Ymd', strtotime($row[wr_2])) >= date(Ymd)) {
			$today_schedule .= "<p><img src='$board_skin_url/img/".$imgown.".gif' border=0 align=absmiddle />";
			$today_schedule .= " <a href=\"javascript:send_write('".$link_url."');\">[".$row[wr_subject]."] ".$row[wr_5]." ".$row[wr_6]."</a>";
			$today_schedule .= " (".$row['wr_7'].")<br />";
			$today_schedule .= $viewlist."</p>";
		}		
		$sc_id = $row[wr_id];
    }
  }

  // 달력의 틀을 보여주는 부분

  $temp = 7- (($lastday[$month]+$dayoftheweek)%7);

  if ($temp == 7) $temp = 0;
     $lastcount = $lastday[$month]+$dayoftheweek + $temp;

  for ($iz = 1; $iz <= $lastcount; $iz++) { // 42번을 칠하게 된다.
    $bgcolor = "#ffffff";  // 쭉 흰색으로 칠하고
    if ($b_year==$year && $b_mon==$month && $b_day==$cday) $bgcolor = "#DEFADE";      //  "#DFFDDF"; // 오늘날짜 연두색으로 표기
    if (($iz%7) == 1) echo ("<tr>"); // 주당 7개씩 한쎌씩을 쌓는다.
    if ($dayoftheweek < $iz  &&  $iz <= $lastday[$month]+$dayoftheweek)	{
	// 전체 루프안에서 숫자가 들어가는 셀들만 해당됨
	// 즉 11월 달에서 1일부터 30 일까지만 해당
	$daytext = "$cday";   // $cday 는 숫자 예> 11월달은 1~ 30일 까지
	//$daytext 은 셀에 써질 날짜 숫자 넣을 공간
	$daycontcolor = "" ; 
	$daycolor = ""; 
	if ($iz%7 == 1) $daycolor = "red"; // 일요일
	if ($iz%7 == 0) $daycolor = "blue"; // 토요일

	// 여기까지 숫자와 들어갈 내용에 대한 변수들의 세팅이 끝나고 
	// 이제 여기 부터 직접 셀이 그려지면서 그 안에 내용이 들어 간다.
	echo ("<td width=$col_width height=$col_height bgcolor=$bgcolor valign=top>");

	$f_date = $year.sprintf("%02d",$month).sprintf("%02d",$cday);

	// 기념일 파일 내용 비교위한 변수 선언, 월과 일을 두자리 포맷으로 고정
	if (strlen($month) == 1) { 
		$monthp = "0".$month ;
	} else {
		$monthp = $month ; 
	}
	if (strlen($cday) == 1) {
		$cdayp = "0".$cday ;
	} else { 
		$cdayp = $cday ; 
	}
	$memday = $year.$monthp.$cdayp;
	$daycont = "" ;

	// 기념일(양력) 표시
	for($i=0 ; $i < sizeof($dayfile) ; $i++) {  // 파일 첫 행부터 끝행까지 루프
		$arrDay = explode("|", $dayfile[$i]);
		if($memday == $year.$arrDay[0]) {
			$daycont = $arrDay[1]; 
			$daycontcolor = $arrDay[2];
			if(substr($arrDay[2],0,3)=="red") $daycolor = "red"; // 공휴일은 날짜를 빨간색으로 표시
		}
	}

    // 석봉운님의 음력날짜 변수선언
    $myarray = soltolun($year,$month,$cday);
    if ($myarray[day]==1 || $myarray[day]==11 || $myarray[day]==21) {
      //1201 $moonday ="<font color='gray'>&nbsp;(음)$myarray[month].$myarray[day]$myarray[leap]</font>";
    } else {
      $moonday="";
    }

	include($file_index."/lunar.txt"); ### 음력 기념일 파일 지정

    if ($annivmoonday&&$daycont) $blank="<br />"; // 음력절기와 양력기념일이 동시에 있으면 한칸 띔
    else $blank="";


    if ($write_href) { 
      // $write_href (글쓰기 권한)이 있으면
      // 날짜를 클릭하면 글씨쓰기가 가능한 링크를 넣어서 출력하기
      echo "<a href='$write_href&f_date=$f_date'><font color='$daycolor' title='일정추가'>$daytext</font></a>$moonday <font color='$daycontcolor'>$daycont</font>$blank $annivmoonday";
    	//echo "<font color='$daycolor' title='일정추가'>$daytext</font>$moonday <font color='$daycontcolor'>$daycont</font>$blank $annivmoonday";
    } else { // 글쓰기 권한이 없으면 글쓰기 링크는 넣지 않고 그냥 숫자와 기념일 내용만 출력하기  
      //echo "<font color='$daycolor'>$daytext</font>$moonday <font color='$daycontcolor'>$daycont</font>$blank $annivmoonday";
    	echo "<font color='$daycolor'>$daytext</font>$moonday <font color='$daycontcolor'>$daycont</font>$blank $annivmoonday";
    }
    echo $html_day[$cday];
    echo ("</td>");  // 한칸을 마무리
    $cday++; // 날짜를 카운팅
  } 
  // 유효날짜가 아니면 그냥 회색을 칠한다.
  else { echo ("     <td width=$col_width height=$col_height bgcolor=f9fafe valign=top>&nbsp;</td>"); }
  if (($iz%7) == 0) echo ("  </tr>");
   
} // 반복구문이 끝남
?>
</tbody>
</table>
</div>


</table>

<section id="today_schedule">

<? 
// 총 수익, 월 총수익, 월별수익
 $sql = " select SUM( wr_4) wr_4, substring( wr_1, 1, 6 ) as wr_1  from $write_table  where  mb_id = '$member[mb_id]' and  left(wr_1,4) = '$year' GROUP BY substring( wr_1, 1, 6 ) ";
$result = sql_query($sql);
$total_income = 0;
$mon= "";
$value= "";
for($loop=0; $loop<$row=mysql_fetch_array($result); $loop++){
	$total_income += $row[wr_4];
	 if( $row[wr_1] ==  $year.$sel_mon){
		$total_month = $row[wr_4]; 
	 }
	 $mon .=  "'".$row[wr_1]."',";
	 $value	.=  $row[wr_4].",";
}



$txt = $sel_mon."월 총손익 : <font color='green'>". number_format($total_month). "원</font> / ".substr($year,2,2)."년 총손익 : <font color='blue'>".number_format($total_income)."원</font>";

// 해당월 누적 수익
 $sql = " select substring(wr_1, 7, 2) wr_1, wr_4  from $write_table  where left(wr_1,6) <= '$year$sel_mon' and left(wr_2,6) >= '$year$sel_mon' and mb_id = '$member[mb_id]' order by wr_1 ";
$result = sql_query($sql);
$day = "";
$val = "";
$val_arr = array();
for($loop=0; $loop<$row=mysql_fetch_array($result); $loop++){
	$day .=  "'".$row[wr_1]."일',";
	 $val_arr[$loop]=  $row[wr_4].", ";
}
 //$day = substr($day,0, strlen($day)-1);
 //$val = substr($val,0, strlen($val)-1);

// 누적계산
for ( $i=0; $i < count($val_arr); $i++){
	$add ="";
	for($j=1; $j<=count($val_arr); $j++){
		$add += $val_arr[$i-$j];
	}
	$val .=  $val_arr[$i] + $add.",";
}
 ?>


<div>
	<table width="100%" bgcolor="#e0e0e0" border="0" cellspacing="0" cellpadding="0" >
	<thead>
<?
	echo $txt;
?>

<script>
$(function () {
        $('#graph').highcharts({
            chart: {
            renderTo: 'containers',
          /*  type: 'column',*/
			zoomType: 'xy',
            /*margin: 60,*/
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                depth: 50,
                viewDistance: 25
            }
        },

            title: {
                text: ' * <?=$monthp?> 월 누적손익'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
			
                categories: [
                  <?=$day?>
                ]
            },

            yAxis: [{ // left y axis
				//min: 0,
                title: {
                    text: null
                },
                labels: {
                    align: 'left',
                   
                  /*  format: '{value:.,1f}'*/
                },

                showFirstLabel: false
   
            }],
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table width="140">',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:,.0f}원</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
           plotOptions: {
            column: {
                depth: 25
            }
        },

            series: [{
                name: '금액',
				 type: 'spline',

                data: [<?=$val?>]
    
            }]
        });

			function showValues() {
        $('#R0-value').html(chart.options.chart.options3d.alpha);
        $('#R1-value').html(chart.options.chart.options3d.beta);
    }

	$('#R0').on('change', function () {
        chart.options.chart.options3d.alpha = this.value;
        showValues();
        chart.redraw(false);
    });
    $('#R1').on('change', function () {
        chart.options.chart.options3d.beta = this.value;
        showValues();
        chart.redraw(false);
    });

   // showValues();

 });



// 월별
$(function () {
        $('#graph_month').highcharts({
            chart: {
            renderTo: 'containers',
           type: 'column',
			zoomType: 'xy',
           /* margin: 60,*/
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                depth: 50,
                viewDistance: 25
            }
        },

            title: {
                text: ' * <?=$year?>년 월별 손익통계'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
			
                categories: [
                  <?=$mon?>
                ]
            },

            yAxis: [{ // left y axis
				//min: 0,
                title: {
                    text: null
                },
                labels: {
                    align: 'left',
                   
                    format: '{value:.,1f}'
                },

                showFirstLabel: false
   
            }],
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table width="140">',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:,.0f}원</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
           plotOptions: {
            column: {
                depth: 25
            }
        },

            series: [{
                name: '금액',
                data: [<?=$value?>]
    
            }]
        });

			function showValues() {
        $('#R0-value').html(chart.options.chart.options3d.alpha);
        $('#R1-value').html(chart.options.chart.options3d.beta);
    }

	$('#R0').on('change', function () {
        chart.options.chart.options3d.alpha = this.value;
        showValues();
        chart.redraw(false);
    });
    $('#R1').on('change', function () {
        chart.options.chart.options3d.beta = this.value;
        showValues();
        chart.redraw(false);
    });

    showValues();

});

</script>



<script>
function tab_sel(val) {
   
	if ( val == '1'){
		 $("#tab1").addClass("active");
		 $("#tab2").removeClass("active").css("color", "#333");
		 $("#graph").show();
		 $("#graph_month").hide();
	}
	else
	{
		$("#tab1").removeClass("active").css("color", "#333");
		$("#tab2").addClass("active");
		$("#graph").hide();
		 $("#graph_month").show();
	}

}
</script>
<style>
ul.tabs {
    margin: 0;
    padding: 0;
    float: left;
    list-style: none;
    height: 32px;
    border-bottom: 1px solid #eee;
    border-left: 1px solid #eee;
    width: 100%;
    font-family:"dotum";
    font-size:12px;
}
ul.tabs li {
    float: left;
    text-align:center;
    cursor: pointer;
    width:82px;
    height: 31px;
    line-height: 31px;
    border: 1px solid #eee;
    border-left: none;
    font-weight: bold;
    background: #fafafa;
    overflow: hidden;
    position: relative;
}
ul.tabs li.active {
    background: #FFFFFF;
    border-bottom: 1px solid #FFFFFF;
}


</style>
<div id="containers">
    <ul class="tabs">
        <li class="active" id="tab1" onClick="tab_sel('1')">일별누적통계</li>
        <li id="tab2" onClick="tab_sel('2')">월별통계</li>
    </ul>


	<div id="graph" style="width:auto; height: 400px; margin: 0 auto;" ></div>
	
	<div id="graph_month" style="width:auto; height: 400px; margin: 0 auto; display:none;" ></div>
</div>


	<thead>
	</table>

	</div>



</section>

<script language="JavaScript">
<!--
function send_write( get_link ){
	location.href = get_link;
}
// 미리보기 팝업 보이기
function PopupShow(n) {
	var position = $("#subject_"+n).position(); 
	$("#popup_"+n).animate({left:position.left-10+"px", top:position.top+30+"px"},0);
	$("#popup_"+n).show();
}

// 미리보기 팝업 숨기기
function PopupHide(n) {
	$("#popup_"+n).hide();
}
//-->
</script>




