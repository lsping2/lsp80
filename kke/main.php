<html>
<head></head>
<body>
<table cellpadding="0" cellspacing="0" border="1" width="100%">
<tr>
	<td>���</td>
</tr>
<tr>
	<td>
	<?
	//�ʼ� �ѱ� �Ķ���� [coin_mid:����Ʈ ȸ�������̵�,coin_a_code:��ü���ڵ�,coin_site_code:����Ʈ�ڵ�]
	//site�� ��ġ�ÿ�  coin_domain �ʼ�
	$coin_mid="kim02";//[���� �帲���� ���̵�]
	$coin_a_code="a_11"; //[�帲���ο��� �߱޵� ��ü���ڵ�]
	$coin_site_code="lsp80";// ȸ�� �̸�[����]
	$coin_domain="lsp80.cafe24.com";//���� �ҽ���ġ�� ������
	$enc=mb_detect_encoding($coin_mid,array("UTF-8","EUC-KR"));
	$coin_param="?coin_mid=".$coin_mid."&coin_a_code=".$coin_a_code."&coin_site_code=".$coin_site_code;

	?>
	<table cellpadding="0" cellspacing="0" border="1"  width="100%" height="100%">
	<tr height="100%">
		<td width="20%">
		<a  href="http://www.dreamcoin.kr/coin/main.php?coin_a_code=<?=$coin_a_code?>&coin_mid=<?=$coin_mid?>" target="_blank">������ ��ưŬ��</a>

		</td>
		<td width="80%">

			<table cellpadding="0" cellspacing="0" border="1"  width="100%" height="100%">
			<tr height="100%">
				<td>

				<iframe name="dreamcoinFrame" id="dreamcoinFrame" frameborder="0" style="width:100%;" scrolling="no"></iframe>
				<script language="javascript" src="http://www.dreamcoin.kr/coin/sosic/comm/iframe.js"></script>
				<script language="javascript">

				document.domain = "<?=$coin_domain?>";//���� �ҽ���ġ�� ������

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