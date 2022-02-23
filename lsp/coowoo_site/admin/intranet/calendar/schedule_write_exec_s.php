<?
require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();


 $to = request( 'to' );
$schedule_date		= request('schedule_date','post' );
$business_diary		= request('business_diary','post' );
$uid					= request('uid','post' );



$db = new MYSQL;

 $query = "
			SELECT	user_id ,
					to_user_name
			FROM	intranet.working_status
			where	working_date  = '$schedule_date'
			AND		uid = '$uid'
	";
$db->query( $query );

$db->fetch();

 $rs_user_id		= $db->result( 'user_id' );
 $rs_to_user_name = $db->result( 'to_user_name' );


if ($rs_user_id !=$s_user_id)
{
	js_msg("본인만 등록 및 수정 가능합니다.");
	js_code( "opener.window.location.reload();" );
	js_code( "window.close();" );

}

elseif ($rs_user_id ==$s_user_id)
{




		if( in_array( '전체' , $to ) AND count( $to ) > 1 ) array_shift( $to );

		for( $loop=0; $loop<count( $to ); $loop++ )
		{
			  $to_user_name .= "/" . $to[$loop];
		}
		$to_user_name = substr( $to_user_name , 1 );
		if( !$to_user_name )  $to_user_name = '기타';

		$db2 = new MYSQL;

		 $to_user_name2 = explode("/",$to_user_name); 

		$comment = $SUserName."님의 글입니다.<br><br>". nl2br( $business_diary );


		for( $loop=0; $loop<count( $to_user_name2 ); $loop++ )
		{
			

			$query = "
					SELECT	user_email
					FROM	intranet.user_info
					WHERE	use_status = 'Yes'
					AND		user_name  = '$to_user_name2[$loop]'
					ORDER BY user_sort ASC
			";
			$db2->query( $query );


			if( $db2->total_record() )
			{
				$db2->fetch();

				$rs_user_email = $db2->result( 'user_email' );

				$send_name		= "쿠우관리자";
				$from_email		= 'webmaster@coowoo.com';
				$returned_email	= '';
				$to_email			= $rs_user_email;

				my_smail( $send_name, $from_email, $returned_email, $to_email, "(업무일지게시판 : $SUserName) ".$subject, $comment );

			}

		}



	$query = "
				
					UPDATE intranet.working_status  SET 
									to_user_name   = '$to_user_name' ,
									business_diary  = '$business_diary' ,
									reg_date		  = now()
							where	uid			  = '$uid'
							AND		working_date = '$schedule_date'								
		";

	$db->query( $query );

	js_code( "opener.window.location.reload();" );
	js_code( "window.close();" );
}

?>