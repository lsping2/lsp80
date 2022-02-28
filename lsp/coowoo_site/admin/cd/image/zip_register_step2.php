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
			AND		pc.cd_order_no = '$cd_order_no'
			AND		pc.use_status = 'Yes'
";
$db->query( $query );
if( !$db->total_record() )
{

	js_msg( "��ϵ� �õ� �ƴմϴ�. �õ� ����۾��� ���� �ϼ���." );
	js_back();
	exit;

}

$db->fetch();
$rs_data_folder_name = $db->result( 'data_folder_name' );

?>
<?

$full_cd_folder =  $SERVER_CONFIG[ 'storage_location' ] . "/{$rs_data_folder_name}/{$cd_order_no}";
if( FALSE == is_dir( $full_cd_folder ) )
{
	js_code( "alert( '[ " . $full_cd_folder . " ] ������ �������� �ʽ��ϴ�.' ); history.back(); " );
	exit;
}


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

?>
<html>
<head>
<title><?$HTML->Title( 'Admin' )?></title>
<?=$HTML->Metatag()?>
<link rel="stylesheet" href="../../admin_style.css" type="text/css">

</head>
<body>
<b><font size=3>* �õ� ZIP���� ���</font></b><br><br>
<font style="font-family:verdana; font-size:8pt">
- ������ ���� �� ���ϸ���Ʈ�� ��Ȯ�� Ȯ���Ͻð� �۾����� ��ư�� ��������.<br><br>
</font>

<form name=Form action=zip_register_step3.php method=post>
<table border=0 cellpadding=0 cellspacing=3 border=0 bgcolor="#CDCD9A">
<tr>
	<td>
	<table border=0 cellpadding=0 cellspacing=5 border=0 bgcolor="#FFFFFF">
	<tr>
		<td align=center>
		<table border=0 cellpadding=3 cellspacing=0>
		<tr>
			<td width=100 height=24 align=center>
			���丮�� 
			</td>
			<td align=center width=30>
			:
			</td>
			<td width=340>
			/storage/<?=$rs_data_folder_name?>
			<input type=hidden name=data_folder_name value="<?=$rs_data_folder_name?>">
			</td>
		</tr>
		<tr>
			<td colspan=3 height=1 background="../../image/dot.gif">
			</td>
		</tr>
		<tr>
			<td height=24 align=center>
			�õ����� 
			</td>
			<td align=center>
			:
			</td>
			<td>
			<?=$cd_order_no?>
			<input type=hidden name=cd_folder value="<?=$cd_order_no?>">
			</td>
		</tr>
		<tr>
			<td colspan=3 height=1 background="../../image/dot.gif">
			</td>
		</tr>
		<tr>
			<td colspan=3>
			<br>
			<table align=center cellpadding=0 cellspacing=1 bgcolor=#DDDDDD>
			<tr>
				<td width=180 align=center height=20>
				���ϸ�
				</td>
				<td width=100 align=center>
				�뷮
				</td>
				<td width=200 align=center>
				ZIP���� �̸�
				</td>
			</tr>
<? for( $loop=0; $loop<$file_count; $loop++ ) : ?>
			<tr>
				<td align=center bgcolor=#FFFFFF height=26>
				<?=$filelist[ $loop]?>
				</td>
				<td align=center bgcolor=#FFFFFF>
				<?

				echo my_filesize( filesize( $SERVER_CONFIG[ 'storage_location' ] . "/{$rs_data_folder_name}/{$cd_order_no}/" . $filelist[ $loop ] ) );

				?>
				</td>
				<td bgcolor=#FFFFFF style="padding-left:5pt">
				<input type=text name=cd_zip_title[] size=28 style="font-family:verdana; font-size:8pt" value="<?=$cd_order_no?> ( CD<?=$loop+1?> )">
				</td>
			</tr>
<? endfor ?>
			</table>
			<br>
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
	<a href="javascript:document.Form.submit()" onFocus='this.blur()'>[&nbsp;&nbsp;&nbsp;���&nbsp;&nbsp;&nbsp;]</a>
	<a href="javascript:window.history.back()" onFocus='this.blur()'>[   ���ư���   ]</a>
	</td>
</tr>
</table>

<input type=hidden name=cd_order_no value="<?=$cd_order_no?>">
</form>
</body>
</html>


