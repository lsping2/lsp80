<?
require_once "../../../include/include.php";
html_cache_disable();

$db = new MYSQL();
$db2 = new MYSQL();
$db3 = new MYSQL();


$filename = trim( request( 'filename' , 'post' ) );
$cd1		= trim( request( 'cd1' , 'post' ) );
$cd2		= trim( request( 'cd2' , 'post' ) );
if( !$cd2 ) $cd2 = $cd1;


$query = "
			SELECT	image_no ,
						product_class ,
						cd_order_no ,
						single_order_no ,
						image_name ,
						image_class ,
						image_shape
			FROM	product_images
			WHERE	cd_order_no >= '$cd1'
			AND		cd_order_no <= '$cd2'
			ORDER BY single_order_no ASC
";
$db->query( $query );

$fp = fopen( "download/".$filename, "w" );

 

for( $loop=0; $loop<$db->total_record(); $loop++ )
{

	$db->fetch();

	$rs_image_no		= $db->result( 'image_no' );
	$rs_product_class	= $db->result( 'product_class' );
	$rs_cd_order_no		= $db->result( 'cd_order_no' );
	$rs_single_order_no	= $db->result( 'single_order_no' );
	$rs_image_name		= $db->result( 'image_name' );
	$rs_image_class		= $db->result( 'image_class' );
	$rs_image_shape		= $db->result( 'image_shape' );

	$string = "$rs_cd_order_no,$rs_single_order_no,$rs_image_name,$rs_image_shape";

	$query = "
				SELECT	ki.index_no ,
						kn.keyword ,
						kn.section ,
						ki.marks
				FROM	keyindex_info as ki,
						keyword_no as kn
				WHERE	ki.index_no = kn.index_no
				AND		ki.image_no = '$rs_image_no'
	";
	$db2->query( $query );

	$keyword = "";
	for( $loop2=0; $loop2<$db2->total_record(); $loop2++ )
	{
		$db2->fetch();

		$rs_index_no		= $db2->result( 'index_no' );
		$rs_keyword		= $db2->result( 'keyword' );
		$rs_section		= $db2->result( 'section' );
		$rs_marks			= $db2->result( 'marks' );

		$keyword .= " " . trim( $rs_keyword );
	}

	$string .= "," . trim( $keyword );

	echo "$string\n";
	fputs( $fp, $string . "\n" );
} // end of for

fclose( $fp );


js_code("window.open('download.php?filename=$filename','self')");

?>

