<?

require_once "../../../include/include.php";
html_cache_disable();

$money_code = request( 'money_code' , 'post' );
$money_name = request( 'money_name' , 'post' );
$money_sign = request( 'money_sign' , 'post' );
$money_exchange = request( 'money_exchange' , 'post' );
$use_status = request( 'use_status' , 'post' );

check_length( $money_code, '==', 3, '코드는 3자리로 입력하세요.' );
check_length( $money_name, '<=', 20, '화폐설명은 20자 이하로 입력하세요.' );
check_length( $money_sign, '<=', 20, '화폐기호는 20자 이하로 입력하세요.' );

$query = "INSERT INTO product_money_code VALUES ( '$money_code', '$money_name', '$money_sign', '$money_exchange', '$use_status' )";

$db = new MYSQL();

$db->query( $query );
if( $db->confirm_flag )
{

	meta_go( 'money_code.html' );

}

$db->close();

?>
