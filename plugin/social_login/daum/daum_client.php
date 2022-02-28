<?php
/*
 *
 * ���� �α��� API ���
 *                  Made by DK

 */

define(DAUM_OAUTH_URL, "https://apis.daum.net/oauth2/");
define(DAUM_SESSION_NAME, "DAUM_SESSION");
@session_start();
class Daum{

	private $tokenDatas	=	array();
	private $access_token			= '';			// oauth ������ ��ū
	private $refresh_token			= '';			// oauth ���� ��ū
	private $access_token_type		= 'bearer';			// oauth ��ū Ÿ��
	private $access_token_expire	= '';			// oauth ��ū ����
	private $access_token_expire_in	= '';			// oauth ��ū�� ���� ��� �ð� (�и���)


	private $client_id		= '';			// �������� �߱޹��� CLIENT ID Ű
	private $client_secret		= '';			// �������� �߱޹��� CLIENT SECRET Ű

	private $returnURL		= '';			// �ݹ� ���� URL ( ������ ��ϵ� �ݹ� URI�� �켱��)
	private $state			= '';			// ���� ���� �ʿ��� ���� Ű (���� ���� ���̺귯������ �̰���)

	
	private $loginMode		= 'request_token';	// ���̺귯�� �۵� ����

	private $returnCode		= '';			// �������� ���� ���� ���� �ڵ�
	private $returnState	 = '';			// �������� ���� ���� ���� �ڵ�
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

			if(!isset($this->access_token) || !isset($_SESSION[DAUM_SESSION_NAME]) || !isset($_SESSION[DAUM_SESSION_NAME]["token_expire"])  || !isset($_SESSION[DAUM_SESSION_NAME]["token_expire_in"]) || !isset($_SESSION[DAUM_SESSION_NAME]["access_token"])) {
			
			$this->state = $this->generate_state();
			}

			if($_GET['state']){
			
				$this->returnState = $_GET['state'];
			}
			if($_GET['code']) {
				$this->returnCode = $_GET['code'];
			}

		if($this->returnState && $this->returnCode) { //�α��� ������ �ݹ��ּҿ��� �� �������� �����Ҷ�
			
			if(!$this->access_token || !$_SESSION[DAUM_SESSION_NAME] || !$_SESSION[DAUM_SESSION_NAME]["token_expire"]  || !$_SESSION[DAUM_SESSION_NAME]["token_expire_in"] || !$_SESSION[DAUM_SESSION_NAME]["access_token"]) {

				$this->getAccessToken();
		}

	}
}
 function getAccessToken()
 {
		$this->curl = curl_init();

		$te = ($_SESSION[DAUM_SESSION_NAME]["token_expire"] - 120); //��ٸ���ð����� 2���� �� 2������ �簻��
		$tei = $_SESSION[DAUM_SESSION_NAME]["token_expire_in"];
		$ct = ceil((time()-$tei)/1000);  //�и��ʸ� �ʷ� ��ȯ
		
		$data="client_id=".$this->client_id."&client_secret=".$this->client_secret."&grant_type=authorization_code&code=".$this->returnCode."&redirect_uri=".$this->returnURL."&state=".$this->returnState;

//		$urldata = urlencode('client_id='.$this->client_id.'&client_secret='.$this->client_secret.'&grant_type=authorization_code&code='.$this->returnCode.'&redirect_uri='.$this->returnURL.'&state='.$this->returnState);

		curl_setopt($this->curl, CURLOPT_URL, DAUM_OAUTH_URL.'token');
		
		curl_setopt($this->curl, CURLOPT_POST, 1); 
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data); 
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,true); 
		$retVar = curl_exec($this->curl); 
		curl_close($this->curl);
		$DAUMreturns = json_decode($retVar);


		if($DAUMreturns->access_token){


			$this->access_token			= $DAUMreturns->access_token;
			$this->access_token_type	= $DAUMreturns->token_type;
			$this->refresh_token		= $DAUMreturns->refresh_token;
			$this->access_token_expire	= $DAUMreturns->expires_in;
			$this->access_token_expire_in = time();

			$this->saveSession();

		}
		return $this->access_token;
 }

 function testLogin()
 {
		echo '<a href="javascript:loginDAUM();"><img src="'.G5_PLUGIN_URL.'/social_login/daum/image/slogin_daum.jpg" alt="���� ���̵�� �α���" width="37" height="37"></a>';
			echo '
			<script>
			function loginDAUM(){
				var win = window.open(\''.DAUM_OAUTH_URL.'authorize?client_id='.$this->client_id.'&client_secret='.$this->client_secret.'&response_type=code&redirect_uri='.$this->returnURL.'&state='.$this->state.'\', \'DAUMlogin\',\'width=320, height=480, toolbar=no, location=no\'); 
			
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
			$datas['Authorization'] = $this->access_token_type.' '.$this->access_token;
			$data = "/user/v1/show?access_token=".$this->access_token;

			$this->curl = curl_init();
			curl_setopt($this->curl, CURLOPT_URL, 'https://apis.daum.net/user/v1/show?access_token='.$this->access_token);
//			curl_setopt($this->curl, CURLOPT_POST, 1); 
//			curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data); 
			curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
//			curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
//				'Authorization: '.$datas['Authorization']
//			));

			curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,true); 
			$retVar = curl_exec($this->curl); 
			curl_close($this->curl);
			return $retVar; //������ �⺻ XML��
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
				$_SESSION[DAUM_SESSION_NAME][$k] = $v;
			}
		}
	}


	function deleteSession(){
		if(isset($_SESSION) && is_array($_SESSION) && $_SESSION[DAUM_SESSION_NAME]){
			$_loadSession = array();
			$this->tokenDatas = $_loadSession;

			unset($_SESSION[DAUM_SESSION_NAME]);

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

		if(isset($_SESSION) && is_array($_SESSION) && $_SESSION[DAUM_SESSION_NAME]){
			
			$_loadSession = array();
			$_loadSession['access_token']		=	$_SESSION[DAUM_SESSION_NAME]['access_token'] ? $_SESSION[DAUM_SESSION_NAME]['access_token'] : '';
			$_loadSession['access_token_type']	=	$_SESSION[DAUM_SESSION_NAME]['access_token_type'] ? $_SESSION[DAUM_SESSION_NAME]['access_token_type'] : '';
			$_loadSession['refresh_token']		=	$_SESSION[DAUM_SESSION_NAME]['refresh_token'] ? $_SESSION[DAUM_SESSION_NAME]['refresh_token'] : '';
			$_loadSession['access_token_expire']	=	$_SESSION[DAUM_SESSION_NAME]['access_token_expire'] ? $_SESSION[DAUM_SESSION_NAME]['access_token_expire']:'';
			$_loadSession['access_token_expire_in']	=	$_SESSION[DAUM_SESSION_NAME]['access_token_expire_in'] ? $_SESSION[DAUM_SESSION_NAME]['access_token_expire_in']:'';
			
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