<?

require_once "../../../include/include.php";
html_cache_disable();

$category_no	= request( 'category_no', 'get' );

$db = new MYSQL();

$query = "
				SELECT	category_gid ,
							category_thread
				FROM	cd_category
				WHERE	category_no = '$category_no'
";
$db->query( $query );
$db->fetch();

$rs_category_gid = $db->result( 'category_gid' );
$rs_category_thread = $db->result( 'category_thread' );

$query = "
				DELETE cd_category_link
				FROM	cd_category as cc ,
							cd_category_link as ccl
				WHERE	cc.category_no = ccl.category_no
				AND		cc.category_gid = '$rs_category_gid'
				AND		cc.category_thread LIKE '$rs_category_thread%'
";
$db->query( $query );

$query = "
				DELETE FROM	 cd_category
				WHERE	category_gid = '$rs_category_gid'
				AND		category_thread LIKE '$rs_category_thread%'
";
$db->query( $query );

js_code( "window.history.back()" );

?>