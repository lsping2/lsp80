<?
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

session_start();
//토큰
require_once $_SERVER["DOCUMENT_ROOT"]."/jwt/src/BeforeValidException.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/jwt/src/ExpiredException.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/jwt/src/SignatureInvalidException.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/jwt/src/JWT.php";
use \Firebase\JWT\JWT;

include $_SERVER["DOCUMENT_ROOT"]."/api_run/jwt_code.php";
//db
include "db_info.php";

/*
{
    "mb_id": "test",
    "mb_pw": "1234",
    "device_id": "tes253525t"
 }
 {
    "jwt" : "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MTAwOTEzNTcsImp0aSI6IllXUnRhVzQ9IiwiaXNzIjoiY29sIiwibmJmIjoxNjEwMDkxMzU3LCJleHAiOjE2MTAwOTQ5NTcsImRhdGEiOnsic3RhdHVzIjoiMjAwIiwibWJfaWQiOiJhZG1pbiIsIm1iX25hbWUiOiJcdWNkNWNcdWFjZTBcdWFkMDBcdWI5YWNcdWM3OTAiLCJtYl9kYXRldGltZSI6IjIwMTUtMDctMDEgMTc6MTE6MzUifX0.5oAg7gXeHeHfGtbw8QVLjn46DtCBZdwJeLlT6dxGObY"
}
*/

$arr = explode("/", $_REQUEST['url']);

if( count($arr)>= 1) $category = $arr[0]; // 구분자.
if( count($arr)>= 2) $type = $arr[1];      // 중간 구분자.
if( count($arr)>= 3) $seq = $arr[2];      // 세번째 구분자.

$headers = getallheaders();
$accept = $headers['Accept'];                 // 리턴타입을 결정하기 위하여 사용됨.
$method = $_SERVER['REQUEST_METHOD']; // GET, POST, DELETE, PUT
 

///////////////////////////////////////////// 토큰검사 테스트 ////////////////////////////////////////////////////
 // http://lsp80.cafe24.com/api/token/login   토큰검사 테스트 
 if(  $category == "token"){
	require_once $_SERVER["DOCUMENT_ROOT"]."/api_run/ckeck_token.php";
 }


///////////////////////////////////////////// 요청 ////////////////////////////////////////////////////
 if( $method == "POST" && $category == "info") {
	// http://lsp80.cafe24.com/api/info/login      로그인
	if($type == "login" ){
		require_once $_SERVER["DOCUMENT_ROOT"]."/api_run/login.php";
	}
 }


///////////////////////////////////////////// 조회 ////////////////////////////////////////////////////
 if( $method == "GET" && $category == "info"){
	// http://lsp80.cafe24.com/api/info/member  회원목록
	if($type == "member" ){
		require_once $_SERVER["DOCUMENT_ROOT"]."/api_run/member_list.php";
	}
 }
?>