<?

require_once "../../../include/include.php";
html_cache_disable();

$watermark_code = request( 'watermark_code' , 'post' );
$watermark_name = request( 'watermark_name' , 'post' );
$watermark_folder = request( 'watermark_folder' , 'post' );
$use_status = request( 'use_status' , 'post' );
$old_watermark_code = request( 'old_watermark_code', 'post' );

check_value( $old_watermark_code, '기존 워터마크 코드가 없습니다.' );
check_length( $watermark_code, '==', 3, '코드는 3자리로 입력하세요.' );
check_length( $watermark_name, '<=', 100, '이름은 100자 이하로 입력하세요.' );
check_length( $watermark_folder, '<=', 100, '폴더는 100자 이하로 입력하세요.' );

$query = "
			UPDATE product_watermark_code	SET		watermark_code = '$watermark_code' ,
													watermark_name = '$watermark_name' ,
													watermark_folder = '$watermark_folder' ,
													use_status = '$use_status' 
											WHERE	watermark_code = '$old_watermark_code'
";

$db = new MYSQL();
$db->query( $query );

if( $db->confirm_flag )
{
	meta_go( 'watermark_code.html' );
}

$db->close();

?>
