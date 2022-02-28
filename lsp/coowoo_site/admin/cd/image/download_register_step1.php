<?

require_once "../../../include/include.php";
require_once "../../login/login_check.php";
login_check( $PHP_SELF );
$cd_order_no = request( 'cd_order_no' , 'get' );

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

	function checkForm( form )
	{

		if( empty( form.cd_order_no.value ) )
		{

			alert( '�õ��ֹ���ȣ�� �Է��� �ּ���.' );
			form.cd_order_no.value='';
			form.cd_order_no.focus();
			return false;

		}

		return true;

	}

-->
</script>
</head>
<body onLoad="document.Form.cd_order_no.focus()">
<b><font size=3>* �õ� �ٿ�ε����� ���</font></b><br><br>
<font style="font-size:9pt">- �ٿ�ε� ������ ����� �õ��� �ֹ���ȣ�� �Է��� �ּ���.</font><br><br>
<form name=Form action="download_register_step2.php" method=get onSubmit="return checkForm( this )">
<table border=0 cellpadding=0 cellspacing=3 border=0 bgcolor="#CDCD9A">
<tr>
	<td>
	<table width=400 height=100 border=0 cellpadding=0 cellspacing=5 border=0 bgcolor="#FFFFFF">
	<tr>
		<td align=center>
		�õ� �ֹ���ȣ : <input type=text name=cd_order_no size=10 value="<?=$cd_order_no?>">
		<input type=submit value="  Ȯ��  ">
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
</form>
</body>
</html>
