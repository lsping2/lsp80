<?

require_once "../../../include/include.php";
html_cache_disable();

$job_code = request( 'job_code', 'post' );
$job_name = request( 'job_name', 'post' );
$use_status = request( 'use_status', 'post' );

check_length( $job_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
check_length( $job_name, '<=', 40, '�ڵ弳���� 40�� ���Ϸ� �Է��ϼ���.' );

$query = "INSERT INTO user_job_code VALUES ( '$job_code', '$job_name', '$use_status' )";

$db = new MYSQL();

$db->query( $query );
if( $db->confirm_flag )
{

	meta_go( 'user_job_code.html' );

}

$db->close();

?>
