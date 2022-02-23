<?

require_once "../../../include/include.php";
html_cache_disable();

$link_no = request( 'link_no' );

$db = new MYSQL;

$query = "
				DELETE FROM cd_category_link WHERE link_no = '$link_no'
";
$db->query( $query );
js_code( "parent.window.location.reload()" );

?>