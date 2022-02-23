<?

class ProductInfo extends MYSQL
{

	// 싱글 폴더 정보 변수
	var $dpi;
	var $folder_size;
	var $folder_name;
	var $pricelist_name;

	var $folder_sell_price;
	var $folder_discount_sell_price;
	var $folder_mileage;

	// 제품 정보 변수
	var $product_image_order_no;
	var $product_order_no;
	var $product_sell_price;
	var $product_discount_sell_price;
	var $product_mileage;
	var $product_image_name;
	var $product_data_folder_name;
	var $product_sub_folder_name;

	var $product_discount_rate;
	var $product_discount_price;
	var $product_mileage_rate;
	var $product_mileage_price;

	var $product_cd_sell_status;
	var $product_vcd_sell_status;
	var $product_single_sell_status;

	var $manufacture_code;
	var $manufacture_name;
	var $license_code;
	var $cd_no;
	var $cd_order_no;
	var $name_kr;
	var $name_eg;
	var $jacket_pic;
	var $info1;
	var $info2;
	var $info3;
	var $info4;
	var $info5;
	var $info6;
	var $real_quantity;
	var $cd_sell_price;
	var $vcd_sell_price;
	var $cd_sell_status;
	var $vcd_sell_status;
	var $vat_price;

	var $use_status;

	function ProductInfo()
	{
		parent::mysql_open();
	}

	function folder_info( $folder_no )
	{

		// SINGLE 기본 적립금
		$query = "
				SELECT	mileage_no ,
							mileage_rate
				FROM	set_mileage
				WHERE	product_class = 'single'
		";
		$this->query( $query );
		$this->fetch();
		$basic_single_mileage_rate = $this->result( 'mileage_rate' );
		
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
		$this->query( $query );
		$this->fetch();	

		$rs_dpi			= $this->result( 'dpi' );

		$rs_folder_size	= $this->result( 'folder_size' );
		$rs_folder_price	= $this->result( 'folder_price' );
		$rs_pricelist_name	= $this->result( 'pricelist_name' );

		$rs_discount_rate	= $this->result( 'discount_rate' );
		$rs_discount_price	= $this->result( 'discount_price' );
		$rs_mileage_rate	= $this->result( 'mileage_rate' );
		$rs_mileage_price	= $this->result( 'mileage_price' );

		$txt_single_sell_price = number_format( $rs_folder_price ) . " 원";
		$txt_single_mileage = '';

		$this->dpi = $rs_dpi;
		$this->folder_size = $rs_folder_size;
		$this->folder_name = $rs_folder_name;
		$this->pricelist_name = $rs_pricelist_name;	

		// 부가세 제외가격
		$original_cd_sell_price = ( $rs_folder_price / 1.1 );
		$this->vat_price = number_format( $rs_folder_price - ( $rs_folder_price / 1.1 ) ) . " 원";
		$txt_cd_mileage = '';

		// 싱글 할인가격
		if( $rs_discount_rate )
		{
			$tmp_sell_price = ( $rs_discount_rate / 100 ) * $rs_folder_price;

			// 부가세 포함가격
			$single_discount_sell_price = $rs_folder_price;

			// 부가세 제외가격
			// $single_discount_sell_price = $rs_folder_price - (int)( $tmp_sell_price / 10 ) * 10;

			$original_single_sell_price = ( $single_discount_sell_price / 1.1 );
			$this->vat_price = number_format( $single_discount_sell_price - ( $single_discount_sell_price / 1.1 ) ) . " 원";

			$txt_single_sell_price ="<del>" . number_format( $rs_folder_price ) . " 원</del> → <font color=#FF3300>" . number_format( $single_discount_sell_price ) . " 원</font>";
		}
		elseif( $rs_discount_price )
		{
			$single_discount_sell_price = $rs_folder_price - $rs_discount_price;

			// 부가세 포함가격
			$original_single_sell_price = $single_discount_sell_price;

			// 부가세 제외가격
			// $original_single_sell_price = ( $single_discount_sell_price / 1.1 );
			$this->vat_price = number_format( $single_discount_sell_price - ( $single_discount_sell_price / 1.1 ) ) . " 원";

			$txt_single_sell_price ="<del>" . number_format( $rs_folder_price ) . " 원</del> → <font color=#FF3300>" . number_format( $single_discount_sell_price ) . " 원</font>";
		}
		else
		{
			$single_discount_sell_price = $rs_folder_price;
			
			// 부가세 포함가격
			$original_single_sell_price = $single_discount_sell_price;

			// 부가세 제외가격
			// $original_single_sell_price = ( $single_discount_sell_price / 1.1 );
			$this->vat_price = number_format( $single_discount_sell_price - ( $single_discount_sell_price / 1.1 ) ) . " 원";

			$txt_single_sell_price = number_format( $original_single_sell_price ) . " 원";
		}

		$this->folder_sell_price = $txt_single_sell_price;
		$this->folder_discount_sell_price = $single_discount_sell_price;

		// 한컷 적립금 (쿠우머니)
		if( $rs_mileage_rate )
		{
			$tmp_mileage = ( $rs_mileage_rate / 100 ) * $single_discount_sell_price;
			$tmp_mileage = (int)( $tmp_mileage / 10 ) * 10;
			
			$this->folder_mileage = number_format( $tmp_mileage ) . " 원";
		}
		elseif( $rs_mileage_price )
		{
			$tmp_mileage = $rs_mileage_price;
			$tmp_mileage = (int)( $tmp_mileage / 10 ) * 10;

			$this->folder_mileage = number_format( $tmp_mileage ) . " 원";

		}
		elseif( $basic_single_mileage_rate )
		{
			$tmp_mileage = ( $basic_single_mileage_rate / 100 ) * $single_discount_sell_price;
			$tmp_mileage = ( $tmp_mileage / 10 ) * 10;
			$this->folder_mileage = number_format( $tmp_mileage ) . " 원";
		}
		else
		{
			$this->folder_mileage = '';
		}

	}

