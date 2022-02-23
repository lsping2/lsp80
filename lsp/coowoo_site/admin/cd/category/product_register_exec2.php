<?

require_once "../../../include/include.php";
html_cache_disable();

$cd_order_no = request( 'reg_cd_order_no' );
$category_no = request( 'category_no' );
$category_name = request( 'category_name' );

$db = new MYSQL;
$db2 = new MYSQL;

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

// 주제별 분류에 등록된 정보 삭제

$query = "
		SELECT	ccl.category_no 
		FROM	cd_category as cc
				LEFT JOIN cd_category_link as ccl
				ON cc.category_no = ccl.category_no
		WHERE	ccl.cd_no = '$rs_cd_no' 
		AND		cc.category_gid = '1'
		AND		cc.category_thread LIKE '001%'
";
$db->query( $query );
for( $loop=0; $loop<$db->total_record(); $loop++ )
{
	$db->fetch();
	$rs_category_no = $db->result( 'category_no' );

	$query = "
			DELETE FROM	cd_category_link
			WHERE		category_no = '$rs_category_no'
			AND			cd_no = '$rs_cd_no'
	";
	$db2->query( $query );

}

for( $loop=0; $loop<count($category_no); $loop++ )
{

	$dst_category_no = $category_no[ $loop ];

	$query = "
			SELECT	category_name
			FROM	cd_category
			WHERE	category_no = '$dst_category_no'
	";
	$db->query( $query );
	$db->fetch();
	$rs_category_name = $db->result( 'category_name' );

	$put_category_name .= "{$rs_category_name}\\n";

	$query = "
				INSERT INTO cd_category_link ( link_no, category_no, cd_no , cd_order_no ) VALUES ( NULL, '$dst_category_no', '$rs_cd_no', '$cd_order_no' );
		";
	// echo $query;
	$db->query( $query );

	

} // end for( $loop=0; $loop<count($category_no); $loop++ )


$put_category_name .= "\\n분류에 " . strtoupper( $cd_order_no ) . "를 등록하였습니다.   ";

if( $cd_order_no )
{
	$no = substr( $cd_order_no, -3 );
	$cd_order_no = substr( $cd_order_no, 0, strlen( $cd_order_no ) - 3 ) . sprintf( '%03d', $no + 1 );
}

js_msg( "{$put_category_name}" );
js_code( "parent.window.location.href='category_show2.php?cd_order_no={$cd_order_no}'" );

?>