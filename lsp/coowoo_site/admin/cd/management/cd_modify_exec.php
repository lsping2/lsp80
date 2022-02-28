<?

require_once "../../../include/include.php";
html_cache_disable();

require_once "../../login/login_check.php";
login_check( $PHP_SELF );

$page		= request( 'page', 'post' );
$cd_no		= request( 'cd_no' , 'post' );
$file		= request( 'file', 'post' );
$search_field	= request( 'search_field' , 'post' );
$search_key	= request( 'search_key' , 'post' );

$location = "search_field={$search_field}&search_key=" . htmlspecialchars( $search_key );

$name_kr				= trim( request( 'name_kr' , 'post' ) );
$name_eg			= trim( request( 'name_eg' , 'post' ) );
$product_class			= request( 'product_class' , 'post' );
$manufacture_code		= request( 'manufacture_code' , 'post' );
$license_code			= request( 'license_code' , 'post' );
$data_folder_no		= request( 'data_folder_no' , 'post' );
$cost				= trim( request( 'cost' , 'post' ) );
$money_code			= request( 'money_code' , 'post' );
$cd_sell_price			= trim( request( 'cd_sell_price' , 'post' ) );
$vcd_sell_price		= trim( request( 'vcd_sell_price' , 'post' ) );
$virtual_quantity_use	= request( 'virtual_quantity_use' , 'post' );
$real_quantity			= trim( request( 'real_quantity' , 'post' ) );
$cd_discount_rate		= trim( request( 'cd_discount_rate' , 'post' ) );
$cd_discount_price		= trim( request( 'cd_discount_price' , 'post' ) );
$cd_mileage_rate		= trim( request( 'cd_mileage_rate' , 'post' ) );
$cd_mileage_price		= trim( request( 'cd_mileage_price' , 'post' ) );
$vcd_discount_rate		= trim( request( 'vcd_discount_rate' , 'post' ) );
$vcd_discount_price	= trim( request( 'vcd_discount_price' , 'post' ) );
$vcd_mileage_rate		= trim( request( 'vcd_mileage_rate' , 'post' ) );
$vcd_mileage_price		= trim( request( 'vcd_mileage_price' , 'post' ) );
$info1				= trim( request( 'info1' , 'post' ) );
$info2				= trim( request( 'info2' , 'post' ) );
$info3				= trim( request( 'info3' , 'post' ) );
$info4				= trim( request( 'info4' , 'post' ) );
$info5				= trim( request( 'info5' , 'post' ) );
$info6				= trim( request( 'info6' , 'post' ) );
$spec				= trim( request( 'spec' , 'post' ) );
$cd_sell_status		= request( 'cd_sell_status' , 'post' );
$vcd_sell_status		= request( 'vcd_sell_status' , 'post' );
$single_sell_status		= request( 'single_sell_status' , 'post' );
$cd_info				= trim( request( 'cd_info' , 'post' ) );
$cd_warning			= trim( request( 'cd_warning' , 'post' ) );
$cd_keyword			= trim( request( 'cd_keyword' , 'post' ) );
$use_status			= request( 'use_status' , 'post' );


$query1 = "
			UPDATE product_cd	SET		name_kr				= '$name_kr' ,
									name_eg				= '$name_eg' ,
									product_class			= '$product_class' ,
									manufacture_code		= '$manufacture_code' ,
									license_code			= '$license_code' ,
									data_folder_no		= '$data_folder_no' ,
									cost					= '$cost' ,
									money_code			= '$money_code' ,
									cd_sell_price			= '$cd_sell_price' ,
									vcd_sell_price			= '$vcd_sell_price' ,
									virtual_quantity_use	= '$virtual_quantity_use' ,
									real_quantity			= '$real_quantity' ,
									cd_discount_rate		= '$cd_discount_rate' ,
									cd_discount_price		= '$cd_discount_price' ,
									cd_mileage_rate		= '$cd_mileage_rate' ,
									cd_mileage_price		= '$cd_mileage_price' ,
									vcd_discount_rate		= '$vcd_discount_rate' ,
									vcd_discount_price		= '$vcd_discount_price' ,
									vcd_mileage_rate		= '$vcd_mileage_rate' ,
									vcd_mileage_price		= '$vcd_mileage_price' ,
									info1					= '$info1' ,
									info2					= '$info2' ,
									info3					= '$info3' ,
									info4					= '$info4' ,
									info5					= '$info5' ,
									info6					= '$info6' ,
									spec					= '$spec' ,
									cd_sell_status			= '$cd_sell_status' ,
									vcd_sell_status		= '$vcd_sell_status' ,
									single_sell_status		= '$single_sell_status' ,
									use_status			= '$use_status'
							WHERE	cd_no				= '$cd_no'	
