<?


require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );



$working_date =  request( 'working_date' , 'POST' );
$memo	=  request( 'memo' , 'POST' );
$uid		=  request( 'uid' , 'POST' );



$db = new MYSQL;
$db2 = new MYSQL;

 
IF ( $uid)   // ���üũ�� ���ְ�  �޸� ������ ex) ����..
{
 $query = "
				SELECT	user_id	
				FROM	intranet.working_status
				where	working_date  = '$working_date'
				AND		uid = '$uid'
		";
		$db->query( $query );

		$db->fetch();
		$rs_user_id		= $db->result( 'user_id' );



		$query = "
				SELECT	user_uid	
				FROM	intranet.calendar_duty 
				where	working_date  = '$working_date'
				AND		user_id = '$s_user_id'
		";
		$db2->query( $query );
		$db2->fetch();


		$db2->total_record();

		if ($rs_user_id !=$s_user_id)
		{
		js_msg("���θ� ��� �� ���� �����մϴ�.");
		js_code( "opener.window.location.reload();" );
		js_code( "window.close();" );

		}


		elseif ($rs_user_id == $s_user_id)

		{

		 $query = "
							UPDATE	intranet.working_status SET
									memo	= '$memo'
							where	uid		= '$uid'
							AND		working_date = '$working_date'
				";
				


		$db->query( $query );

		js_code( "opener.window.location.reload();" );
		js_code( "window.close();" );


		}
}
else // ���üũ�� �ȵ��ְ� �޸��� ������ ex) �ݿ����� �޸𳲱�
{
	 $query = "
				INSERT INTO intranet.working_status (
												uid  ,
												user_id  ,
												memo ,
												working_date  ,
												reg_date 
											)
											VALUES
											(
												'' ,
												'$s_user_id',
												'$memo' ,
												'$working_date' ,
												 now()
											)
		";




	$db->query( $query );

		js_code( "opener.window.location.reload();" );
		js_code( "window.close();" );
}

?>