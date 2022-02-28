<?

require_once "../../../include/include.php";
html_cache_disable();

$license_code = request( 'license_code' , 'post' );
$license_name = request( 'license_name' , 'post' );
$license_text = request( 'license_text' , 'post' );
$use_status = request( 'use_status' , 'post' );
$old_license_code = request( 'old_license_code', 'post' );

check_value( $old_license_code, '원라이센스코드가 없습니다.' );
check_length( $license_code, '==', 3, '코드는 3자리로 입력하세요.' );
check_length( $license_name, '<=', 200, '라이센스 이름은 200자 이하로 입력하세요.' );

$query = "
			UPDATE product_license_code	SET		license_code = '$license_code' ,
												license_name = '$license_name' ,
												license_text = '$license_text' ,
												use_status = '$use_status' 
										WHERE	license_code = '$old_license_code'
";

$db = new MYSQL();
$db->query( $query );

if( $db->confirm_flag )
{
	meta_go( 'license_code.html' );
}

$db->close();

?>
