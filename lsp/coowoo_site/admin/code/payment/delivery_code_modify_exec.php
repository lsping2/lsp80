<?

require_once "../../../include/include.php";
html_cache_disable();

$delivery_code = request( 'delivery_code', 'post' );
$delivery_name = request( 'delivery_name', 'post' );
$use_status = request( 'use_status', 'post' );
$old_delivery_code = request( 'old_delivery_code', 'post' );

check_value( $old_delivery_code, '���ڵ尡 �����ϴ�.' );
check_length( $delivery_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
// check_length( $delivery_name, '<=', 40, '��۹���� 40�� ���Ϸ� �Է��ϼ���.' );

$query = "
			UPDATE order_delivery_code	SET		delivery_code = '$delivery_code' ,
											delivery_name = '$delivery_name' ,
											use_status = '$use_status'
									WHERE	delivery_code = '$old_delivery_code'
";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'delivery_code.html' );

}

$db->close();

?>
