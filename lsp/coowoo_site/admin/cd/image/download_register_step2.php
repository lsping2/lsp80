<?

require_once "../../../include/include.php";
html_cache_disable();

$cd_order_no = strtoupper( trim( request( 'cd_order_no', 'get' ) ) );

$db = new mysql();

$query = "
			SELECT	df.data_folder_name
			FROM	product_cd as pc ,
					data_folder as df
			WHERE	pc.data_folder_no = df.data_folder_no
			AND		cd_order_no = '$cd_order_no'
";
$db->query( $query );
if( !$db->total_record() )
{

	js_msg( "등록된 시디가 아닙니다. 시디 등록작업을 먼저 하세요." );
	js_back();
	exit;

}

$db->fetch();
$rs_data_folder_name = $db->result( 'data_folder_name' );

$query = "
			SELECT	count(*)
			FROM	product_images
			WHERE	cd_order_no = '$cd_order_no'
";
$db->query( $query );
if( !$db->is_count() )
{

	js_msg( "등록된 섬네일 이미지가 없습니다. 섬네일 등록 작업을 먼저 하세요." );
	js_back();
	exit;

}

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
<b><font size=3>* 시디 다운로드폴더 등록 : 섬네일 검사</font></b><br><br>
<form name=Form action="download_register_step3.php" method=get>
<table border=0 cellpadding=0 cellspacing=3 border=0 bgcolor="#CDCD9A">
<tr>
	<td>
	<table width=500 height=100 border=0 cellpadding=0 cellspacing=5 border=0 bgcolor="#FFFFFF">
	<tr>
		<td align=center>
		[ <?=$cd_order_no?> ] 시디에 등록된 섬네일 갯수는 <font color=#FF9966><?=$db->is_count()?>개</font> 입니다.
		<br>등록된 섬네일 갯수는 다운로드폴더의 파일 갯수 및 정렬순서가 동일해야 합니다.
		<br>
		<table align=center border=0 cellpadding=0 cellspacing=0 border=0 bgcolor="#FFFFFF">
<?

$cd_upload_directory = $SERVER_CONFIG[ 'storage_location' ] . "/{$rs_data_folder_name}/{$cd_order_no}";
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

} // end of while

$ext_array = array( 'jpg' , 'jpeg' , 'eps' , 'psd' , 'tif' , 'zip' );

if( $c >= 1 ) 
{

	echo "<tr><td align=center height=50>다운로드 폴더를 선택해 주세요.</td></tr>";

	usort( $dirlist );

	for( $i=0; $i<count( $dirlist ); $i++ )
	{
		
		$dirname = $dirlist[ $i ];
		$dir = dir( $cd_upload_directory . "/" . $dirname );
		$dir->rewind();

		$count = 0;
		while( $filename = $dir->read() )
		{
			$extention = explode( ".", $filename );
			if( in_array( strtolower( $extention[1] ) , $ext_array ) )
			{
				$count++;
			}
		} // end of while

		echo "<tr><td><input type=radio name=download_folder value='$dirname' checked>&nbsp;<font face=verdana style='font-size:8pt'>{$rs_data_folder_name}/{$cd_order_no}/" . $dirname . " : " . $count .  "개의 파일이 등록되어있습니다.</font></td></tr>";
		

	}

}
else
{

		echo "<tr><td>등록된 폴더가 없습니다.</td></tr>";

}

?>
		</table>
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td>
	<table width=500 border=0 cellpadding=0 cellspacing=5 border=0 bgcolor="#FFFFFF">
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
<input type=hidden name=data_folder value="<?=$rs_data_folder_name?>">
</form>
</body>
</html>
