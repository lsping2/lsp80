<?

require_once "../../../include/include.php";
html_cache_disable();

$watermark_code = request( 'watermark_code', 'get' );

check_value( $watermark_code, '������ ���͸�ũ �ڵ尡 �����ϴ�.' );

$query = "DELETE FROM product_watermark_code WHERE watermark_code = '$watermark_code'";

$db = new MYSQL();
$db->query( $query );

if( $db->confirm_flag )
{
	meta_go( 'watermark_code.html' );
}

$db->close();

?>
