<?

require_once "../../../include/include.php";
html_cache_disable();

$job_code = request( 'job_code', 'post' );
$job_name = request( 'job_name', 'post' );
$use_status = request( 'use_status', 'post' );
$old_job_code = request( 'old_job_code', 'post' );

check_value( $old_job_code, '���ڵ尡 �����ϴ�.' );
check_length( $job_code, '==', 3, '�ڵ�� 3�ڸ��� �Է��ϼ���.' );
check_length( $job_name, '<=', 40, '�ڵ弳���� 40�� ���Ϸ� �Է��ϼ���.' );

$query = "
			UPDATE user_job_code	SET		job_code = '$job_code' ,
											job_name = '$job_name' ,
											use_status = '$use_status' 
									WHERE	job_code = '$old_job_code'
";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'user_job_code.html' );

}

$db->close();

?>
