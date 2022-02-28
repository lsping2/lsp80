<?php
include_once("./_common.php");

//ver1.0 150517 @_untitle_d


require_once(G5_PLUGIN_PATH.'/social_login/naver/naver_fun.php');
$naver = new Naver(array(
        "CLIENT_ID" => NV_CONSUMER_KEY,        // (*필수)클라이언트 ID  
        "CLIENT_SECRET" => NV_CONSUMER_SECRET,    // (*필수)클라이언트 시크릿
        "RETURN_URL" => G5_PLUGIN_URL."/social_login/naver/naverlogin.php",      // (*필수)콜백 URL
        "AUTO_CLOSE" => true,              // 인증 완료후 팝업 자동으로 닫힘 여부 설정 (추가 정보 기재등 추가행동 필요시 false 설정 후 추가)
        "SHOW_LOGOUT" => false              // 인증 후에 네이버 로그아웃 버튼 표시/ 또는 표시안함
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