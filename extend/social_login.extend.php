<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//ver1.0 150517 @_untitle_d
//공통
define('SL_ID_FIELD','mb_9'); //소셜로그인 서비스를 사용할때 소셜로그인의 아이디정보를 기록할 필드명
define('SL_TYPE_FIELD','mb_10'); //소셜로그인 서비스를 사용할때 소셜명을 기록할 필드명 (ex. 카카오톡=kakao, 네이버=naver)
define('SL_PROFILE_IMAGE_FIELD','mb_8'); //소셜로그인 서비스를 사용할때 사용자 프로필 이미지를 기록할 필드
define('SL_PROFILE_IMAGE2_FIELD','mb_7'); //소셜로그인 서비스를 사용할때 사용자 프로필 썸네일 이미지를 기록할 필드
define('SL_CHECK_EMAIL','0'); //이메일 체크를 할지 여부 (0: 체크안함 1:체크함)
define('SL_UPDATE_THUMBNAIL','0'); //썸네일 이미지를 로그인할때마다 업데이트 할지 여부 (0: 업데이트 안함 1:업데이트 실시)

//트위터 - https://apps.twitter.com
define('TW_CONSUMER_KEY', '');
define('TW_CONSUMER_SECRET', '');
define('TW_ACCESS_TOKEN', '');
define('TW_ACCESS_TOKEN_SECRET', '');
define('TW_LOGIN', G5_PLUGIN_URL.'/social_login/tw/login.php');
define('TW_OAUTH_CALLBACK', G5_PLUGIN_URL.'/social_login/tw/twlogin.php'); //http://Your HOMEPAGE/plugin/social_login/tw/callback.php


//페이스북 - https://developers.facebook.com/apps
define('FB_CONSUMER_KEY', '806628996049819');
define('FB_CONSUMER_SECRET', '27f7013c849ab4e53df59fa62cc5c76a');
define('FB_LOGIN', G5_PLUGIN_URL.'/social_login/fb/login.php');
define('FB_OAUTH_CALLBACK', G5_PLUGIN_URL.'/social_login/fb/fblogin.php');

//카카오톡 - https://dev.kakao.com/
define('KA_OAUTH_URL', 'https://kauth.kakao.com/oauth/');
define('KA_CONSUMER_KEY', '6e2fe9224487a7e8818962f7c1020c53');
define('KA_LOGIN', G5_PLUGIN_URL.'/social_login/kakao/login.php');
define('KA_OAUTH_CALLBACK', G5_PLUGIN_URL.'/social_login/kakao/kalogin.php');

//구글 - https://code.google.com/apis/console
define('GG_CONSUMER_KEY', '89024960002-t6g9ivdefn5perp21k0v2bijk7n7eq2o.apps.googleusercontent.com');
define('GG_CONSUMER_SECRET', 'rhu8jendGdpTTpxBinEFdzI3');
define('GG_LOGIN', G5_PLUGIN_URL.'/social_login/gg/login.php');
define('GG_OAUTH_CALLBACK', G5_PLUGIN_URL.'/social_login/gg/gglogin.php'); //http://Your HOMEPAGE/plugin/social_login/gg/callback.php


//네이버
define('NV_CONSUMER_KEY', 'st8Hsf10c_OAXmHMXUMh');
define('NV_CONSUMER_SECRET', 'Vy2RPoxSou');
define('NV_LOGIN', G5_PLUGIN_URL.'/social_login/naver/login.php');
define('NV_OAUTH_CALLBACK', G5_PLUGIN_URL.'/social_login/naver/naverlogin.php'); //http://Your HOMEPAGE/plugin/social_login/tw/callback.php

//다음넷
define('DAUM_CONSUMER_KEY', '');
define('DAUM_CONSUMER_SECRET', '');
define('DAUM_LOGIN', G5_PLUGIN_URL.'/social_login/daum/daumlogin.php');
define('DAUM_CALLBACK_URL', G5_PLUGIN_URL.'/social_login/daum/daumlogin.php'); //http://Your 

define('SL_PASSWORD', '$z!'); //소셜로그인 패스워드

define('SL_MB_LEVEL', '2');
define('SL_MB_MAILLING', '1');
define('SL_MB_SMS', '0');
define('SL_MB_OPEN', '1');
define('SL_MB_ADULT', '0');

//id중복체크
function sl_id_check($id)
{
	global $g5;
	$tid = $id.mt_rand(100000000000000,1000000000000000);

	$row = sql_fetch(" select count(*) as cnt from {$g5['member_table']} where mb_id = '".$id."' ");
    if ($row['cnt']) { return sl_id_check($tid); }
	else return $id;
}

