<?

 

     $src = "E:\\SAMIL\\cd2\\22";		// 씨디경로


     $dir = dir( $src );				      

     $dir->rewind();				  // 디렉토리정보를 읽어옴.

      while( $filename = $dir->read() )      // 디렉토리 내용을 $filename 에 담는다
     {


		   $ext = explode( ".", $filename );			
		   if( 'JPG' == strtoupper( $ext[1] ) )			// 확장자부분( 뒷부분) 을 대문자 변환
		   {
			$filelist[] = $filename;                           
		   }

     }

	sort( $filelist );		// 배열정렬		

    for( $i=0; $i<count( $filelist ); $i++ )
    {

	$filename = $filelist[$i];

	$new_file = sprintf( "%03d", $i + 1 ) .".jpg";       
	 exec( "ren \"$src\\$filename\" $new_file" );      //  도스에서 공백을 인식하기위해 \" \" 로 묶어줌

	echo "ren \"$src\\$filename\" $new_file\n";
   }

 

// 도스에서 file.php 파일이 있는곳으로 이동
// c:\php\php.exe file.php  실행
 

?>
