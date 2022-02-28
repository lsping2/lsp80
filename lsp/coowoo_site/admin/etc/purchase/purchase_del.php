<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$purchase_no	= request( 'purchase_no' , 'GET' );

$db = new MYSQL;


$query = "
		DELETE FROM intranet.purchase_list WHERE purchase_no = '$purchase_no';
";
$db->query( $query );


js_code( "opener.window.location.reload();" );
js_code( "window.close();" );


?>