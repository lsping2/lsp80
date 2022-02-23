<?

require_once "../../../include/include.php";
html_cache_disable();

$withdraw_code = request( 'withdraw_code', 'post' );
$withdraw_name = request( 'withdraw_name', 'post' );
$use_status = request( 'use_status', 'post' );
$old_withdraw_code = request( 'old_withdraw_code', 'post' );

check_value( $old_withdraw_code, '원코드가 없습니다.' );
check_length( $withdraw_code, '==', 3, '코드는 3자리로 입력하세요.' );
check_length( $withdraw_name, '<=', 40, '탈퇴사유는 40자 이하로 입력하세요.' );

$query = "
			UPDATE user_withdraw_code	SET		withdraw_code = '$withdraw_code' ,
												withdraw_name = '$withdraw_name' ,
												use_status = '$use_status'
										WHERE	withdraw_code = '$old_withdraw_code'
";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'user_withdraw_code.html' );

}

$db->close();

?>
