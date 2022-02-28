<?

require_once "../../../include/include.php";
html_cache_disable();


$bank_code		= request( 'bank_code', 'post' );
$bank_name		= request( 'bank_name', 'post' );
$bank_account	= request( 'bank_account', 'post' );
$bank_depositor = request( 'bank_depositor', 'post' );
$use_status		= request( 'use_status', 'post' );

check_length( $bank_code, '==', 3, '코드는 3자리로 입력하세요.' );
check_length( $bank_name, '<=', 40, '은행이름은 40자 이하로 입력하세요.' );

$query = "INSERT INTO order_bank_code VALUES ( '$bank_code', '$bank_name', '$bank_account', '$bank_depositor', '$use_status' )";

$db = new MYSQL();

$db->query( $query );
if( $db->confirm_flag )
{

	meta_go( 'bank_code.html' );

}

$db->close();

?>
