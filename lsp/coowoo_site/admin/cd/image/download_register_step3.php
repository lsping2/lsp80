<?

require_once "../../../include/include.php";
html_cache_disable();

$cd_order_no		= request( 'cd_order_no', 'get' );
$data_folder		= request( 'data_folder', 'get' );
$download_folder	= request( 'download_folder', 'get' );

$db = new mysql();

?>
<html>
<head>
<title><?$HTML->Title( 'Admin' )?></title>
<?=$HTML->Metatag()?>
<link rel="stylesheet" href="../../admin_style.css" type="text/css">
<script language=javascript>
<!--

	function digit(c)
	{
		return ((c >= "0") && (c <= "9"));
	}

	function digitCheck( data, input_pos )
	{	
		for( i=0; i<data.length; i++)
		{
			var ch = data.charAt( i );
			if( false == digit( ch ) )
			{ 
				alert("숫자로만 입력해 주세요.");
				input_pos.focus();
				input_pos.select();
				return false;
			}
		}
		return true;
	}

	function empty( data )
	{
		if( !data ) return true;

		for( i=0; i<data.length; i++ )
		{
			if( data.substring( i, i+1 ) != ' ' )
				return false;
		}
		return true;
	}

-->
</script>
</head>
<body>
<b><font size=3>* 시디 다운로드폴더 등록 :</font></b><br><br>
<form name=Form action="download_register_step4.php" method=get>
<table border=0 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td>
	<table width=400 height=50 border=0 cellpadding=0 cellspacing=5 border=0 bgcolor="#FFFFFF">
	<tr>
		<td align=center>
		<input type=submit value="    확인    ">
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=1 bgcolor=#EFEFEF>
<tr height=20>
	<td align=center width=200>
	<font color=#666666><b>섬네일 파일이름</b></font>
	</td>
	<td align=center width=200>
	<font color=#666666><b>다운로드 파일이름</b></font>
	</td>
</tr>
<?

$query = "
			SELECT	image_no ,
						single_order_no ,
						image_name
			FROM	product_images
			WHERE	cd_order_no = '$cd_order_no'
			ORDER BY single_order_no ASC
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
		if ( in_array( strtolower( $extention[1] ) , $ext_array ) )
		{
			$filelist[] = $filename;	
			$file_count++;
		}
	}
} // end of while

sort( $filelist );

?>
<? for( $loop=0; $loop<$db->total_record(); $loop++ ) : ?>
<?

$db->fetch();
$image_name = $db->result( 'image_name' );

?>
<tr>
	<td height=18 align=center bgcolor=#FFFFFF>
	<?=$image_name?>
	</td>
	<td align=center bgcolor=#FFFFFF>
	<?=$filelist[$loop]?>
	</td>
</tr>
<? endfor ?>
</table>
<table border=0 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td>
	<table width=400 height=50 border=0 cellpadding=0 cellspacing=5 border=0 bgcolor="#FFFFFF">
	<tr>
		<td align=center>
		<input type=submit value="    확인    ">
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
<input type=hidden name=cd_order_no value="<?=strtoupper( $cd_order_no )?>">
<input type=hidden name=data_folder value="<?=$data_folder?>">
<input type=hidden name=download_folder value="<?=$download_folder?>">
</form>
</body>
</html>
