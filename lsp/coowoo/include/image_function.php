<?

function cmyk2rgb( $src_image, $dst_image = "" )
{
	if( !$dst_image ) $dst_image = "/tmp/" . md5( time() );
	echo "/usr/bin/convert -profile /usr/local/colorprofile/USWebCoatedSWOP.icc -profile /usr/local/colorprofile/sRGB.icm $src_image $dst_image";
	exec( "/usr/bin/convert -profile /usr/local/colorprofile/USWebCoatedSWOP.icc -profile /usr/local/colorprofile/sRGB.icm $src_image $dst_image" );
	
	return $dst_image;
}

function img_resize( $src_image, $dst_image, $select , $pixel , $sharpen = 'No', $dpi = 350 )
{

	$select = strtolower( $select );
	$sharpen = strtolower( $sharpen );

	if( 'auto' == $select )
	{
		if( 'yes' == $sharpen ) $sharpen = "-sharpen 2";
		exec( "/usr/bin/convert -density {$dpi}x{$dpi} -resize {$pixel}x{$pixel} -quality 95% $src_image $dst_image" );
	}
	elseif( 'equal' == $select )
	{
		if( 'yes' == $sharpen ) $sharpen = "-sharpen 2";
		exec( "/usr/bin/convert -resize {$pixel}x{$pixel}! -quality 95% $src_image $dst_image" );
	}

}

function watermark_src( $source, $watermark_url='default', $watermark_size='big', $opacity=20 )
{

	switch( $watermark_size )
	{
		case 'big'		:	
						$watermark_img = "big_mix.gif";
						break;
		case 'middle'	:	
						$watermark_img = "middle_mix.gif";
						break;
		case 'small'	:	
						$watermark_img = "small_mix.gif";
						break;	
	}

	$watermark_url = "/home/coowoo/www/watermark/{$watermark_url}";
	if( is_file( $watermark_url . "/" . $watermark_img ) )
	{
		$watermark		= imageCreateFromGif( $watermark_url . "/" . $watermark_img );

		$source_width		= imageSX( $source );
		$source_height	= imageSY( $source );

		$watermark_width	= imageSX( $watermark );
		$watermark_height	= imageSY( $watermark );

		imageCopyMerge( $source, $watermark, ( $source_width / 2 ) - ( $watermark_width /2 ), ( $source_height / 2 ) - ( $watermark_height /2 ), 0, 0, $watermark_width, $watermark_height, $opacity );
	}

}

function watermark_url( $source_url, $watermark_size='middle', $color='white', $mode='jpeg', $opacity=20 )
{

	// 원본이미지
	switch( $mode )
	{
		case 'jpeg' :
					$source = imageCreateFromJPEG( $source_url );
					break;
	}

	// 워터마크
	switch( $watermark_size )
	{
		case 'middle' :
					$watermark_url = "watermark250_{$color}.gif";
					break;
	}

	$watermark		= imageCreateFromGIF( $watermark_url );

	$source_width		= imageSX( $source );
	$source_height	= imageSY( $source );

	$watermark_width	= imageSX( $watermark );
	$watermark_height = imageSY( $watermark );

	imageCopyMerge( $source, $watermark, ( $source_width / 2 ) - ( $watermark_width /2 ), ( $source_height / 2 ) - ( $watermark_height /2 ), 0, 0, $watermark_width, $watermark_height, $opacity );

	header( "Content-type: image/jpeg" );
	ImageJPEG( $source );

}

