<?php
ini_set('display_errors', 'on'); 
//include_once('./_common.php');
if(!defined('_GNUBOARD_')) exit; //개별페이지 접근불가
/*if ($is_guest)
    alert('로그인 한 회원만 접근하실 수 있습니다.', G5_BBS_URL.'/login.php');
*/
/*
if ($url)
    $urlencode = urlencode($url);
else
    $urlencode = urlencode($_SERVER[REQUEST_URI]);
*/

$mbid = get_session("ss_mb_id");

//$member = get_member($mbid);
$g5['title'] = '소셜가입 확인';
include_once('./_head.sub.php'); //헤더연결 필요없으면 주석
$SLType = SL_TYPE_FIELD;
$SLID = SL_ID_FIELD;
$SLThumb = SL_PROFILE_IMAGE2_FIELD;


?>
<script>
</script>
<form name="umfrm" method="post" action="sns.member.update.php" onsubmit="return checkfrm(this.form);">
<input type="hidden" name="sns" value="tw">

<table cellspacing="0" style="border-collapse:collapse;" width="70%" align="center">
                                <tr>
 <td style="border-top-width:1px; border-right-width:0; border-bottom-width:1px; border-left-width:0; border-color:rgb(153,153,153); border-top-style:solid; border-right-style:none; border-bottom-style:solid; border-left-style:none;" valign="top">
								  <table cellspacing="0" style="border-collapse:collapse;" width="100%">
<tr>
    <td width="" style="border-width:0; border-color:black; border-style:none;"><p><BR><img src="<?=$member[$SLThumb]?>" border=1 align="absmiddle" width="150" height="150"><BR></p></td>
</tr>
<tr>
    <td style="border-width:0; border-color:black; border-style:none;">
     <p><span style="font-size:9pt;"><br><br><font color="black"><b>닉네임:</b></font> <font color="#3333FF"><?=$member['mb_nick']?></font><br><br><b><font color="black">이메일:</font></b> 
<?

	 if($member['mb_email']) {
	 ?>
	 <font color="#006666"><?=$member['mb_email']?></font>
	 <?
	 }
	 else {
	?>
	<BR><input type="text" name="mb_email" style="border-width:1px; border-color:rgb(102,102,102); border-style:dotted;width:160px;" required>
	<?
	 }
	?>
</span></p>
</td>
</tr>
      </table>
</td>
  <td style="border-top-width:1px; border-right-width:0; border-bottom-width:1px; border-left-width:0; border-color:rgb(153,153,153); border-top-style:solid; border-right-style:none; border-bottom-style:solid; border-left-style:none;" valign="top">
									<p><span style="font-size:9pt;"><b><font color="black"><br><?=$member['mb_nick']?>님!! </font></b><font color="#666666">환영합니다 ^^</font></span></p>

 <p><b><font color="#CC0000"><span style="font-size:9pt;">&lt;동의사항&gt;</span></font></b><span style="font-size:9pt;"><font color="#666666"><br><br>&nbsp;</font><font color="black">본 사이트(이하 '</font><font color="blue">단지</font><font color="black">')에서는 </font><font color="#CC0066"><b>소셜로그인을 처음 사용시</b></font><font color="black"><br> &nbsp;회원님의 소셜정보중 일부(</font><font color="#990000">고유식별번호, 닉네임, <br>프로필이미지</font><font color="black">)를 소셜사이트로부터 전달받아 </font><b><font color="#990000">저장</font></b><font color="black">하고 있습니다. <br></font><font color="#336666">(소셜사이트마다 정보제공이 다를 수 있습니다.)</font><font color="black"><br>이는 청연에서 사용자님간의 식별 및 사이트내에 사용자님에 대한<br>표현을 위한 최소의 수단이기 때문입니다.<br></font></span><font color="black"><span style="font-size:9pt;"><br>만약, 이를 원하지 않으실 경우 언제든 </span></font><span style="font-size:9pt;"><font color="#CC0000"><b>회원정보수정-&gt;회원탈퇴</b></font></span><font color="black"><span style="font-size:9pt;">를 이용하여 개인정보를 삭제토록 할 수 있습니다.<br>이때는 청연에서의 일부 이용이 제한적이 될 수 있습니다.<br><br></span></font><span style="font-size:9pt;"><font color="#6666FF">이 메시지를 확인하신후 3일 이내에 별도의 의사표시가 없거나 <br>회원탈퇴를 통하여 회원님의 정보 저장을 거부하겠다는 <br>표현을 하지 않으시면 위 내용에 이의가 없이&nbsp;동의하신 것으로 간주합니다.</font></span></p>


</td>
    </tr>
                                <tr>
  <td style="border-top-width:1px; border-right-width:0; border-bottom-width:0; border-left-width:0; border-color:rgb(153,153,153); border-top-style:solid; border-right-style:none; border-bottom-style:none; border-left-style:none;">&nbsp;</td>
  <td style="border-top-width:1px; border-right-width:0; border-bottom-width:0; border-left-width:0; border-color:rgb(153,153,153); border-top-style:solid; border-right-style:none; border-bottom-style:none; border-left-style:none;">
  <p align="right">
  <?
  if(!$member['mb_email']) {
  ?>
  <input type="submit" name="okMod" value="< 회원정보수정 >" style="font-weight:bolder; color:red; background-color:white; border-color:black; border-style:none;width:110px; height:30px;font-size:12px;cursor:pointer;"> &nbsp;&nbsp;
  <?
}
 ?>
  <input type="button" name="OkBak" value="< 메인으로.. >" style="font-weight:bolder; color:rgb(51,102,204); background-color:white; border-color:black; border-style:none; width:110px; height:30px;font-size:12px;cursor:pointer;" onclick="javascript:document.location.href='/';"></p>
</td>
    </tr>
</table>
<script>
function checkfrm(f)
{

	if(!f.mb_email.value) {
		alert("이메일주소를 입력하세요..");
		return;
	}

}
</script>
<?
?>