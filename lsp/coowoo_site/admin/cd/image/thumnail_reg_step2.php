<?

require_once "../../../include/include.php";
html_cache_disable();

$data_folder_no	= request( 'data_folder_no' , 'get' );
$cd_folder		= request( 'cd_folder' , 'get' );  // ������������ �˻���κп��� ������

$db = new MYSQL();

$query = "
			SELECT	data_folder_name
			FROM	data_folder
			WHERE	data_folder_no = '$data_folder_no' 
";
$db->query( $query );
$db->fetch();
$rs_data_folder_name = $db->result( 'data_folder_name' );

$cd_dirname = "{$rs_data_folder_name}/{$cd_folder}";     // �����̸� / ������������ ã�� ����

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
				alert("���ڷθ� �Է��� �ּ���.");
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

	function thumnail_confirm()
	{

		form = document.Form;

		return void(0);

	}

-->
</script>
</head>
<body>
<b><font size=3>* CD ������ ����</font></b><br><br>
<font style="font-size:9pt">- CD���ۻ�� �������� ���� ������ �����Ͽ� �ּ���.</font><br>
<form name=Form action='thumnail_reg_step3.php' method=get>
<table border=0 cellpadding=0 cellspacing=3 border=0 bgcolor="#CDCD9A">
<tr>
	<td>
	<table border=0 cellpadding=0 cellspacing=5 border=0 bgcolor="#FFFFFF">
	<tr>
		<td align=center>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
			<td width=140 height=24 align=center>
			���丮�� 
			</td>
			<td align=center width=30>
			:
			</td>
			<td width=330>
			/storage/<?=$rs_data_folder_name?>
			<input type=hidden name=data_folder_no value="<?=$data_folder_no?>">
			</td>
		</tr>
		<tr>
			<td colspan=3 height=1 background="../../image/dot.gif">
			</td>
		</tr>
		<tr>
			<td width=140 height=24 align=center>
			�õ����� 
			</td>
			<td align=center width=30>
			:
			</td>
			<td width=330>
			<?=$cd_folder?>
			<input type=hidden name=cd_folder value="<?=$cd_folder?>">
			</td>
		</tr>
		<tr>
			<td colspan=3 height=1 background="../../image/dot.gif">
			</td>
		</tr>
		<tr>
			<td width=140 height=24 align=center>
			��ϵ� ������ ����
			</td>
			<td align=center width=30>
			:
			</td>
			<td width=330>
			<?
			
			$query = "
					SELECT	count(*) as thumbs_count
					FROM	product_images
					WHERE	cd_order_no = '$cd_folder'
			";
			$db->query( $query );
			$db->fetch();
			$rs_thumbs_count	= $db->result( 'thumbs_count' )

			?>
			<?=$rs_thumbs_count?> ��
			</td>
		</tr>
		<tr>
			<td colspan=3 height=1 background="../../image/dot.gif">
			</td>
		</tr>
		<tr><td colspan=3 height=10></td></tr>
		<tr>
			<td align=center>
			�������� 
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

		sort( $dirlist );  // [high] [low] [mid]  �������� ���� 

		$count_flag = FALSE;

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
						if ( strtolower( $extention[1] ) == 'jpg' OR strtolower( $extention[1] ) == 'jpeg' ) $file_count++;
					}
				}
			} // end of while

			echo "<tr><td>";
			if( $file_count == $rs_thumbs_count )
			{
				echo "<input type=radio name=thumnail_folder value='$dirname' checked>";
				$count_flag = TRUE;
			}
			else
			{
				echo "&nbsp;";
			}
			echo "</td><td><font face=verdana style='font-size:8pt'> {$cd_folder}/{$dirname}</font></td><td>&nbsp;: " . $file_count . "���� ������ �ֽ��ϴ�.</td></tr>";
			

		}

	}
	else
	{

			echo "���ε�� ������ �����ϴ�.";
			$exist_flag = FALSE;

	}

}
else
{

	echo "<font color=#FF9966>�ش��ϴ� �õ������� �����ϴ�.</font>";
	$exist_flag = FALSE;

}

?>
		</table>
		</td>
		</tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>

<table width=510 border=0 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td align=center height=50>

<? IF( TRUE == $count_flag ) : ?>
	<? if( TRUE == $exist_flag ) : ?>
	<a href="javascript:document.Form.submit()" onFocus='this.blur()'>[ �����ܰ� ]</a>
	<? endif ?>
	<a href="javascript:window.history.back()" onFocus='this.blur()'>[ ���ư��� ]</a>
<? ELSE : ?>
	<font color=#FF9966 style="font-size:9pt">�� ������ ��ϵǾ��ִ� ������ ������ ���� ����� ������ �̹��� ������<br>��ġ���� �ʾ� �����ܰ�� ������ �� �����ϴ�.</font>
	<a href="javascript:window.history.back()" onFocus='this.blur()'>[ ���ư��� ]</a>
<? ENDIF ?>
	</td>
</tr>
</table>
<form>
</body>
</html>
