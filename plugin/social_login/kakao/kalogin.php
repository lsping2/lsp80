<?
ini_set("display_errors", "on"); 
include_once("./_common.php");

require_once(G5_PLUGIN_PATH.'/social_login/kakao/kakao_fun.php');

$kakao = new Kakao(array(
        "REST_ID" => KA_CONSUMER_KEY,        // (*필수)REST ID  
        "RETURN_URL" => G5_PLUGIN_URL."/social_login/kakao/kalogin.php"      // (*필수)콜백 URL
         )
    );

if($is_member)
	alert_close("이미 로그인이 되어있습니다.");

if ($kakao->getAccessToken()) {

	
	$contents = $kakao->GetUserProfile();

	//$json = file_get_contents($url);
 
	$obj = json_decode($contents);
 
	$id = $obj->id;
	$nickname = $obj->properties->nickname;
	$profile_image = $obj->properties->profile_image;
	$thumbnail_image = $obj->properties->thumbnail_image;
	$email = $obj->properties->email;
	$gender = $obj->properties->gender;
	$birthday = $obj->properties->birthday;
	
	$row = sql_fetch(" select * from {$g5['member_table']} where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = 'kakao' ");
		//소셜로그인(카카오) 계정중 카카오에서 전달받은 아이디값과 일치하는게 있으면 이미 가입된 회원이므로
		//로그인처리함

	if ($row['mb_id']){
		
		//탈퇴 또는 차단여부 확인
            if ($row[mb_intercept_date] && $row[mb_intercept_date] <= date("Ymd", G5_SERVER_TIME)) {
                $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $row[mb_intercept_date]); 
                alert_close("회원님의 아이디는 접근이 금지되어 있습니다.\\n\\n처리일 : $date");
            }

            if ($row[mb_leave_date] && $row[mb_leave_date] <= date("Ymd", G5_SERVER_TIME)) {
                $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $row[mb_leave_date]); 
                alert_close("탈퇴한 아이디이므로 로그인을 하실 수 없습니다.\\n\\n탈퇴일 : $date");
            }


		sl_login($id, 'kakao');
		
		//소셜로그인
		set_session('sl_id', $id);
		set_session('sl_nickname', $nickname);
		set_session('sl_sns', 'kakao');
		set_session('sl_picture', $profile_image);

		//이미지 업데이트
		$SLThumbUp = SL_UPDATE_THUMBNAIL;
			
		if($SLThumbUp) 
			$imgup = sql_fetch("update {$g5['member_table']} set ".SL_PROFILE_IMAGE_FIELD."='".$profile_image."',".SL_PROFILE_IMAGE2_FIELD."='".$thumbnail_image."' where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = 'kakao' ");
		else
			$imgup = sql_fetch("update {$g5['member_table']} set ".SL_PROFILE_IMAGE_FIELD."='".$profile_image."' where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = 'kakao' ");

		//goto_url('/');
		//로그인처리후 부모창에서 메인페이지로 이동
		echo "<script>
				opener.document.location.href='/';
				window.close();
				</script>";
		
		
				exit;		
	}else{ //신규가입
		
		//카카오 로그인 API의 REST API는 기본정보 제공이 닉네임, 프로필이미지, 썸네일 이미지임 ID값은 고유값으로 전달됨
		//이메일주소나 생년월일 또는 성별은 카카오인증후에 따로 사용자 입력을 받아 저장하도록 설계해야됨

		if($email && (SL_CHECK_EMAIL == "1")) { 
			//이메일이 존재하고 이를 체크하여 중복방지를 하도록 설정된경우라면 체크후 가입차단
			$row = sql_fetch(" select count(*) as cnt from `{$g5['member_table']}` where mb_email = '".$email."' and ".SL_TYPE_FIELD." = 'kakao' ");
	    	if ($row['cnt']) alert('이미 사용중인 E-mail 주소입니다.', '/');
		}
//		$npass = newpassword(); //임의 8자리 비밀번호를 부여
		
		//sl_id_check() 함수는 사용자ID를 체크하여 존재하면 임의값을 더해서 저장하는데
		//카카오는 식별방법이 따로 없으므로 이 함수는 패스
		//카카오에서 전달되는 고유아이디값은 사용자마다 각기 다른 고유값이기때문에 카카오안에서
		//중복염려 없음
		//카카오는 이메일을 전달해주지 않음 따라서, $email 값은 비어있게 됨 null
		//이 값은 사용자 입력에 따라 다시 수정하도록 해야뎀
	
		//닉네임부분도 체크를 위한 함수를 사용하는데 소셜마다 따로 표시해준다면 상관없이 코딩할수 있으나
		//그렇지 않다면 사용자간의 혼란이 야기될수 있으므로 중복되는 닉네임을 가진 사용자는 임의 숫자를 덧붙여
		//저장하도록 함
		//추후 이부분은 각 SNS 별로 파비콘을 사용하도록 해서 닉네임 그대로 사용하도록 할 예정

		//중유사실 하나 카카오에서의 프로필 이미지는 사이트에 가입하는 당시의 사용자 프로필이미지만을 제공
		//그 이후에 사용자가 프로필 이미지를 변경해도 반영해주지않음... 이것도 고정성이 있나..?
		//탈퇴 또는 차단여부 확인

		$row = sql_fetch(" select * from `{$g5['member_table']}` where ".SL_ID_FIELD." = '".$id."' and ".SL_TYPE_FIELD." = 'kakao'");
		
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
			"sns" => "kakao"
		);

		$kakao_user = array(
			'mb_id' => sl_id_check($id),
			'mb_password' => SL_PASSWORD.$id,
			'mb_email' => $email,
			'mb_name' => str_replace(' ', '', $nickname),
			'mb_nick' => sl_nick_check($ndata),
			SL_PROFILE_IMAGE2_FIELD => $thumbnail_image, 
			SL_PROFILE_IMAGE_FIELD => $profile_image, 
			SL_ID_FIELD => $id, 
			SL_TYPE_FIELD => 'kakao'
		);
		
		$result = sl_register($kakao_user); //회원가입
		if ($result){
			//가입이 완료되면 로그인처리함
			sl_login($id, 'kakao');
			
			//소셜로그인
			set_session('sl_id', $id);
			set_session('sl_sns', 'kakao');
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

	echo "<script>
	window.alert('정상적인 로그인처리가 되지 못했습니다. 다시 시도해주세요\\n\\n계속 같은 현상이 나타나면 관리자에게 문의하세요');
	</script>";
}
?>

