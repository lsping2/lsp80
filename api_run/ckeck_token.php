<?
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
session_start();

//echo date("Y-m-d H:i:s", "1610013826");
//echo "==";
//echo date("Y-m-d H:i:s", "1610014318");
//exit;
//토큰
require_once $_SERVER["DOCUMENT_ROOT"]."/jwt/src/BeforeValidException.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/jwt/src/ExpiredException.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/jwt/src/SignatureInvalidException.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/jwt/src/JWT.php";
use \Firebase\JWT\JWT;

include $_SERVER["DOCUMENT_ROOT"]."/api_run/jwt_code.php";

 header("Content-Type:application/json");
$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array
// get jwt
$jwt=isset($input['jwt']) ? $input['jwt'] : "";

if($jwt){
	// if decode succeed, show user details
		try {

			$decoded = JWT::decode($jwt, $secret_key, array('HS256'));
			
			echo json_encode(array(
				"status" => '200',
				"message" => "Access granted.",
				"data" => $decoded
			));	
		
		}

		catch (Exception $e){

			echo json_encode(array(
				"status" => '401',
				"message" => "Access denied1.",
				"error" => "token error"
			));

		}
}else{
		echo json_encode(array(
			"status" => '401',
			"message" => "Access denied2.",
			"error" => "token error"
		));
}
?>