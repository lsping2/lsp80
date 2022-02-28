<?

//###########################################
//##													 ##
//##	 쿠폰발행목록  / 발행여부 취소 쿼리 ( 발행회원, 발행목록 모두삭제)	 ##
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



js_code( "parent.window.location.reload()" );		// 현제 상태서 리로드 하기
?>