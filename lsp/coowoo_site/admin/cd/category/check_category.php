<?

require_once "../../../include/include.php";
html_cache_disable();

$category_no = request( 'category_no' );

$db = new MYSQL;

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

} // end for( $loop=0; $loop<count($category_no); $loop++ )

if( count( $category_no ) )
{
	$put_category_name .= "\\n분류가 선택되었습니다.     ";
}
else
{
	$put_category_name .= "\\n선택된 분류가 없습니다.     ";
}

js_msg( "{$put_category_name}" );
// js_code( "parent.window.location.reload()" );

?>