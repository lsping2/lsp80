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

include "db_info.php";




$arr = explode("/", $_REQUEST['url']);

if( count($arr)>= 1) $category = $arr[0]; // 구분자.
if( count($arr)>= 2) $type = $arr[1];      // 중간 구분자.
if( count($arr)>= 3) $seq = $arr[2];      // 세번째 구분자.

$headers = getallheaders();

$accept = $headers['Accept'];                 // 리턴타입을 결정하기 위하여 사용됨.

$method = $_SERVER['REQUEST_METHOD']; // GET, POST, DELETE, PUT
 //$method ='POST';

 if( $method == "POST" && $category == "info"){

  header("Content-Type:application/json");

  $inputJSON = file_get_contents('php://input');
  $input= json_decode( $inputJSON, TRUE ); //convert JSON into array


	// 로그인
	if($type == "login" ){

		$mb_id		= $input['mb_id'];
	    $mb_pw		= $input['mb_pw'];
	    $device_id	= $input['device_id'];

		//$mb_id		= 'test';
		//$mb_pw		= '1234';

		$text = implode("^",$input);
		 $sql = "insert into app_log	set
							content			=	'$text',
							reg_date			= now()

		";
		 mysql_query($sql);

		check_login($mb_id, $mb_pw,$device_id);
	}

 }

//require_once 'count.php';









 function check_login($mb_id, $mb_pw,$device_id){

	$query = "SELECT mb_no, mb_password, mb_id, mb_name, mb_datetime   from g5_member where mb_id = '$mb_id' ";
	$query = mysql_query($query);
	$num=mysql_num_rows($query);
	$row=mysql_fetch_array($query);

	$products_arr=array();
	$products_arr["records"]=array();

	if (!$row['mb_id'] ) {
		$product_item=array(
				"status" => '401'
			);
	}elseif ( sql_password($mb_pw) != $row['mb_password'] ) {
		$product_item=array(
				"status" => '400'
			);
	}else{

			$secret_key = "YOUR_SECRET_KEY";
			$issuer_claim = "THE_ISSUER"; // this can be the servername
			$audience_claim = "THE_AUDIENCE";
			$issuedat_claim = time(); // issued at
			$notbefore_claim = $issuedat_claim + 10; //not before in seconds
			$expire_claim = $issuedat_claim + 60 * 60; // expire time in seconds --1시간

			$token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
			"data" => array(
					"status" => '200',
					"mb_id" => $row['mb_id'],
					"mb_name" => $row['mb_name'],
					"mb_datetime" => $row['mb_datetime']
					)
           );

			$jwt = JWT::encode($token, $secret_key);
			
			$product_item=array(
					"status" => '200',
					"jwt" => $jwt
				
				);
			

			// 디바이스ID update
			if($device_id){
				 $sql = "update	g5_member	set
									mb_1			=	'$device_id',
									mb_2			=	'$jwt'
						where	mb_id			= '$row[mb_id]'
				";
				$rs = mysql_query($sql);
			}
	}
	array_push($products_arr["records"], $product_item);

	echo to_han(json_encode($products_arr));

 }




//한글처리 5.3 이하
function han ($s) {
	return reset(json_decode('{"s":"'.$s.'"}'));
}
function to_han ($str) {
	return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',$str);
}



// 임시 패스워드 암호화
function sql_password($value)
{
    $query = "select password('$value') as pass ";
	$query = mysql_query($query);
	$row=mysql_fetch_array($query);

    return $row['pass'];
}
?>