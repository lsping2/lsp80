<?
// 해당날짜의 월요일
function getMonthFirstSunday( $chkDate ) {
	$chkVal;
	$thisMonthStart;
	$year = substr( $chkDate, 0, 4 );
	$month = substr( $chkDate, 5, 2 );
	$day = substr( $chkDate, 8, 2 );
	$iday = date( "w", mktime( 0, 0, 0, $month, $day, $year ));

	$thisMonthStart = date( "Y-m-d", mktime( 0, 0, 0, $month, ($day-$iday), $year ));
	return $thisMonthStart;
}


$First_Sunday = getMonthFirstSunday( '2013-02-07' );	// 현재일자 기준 첫 일요일 날짜
$f_year		= substr( $First_Sunday, 0, 4 );
$f_month	= substr( $First_Sunday, 5, 2 );
$f_day		= substr( $First_Sunday, 8, 2 );
$Find_Sdate = date("Y-m-d", mktime( 0, 0, 0, $f_month, $f_day+1, $f_year )); // 검색 시작일
$Find_Edate = date("Y-m-d", mktime( 0, 0, 0, $f_month, $f_day+5, $f_year )); // 검색 종료일


echo $Find_Sdate."~".$Find_Edate ;

?>