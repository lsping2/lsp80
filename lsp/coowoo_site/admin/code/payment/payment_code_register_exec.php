<?

require_once "../../../include/include.php";
html_cache_disable();

$payment_code = request( 'payment_code', 'post' );
$payment_name = request( 'payment_name', 'post' );
$use_status = request( 'use_status', 'post' );

check_length( $payment_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
check_length( $payment_name, '<=', 40, '��������� 40�� ���Ϸ� �Է��ϼ���.' );

$query = "INSERT INTO order_payment_code VALUES ( '$payment_code', '$payment_name', '$use_status' )";

$db = new MYSQL();

$db->query( $query );
if( $db->confirm_flag )
{

	meta_go( 'payment_code.html' );

}

$db->close();

?>
