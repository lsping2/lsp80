<html>
<head></head>
<body>
<table cellpadding="0" cellspacing="0" border="1" width="100%">
<tr>
	<td>상단</td>
</tr>
<tr>
	<td>
	<?
	//필수 넘길 파라미터 [coin_mid:싸이트 회원고객아이디,coin_a_code:매체사코드,coin_site_code:사이트코드]
	//site에 설치시엔  coin_domain 필수
	$coin_mid="kim02";//[현재 드림코인 아이디]
	$coin_a_code="a_11"; //[드림코인에서 발급된 매체사코드]
	$coin_site_code="lsp80";// 회사 이름[영문]
	$coin_domain="lsp80.cafe24.com";//현재 소스설치한 도메인
	$enc=mb_detect_encoding($coin_mid,array("UTF-8","EUC-KR"));
	$coin_param="?coin_mid=".$coin_mid."&coin_a_code=".$coin_a_code."&coin_site_code=".$coin_site_code;

	?>
	<table cellpadding="0" cellspacing="0" border="1"  width="100%" height="100%">
	<tr height="100%">
		<td width="20%">
		<a  href="http://www.dreamcoin.kr/coin/main.php?coin_a_code=<?=$coin_a_code?>&coin_mid=<?=$coin_mid?>" target="_blank">충전소 버튼클릭</a>

		</td>
		<td width="80%">

			<table cellpadding="0" cellspacing="0" border="1"  width="100%" height="100%">
			<tr height="100%">
				<td>

				<iframe name="dreamcoinFrame" id="dreamcoinFrame" frameborder="0" style="width:100%;" scrolling="no"></iframe>
				<script language="javascript" src="http://www.dreamcoin.kr/coin/sosic/comm/iframe.js"></script>
				<script language="javascript">

				document.domain = "<?=$coin_domain?>";//현재 소스설치한 도메인

				var dummy = new Date().getTime();
				document.getElementById('dreamcoinFrame').src = "http://www.dreamcoin.kr/coin/main.php<?=$coin_param?>&fw=" + window.innerWidth + "&fh=" + window.innerHeight + "&t=" + dummy;
				</script>

				</td>
			</tr>
			</table>

		</td>
	</tr>
	</table>


	</td>
</tr>
</table>
</body>

</html>