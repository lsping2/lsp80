<?
//####################################
//##											##
//##	 ���������� / [��������] �˾��� �ѻ���� ��������. 	##
//##			      ( ����ȸ��, ������ ��λ���)		##
//####################################



require_once "../../../include/include.php";
html_cache_disable();

require_once "../../login/login_check.php";


$publish_no =		request( 'publish_no', 'get' );
$user_id	=		request( 'user_id', 'get' );




$db = new MYSQL;

 $query = "
				DELETE FROM coupon.coupon_publish_info WHERE publish_no = '$publish_no'  AND user_id = '$user_id'
";


$db->query( $query );
$db->close();

js_code( "parent.opener.location.reload();");	


js_code( "parent.location.reload();");	


?>

