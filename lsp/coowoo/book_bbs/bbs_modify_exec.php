<?

require_once "../include/include.php";
//require_once "../login/login_check.php";
//login_check( $PHP_SELF );

html_cache_disable();


$bbs_uid		= request( 'bbs_uid'	, 'post' );
$table		= request( 'table'		, 'post' );
$page		= request( 'page'		, 'post' );
$subject		= request( 'subject'	, 'post' );
$comment	= request( 'comment'	, 'post' );
$search_field	= request( 'search_field', 'post' );
$search_key	= stripcslashes( request( 'search_key', 'post' ) );
if( $search_key ) $location = "&search_field={$search_field}&search_key=". htmlspecialchars( $search_key ); else $location = '';

$db = new MYSQL();

$query = "
			SELECT	b.bbs_uid ,
					ui.user_id 
			FROM	{$table} as b ,
					coowoo.user_info as ui
			WHERE	b.user_id = ui.user_id
			AND		b.bbs_uid = '$bbs_uid'
";

$db->query( $query );
$db->fetch();
$user_id		= $db->result( 'user_id' );




if ( $user_id == $s_user_id )
{
	$query = "
				UPDATE {$table}	SET		subject = '$subject' ,
										comment = '$comment'
								WHERE	bbs_uid = '$bbs_uid'
	";

	$db->query( $query );
	$db->close();

	meta_go( "bbs_view.html?table={$table}&bbs_uid={$bbs_uid}&page={$page}{$location}" );
}


else 
{
	js_msg("글쓴이 본인만 수정할수 있습니다.");
	js_code("window.history.back()");

}

?>
