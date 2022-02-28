<?
require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );


$team			= request( 'team' , 'post' );
$working_date		= request( 'working_date','post' );
$comment		= request( 'comment','post' );


$db = new MYSQL;

 
  $query = "
			INSERT INTO intranet.business_diary SET	diary_no		= NULL ,
												team		= '$team' ,
												working_date	= '$working_date' ,
												comment		= '$comment' ,
												user_id		= '$s_user_id' ,
												reg_date		= now()
		";

$db->query( $query );
$db->fetch();

	
js_code( "opener.window.location.reload();" );
js_code( "window.close();" );


?>