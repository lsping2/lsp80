<?

require_once "../../../include/include.php";
html_cache_disable();

$coupon_no = request( 'coupon_no' , 'get' );

$db = new MYSQL;

$query = "
				UPDATE coupon.coupon SET use_status = 'No' WHERE coupon_no = '$coupon_no'
";
$db->query( $query );

js_code( "parent.window.location.reload()" );

?>