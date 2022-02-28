<?

require_once "../../../include/include.php";
html_cache_disable();

$data_folder_no			= request( 'data_folder_no' , 'get' );
$cd_folder					= request( 'cd_folder' , 'get' );
$pricelist_no				= request( 'pricelist_no' , 'get' );

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

?>
<?

$full_cd_folder =  $SERVER_CONFIG[ 'storage_location' ] . "/{$rs_data_folder_name}/{$cd_folder}";
if( !is_dir( $full_cd_folder ) )
{
	js_code( "alert( '[ " . $full_cd_folder . " ] 폴더가 존재하지 않습니다.' ); history.back(); " );
	exit;
}


$dir = dir( $full_cd_folder );
$dir->rewind();

$count = 0;

$file_count = 0;
// 확장자가 JPG 나 jpeg일 경우 $filelist에 담음
while( $filename = $dir->read() )
{
	if( '.' != $filename AND '..' != $filename )
	{
		$extention = explode( ".", $filename );
		if( count( $extention ) > 1 )
		{
			if ( strtolower( $extention[1] ) == 'jpg' OR strtolower( $extention[1] ) == 'jpeg')
			{
				$filelist[] = $filename;	
				$file_count++;
			}
		}
	}
} // end of while

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

<form name=Form action=cd2single_step3.php method=get>
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
<?

$cd_upload_directory = $SERVER_CONFIG[ 'storage_location' ] . "/" . $cd_dirname;

$exist_flag = TRUE;
if( is_dir( $cd_upload_directory ) )
{

	chdir( $cd_upload_directory );

	$dir = dir( "." );
	$dir->rewind();

	$dirlist = '';
	$c = 0;
	while( $dirname = $dir->read() )
	{
		if( '.' != $dirname AND '..' != $dirname )
		{
			if( is_dir( $dirname ) )
			{
				$dirlist[] = $dirname;
				$c++;
			}
		}
	}

	if( $c >= 1 ) 
	{

		usort( $dirlist );

		for( $i=0; $i<count( $dirlist ); $i++ )
		{
			
			$dirname = $dirlist[ $i ];
			$dir = dir( $cd_upload_directory . "/" . $dirname );
			$dir->rewind();

			$file_count = 0;
			while( $filename = $dir->read() )
			{
				if( '.' != $filename AND '..' != $filename )
				{
					$extention = explode( ".", $filename );
					if( count( $extention ) > 1 )
					{
						if ( strtolower( $extention[1] ) == 'jpg' OR strtolower( $extention[1] ) == 'jpeg'  OR strtolower( $extention[1] ) == 'eps' OR strtolower( $extention[1] ) == 'zip' OR strtolower( $extention[1] ) == 'psd' OR strtolower( $extention[1] ) == 'bmp'  OR strtolower( $extention[1] ) == 'ai' ) $file_count++;
					}
				}
			} // end of while

			echo "<tr><td><input type=checkbox name=folder[] value='$dirname' checked></td><td><font face=verdana style='font-size:8pt'>[ " . $dirname . " ]</font></td><td>&nbsp;: " . $file_count . "개의 파일이 있습니다.</td></tr>";
			

		}

	}
	else
	{

			echo "업로드된 폴더가 없습니다.";
			$exist_flag = FALSE;

	}

}
else
{

	echo "<font color=#FF9966>해당하는 시디폴더가 없습니다.</font>";
	$exist_flag = FALSE;

}

?>
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
	<input type=submit value="  다음  " style="font-size:9pt">
	<input type=hidden name=data_folder_no value="<?=$data_folder_no?>">
	<input type=hidden name=cd_folder value="<?=$cd_folder?>">
	<input type=hidden name=pricelist_no value="<?=$pricelist_no?>">
	<input type=hidden name=license_code value="<?=$license_code?>">

	<? endif ?>
	<input type=button value="돌아가기" onClick="window.history.back()">
	</td>
</tr>
</table>

</form>



