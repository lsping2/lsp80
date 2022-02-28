<?


     $src = ".";		


     $dir = dir( $src );				      

     $dir->rewind();				 

      while( $filename = $dir->read() )     
     {

		if( "." != $filename AND ".." != $filename )	$filelist[] = $filename;               

     }

	sort( $filelist );			

    for( $i=0; $i<count( $filelist ); $i++ )
    {
		echo $filelist[$i] . "\n";
	 `move $filelist[$i]\* .`;

	if( is_dir( $filelist[$i] ) )
	    {

		`rmdir $filelist[$i]`;

	  }



   }

	  `del *.xls`;
	  `del *.jpg`;
 

?>
