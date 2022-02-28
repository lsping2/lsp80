<?
// E:\\Website Previews\\a 에 있는 swf파일을 E:\\New_Zip\\파일명\\preview\\파일 로 옮김
// E:\\Website Previews\\안에 파일들을 규칙성 있게  하려고 str_replace 사용.
set_time_limit(0);
$src = "E:\\Website Previews\\a";
$dst = "E:\\New_Zip";

$except = array( '.','..','thumbs.db' );

$dir = dir( $src );
$dir->rewind();

while( $filename = $dir->read() )
{
	if( "." != $filename AND ".." != $filename ) $filelist[] = $filename;                 
}



foreach($filelist as $key => $value)
{
	$val2   = str_replace("A_T","_T",$value);
	$val3   = str_replace("A.",".",$val2);
	$val     = str_replace(".swf","",$val3);
	
	echo "copy \"{$src}\\{$value}\" \"{$dst}\\{$val}\\preview\\{$value}";
	exec("copy \"{$src}\\{$value}\"  \"{$dst}\\{$val}\\preview\\{$value}");
	echo "\n";	
}

?>
