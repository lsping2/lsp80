<?

require_once "../../../include/include.php";
html_cache_disable();

$job_code = request( 'job_code', 'post' );
$job_name = request( 'job_name', 'post' );
$use_status = request( 'use_status', 'post' );

check_length( $job_code, '==', 3, '코드는 3자리로 입력하세요.' );
check_length( $job_name, '<=', 40, '코드설명은 40자 이하로 입력하세요.' );

$query = "INSERT INTO user_job_code VALUES ( '$job_code', '$job_name', '$use_status' )";

$db = new MYSQL();

$db->query( $query );
if( $db->confirm_flag )
{

	meta_go( 'user_job_code.html' );

}

$db->close();

?>
