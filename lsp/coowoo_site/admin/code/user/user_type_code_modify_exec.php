<?

require_once "../../../include/include.php";
html_cache_disable();

$type_code = request( 'type_code', 'post' );
$type_name = request( 'type_name', 'post' );
$use_status = request( 'use_status', 'post' );
$old_type_code = request( 'old_type_code', 'post' );

check_value( $old_type_code, '원코드가 없습니다.' );
check_length( $type_code, '==', 3, '코드는 3자리로 입력하세요.' );
check_length( $type_name, '<=', 40, '코드설명은 40자 이하로 입력하세요.' );

$query = "
			UPDATE user_type_code	SET		type_code = '$type_code' ,
											type_name = '$type_name' ,
											use_status = '$use_status'
									WHERE	type_code = '$old_type_code'
";

$db = new MYSQL();
$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'user_type_code.html' );

}

$db->close();

?>
