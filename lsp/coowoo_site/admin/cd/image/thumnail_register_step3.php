<?

require_once "../../../include/include.php";
html_cache_disable();

$data_folder_no		= request( 'data_folder_no' , 'get' );
$cd_folder		= request( 'cd_folder' , 'get' );
$thumnail_folder	= request( 'thumnail_folder' , 'get' );

$db = new MYSQL;

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

$SERVER_CONFIG[ 'storage_location' ] . "/{$rs_data_folder_name}/{$cd_folder}/{$thumnail_folder}";
$dir = dir( $SERVER_CONFIG[ 'storage_location' ] . "/{$rs_data_folder_name}/{$cd_folder}/{$thumnail_folder}" );

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
			if ( strtolower( $extention[1] ) == 'jpg' OR strtolower( $extention[1] ) == 'jpeg' )
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
<b><font size=3>* CD ������ ����� - Ȯ��</font></b><br><br>
<font style="font-family:verdana; font-size:8pt">
- ������ ���� �� ���ϸ���Ʈ�� ��Ȯ�� Ȯ���Ͻð� �۾����� ��ư�� ��������.<br>
- �۾��� �Ϸ�Ǳ���� 1~2���� �ð��� �ɸ��� �۾��ߴܽ� ó������ �ٽ������Ͻñ� �ٶ��ϴ�.<br><br>
</font>


<table border=0 cellpadding=0 cellspacing=3 border=0 bgcolor="#CDCD9A">
<tr>
	<td>
	<table border=0 cellpadding=0 cellspacing=5 border=0 bgcolor="#FFFFFF">
	<tr>
		<td align=center>
		<table border=0 cellpadding=3 cellspacing=0>
		<tr>
			<td width=80 height=24 align=center>
			���丮�� 
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
			�õ����� 
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
			�ҽ� ���� 
			</td>
			<td align=center>
			:
			</td>
			<td>
			<?=$thumnail_folder?>
			&nbsp;&nbsp;[ <?=$file_count?>�� ���� ]
			<input type=hidden name=thumnail_dirname value="<?=$thumnail_dirname?>">
			</td>
		</tr>
		<tr>
			<td colspan=3 height=1 background="../../image/dot.gif">
			</td>
		</tr>
		<tr><td colspan=3 height=5></td></tr>
		<tr bgcolor=#EFEFEF>
			<td height=60 align=center>
			����� ����
			</td>
			<td align=center>
			:
			</td>
			<td>
			<br>
			/thumnail/<?=$cd_dirname?>/single_images/80<br>
			/thumnail/<?=$cd_dirname?>/single_images/120<br>
			/thumnail/<?=$cd_dirname?>/single_images/500<br>
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
	<? if( $file_count ) : ?>
	<a href="thumnail_register_step4.php?data_folder_no=<?=$data_folder_no?>&cd_folder=<?=$cd_folder?>&thumnail_folder=<?=$thumnail_folder?>" onFocus='this.blur()'>[   ��Ͻ���   ]</a>
	<? endif ?>
	<a href="javascript:window.history.back()" onFocus='this.blur()'>[   ���ư���   ]</a>
	</td>
</tr>
</table>

<table border=0 cellpadding=0 cellspacing=1 bgcolor=#EFEFEF>
<tr height=24>
	<td align=center width=200>
	�ҽ� ����
	</td>
	<td align=center width=120>
	�õ� ��Ϲ�ȣ
	</td>
	<td align=center width=160>
	�̱� ��Ϲ�ȣ
	</td>
</tr>

<? if( $file_count ) : ?>
	<? for( $loop=0; $loop<count( $filelist ); $loop++ ) : ?>
	<tr>
		<td height=18 align=center bgcolor=#FFFFFF>
		<?=$filelist[$loop]?>
		</td>
		<td align=center bgcolor=#FFFFFF>
		<?=$cd_folder?>
		</td>
		<td align=center bgcolor=#FFFFFF>
		<?=substr( $cd_folder, 0, 1 )?><?=substr( $cd_folder, 1 )?><?=sprintf( "%03d", $loop+1 ); ?>
		</td>
	</tr>
	<? endfor ?>
<? else : ?>
	<tr>
		<td colspan=3 height=50 align=center bgcolor=#FFFFFF>
		<font color=#FF9966>����� ������ �����ϴ�.</font>
		</td>
	</tr>
<? endif ?>
</table>


