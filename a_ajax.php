<?
$T_URL = $_SERVER['DOCUMENT_ROOT'];
include($T_URL."/db_include/include.php");
$db = new MYSQL();

  $query = " INSERT INTO test2 (
					subject 
					)
					VALUES (
					 'test'
					);";
					

	$rs = $db->executeUpdate( $query );
	echo $rs ;
?>