<?

require_once "../../../include/include.php";
html_cache_disable();


$bank_code		= request( 'bank_code', 'post' );
$bank_name		= request( 'bank_name', 'post' );
$bank_account	= request( 'bank_account', 'post' );
$bank_depositor = request( 'bank_depositor', 'post' );
$use_status		= request( 'use_status', 'post' );

check_length( $bank_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
check_length( $bank_name, '<=', 40, '�����̸��� 40�� ���Ϸ� �Է��ϼ���.' );

$query = "INSERT INTO order_bank_code VALUES ( '$bank_code', '$bank_name', '$bank_account', '$bank_depositor', '$use_status' )";

$db = new MYSQL();

$db->query( $query );
if( $db->confirm_flag )
{

	meta_go( 'bank_code.html' );

}

$db->close();

?>
