<?

function folder_info( $folder_no )
{

	$image_db = new MYSQL;

	global $dpi;
	global $folder_size;
	global $folder_name;
	global $pricelist_name;

	global $folder_sell_price;
	global $folder_mileage;

	$query = "
			SELECT	spf.dpi ,
					spf.folder_size ,
					spf.folder_price ,
					spn.pricelist_name ,
					spn.discount_rate ,
					spn.discount_price ,
					spn.mileage_rate ,
					spn.mileage_price
			FROM	single_pricelist_folder as spf ,
					single_pricelist_name as spn
			WHERE	spf.pricelist_no = spn.pricelist_no 
			AND		spf.folder_no = '$folder_no'
	";
	$image_db->query( $query );
	$image_db->fetch();

	$rs_dpi			= $image_db->result( 'dpi' );

	$rs_folder_size	= $image_db->result( 'folder_size' );
	$rs_folder_name	= $image_db->result( 'folder_name' );
	$rs_folder_price		= $image_db->result( 'folder_price' );
	$rs_pricelist_name	= $image_db->result( 'pricelist_name' );

	$rs_discount_rate	= $image_db->result( 'discount_rate' );
	$rs_discount_price	= $image_db->result( 'discount_price' );
	$rs_mileage_rate	= $image_db->result( 'mileage_rate' );
	$rs_mileage_price	= $image_db->result( 'mileage_price' );

	$txt_single_sell_price = number_format( $rs_folder_price ) . " 원";
	$txt_single_mileage = '';

	$dpi = $rs_dpi;
	$folder_size		= $rs_folder_size;
	$folder_name		= $rs_folder_name;
	$pricelist_name	= $pricelist_name;

	// 싱글 할인가격
	if( $rs_discount_rate )
	{
		$tmp_sell_price = ( $rs_discount_rate / 100 ) * $rs_folder_price;
		$single_discount_sell_price = $rs_folder_price - (int)( $tmp_sell_price / 10 ) * 10;
		
		$txt_single_sell_price ="<del>" . number_format( $rs_folder_price ) . " 원</del> → <font color=#FF3300>" . number_format( $single_discount_sell_price ) . " 원</font>";
	}
	elseif( $rs_discount_price )
	{
		$single_discount_sell_price = $rs_folder_price - $rs_discount_price;
		$txt_single_sell_price ="<del>" . number_format( $rs_folder_price ) . " 원</del> → <font color=#FF3300>" . number_format( $single_discount_sell_price ) . " 원</font>";
	}
	else
	{
		$single_discount_sell_price = $rs_folder_price;
	}

	$folder_sell_price = $txt_single_sell_price;

	// 싱글 적립금
	if( $rs_mileage_rate )
	{
		$tmp_mileage = ( $rs_mileage_rate / 100 ) * $single_discount_sell_price;
		$tmp_mileage = (int)( $tmp_mileage / 10 ) * 10;
		
		$txt_single_mileage =number_format( $tmp_mileage ) . " 원";
	}
	elseif( $rs_mileage_price )
	{
		$tmp_mileage = $rs_mileage_price;
		$txt_single_mileage = number_format( $tmp_mileage ) . " 원";
	}

	$folder_mileage = $txt_single_mileage;

}

