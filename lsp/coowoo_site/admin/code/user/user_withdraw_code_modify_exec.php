<?

require_once "../../../include/include.php";
html_cache_disable();

$withdraw_code = request( 'withdraw_code', 'post' );
$withdraw_name = request( 'withdraw_name', 'post' );
$use_status = request( 'use_status', 'post' );
$old_withdraw_code = request( 'old_withdraw_code', 'post' );

check_value( $old_withdraw_code, '���ڵ尡 �����ϴ�.' );
check_length( $withdraw_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
check_length( $withdraw_name, '<=', 40, 'Ż������� 40�� ���Ϸ� �Է��ϼ���.' );

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
