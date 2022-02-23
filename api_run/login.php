<?
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Content-Type:application/json");
session_start();

include "../api/db_info.php";

$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array

$mb_id		= $input['mb_id'];
$mb_pw		= $input['mb_pw'];
$device_id	= $input['device_id'];

// log
if($input) $text = implode("^",$input);
 $sql = "insert into app_log	set
					content			=	'$text',
					reg_date			= now()

";
 mysql_query($sql);

// 회원 정보 체크
$query = "SELECT mb_no, mb_password, mb_id, mb_name, mb_datetime   from g5_member where mb_id = '$mb_id' ";
$query = mysql_query($query);
$num=mysql_num_rows($query);
$row=mysql_fetch_array($query);

$products_arr=array();
$products_arr["records"]=array();

if (!$row['mb_id'] ) {
	$result=array(
			"status" => '401'
		);
}elseif ( sql_password($mb_pw) != $row['mb_password'] ) {
	$result=array(
			"status" => '400'
		);
}else{
		
		// 토큰 발행( 한페이지내 유지안되서 다른경로로 생성)
		require_once $_SERVER["DOCUMENT_ROOT"]."/api_run/token.php";

		$result=array(
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
//array_push($products_arr["records"], $result);

echo json_encode($result);







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