<?
	//1.�ѱ� �Ķ���� a_code[��ü���ڵ�],coin_mid[����Ʈ ȸ�������̵�],site_code[����Ʈ�ڵ�]
	$coin_mid="kim01";//[�Ͽ��ֵ����Ʈ���̵�]
	$coin_a_code="a_2"; //[�Ͽ��ֵ忡�� �߱޵� ��ü�ڵ�]
	$coin_site_code="ȸ���̸�";//���� ȸ�� �̸�[����]
	$coin_domain="lsp80.cafe24.com";//���� ȸ�� ������

	$enc=mb_detect_encoding($coin_mid,array("UTF-8","EUC-KR"));
	if($enc=="UTF-8"){
		$coin_mid=iconv("utf-8", "euc-kr",$coin_mid);
	}
	$coin_param="?coin_a_code=".$coin_a_code."&coin_site_code=".$coin_site_code."&coin_mid=".$coin_mid;

	?>

	<iframe name="onewonadFrame" id="onewonadFrame" frameborder="0" style="width:100%;" scrolling="no"></iframe>
	<script language="javascript" src="http://www.dreamcoin.kr/coin/sosic/comm/iframe.js"></script>
	<script language="javascript">		
	document.domain = "<?=$coin_domain?>";//��ü ������ 
	var dummy = new Date().getTime();
	document.getElementById("onewonadFrame").src = "http://www.dreamcoin.kr/coin/sosic/site/sosic_list.php<?=$coin_param?>&fw=" + window.innerWidth + "&fh=" + window.innerHeight + "&t=" + dummy;
	</script>
	</body>
	</html>