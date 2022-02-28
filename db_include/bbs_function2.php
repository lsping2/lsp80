<?php

$page2 = request( 'page2', 'any' );

$total_record2= 0;
$total_page2 = 0;

$max_show_list2 = 20;
$max_show_page2 = 11;
$start2 = 0;



function page_list2( $url, $httpvar2="", $anchor2 = "" )
{


	global $page2;
	global $max_show_page2;
	global $total_page2;

	if( $anchor2 ) $anchor2= "#{$anchor}";
	if( $httpvar2 ) $httpvar2 .= "&";

	$half2 = ceil( $max_show_page2 / 2 );

	if ( $page2 - $half2 <= 0 )
	{

		$s2 = 1;
		$e2 = $max_show_page2 - 1;

		}
		else if ( $page2 + $half2 > $total_page2 )
		{

		$s2 = $total_page2 - $max_show_page2 + 1;
		$e2 = $total_page2;

	}
	else
	{

		$s2 = $page2 - $half2 + 1;
		$e2 = $page2 + $half2 - 1;

	} // end of if

	if ( $s2 <= 0 ) $s2 = 1;

	if ( $e2 > $total_page2 ) $e2= $total_page2;

	if ( $page2 - 1 > 0 )
	{

		echo "<a href='{$url2}?{$httpvar2}page2=" . ( $page2 - 1 ) . "{$anchor2}' onFocus='this.blur()'><img  src='/img/btn_before.jpg' border='0' align='absmiddle'></a>&nbsp;";

	} // end of if

	for ( $loop = $s2; $loop <= $e2; $loop++ )
	{

		if ( $loop == $page2 ) echo "<b><font color=#E60000 style='font-family:tahoma; font-size:8pt'>$loop</font></b>";
		else echo "<a href='{$url2}?{$httpvar2}page2=$loop{$anchor2}' onFocus='this.blur()'><font style='font-family:tahoma; font-size:8pt'>$loop</font><a>";

		if( $loop != $e2 ) echo " <font color=#AAAAAA>|</font> ";

	} // end of for

	if ( $page2 < $total_page2 )
	{
		echo "&nbsp;&nbsp;<a href='{$url2}?{$httpvar2}page2=" . ( $page2 + 1 ) . "{$anchor2}' onFocus='this.blur()'><font size='1' color=#AAAAAA><img  src='/img/btn_after.jpg' border='0' align='absmiddle'></font></a>";
	} // end of if

}

?>