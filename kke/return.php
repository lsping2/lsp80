<?
	$param = unserialize(base64_decode($_POST['token']));


 	$host="localhost";
	$user="lsp80";
	$password="dldks1006";

	$dbname="lsp80";

	$mid=$param[mid];

	$db=mysql_connect($host,$user,$password);
	mysql_select_db("$dbname",$db);
?>
<?

if($mid){
	mysql_query("insert into kke_test(mid)values('$mid')");

$q=mysql_query("select * from kke_test ");
	while($f=mysql_fetch_array($q)){
		echo $f[mid]."<br>";
	}
}else{
	echo "파라미터없음";

	$q=mysql_query("select * from kke_test ");
	while($f=mysql_fetch_array($q)){
		echo $f[mid]."<br>";
	}


}
?>