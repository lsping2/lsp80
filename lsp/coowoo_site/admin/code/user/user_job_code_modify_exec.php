<?

require_once "../../../include/include.php";
html_cache_disable();

$job_code = request( 'job_code', 'post' );
$job_name = request( 'job_name', 'post' );
$use_status = request( 'use_status', 'post' );
$old_job_code = request( 'old_job_code', 'post' );

check_value( $old_job_code, '원코드가 없습니다.' );
check_length( $job_code, '==', 3, '코드는 3자리로 입력하세요.' );
check_length( $job_name, '<=', 40, '코드설명은 40자 이하로 입력하세요.' );

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
