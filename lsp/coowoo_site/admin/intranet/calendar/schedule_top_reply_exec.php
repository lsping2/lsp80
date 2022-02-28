<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$uid				= request( 'uid' );
$fid				= request( 'fid' );
$reply_comment	= request( 'reply_comment' );

$db = new MYSQL;

$query = "
		INSERT INTO intranet.schedule_top_reply	 (
												reply_uid ,
												reply_fid ,
												reply_user_uid ,
												reply_comment,
												reply_reg_date
											)
											VALUES
											(
												NULL ,
												'$fid' ,
												'$SUserUid' ,
												'$reply_comment' ,
												now()
											)
";
$db->query( $query );


js_code( "parent.history.go(-1)" );

?>