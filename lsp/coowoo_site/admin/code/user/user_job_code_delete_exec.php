<?

require_once "../../../include/include.php";
html_cache_disable();

$job_code = request( 'job_code', 'get' );

check_value( $job_code, '직업코드가 없습니다.' );

$query = "DELETE FROM user_job_code WHERE job_code = '$job_code'";

$db = new MYSQL();

$db->query( $query );

if( $db->confirm_flag )
{

	meta_go( 'user_job_code.html' );

}

$db->close();

?>
