<?

require_once "../../../include/include.php";
html_cache_disable();


$cd_no					= request( 'cd_no' , 'get' );

$db = new MYSQL;

$query = "
				DELETE FROM product_cd WHERE cd_no = '$cd_no'
";
$db->query( $query );
$db->close();

js_code( "parent.window.location.reload()" );

?>

