<?

require_once "../../../include/include.php";
html_cache_disable();

$payment_code = request( 'payment_code', 'post' );
$payment_name = request( 'payment_name', 'post' );
$use_status = request( 'use_status' , 'post' );
$old_payment_code = request( 'old_payment_code', 'post' );

check_value( $old_payment_code, '원결제방법코드가 없습니다.' );
check_length( $payment_code, '==', 3, '코드는 3자리로 입력하세요.' );
check_length( $payment_name, '<=', 40, '결제방법은 40자 이하로 입력하세요.' );

$query = "
			UPDATE order_payment_code	SET		payment_code = '$payment_code' ,
												payment_name = '$payment_name' ,
												use_status = '$use_status' 
										WHERE	payment_code = '$old_payment_code'
";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'payment_code.html' );

}

$db->close();

?>
