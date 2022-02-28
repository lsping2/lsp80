<?
// E:\\Thumbnails 에 있는 jpg파일을 E:\\New_Zip\\해당하는 파일명\\ 파일로 옮기는 작업
set_time_limit(0);
$src = "E:\\Thumbnails";
$dst = "E:\\New_Zip";

$except = array( '.','..','thumbs.db' );

$dir = dir( $src );
$dir->rewind();

while( $filename = $dir->read() )
{
	  $ext = explode( ".", $filename );			
	   if( 'JPG' == strtoupper( $ext[1] ) )			
	   {
		$filelist[] = $ext[0];                       
	   }


	
}

foreach($filelist as $key => $value )
{
	//echo "mkdir \"{$dst}\\{$value}\\thumnail"; 
	//exec("mkdir \"{$dst}\\{$value}\\thumnail");
	echo "copy {$src}\\{$value}.jpg \"{$dst}\\{$value}\\thumnail\\{$value}.jpg";
	exec("copy {$src}\\{$value}.jpg \"{$dst}\\{$value}\\thumnail\\{$value}.jpg");
	echo "\n";	

}


?>
