<?

require_once "../../../include/include.php";
html_cache_disable();

set_time_limit(0);

$data_folder_no			= request( 'data_folder_no' , 'get' );
$cd_folder					= request( 'cd_folder' , 'get' );
$pricelist_no				= request( 'pricelist_no' , 'get' );
$folder						= request( 'folder' , 'get' );

$license_code			= request( 'license_code', 'get');

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

$cd_dirname = "{$rs_data_folder_name}/{$cd_folder}";

// 가격 리스트

$query = "
				SELECT	ext ,
							folder_size ,
							pixel_size ,
							folder_price
				FROM	single_pricelist_folder
				WHERE	pricelist_no = $pricelist_no
				ORDER BY pixel_size ASC
";
$db->query( $query );
for( $loop=0; $loop<$db->total_record(); $loop++ )
{
	$db->fetch();

	$ext_array[] = $db->result( 'ext' );
	$folder_size_array[] = $db->result( 'folder_size' );
	$pixel_size_array[] = $db->result( 'pixel_size' );
	$folder_price_array[] = $db->result( 'folder_price' );

}

$full_cd_folder =  $SERVER_CONFIG[ 'storage_location' ] . "/{$rs_data_folder_name}/{$cd_folder}";
if( FALSE == is_dir( $full_cd_folder ) )
{
	js_code( "alert( '[ " . $full_cd_folder . " ] 폴더가 존재하지 않습니다.' ); history.back(); " );
	exit;
}


$query = "
			SELECT	image_no ,
						single_order_no ,
						image_name
			FROM	product_images
			WHERE	cd_order_no = '$cd_folder'
			ORDER BY image_name ASC
";
$db->query( $query );
for( $loop=0; $loop<$db->total_record(); $loop++ )
{
	$db->fetch();

	$rs_image_no = $db->result( 'image_no' );
	$rs_single_order_no = $db->result( 'single_order_no' );
	$rs_image_name = $db->result( 'image_name' );

	$image_no[] = $rs_image_no;
	$image_name[] = $rs_image_name;
	$single_order_no[] = $rs_single_order_no;
}

?>
<html>
<head>
<title><?$HTML->Title( 'Admin' )?></title>
<?=$HTML->Metatag()?>
<link rel="stylesheet" href="../../admin_style.css" type="text/css">

</head>
<body>
<b><font size=3>* CD → 싱글 등록 - 확인</font></b><br><br>
<font style="font-family:verdana; font-size:8pt">
- 사용할 폴더를 정확히 선택하시고 다음 버튼을 누르세요.<br><br>
</font>

<form name=Form action=cd2single_step4.php method=get>

<table border=0 cellpadding=0 cellspacing=3 border=0 bgcolor="#CDCD9A">
<tr>
	<td>
	<table border=0 cellpadding=0 cellspacing=5 border=0 bgcolor="#FFFFFF">
	<tr>
		<td align=center>
		<table border=0 cellpadding=3 cellspacing=0>
		<tr>
			<td width=100 height=24 align=center>
			스토리지 
			</td>
			<td align=center width=30>
			:
			</td>
			<td width=340>
			/storage/<?=$rs_data_folder_name?>
			<input type=hidden name=data_folder_no value="<?=$data_folder_no?>">
			</td>
		</tr>
		<tr>
			<td colspan=3 height=1 background="../../image/dot.gif">
			</td>
		</tr>
		<tr>
			<td height=24 align=center>
			시디폴더 
			</td>
			<td align=center>
			:
			</td>
			<td>
			<?=$cd_folder?>
			<input type=hidden name=cd_folder value="<?=$cd_folder?>">
			</td>
		</tr>
		<tr>
			<td colspan=3 height=1 background="../../image/dot.gif">
			</td>
		</tr>
		<tr>
			<td height=24 align=center>
			가격표 이름 
			</td>
			<td align=center>
			:
			</td>
			<td>
<?

$query = "
			SELECT	pricelist_name
			FROM	single_pricelist_name
			WHERE	pricelist_no = '$pricelist_no'
";
$db->query( $query );
$db->fetch();
$rs_pricelist_name = $db->result( 'pricelist_name' );

?>
			<?=$rs_pricelist_name?>
			<input type=hidden name=pricelist_no value="<?=$pricelist_no?>">
			</td>
		</tr>
		<tr>
			<td colspan=3 height=1 background="../../image/dot.gif">
			</td>
		</tr>
		<tr>
			<td height=24 align=center>
			사용할 폴더 
			</td>
			<td align=center>
			:
			</td>

			<td>
			<table width=100% border=0 cellpadding=0 cellspacing=0>
			<tr>
			<td>
			<? for( $i=0; $i<count( $folder ); $i++ ) : ?>
			<?=$folder[$i] . "<br>"?>
			<? endfor ?>
			</td>
			</tr>
			</table>

			</td>
		</tr>
		</table>
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>

