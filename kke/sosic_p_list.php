<?
	/////////////////////여기서부터 start/////////////////////////
	$coin_mid="ddalgia";//[일원애드사이트아이디]
	$coin_a_code="a_25047";//삽입할 매체코드 입력
	$coin_site_code="회사이름";//현재 회사 이름[영문]

	$enc=mb_detect_encoding($coin_mid,array("UTF-8","EUC-KR"));
	if($enc=="UTF-8"){
		$coin_mid=iconv("utf-8", "euc-kr",$coin_mid);
	}
	$coin_param="?coin_a_code=".$coin_a_code."&coin_site_code=".$coin_site_code."&coin_mid=".$coin_mid;
	?>

	<a href="http://www.1wonad.com/coin/sosic/site/sosic_p_list.php<?=$coin_param?>" target="_blank">충전소 버튼클릭</a>
	<?
	/////////////////////여기까지 end/////////////////////////
	?>
	</body>
	</html>