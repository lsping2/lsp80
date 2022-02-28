<?

require_once "../../../include/include.php";

set_time_limit(0);

html_cache_disable();

$db = new mysql();

$thumnail_folder        = "thumbs";
$data_folder_no		= 105;
$rs_data_folder_name    = "ZEFA";


$fp = fopen( "zefa.txt", "r" );
while( !feof( $fp ) )
{
        $temp = fgets( $fp, 4096 );
        $temp = str_replace( "\n", "", $temp );
        $temp = str_replace( "\r", "", $temp );

        if( $temp ) $list[] = $temp;
}

FOR( $main_loop=0; $main_loop < count( $list ); $main_loop++ )
{

        $cd_folder      = $list[$main_loop];


flush();


$full_name = $SERVER_CONFIG[ 'storage_location' ] . "/{$rs_data_folder_name}/{$cd_folder}/{$thumnail_folder}";

$dir = dir( $full_name );
$dir->rewind();

$filelist = '';

while( $filename = $dir->read() )
{
	if( '.' != $filename AND '..' != $filename )
	{
		$extention = explode( ".", $filename );
		if( count( $extention ) > 1 )
		{
			if ( strtolower( $extention[1] ) == 'jpg' OR strtolower( $extention[1] ) == 'jpeg' ) $filelist[] = $filename;
		}
	}
} // end of while

sort( $filelist );

$data_folder_name = $SERVER_CONFIG[ 'thumbnail_location' ] . "/{$rs_data_folder_name}";
if( !is_dir( $data_folder_name ) ) mkdir( $data_folder_name );

$cd_folder_name = $data_folder_name . "/{$cd_folder}";
if( !is_dir( $cd_folder_name ) ) mkdir( $cd_folder_name );

if( !is_dir( $cd_folder_name . "/80" ) )	mkdir( $cd_folder_name . "/80" );  // 디렉토리가 없으면 생성
if( !is_dir( $cd_folder_name . "/120" ) )	mkdir( $cd_folder_name . "/120" );
if( !is_dir( $cd_folder_name . "/500" ) )	mkdir( $cd_folder_name . "/500" );

if( count( $filelist ) > 0 )
{

	// 관련된 DB삭제 (cd_image, keyindex)


	$query = "	DELETE	product_cd_images	FROM	product_images as pi ,
													product_cd_images as pci
											WHERE	pi.image_no = pci.image_no
											AND		pi.cd_order_no = '$cd_folder'
	";
	$db->query( $query );

	$query = "
				DELETE	keyindex_info	FROM	product_images as pi ,
												keyindex_info as ki
										WHERE	pi.image_no = ki.image_no
										AND		pi.cd_order_no = '$cd_folder'

	";
	$db->query( $query );

	$query = "
				DELETE	keyindex_info2	FROM	product_images as pi ,
												keyindex_info2 as ki2
										WHERE	pi.image_no = ki2.image_no
										AND		pi.cd_order_no = '$cd_folder'
	";
	$db->query( $query );

	$query = "DELETE FROM product_single WHERE single_order_no LIKE '{$cd_folder}%'";
	$db->query( $query );

	$query = "DELETE FROM product_images WHERE cd_order_no = '$cd_folder'";
	$db->query( $query );



}


$query = "
			SELECT	manufacture_code ,
					cd_sell_status ,
					vcd_sell_status
			FROM	product_cd
			WHERE	cd_order_no = '$cd_folder'
";
$db->query( $query );
$rs_manufacture_code = $rs_cd_sell_status = $rs_vcd_sell_status = '';
if( $db->total_record() )
{

	$db->fetch();
	$rs_manufacture_code = $db->result( 'manufacture_code' );
	$rs_cd_sell_status = $db->result( 'cd_sell_status' );
	$rs_vcd_sell_status = $db->result( 'vcd_sell_status' );

}

// 현재 이미지 고유번호 값
$query = "
				SELECT	MAX( image_no ) as max_image_no
				FROM	product_images
";
$db->query( $query );
$db->fetch();
$max_image_no = (int)$db->result( 'max_image_no' );
$max_image_no += 1;

for( $i=0; $i<count( $filelist ); $i++ )   // 파일의 갯수만큼 
{
	
	flush();

	$filename = $filelist[ $i ];
	$src_image = $full_name . "/" . $filename;

	$size = getimagesize( $src_image );
	if( 4 == $size["channels"] )
	{
		$src_image = cmyk2rgb( $src_image );
	}

	if( $size[0] <= 500 AND $size[1] <= 500 )
	{
		copy( $src_image , $cd_folder_name . "/500/" . $filename );
	}
	else
	{
		img_resize( $src_image , $cd_folder_name . "/500/" . $filename , 'auto', 500 , 'Yes' );
	}

	if( $size[0] <= 120 AND $size[1] <= 120 )
	{
		copy( $cd_folder_name . "/500/" . $filename , $cd_folder_name . "/120/" . $filename );
	}
	else
	{
		img_resize( $cd_folder_name . "/500/" . $filename 	, $cd_folder_name . "/120/" . $filename , 'auto', 120 , 'No' );
	}

	img_resize( $cd_folder_name	. "/120/" . $filename	, $cd_folder_name . "/80/"	. $filename , 'auto', 80 , 'No' );

	// 싱글 주문번호
	// $single_order_no = substr( $cd_folder, 0, 1 ) . "S" . substr( $cd_folder , 1 ) . sprintf( "%03d" , $i+1 );
	$single_order_no = substr( $cd_folder, 0, 1 ) .  substr( $cd_folder , 1 ) . sprintf( "%03d" , $i+1 );

    $size = getimagesize( $full_name . "/" . $filename );
    $cal = $size[0] - $size[1];

    if( $cal > 50 )
    {
        $image_shape = 'vertical';
    }
    elseif( $cal < -50 )
    {
        $image_shape = 'horizon';
    }
    else
    {
        $image_shape = 'square';
    }

	$query = "SELECT image_no FROM product_images WHERE single_order_no = '$single_order_no'";
	$db->query( $query );
	$db->fetch();

	$rs_image_no = $db->result( 'image_no' );
	
	if( $rs_image_no )
	{

		$query = "
						UPDATE	 product_images	SET		data_folder_no = '$data_folder_no' ,
														image_name = '$filename' ,
														image_class = '' ,
														image_shape = '$image_shape' ,
														manufacture_code = '$rs_manufacture_code' ,
														cd_sell_status = '$rs_cd_sell_status' ,
														vcd_sell_status = '$rs_vcd_sell_status'
												WHERE	image_no = '$rs_image_no'
		";
		$db->query( $query );
	}
	else
	{
		$query = "
						INSERT INTO	product_images	(	image_no ,
														product_class ,
														cd_order_no ,
														single_order_no ,
														data_folder_no ,
														image_name ,
														image_class ,
														image_shape ,
														manufacture_code ,
														cd_sell_status ,
														vcd_sell_status ,
														single_sell_status ,
														reg_date 
													)
													VALUES	
													(	'$max_image_no' ,
														'cd' ,
														'$cd_folder' ,
														'$single_order_no' ,
														'$data_folder_no' ,
														'$filename' ,
														'real' ,
														'$image_shape' ,
														'$rs_manufacture_code' ,
														'$rs_cd_sell_status' ,
														'$rs_vcd_sell_status' ,
														'No' ,
														now() 
													)
		";
		$db->query( $query );
		$max_image_no++;
	}
	if( ( $i ) % 5 == 0 ) echo "<table border=0 cellpadding=0 cellspacing=1 bgcolor=#EFEFEF><tr>";

	echo "<td height=130 width=130 align=center valign=middle bgcolor=#FFFFFF>
			<table border=0 cellpadding=0 cellspacing=0 height=100% width=100%>
			<tr>
				<td align=center valign=middle height=10 bgcolor=#EFEFEF><font style='font-family:verdana;font-size:7pt'>{$single_order_no}</font></td>
			</tr>
			<tr>
			<td align=center valign=bottom style='padding: 2 2 2 2'><img src='/thumbnail/{$rs_data_folder_name}/{$cd_folder}/120/{$filename}' border=0 onClick=\"javascript:viewPic( 'data_folder={$rs_data_folder_name}&sub_folder={$cd_folder}&size=500&image_name={$filename}' )\" style='cursor:hand'></a><br><font style='font-family:verdana;font-size:7pt' color=#FF9966>{$filename}</font>
			<br>{$image_shape}	
			</td>
			</tr>
			</table>
		</td>
		";
	if( ( $i + 1 ) % 5 == 0 ) echo "<tr></table><script>self.scrollTo(0,100000000000);</script>";


}

$query = "
		UPDATE coowoo.product_cd SET reg_date_thumbnail = now() WHERE cd_order_no = '$cd_folder'
";
$db->query( $query );



} // END $main_loop


?>
