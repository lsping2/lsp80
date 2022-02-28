<?
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//header("Content-Type:application/json");

//error_reporting(E_ALL);
//ini_set("display_errors", 1);


$identifier		= 'lsp@nate.com';
$username		= '홍길동';

$user = array(
				"identifier" => $identifier,
				"username" => $username
				);

$result=array(
				"status" => '200',
				"user"	=> $user,
			);

echo json_encode($result);
?>