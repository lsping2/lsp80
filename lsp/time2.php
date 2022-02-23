<?
$start_time = microtime(); //시작
$end_time	= microtime(); //종료
$start_sec = explode( " ", $start_time ); 
$end_sec  = explode( " ", $end_time ); 
$rap_micsec = $end_sec[0] - $start_sec[0]; //실행시간 microsecond
$rap_sec	=  $end_sec[1] - $start_sec[1]; //실행시간 second
$rap = $rap_sec + $rap_micsec;

echo("<br> $end_time : $start_time : 실행시간 $rap 초 <br>" );
?>