<?php
ini_set("display_errors","on");
include_once("./_common.php");

//ver1.0 150517 @_untitle_d


require_once(G5_PLUGIN_PATH.'/social_login/kakao/kakao_fun.php');
$kakao = new Kakao(array(
        "REST_ID" => "e50b07f7728318d38e9ce6eeb19aa85d",        // (*필수)REST ID  
        "RETURN_URL" => "http://kynlove.cafe24.com/plugin/social_login/kakao/kalogin.php",      // (*필수)콜백 URL
        )
    );


$kakao->testLogin();



?>