<?php
 ini_set('display_errors', 'on'); 
include_once("./_common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

//ver1.0 150517 @_untitle_d

/*
require_once(G5_PLUGIN_PATH.'/social_login/naver/src/naver_client.php');
require_once(G5_PLUGIN_PATH.'/social_login/naver/src/contrib/naver_Oauth2Service.php');

$client = new Naver_Client();

$oauth2 = new Naver_Oauth2Service($client);

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
*/

require_once(G5_PLUGIN_PATH.'/social_login/naver/naver_fun.php');

$naver = new Naver(array(
        "CLIENT_ID" => NV_CONSUMER_KEY,        // (*필수)클라이언트 ID  
        "CLIENT_SECRET" => NV_CONSUMER_SECRET,    // (*필수)클라이언트 시크릿
        "RETURN_URL" => G5_PLUGIN_URL."/social_login/naver/naverlogin.php"    // (*필수)콜백 URL
        )
    );

if($is_member)
	alert_close("이미 로그인되어 있습니다.");

if ($naver->getAccessToken()) {
	$contents = $naver->GetUserProfile("XML");

//	$this->load->library('simplexml');

//	$xmlData = $this->simplexml->xml_parse($contents);

		$xml = simplexml_load_string ($contents);
	
		if ( $xml->result->resultcode != '00' )
			$this->error ($r->result->message);

		$xmlr = &$xml->response;

	$content['email'] = (string) $xmlr->email->{0};

   $content['name'] = (string) $xmlr->name->{0}; //추후 네이버에서 지원한다고 함

   $content['nickname'] = (string) $xmlr->nickname->{0};

//   $content['enc_id'] = (string) $xmlr->enc_id->{0};

   $content['profile_image'] = (string) $xmlr->profile_image->{0};

   $content['age'] = (string) $xmlr->age->{0};

   $content['birthday'] = (string) $xmlr->birthday->{0};

   $content['gender'] = (string) $xmlr->gender->{0};
	
	$content['link'] = G5_BBS_URL."/member_info.php";

	$ids = explode("@",$content['email']);
	$content['id'] = $ids[0];

	$str = "<a href='".$content['link']."' target='_blank'>+".$content['nickname']."</a>
			<font style='color:#c5c5c5'>(".($content['gender']=='M'?'♂':'♀').")</font><br>
			<font style='color:#a1a1a1'>".str_replace('@', ' (at) ', $content['email'])."</font>";
	
	
	$row = sql_fetch(" select count(*) as cnt from {$g5['member_table']} where ".SL_ID_FIELD." = '".$content['id']."' and ".SL_TYPE_FIELD." = 'naver' ");
	if ($row['cnt']){
		
		$row = sql_fetch(" select * from `{$g5['member_table']}` where ".SL_ID_FIELD." = '".$content['id']."' and ".SL_TYPE_FIELD." = 'naver'");
		
		if($row['mb_id']) {
          
			    if ($row[mb_intercept_date] && $row[mb_intercept_date] <= date("Ymd", G5_SERVER_TIME)) {
				    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $row[mb_intercept_date]); 
					alert_close("회원님의 아이디는 접근이 금지되어 있습니다.\\n\\n차단일 : $date");
	            }
	
		       else if ($row[mb_leave_date] && $row[mb_leave_date] <= date("Ymd",G5_SERVER_TIME)) {
			        $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $row[mb_leave_date]); 
				    alert_close("탈퇴한 아이디이므로 로그인을 하실 수 없습니다.\\n\\n탈퇴일 : $date");
	            }
	
		}

		$thumbnail_image = thumbnail_set($content['profile_image'],$content['id'],$mb_img_width,$mb_img_height);

		sl_login($content['id'], 'naver');
		
		//소셜로그인
		set_session('sl_id', $content['id']);
		set_session('sl_sns', 'naver');
		set_session('sl_str', $str);
		set_session('sl_picture', $content['profile_image']);
		//goto_url('/');

		//이미지 업데이트
		$SLThumbUp = SL_UPDATE_THUMBNAIL;
			
		if($SLThumbUp) 
			$imgup = sql_fetch("update {$g5['member_table']} set ".SL_PROFILE_IMAGE2_FIELD."='".$thumbnail_image."',".SL_PROFILE_IMAGE_FIELD."='".$content['profile_image']."' where ".SL_ID_FIELD." = '".$content['id']."' and ".SL_TYPE_FIELD." = 'naver' ");
		else
			$imgup = sql_fetch("update {$g5['member_table']} set ".SL_PROFILE_IMAGE_FIELD."='".$content['profile_image']."' where ".SL_ID_FIELD." = '".$content['id']."' and ".SL_TYPE_FIELD." = 'naver' ");



		echo "<script>
				opener.document.location.href='/';
				window.close();
				</script>";
		
		
				exit;		
	}else{ //신규가입
		
		if($content['email'] && (SL_CHECK_EMAIL == "1")) { 

			$row = sql_fetch(" select count(*) as cnt from `{$g5['member_table']}` where mb_email = '".$content['email']."' ");
	
			if ($row['cnt']) alert('이미 사용중인 E-mail 주소입니다.', '/');
		}

		$row = sql_fetch(" select * from `{$g5['member_table']}` where ".SL_ID_FIELD." = '".$content['id']."' and ".SL_TYPE_FIELD." = 'naver'");
		
		if($row['mb_id']) {
            
			    if ($row[mb_intercept_date] && $row[mb_intercept_date] <= date("Ymd", G5_SERVER_TIME)) {
				    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $row[mb_intercept_date]); 
					alert_close("회원님의 아이디는 접근이 금지되어 있습니다.\\n\\n차단일 : $date");
	            }
	
		       else if ($row[mb_leave_date] && $row[mb_leave_date] <= date("Ymd",G5_SERVER_TIME)) {
			        $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $row[mb_leave_date]); 
				    alert_close("탈퇴한 아이디이므로 회원가입을 하실 수 없습니다.\\n\\n탈퇴일 : $date");
	            }
	
				else {
					alert_close("이미 가입되어있는 회원입니다.");
				}
		}
		$ndata = array(
			"nick" => str_replace(' ', '', $content['nickname']),
			"sns" => "naver"
		);
		
		if(!$content['name']) 
			$content['name'] = $content['nickname']; //지원전에는 닉네임으로 대체

		//현재(2015/07/15 기준) 지원되고 있음 따라서 네임값이 비어있을수가 없지만 만에 하나를 위해 처리

		$thumbnail_image = thumbnail_set($content['profile_image'],$content['id'],$mb_img_width,$mb_img_height);

		$naver_user = array(
			'mb_id' => sl_id_check($content['id']),
			'mb_password' => SL_PASSWORD.$content['id'],
			'mb_email' => $content['email'],
			'mb_name' => $content['name'],
			'mb_nick' => sl_nick_check($ndata),
			'mb_homepage' => 'none',
			SL_PROFILE_IMAGE2_FIELD => $thumbnail_image,
			SL_PROFILE_IMAGE_FIELD => $content['profile_image'], 
			SL_ID_FIELD => $content['id'], 
			SL_TYPE_FIELD => 'naver'
		);
		
		$result = sl_register($naver_user); //회원가입
		if ($result){
			
			sl_login($content['id'], 'naver');
			
			//소셜로그인
			set_session('sl_id', $content['id']);
			set_session('sl_sns', 'naver');
			set_session('sl_str', $str);
			set_session('sl_picture', $content['profile_image']);
//			goto_url(G5_BBS_URL.'/sns_confirm.php');
		echo "<script>
				opener.document.location.href='".G5_BBS_URL."/sns_confirm.php';
				window.close();
				</script>";

		}
	}	




}else{
//	die('Error');
	header('Location: '."/");
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
	
	$tmpPath = G5_DATA_PATH."/".$mbid.".png";

	if(!is_dir(G5_DATA_PATH."/member_image"))
		@mkdir(G5_DATA_PATH."/member_image",G5_DIR_PERMISSION);

	if(!is_dir(G5_DATA_PATH."/member_image/naver"))
		@mkdir(G5_DATA_PATH."/member_image/naver",G5_DIR_PERMISSION);

	if(!is_dir(G5_DATA_PATH."/member_image/naver/".substr($mbid,0,2)))
		@mkdir(G5_DATA_PATH."/member_image/naver/".substr($mbid,0,2),G5_DIR_PERMISSION);

	$savePath = G5_DATA_PATH."/member_image/naver/".substr($mbid,0,2)."/".$mbid.".png";
	$tpath = G5_DATA_PATH."/member_image/naver/".substr($mbid,0,2);
	$saveURL = G5_DATA_URL."/member_image/naver/".substr($mbid,0,2)."/";

	$fd = fopen($tmpPath, 'w');
	fwrite($fd, $st);
	fclose($fd);

	curl_close($ch);

	$iinfo = getimagesize($tmpPath);

	if($iinfo[0] && $iinfo[1]) { //이미지맞음
	
	 $filename = $mbid.".png";
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