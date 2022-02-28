<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$uid	= request( 'uid' );

$db = new MYSQL;

$query = "
		SELECT	fid
		FROM	intranet.schedule
		WHERE	uid = '$uid'
		AND		from_user_uid = '$SUserUid'
";
$db->query( $query );
if( !$db->total_record() ) 
{
	js_msg( '작성자만 삭제할 수 있습니다.' );
	js_back();
	exit;
}

$db->fetch();

$rs_fid = $db->result( 'fid' );

$query = "
		DELETE FROM intranet.schedule_reply WHERE reply_fid = '$rs_fid';
";
$db->query( $query );
$query = "
		DELETE FROM intranet.schedule WHERE uid = '$uid';
";
$db->query( $query );

js_code( "parent.window.history.go(-1)" );

?>