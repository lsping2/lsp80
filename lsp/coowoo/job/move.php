<?
// E:\\Zip�� ��ġ�� ���ϵ��� E:\\New_Zip\\�ش��ϴ� ���ϸ�\\data\\ ������ ���� �ִ� �۾�.

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
