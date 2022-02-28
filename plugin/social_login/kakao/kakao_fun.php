<?php
/*
 *
 * īī�� �α��� API ���
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
	private $access_token			= '';			// oauth ������ ��ū
	private $refresh_token			= '';			// oauth ���� ��ū
	private $access_token_type		= 'bearer';			// oauth ��ū Ÿ��
	private $access_token_expire	= '';			// oauth ��ū ����
	private $access_token_expire_in	= '';			// oauth ��ū�� ���� ��� �ð� (�и���)


	private $rest_id		= '';			// īī������ �߱޹��� REST APIŰ


	private $returnURL		= '';			// �ݹ� ���� URL ( īī���� ��ϵ� �ݹ� URI�� �켱��)
	private $state			= '';			// īī�� ���� �ʿ��� ���� Ű (���� ���� ���̺귯������ �̰���)

	
	private $loginMode		= 'request_token';	// ���̺귯�� �۵� ����

	private $returnCode		= '';			// īī������ ���� ���� ���� �ڵ�
	private $returnState	 = '';			// īī������ ���� ���� ���� �ڵ�
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

		if(isset($this->returnState) &&	isset($this->returnCode)) { //�α��� ������ �ݹ��ּҿ��� �� �������� �����Ҷ�
			
			if(!$this->access_token || !$_SESSION[KAKAO_SESSION_NAME] || !$_SESSION[KAKAO_SESSION_NAME]["token_expire"]  || !$_SESSION[KAKAO_SESSION_NAME]["token_expire_in"] || !$_SESSION[KAKAO_SESSION_NAME]["access_token"]) {

				$this->getAccessToken();
		}

	}
}
 function getAccessToken()
 {
		$this->curl = curl_init();

		$te = ($_SESSION[KAKAO_SESSION_NAME]["token_expire"] - 120); //��ٸ���ð����� 2���� �� 2������ �簻��
		$tei = $_SESSION[KAKAO_SESSION_NAME]["token_expire_in"];
		$ct = ceil((time()-$tei)/1000);  //�и��ʸ� �ʷ� ��ȯ

		if($this->access_token && $ct >= $te) { // ��ٹ߱޹����ð��� ����ð����� ���� ���� ��ٸ���ð�-2�� �Ѱͺ��� ũ�ų� ������ �簻��
			curl_setopt($this->curl, CURLOPT_URL, KAKAO_OAUTH_URL.'token?client_id='.$this->rest_id.'&grant_type=refresh_token&refresh_token='.$this->refresh_token.'&code='.$this->returnCode.'state='.$this->returnState);
		}
		else { //����� ���ų� �簻�Žð����� �����ִٸ� ��� ������
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
		echo '<a href="javascript:loginKakao();"><img src="'.G5_PLUGIN_URL.'/social_login/kakao/image/slogin_kakao.jpg" alt="īī�� ���̵�� �α���" width="37" height="37"></a>';
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
			return $retVar; //īī���� �⺻ JSON��
 }


	/**
	*	����� ���ǿ� ����մϴ�.
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
	*	����� ��ū�� �����մϴ�.
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