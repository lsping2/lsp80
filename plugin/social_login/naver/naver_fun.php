<?php
/*
 *
 * 네이버 로그인 API 모듈
 *                  Made by DK

 */

define( NAVER_OAUTH_URL, "https://nid.naver.com/oauth2.0/" );
define( NAVER_SESSION_NAME, "NHN_SESSION");
@session_start();
class Naver{

	private $tokenDatas	=	array();
	private $access_token			= '';			// oauth 엑세스 토큰
	private $refresh_token			= '';			// oauth 갱신 토큰
	private $access_token_type		= 'bearer';			// oauth 토큰 타입
	private $access_token_expire	= '';			// oauth 토큰 만료
	private $access_token_expire_in	= '';			// oauth 토큰을 받은 당시 시간 (밀리초)


	private $client_id		= '';			// 네이버에서 발급받은 CLIENT ID 키
	private $client_secret		= '';			// 네이버에서 발급받은 CLIENT SECRET 키

	private $returnURL		= '';			// 콜백 받을 URL ( 네이버에 등록된 콜백 URI가 우선됨)
	private $state			= '';			// 네이버 명세에 필요한 검증 키 (현재 버전 라이브러리에서 미검증)

	
	private $loginMode		= 'request_token';	// 라이브러리 작동 상태

	private $returnCode		= '';			// 네이버에서 리턴 받은 승인 코드
	private $returnState	 = '';			// 네이버에서 리턴 받은 검증 코드
	private $curl = NULL;

