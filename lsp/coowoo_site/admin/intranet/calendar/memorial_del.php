<?
require_once "../../../include/include.php";
html_cache_disable();

$user_uid 	= request( 'user_uid' , 'get');
$working_date= request( 'working_date' , 'get' );

$db = new MYSQL;
	
$query = "
			DELETE	FROM intranet.calendar_memorial_day  
			WHERE	user_uid  = '$user_uid' 
";


$db->query( $query );
$db->close();


js_code( "opener.window.location.reload();" );
js_code( "location.href='register.html?user_uid={$user_uid}&working_date={$working_date}'" );

?>