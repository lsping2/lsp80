<?

require_once "../../../include/include.php";
html_cache_disable();

$withdraw_code = request( 'withdraw_code', 'post' );
$withdraw_name = request( 'withdraw_name', 'post' );
$use_status = request( 'use_status', 'post' );

check_length( $withdraw_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
check_length( $withdraw_name, '<=', 40, 'Ż������� 40�� ���Ϸ� �Է��ϼ���.' );

$query = "INSERT INTO user_withdraw_code VALUES ( '$withdraw_code', '$withdraw_name', '$use_status' )";

$db = new MYSQL();

$db->query( $query );
if( $db->confirm_flag )
{

	meta_go( 'user_withdraw_code.html' );

}

$db->close();

?>