function image_request( $user_id, $single_order_no, $folder_no )
{
	
	global $SERVER_CONFIG;

	$dst_dir = $SERVER_CONFIG[ my_download ] . "/{$user_id}";
	if( !is_dir( $dst_dir ) ) @mkdir( $dst_dir);

	$image_db = new MYSQL;
	$image_db2 = new MYSQL;

	$query2 = "
				SELECT	image_name
				FROM	product_images
				WHERE	single_order_no = '$single_order_no'									
	";
	$image_db2->query( $query2 );
	$image_db2->fetch();

	$rs_image_name= $image_db2->result( 'image_name' );

	$query2 = "
				SELECT	folder_no ,
						ext ,
						dpi ,
						folder_size ,
						folder_price ,
						pixel_size 
				FROM	single_pricelist_folder
				WHERE	folder_no = '$folder_no'
	";
	$image_db2->query( $query2 );
	$image_db2->fetch();

	$dst_folder_no	= $image_db2->result( 'folder_no' );
	$rs_ext			= $image_db2->result( 'ext' );
	$rs_dpi			= $image_db2->result( 'dpi' );
	$rs_folder_size	= $image_db2->result( 'folder_size' );
	$rs_folder_price	= $image_db2->result( 'folder_price' );
	$rs_pixel_size		= $image_db2->result( 'pixel_size' );


	$tmp = explode( "." , $rs_image_name );
	$rs_image_name = $tmp[0] . "." . $rs_ext;

	$query = "
				SELECT	data_folder ,
						sub_folder ,
						down_filename ,
						size_width ,
						size_height
				FROM	product_single_download
				WHERE	single_order_no = '$single_order_no'
				AND		folder_no = '$folder_no'
	";

	$image_db2->query( $query );
	if( $image_db2->total_record() )
	{
		$image_db2->fetch();
		$rs_data_folder		= $image_db2->result( 'data_folder' );
		$rs_sub_folder			= $image_db2->result( 'sub_folder' );
		$rs_down_filename		= $image_db2->result( 'down_filename' );
		$dst_size_width		= $image_db2->result( 'size_width' );
		$dst_size_height		= $image_db2->result( 'size_height' );

		
			$src_file = "/home/coowoo/www/storage" . "/{$rs_data_folder}/{$rs_sub_folder}/{$rs_down_filename}";
			$dst_file = $dst_dir . "/{$rs_image_name}";


		if( is_file( $dst_file ) )
		{
			unlink( $dst_file );
		}

		system( "cp $src_file $dst_file > /dev/null &" );

		$create = 'No';


	}
	else
	{


		// 사이즈에 맞는 이미지가 없으면
		// 해당 이미지의 제일 큰 사이즈로 리사이즈

		$query = "
					SELECT	single_download_no ,
							image_no ,
							data_folder ,
							sub_folder ,
							folder_no ,
							down_filename ,
							size_width ,
							size_height
					FROM	product_single_download
					WHERE	single_order_no = '$single_order_no'
					ORDER BY folder_no DESC
					LIMIT	1
		";
		$image_db2->query( $query );

		if( $image_db2->total_record() )
		{

			$image_db2->fetch();

			$rs_single_download_no		= $image_db2->result( 'single_download_no' );
			$rs_image_no				= $image_db2->result( 'image_no' );
			$rs_data_folder			= $image_db2->result( 'data_folder' );
			$rs_sub_folder				= $image_db2->result( 'sub_folder' );
			$rs_forder_no				= $image_db2->result( 'folder_no' );
			$rs_down_filename			= $image_db2->result( 'down_filename' );
			$rs_size_width			= $image_db2->result( 'size_width' );
			$rs_size_height			= $image_db2->result( 'size_height' );

			$src_pixelsize = $rs_size_width + $rs_size_height;

			// 가로 세로 비율 계산
			$ratio_x = 1;
			$ratio_y = @( $rs_size_height / $rs_size_width );


			if( 79 == $folder_no ) $basis = 4500; // DAJ
			elseif( 80 == $folder_no ) $basis = 7500; // DAJ
			elseif( 388 == $folder_no ) $basis = 4500; // DAK
			elseif( 389 == $folder_no ) $basis = 7500; // DAK
			elseif( 337 == $folder_no ) $basis = 4400; // DAJ Illust - NEW - Size Step 2 : 약 14M
			elseif( 338 == $folder_no ) $basis = 7400; // DAJ Illust - NEW - Size Step 3 : 약 40M
			elseif( 140 == $folder_no ) $basis = 3850; // Photick
			elseif( 141 == $folder_no ) $basis = 6550; // Photick
			elseif( 102 == $folder_no ) $basis = 7200; // Urikiri
			elseif( 155 == $folder_no ) $basis = 1500; // MIXA
			elseif( 156 == $folder_no ) $basis = 4500; // MIXA
			elseif( 169 == $folder_no ) $basis = 4000; // DEX
			elseif( 170 == $folder_no ) $basis = 5800; // DEX
			elseif( 171 == $folder_no ) $basis = 7200; // DEX
			elseif( 285 == $folder_no ) $basis = 3900; // ION
			elseif( 107 == $folder_no ) $basis = 4000; // ImageXzone
			elseif( 108 == $folder_no ) $basis = 6200; // ImageXzone
			elseif( 174 == $folder_no ) $basis = 4000; // Potos.com
			elseif( 175 == $folder_no ) $basis = 5300; // Potos.com

			$dst_size_width = ceil( ( $basis / ( $ratio_x + $ratio_y ) ) * $ratio_x );
			$dst_size_height  = ceil( ( $basis / ( $ratio_x + $ratio_y ) ) * $ratio_y ); 

			 // echo "[ratio_x : $ratio_x] [ratio_y : $ratio_y] [$forder_no] [$rs_pixel_size] [$basis] [dst_size_width : $dst_size_width][dst_size_height : $dst_size_height]";

			$src_file = "/home/coowoo/www/storage" . "/{$rs_data_folder}/{$rs_sub_folder}/{$rs_down_filename}";
			$dst_file = $dst_dir . "/{$rs_image_name}";

					if( is_file( $dst_file ) )
					{
						unlink( $dst_file );
					}

			system( $SERVER_CONFIG['imagemagick'] . "/convert  -resize {$dst_size_width}x{$dst_size_height}! -sharpen 1 -quality 90% $src_file $dst_file > /dev/null &" );

			$create = 'Yes';

		}

	}

	return $create;

}

?>
