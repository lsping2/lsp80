<?


require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );



$working_date	 	=  request( 'working_date' , 'post' );
$uid				=  request( 'uid' , 'post' );
$memo		=  request( 'memo' , 'post');


$db = new MYSQL;


 
$query = "
			SELECT	user_id	
			FROM	intranet.working_status
			where	working_date  = '$working_date'
			AND		uid = '$uid'
	";
$db->query( $query );

$db->fetch();

 $rs_user_id		= $db->result( 'user_id' );



if ($rs_user_id !=$s_user_id)
{
	js_msg("본인만 수정 가능합니다.");
	js_code( "opener.window.location.reload();" );
	js_code( "window.close();" );

}


elseif ($rs_user_id == $s_user_id)

{



	 $query = "
						UPDATE	intranet.working_status SET
								memo	= '$memo'
						where	uid  = '$uid'
						AND		working_date = '$working_date'
			";
			


	$db->query( $query );

	js_code( "opener.window.location.reload();" );
	js_code( "window.close();" );


}

?>