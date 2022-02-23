<?php

$page = request( 'page', 'any' );

$total_record = 0;
$total_page = 0;

$max_show_list = 20;
$max_show_page = 11;
$start = 0;

function page_calcu()
{

	global $max_show_list;
	global $max_show_page;
	global $start;
	global $total_record;
	global $page;
	global $total_page;

	$total_page = @ceil( $total_record / $max_show_list );

	if( $page <= 0 ) $page = 1;
	if( $total_page < $page ) $page = $total_page;

	$start = $max_show_list * ( $page - 1 );
	if( $start<0 ) $start=0;

}

function page_list( $url, $httpvar="", $anchor = "" )
{


	global $page;
	global $max_show_page;
	global $total_page;

	if( $anchor ) $anchor = "#{$anchor}";
	if( $httpvar ) $httpvar .= "&";

	$half = ceil( $max_show_page / 2 );

	if ( $page - $half <= 0 )
	{

		$s = 1;
		$e = $max_show_page - 1;

		}
		else if ( $page + $half > $total_page )
		{

		$s = $total_page - $max_show_page + 1;
		$e = $total_page;

	}
	else
	{

		$s = $page - $half + 1;
		$e = $page + $half - 1;

	} // end of if

	if ( $s <= 0 ) $s = 1;

	if ( $e > $total_page ) $e = $total_page;

	if ( $page - 1 > 0 )
	{

		echo "<a href='{$url}?{$httpvar}page=" . ( $page - 1 ) . "{$anchor}' onFocus='this.blur()'><font size='1' color=#AAAAAA>¢¸</font></a>&nbsp;";

	} // end of if

	for ( $loop = $s; $loop <= $e; $loop++ )
	{

		if ( $loop == $page ) echo "<b><font color=#E60000 style='font-family:tahoma; font-size:8pt'>$loop</font></b>";
		else echo "<a href='{$url}?{$httpvar}page=$loop{$anchor}' onFocus='this.blur()'><font style='font-family:tahoma; font-size:8pt'>$loop</font><a>";

		if( $loop != $e ) echo " <font color=#AAAAAA>|</font> ";

	} // end of for

	if ( $page < $total_page )
	{
		echo "&nbsp;&nbsp;<a href='{$url}?{$httpvar}page=" . ( $page + 1 ) . "{$anchor}' onFocus='this.blur()'><font size='1' color=#AAAAAA>¢º</font></a>";
	} // end of if

}

?>