<?
function rand_it(){
	$sel = rand( 1, 45 );
	return $sel;

}

$arr_val = array();
for( ;; )
{
	$a= rand_it();
	$b= rand_it();
	$c= rand_it();
	$d= rand_it();
	$e= rand_it();


	$arr = array($a,$b,$c,$d,$e);
	//$arr = array("1","2","3","8","7");

	if($arr[0] == $arr[1]) {
		continue;
	}else	{

			$arr_val[] = $arr[0];
			break;
	}


	$sel = $b;

/*	if( !in_array( $sel, $arr ) ) {
		echo "t1"."<br>";
		continue;
	}else{
		echo "t2"."<br>";
		$arr_val[] = $sel;
		$loop++;
		if( $loop >5 ) break;
	}
*/
}

print_r( $arr_val );
?>