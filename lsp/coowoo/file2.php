<?

 

     $src = "E:\\wizdata\\WDW004\\thum";		// ������


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

	$new_file = "pic4_".sprintf( "%02d", $i + 1 ) .".jpg";       
	 exec( "ren \"$src\\$filename\" $new_file" );      //  �������� ������ �ν��ϱ����� \" \" �� ������

	echo "ren \"$src\\$filename\" $new_file\n";
   }

 

// �������� file.php ������ �ִ°����� �̵�
// c:\php\php.exe file.php  ����
 

?>
