<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$db = new MYSQL;


$user_uid		= request( 'user_uid' , 'post' );
$working_date= request( 'working_date' , 'post' );
$lunar_date	= request( 'lunar_date' , 'post' );

$comment= request( 'comment' , 'post' );
$colors	= request( 'colors' , 'post' );
$repeat	= request( 'repeat' , 'post' );
$lunar2solar= request( 'lunar2solar' , 'post' );




IF ( 'lunar' == $lunar2solar )
{
	$working_date = $lunar_date;
}



list($year,$month,$day) = explode("-", $working_date );



IF ( 'Yearly' == $repeat )
{
	 $working_date = '0000-' . $month."-".$day;
}

IF ( 'Monthly' == $repeat )
{
	 $working_date = '0000-00-'.$day;
}




$query = "
		INSERT INTO intranet.calendar_memorial_day	(
												user_uid  ,
												user_id ,
												color  ,
												comment ,
												repeat ,
												lunar2solar , 
												working_date ,
												reg_date
											)
											VALUES
											(
												NULL ,
												'$s_user_id' ,
												'$colors' ,
												'$comment' ,
												'$repeat' ,
												'$lunar2solar' ,
												'$working_date' ,
												now()
											)
	";

$db->query( $query );

$working_date= request( 'working_date' , 'post' );

js_code( "opener.window.location.reload();" );
js_code( "location.href='schedule_memorial.html?user_uid={$user_uid}&working_date={$working_date}'" );


?>