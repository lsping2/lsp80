<?

require_once "../../../include/include.php";
html_cache_disable();

require_once "../../login/login_check.php";
login_check( $PHP_SELF );

$coupon_no		= request( 'coupon_no', 'post' );
$coupon_title		= trim( request( 'coupon_title', 'post' ) );

$discount_rate		= trim( request( 'discount_rate', 'post' ) );
$discount_price	= trim( request( 'discount_price', 'post' ) );
$mileage_rate		= trim( request( 'mileage_rate' , 'post' ) );
$mileage_price		= trim( request( 'mileage_price', 'post' ) );

$use_month			= trim( request( 'use_month', 'post' ) );
$use_week			= trim( request( 'use_week', 'post' ) );
$use_day				= trim( request( 'use_day', 'post' ) );

$from_year		= request( 'from_year', 'post' );
$from_month		= request( 'from_month', 'post' );
$from_day		= request( 'from_day', 'post' );

$to_year			= request( 'to_year', 'post' );
$to_month		= request( 'to_month', 'post' );
$to_day			= request( 'to_day', 'post' );

$date_start		= $from_year . sprintf( "-%02d-%02d" , $from_month, $from_day );
$date_end		= $to_year . sprintf( "-%02d-%02d" , $to_month, $to_day );

if( !$coupon_title )
{
	js_msg( "쿠폰 이름을 입력하세요." );
	exit;
}

if( !$discount_rate AND !$discount_price AND !$mileage_rate AND !$mileage_price )
{
	js_msg( "(할인률,할인가,적립률,적립가)를 입력하세요." );
	exit;
}

$db = new MYSQL;

$query = "
			UPDATE coupon.coupon	SET		coupon_title	= '$coupon_title' ,
										discount_rate	= '$discount_rate' ,
										discount_price	= '$discount_price' ,
										mileage_rate	= '$mileage_rate' ,
										mileage_price	= '$mileage_price' ,
										use_month	= '$use_month' ,
										use_week	= '$use_week' ,
										use_day		= '$use_day' ,
										date_start	= '$date_start' ,
										date_end		= '$date_end'
								WHERE	coupon_no	= '$coupon_no'
";
$db->query( $query );


$query = "
			SELECT	coupon_img_name
			FROM	coupon.coupon
			WHERE	coupon_no = '$coupon_no'
";
$db->query( $query );
$db->fetch();

$rs_coupon_img_name = $db->result( 'coupon_img_name' );

@unlink( $coupon_dir . "/large/" . $rs_coupon_img_name );
@unlink( $coupon_dir . "/single/" . $rs_coupon_img_name );

$coupon_img_realname = $_FILES['coupon_img']['name'];
$tmp_filename = $file_md5 = '';
if( $coupon_img_realname )
{

	$coupon_dir = $SERVER_CONFIG['coupon_dir'];

	$file_md5 = md5( time() ) . time() . ".jpg";
	move_uploaded_file( $_FILES['coupon_img']['tmp_name'] , $coupon_dir . "/large/" . $file_md5 );
	img_resize( $coupon_dir . "/large/" . $file_md5 , $coupon_dir . "/small/" . $file_md5, "auto", 150 , 'No' );

	$query = "
				UPDATE coupon.coupon	SET		coupon_img_name		= '$file_md5' ,
											coupon_img_realname	= '$coupon_img_realname'
									WHERE	coupon_no = '$coupon_no'
	";

	$db->query( $query );

}

$db->close();

js_msg( "수정되었습니다." );
js_code( "parent.window.location.reload()" );

?>