<?
	/////////////////////���⼭���� start/////////////////////////
	$coin_mid="ddalgia";//[�Ͽ��ֵ����Ʈ���̵�]
	$coin_a_code="a_25047";//������ ��ü�ڵ� �Է�
	$coin_site_code="ȸ���̸�";//���� ȸ�� �̸�[����]

	$enc=mb_detect_encoding($coin_mid,array("UTF-8","EUC-KR"));
	if($enc=="UTF-8"){
		$coin_mid=iconv("utf-8", "euc-kr",$coin_mid);
	}
	$coin_param="?coin_a_code=".$coin_a_code."&coin_site_code=".$coin_site_code."&coin_mid=".$coin_mid;
	?>

	<a href="http://www.1wonad.com/coin/sosic/site/sosic_p_list.php<?=$coin_param?>" target="_blank">������ ��ưŬ��</a>
	<?
	/////////////////////������� end/////////////////////////
	?>
	</body>
	</html>