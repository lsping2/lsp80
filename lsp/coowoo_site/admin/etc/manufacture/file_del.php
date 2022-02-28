<?

require_once "../../../include/include.php";
require_once "../../login/login_check.php";
login_check( $PHP_SELF );

html_cache_disable();

$bbs_uid		= request( 'bbs_uid' , 'get' );
$manufacture_code	= request( 'manufacture_code', 'get' );
$page		= request( 'page' , 'get' );
$search_field	= request( 'search_field', 'get' );
$search_key		= stripcslashes( request( 'search_key', 'get' ) );
if( $search_key ) $location = "&manufacture_code={$manufacture_code}&search_field={$search_field}&search_key=". htmlspecialchars( $search_key ); else $location = "&manufacture_code={$manufacture_code}";


$db = new MYSQL();


$query = "
			SELECT	user_id 
			FROM	bbs_manufacture 
			WHERE	bbs_uid = '$bbs_uid'
";

$db->query( $query );
$db->fetch();
$user_id		= $db->result( 'user_id' );





if ( $user_id == $s_user_id )
{

	$query = "
				SELECT	tmp_filename
				FROM	bbs_manufacture 
				WHERE	bbs_uid = '$bbs_uid'
	";

	$db->query( $query );
	$db->fetch();


	 $tmp_filename = $db->result( 'tmp_filename' );

	if ($tmp_filename)
	{
		 $folder='download/';
		 $file_name =  $folder."/".$tmp_filename;
		 exec("rm $file_name");
	}


	$query = "
				UPDATE	bbs_manufacture  
				SET		real_filename = '' ,
						tmp_filename  = '',
						filesize = ''
				WHERE	bbs_uid = '$bbs_uid'
	";

	$db->query( $query );
	
	js_code("window.history.back()");
}

else 
{
	js_msg("작성자만 삭제할수 있습니다.");
	js_code("window.history.back()");

}
?>
