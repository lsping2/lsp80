<?

require_once "../../../include/include.php";
html_cache_disable();

$payment_code = request( 'payment_code', 'get' );

check_value( $payment_code, '��������ڵ尡 �����ϴ�.' );

$query = "DELETE FROM order_payment_code WHERE payment_code = '$payment_code'";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'payment_code.html' );

}

$db->close();

?>
