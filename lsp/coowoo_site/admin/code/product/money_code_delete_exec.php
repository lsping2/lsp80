<?

require_once "../../../include/include.php";
html_cache_disable();

$money_code = request( 'money_code', 'get' );

check_value( $money_code, '화폐코드가 없습니다.' );

$query = "DELETE FROM product_money_code WHERE money_code = '$money_code'";

$db = new MYSQL();
$db->query( $query );

if( $db->confirm_flag )
{
	meta_go( 'money_code.html' );
}

$db->close();

?>
