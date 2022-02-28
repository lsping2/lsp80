<?php
ini_set("display_errors","on");
include_once("./_common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

//ver1.0 150517 @_untitle_d


/* Start session and load library. */
require_once(G5_PLUGIN_PATH.'/social_login/tw/twitteroauth.php');

/* If the oauth_token is old redirect to the connect page. */
if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
    $_SESSION['oauth_status'] = 'oldtoken';
	$url = G5_BBS_URL.'/logout.php';
    header('Location: '.$url);
}

/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$connection = new TwitterOAuth(TW_CONSUMER_KEY, TW_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

/* Request access tokens from twitter */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

/* Save the access tokens. Normally these would be saved in a database for future use. */
$_SESSION['access_token'] = $access_token;

/* Remove no longer needed request tokens */
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

if (200 == $connection->http_code) {
    $content  = $connection->get('account/verify_credentials');
	//print_r($content);
	//exit;
	$str = "";
	$str.= $content->name."<br><a href='http://twitter.com/".$content->screen_name."' target='_blank'>@".$content->screen_name."</a>";
	//if ($content->location) $str .= "<br><font style='color:#a1a1a1'>".$content->location."</font>";
	if ($content->description) $str .= "<br><font style='color:#a1a1a1'>".$content->description."</font>";
	//if ($content->url) $str .= "<br><font style='color:#a1a1a1'><a href='".$content->url."' target='_blank'>".$content->url."</a></font>";
	
	$profile_img = str_replace("_normal","",$content->profile_image_url);
	
	
	$row = sql_fetch(" select count(*) as cnt from {$g5['member_table']} where ".SL_ID_FIELD." = '".$content->id."' and ".SL_TYPE_FIELD." = 'tw' ");
	if ($row['cnt']){
		
		$row = sql_fetch(" select * from `{$g5['member_table']}` where ".SL_ID_FIELD." = '".$content->id."' and ".SL_TYPE_FIELD." = 'tw'");
		
		if($row['mb_id']) {
            
			    if ($row[mb_intercept_date] && $row[mb_intercept_date] <= date("Ymd", G5_SERVER_TIME)) {
				    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $row[mb_intercept_date]); 
					alert_close("회원님의 아이디는 접근이 금지되어 있습니다.\\n\\n차단일 : $date");
	            }
	
		        if ($row[mb_leave_date] && $row[mb_leave_date] <= date("Ymd",G5_SERVER_TIME)) {
			        $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $row[mb_leave_date]); 
				    alert_close("탈퇴한 아이디이므로 로그인을 하실 수 없습니다.\\n\\n탈퇴일 : $date");
	            }

		}
		sl_login($content->id, 'tw');
		
			//페이스북은 썸네일 프로필 이미지가 없습니다.
			//따라서 썸네일이미지를 만들어서 저장하거나 패스하여야 합니다.
			//GD를 사용하지 않거나 썸네일이 필요없으면 아래 콜함수 제거

			$thumbnail_image = thumbnail_set($profile_img,$content->id,$mb_img_width,$mb_img_height);

		//소셜로그인
		set_session('sl_id', $content->id);
		set_session('sl_sns', 'tw');
		set_session('sl_str', $str);
		set_session('sl_thumbnail', $thumbnail_image);
		set_session('sl_picture', $profile_img);

		//이미지 업데이트
		$SLThumbUp = SL_UPDATE_THUMBNAIL;
		if($SLThumbUp) 
			$row = sql_fetch("update {$g5['member_table']} set ".SL_PROFILE_IMAGE2_FIELD."='".$thumbnail_image."',".SL_PROFILE_IMAGE_FIELD."='".$profile_img."' where ".SL_ID_FIELD." = '".$content->id."' and ".SL_TYPE_FIELD." = 'tw' ");
		else
			$row = sql_fetch("update {$g5['member_table']} set ".SL_PROFILE_IMAGE_FIELD."='".$profile_img."' where ".SL_ID_FIELD." = '".$content->id."' and ".SL_TYPE_FIELD." = 'tw' ");

//		goto_url('/');
		echo "<script>
				opener.document.location.href='/';
				window.close();
				</script>";
		
		
		
	}else{
		
		//$row = sql_fetch(" select count(*) as cnt from `{$g5['member_table']}` where mb_email = '".$content['email']."' ");
    	//if ($row['cnt']) alert('이미 사용중인 E-mail 주소입니다.', '/');

			//페이스북은 썸네일 프로필 이미지가 없습니다.
			//따라서 썸네일이미지를 만들어서 저장하거나 패스하여야 합니다.
			//GD를 사용하지 않거나 썸네일이 필요없으면 아래 콜함수 제거

		$row = sql_fetch(" select * from `{$g5['member_table']}` where ".SL_ID_FIELD." = '".$content->id."' and ".SL_TYPE_FIELD." = 'tw'");
		
		if($row['mb_id']) {
            
			    if ($row[mb_intercept_date] && $row[mb_intercept_date] <= date("Ymd", G5_SERVER_TIME)) {
				    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $row[mb_intercept_date]); 
					alert_close("회원님의 아이디는 접근이 금지되어 있습니다.\\n\\n차단일 : $date");
	            }
	
		        if ($row[mb_leave_date] && $row[mb_leave_date] <= date("Ymd",G5_SERVER_TIME)) {
			        $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $row[mb_leave_date]); 
				    alert_close("탈퇴한 아이디이므로 회원가입을 하실 수 없습니다.\\n\\n탈퇴일 : $date");
	            }

		}

		$thumbnail_image = thumbnail_set($profile_img,$content->id,$mb_img_width,$mb_img_height);

		$nickname = str_replace(' ', '', $content->name);
		$ndata = array(
			"nick" => $nickname,
			"sns" => "tw"
		);

		$tw_user = array(
			'mb_id' => sl_id_check($content->id),
			'mb_password' => SL_PASSWORD.$content->id,
			'mb_name' => str_replace(' ', '', $content->screen_name),
			'mb_nick' => sl_nick_check($ndata),
			'mb_homepage' => $content->url,
			SL_PROFILE_IMAGE2_FIELD => $thumbnail_image,
			SL_PROFILE_IMAGE_FIELD => $profile_img, 
			SL_ID_FIELD => $content->id, 
			SL_TYPE_FIELD => 'tw'
		);
		
		$result = sl_register($tw_user); //회원가입
		if ($result){
			
			sl_login($content->id, 'tw');
			
			//소셜로그인
			set_session('sl_id', $content->id);
			set_session('sl_sns', 'tw');
			set_session('sl_str', $str);
			set_session('sl_thumbnail', $thumbnail_image);
			set_session('sl_picture', $profile_img);
//			goto_url(G5_BBS_URL.'/member_confirm.php');
		echo "<script>
				opener.document.location.href='".G5_BBS_URL."/sns_confirm.php';
				window.close();
				</script>";

		}
	}




}else{
	//die('Error');
	header('Location: /'); 
    break;
}

function thumbnail_set($imgurl,$mbid,$thumb_width,$thumb_height) {

	if(!$imgurl || (substr($imgurl,0,4))!="http") {

		return "없음";
	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $imgurl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$st = curl_exec($ch);
	
	$tmpPath = G5_DATA_PATH."/".$mbid.".jpg";

	if(!is_dir(G5_DATA_PATH."/member_image"))
		@mkdir(G5_DATA_PATH."/member_image",G5_DIR_PERMISSION);

	if(!is_dir(G5_DATA_PATH."/member_image/tw"))
		@mkdir(G5_DATA_PATH."/member_image/tw",G5_DIR_PERMISSION);

	if(!is_dir(G5_DATA_PATH."/member_image/tw/".substr($mbid,0,2)))
		@mkdir(G5_DATA_PATH."/member_image/tw/".substr($mbid,0,2),G5_DIR_PERMISSION);

	$savePath = G5_DATA_PATH."/member_image/tw/".substr($mbid,0,2)."/".$mbid.".jpg";
	$tpath = G5_DATA_PATH."/member_image/tw/".substr($mbid,0,2);
	$saveURL = G5_DATA_URL."/member_image/tw/".substr($mbid,0,2)."/";

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