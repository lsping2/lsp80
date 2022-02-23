<?
	//1.넘길 파라미터 a_code[매체사코드],coin_mid[싸이트 회원고객아이디],site_code[사이트코드]
	$coin_mid="kim01";//[일원애드사이트아이디]
	$coin_a_code="a_2"; //[일원애드에서 발급된 업체코드]
	$coin_site_code="회사이름";//현재 회사 이름[영문]
	$coin_domain="lsp80.cafe24.com";//현재 회사 도메인

	$enc=mb_detect_encoding($coin_mid,array("UTF-8","EUC-KR"));
	if($enc=="UTF-8"){
		$coin_mid=iconv("utf-8", "euc-kr",$coin_mid);
	}
	$coin_param="?coin_a_code=".$coin_a_code."&coin_site_code=".$coin_site_code."&coin_mid=".$coin_mid;

	?>

	<iframe name="onewonadFrame" id="onewonadFrame" frameborder="0" style="width:100%;" scrolling="no"></iframe>
	<script language="javascript" src="http://www.dreamcoin.kr/coin/sosic/comm/iframe.js"></script>
	<script language="javascript">		
	document.domain = "<?=$coin_domain?>";//업체 도메인 
	var dummy = new Date().getTime();
	document.getElementById("onewonadFrame").src = "http://www.dreamcoin.kr/coin/sosic/site/sosic_list.php<?=$coin_param?>&fw=" + window.innerWidth + "&fh=" + window.innerHeight + "&t=" + dummy;
	</script>
	</body>
	</html>