<?

require_once "../../../include/include.php";
html_cache_disable();

$cd_order_no = request( 'cd_order_no' );
$category_no = request( 'category_no' );
$category_name = request( 'category_name' );

$db = new MYSQL;

$query = "
				SELECT	cd_no
				FROM	product_cd
				WHERE	cd_order_no = '$cd_order_no'
				AND		use_status = 'Yes'
";
$db->query( $query );
if( !$db->total_record() )
{
	js_msg( "사용중인 시디 주문번호가 아닙니다." );
	exit;
}

$db->fetch();
$rs_cd_no = $db->result( 'cd_no' );

$query = "
			SELECT	*
			FROM	cd_category_link
			WHERE	category_no = '$category_no'
			AND		cd_no = '$rs_cd_no'
";
$db->query( $query );

if( !$db->total_record() )
{

	$query = "
					INSERT INTO cd_category_link ( link_no, category_no, cd_no , cd_order_no ) VALUES ( NULL, '$category_no', '$rs_cd_no', '$cd_order_no' );
	";
	$db->query( $query );

}


js_code( "parent.window.location.reload()" );

?>