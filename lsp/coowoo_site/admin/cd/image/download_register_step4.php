<?

require_once "../../../include/include.php";
html_cache_disable();

$cd_order_no		= request( 'cd_order_no', 'get' );
$data_folder		= request( 'data_folder', 'get' );
$download_folder	= request( 'download_folder', 'get' );

$db = new MYSQL();
$db2 = new MYSQL();

$query = "
			DELETE	product_cd_images
			FROM	product_cd_images as pci ,
					product_images as pi
			WHERE	pci.image_no = pi.image_no
			AND		pi.cd_order_no = '$cd_order_no'
";
$db->query( $query );

$query = "
			SELECT	image_no ,
					image_name
			FROM	product_images
			WHERE	cd_order_no = '$cd_order_no'
			ORDER BY image_name ASC
";
$db->query( $query );

$dir = dir( $SERVER_CONFIG[ 'storage_location' ] . "/{$data_folder}/{$cd_order_no}/{$download_folder}" );
$dir->rewind();

$ext_array = array( 'jpg' , 'jpeg' , 'eps' , 'psd' , 'tif' , 'zip' );

$file_count = 0;
while( $filename = $dir->read() )
{
	if( '.' != $filename AND '..' != $filename )
	{
		$extention = explode( ".", $filename );
		if( in_array( strtolower( $extention[1] ) , $ext_array ) )
		{
			$filelist[] = $filename;	
			$file_count++;
		}
	}
} // end of while

sort( $filelist );

$download = count($filelist);

for( $loop=0; $loop<$db->total_record(); $loop++ )
{

	$db->fetch();
	$image_no	= $db->result( 'image_no' );
	$image_name	= $db->result( 'image_name' );

	$download_filename = $filelist[$loop];

	$query = "
				INSERT INTO product_cd_images VALUES (	NULL ,
														'$image_no' ,
														'$download_folder' ,
														'$download_filename' ,
														now() )
	";
	$db2->query( $query );

}



$query = "
		UPDATE coowoo.product_cd SET	download	= $download
							WHERE cd_order_no = '$cd_order_no'
";
$db2->query( $query );


?>
<script language=javascript>
	alert( '<?=$db->total_record()?>개의 다운로드 이미지를 등록하였습니다.' );
	window.open( 'download_register_step1.php?cd_order_no=<?=$cd_order_no?>', '_self' );
</script>