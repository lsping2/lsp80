<?

require_once "../../../include/include.php";
html_cache_disable();

$manufacture_code = request( 'manufacture_code', 'get' );

check_value( $manufacture_code, '���ۻ��ڵ尡 �����ϴ�.' );

$query = "DELETE FROM product_manufacture_code WHERE manufacture_code = '$manufacture_code'";

$db = new MYSQL();
$db->query( $query );

if( $db->confirm_flag )
{
	meta_go( 'manufacture_code.html' );
}

$db->close();

?>
