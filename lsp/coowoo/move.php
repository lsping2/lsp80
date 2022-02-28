<?

set_time_limit(0);

$ps = "superhigh";

$src = "E:\\PIXLAND\\download\\{$ps}";
$dst = "E:\\New";

$except = array( '.','..','thumbs.db' );

$dir = dir( $src );
$dir->rewind();

while( $folder = $dir->read() )
{
	if( !in_array( strtolower( $folder ), $except ) )
	{

		echo $folder . "\n";

		// mkdir( $dst . "\\" . strtoupper( $folder ) );
		 mkdir( $dst . "\\" . strtoupper( $folder ) . "\\" . $ps );

		$exec = "move {$src}\\{$folder}\\* {$dst}\\{$folder}\\{$ps}";

		exec( $exec );

	}

}

?>