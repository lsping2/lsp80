<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$SUserUid = request( 'S_USER_UID' , 'session' );

$working_date		= request( 'working_date','get' );
$uid				= request('uid','get' );




$db = new MYSQL;


  $query = "
				SELECT	ui.user_uid 
				FROM	intranet.user_info as ui ,
						intranet.working_status as ws
				WHERE	ui.user_id	 = ws.user_id
				AND		working_date = '$working_date'	
				AND		ws.uid = '$uid'
			
			
		";

$db->query( $query );
$db->fetch();

$rs_user_uid		= $db->result( 'user_uid' );


if ( $rs_user_uid != $SUserUid  )
{

	js_back("본인만 등록 가능합니다.");
	exit;
	

}


elseif ( $rs_user_uid == $SUserUid  )
{

	 
	 
	  $query = "
			
				UPDATE intranet.working_status  SET 
						date_finish = now()
						where	uid  = '$uid'
						AND		working_date = '$working_date'								
	";


}

$db->query( $query );




js_code( "window.history.go(-1)" );



?>
