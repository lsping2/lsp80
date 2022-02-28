<?php
include_once('./_common.php');

if ($is_guest)
    alert('회원만 이용하실 수 있습니다.');



if(!$member[mb_id])
	alert('회원만 이용가능합니다.');

$SLType = SL_TYPE_FIELD;
$SLID = SL_ID_FIELD;

if($member[$SLType] != "naver" && $member[$SLType] != "tw" && $member[$SLType] != "fb" && $member[$SLType] != "kakao" && $member[$SLType] != "daum" && $member[$SLType] != "gg") {
	alert('소셜로그인 사용자만 이용하실수 있습니다.');
}


$email = $_POST["mb_email"];

if(!$email)
	alert('이메일주소가 정상적으로 전달되지 않았습니다.');
	

	$row = sql_fetch("select mb_email from {$g5['member_table']} where ".$SLID."='".$member[$SLID]."' and ".$SLType."='".$member[$SLType]."'");

	if($row['mb_email'])
		alert('귀 사용자님은 이미 이메일주소가 등록되어있습니다. 변경을 원하시면 [정보수정]에서 수정가능합니다..');


	$sql = "update {$g5['member_table']} set mb_email='".$email."' where mb_no='".$member[mb_no]."'";

	sql_query($sql);
	alert('정상적으로 수정되었습니다.','/');


?>