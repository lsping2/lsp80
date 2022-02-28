<?
 ini_set('display_errors', 'on'); 
include_once("./_common.php");

require_once(G5_PLUGIN_PATH.'/social_login/daum/daum_client.php');

$daum = new Daum(array(
        "CLIENT_ID" => DAUM_CONSUMER_KEY,        // (*필수)CLIENT ID
        "CLIENT_SECRET" => DAUM_CONSUMER_SECRET,        // (*필수)CLIENT SECRET KEY  
        "RETURN_URL" => G5_PLUGIN_URL."/social_login/daum/daumlogin.php"      // (*필수)콜백 URL
        )
    );

if($is_member)
	alert_close("이미 로그인되어 있습니다.");

if ($daum->getAccessToken()) {
	$contents = $daum->GetUserProfile();

	//$json = file_get_contents($url);
 
	$obj = json_decode($contents);
 
	$id = $obj->result->id;
	$userid = $obj->result->userid;
	$nickname = $obj->result->nickname;
	$profile_image = $obj->result->bigImagePath; //158x158
	$thumbnail_image = $obj->result->imagePath; //55x55
	
	$row = sql_fetch(" select count(*) as cnt from {$g5['member_table']} where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = 'daum' ");
	
	if ($row['cnt']){
		
		$row = sql_fetch(" select * from `{$g5['member_table']}` where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = 'daum'");
		
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

		sl_login($id, 'daum');
		
		//소셜로그인
		set_session('sl_id', $id);
		set_session('sl_nickname', $nickname);
		set_session('sl_sns', 'daum');
		set_session('sl_picture', $profile_image);

		//이미지 업데이트
		$SLThumbUp = SL_UPDATE_THUMBNAIL;
		
		if($SLThumbUp) {
			$imgup = sql_fetch("update {$g5['member_table']} set ".SL_PROFILE_IMAGE2_FIELD." = '".$thumbnail_image."',".SL_PROFILE_IMAGE_FIELD."='".$profile_image."' where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = 'daum' ");
		}
		else
			$imgup = sql_fetch("update {$g5['member_table']} set ".SL_PROFILE_IMAGE_FIELD."='".$profile_image."' where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = 'daum' "); //썸네일업데이트 제한시 일반 이미지만 업데이트

		//goto_url('/');
		//로그인처리후 부모창에서 메인페이지로 이동
		echo "<script>
				opener.document.location.href='/';
				window.close();
				</script>";
		
		
				exit;		
	}else{ //신규가입
		
			//기본정보 제공이 닉네임과 기타 이미지뿐이고 그나마 고유번호를 아이디로 전달하기때문에
			//전달받은 고유아이디값과 mb_10필드에 '다음'으로 기록된 유저를 체크해 존재유무를 체크함
		
/*		if($userid && (SL_CHECK_EMAIL == "1")) {
			
			$emails[0] = $userid."@hanmail.net";
			$emails[1] = $userid."@daum.net";

			$row = sql_fetch(" select count(*) as cnt from `{$g5['member_table']}` where mb_email = '".$emails[0]."' or mb_email = '".$emails[1]."'");
	    	if ($row['cnt']) alert('이미 사용중인 이메일입니다.', '/');
		}		*/
		//다음넷은 이메일주소나 아이디를 전달해주지 않으므로 이메일체크는 할수 없음
//		$npass = newpassword(); //임의 8자리 비밀번호를 부여
		
		$row = sql_fetch(" select * from `{$g5['member_table']}` where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = 'daum'");
		
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

		$ndata = array(
			"nick" => str_replace(' ', '', $nickname),
			"sns" => "daum"
		);
		
		//$email = $userid."@hanmail.net";
		//이메일은 직접 입력받도록 설계

		$daum_user = array(
			'mb_id' => sl_id_check($id),
			'mb_password' => SL_PASSWORD.$id,
			'mb_email' => '',
			'mb_name' => str_replace(' ', '', $nickname),
			'mb_nick' => sl_nick_check($ndata),
			SL_PROFILE_IMAGE2_FIELD => $thumbnail_image, 
			SL_PROFILE_IMAGE_FIELD => $profile_image, 
			SL_ID_FIELD => $id, 
			SL_TYPE_FIELD => 'daum'
		);
		
		$result = sl_register($daum_user); //회원가입
		if ($result){
			//가입이 완료되면 로그인처리함
			sl_login($id, 'daum');
			
			//소셜로그인
			set_session('sl_id', $id);
			set_session('sl_sns', 'daum');
			set_session('sl_picture', $profile_image);
//			goto_url(G5_BBS_URL.'/sns_confirm.php');
		echo "<script>
				opener.document.location.href='".G5_BBS_URL."/sns_confirm.php';
				window.close();
				</script>";

		}
	}	

}
else {
	alert("정상적인 로그인처리가 되지 못했습니다. 다시 시도해주세요\\n\\n계속 같은 현상이 나타나면 관리자에게 문의하세요");

}
?>

