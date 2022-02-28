<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$night		= request( 'night' , 'post' );
$duty		= request( 'duty' , 'post' );
$user_uid		= request( 'user_uid' , 'post' );
$working_date= request( 'working_date' , 'post' );

$colors	= request( 'colors' , 'post' );
$comment= request( 'comment' , 'post' );


$db = new MYSQL;


$query = "
		DELETE	FROM intranet.calendar_duty
		WHERE	working_date= '$working_date'
";
$db->query( $query );

if( is_array( $duty ) )
{
	for( $loop=0; $loop<count( $duty ); $loop++ )
	{
		$query = "
				INSERT INTO intranet.calendar_duty	SET	user_id		= '$duty[$loop]' ,
													working_date	= '$working_date' ,
													reg_date		= now()
		";
		$db->query( $query );
	}
}

$query = "
		DELETE	FROM intranet.calendar_night
		WHERE	working_date= '$working_date'
";
$db->query( $query );

if( is_array( $night ) )
{
	for( $loop=0; $loop<count( $night ); $loop++ )
	{
		$query = "
				INSERT INTO intranet.calendar_night	SET	user_id		= '$night[$loop]' ,
													working_date	= '$working_date' ,
													reg_date		= now()
		";
		$db->query( $query );
	}
}

js_code( "opener.window.location.reload();" );
js_code( "window.close();" );


?>