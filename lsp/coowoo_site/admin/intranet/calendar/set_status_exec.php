<?

require_once "../../../include/include.php";
html_cache_disable();

$user_id			= request( 'user_id' , 'post' );
$working_date		= request( 'working_date', 'post' );
$status_code		= request( 'status_code' , 'post' );

$db = new MYSQL;

$query = "
		SELECT	*
		FROM	intranet.calendar_duty
		WHERE	user_id = '$user_id'
		AND		working_date = '$working_date'
";
$db->query( $query );

if( $db->total_record() )
{
	
	IF ( '' == $status_code )   // 처음 근무설정후  근무 없는상태로 재설정할경우 기존데이터 삭제 
	{
		
		 $query = "
			DELETE FROM		intranet.calendar_duty 
			WHERE			user_id = '$user_id' 
			AND				working_date = '$working_date'
		";
		$db->query( $query );
	}

	$query = "
			UPDATE intranet.calendar_duty SET status_code = '$status_code' WHERE user_id = '$user_id' AND working_date = '$working_date'
	";
	$db->query( $query );
}
else
{
	IF ( '' != $status_code )    // 처음에 널값이 들어가는것 방지
	{
		$query = "
				INSERT INTO intranet.calendar_duty SET	user_id = '$user_id' ,
													status_code = '$status_code' ,
													working_date = '$working_date' ,
													reg_date = now()
		";
		$db->query( $query );
	}
}	

?>
<script language=javascript>
<!--
	
	opener.opener.window.location.reload();
	opener.window.location.reload();
	self.close();
-->
</script>