<table width=480 border=0 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td align=center height=50>
	<input type=submit value="  다음  " style="font-size:9pt">
	<input type=hidden name=data_folder_no value="<?=$data_folder_no?>">
	<input type=hidden name=cd_folder value="<?=$cd_folder?>">
	<input type=hidden name=pricelist_no value="<?=$pricelist_no?>">
	<input type=hidden name=license_code value="<?=$license_code?>">
<? for( $loop=0; $loop<count( $folder ); $loop++ ) : ?>
	<input type=hidden name=folder[] value="<?=$folder[$loop]?>">
<? endfor ?>
	<input type=button value="돌아가기" onClick="window.history.back()">
	</td>
</tr>
</table>


<table border=0 cellpadding=0 cellspacing=1 bgcolor=#CDCD9A>
<tr height=20>
	<td align=center width=120>
	<font color=#666666><b>주문번호</b></font>
	</td>
	<td align=center width=140>
	<font color=#666666><b>기준파일</b></font>
	</td>
	<td align=center width=140>
	<font color=#666666><b>파일이름</b></font>
	</td>
	<td align=center width=100>
	<font color=#666666><b>픽셀 가로</b></font>
	</td>
	<td align=center width=100>
	<font color=#666666><b>픽셀 세로</b></font>
	</td>
	<td align=center width=100>
	<font color=#666666><b>픽셀수</b></font>
	</td>
	<td align=center width=100>
	<font color=#666666><b>MODE / MB</b></font>
	</td>
	<td align=center width=100>
	<font color=#666666><b>가격</b></font>
	</td>
</tr>

<? for( $loop=0; $loop<count( $folder ); $loop++ ) : ?>
<?


$dir_fullname = $SERVER_CONFIG[ 'storage_location' ] . "/{$rs_data_folder_name}/{$cd_folder}/" . $folder[$loop];

$dir = dir( $dir_fullname );
$dir->rewind();

$filelist = '';
$file_count = 0;
while( $filename = $dir->read() )
{
	if( '.' != $filename AND '..' != $filename )
	{
		$extention = explode( ".", $filename );

		for( $loop2=0; $loop2<count( $ext_array ); $loop2++ )
		{

			if( strtolower( $extention[1] ) == strtolower( $ext_array[$loop2] ) )
			{
				$filelist[] = $filename;	
				$file_count++;
				break;
			}

		}
	}
} // end of while

sort( $filelist );

?>
	<tr bgcolor=#FFFFFF>
	<td colspan=8 align=center height=18>
	<?=$dir_fullname?> ( <?=count( $filelist )?> files )
	</td>
	</tr>
<? for( $loop2=0; $loop2<count( $filelist ); $loop2++ ) : ?>
<?

	$extention = explode( ".", $filelist[ $loop2 ] );

	$pixel_size = $width_size = $height_size = 0;
	$channels = $mega_size = 0;
	if( 'jpg' == strtolower( $extention[1] ) OR strtolower( 'jpeg' == $extention[1] ) OR strtolower( 'psd' == $extention[1] ) OR strtolower( 'bmp' == $extention[1] ) )
	{

		$image_size = getimagesize( $dir_fullname . "/" . $filelist[ $loop2 ] );
		$width_size = $image_size[0];
		$height_size = $image_size[1];

		if( 4 == $image_size['channels'] )
		{
			$channels = 'CMYK';
		}
		elseif( 3 == $image_size['channels'] )
		{
			$channels = 'RGB';
		}
		else
		{
			$channels = 'RGB';
			$image_size['channels'] = 3;
		}

	}

	$pixel_size = $width_size * $height_size;
	$mega_size = $pixel_size * $image_size['channels'] / 1024 / 1024;
	if( $mega_size > 0 ) $mega_size = sprintf( '%.1f M' , $mega_size );



	for( $loop3=0; $loop3<count( $pixel_size_array ); $loop3++ )
	{

		$extention = explode( ".", $filelist[ $loop2 ] );
		if( 'jpg' != strtolower( $extention[1] ) )
		{
			if( strtolower( $extention[1] ) == strtolower( $ext_array[$loop3] ) )
			{
				$price_pos = $loop3;
				break;
			}
		}
		elseif( $pixel_size <= $pixel_size_array[ $loop3 ] )
		{
			$price_pos = $loop3; 
			break;
		}

	}

	if( $price_pos < 0 ) $price_pos = 0;

?>
	<tr bgcolor=#FFFFFF>
		<td align=center>
		<?=$single_order_no[ $loop2 ]?>
		</td>
		<td align=center>
		<?=$image_name[ $loop2 ]?>
		</td>
		<td align=center>
		<?=$filelist[ $loop2 ]?>
		</td>
		<td align=center>
		<?=$width_size?>
		</td>
		<td align=center>
		<?=$height_size?>
		</td>
		<td align=center>
		<?=$pixel_size?>
		</td>
		<td align=center>
		<?=$channels?> / <?=$mega_size?>
		</td>
		<td align=center>
		<?=number_format( $folder_price_array[ $price_pos ] ) ?> 원
		</td>
	</tr>
<? endfor ?>

<? endfor ?>
</table>

</form>
