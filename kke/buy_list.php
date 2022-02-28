<?
session_start();
?>
<html>
<body>
<table width="100%">
<tr>
<td>개인 홈페이지</td>
</tr>
</table>
<?
$coin_mid="kke";
session_register("coin_mid");


/////////////////////여기서부터 start/////////////////////////

//1.넘길 파라미터 a_code[매체사코드],coin_mid[싸이트 회원고객아이디],site_code[사이트코드]

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
			<td><a href="sosic_list.php<?=$coin_param?>">[광고리스트]</a>&nbsp;<a href="buy_list.php<?=$coin_param?>">[적립내역]</a></td>
		</tr>
		</table>

		</td>
	</tr>
	</table>

	<br><br>


	<iframe width="700" height="<?=$buy_height?>" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" src="http://www.1wonad.com/coin/result/point_list.php?coin_a_code=<?=$coin_a_code?>&coin_site_code=<?-$coin_site_code?>&coin_mid=<?=$coin_mid?>"></iframe>

<?
/////////////////////여기까지 end/////////////////////////
?>
</body>
</html>