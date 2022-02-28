<?

require_once "../../../include/include.php";

html_cache_disable();

$data_folder_no		= request( 'data_folder_no' , 'get' );
$cd_folder				= request( 'cd_folder' , 'get' );
$thumnail_folder	= request( 'thumnail_folder' , 'get' );

set_time_limit(0);

$db = new MYSQL;
$db2 = new MYSQL;

$query = "
			SELECT	data_folder_name
			FROM	data_folder
			WHERE	data_folder_no = '$data_folder_no' 
";
$db->query( $query );
$db->fetch();
$rs_data_folder_name = $db->result( 'data_folder_name' );

?>
<html>
<head>
<title><?$HTML->Title( 'Admin' )?></title>
<?=$HTML->Metatag()?>
<link rel="stylesheet" href="../../admin_style.css" type="text/css">
<script language=javascript>
<!--

	function viewPic( src )
	{

		window.open( '../../image.php?' + src, '_viewpic', 'width=530, height=530' );

	}

-->
</script>
</head>
<body>
<b><font size=3>* CD 섬네일 재등록</font></b><br><br>
<font style="font-family:verdana; font-size:8pt">
- [ storage/<?=$rs_data_folder_name?>/<?=$cd_folder?>/<?=$thumnail_folder?>] 폴더에서 섬네일을 등록중입니다.<br>
- 작업이 끝나면 섬네일 이미지가 출력됩니다. 문제가 발생하여 작업을 다시 시작하시려면 '돌아가기' 버튼을 눌러주세요.<br><br>
</font>



<table width=600 border=0 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td align=center height=50>
	<a href="thumnail_reg_step1.php?data_folder_no=<?=$data_folder_no?>&cd_order_no=<?=$cd_folder?>" onFocus='this.blur()'>[   등록완료   ]</a>
	<a href="javascript:window.history.back()" onFocus='this.blur()'>[   돌아가기   ]</a>
	</td>
</tr>
</table>
<?

flush();

?>

<?

$full_name = $SERVER_CONFIG[ 'storage_location' ] . "/{$rs_data_folder_name}/{$cd_folder}/{$thumnail_folder}";

$dir = dir( $full_name );
$dir->rewind();

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

if( !is_dir( $cd_folder_name . "/80" ) )		mkdir( $cd_folder_name . "/80" );
if( !is_dir( $cd_folder_name . "/120" ) )	mkdir( $cd_folder_name . "/120" );
if( !is_dir( $cd_folder_name . "/500" ) )	mkdir( $cd_folder_name . "/500" );


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

for( $i=0; $i<count( $filelist ); $i++ )
{
	$single_order_no = substr( $cd_folder, 0, 1 ) .  substr( $cd_folder , 1 ) . sprintf( "%03d" , $i+1 );

	flush();

	$filename = $filelist[ $i ];

	$src_image = $full_name . "/" . $filename;
	$dst_filename = $filename;

	// 임시쿼리

	$query = "
		SELECT	image_name
		FROM	product_images
		WHERE	single_order_no = '$single_order_no'
	";
	$db2->query( $query );
	$db2->fetch();

	$rs_image_name = $db2->result( 'image_name' );
	if( $rs_image_name ) $dst_filename = $rs_image_name;

	$size = getimagesize( $src_image );
	if( 4 == $size["channels"] )
	{
		$src_image = cmyk2rgb( $src_image );
	}

	if( $size[0] <= 500 AND $size[1] <= 500 )
	{
		copy( $src_image , $cd_folder_name . "/500/" . $dst_filename );
	}
	else
	{
		img_resize( $src_image , $cd_folder_name . "/500/" . $dst_filename , 'auto', 500 , 'Yes' );
	}

	if( $size[0] <= 120 AND $size[1] <= 120 )
	{
		copy( $cd_folder_name	. "/500/" . $dst_filename , $cd_folder_name . "/120/" . $dst_filename );
	}
	else
	{
		img_resize( $cd_folder_name	. "/500/" . $dst_filename	, $cd_folder_name . "/120/" . $dst_filename , 'auto', 120 , 'No' );
	}

	img_resize( $cd_folder_name	. "/120/" . $dst_filename	, $cd_folder_name . "/80/"	. $dst_filename , 'auto', 80 , 'No' );


	if( ( $i ) % 5 == 0 ) echo "<table border=0 cellpadding=0 cellspacing=1 bgcolor=#EFEFEF><tr>";
	echo "<td height=130 width=130 align=center valign=middle bgcolor=#FFFFFF>
			<table border=0 cellpadding=0 cellspacing=0 height=100% width=100%>
			<tr>
				<td align=center valign=middle height=10 bgcolor=#EFEFEF><font style='font-family:verdana;font-size:7pt'>{$single_order_no}</font></td>
			</tr>
			<tr>
			<td align=center valign=bottom><img src='/thumbnail/{$rs_data_folder_name}/{$cd_folder}/120/{$dst_filename}' border=0 onClick=\"javascript:viewPic( 'data_folder={$rs_data_folder_name}&sub_folder={$cd_folder}&size=500&image_name={$dst_filename}' )\"><br><font style='font-family:verdana;font-size:7pt' color=#FF9966>{$dst_filename}</font>
			<br>{$image_shape}	
			</td>
			</tr>
			</table>
		</td>
		";
	if( ( $i + 1 ) % 5 == 0 ) echo "<tr></table><script>self.scrollTo(0,100000000000);</script>";

}

?>

<table width=600 border=0 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td align=center height=50>
	<a href="thumnail_reg_step1.php?data_folder_no=<?=$data_folder_no?>&cd_order_no=<?=$cd_folder?>" onFocus='this.blur()'>[   등록완료   ]</a>
	<a href="javascript:window.history.back()" onFocus='this.blur()'>[   돌아가기   ]</a>
	</td>
</tr>
</table>
<br><br>
<script>self.scrollTo(0,100000000000);</script>

