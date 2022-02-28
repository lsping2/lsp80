<?


set_time_limit(0);

$exclude = array( '.' , '..' );

$src1 = "F:\\Zip";

$dir = dir( $src1 );
$dir->rewind();
while( $filename = $dir->read() )
{
	if( !in_array( $filename, $exclude ) )
	{
		$array1[] = $filename;
	}
}


echo count( $array1 ) . "\n";

foreach( $array1 as $key => $value )
{

	$temp = 0;

	$dir = dir( $src1 . "\\" . $value );
	$dir->rewind();

	while( $filename = $dir->read() )
	{
		
		if( is_dir( $filename ) )
		{
			$temp[] = $filename;
		}
	}

	if( count( $temp ) > 0 ) echo $value . "," . count( $temp ) . "\n";

}

?>
