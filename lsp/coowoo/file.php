<?

 

     $src = "E:\\SAMIL\\cd5\\55";		// 씨디경로


     $dir = dir( $src );				      

     $dir->rewind();				  // 디렉토리정보를 읽어옴.

 
$count = 1;    // 1부터 증가하기

             while( $filename = $dir->read() )      // 디렉토리 내용을 $filename 에 담는다

             {

	

                           $ext = explode( ".", $filename );			// 구분자 . 으로 구분하여

                           if( 'JPG' == strtoupper( $ext[1] ) )			// 확장자부분( 뒷부분) 을 대문자로 바꺼서 비교

                           {

$new_file = sprintf( "%03d", $count ) .".".strtolower($ext[1]);        // $count 를 3자리수로 만들어서 확장자와 조합 { ex)  001.jpg }

                                        exec( "ren $src\\$filename $new_file" );    // $src\\$filename 을 $new_file로 바꿈
					

		$count++;
                           }


             }

 

// 도스에서 file.php 파일이 있는곳으로 이동
// c:\php\php.exe file.php  실행
 

?>
