<?


require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );



 $working_date =  request( 'working_date' , 'get' );
 $uid		=  request( 'uid' , 'get' );







$db = new MYSQL;


 
 $query = "
			SELECT	date_start  ,
					user_id	
			FROM	intranet.working_status
			where	working_date  = '$working_date'
			AND		uid = '$uid'
	";
$db->query( $query );

$db->fetch();
$rs_date_start		= $db->result( 'date_start' );
$rs_user_id		= $db->result( 'user_id' );



if ($rs_user_id !=$s_user_id)
{
	js_msg("본인만 삭제 가능합니다.");
	js_code( "opener.window.location.reload();" );
	js_code( "window.close();" );

}


elseif ($rs_user_id == $s_user_id)

{

	IF( $rs_date_start != '0000-00-00 00:00:00' )  // 출근체크가 되있고 메모가 있을때 ex) 지각..

	{
		 $query = "
							UPDATE	intranet.working_status SET
									memo	= ''
							where	uid  = '$uid'
							AND		working_date = '$working_date'
				";
				
	}
	ELSE		// 출근체크가 안되있고 메모값이 있을때 ex) 격월차후 메모남김
	{
		$query = " DELETE FROM intranet.working_status WHERE uid  = '$uid';";
	}

	$db->query( $query );

	js_code( "opener.window.location.reload();" );
	js_code( "window.close();" );


}

?>