<?
// E:\\Zip�� ���丮������ E:\\New_Zip�� ���丮������ ��, �ٸ���� �ٸ����� ���.
$src1 = "E:\\Zip";
$src2 = "E:\\New_Zip";


$dir = dir($src1);
$dir->rewind();

while($filename= $dir->read())
{
	list($filelist , $ext) = explode(".",$filename);

	$array1[] = $filelist;

}


$dir = dir($src2);
$dir->rewind();

while($filename = $dir->read())
{
	list($filelist , $ext) = explode(".",$filename);
	$array2[] = $filelist;
}


echo count( $array1 ) . "\n";
echo count( $array2 );

foreach($array2 as $key => $value)
{

	if(!in_array($value,$array1)) echo $value . "\n";
}


?>