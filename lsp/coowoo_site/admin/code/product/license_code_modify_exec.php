<?

require_once "../../../include/include.php";
html_cache_disable();

$license_code = request( 'license_code' , 'post' );
$license_name = request( 'license_name' , 'post' );
$license_text = request( 'license_text' , 'post' );
$use_status = request( 'use_status' , 'post' );
$old_license_code = request( 'old_license_code', 'post' );

check_value( $old_license_code, '�����̼����ڵ尡 �����ϴ�.' );
check_length( $license_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
check_length( $license_name, '<=', 200, '���̼��� �̸��� 200�� ���Ϸ� �Է��ϼ���.' );

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
