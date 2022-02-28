<?

$arr = array();
for( ;; )
{
	$sel = rand( 1, 45 );
	if( in_array( $sel, $arr ) ) continue; 
	else $arr[] = $sel;
	if( ++$loop >5 ) break;

}

print_r( $arr );
 

///////////////////////////////////////////////////////////////////////////////

$arr = array();
echo "<br><br>";

for( $loop=1; $loop<=6; $loop++ )
{
	$sel = rand( 1, 45 );
	if( in_array( $sel, $arr ) ) $loop-- ; else $arr[] = $sel;
}

print_r( $arr );

///////////////////////////////////////////////////////////////////////////////

echo "<br><br>";

$arr = range( 1, 45 );
shuffle( $arr );
for( $loop=0; $loop<6; $loop++ ) echo $arr[$loop] . " ";

///////////////////////////////////////////////////////////////////////////////

?>

