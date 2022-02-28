<table align=center border=0 cellpadding=0 cellspacing=0 border=0 bgcolor="#FFFFFF">
<?

$cd_upload_directory = 'http://lsp80.cafe24.com/lsp/coowoo/foderinfo/NDX033';
chdir( $cd_upload_directory );

$dir = dir( "." );
$dir->rewind();

$dirlist = '';
$c = 0;
while( $dirname = $dir->read() )
{

	if( '.' != $dirname AND '..' != $dirname )
	{

		if( is_dir( $dirname ) )
		{
			$dirlist[] = $dirname;
			$c++;
		}

	}

} // end of while

$ext_array = array( 'jpg' , 'jpeg' , 'eps' , 'psd' , 'tif' , 'zip' );

if( $c >= 1 ) 
{

	echo "<tr><td align=center height=50>다운로드 폴더를 선택해 주세요.</td></tr>";

	usort( $dirlist );

	for( $i=0; $i<count( $dirlist ); $i++ )
	{
		
		$dirname = $dirlist[ $i ];
		$dir = dir( $cd_upload_directory . "/" . $dirname );
		$dir->rewind();

		$count = 0;
		while( $filename = $dir->read() )
		{
			$extention = explode( ".", $filename );
			if( in_array( strtolower( $extention[1] ) , $ext_array ) )
			{
				$count++;
			}
		} // end of while

		echo "<tr><td><input type=radio name=download_folder value='$dirname' checked>&nbsp;<font face=verdana style='font-size:8pt'>{$rs_data_folder_name}/{$cd_order_no}/" . $dirname . " : " . $count .  "개의 파일이 등록되어있습니다.</font></td></tr>";
		

	}

}
else
{

		echo "<tr><td>등록된 폴더가 없습니다.</td></tr>";

}

?>
		</table>