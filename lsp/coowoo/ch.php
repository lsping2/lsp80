<?

 

     $src = "/storage12/SAMIL/FA005/low";		


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



   
	 



		 for( $i=0; $i<count( $filelist ); $i++ )
		    {

			

			 $filename = $filelist[$i];
			// $filename =  array_push ($filename, $get);

			  $new_file = "5_".sprintf( "%03d",  $i+1) .".jpg";       
			 exec( "mv $src/$filename $src/$new_file" );      

			echo "mv $src/$filename   $src/$new_file\n";
		
		    }
	

 // c:\php\php.exe file.php  ½ÇÇà






?>
