<?

require_once "../../../include/include.php";
html_cache_disable();

$withdraw_code = request( 'withdraw_code', 'get' );

check_value( $withdraw_code, '코드가 없습니다.' );

$query = "DELETE FROM user_withdraw_code WHERE withdraw_code = '$withdraw_code'";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'user_withdraw_code.html' );

}

$db->close();

?>
