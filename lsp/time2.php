<?
$start_time = microtime(); //����
$end_time	= microtime(); //����
$start_sec = explode( " ", $start_time ); 
$end_sec  = explode( " ", $end_time ); 
$rap_micsec = $end_sec[0] - $start_sec[0]; //����ð� microsecond
$rap_sec	=  $end_sec[1] - $start_sec[1]; //����ð� second
$rap = $rap_sec + $rap_micsec;

echo("<br> $end_time : $start_time : ����ð� $rap �� <br>" );
?>