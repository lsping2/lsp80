<?php
ini_set("display_errors","on");
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

//ver1.0 150517 @_untitle_d


require_once(G5_PLUGIN_PATH.'/social_login/fb/facebook.php');

$config = array(
	'appId' => FB_CONSUMER_KEY,
	'secret' => FB_CONSUMER_SECRET
);

$facebook = new Facebook($config);

$access_token = $facebook->getAccessToken();

$users = $facebook->getUser();

if ($users){
	try{

        $content = $facebook->api('/me');
		//print_r($content);
		//exit;
		
		$str = "<a href='".$content['link']."' target='_blank'>".$content['first_name']."</a>
				<font style='color:#c5c5c5'>(".($content['gender']=='female'?'♀':'♂').")</font><br>
				<font style='color:#a1a1a1'>".str_replace('@', ' (at) ', $content['email'])."</font>";
		
		
		$profile_image = 'https://graph.facebook.com/'.$content['id'].'/picture';

		$row = sql_fetch(" select count(*) as cnt from {$g5['member_table']} where ".SL_ID_FIELD." = '".$content['id']."' and ".SL_TYPE_FIELD." = 'fb' ");
		if ($row['cnt']){

			$row = sql_fetch(" select * from `{$g5['member_table']}` where ".SL_ID_FIELD." = '".$content['id']."' and ".SL_TYPE_FIELD." = 'fb'");
		
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
			sl_login($content['id'], 'fb');

			//소셜로그인
			set_session('sl_id', $content['id']);
			set_session('sl_sns', 'fb');
			set_session('sl_str', $str);
			set_session('sl_picture', $profile_image);
		
			//페이스북은 썸네일 프로필 이미지가 없습니다.
			//따라서 썸네일이미지를 만들어서 저장하거나 패스하여야 합니다.
			//GD를 사용하지 않거나 썸네일이 필요없으면 아래 콜함수 제거

			$thumbnail_image = thumbnail_set($profile_image,$content['id'],$mb_img_width,$mb_img_height);

			$SLThumbUp = SL_UPDATE_THUMBNAIL;
			
			if($SLThumbUp) 
				$imgup = sql_fetch("update {$g5['member_table']} set  ".SL_PROFILE_IMAGE2_FIELD."='".$thumbnail_image."',".SL_PROFILE_IMAGE_FIELD."= '".$profile_image."' where ".SL_ID_FIELD." = '".$content['id']."' and ".SL_TYPE_FIELD." = 'fb'");
			else
				$imgup = sql_fetch("update {$g5['member_table']} set ".SL_PROFILE_IMAGE_FIELD."= '".$profile_image."' where ".SL_ID_FIELD." = '".$content['id']."' and ".SL_TYPE_FIELD." = 'fb'");

			echo "<script>
				opener.document.location.href='/';
				window.close();
				</script>";
			
			
			
		}else{
			
			if($content['email'] && (SL_CHECK_EMAIL == "1")) {
				$row = sql_fetch(" select count(*) as cnt from `{$g5['member_table']}` where mb_email = '".$content['email']."' ");
		    	if ($row['cnt']) alert('이미 사용중인 E-mail 주소입니다.', '/');
			}
			
			$row = sql_fetch(" select * from `{$g5['member_table']}` where ".SL_ID_FIELD." = '".$content['id']."' and ".SL_TYPE_FIELD." = 'fb'");
		
			if($row['mb_id']) {
            
			    if ($row[mb_intercept_date] && $row[mb_intercept_date] <= date("Ymd", G5_SERVER_TIME)) {
				    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $row[mb_intercept_date]); 
					alert_close("회원님의 아이디는 접근이 금지되어 있습니다.\\n\\n차단일 : $date");
	            }
	
		        if ($row[mb_leave_date] && $row[mb_leave_date] <= date("Ymd",G5_SERVER_TIME)) {
			        $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $row[mb_leave_date]); 
				    alert_close("탈퇴한 아이디이므로 가입을 하실 수 없습니다.\\n\\n탈퇴일 : $date");
	            }

			}
			//페이스북은 썸네일 프로필 이미지가 없습니다.
			//따라서 썸네일이미지를 만들어서 저장하거나 패스하여야 합니다.
			//GD를 사용하지 않거나 썸네일이 필요없으면 아래 콜함수 제거

			$thumbnail_image = thumbnail_set($profile_image,$content['id'],$mb_img_width,$mb_img_height);
			
			$ndata = array(
				"nick"=>str_replace(' ', '', $content['first_name']),
				"sns"=>"fb"
			);

			$fb_user = array(
				'mb_id' => sl_id_check($content['id']),
				'mb_password' => SL_PASSWORD.$content['id'],
				'mb_email' => $content['email'],
				'mb_name' => str_replace(' ', '', $content['name']),
				'mb_nick' => sl_nick_check($ndata),
				'mb_homepage' => $content['link'],
				SL_PROFILE_IMAGE2_FIELD => $thumbnail_image,
				SL_PROFILE_IMAGE_FIELD => $profile_image, 
				SL_ID_FIELD => $content['id'], 
				SL_TYPE_FIELD => 'fb'
			);
			
			$result = sl_register($fb_user); //회원가입
			if ($result){
				
				sl_login($content['id'], 'fb');
				
				//소셜로그인
				set_session('sl_id', $content['id']);
				set_session('sl_sns', 'fb');
				set_session('sl_str', $str);
				set_session('sl_picture', 'https://graph.facebook.com/'.$content['id'].'/picture');
//				goto_url(G5_BBS_URL.'/member_confirm.php');
				echo "<script>
				opener.document.location.href='".G5_BBS_URL."/sns_confirm.php';
				window.close();
				</script>";

			}
		}
		
		


    }catch(FacebookApiException $e) {
        error_log($e);
        $user = NULL;
    }
}else{
	//die('Error');
	print_r($users);
//	header('Location: /'); 
exit;
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

	if(!is_dir(G5_DATA_PATH."/member_image/fb"))
		@mkdir(G5_DATA_PATH."/member_image/fb",G5_DIR_PERMISSION);

	if(!is_dir(G5_DATA_PATH."/member_image/fb/".substr($mbid,0,2)))
		@mkdir(G5_DATA_PATH."/member_image/fb/".substr($mbid,0,2),G5_DIR_PERMISSION);

	$savePath = G5_DATA_PATH."/member_image/fb/".substr($mbid,0,2)."/".$mbid.".jpg";
	$tpath = G5_DATA_PATH."/member_image/fb/".substr($mbid,0,2);
	$saveURL = G5_DATA_URL."/member_image/fb/".substr($mbid,0,2)."/";

	$fd = fopen($tmpPath, 'w');
	fwrite($fd, $st);
	fclose($fd);

	curl_close($ch);

	$iinfo = getimagesize($tmpPath);

	if($iinfo[0] && $iinfo[1]) { //이미지맞음
		
			if(((int)$iinfo[0]) <= ((int)$thumb_width) || ((int)$iinfo[1]) <= ((int)$thumb_height)) {
				@unlink($tmpPath);	
				return $imgurl;
			}
	 $filename = $mbid.".jpg";
	 $filepath = G5_DATA_PATH;

	 $tname = thumbnail($filename, $filepath, $tpath, $thumb_width, $thumb_height, true, true, "center", false, '80/0.5/3');
	 
	 if($tname) {
		 @unlink($tmpPath);
		return $saveURL.$tname;
	 }
	 else
		 @unlink($tmpPath);
		return $imgurl;
	}
	 else //이미지 아님
		 @unlink($tmpPath);
		 return $imgurl;

}


?>