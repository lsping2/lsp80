<?

require_once "../../../include/include.php";
html_cache_disable();


$manufacture = request( 'manufacture' , 'get' );
$download_no = request('download_no','get');




switch( $manufacture )
{
	case 'ndisc'		:
						$title = "NDisc";
						$menu = "ndisc_menu.html";
						$table_name = 'seller_download_ndisc';
						$folder_name = 'seller_ndisc_download';
						break;
	case 'daj'			:
						$title = "DAJ";
						$menu = "daj_menu.html";
						$table_name = 'seller_download_daj';
						$folder_name = 'seller_daj_download';
						break;
	case 'mixa'		:
						$title = "MIXA";
						$menu = "mixa_menu.html";
						$table_name = 'seller_download_mixa';
						$folder_name = 'seller_mixa_download';
						break;
	case 'naturalimage'	:
						$title = "Natural Image";
						$menu = "naturalimage_menu.html";
						$table_name = 'seller_download_naturalimage';
						$folder_name = 'seller_naturalimage_download';
						break;
	case 'ion'			:
						$title = "ION";
						$menu = "ion_menu.html";
						$table_name = 'seller_download_ion';
						$folder_name = 'seller_ion_download';
						break;
}




$db = new MYSQL;


//echo $download_no;
//echo $manufacture;
//exit;






$query = "
			SELECT
					reason 
			FROM	seller.{$table_name}
			WHERE	download_no = '$download_no'
";




$db->query( $query );
$db->fetch();
$rs_reason		= htmlspecialchars( trim ($db->result( 'reason' ) ) );


?>
<html>
<head>
<title></title>

</head>
<body>
<form name=frm action="reson_modify_exec.php" method="post">
<table width=100% height=300  border=0 cellpadding=0 cellspacing=2 bgcolor=#EFEFEF>
	<tr>
		<td align=center  bgcolor="#FAFAFA" height=10%><b>reason</b></td>
	</tr>
	<tr>
		<td  valign=top bgcolor=#FFFFFF>
			<center><textarea rows=17 cols=50 name=reason> <?= $rs_reason ?> </textarea></center>
		</td>
	</tr>
</table>

<!--  실행 페이지에 넘길 값들 -->
<input type=hidden name=download_no value="<?=$download_no?>">
<input type=hidden name=manufacture value="<?=$manufacture?>">

<table>
<tr>
	<td>
		<a href="javascript: self.close()" onFocus=this.blur() style="font-size=9pt">[ 창닫기 ]</a>
	</td>
	<td width=250>&nbsp;</td>
	<td valign=right>
		<a href="javascript:this.frm.submit()" onFocus=this.blur() style="font-size=9pt">[ 수정 ]</a>
	</td>
</tr>
</table>
</form>
</body>
</html>