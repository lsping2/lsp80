<?
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/jwt/src/BeforeValidException.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/jwt/src/ExpiredException.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/jwt/src/SignatureInvalidException.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/jwt/src/JWT.php";

use \Firebase\JWT\JWT;

include $_SERVER["DOCUMENT_ROOT"]."/api_run/jwt_code.php";

 $token = array(
	 "iat" => $issuedAt,
	"jti" => $tokenId,
	"iss" => $severName,
	"nbf" => $notbefore,
	"exp" => $expire,
	"data" => array(
			"status" => '200',
			"mb_id" => $row['mb_id'],
			"mb_name" => $row['mb_name'],
			"mb_datetime" => $row['mb_datetime']
			)
   );

   $jwt = JWT::encode($token, $secret_key);

//$jwt="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MTAwMTgxMzEsImp0aSI6IllXUnRhVzQ9IiwiaXNzIjoiY29sIiwibmJmIjoxNjEwMDE4MTMxLCJleHAiOjE2MTAwMjE3MzEsImRhdGEiOnsic3RhdHVzIjoiMjAwIiwibWJfaWQiOiJhZG1pbiIsIm1iX25hbWUiOiJcdWNkNWNcdWFjZTBcdWFkMDBcdWI5YWNcdWM3OTAiLCJtYl9kYXRldGltZSI6IjIwMTUtMDctMDEgMTc6MTE6MzUifX0.zvVVo6FBDVdfwfA7KW5eTffk1WUOVbssoEjERavNY5I";

//$decoded = JWT::decode($jwt, $secret_key, array('HS256'));

//print_r($decoded);
?>