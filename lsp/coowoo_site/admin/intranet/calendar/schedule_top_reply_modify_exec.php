<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$reply_uid		= request( 'reply_uid' );
$reply_comment	= request( 'reply_comment' );

$db = new MYSQL;

$query = "
			UPDATE intranet.schedule_top_reply	SET		reply_comment			= '$reply_comment'
										WHERE	reply_uid = $reply_uid
";

$db->query( $query );

js_code( "parent.history.go(-1)" );

?>