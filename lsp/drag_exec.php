<?
$T_URL = $_SERVER['DOCUMENT_ROOT'];
include($T_URL."/lsp/menu/include/include.php");

$db = new MYSQL();

$p_headerimages = $_POST['p_headerimages'];

print_r($p_headerimages);
for ($i = 0; $i < count($p_headerimages); $i++) {


		 $query = "
						UPDATE		test 
							SET		sort_it		= ".$i."
						WHERE		seq =  ".$p_headerimages[$i]."

					";


	$rs = $db->executeUpdate( $query );
}
?>