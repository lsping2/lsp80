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
include "../api/db_info.php";

$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array
// get jwt
$jwt=isset($input['jwt']) ? $input['jwt'] : "";

if($jwt){
	// if decode succeed, show user details
		try {

			$decoded = JWT::decode($jwt, $secret_key, array('HS256'));
			$flag = true;
				if( true){ //$input['mb_id'] == "admin"
						// 회원 정보 
						$query = "SELECT mb_no, mb_id, mb_name, mb_datetime   from g5_member";
						$result = mysql_query($query);
						$num=mysql_num_rows($result);

						for($i=0; $i<$row=mysql_fetch_array($result); $i++){

							$data[] = array(
										'mb_no' => $row['mb_no'], 
										'mb_id' => $row['mb_id'], 
										'mb_name' => $row['mb_name'], 
										'mb_datetime' => $row2['mb_datetime']
								);
							
						}

						$result=array(
							"status" => '200',
							"data"	=> $data,
							"jwt" => $decoded
						);

						echo json_encode($result);
				}else{ // 일반유저
						$result=array(
							"status" => '400',
							"message"	=> "Access denied0.",
							"error" => "auth error"
						);

						echo json_encode($result);
				}
			
			
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