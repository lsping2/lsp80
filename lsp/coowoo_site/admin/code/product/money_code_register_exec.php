<?

require_once "../../../include/include.php";
html_cache_disable();

$money_code = request( 'money_code' , 'post' );
$money_name = request( 'money_name' , 'post' );
$money_sign = request( 'money_sign' , 'post' );
$money_exchange = request( 'money_exchange' , 'post' );
$use_status = request( 'use_status' , 'post' );

check_length( $money_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
check_length( $money_name, '<=', 20, 'ȭ�󼳸��� 20�� ���Ϸ� �Է��ϼ���.' );
check_length( $money_sign, '<=', 20, 'ȭ���ȣ�� 20�� ���Ϸ� �Է��ϼ���.' );

$query = "INSERT INTO product_money_code VALUES ( '$money_code', '$money_name', '$money_sign', '$money_exchange', '$use_status' )";

$db = new MYSQL();

$db->query( $query );
if( $db->confirm_flag )
{

	meta_go( 'money_code.html' );

}

$db->close();

?>
