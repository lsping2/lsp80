<?

require_once "../../../include/include.php";
html_cache_disable();

$watermark_code = request( 'watermark_code', 'get' );

check_value( $watermark_code, '삭제할 워터마크 코드가 없습니다.' );

$query = "DELETE FROM product_watermark_code WHERE watermark_code = '$watermark_code'";

$db = new MYSQL();
$db->query( $query );

if( $db->confirm_flag )
{
	meta_go( 'watermark_code.html' );
}

$db->close();

?>