	function product_info( $product_class, $product_no, $class = '' )
	{

		if( 'order_no' == $class )
		{
			if( 'single' == $product_class )
			{
				$query = "
						SELECT	image_no
						FROM	product_images
						WHERE	single_order_no = '$product_no'
				";
				$this->query( $query );
				$this->fetch();
				$product_no = $this->result( 'image_no' );
			}
			if( 'cd' == $product_class OR 'vcd' == $product_class )
			{
				$query = "
						SELECT	cd_no
						FROM	product_cd
						WHERE	cd_order_no = '$product_no'
				";
				$this->query( $query );
				$this->fetch();
				$product_no = $this->result( 'cd_no' );

			}
		}

		// CD 기본 적립금
		$query = "
						SELECT	mileage_no ,
								mileage_rate
						FROM	set_mileage
						WHERE	product_class = 'cd'
		";
		$this->query( $query );
		$this->fetch();
		$basic_cd_mileage_rate = $this->result( 'mileage_rate' );

		// VCD 기본 적립금
		$query = "
						SELECT	mileage_no ,
								mileage_rate
						FROM	set_mileage
						WHERE	product_class = 'vcd'
		";
		$this->query( $query );
		$this->fetch();
		$basic_vcd_mileage_rate = $this->result( 'mileage_rate' );

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
								pi.single_sell_status ,
								pi.manufacture_code
						FROM	product_images as pi ,
								data_folder as df
						WHERE	pi.data_folder_no = df.data_folder_no
						AND		pi.image_no = '$product_no'
			";
			$this->query( $query );
			$this->fetch();

			$rs_product_class		= $this->result( 'product_class' );
			$rs_cd_order_no		= $this->result( 'cd_order_no' );
			$rs_single_order_no	= $this->result( 'single_order_no' );
			$rs_data_folder_no		= $this->result( 'data_folder_no' );
			$rs_data_folder_name	= $this->result( 'data_folder_name' );
			$rs_image_name		= $this->result( 'image_name' );
			$rs_cd_sell_status		= $this->result( 'cd_sell_status' );
			$rs_vcd_sell_status		= $this->result( 'vcd_sell_status' );
			$rs_single_sell_status	= $this->result( 'single_sell_status' );
			$rs_manufacture_code	= $this->result( 'manufacture_code' );

			$this->manufacture_code = $rs_manufacture_code;

			$this->product_order_no			= $rs_single_order_no;
			$this->product_data_folder_name	= $rs_data_folder_name;
			$this->product_image_name		= $rs_image_name;
			$this->product_sub_folder_name	= $rs_cd_order_no;

			$this->product_cd_sell_status	= $rs_cd_sell_status;
			$this->product_vcd_sell_status	= $rs_vcd_sell_status;
			$this->product_single_sell_status	= $rs_single_sell_status;

		}

