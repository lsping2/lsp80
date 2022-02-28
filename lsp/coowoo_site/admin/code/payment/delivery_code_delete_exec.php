<?

require_once "../../../include/include.php";
html_cache_disable();

$delivery_code = request( 'delivery_code', 'get' );

check_value( $delivery_code, '코드가 없습니다.' );

$query = "DELETE FROM order_delivery_code WHERE delivery_code = '$delivery_code'";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'delivery_code.html' );

}

$db->close();

?>
