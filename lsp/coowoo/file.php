<?

 

     $src = "E:\\SAMIL\\cd5\\55";		// ������


     $dir = dir( $src );				      

     $dir->rewind();				  // ���丮������ �о��.

 
$count = 1;    // 1���� �����ϱ�

             while( $filename = $dir->read() )      // ���丮 ������ $filename �� ��´�

             {

	

                           $ext = explode( ".", $filename );			// ������ . ���� �����Ͽ�

                           if( 'JPG' == strtoupper( $ext[1] ) )			// Ȯ���ںκ�( �޺κ�) �� �빮�ڷ� �ٲ��� ��

                           {

$new_file = sprintf( "%03d", $count ) .".".strtolower($ext[1]);        // $count �� 3�ڸ����� ���� Ȯ���ڿ� ���� { ex)  001.jpg }

                                        exec( "ren $src\\$filename $new_file" );    // $src\\$filename �� $new_file�� �ٲ�
					

		$count++;
                           }


             }

 

// �������� file.php ������ �ִ°����� �̵�
// c:\php\php.exe file.php  ����
 

?>
