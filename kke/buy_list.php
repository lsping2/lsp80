<?
session_start();
?>
<html>
<body>
<table width="100%">
<tr>
<td>���� Ȩ������</td>
</tr>
</table>
<?
$coin_mid="kke";
session_register("coin_mid");


/////////////////////���⼭���� start/////////////////////////

//1.�ѱ� �Ķ���� a_code[��ü���ڵ�],coin_mid[����Ʈ ȸ�������̵�],site_code[����Ʈ�ڵ�]

	$coin_a_code="a_25047";
	$coin_mid=$coin_mid;
	$site_code="";

	$enc=mb_detect_encoding($coin_mid,array("UTF-8","EUC-KR"));
	if($enc=="UTF-8"){
		$coin_mid=iconv("utf-8", "euc-kr",$coin_mid);
	}
	$coin_param="?coin_a_code=".$coin_a_code."&coin_site_code=".$coin_site_code."&coin_mid=".$coin_mid;
?>
<?	include "xml/xmlParser.php";?>
<?	include "xml/sosic_inc.php";?>



	<table width="50%" width="left" height="35" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center">
		
		<table width="50%" align="left" cellpadding="0" cellspacing="0">
		<tr>
			<td><a href="sosic_list.php<?=$coin_param?>">[������Ʈ]</a>&nbsp;<a href="buy_list.php<?=$coin_param?>">[��������]</a></td>
		</tr>
		</table>

		</td>
	</tr>
	</table>

	<br><br>


	<iframe width="700" height="<?=$buy_height?>" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" src="http://www.1wonad.com/coin/result/point_list.php?coin_a_code=<?=$coin_a_code?>&coin_site_code=<?-$coin_site_code?>&coin_mid=<?=$coin_mid?>"></iframe>

<?
/////////////////////������� end/////////////////////////
?>
</body>
</html>