		if( 'single' == $product_class )
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
							pi.single_sell_status ,
							pi.manufacture_code ,
							pmc.manufacture_name
					FROM	product_images as pi ,
							data_folder as df ,
							product_manufacture_code pmc
					WHERE	pi.data_folder_no = df.data_folder_no
					AND		pi.manufacture_code = pmc.manufacture_code
					AND		pi.image_no = '$product_no'
			";
			$this->query( $query );
			$this->fetch();

			$rs_product_class		= $this->result( 'product_class' );
			$rs_cd_order_no		= $this->result( 'cd_order_no' );
			$rs_single_order_no	= $this->result( 'single_order_no' );
			$rs_data_folder_no		= $this->result( 'data_folder_no' );
			$rs_data_folder_name	= $this->result( 'data_folder_name' );
			$rs_image_name		= $this->result( 'image_name' );
			$rs_cd_sell_status		= $this->result( 'cd_sell_status' );
			$rs_vcd_sell_status		= $this->result( 'vcd_sell_status' );
			$rs_single_sell_status	= $this->result( 'single_sell_status' );
			$rs_manufacture_code	= $this->result( 'manufacture_code' );
			$rs_manufacture_name	= $this->result( 'manufacture_name' );

			$this->manufacture_code		= $rs_manufacture_code;
			$this->manufacture_name		= $rs_manufacture_name;

			$this->product_order_no			= $rs_single_order_no;
			$this->product_data_folder_name	= $rs_data_folder_name;
			$this->product_sub_folder_name	= $rs_cd_order_no;
			$this->product_image_name		= $rs_image_name;

