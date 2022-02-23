<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );

$diary_no		=  request( 'diary_no' , 'post' );
$comment	=  request( 'comment' , 'post' );

$db = new MYSQL;

$query = "
			SELECT	user_id	
			FROM	intranet.business_diary 
			where	diary_no = '$diary_no'
";
$db->query( $query );
$db->fetch();

$rs_user_id	= $db->result( 'user_id' );

if ($rs_user_id !=$s_user_id)
{
	js_msg("본인만 수정 가능합니다.");
	js_code( "opener.window.location.reload();" );
	js_code( "window.close();" );

}

elseif ($rs_user_id == $s_user_id)

{

	 $query = "
						UPDATE	intranet.business_diary  SET
								comment	= '$comment'
						where	diary_no  = '$diary_no'
			";
			


	$db->query( $query );

	js_code( "opener.window.location.reload();" );
	js_code( "window.close();" );


}

?>