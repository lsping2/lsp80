
<?

require_once "../../../include/include.php";
html_cache_disable();

$data_folder_no			= request( 'data_folder_no' , 'get' );
$cd_folder					= request( 'cd_folder' , 'get' );
$pricelist_no				= request( 'pricelist_no' , 'get' );
$folder						= request( 'folder' , 'get' );

$license_code			= request( 'license_code', 'get');

$db = new MYSQL;
$db2 = new MYSQL;
$db3 = new MYSQL;

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
				SELECT	folder_no ,
							ext ,
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

	$folder_no_array[] = $db->result( 'folder_no' );
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

	$image_no_array[] = $rs_image_no;
	$image_name_array[] = $rs_image_name;
	$single_order_no_array[] = $rs_single_order_no;

	// 기존에 등록된 정보 삭제
	$query = "
					DELETE FROM product_single_download WHERE image_no = '$rs_image_no'
	";
	$db3->query( $query );
	$query = "
					DELETE FROM product_single WHERE image_no = '$rs_image_no'
	";
	$db3->query( $query );

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
	<? if( FALSE == $dir_error ) : ?>
	<a href="cd2single_step1.php?data_folder_no=<?=$data_folder_no?>&cd_order_no=<?=$cd_folder?>&pricelist_no=<?=$pricelist_no?>&license_code=<?=$license_code?>" onFocus='this.blur()'>[   완료   ]</a>
	<? endif ?>
	<a href="javascript:window.history.back()" onFocus='this.blur()'>[   돌아가기   ]</a>
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
	<td colspan=7 align=center height=18>
	<?=$dir_fullname?> ( <?=count( $filelist )?> files )
	</td>
	</tr>
<? for( $loop2=0; $loop2<count( $filelist ); $loop2++ ) : ?>
<?

	$extention = explode( ".", $filelist[ $loop2 ] );
	$pixel_size = $width_size = $height_size = 0;
	$channels = 'NONE';
	$bits = 0;

	if( 'jpg' == strtolower( $extention[1] ) OR strtolower( 'jpeg' == $extention[1] ) )
	{

		$image_size = getimagesize( $dir_fullname . "/" . $filelist[ $loop2 ] );
		$channels = $image_size['channels'];
		$bits = $image_size['bits'];

		if( 3 == $channels )
		{
			$channels = 'RGB';
		}
		elseif( 4 == $channels )
		{
			$channels = 'CMYK';
		}
		else
		{
			$channels = 'NONE';
		}

		$width_size = $image_size[0];
		$height_size = $image_size[1];
	}
	$pixel_size = $width_size * $height_size;

	for( $loop3=0; $loop3<count( $pixel_size_array ); $loop3++ )
	{

		if( 0 == (int)$pixel_size_array[ $loop3 ] )
		{
			$extention = explode( ".", $filelist[ $loop2 ] );
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

	$query = "
				SELECT	manufacture_code
				FROM	product_cd
				WHERE	cd_order_no = '$cd_folder'
	";
	$db3->query( $query );
	$db3->fetch();
	$rs_manufacture_code = $db3->result( 'manufacture_code' );

	$sub_folder = $folder[$loop];
	$folder_no = $folder_no_array[ $price_pos ];
	$image_no = $image_no_array[ $loop2 ];
	$single_order_no = $single_order_no_array[ $loop2 ];
	$filename = $filelist[ $loop2 ];

	$query = " DELETE FROM product_single WHERE single_order_no = '$single_order_no'";
	$db3->query( $query );



	$query = "
				UPDATE product_images	SET		single_sell_status = 'Yes'
									WHERE	image_no = '$image_no'
	";
	$db3->query( $query );

	$query = "
					INSERT INTO product_single VALUES	(	NULL ,
														'$single_order_no' ,
														'$image_no' ,
														'$data_folder_no' ,
														'$rs_manufacture_code' ,
														'$pricelist_no' ,
														'$license_code' 
													)
	";
	// echo "<font face=verdana style='font-size:7pt'>$query</font><br>";
	$db3->query( $query );


	$query = "
						INSERT INTO product_single_download				(	single_download_no ,
															single_order_no ,
																		image_no ,
																		data_folder ,
																		sub_folder ,
																		folder_no ,
																		down_filename ,
																		size_width ,
																		size_height ,
																		channels ,
																		bits
																		)
														VALUES (	NULL ,
																'$single_order_no' ,
																		'$image_no' ,
																		'{$rs_data_folder_name}/{$cd_folder}' ,
																		'$sub_folder' ,
																		'$folder_no' ,
																		'$filename' , 
																		'$width_size' ,
																		'$height_size' ,
																		'$channels' ,
																		'$bits'
																		)
	";
	// echo "<font face=verdana style='font-size:7pt'>$query</font><br>";
	$db3->query( $query );


?>
	<tr bgcolor=#FFFFFF>
		<td align=center>
		<?=$single_order_no_array[ $loop2 ]?>
		</td>
		<td align=center>
		<?=$image_name_array[ $loop2 ]?>
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
		<?=number_format( $folder_price_array[ $price_pos ] ) ?> 원
		</td>
	</tr>
<? endfor ?>

<? endfor ?>
</table>

