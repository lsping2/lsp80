<?

//###########################################
//##													 ##
//##	 ����������  / ���࿩�� ��� ���� ( ����ȸ��, ������ ��λ���)	 ##
//##													 ##
//###########################################




require_once "../../../include/include.php";
html_cache_disable();

require_once "../../login/login_check.php";


$publish_title=		request( 'publish_title', 'get' );
$publish_no =		request( 'publish_no', 'get' );




$db = new MYSQL;

$query = "
				DELETE FROM coupon.coupon_publish_info WHERE publish_no = '$publish_no'
";

$query2 = "
				DELETE FROM coupon.coupon_publish WHERE publish_no = '$publish_no' 
";


$db->query( $query );
$db->query( $query2 );
$db->close();



js_code( "parent.window.location.reload()" );		// ���� ���¼� ���ε� �ϱ�
?>