";

$db = new MYSQL();

$db->transaction();
$db->query( $query1 );

if( !$db->confirm_flag )
{

	$db->rollback();
	ERROR::error_msg( '수정중 에러가 발생하였습니다.<br>관리자에게 문의하세요.' );
	$db->close();
	exit;

}

$query2 = "

			UPDATE product_cd_info	SET		cd_info		= '$cd_info' ,
										cd_warning	= '$cd_warning' ,
										cd_keyword	= '$cd_keyword'
								WHERE	cd_no		= '$cd_no'
";

$db->query( $query2 );

if( !$db->confirm_flag )
{

	$db->rollback();
	ERROR::error_msg( '수정중 에러가 발생하였습니다.<br>관리자에게 문의하세요.' );
	$db->close();
	exit;

}

// product_images 시디 이미지 업데이트
$query = "
					SELECT	cd_order_no
					FROM	product_cd
					WHERE	cd_no = '$cd_no'
";
$db->query( $query );
$db->fetch();

$rs_cd_order_no = $db->result( 'cd_order_no' );

$query = "
					UPDATE	 product_images		SET		manufacture_code = '$manufacture_code' ,
														cd_sell_status = '$cd_sell_status' ,
														vcd_sell_status = '$vcd_sell_status'
												WHERE	cd_order_no = '$rs_cd_order_no'
";
$db->query( $query );


$db->commit();

// 자켓이미지 섬네일 생성

$real_filename = $_FILES['jacket_pic']['name'];
$filesize = $_FILES['jacket_pic']['size'];

$tmp_filename = $file_md5 = '';
if( $real_filename )
{

	$largepic_dir = "/home/coowoo/www/jacket/200";
	$middlepic_dir = "/home/coowoo/www/jacket/140";
	$smallpic_dir = "/home/coowoo/www/jacket/100";
	$lowpic_dir = "/home/coowoo/www/jacket/80";

	// 기존 이미지가 있으면 삭제
	$query = "	SELECT	jacket_pic
				FROM	product_cd
				WHERE	cd_no = '$cd_no'
	";

	$db->query( $query );
	
	if( $db->total_record() )
	{
		$db->fetch();
		$rs_jacket_pic = $db->result( 'jacket_pic' );

		if( $rs_jacket_pic )
		{
			@unlink( $largepic_dir . "/" . $rs_jacket_pic );
			@unlink( $smallpic_dir . "/" . $rs_jacket_pic );
		}
	}

	$file_md5 = md5( time() ) . time();

	// 이미지크기 조정
	img_resize( $_FILES['jacket_pic']['tmp_name'] , $largepic_dir . "/" . $file_md5 . ".jpg", "equal", 200, 'No' );
	img_resize( $_FILES['jacket_pic']['tmp_name'] , $middlepic_dir . "/" . $file_md5 . ".jpg", "equal", 140 , 'No' );
	img_resize( $_FILES['jacket_pic']['tmp_name'] , $smallpic_dir . "/" . $file_md5 . ".jpg", "equal", 100, 'No' );
	img_resize( $_FILES['jacket_pic']['tmp_name'] , $lowpic_dir . "/" . $file_md5 . ".jpg", "equal", 80, 'No' );

	$query = "
				UPDATE product_cd	SET		jacket_real_pic = '$real_filename' ,
										jacket_pic = '{$file_md5}.jpg'
								WHERE	cd_no = '$cd_no'
	";

	$db->query( $query );

}

$db->close();

meta_go( "cd_modify.html?file={$file}&cd_no={$cd_no}&page={$page}&{$location}" );

?>

