<?

require_once "../../../include/include.php";
html_cache_disable();

$manufacture_code = request( 'manufacture_code' , 'post' );
$manufacture_name = request( 'manufacture_name' , 'post' );
$manufacture_warning = request( 'manufacture_warning' , 'post' );
$watermark_code	= request( 'watermark_code' , 'post' );
$use_status = request( 'use_status' , 'post' );
$old_manufacture_code = request( 'old_manufacture_code', 'post' );

check_value( $old_manufacture_code, '원제작사코드가 없습니다.' );
check_length( $manufacture_code, '==', 3, '코드는 3자리로 입력하세요.' );
check_length( $manufacture_name, '<=', 100, '제작사는 100자 이하로 입력하세요.' );

$query = "
			UPDATE product_manufacture_code	SET		manufacture_code = '$manufacture_code' ,
													manufacture_name = '$manufacture_name' ,
													manufacture_warning = '$manufacture_warning' ,
													watermark_code = '$watermark_code' ,
													use_status = '$use_status' 
											WHERE	manufacture_code = '$old_manufacture_code'
";

$db = new MYSQL();
$db->query( $query );

if( $db->confirm_flag )
{
	meta_go( 'manufacture_code.html' );
}

$db->close();

?>
