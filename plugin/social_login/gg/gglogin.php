<?php
include_once("./_common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

//ver1.0 150517 @_untitle_d


require_once(G5_PLUGIN_PATH.'/social_login/gg/src/Google_Client.php');
require_once(G5_PLUGIN_PATH.'/social_login/gg/src/contrib/Google_Oauth2Service.php');


$client = new Google_Client();


$oauth2 = new Google_Oauth2Service($client);

if (isset($_GET['code'])) {
	$client->authenticate($_GET['code']);
	$_SESSION['token'] = $client->getAccessToken();
	$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
	return;
}
if (isset($_SESSION['token'])) {
	$client->setAccessToken($_SESSION['token']);
}
if (isset($_REQUEST['logout'])) {
	unset($_SESSION['token']);
	$client->revokeToken();
}
if ($_GET['error'] == 'access_denied'){
	header('Location: /'); 
    break;
}

if ($client->getAccessToken()) {

	$content = $oauth2->userinfo->get();
	
	$str = "<a href='".$content['link']."' target='_blank'>+".$content['given_name']."</a>
			<font style='color:#c5c5c5'>(".($content['gender']=='male'?'♂':'♀').")</font><br>
			<font style='color:#a1a1a1'>".str_replace('@', ' (at) ', $content['email'])."</font>";
	
	$SLType = SL_TYPE_FIELD;
	$SLThumb = SL_PROFILE_IMAGE2_FIELD;
	$SLImg = SL_PROFILE_IMAGE_FIELD;
	$SLID = SL_ID_FIELD;

	$profile_image = $content["picture"];
	$email = $content["email"];
	if($content["gender"] == "male")
		$gender = "M";
	else
		$gender= "F";
	$name = $content["name"];
	$nick = $content["given_name"];

	$row = sql_fetch(" select count(*) as cnt from {$g5['member_table']} where {$SLID} = '".$content['id']."' and ".$SLType." = 'gg' ");
	if ($row['cnt']){

		$mdata = sql_fetch(" select * from `{$g5['member_table']}` where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = 'gg'");
		
		if($mdata['mb_id']) {
            
			    if ($mdata[mb_intercept_date] && $mdata[mb_intercept_date] <= date("Ymd", G5_SERVER_TIME)) {
				    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mdata[mb_intercept_date]); 
					alert_close("회원님의 아이디는 접근이 금지되어 있습니다.\\n\\n차단일 : $date");
	            }
	
		        if ($mdata[mb_leave_date] && $mdata[mb_leave_date] <= date("Ymd",G5_SERVER_TIME)) {
			        $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mdata[mb_leave_date]); 
				    alert_close("탈퇴한 아이디이므로 로그인을 하실 수 없습니다.\\n\\n탈퇴일 : $date");
	            }

		}

		sl_login($content['id'], 'gg');
		
		//소셜로그인
		set_session('sl_id', $content['id']);
		set_session('sl_sns', 'gg');
		set_session('sl_str', $str);
		set_session('sl_picture', $content['picture']);
		
		//이미지 업데이트
		$SLThumbUp = SL_UPDATE_THUMBNAIL;

		if($SLThumbUp) {
			$thumbnail_image = thumbnail_set($profile_image,$content['id'],$mb_img_width,$mb_img_height);

			$imgup = sql_fetch("update {$g5['member_table']} set ".SL_PROFILE_IMAGE2_FIELD." = '".$thumbnail_image."',".SL_PROFILE_IMAGE_FIELD."='".$profile_image."' where ".SL_ID_FIELD." = '".$content["id"]."' and ".SL_TYPE_FIELD." = 'gg' ");
		}
		else
			$imgup = sql_fetch("update {$g5['member_table']} set ".SL_PROFILE_IMAGE_FIELD."='".$profile_image."' where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = 'gg' "); //썸네일업데이트 제한시 일반 이미지만 업데이트

		//goto_url('/');
		//로그인처리후 부모창에서 메인페이지로 이동
		echo "<script>
				opener.document.location.href='/';
				window.close();
				</script>";
		
		
				exit;		
		
		
		
	}else{
		
		$SLCMail = SL_CHECK_EMAIL;

		if($SLCMail && $email) {
			$row = sql_fetch(" select count(*) as cnt from `{$g5['member_table']}` where mb_email = '".$content['email']."' ");
			if ($row['cnt']) alert('이미 사용중인 E-mail 주소입니다.', '/');
		}
		$mdata = sql_fetch(" select * from `{$g5['member_table']}` where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = 'gg'");
		
		if($mdata['mb_id']) {
            
			    if ($mdata[mb_intercept_date] && $mdata[mb_intercept_date] <= date("Ymd", G5_SERVER_TIME)) {
				    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mdata[mb_intercept_date]); 
					alert_close("회원님의 아이디는 접근이 금지되어 있습니다.\\n\\n차단일 : $date");
	            }
	
		        if ($mdata[mb_leave_date] && $mdata[mb_leave_date] <= date("Ymd",G5_SERVER_TIME)) {
			        $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mdata[mb_leave_date]); 
				    alert_close("탈퇴한 아이디이므로 가입을 하실 수 없습니다.\\n\\n탈퇴일 : $date");
	            }

		}

		$thumbnail_image = thumbnail_set($profile_image,$content['id'],$mb_img_width,$mb_img_height);

		$ndata = array(
			"nick" => str_replace(' ', '', $nick),
			"sns" => "gg"
		);

		$gg_user = array(
			'mb_id' => sl_id_check($content["id"]),
			'mb_password' => SL_PASSWORD.$content['id'],
			'mb_email' => $email,
			'mb_name' => str_replace(' ', '', $name),
			'mb_nick' => sl_nick_check($ndata),
			'mb_homepage' => $content['link'],
			SL_PROFILE_IMAGE2_FIELD => $thumbnail_image,
			SL_PROFILE_IMAGE_FIELD => $profile_image, 
			SL_ID_FIELD => $content['id'], 
			SL_TYPE_FIELD => 'gg'
		);
		
		$result = sl_register($gg_user); //회원가입
		if ($result){
			
			sl_login($content['id'], 'gg');
			
			//소셜로그인
			set_session('sl_id', $content['id']);
			set_session('sl_sns', 'gg');
			set_session('sl_str', $str);
			set_session('sl_picture', $content['picture']);
			echo "<script>
				opener.document.location.href='".G5_BBS_URL."/sns_confirm.php';
				window.close();
				</script>";
		}
	}	




}else{
	//die('Error');
	$authUrl = $client->createAuthUrl();
	header('Location: '.$authUrl);
	break;
}
function thumbnail_set($imgurl,$mbid,$thumb_width,$thumb_height) {

	if(!$imgurl || (substr($imgurl,0,4))!="http") {

		return false;
	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $imgurl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$st = curl_exec($ch);
	
	$tmpPath = G5_DATA_PATH."/".$mbid.".jpg";

	if(!is_dir(G5_DATA_PATH."/member_image"))
		@mkdir(G5_DATA_PATH."/member_image",G5_DIR_PERMISSION);

	if(!is_dir(G5_DATA_PATH."/member_image/gg"))
		@mkdir(G5_DATA_PATH."/member_image/gg",G5_DIR_PERMISSION);

	if(!is_dir(G5_DATA_PATH."/member_image/gg/".substr($mbid,0,2)))
		@mkdir(G5_DATA_PATH."/member_image/gg/".substr($mbid,0,2),G5_DIR_PERMISSION);

	$savePath = G5_DATA_PATH."/member_image/gg/".substr($mbid,0,2)."/".$mbid.".jpg";
	$tpath = G5_DATA_PATH."/member_image/gg/".substr($mbid,0,2);
	$saveURL = G5_DATA_URL."/member_image/gg/".substr($mbid,0,2)."/";

	$fd = fopen($tmpPath, 'w');
	fwrite($fd, $st);
	fclose($fd);

	curl_close($ch);

	$iinfo = getimagesize($tmpPath);

	if($iinfo[0] && $iinfo[1]) { //이미지맞음
	
	 $filename = $mbid.".jpg";
	 $filepath = G5_DATA_PATH;

	 $tname = thumbnail($filename, $filepath, $tpath, $thumb_width, $thumb_height, true, true, "center", false, '80/0.5/3');
	 
	 if($tname) {
		 @unlink($tmpPath);
		return $saveURL.$tname;
	 }
	 else
		 @unlink($tmpPath);
		 return "";
	}
	else //이미지 아님
		@unlink($tmpPath);
		return "";
}
	
?>