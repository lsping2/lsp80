#! /usr/local/bin/php


<?

     $src = "SM140_test/50MB";	


     $dir = dir( $src );				      

     $dir->rewind();				

      while( $filename = $dir->read() )     
     {


		   $ext = explode( ".", $filename );			
		   if( 'JPG' == strtoupper( $ext[1] ) )			
		   {
			$filelist[] = $filename;                           
		   }

     }

	sort( $filelist );	
	

    for( $i=0; $i<=count( $filelist ); $i++ )
    {


	$filename = $filelist[$i];
	$size = getimagesize( "SM140_test/50MB/$filename" );
	$width = $size[0];	
	$height = $size[1];
		

	 $radio = $height/$width;


	for (;;)
		    {
			
			$height = $radio * $width;
			$channels = $size["channels"];
			  $mb= (($width * $height)  * $channels)/1024/1024; 
			  $mb =  round( $mb * 10) / 10;
		
			
			if ( $mb < 35.1 ) { break; } // MB SIZE

			$width--;
		    }

		
		
	$src_image = "SM140_test/50MB/$filename";
	$dst_image = "SM140_test/35MB/$filename";  	
	//echo $mb."=".$width."*".round($height)."\n";
	$height = round($height);
	echo "/usr/bin/convert -resize {$width}x{$height}! $src_image $dst_image"."\n" ;
	exec("/usr/bin/convert -resize {$width}x{$height}! $src_image  $dst_image");
	   
   }

?>






<?
////////////////////////////////////////////////////////////////////////////////////////////////////////////////



     $src = "F:\NDISC\NDV034\High";	
	$dst = "F:\\NDISC\\NDV034\\Mid";

     $dir = dir( $src );				      

     $dir->rewind();				

      while( $filename = $dir->read() )     
     {


		   $ext = explode( ".", $filename );			
		   if( 'JPG' == strtoupper( $ext[1] ) )			
		   {
			$filelist[] = $filename;                           
		   }

     }

	sort( $filelist );	
	


    for( $i=0; $i<=count( $filelist ); $i++ )
    {


	$src_image = "{$src}\\{$filename}";
	$dst_image = "{$dst}\\{$filename}";  

	$filename = $filelist[$i];
	$size = getimagesize( $src_image );
	 $width = $size[0];	
	 $height = $size[1];
		

	 $radio = $height/$width;


	for (;;)
		    {
			
			$height = $radio * $width;
			$channels = $size["channels"];
			  $mb= (($width * $height)  * $channels)/1024/1024; 
			  $mb =  round( $mb * 10) / 10;
		
			
			if ( $mb < 10.1 ) { break; } // MB SIZE

			$width--;
		    }

		
			
	$height = round($height);
	echo "convert -resize {$width}x{$height}! $src_image $dst_image"."\n" ;
	exec("convert -resize {$width}x{$height}! -quality 90% $src_image  $dst_image");

	   
   }

?>

