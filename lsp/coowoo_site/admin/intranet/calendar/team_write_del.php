<?


require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );



$working_date	 	=  request( 'working_date' , 'get' );
$diary_no			=  request( 'diary_no' , 'get' );






$db = new MYSQL;


 
 $query = "
			SELECT	user_id	
			FROM	intranet.business_diary 
			where	working_date  = '$working_date'
			AND		diary_no = '$diary_no'
	";

	
$db->query( $query );

$db->fetch();

 $rs_user_id		= $db->result( 'user_id' );






if ($rs_user_id !=$s_user_id)
{
	js_msg("���θ� ������ �� �ֽ��ϴ�.");
	js_back();
	exit;
}


elseif ($rs_user_id == $s_user_id)

{



	 $query = "
						DELETE FROM	intranet.business_diary  
						WHERE		diary_no  = '$diary_no'
						AND			working_date = '$working_date'
			";
			


	$db->query( $query );


}



js_code( "parent.window.history.go(-1)" );


?>