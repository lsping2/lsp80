<?php
/*
 *
 * 카카오 로그인 API 모듈
 *                  Made by DK

 */
ini_set("display_errors","on");
define( KAKAO_OAUTH_URL, "https://kauth.kakao.com/oauth/" );
define( KAKAO_SESSION_NAME, "KAKAO_SESSION");

//define( KAKAO_TOKEN_URL, "https://kauth.kakao.com/oauth/" );
//define( KAKAO_USER_URL, "https://kauth.kakao.com/oauth/" );
@session_start();
class Kakao{

	private $tokenDatas	=	array();
	private $access_token			= '';			// oauth 엑세스 토큰
	private $refresh_token			= '';			// oauth 갱신 토큰
	private $access_token_type		= 'bearer';			// oauth 토큰 타입
	private $access_token_expire	= '';			// oauth 토큰 만료
	private $access_token_expire_in	= '';			// oauth 토큰을 받은 당시 시간 (밀리초)


	private $rest_id		= '';			// 카카오에서 발급받은 REST API키


	private $returnURL		= '';			// 콜백 받을 URL ( 카카오에 등록된 콜백 URI가 우선됨)
	private $state			= '';			// 카카오 명세에 필요한 검증 키 (현재 버전 라이브러리에서 미검증)

	
	private $loginMode		= 'request_token';	// 라이브러리 작동 상태

	private $returnCode		= '';			// 카카오에서 리턴 받은 승인 코드
	private $returnState	 = '';			// 카카오에서 리턴 받은 검증 코드
	private $curl = NULL;

