<?

require_once "../../../include/include.php";
html_cache_disable();

$type_code = request( 'type_code', 'get' );

check_value( $type_code, '구분코드가 없습니다.' );

$query = "DELETE FROM user_type_code WHERE type_code = '$type_code'";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'user_type_code.html' );

}

$db->close();

?>
