<?php
include_once("./_common.php");

//ver1.0 150517 @_untitle_d


require_once(G5_PLUGIN_PATH.'/social_login/naver/naver_fun.php');
$naver = new Naver(array(
        "CLIENT_ID" => NV_CONSUMER_KEY,        // (*�ʼ�)Ŭ���̾�Ʈ ID  
        "CLIENT_SECRET" => NV_CONSUMER_SECRET,    // (*�ʼ�)Ŭ���̾�Ʈ ��ũ��
        "RETURN_URL" => G5_PLUGIN_URL."/social_login/naver/naverlogin.php",      // (*�ʼ�)�ݹ� URL
        "AUTO_CLOSE" => true,              // ���� �Ϸ��� �˾� �ڵ����� ���� ���� ���� (�߰� ���� ����� �߰��ൿ �ʿ�� false ���� �� �߰�)
        "SHOW_LOGOUT" => false              // ���� �Ŀ� ���̹� �α׾ƿ� ��ư ǥ��/ �Ǵ� ǥ�þ���
        )
    );

$naver->login();

if (!$naver->getAccessToken()) {
	header('Location: /'); 
    break;
}else{
	header('Location: /'); 
    break;
}


?>