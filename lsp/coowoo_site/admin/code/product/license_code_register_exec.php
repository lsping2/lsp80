<?

require_once "../../../include/include.php";
html_cache_disable();

$license_code	= request( 'license_code'	, 'post' );
$license_name	= request( 'license_name'	, 'post' );
$license_text	= request( 'license_text'	, 'post' );
$use_status		= request( 'use_status'		, 'post' );

check_length( $license_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
check_length( $license_name, '<=', 100, '���̼��� �̸��� 200�� ���Ϸ� �Է��ϼ���.' );

$query = "INSERT INTO product_license_code VALUES ( '$license_code', '$license_name', '$license_text', '$use_status' )";

$db = new MYSQL();

$db->query( $query );
if( $db->confirm_flag )
{

	meta_go( 'license_code.html' );

}

$db->close();

?>
