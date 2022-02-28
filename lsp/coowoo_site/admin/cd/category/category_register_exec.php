<?

require_once "../../../include/include.php";
html_cache_disable();

$category_name		= addslashes( trim( request( 'category_name', 'post' ) ) );
$gid					= request( 'gid', 'post' );
$thread				= request( 'thread', 'post' );

$url_option_value = "gid={$gid}&thread={$thread}";

$search_length = strlen( $thread ) + 3;
if( !$thread ) $search_length = 3;

$gid_query = '';
if( $gid )
{
    $gid_query = "and category_gid = $gid";
} 

$db = new MYSQL();

$query = "
				SELECT	category_thread
				FROM	cd_category
				WHERE	length( category_thread ) = $search_length
				AND		category_thread LIKE '$thread%'
				$gid_query
				ORDER BY category_thread DESC
				LIMIT 1
";
$db->query( $query );

// 하위 스레드 구함
$exist_thread = '';
if( $db->total_record() )
{
	$db->fetch();
	$exist_thread = $db->result( 'category_thread' );
}

if( $exist_thread AND $thread )
{
	$parent_thread	= substr( $exist_thread, 0, strlen( $exist_thread ) - 3 );
    $last_thread = substr( $exist_thread, strlen( $exist_thread ) - 3 );
    $last_thread++;
    $new_thread = $parent_thread . sprintf( "%03d", $last_thread );
}
else
{
    if( $thread )
    {
        $new_thread = $thread . "001";
    }
    else
    {
        $new_thread = "001";
    }
}

// 정렬순서 구함
$query = "
				SELECT	max( category_sort ) + 1 as new_sort
				FROM	cd_category
				WHERE	length( category_thread ) = $search_length
				AND		category_thread LIKE '$thread%'
				$gid_query
				ORDER BY category_thread DESC
				LIMIT 1
";
$db->query( $query );
$db->fetch();

$new_sort = $db->result( 'new_sort' );
if( !$new_sort ) $new_sort = 1;

// 분류 그룹 구함
if( $gid )
{
    $new_gid = $gid;
}
else
{
    $query = "
						SELECT	max( category_gid ) + 1 as new_gid
						FROM	cd_category
						WHERE	length( category_thread ) = 3
    ";
	$db->query( $query );
	$db->fetch();

    $new_gid = $db->result( 'new_gid' );
    if( !$new_gid ) $new_gid = 1;

} // end of if

$category_query = "
								INSERT INTO cd_category VALUES	(	NULL , 
																'$new_gid' ,
																'$new_thread' ,
																'$category_name' ,
																'' ,
																'' ,
																'$new_sort' ,
																now() )
";

$db->query( $category_query );

meta_go( "category_register.html?{$url_option_value}" );

?>