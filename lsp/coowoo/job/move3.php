<?
// E:\\Website Previews\\a �� �ִ� swf������ E:\\New_Zip\\���ϸ�\\preview\\���� �� �ű�
// E:\\Website Previews\\�ȿ� ���ϵ��� ��Ģ�� �ְ�  �Ϸ��� str_replace ���.
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
