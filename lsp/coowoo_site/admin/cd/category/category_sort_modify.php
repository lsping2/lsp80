<?

require_once "../../../include/include.php";
html_cache_disable();

$category_no		= request( 'category_no', 'post' );
$category_sort	= request( 'category_sort', 'post' );

$db = new MYSQL();

$query = "
				UPDATE cd_category SET category_sort = '$category_sort' WHERE category_no = '$category_no'
";
$db->query( $query );

js_code( "parent.window.location.reload()" );

?>