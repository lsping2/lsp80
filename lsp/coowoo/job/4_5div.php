<?

// 4.5G·Î ºÐÇÒ

set_time_limit(0);

$exclude = array( '.' , '..' );

$no = "bl010";

$src = "F:\\BLEND_5-10\\download\\superhigh\\{$no}";
$dst = "F:\\new2";

$dir = dir( $src );
$dir->rewind();

$all_size = 0;
$count = 1;

exec( "mkdir {$dst}\\{$no}_superhigh{$count}" );

while( $filename = $dir->read() )
{

	if( $all_size > 4500000000 )
	{

		$count++;
		exec( "mkdir {$dst}\\{$no}_superhigh{$count}" );

		$all_size = 0;

	}

	if( !in_array( $filename, $exclude ) )
	{
		// echo filesize( "{$src}\\$filename" ) . "\n";

		$filesize = filesize( "{$src}\\$filename" );
		$all_size += $filesize;

		echo "move {$src}\\$filename {$dst}\\{$no}_superhigh{$count}\\$filename";
	
		exec( "move {$src}\\$filename {$dst}\\{$no}_superhigh{$count}\\$filename" );
	}

}

echo $all_size;

?>
