<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$reply_uid	= request( 'reply_uid' );

$db = new MYSQL;

$query = "
		SELECT	*
		FROM	intranet.schedule_top_reply
		WHERE	reply_uid = '$reply_uid'
		AND		reply_user_uid = '$SUserUid'
";

$db->query( $query );
if( !$db->total_record() ) 
{
	js_msg( '작성자만 삭제할 수 있습니다.' );
	js_back();
	exit;
}

$query = "
		DELETE FROM intranet.schedule_top_reply WHERE reply_uid = '$reply_uid';
";
$db->query( $query );

js_code( "parent.window.location.reload()" );

?>