<?

//###########################################
//##													 ##
//##	 쿠폰 발행회원   / [발행취소]	 (발행 회원 목록만 삭제)			 ##
//##													 ##
//###########################################



require_once "../../../include/include.php";
html_cache_disable();

require_once "../../login/login_check.php";


$user_id	=		request( 'user_id', 'get' );
$publish_no =		request( 'publish_no', 'get' );

$db = new MYSQL;

$query = "
				DELETE FROM coupon.coupon_publish_info WHERE publish_no = '$publish_no' AND user_id = '$user_id'
";

$db->query( $query );
$db->close();



js_code( "parent.window.location.reload()" );		// 현제 상태서 리로드 하기
?>