<?

require_once "../../../include/include.php";
html_cache_disable();

$watermark_code = request( 'watermark_code' , 'post' );
$watermark_name = request( 'watermark_name' , 'post' );
$watermark_folder = request( 'watermark_folder' , 'post' );
$use_status = request( 'use_status' , 'post' );

check_length( $watermark_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
check_length( $watermark_name, '<=', 100, '�̸��� 100�� ���Ϸ� �Է��ϼ���.' );
check_length( $watermark_folder, '<=', 100, '������ 100�� ���Ϸ� �Է��ϼ���.' );

$query = "INSERT INTO product_watermark_code VALUES ( '$watermark_code', '$watermark_name', '$watermark_folder', '$use_status' )";

$db = new MYSQL();

$db->query( $query );
if( $db->confirm_flag )
{

	meta_go( 'watermark_code.html' );

}

$db->close();

?>
