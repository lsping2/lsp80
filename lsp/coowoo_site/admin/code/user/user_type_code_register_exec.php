<?

require_once "../../../include/include.php";
html_cache_disable();

$type_code = request( 'type_code', 'post' );
$type_name = request( 'type_name', 'post' );
$use_status = request( 'use_status', 'post' );

check_length( $type_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
check_length( $type_name, '<=', 40, '�ڵ弳���� 40�� ���Ϸ� �Է��ϼ���.' );

$query = "INSERT INTO user_type_code VALUES ( '$type_code', '$type_name', '$use_status' )";

$db = new MYSQL();

$db->query( $query );
if( $db->confirm_flag )
{

	meta_go( 'user_type_code.html' );

}

$db->close();

?>
