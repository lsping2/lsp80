<?
// E:\\Zip에 위치한 파일들을 E:\\New_Zip\\해당하는 파일명\\data\\ 안으로 각각 넣는 작업.

set_time_limit(0);
$src = "E:\\Zip";
$dst = "E:\\New_Zip";

$except = array( '.','..','thumbs.db' );

$dir = dir( $src );
$dir->rewind();

while( $folder = $dir->read() )
{
	if( !in_array( strtolower( $folder ), $except ) )   
	{
		
		$folderlist[] = $folder;
	}
	
}


foreach($folderlist as $key => $value )
{

	//echo "mkdir \"{$dst}\\{$value}\\data"; 
	//exec("mkdir \"{$dst}\\{$value}\\data");
	echo "move {$dst}\\{$value}\\* \"{$dst}\\{$value}\\data\\";
	exec("move {$dst}\\{$value}\\* \"{$dst}\\{$value}\\data\\");
	echo "\n";
	
	
}



?>
