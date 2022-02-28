<?

require_once "../../../include/include.php";
html_cache_disable();

require_once "../../login/login_check.php";
login_check( $PHP_SELF );

$management_no	= request( 'management_no' , 'get' );

$db = new MYSQL;

$query = "
		DELETE FROM product_cd_management WHERE management_no = '$management_no'
";
$db->query( $query );

?>
<script language=javascript>
parent.window.location.reload();
</script>

