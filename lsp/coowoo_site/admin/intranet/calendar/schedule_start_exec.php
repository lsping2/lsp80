<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );

$SUserUid = request( 'S_USER_UID' , 'session' );

$working_date		= request( 'working_date','get' );
$uid				= request('uid','get' );
$user_id			=request('user_id','get');



$db = new MYSQL;


 $query = "
				SELECT date_start 
				FROM	intranet.working_status
				WHERE	working_date = '$schedule_date'
				AND		user_id = '$user_id'
			
			
			
		";

$db->query( $query );
$db->fetch();

 $date_start		= $db->result( 'date_start' );



if ( $s_user_id == $user_id )

{

	   $query = "
				INSERT INTO intranet.working_status (
												uid ,
												date_start ,
												memo ,
												user_id ,
												business_diary ,
												working_date ,
												reg_date
											)
											VALUES
											(
												'' ,
												now(),
												'$memo' ,
												'$user_id' ,
												'$business_diary' ,
												'$working_date' ,
												 now()
											)
		";




	$db->query( $query );
}



else
{
	js_msg("본인만 등록 가능합니다.");
}



js_code( "window.history.go(-1)" );

?>
