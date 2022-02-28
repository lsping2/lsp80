<?

require_once "../../../include/include.php";
html_cache_disable();

$bank_code = request( 'bank_code', 'get' );

check_value( $bank_code, '코드가 없습니다.' );

$query = "DELETE FROM order_bank_code WHERE bank_code = '$bank_code'";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'bank_code.html' );

}

$db->close();

?>
