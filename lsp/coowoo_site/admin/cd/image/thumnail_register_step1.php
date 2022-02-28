<?

require_once "../../../include/include.php";
require_once "../../login/login_check.php";
login_check( $PHP_SELF );
$cd_order_no = request( 'cd_order_no' );
$data_folder_no = request( 'data_folder_no' );

if( $cd_order_no )
{
	$no = substr( $cd_order_no, -3 );
	$cd_order_no = substr( $cd_order_no, 0, strlen( $cd_order_no ) - 3 ) . sprintf( '%03d', $no + 1 );
}


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
			return false;
		}

		return true;

	}

-->
</script>
</head>
<body onLoad="document.Form.cd_folder.focus()">
<b><font size=3>* CD 섬네일 만들기</font></b><br><br>
<form name=Form method=get action=thumnail_register_step2.php onSubmit="return checkForm( this )">
<font style="font-size:9pt">- 섬네일을 만들 폴더를 입력해 주세요.</font><br><br>
<table border=0 cellpadding=0 cellspacing=3 border=0 bgcolor="#CDCD9A">
<tr>
	<td align=center bgcolor=#FFFFFF>
	<br>
	<table width=500 border=0 cellpadding=0 cellspacing=5 border=0 bgcolor="#FFFFFF">
	<tr>
		<td align=center>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td align=center width=140>
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
		<option value='<?=$rs_data_folder_no?>'<? if( $data_folder_no == $rs_data_folder_no ) echo " selected"; ?>>/storage/<?=$rs_data_folder_name?>&nbsp;</option>
	<? endfor ?>
		</select>
<? else : ?>
		<font color="#FF9966">등록된 스토리지가 없습니다.</font>
		<input type=hidden name=data_folder_no>
<? endif ?>
		</td>
		</tr>
		<tr>
		<td align=center>
		시디 폴더(주문번호)
		</td>
		<td width=10>
		:
		</td>
		<td>
		<input type=text name=cd_folder size=20 value="<?=$cd_order_no?>">
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
