<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );

$SUserUid = request( 'S_USER_UID' , 'session' );

$schedule_date	= request( 'schedule_date','get' );
$uid				= request('uid','get' );



$db = new MYSQL;



$query = "
				SELECT	ui.user_uid 
				FROM	intranet.user_info as ui ,
						intranet.working_status as ws
				WHERE	ui.user_id	 = ws.user_id
				AND		working_date = '$schedule_date'	
				AND		ws.uid = '$uid'
			
			
		";

$db->query( $query );
$db->fetch();

$rs_user_uid		= $db->result( 'user_uid' );


if ( $rs_user_uid != $SUserUid  )
{

	js_msg("작성자만 삭제할 수 있습니다.");
	js_back();
	exit;

}

elseif ( $rs_user_uid == $SUserUid  )
{


	 $query = "
					DELETE FROM intranet.working_status
					
					WHERE working_date = '$schedule_date'	
					AND	uid = '$uid'	
				
				
			";

$db->query( $query );

}

js_code( "parent.window.history.go(-1)" );

?>


