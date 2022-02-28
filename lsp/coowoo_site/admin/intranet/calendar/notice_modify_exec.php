<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$comment	= request( 'comment' , 'POST' );
$bbs_uid		= request( 'bbs_uid' , 'POST' );


$db = new MYSQL;

$query = "
			SELECT	user_id 
			FROM	 intranet.calendar_notice      
			WHERE	bbs_uid ='$bbs_uid'
";
$db->query($query);
$db->fetch(); 
$rs_user_id 	= $db->result( 'user_id' );

IF ( $rs_user_id == $s_user_id )
{
	 $query = "
			UPDATE intranet.calendar_notice		SET	comment  =  '$comment'
									  WHERE	bbs_uid  = $bbs_uid	
	";

	$db->query( $query );
}
ELSE
{
	js_msg("작성자만 수정 및 삭제할 수 있습니다.");
}


js_code( "opener.opener.window.location.reload();" );
js_code( "opener.window.location.reload();" );
js_code( "window.close();" );

?>
