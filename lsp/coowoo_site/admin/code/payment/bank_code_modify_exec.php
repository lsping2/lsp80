<?

require_once "../../../include/include.php";
html_cache_disable();

$bank_code = request( 'bank_code', 'post' );
$bank_name = request( 'bank_name', 'post' );
$bank_account = request( 'bank_account', 'post' );
$bank_depositor = request( 'bank_depositor', 'post' );
$use_status = request( 'use_status', 'post' );
$old_bank_code = request( 'old_bank_code', 'post' );

check_value( $old_bank_code, '���ڵ尡 �����ϴ�.' );
check_length( $bank_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );

$query = "
			UPDATE order_bank_code	SET		bank_code		= '$bank_code' ,
											bank_name		= '$bank_name' ,
											bank_account	= '$bank_account' ,
											bank_depositor	= '$bank_depositor' ,
											use_status		= '$use_status'
									WHERE	bank_code		= '$old_bank_code'
";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'bank_code.html' );

}

$db->close();

?>
