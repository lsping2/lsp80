<?

 

     $src = "E:\\SAMIL\\cd2\\22";		// ������


     $dir = dir( $src );				      

     $dir->rewind();				  // ���丮������ �о��.

      while( $filename = $dir->read() )      // ���丮 ������ $filename �� ��´�
     {


		   $ext = explode( ".", $filename );			
		   if( 'JPG' == strtoupper( $ext[1] ) )			// Ȯ���ںκ�( �޺κ�) �� �빮�� ��ȯ
		   {
			$filelist[] = $filename;                           
		   }

     }

	sort( $filelist );		// �迭����		

    for( $i=0; $i<count( $filelist ); $i++ )
    {

	$filename = $filelist[$i];

	$new_file = sprintf( "%03d", $i + 1 ) .".jpg";       
	 exec( "ren \"$src\\$filename\" $new_file" );      //  �������� ������ �ν��ϱ����� \" \" �� ������

	echo "ren \"$src\\$filename\" $new_file\n";
   }

 

// �������� file.php ������ �ִ°����� �̵�
// c:\php\php.exe file.php  ����
 

?>