			$this->product_cd_sell_status	= $rs_cd_sell_status;
			$this->product_vcd_sell_status	= $rs_vcd_sell_status;
			$this->product_single_sell_status	= $rs_single_sell_status;

		} // 'single' == $product_class

		elseif( 'cd' == $product_class )
		{

			$query = "
						SELECT	pc.cd_no ,
								pc.cd_order_no ,
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
								pc.real_quantity ,
								pc.info1 ,
								pc.info2 ,
								pc.info3 ,
								pc.info4 ,
								pc.info5 ,
								pc.info6 ,
								pc.spec ,
								pc.manufacture_code ,
								pmc.manufacture_name ,
								pc.license_code ,
								pc.data_folder_no ,
								df.data_folder_name ,
								pc.cd_sell_status ,
								pc.vcd_sell_status ,
								pc.use_status
						FROM	product_cd as pc ,
								data_folder df ,
								product_manufacture_code pmc
						WHERE	pc.data_folder_no = df.data_folder_no
						AND		pc.manufacture_code = pmc.manufacture_code
						AND		pc.cd_no = '$product_no'
			";
			$this->query( $query );
			$this->fetch();
			
			$rs_cd_no			= $this->result( 'cd_no' );
			$rs_cd_order_no		= $this->result( 'cd_order_no' );
			$rs_name_kr			= $this->result( 'name_kr' );
			$rs_name_eg			= $this->result( 'name_eg' );
			$rs_jacket_pic			= $this->result( 'jacket_pic' );
			$rs_cd_sell_price		= $this->result( 'cd_sell_price' );
			$rs_vcd_sell_price		= $this->result( 'vcd_sell_price' );
			$rs_cd_discount_rate	= $this->result( 'cd_discount_rate' );
			$rs_cd_discount_price	= $this->result( 'cd_discount_price' );
			$rs_cd_mileage_rate	= $this->result( 'cd_mileage_rate' );
			$rs_cd_mileage_price	= $this->result( 'cd_mileage_price' );
			$rs_vcd_discount_rate	= $this->result( 'vcd_discount_rate' );
			$rs_vcd_discount_price	= $this->result( 'vcd_discount_price' );
			$rs_vcd_mileage_rate	= $this->result( 'vcd_mileage_rate' );
			$rs_vcd_mileage_price	= $this->result( 'vcd_mileage_price' );
			$rs_real_quantity		= $this->result( 'real_quantity' );
			$rs_info1				= $this->result( 'info1' );
			$rs_info2				= $this->result( 'info2' );
			$rs_info3				= $this->result( 'info3' );
			$rs_info4				= $this->result( 'info4' );
			$rs_info5				= $this->result( 'info5' );
			$rs_info6				= $this->result( 'info6' );
			$rs_spec				= $this->result( 'spec' );
			$rs_manufacture_code	= $this->result( 'manufacture_code' );
			$rs_manufacture_name	= $this->result( 'manufacture_name' );
			$rs_license_code		= $this->result( 'license_code' );
			$rs_data_folder_no		= $this->result( 'data_folder_no' );
			$rs_data_folder_name	= $this->result( 'data_folder_name' );
			$rs_cd_sell_status		= $this->result( 'cd_sell_status' );
			$rs_vcd_sell_status		= $this->result( 'vcd_sell_status' );
			$rs_use_status		= $this->result( 'use_status' );

			$this->manufacture_code		= $rs_manufacture_code;
			$this->manufacture_name		= $rs_manufacture_name;
			$this->license_code				= $rs_license_code;
			$this->cd_no					= $rs_cd_no;
			$this->cd_order_no				= $rs_cd_order_no;
			$this->name_kr				= $rs_name_kr;
			$this->name_eg				= $rs_name_eg;
			$this->jacket_pic				= $rs_jacket_pic;
			$this->info1					= $rs_info1;
			$this->info2					= $rs_info2;
			$this->info3					= $rs_info3;
			$this->info4					= $rs_info4;
			$this->info5					= $rs_info5;
			$this->info6					= $rs_info6;
			$this->spec					= $rs_spec;
			$this->real_quantity			= $rs_real_quantity;
			$this->cd_sell_price				= $rs_cd_sell_price;
			$this->vcd_sell_price			= $rs_vcd_sell_price;
			$this->cd_sell_status			= $rs_cd_sell_status;
			$this->vcd_sell_status			= $rs_vcd_sell_status;

			$this->product_discount_rate		= $rs_cd_discount_rate;
			$this->product_discount_price	= $rs_cd_discount_price;
			$this->product_mileage_rate		= $rs_cd_mileage_rate;
			$this->product_mileage_price		= $rs_cd_mileage_price;

			$this->product_order_no			= $rs_cd_order_no;
			$this->product_data_folder_name	= $rs_data_folder_name;
			$this->product_image_name		= $rs_jacket_pic;
			$this->use_status				= $rs_use_status;

	
			// 부가세 제외가격
			$original_cd_sell_price = ( $rs_cd_sell_price / 1.1 );
			$this->vat_price = number_format( $rs_cd_sell_price - ( $rs_cd_sell_price / 1.1 ) ) . " 원";
			$txt_cd_mileage = '';

			// CD 할인가격
			if( $rs_cd_discount_rate )
			{
				$tmp_sell_price = ( $rs_cd_discount_rate / 100 ) * $rs_cd_sell_price;
				$cd_discount_sell_price = $rs_cd_sell_price - (int)( $tmp_sell_price / 10 ) * 10;

				$original_cd_sell_price = ( $cd_discount_sell_price / 1.1 );
				$this->vat_price = number_format( $cd_discount_sell_price - ( $cd_discount_sell_price / 1.1 ) ) . " 원";				

				$txt_cd_sell_price ="<del>" . number_format( $rs_cd_sell_price ) . " 원</del>→<font color=#FF3300>" . number_format( $original_cd_sell_price ) . " 원</font>";
			}
			elseif( $rs_cd_discount_price )
			{

				$cd_discount_sell_price = $rs_cd_sell_price - $rs_cd_discount_price;

				$original_cd_sell_price = ( $cd_discount_sell_price / 1.1 );
				$this->vat_price = number_format( $cd_discount_sell_price - ( $cd_discount_sell_price / 1.1 ) ) . " 원";	

				$txt_cd_sell_price ="<del>" . number_format( $rs_cd_sell_price ) . " 원</del>→<font color=#FF3300>" . number_format( $original_cd_sell_price ) . " 원</font>";
			}
			else
			{
				$cd_discount_sell_price = $rs_cd_sell_price;

				$original_cd_sell_price = ( $cd_discount_sell_price / 1.1 );
				$this->vat_price = number_format( $cd_discount_sell_price - ( $cd_discount_sell_price / 1.1 ) ) . " 원";

				$txt_cd_sell_price = number_format( $original_cd_sell_price ) . " 원";
			}

			$this->product_sell_price = $txt_cd_sell_price;
			$this->product_discount_sell_price = $cd_discount_sell_price;

			// CD 적립금 (쿠우머니)
			if( $rs_cd_mileage_rate )
			{
				$tmp_mileage = ( $rs_cd_mileage_rate / 100 ) * $original_cd_sell_price;
				$tmp_mileage = ( $tmp_mileage / 10 ) * 10;				
				$this->product_mileage = number_format( $tmp_mileage ) . " 원";
			}
			elseif( $rs_cd_mileage_price )
			{
				$tmp_mileage = $original_cd_sell_price;
				$tmp_mileage = ( $tmp_mileage / 10 ) * 10;
				$this->product_mileage = number_format( $tmp_mileage ) . " 원";
			}
			elseif( $basic_cd_mileage_rate )
			{

				$tmp_mileage = ( $basic_cd_mileage_rate / 100 ) * $original_cd_sell_price;
				$tmp_mileage = ( $tmp_mileage / 10 ) * 10;
				$this->product_mileage = number_format( $tmp_mileage ) . " 원";
			}
			else
			{
				$this->product_mileage = '';
			}

		}
		elseif( 'vcd' == $product_class )
		{

			$query = "
						SELECT	pc.cd_no ,
								pc.cd_order_no ,
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
								pc.real_quantity ,
								pc.info1 ,
								pc.info2 ,
								pc.info3 ,
								pc.info4 ,
								pc.info5 ,
								pc.info6 ,
								pc.spec ,
								pc.manufacture_code ,
								pmc.manufacture_name ,
								pc.license_code ,
								pc.data_folder_no ,
								df.data_folder_name ,
								pc.cd_sell_status ,
								pc.vcd_sell_status ,
								pc.use_status
						FROM	product_cd as pc ,
								data_folder df ,
								product_manufacture_code pmc
						WHERE	pc.data_folder_no = df.data_folder_no
						AND		pc.manufacture_code = pmc.manufacture_code
						AND		pc.cd_no = '$product_no'
			";
			$this->query( $query );
			$this->fetch();
			
			$rs_cd_no				= $this->result( 'cd_no' );
			$rs_cd_order_no			= $this->result( 'cd_order_no' );
			$rs_name_kr				= $this->result( 'name_kr' );
			$rs_name_eg				= $this->result( 'name_eg' );
			$rs_jacket_pic				= $this->result( 'jacket_pic' );
			$rs_cd_sell_price			= $this->result( 'cd_sell_price' );
			$rs_vcd_sell_price			= $this->result( 'vcd_sell_price' );
			$rs_cd_discount_rate		= $this->result( 'cd_discount_rate' );
			$rs_cd_discount_price		= $this->result( 'cd_discount_price' );
			$rs_cd_mileage_rate		= $this->result( 'cd_mileage_rate' );
			$rs_cd_mileage_price		= $this->result( 'cd_mileage_price' );
			$rs_vcd_discount_rate		= $this->result( 'vcd_discount_rate' );
			$rs_vcd_discount_price		= $this->result( 'vcd_discount_price' );
			$rs_vcd_mileage_rate		= $this->result( 'vcd_mileage_rate' );
			$rs_vcd_mileage_price		= $this->result( 'vcd_mileage_price' );
			$rs_real_quantity			= $this->result( 'real_quantity' );
			$rs_info1					= $this->result( 'info1' );
			$rs_info2					= $this->result( 'info2' );
			$rs_info3					= $this->result( 'info3' );
			$rs_info4					= $this->result( 'info4' );
			$rs_info5					= $this->result( 'info5' );
			$rs_info6					= $this->result( 'info6' );
			$rs_spec					= $this->result( 'spec' );
			$rs_manufacture_code		= $this->result( 'manufacture_code' );
			$rs_manufacture_name		= $this->result( 'manufacture_name' );
			$rs_license_code			= $this->result( 'license_code' );
			$rs_data_folder_no			= $this->result( 'data_folder_no' );
			$rs_data_folder_name		= $this->result( 'data_folder_name' );
			$rs_cd_sell_status			= $this->result( 'cd_sell_status' );
			$rs_vcd_sell_status			= $this->result( 'vcd_sell_status' );
			$rs_use_status			= $this->result( 'use_status' );

			$this->manufacture_code		= $rs_manufacture_code;
			$this->manufacture_name		= $rs_manufacture_name;
			$this->license_code				= $rs_license_code;
			$this->cd_no					= $rs_cd_no;
			$this->cd_order_no				= $rs_cd_order_no;
			$this->name_kr				= $rs_name_kr;
			$this->name_eg				= $rs_name_eg;
			$this->jacket_pic				= $rs_jacket_pic;
			$this->info1					= $rs_info1;
			$this->info2					= $rs_info2;
			$this->info3					= $rs_info3;
			$this->info4					= $rs_info4;
			$this->info5					= $rs_info5;
			$this->info6					= $rs_info6;
			$this->spec					= $rs_spec;
			$this->real_quantity			= $rs_real_quantity;
			$this->cd_sell_price				= $rs_cd_sell_price;
			$this->vcd_sell_price			= $rs_vcd_sell_price;
			$this->cd_sell_status			= $rs_cd_sell_status;
			$this->vcd_sell_status			= $rs_vcd_sell_status;

			$this->product_discount_rate		= $rs_vcd_discount_rate;
			$this->product_discount_price	= $rs_vcd_discount_price;
			$this->product_mileage_rate		= $rs_vcd_mileage_rate;
			$this->product_mileage_price		= $rs_vcd_mileage_price;

			$this->product_order_no			= $rs_cd_order_no;
			$this->product_data_folder_name	= $rs_data_folder_name;
			$this->product_image_name		= $rs_jacket_pic;
			$this->use_status				= $rs_use_status;

			// 부가세 제외가격
			$original_vcd_sell_price = ( $rs_vcd_sell_price / 1.1 );
			$this->vat_price = number_format( $rs_vcd_sell_price - ( $rs_vcd_sell_price / 1.1 ) ) . " 원";
			$txt_cd_mileage = '';

			// VCD 할인가격
			if( $rs_vcd_discount_rate )
			{
				$tmp_sell_price = ( $rs_vcd_discount_rate / 100 ) * $rs_vcd_sell_price;
				$vcd_discount_sell_price = $rs_vcd_sell_price - (int)( $tmp_sell_price / 10 ) * 10;

				$original_vcd_sell_price = ( $vcd_discount_sell_price / 1.1 );
				$this->vat_price = number_format( $vcd_discount_sell_price - ( $vcd_discount_sell_price / 1.1 ) ) . " 원";				

				$txt_vcd_sell_price ="<del>" . number_format( $rs_vcd_sell_price ) . " 원</del>→<font color=#FF3300>" . number_format( $original_vcd_sell_price ) . " 원</font>";
			}
			elseif( $rs_vcd_discount_price )
			{

				$vcd_discount_sell_price = $rs_vcd_sell_price - $rs_vcd_discount_price;

				$original_vcd_sell_price = ( $vcd_discount_sell_price / 1.1 );
				$this->vat_price = number_format( $vcd_discount_sell_price - ( $vcd_discount_sell_price / 1.1 ) ) . " 원";	

				$txt_vcd_sell_price ="<del>" . number_format( $rs_vcd_sell_price ) . " 원</del>→<font color=#FF3300>" . number_format( $original_vcd_sell_price ) . " 원</font>";
			}
			else
			{
				$vcd_discount_sell_price = $rs_vcd_sell_price;

				$original_vcd_sell_price = ( $vcd_discount_sell_price / 1.1 );
				$this->vat_price = number_format( $vcd_discount_sell_price - ( $vcd_discount_sell_price / 1.1 ) ) . " 원";

				$txt_vcd_sell_price = number_format( $original_vcd_sell_price ) . " 원";
			}

			$this->product_sell_price			= $txt_vcd_sell_price;
			$this->product_discount_sell_price		= $vcd_discount_sell_price;

			// VCD 적립금 (쿠우머니)
			if( $rs_vcd_mileage_rate )
			{
				$tmp_mileage = ( $rs_vcd_mileage_rate / 100 ) * $original_vcd_sell_price;
				$tmp_mileage = ( $tmp_mileage / 10 ) * 10;				
				$this->product_mileage = number_format( $tmp_mileage ) . " 원";
			}
			elseif( $rs_vcd_mileage_price )
			{
				$tmp_mileage = $original_vcd_sell_price;
				$tmp_mileage = ( $tmp_mileage / 10 ) * 10;
				$this->product_mileage = number_format( $tmp_mileage ) . " 원";
			}
			elseif( $basic_vcd_mileage_rate )
			{

				$tmp_mileage = ( $basic_vcd_mileage_rate / 100 ) * $original_vcd_sell_price;
				$tmp_mileage = ( $tmp_mileage / 10 ) * 10;
				$this->product_mileage = number_format( $tmp_mileage ) . " 원";
			}
			else
			{
				$this->product_mileage = '';
			}

		} // if( 'vcd' == $product_class )

	}

}

?>
