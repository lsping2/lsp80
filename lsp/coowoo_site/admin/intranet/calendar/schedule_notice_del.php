<?
require_once "../../../include/include.php";
html_cache_disable();

$bbs_uid	 	= request( 'bbs_uid' , 'get');
$working_date= request( 'working_date' , 'get' );

$db = new MYSQL;
	
$query = "
			DELETE	FROM intranet.calendar_notice   
			WHERE	bbs_uid   = '$bbs_uid' 
";


$db->query( $query );
$db->close();


js_code( "opener.window.location.reload();" );
js_code( "location.href='schedule_notice.html?bbs_uid={$bbs_uid}&working_date={$working_date}'" );

?>