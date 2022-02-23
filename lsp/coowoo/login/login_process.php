<?

session_start();

require_once "../include/include.php";
html_cache_disable();

$user_id	= request( 'user_id', 'post' );
$user_passwd	= request( 'user_passwd', 'post' );
$request_url	= request( 'request_url' , 'post' );

check_value( $user_id, '아이디가 없습니다.' );
check_value( $user_passwd, '비밀번호가 없습니다.' );

$query	= "	
			SELECT	user_uid ,
				user_id ,
				user_name ,
				user_level
			FROM	User_Info
			WHERE	user_id		= '$user_id'
			AND	user_passwd	= '$user_passwd'
			AND	use_status = 'Yes'
";

$db = new MYSQL();

$db->query( $query );
if( $db->total_record() )
{

	$db->fetch();

	$user_uid	= $db->result( 'user_uid' );
	$user_id	= $db->result( 'user_id' );
	$user_name	= $db->result( 'user_name' );
	$user_level	= $db->result( 'user_level' );

	$_SESSION[ 'S_USER_UID' ]	= $user_uid;
	$_SESSION[ 'S_USER_ID' ]	= $user_id;
	$_SESSION[ 'S_USER_NAME' ]	= $user_name;
	$_SESSION[ 'S_USER_LEVEL' ]	= $user_level;

	if( $request_url )
	{
		if( "/" == substr( $request_url , 0, 1 ) )
		{
			meta_go( $SERVER_CONFIG[ 'site_address' ] . $request_url );
		}
		else
		{
			meta_go( $SERVER_CONFIG[ 'site_address' ] . "/" . $request_url );
		}
	}
	else
	{
		meta_go( '../book_bbs/bbs_list.html' );
	}

}
else
{

	js_back( "로그인 정보가 없습니다." );

}

$db->close();

?>
