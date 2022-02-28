<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$reply_no	= request( 'reply_no' );

$db = new MYSQL;

$query = "
		SELECT	*
		FROM	intranet.business_diary_reply
		WHERE	reply_no = '$reply_no'
		AND		user_id = '$s_user_id'
";

$db->query( $query );
if( !$db->total_record() ) 
{
	js_msg( '작성자만 삭제할 수 있습니다.' );
	exit;
}

$query = "
		DELETE FROM intranet.business_diary_reply WHERE reply_no = '$reply_no';
";
$db->query( $query );

js_code( "parent.window.location.reload()" );

?>