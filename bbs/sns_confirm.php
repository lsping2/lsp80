<?php
ini_set('display_errors', 'on'); 
include_once('./_common.php');

/*if ($is_guest)
    alert('로그인 한 회원만 접근하실 수 있습니다.', G5_BBS_URL.'/login.php');
*/
/*
if ($url)
    $urlencode = urlencode($url);
else
    $urlencode = urlencode($_SERVER[REQUEST_URI]);
*/

$isns = get_session("sl_sns");

include_once("./_head.sub.php");

switch($isns)
{
	case "naver":

		include_once(G5_BBS_PATH."/sns.naver.confirm.php");
		break;

	case "tw": //트위터

		include_once(G5_BBS_PATH."/sns.tw.confirm.php");
		break;

	case "fb": //페이스북

		include_once(G5_BBS_PATH."/sns.fb.confirm.php");
		break;

	case "kakao": //카카오

		include_once(G5_BBS_PATH."/sns.kakao.confirm.php");
		break;

	case "daum":

		include_once(G5_BBS_PATH."/sns.daum.confirm.php");
		break;
	case "gg":

		include_once(G5_BBS_PATH."/sns.google.confirm.php");
		break;

}

include_once('./_tail.sub.php');
?>