//닉네임중복체크
//홈페이지 자체 가입유저와 소셜가입유저는 철저히 분리하므로 중복체크가 불필요
//로그인시 홈페이지 자체로그인으로는 소셜가입유저는 로그인을 막아야됨
//그렇지 않으면 충돌 발생 가능성 농후

function sl_nick_check($ndata)
{
	global $g5;

	//같은 SNS 계정에 동일한 닉네임이 있으면 이때는 중복을 피하기 위해 임의 숫자를 붙여주고 추후 수정가능하게 해줌

    $row = sql_fetch(" select count(*) as cnt from {$g5['member_table']} where mb_nick = '".$ndata['nick']."' and mb_10='".$ndata['sns']."'");
    if ($row['cnt']) {
		
		$ndata['nick']=$ndata['nick'].mt_rand(10,100);
		$ndata['sns'] = $ndata['sns'];

		return sl_nick_check($ndata);

	}
	else return $ndata['nick'];
}

function sl_sns($type)
{
	if ($type == 'tw')
		return '트위터';
	else if ($type == 'fb')
		return '페이스북';
	else if ($type == 'gg')
		return '구글';
	else if ($type == 'naver')
		return '네이버';
	else if ($type == 'kakao')
		return '카카오';
	else if ($type == 'daum')
		return '다음';
}

function sl_register($mb)
{
	global $g5;
	
	if (!$mb) return FALSE;
	
	$sql = " insert into {$g5['member_table']}
					set mb_id = '".$mb['mb_id']."',
						mb_password = '".sql_password($mb['mb_password'])."',
						mb_name = '".$mb['mb_name']."',
						mb_nick = '".$mb['mb_nick']."',
						mb_email = '".$mb['mb_email']."',
						mb_homepage = '".$mb['mb_homepage']."',
						mb_profile = '".$mb['mb_profile']."',
						mb_today_login = '".G5_TIME_YMDHIS."',
						mb_datetime = '".G5_TIME_YMDHIS."',
						mb_ip = '".$_SERVER['REMOTE_ADDR']."',
						mb_level = '".SL_MB_LEVEL."',
						mb_login_ip = '".$_SERVER['REMOTE_ADDR']."',
						mb_mailling = '".SL_MB_MAILLING."',
						mb_sms = '".SL_MB_SMS."',
						mb_open = '".SL_MB_OPEN."',
						mb_open_date = '".G5_TIME_YMD."',
						mb_adult = '".SL_MB_ADULT."',
						".SL_PROFILE_IMAGE2_FIELD." = '".$mb['mb_7']."',
						".SL_PROFILE_IMAGE_FIELD." = '".$mb['mb_8']."',
						".SL_ID_FIELD." = '".$mb['mb_9']."',
						".SL_TYPE_FIELD." = '".$mb['mb_10']."',
						mb_email_certify = '".G5_TIME_YMDHIS."' ";
	sql_query($sql);
	return TRUE;
}

function sl_login($id, $sns)
{
	global $g5;
    global $config;
    
	$row = sql_fetch(" select mb_id from {$g5['member_table']} where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = '".$sns."' ");
	$mb = get_member($row['mb_id']);
	
	set_session('ss_mb_id', $mb['mb_id']); //회원아이디 세션 생성
	set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'])); //XSS 공격
	if($config['cf_use_point']) { //포인트 체크
	    $sum_point = get_point_sum($mb['mb_id']);
	    $sql= " update {$g5['member_table']} set mb_point = '$sum_point' where mb_id = '{$mb['mb_id']}' ";
	    sql_query($sql);
	}
}


function newpassword()
{
//신규가입시 임시 비밀번호를 만듬.

$random_string="";

$random_string .= chr(rand(0,25)+65);
$random_string .= chr(rand(0,25)+97);
$random_string .= chr(rand(0,25)+97);
$random_string .= chr(rand(0,25)+65);
$random_string .= rand(0,9);  
$random_string .= rand(0,9);  
$random_string .= rand(0,9);  
$random_string .= rand(0,9);  

return $random_string;
}


if ($_SESSION['sl_sns']){ //소셜로그인중이라면
	if ($member['mb_datetime'] == $member['mb_today_login']) //날짜
		insert_point($_SESSION['ss_mb_id'], $config['cf_register_point'], '회원가입 축하!', '@member', $_SESSION['ss_mb_id'], '회원가입'); //회원가입 포인트 부여
}


?>
