<?

require_once "../../../include/include.php";
html_cache_disable();

require_once "../../login/login_check.php";
login_check( $PHP_SELF );

$cd_no		= request( 'cd_no' , 'post' );
$management	= request( 'management' , 'post' );

$db = new MYSQL;

$query = "
		INSERT INTO product_cd_management	SET	management_no	= NULL ,
											cd_no			= '$cd_no' ,
											management		= '$management' ,
											user_id			= '$SUserID' ,
											reg_date			= now()
";
$db->query( $query );

?>
<script language=javascript>
parent.window.location.reload();
</script>