function product_info( $product_class, $product_no )
{


	$image_db = new MYSQL;

	global $product_image_order_no;
	global $product_order_no;
	global $product_sell_price;
	global $product_mileage;
	global $product_image_name;
	global $product_data_folder_name;

	global $product_cd_sell_status;
	global $product_vcd_sell_status;
	global $product_single_sell_status;

	if( 'image' == $product_class )
	{

		$query = "
							SELECT	pi.product_class ,
									pi.cd_order_no ,
									pi.single_order_no ,
									pi.data_folder_no ,
									df.data_folder_name ,
									pi.image_name ,
									pi.cd_sell_status ,
									pi.vcd_sell_status ,
									pi.single_sell_status
							FROM	product_images as pi ,
									data_folder as df
							WHERE	pi.data_folder_no = df.data_folder_no
							AND		pi.image_no = '$product_no'
		";
		$image_db->query( $query );
		$image_db->fetch();

		$rs_product_class		= $image_db->result( 'product_class' );
		$rs_cd_order_no		= $image_db->result( 'cd_order_no' );
		$rs_single_order_no	= $image_db->result( 'single_order_no' );
		$rs_data_folder_no		= $image_db->result( 'data_folder_no' );
		$rs_data_folder_name	= $image_db->result( 'data_folder_name' );
		$rs_image_name		= $image_db->result( 'image_name' );
		$rs_cd_sell_status		= $image_db->result( 'cd_sell_status' );
		$rs_vcd_sell_status		= $image_db->result( 'vcd_sell_status' );
		$rs_single_sell_status	= $image_db->result( 'single_sell_status' );

		$product_image_order_no = $rs_single_order_no;
		$product_order_no = $rs_cd_order_no;
		$product_data_folder_name = $rs_data_folder_name;
		$product_image_name = $rs_image_name;

		$product_cd_sell_status = $rs_cd_sell_status;
		$product_vcd_sell_status = $rs_vcd_sell_status;
		$product_single_sell_status = $rs_single_sell_status;

	}

	if( 'single' == $product_class )
	{

		$query = "
				SELECT	ps.single_no ,
						pi.product_class ,
						pi.cd_order_no ,
						pi.single_order_no ,
						pi.data_folder_no ,
						df.data_folder_name ,
						pi.image_name ,
						pi.cd_sell_status ,
						pi.vcd_sell_status ,
						pi.single_sell_status
				FROM	product_images as pi ,
						product_single as ps ,
						data_folder as df
				WHERE	pi.image_no = ps.image_no
				AND		pi.data_folder_no = df.data_folder_no
				AND		pi.image_no = '$product_no'
		";

		$query = "
				SELECT	pi.product_class ,
						pi.cd_order_no ,
						pi.single_order_no ,
						pi.data_folder_no ,
						df.data_folder_name ,
						pi.image_name ,
						pi.cd_sell_status ,
						pi.vcd_sell_status ,
						pi.single_sell_status
				FROM	product_images as pi ,
						data_folder as df
				WHERE	pi.data_folder_no = df.data_folder_no
				AND		pi.image_no = '$product_no'
		";
		$image_db->query( $query );
		$image_db->fetch();

		$rs_product_class		= $image_db->result( 'product_class' );
		$rs_cd_order_no		= $image_db->result( 'cd_order_no' );
		$rs_single_order_no	= $image_db->result( 'single_order_no' );
		$rs_data_folder_no		= $image_db->result( 'data_folder_no' );
		$rs_data_folder_name	= $image_db->result( 'data_folder_name' );
		$rs_image_name		= $image_db->result( 'image_name' );
		$rs_cd_sell_status		= $image_db->result( 'cd_sell_status' );
		$rs_vcd_sell_status		= $image_db->result( 'vcd_sell_status' );
		$rs_single_sell_status	= $image_db->result( 'single_sell_status' );

		$product_image_order_no = $rs_single_order_no;
		$product_order_no = $rs_cd_order_no;
		$product_data_folder_name = $rs_data_folder_name;
		$product_image_name = $rs_image_name;

		$product_cd_sell_status = $rs_cd_sell_status;
		$product_vcd_sell_status = $rs_vcd_sell_status;
		$product_single_sell_status = $rs_single_sell_status;

	} // 'single' == $product_class

	elseif( 'cd' == $product_class )
	{

		$query = "
				SELECT	pc.cd_order_no ,
						pc.name_kr ,
						pc.name_eg ,
						pc.jacket_pic ,
						pc.cd_sell_price ,
						pc.vcd_sell_price ,
						pc.cd_discount_rate ,
						pc.cd_discount_price ,
						pc.cd_mileage_rate ,
						pc.cd_mileage_price ,
						pc.vcd_discount_rate ,
						pc.vcd_discount_price ,
						pc.vcd_mileage_rate ,
						pc.vcd_mileage_price ,
						pc.info1 ,
						pc.info2 ,
						pc.info3 ,
						pc.info4 ,
						pc.info5 ,
						pc.info6 ,
						pc.manufacture_code ,
						pmc.manufacture_name ,
						pc.data_folder_no ,
						df.data_folder_name
				FROM	product_cd as pc ,
						data_folder df ,
						product_manufacture_code pmc
				WHERE	pc.data_folder_no = df.data_folder_no
				AND		pc.manufacture_code = pmc.manufacture_code
				AND		pc.cd_no = '$product_no'
		";
		$image_db->query( $query );
		$image_db->fetch();
		
		$rs_cd_order_no		= $image_db->result( 'cd_order_no' );
		$rs_name_kr			= $image_db->result( 'name_kr' );
		$rs_name_eg			= $image_db->result( 'name_eg' );
		$rs_jacket_pic			= $image_db->result( 'jacket_pic' );
		$rs_cd_sell_price		= $image_db->result( 'cd_sell_price' );
		$rs_vcd_sell_price		= $image_db->result( 'vcd_sell_price' );
		$rs_cd_discount_rate	= $image_db->result( 'cd_discount_rate' );
		$rs_cd_discount_price	= $image_db->result( 'cd_discount_price' );
		$rs_cd_mileage_rate	= $image_db->result( 'cd_mileage_rate' );
		$rs_cd_mileage_price	= $image_db->result( 'cd_mileage_price' );
		$rs_vcd_discount_rate	= $image_db->result( 'vcd_discount_rate' );
		$rs_vcd_discount_price	= $image_db->result( 'vcd_discount_price' );
		$rs_vcd_mileage_rate	= $image_db->result( 'vcd_mileage_rate' );
		$rs_vcd_mileage_price	= $image_db->result( 'vcd_mileage_price' );
		$rs_info1				= $image_db->result( 'info1' );
		$rs_info2				= $image_db->result( 'info2' );
		$rs_info3				= $image_db->result( 'info3' );
		$rs_info4				= $image_db->result( 'info4' );
		$rs_info5				= $image_db->result( 'info5' );
		$rs_info6				= $image_db->result( 'info6' );
		$rs_manufacture_code	= $image_db->result( 'manufacture_code' );
		$rs_manufacture_name	= $image_db->result( 'manufacture_name' );
		$rs_data_folder_no		= $image_db->result( 'data_folder_no' );
		$rs_data_folder_name	= $image_db->result( 'data_folder_name' );

		$product_order_no			= $rs_cd_order_no;
		$product_data_folder_name	= $rs_data_folder_name;
		$product_image_name		= $rs_jacket_pic;

		$txt_cd_sell_price = number_format( $rs_cd_sell_price ) . " 원";
		$txt_cd_mileage = '';

		// CD 할인가격
		if( $rs_cd_discount_rate )
		{
			$tmp_sell_price = ( $rs_cd_discount_rate / 100 ) * $rs_cd_sell_price;
			$cd_discount_sell_price = $rs_cd_sell_price - (int)( $tmp_sell_price / 10 ) * 10;
			
			$txt_cd_sell_price ="<del>" . number_format( $rs_cd_sell_price ) . " 원</del> → <font color=#FF3300>" . number_format( $cd_discount_sell_price ) . " 원</font>";
		}
		elseif( $rs_cd_discount_price )
		{
			$cd_discount_sell_price = $rs_cd_sell_price - $rs_cd_discount_price;
			$txt_cd_sell_price ="<del>" . number_format( $rs_cd_sell_price ) . " 원</del> → <font color=#FF3300>" . number_format( $cd_discount_sell_price ) . " 원</font>";
		}
		else
		{
			$cd_discount_sell_price = $txt_cd_sell_price;
		}

		$product_sell_price = $txt_cd_sell_price;

		// CD 적립금
		if( $rs_cd_mileage_rate )
		{
			$tmp_mileage = ( $rs_cd_mileage_rate / 100 ) * $cd_discount_sell_price;
			$tmp_mileage = (int)( $tmp_mileage / 10 ) * 10;
			
			$txt_cd_mileage =number_format( $tmp_mileage ) . " 원";
		}
		elseif( $rs_cd_mileage_price )
		{
			$tmp_mileage = $rs_cd_mileage_price;
			$txt_cd_mileage = number_format( $tmp_mileage ) . " 원";
		}

		$product_mileage = $txt_cd_mileage;

	}
	elseif( 'vcd' == $product_class )
	{

		$query = "
				SELECT	pc.cd_order_no ,
						pc.name_kr ,
						pc.name_eg ,
						pc.jacket_pic ,
						pc.cd_sell_price ,
						pc.vcd_sell_price ,
						pc.cd_discount_rate ,
						pc.cd_discount_price ,
						pc.cd_mileage_rate ,
						pc.cd_mileage_price ,
						pc.vcd_discount_rate ,
						pc.vcd_discount_price ,
						pc.vcd_mileage_rate ,
						pc.vcd_mileage_price ,
						pc.info1 ,
						pc.info2 ,
						pc.info3 ,
						pc.info4 ,
						pc.info5 ,
						pc.info6 ,
						pc.manufacture_code ,
						pmc.manufacture_name ,
						pc.data_folder_no ,
						df.data_folder_name
				FROM	product_cd as pc ,
						data_folder df ,
						product_manufacture_code pmc
				WHERE	pc.data_folder_no = df.data_folder_no
				AND		pc.manufacture_code = pmc.manufacture_code
				AND		pc.cd_no = '$product_no'
		";
		$image_db->query( $query );
		$image_db->fetch();
		
		$rs_cd_order_no		= $image_db->result( 'cd_order_no' );
		$rs_name_kr			= $image_db->result( 'name_kr' );
		$rs_name_eg			= $image_db->result( 'name_eg' );
		$rs_jacket_pic			= $image_db->result( 'jacket_pic' );
		$rs_cd_sell_price		= $image_db->result( 'cd_sell_price' );
		$rs_vcd_sell_price		= $image_db->result( 'vcd_sell_price' );
		$rs_cd_discount_rate	= $image_db->result( 'cd_discount_rate' );
		$rs_cd_discount_price	= $image_db->result( 'cd_discount_price' );
		$rs_cd_mileage_rate	= $image_db->result( 'cd_mileage_rate' );
		$rs_cd_mileage_price	= $image_db->result( 'cd_mileage_price' );
		$rs_vcd_discount_rate	= $image_db->result( 'vcd_discount_rate' );
		$rs_vcd_discount_price	= $image_db->result( 'vcd_discount_price' );
		$rs_vcd_mileage_rate	= $image_db->result( 'vcd_mileage_rate' );
		$rs_vcd_mileage_price	= $image_db->result( 'vcd_mileage_price' );
		$rs_info1				= $image_db->result( 'info1' );
		$rs_info2				= $image_db->result( 'info2' );
		$rs_info3				= $image_db->result( 'info3' );
		$rs_info4				= $image_db->result( 'info4' );
		$rs_info5				= $image_db->result( 'info5' );
		$rs_info6				= $image_db->result( 'info6' );
		$rs_manufacture_code	= $image_db->result( 'manufacture_code' );
		$rs_manufacture_name	= $image_db->result( 'manufacture_name' );
		$rs_data_folder_no		= $image_db->result( 'data_folder_no' );
		$rs_data_folder_name	= $image_db->result( 'data_folder_name' );

		$product_order_no = $rs_cd_order_no;
		$product_data_folder_name = $rs_data_folder_name;
		$product_image_name = $rs_jacket_pic;

		$txt_vcd_sell_price = number_format( $rs_vcd_sell_price ) . " 원";
		$txt_vcd_mileage = '';

		if( $rs_vcd_discount_rate )
		{
			$tmp_sell_price = ( $rs_vcd_discount_rate / 100 ) * $rs_vcd_sell_price;
			$vcd_discount_sell_price = $rs_vcd_sell_price - (int)( $tmp_sell_price / 10 ) * 10;
			
			$txt_vcd_sell_price ="<del>" . number_format( $rs_vcd_sell_price ) . " 원</del> → <font color=#FF3300>" . number_format( $vcd_discount_sell_price ) . " 원</font>";
		}
		elseif( $rs_cd_discount_price )
		{
			$vcd_discount_sell_price = $rs_vcd_sell_price - $rs_vcd_discount_price;
			$txt_vcd_sell_price ="<del>" . number_format( $rs_vcd_sell_price ) . " 원</del> → <font color=#FF3300>" . number_format( $vcd_discount_sell_price ) . " 원</font>";
		}
		else
		{
			$vcd_discount_sell_price = $txt_vcd_sell_price;
		}

		$product_sell_price = $txt_vcd_sell_price;

		// VCD 적립금
		if( $rs_vcd_mileage_rate )
		{
			$tmp_mileage = ( $rs_vcd_mileage_rate / 100 ) * $vcd_discount_sell_price;
			$tmp_mileage = (int)( $tmp_mileage / 10 ) * 10;
			
			$txt_vcd_mileage = number_format( $tmp_mileage ) . " 원";
		}
		elseif( $rs_vcd_mileage_price )
		{
			$tmp_mileage = $rs_vcd_mileage_price;
			$txt_vcd_mileage = number_format( $tmp_mileage ) . " 원";
		}

		$product_mileage = number_format( $txt_vcd_mileage ) . " 원";

	} // if( 'vcd' == $product_class )

}

?>