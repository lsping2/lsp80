<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$db = new MYSQL;

$duty		= request( 'duty' , 'post' );
$night		= request( 'night' , 'post' );
$user_uid		= request( 'user_uid' , 'post' );
$working_date= request( 'working_date' , 'post' );

$colors	= request( 'colors' , 'post' );
$comment= request( 'comment' , 'post' );

if ( $comment)
{

	$query = "
			SELECT	user_id
			FROM	intranet.user_info
			WHERE	use_status = 'Yes'
			AND		user_uid	= '$user_uid'
		";

	$db->query( $query );

	$db->fetch();
	$rs_user_id		= $db->result( 'user_id' );

	 $query = "
		INSERT INTO intranet.calendar_memorial_day (
												user_uid,
												user_id ,
												color  ,
												comment ,
												working_date ,
												reg_date
											)
											VALUES
											(
												NULL ,
												'$rs_user_id' ,
												'$colors' ,
												'$comment' ,
												'$working_date' ,
												now()
											)
";

	$db->query( $query );

}

js_code( "opener.window.location.reload();" );
js_code( "location.href='register.html?user_uid={$user_uid}&working_date={$working_date}'" );


?>