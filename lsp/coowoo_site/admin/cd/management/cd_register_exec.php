<?

require_once "../../../include/include.php";

$cd_order_no			= strtoupper( trim( request( 'cd_order_no' , 'post' ) ) );
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

$httpvar = make_httpvar();

$db = new MYSQL();

$query = "
				SELECT *
				FROM	product_cd
				WHERE	cd_order_no = '$cd_order_no'
";
$db->query( $query );
if( $db->total_record() )
{
	js_msg( "이미 등록되어 있는 CD주문번호입니다." );
	exit;
}

$query1 = "
			INSERT INTO product_cd VALUES (	NULL ,
										'$cd_order_no' ,
										'$name_kr' ,
										'$name_eg' ,
										'photo' ,
										'$product_class' ,
										'$manufacture_code' ,
										'$license_code' ,
										'$data_folder_no' ,
										'' ,
										'' ,
										'' ,
										'$cost' ,
										'$money_code' ,
										'$cd_sell_price' ,
										'' ,
										'$vcd_sell_price' ,
										'$virtual_quantity_use' ,
										'$real_quantity' ,
										'$cd_discount_rate' ,
										'$cd_discount_price' ,
										'$cd_mileage_rate' ,
										'$cd_mileage_price' ,
										'$vcd_discount_rate' ,
										'$vcd_discount_price' ,
										'$vcd_mileage_rate' ,
										'$vcd_mileage_price' ,
										'$info1' ,
										'$info2' ,
										'$info3' ,
										'$info4' ,
										'$info5' ,
										'$info6' ,
										'$spec' ,
										'0' ,
										'0' ,
										'$cd_sell_status' ,
										'$vcd_sell_status' ,
										'$single_sell_status' ,
										'$use_status' ,
										'' ,
										now()	)
";


$db->transaction();
$db->query( $query1 );

$db->query( "SELECT LAST_INSERT_ID() as last_insert_id" );

$db->fetch();
$last_insert_id = $db->result( 'last_insert_id' );

$query2 = "
			INSERT INTO product_cd_info VALUES (	$last_insert_id ,
											'$cd_info' ,
											'$cd_warning' ,
											'$cd_keyword' )
";

$db->query( $query2 );

if( !$db->confirm_flag )
{

	$db->rollback();
	ERROR::error_msg( '등록중 에러가 발생하였습니다.<br>관리자에게 문의하세요.' );
	$db->close();
	exit;

}

// product_images에 섬네일이 등록되어있으면 정보 업데이트
$query = "
					UPDATE	 product_images		SET		manufacture_code = '$manufacture_code' ,
																		cd_sell_status = '$cd_sell_status' ,
																		vcd_sell_status = '$vcd_sell_status'
															WHERE	cd_order_no = '$cd_order_no'
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

	$file_md5 = md5( time() ) . time();

	// 이미지크기 조정
	img_resize( $_FILES['jacket_pic']['tmp_name'] , $largepic_dir . "/" . $file_md5 . ".jpg", "equal", 200 , 'No' );	  
	img_resize( $_FILES['jacket_pic']['tmp_name'] , $middlepic_dir . "/" . $file_md5 . ".jpg", "equal", 140 , 'No' );
	img_resize( $_FILES['jacket_pic']['tmp_name'] , $smallpic_dir . "/" . $file_md5 . ".jpg", "equal", 100 , 'No' );
	img_resize( $_FILES['jacket_pic']['tmp_name'] , $lowpic_dir . "/" . $file_md5 . ".jpg", "equal", 80, 'No' );

	$query = "
				UPDATE product_cd	SET		jacket_real_pic = '$real_filename' ,
															jacket_pic = '{$file_md5}.jpg'
												WHERE	cd_no = '$last_insert_id'
	";

	$db->query( $query );

}

$db->close();


js_code( "parent.window.location.href='cd_register.html?{$httpvar}'");

?>