	function __construct($argv = array()) {		

		if  ( ! in_array  ('curl', get_loaded_extensions())) {
			echo 'curl required';
			return false;
		}

		
		if($argv['REST_ID']){
			$this->rest_id = trim($argv['REST_ID']);
		}

		if($argv['RETURN_URL']){
			$this->returnURL = trim(urlencode($argv['RETURN_URL']));
		}
		
	
		$this->loadSession();

			if(!isset($this->access_token) || !isset($_SESSION[KAKAO_SESSION_NAME]) || !isset($_SESSION[KAKAO_SESSION_NAME]["token_expire"])  || !isset($_SESSION[KAKAO_SESSION_NAME]["token_expire_in"]) || !isset($_SESSION[KAKAO_SESSION_NAME]["access_token"])) {
			
			$this->state = $this->generate_state();
			}

			if($_GET['state']){
			
				$this->returnState = $_GET['state'];
			}
			if($_GET['code']) {
				$this->returnCode = $_GET['code'];
			}

		if(isset($this->returnState) &&	isset($this->returnCode)) { //로그인 인증후 콜백주소에서 이 페이지를 참조할때
			
			if(!$this->access_token || !$_SESSION[KAKAO_SESSION_NAME] || !$_SESSION[KAKAO_SESSION_NAME]["token_expire"]  || !$_SESSION[KAKAO_SESSION_NAME]["token_expire_in"] || !$_SESSION[KAKAO_SESSION_NAME]["access_token"]) {

				$this->getAccessToken();
		}

	}
}
 function getAccessToken()
 {
		$this->curl = curl_init();

		$te = ($_SESSION[KAKAO_SESSION_NAME]["token_expire"] - 120); //토근만료시간에서 2분을 뺌 2분전에 재갱신
		$tei = $_SESSION[KAKAO_SESSION_NAME]["token_expire_in"];
		$ct = ceil((time()-$tei)/1000);  //밀리초를 초로 변환

		if($this->access_token && $ct >= $te) { // 토근발급받은시간을 현재시간에서 뺀후 값이 토근만료시간-2분 한것보다 크거나 같으면 재갱신
			curl_setopt($this->curl, CURLOPT_URL, KAKAO_OAUTH_URL.'token?client_id='.$this->rest_id.'&grant_type=refresh_token&refresh_token='.$this->refresh_token.'&code='.$this->returnCode.'state='.$this->returnState);
		}
		else { //토근이 없거나 재갱신시간보다 남아있다면 토근 가져옴
		curl_setopt($this->curl, CURLOPT_URL, KAKAO_OAUTH_URL.'token?client_id='.$this->rest_id.'&grant_type=authorization_code&code='.$this->returnCode.'&state='.$this->returnState);
		}
		curl_setopt($this->curl, CURLOPT_POST, 1); 
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data); 
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,true); 
		$retVar = curl_exec($this->curl); 
		curl_close($this->curl);
		$KAKAOreturns = json_decode($retVar);


		if($KAKAOreturns->access_token){


			$this->access_token			= $KAKAOreturns->access_token;
			$this->access_token_type	= $KAKAOreturns->token_type;
			$this->refresh_token		= $KAKAOreturns->refresh_token;
			$this->access_token_expire	= $KAKAOreturns->expires_in;
			$this->access_token_expire_in = time();

			$this->saveSession();

		}
		return $this->access_token;
 }

 function testLogin()
 {
		echo '<a href="javascript:loginKakao();"><img src="'.G5_PLUGIN_URL.'/social_login/kakao/image/slogin_kakao.jpg" alt="카카오 아이디로 로그인" width="37" height="37"></a>';
			echo '
			<script>
			function loginKakao(){
				var win = window.open(\''.KAKAO_OAUTH_URL.'authorize?client_id='.$this->rest_id.'&response_type=code&redirect_uri='.$this->returnURL.'&state='.$this->state.'\', \'kakaologin\',\'width=320, height=480, toolbar=no, location=no\'); 
			
				var timer = setInterval(function() {   
					if(win.closed) {  
						window.location.reload();
					}  
				}, 500); 
			} 
			</script>
			';
	
 }

 function getUserProfile($isType = "JSON")
 {
			$data = array();
			$data['Authorization'] = $this->access_token_type.' '.$this->access_token;

			$this->curl = curl_init();
			curl_setopt($this->curl, CURLOPT_URL, 'https://kapi.kakao.com/v1/user/me');
			curl_setopt($this->curl, CURLOPT_POST, 1); 
			curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data); 
			curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
				'Authorization: '.$data['Authorization']
			));

			curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,true); 
			$retVar = curl_exec($this->curl); 
			curl_close($this->curl);
			return $retVar; //카카오는 기본 JSON임
 }


	/**
	*	토근을 세션에 기록합니다.
	*/
	function saveSession(){
		
		if(isset($_SESSION) && is_array($_SESSION)){
			$_saveSession = array();
			$_saveSession['access_token']		=	$this->access_token;
			$_saveSession['access_token_type']	=	$this->access_token_type;
			$_saveSession['refresh_token']		=	$this->refresh_token;
			$_saveSession['access_token_expire']	=	$this->access_token_expire;
			$_saveSession['access_token_expire_in']	=	$this->access_token_expire_in;
			
			$this->tokenDatas = $_saveSession;

			foreach($_saveSession as $k=>$v){
				$_SESSION[KAKAO_SESSION_NAME][$k] = $v;
			}
		}
	}


	function deleteSession(){
		if(isset($_SESSION) && is_array($_SESSION) && $_SESSION[KAKAO_SESSION_NAME]){
			$_loadSession = array();
			$this->tokenDatas = $_loadSession;

			unset($_SESSION[KAKAO_SESSION_NAME]);

			$this->access_token			= '';
			$this->access_token_type	= '';
			$this->refresh_token		= '';
			$this->access_token_expire	= '';
			$this->access_token_expire_in	= '';
//			$this->updateConnectState(false);
		}
	}


	/**
	*	저장된 토큰을 복원합니다.
	*/
 function loadSession(){

		if(isset($_SESSION) && is_array($_SESSION) && $_SESSION[KAKAO_SESSION_NAME]){
			
			$_loadSession = array();
			$_loadSession['access_token']		=	$_SESSION[KAKAO_SESSION_NAME]['access_token'] ? $_SESSION[KAKAO_SESSION_NAME]['access_token'] : '';
			$_loadSession['access_token_type']	=	$_SESSION[KAKAO_SESSION_NAME]['access_token_type'] ? $_SESSION[KAKAO_SESSION_NAME]['access_token_type'] : '';
			$_loadSession['refresh_token']		=	$_SESSION[KAKAO_SESSION_NAME]['refresh_token'] ? $_SESSION[KAKAO_SESSION_NAME]['refresh_token'] : '';
			$_loadSession['access_token_expire']	=	$_SESSION[KAKAO_SESSION_NAME]['access_token_expire'] ? $_SESSION[KAKAO_SESSION_NAME]['access_token_expire']:'';
			$_loadSession['access_token_expire_in']	=	$_SESSION[KAKAO_SESSION_NAME]['access_token_expire_in'] ? $_SESSION[KAKAO_SESSION_NAME]['access_token_expire_in']:'';
			
			$this->tokenDatas = $_loadSession;

			$this->access_token			= $this->tokenDatas['access_token'];
			$this->access_token_type	= $this->tokenDatas['access_token_type'];
			$this->refresh_token		= $this->tokenDatas['refresh_token'];
			$this->access_token_expire	= $this->tokenDatas['access_token_expire'];
			$this->access_token_expire_in	= $this->tokenDatas['access_token_expire_in'];
			$this->saveSession();
		}
	}

 function generate_state() {
   
   $mt = microtime();
   $rand = mt_rand();
   return md5( $mt . $rand );
 }
}
?>