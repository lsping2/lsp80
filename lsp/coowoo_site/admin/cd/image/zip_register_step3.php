<?

require_once "../../../include/include.php";
html_cache_disable();

$cd_order_no = strtoupper( trim( request( 'cd_order_no', 'post' ) ) );
$cd_zip_title = request( 'cd_zip_title', 'post' );

$db = new mysql();

$query = "
			SELECT	pc.cd_no ,
						df.data_folder_name
			FROM	product_cd as pc ,
						data_folder as df
			WHERE	pc.data_folder_no = df.data_folder_no
			AND		pc.cd_order_no = '$cd_order_no'
			AND		pc.use_status = 'Yes'
";
$db->query( $query );
$db->fetch();
$rs_cd_no = $db->result( 'cd_no' );
$rs_data_folder_name = $db->result( 'data_folder_name' );

$query = "
				DELETE FROM product_cd_zip WHERE cd_no = '$rs_cd_no'
";
$db->query( $query );

$full_cd_folder =  $SERVER_CONFIG[ 'storage_location' ] . "/{$rs_data_folder_name}/{$cd_order_no}";

$dir = dir( $full_cd_folder );
$dir->rewind();

$count = 0;

$file_count = 0;
while( $filename = $dir->read() )
{
	if( '.' != $filename AND '..' != $filename )
	{
		$extention = explode( ".", $filename );
		if( count( $extention ) > 1 )
		{
			if ( strtolower( $extention[1] ) == 'zip' )
			{
				$filelist[] = $filename;
				$file_count++;
			}
		}
	}
} // end of while

sort( $filelist );

$query = "DELETE FROM product_cd_zip WHERE cd_no = '$rs_cd_no'";
$db->query( $query );

for( $loop=0; $loop<$file_count; $loop++ )
{

	$zip_file = $filelist[ $loop ];
	$zip_title = $cd_zip_title[ $loop ];

	$query = "
					INSERT INTO product_cd_zip VALUES (	NULL ,
																				'$rs_cd_no' ,
																				'$zip_title' ,
																				'$zip_file' )
	";
	$db->query( $query );

}

?>
<script language=javascript>
	window.open( 'zip_register_step1.php?cd_order_no=<?=$cd_order_no?>', '_self' );
</script>
