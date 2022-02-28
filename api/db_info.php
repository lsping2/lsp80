<?
$host="localhost";
$user="lsp80";
$password="dldks1006";

$dbname="lsp80";

$db=mysql_connect($host,$user,$password);
mysql_select_db("$dbname",$db);

//header('Content-Type: application/json');
//header("HTTP/1.1 200 OK");
//header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

?>