	function __construct($argv = array()) {		

		if  ( ! in_array  ('curl', get_loaded_extensions())) {
			echo 'curl required';
			return false;
		}

		
		if($argv['CLIENT_ID']){
			$this->client_id = trim($argv['CLIENT_ID']);
		}
		if($argv['CLIENT_SECRET']){
			$this->client_secret = trim($argv['CLIENT_SECRET']);
		}

		if($argv['RETURN_URL']){
			$this->returnURL = trim(urlencode($argv['RETURN_URL']));
		}
		
	
		$this->loadSession();

			if(!isset($this->access_token) || !isset($_SESSION[NAVER_SESSION_NAME]) || !isset($_SESSION[NAVER_SESSION_NAME]["token_expire"])  || !isset($_SESSION[NAVER_SESSION_NAME]["token_expire_in"]) || !isset($_SESSION[NAVER_SESSION_NAME]["access_token"])) {
			
			$this->state = $this->generate_state();
			}

			if($_GET['state']){
			
				$this->returnState = $_GET['state'];
			}
			if($_GET['code']) {
				$this->returnCode = $_GET['code'];
			}

		if($this->returnState && $this->returnCode) { //로그인 인증후 콜백주소에서 이 페이지를 참조할때
			
			if(!$this->access_token || !$_SESSION[NAVER_SESSION_NAME] || !$_SESSION[NAVER_SESSION_NAME]["token_expire"]  || !$_SESSION[NAVER_SESSION_NAME]["token_expire_in"] || !$_SESSION[NAVER_SESSION_NAME]["access_token"]) {

				$this->getAccessToken();
		}

	}
}
 function getAccessToken()
 {
		$this->curl = curl_init();

		$te = ($_SESSION[NAVER_SESSION_NAME]["token_expire"] - 120); //토근만료시간에서 2분을 뺌 2분전에 재갱신
		$tei = $_SESSION[NAVER_SESSION_NAME]["token_expire_in"];
		$ct = ceil((time()-$tei)/1000);  //밀리초를 초로 변환

		if($this->access_token && $ct >= $te) { // 토근발급받은시간을 현재시간에서 뺀후 값이 토근만료시간-2분 한것보다 크거나 같으면 재갱신
			curl_setopt($this->curl, CURLOPT_URL, NAVER_OAUTH_URL.'token?client_id='.$this->client_id.'&client_secret='.$this->client_secret.'&grant_type=refresh_token&refresh_token='.$this->refresh_token.'&code='.$this->returnCode.'state='.$this->returnState);
		}
		else { //토근이 없거나 재갱신시간보다 남아있다면 토근 가져옴
		curl_setopt($this->curl, CURLOPT_URL, NAVER_OAUTH_URL.'token?client_id='.$this->client_id.'&client_secret='.$this->client_secret.'&grant_type=authorization_code&code='.$this->returnCode.'&state='.$this->returnState);
		}
		curl_setopt($this->curl, CURLOPT_POST, 1); 
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data); 
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,true); 
		$retVar = curl_exec($this->curl); 
		curl_close($this->curl);
		$Naverreturns = json_decode($retVar);


		if($Naverreturns->access_token){


			$this->access_token			= $Naverreturns->access_token;
			$this->access_token_type	= $Naverreturns->token_type;
			$this->refresh_token		= $Naverreturns->refresh_token;
			$this->access_token_expire	= $Naverreturns->expires_in;
			$this->access_token_expire_in = time();

			$this->saveSession();

		}
		return $this->access_token;
 }

 function testLogin()
 {
		echo '<a href="javascript:loginNaver();"><img src="'.G5_PLUGIN_URL.'/social_login/naver/image/slogin_naver.jpg" alt="네이버 아이디로 로그인" width="37" height="37"></a>';
			echo '
			<script>
			function loginNaver(){
				var win = window.open(\''.NAVER_OAUTH_URL.'authorize?client_id='.$this->client_id.'&client_secret='.$this->client_secret.'&response_type=code&redirect_uri='.$this->returnURL.'&state='.$this->state.'\', \'naverlogin\',\'width=320, height=480, toolbar=no, location=no\'); 
			
				var timer = setInterval(function() {   
					if(win.closed) {  
						window.location.reload();
					}  
				}, 500); 
			} 
			</script>
			';
	
 }

 function getUserProfile($isType = "XML")
 {
			$data = array();
			$data['Authorization'] = $this->access_token_type.' '.$this->access_token;

			$this->curl = curl_init();
			curl_setopt($this->curl, CURLOPT_URL, 'https://apis.naver.com/nidlogin/nid/getUserProfile.xml');
			curl_setopt($this->curl, CURLOPT_POST, 1); 
			curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data); 
			curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
				'Authorization: '.$data['Authorization']
			));

			curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,true); 
			$retVar = curl_exec($this->curl); 
			curl_close($this->curl);
			return $retVar; //네이버는 기본 XML임
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
				$_SESSION[NAVER_SESSION_NAME][$k] = $v;
			}
		}
	}


	function deleteSession(){
		if(isset($_SESSION) && is_array($_SESSION) && $_SESSION[NAVER_SESSION_NAME]){
			$_loadSession = array();
			$this->tokenDatas = $_loadSession;

			unset($_SESSION[NAVER_SESSION_NAME]);

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

		if(isset($_SESSION) && is_array($_SESSION) && $_SESSION[NAVER_SESSION_NAME]){
			
			$_loadSession = array();
			$_loadSession['access_token']		=	$_SESSION[NAVER_SESSION_NAME]['access_token'] ? $_SESSION[NAVER_SESSION_NAME]['access_token'] : '';
			$_loadSession['access_token_type']	=	$_SESSION[NAVER_SESSION_NAME]['access_token_type'] ? $_SESSION[NAVER_SESSION_NAME]['access_token_type'] : '';
			$_loadSession['refresh_token']		=	$_SESSION[NAVER_SESSION_NAME]['refresh_token'] ? $_SESSION[NAVER_SESSION_NAME]['refresh_token'] : '';
			$_loadSession['access_token_expire']	=	$_SESSION[NAVER_SESSION_NAME]['access_token_expire'] ? $_SESSION[NAVER_SESSION_NAME]['access_token_expire']:'';
			$_loadSession['access_token_expire_in']	=	$_SESSION[NAVER_SESSION_NAME]['access_token_expire_in'] ? $_SESSION[NAVER_SESSION_NAME]['access_token_expire_in']:'';
			
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