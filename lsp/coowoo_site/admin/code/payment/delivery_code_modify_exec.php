<?

require_once "../../../include/include.php";
html_cache_disable();

$delivery_code = request( 'delivery_code', 'post' );
$delivery_name = request( 'delivery_name', 'post' );
$use_status = request( 'use_status', 'post' );
$old_delivery_code = request( 'old_delivery_code', 'post' );

check_value( $old_delivery_code, '원코드가 없습니다.' );
check_length( $delivery_code, '==', 3, '코드는 3자리로 입력하세요.' );
// check_length( $delivery_name, '<=', 40, '배송방법은 40자 이하로 입력하세요.' );

$query = "
			UPDATE order_delivery_code	SET		delivery_code = '$delivery_code' ,
											delivery_name = '$delivery_name' ,
											use_status = '$use_status'
									WHERE	delivery_code = '$old_delivery_code'
";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'delivery_code.html' );

}

$db->close();

?>
