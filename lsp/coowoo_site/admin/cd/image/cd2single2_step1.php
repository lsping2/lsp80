<?

require_once "../../../include/include.php";

require_once "../../login/login_check.php";
login_check( $PHP_SELF );

$data_folder_no			= request( 'data_folder_no' , 'get' );
$cd_folder					= request( 'cd_folder' , 'get' );
$pricelist_no				= request( 'pricelist_no' , 'get' );

$manufacture_code	= request( 'manufacture_code', 'get' );
$license_code			= request( 'license_code', 'get' );


$db = new mysql();
$db2 = new mysql();

$cd_order_no = request( 'cd_order_no' , 'get' );
$cd_order_no_end = request( 'cd_order_no_end' , 'get' );

if( $cd_order_no )
{
	$no = substr( $cd_order_no, -3 );
	$cd_order_no = substr( $cd_order_no, 0, strlen( $cd_order_no ) - 3 ) . sprintf( '%03d', $no + 1 );
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

	function checkForm( form )
	{

		if( empty( form.data_folder_no.value ) )
		{
			alert( '스토리지가 없습니다.' );
			return false;
		}

		if( empty( form.cd_folder.value ) )
		{
			alert( '시디 폴더명을 입력해 주세요.' );
			form.cd_folder.focus();
			return false;
		}

		return true;

	}

-->
</script>
</head>
<body onLoad="document.Form.cd_folder.focus()">
<b><font size=3>* CD → 싱글 등록 ( 수동 다운로드 )</font></b><br><br>
<form name=Form method=get action=cd2single2_step2.php onSubmit="return checkForm( this )">
<font style="font-size:9pt">- 싱글이미지로 등록할 정보와 폴더를 입력해 주세요.</font><br><br>
<table border=0 cellpadding=0 cellspacing=3 border=0 bgcolor="#CDCD9A">
<tr>
	<td align=center bgcolor=#FFFFFF>
	<br>
	<table width=700 border=0 cellpadding=0 cellspacing=5 border=0 bgcolor="#FFFFFF">
	<tr>
		<td align=center>
		<table border=0 cellpadding=0 cellspacing=0>

		<tr>
		<td align=center width=140 height=24>
		라이센스
		</td>
		<td width=10>
		:
		</td>
		<td>
<?

$query = "
			SELECT	license_code ,
					license_name
			FROM	product_license_code
			WHERE	use_status = 'Yes'
			ORDER BY license_name ASC
";
$db->query( $query );

?>
	<? if( $db->total_record() ) : ?>
		<select name=license_code>
	<? for( $loop=0; $loop<$db->total_record(); $loop++ ) : ?>
	<?

		$db->fetch();
		$rs_license_code = $db->result( 'license_code' );
		$rs_license_name = $db->result( 'license_name' );

	?>
	<? if( $rs_license_code == $license_code ) : ?>
		<option value='<?=$rs_license_code?>' selected><?=$rs_license_name?>&nbsp;</option>
	<? else : ?>
		<option value='<?=$rs_license_code?>'><?=$rs_license_name?>&nbsp;</option>
	<? endif ?>

	<? endfor ?>
		</select>
<? else : ?>
		<font color="#FF9966">등록된 라이센스가 없습니다.</font>
		<input type=hidden name=license_code>
<? endif ?>
		</td>
		</tr>

		<tr>
		<td align=center width=140 height=24>
		스토리지
		</td>
		<td width=10>
		:
		</td>
		<td>
<?

$query = "
			SELECT	data_folder_no ,
					data_folder_name
			FROM	data_folder
			WHERE	use_status = 'Yes'
			ORDER BY data_folder_name ASC
";
$db->query( $query );

?>
	<? if( $db->total_record() ) : ?>
		<select name=data_folder_no>
	<? for( $loop=0; $loop<$db->total_record(); $loop++ ) : ?>
	<?

		$db->fetch();
		$rs_data_folder_no = $db->result( 'data_folder_no' );
		$rs_data_folder_name = $db->result( 'data_folder_name' );

	?>
	<? if( $rs_data_folder_no == $data_folder_no ) : ?>
		<option value='<?=$rs_data_folder_no?>' selected>/storage/<?=$rs_data_folder_name?>&nbsp;</option>
	<? else : ?>
		<option value='<?=$rs_data_folder_no?>'>/storage/<?=$rs_data_folder_name?>&nbsp;</option>
	<? endif ?>

	<? endfor ?>
		</select>
<? else : ?>
		<font color="#FF9966">등록된 스토리지가 없습니다.</font>
		<input type=hidden name=data_folder_no>
<? endif ?>
		</td>
		</tr>

		<tr>
		<td align=center width=140 height=24>
		가격표
		</td>
		<td width=10>
		:
		</td>
		<td>
<?

$query = "
			SELECT	pricelist_no ,
					pricelist_name
			FROM 	single_pricelist_name
			ORDER BY pricelist_name ASC
";
$db->query( $query );

?>
	<? if( $db->total_record() ) : ?>
		<select name=pricelist_no>
	<? for( $loop=0; $loop<$db->total_record(); $loop++ ) : ?>
	<?

		$db->fetch();
		$rs_pricelist_no = $db->result( 'pricelist_no' );
		$rs_pricelist_name = $db->result( 'pricelist_name' );

		$query2 = "
					SELECT	folder_no ,
								folder_size ,
								folder_name
					FROM	single_pricelist_folder
					WHERE	pricelist_no = '$rs_pricelist_no'
					ORDER BY sort ASC
		";
		$db2->query( $query2 );

		$folder_info = '';
		for( $loop2=0; $loop2<$db2->total_record(); $loop2++ )
		{

			$db2->fetch();
			$rs_folder_no = $db2->result( 'folder_no' );
			$rs_folder_size = $db2->result( 'folder_size' );
			$rs_folder_name = $db2->result( 'folder_name' );

			$folder_info .= ", [$rs_folder_size/$rs_folder_name]";

		}
		$folder_info = substr( $folder_info, 2 );

	?>
	<? if( $rs_pricelist_no == $pricelist_no ) : ?>
	<option value='<?=$rs_pricelist_no?>' selected><?=$rs_pricelist_name?> <?=$folder_info?></option>
	<? else : ?>
		<option value='<?=$rs_pricelist_no?>'><?=$rs_pricelist_name?> <?=$folder_info?></option>
	<? endif ?>

	<? endfor ?>
		</select>
<? else : ?>
		<font color="#FF9966">등록된 가격표 없습니다.</font>
		<input type=hidden name=data_folder_no>
<? endif ?>
		</td>
		</tr>

		<tr>
		<td align=center>
		시디 폴더(주문번호) 시작
		</td>
		<td width=10>
		:
		</td>
		<td>
		<input type=text name=cd_folder size=20 value="<?=$cd_order_no?>">
		</td>
		</tr>
		<tr>
		<td align=center>
		시디 폴더(주문번호) 끝
		</td>
		<td width=10>
		:
		</td>
		<td>
		<input type=text name=cd_folder_end size=20 value="">
		</td>
		</tr>

		</table>
		</td>
	</tr>
	</table>
	<br>
	<input type=submit value="  확인  " onFocus="this.blur()">
	<br><br>
	</td>
</tr>
</table>
</form>
</body>
</html>
