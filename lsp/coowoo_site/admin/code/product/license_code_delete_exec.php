<?

require_once "../../../include/include.php";
html_cache_disable();

$license_code = request( 'license_code', 'get' );

check_value( $license_code, '���̼����ڵ尡 �����ϴ�.' );

$query = "DELETE FROM product_license_code WHERE license_code = '$license_code'";

$db = new MYSQL();
$db->query( $query );

if( $db->confirm_flag )
{
	meta_go( 'license_code.html' );
}

$db->close();

?>
