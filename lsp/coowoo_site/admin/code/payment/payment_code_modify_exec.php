<?

require_once "../../../include/include.php";
html_cache_disable();

$payment_code = request( 'payment_code', 'post' );
$payment_name = request( 'payment_name', 'post' );
$use_status = request( 'use_status' , 'post' );
$old_payment_code = request( 'old_payment_code', 'post' );

check_value( $old_payment_code, '����������ڵ尡 �����ϴ�.' );
check_length( $payment_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
check_length( $payment_name, '<=', 40, '��������� 40�� ���Ϸ� �Է��ϼ���.' );

$query = "
			UPDATE order_payment_code	SET		payment_code = '$payment_code' ,
												payment_name = '$payment_name' ,
												use_status = '$use_status' 
										WHERE	payment_code = '$old_payment_code'
";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'payment_code.html' );

}

$db->close();

?>
