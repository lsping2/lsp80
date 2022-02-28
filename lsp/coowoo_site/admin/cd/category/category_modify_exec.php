<?

require_once "../../../include/include.php";
html_cache_disable();

$category_no		= request( 'category_no', 'post' );
$category_name	= addslashes( trim( request( 'category_name', 'post' ) ) );
$category_title		= request( 'category_title', 'post' );

$db = new MYSQL();

$query = "
				UPDATE cd_category	SET		category_name = '$category_name' ,
											category_title = '$category_title'
									WHERE	category_no = '$category_no'
";
$db->query( $query );

js_code( "alert('수정되었습니다.')" );
js_code( "window.history.back()" );

?>