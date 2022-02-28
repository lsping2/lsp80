
<?
function cal( $a , $b )
{
	$a_len = strlen($a);
	$b_len = strlen($b);

	if( $a_len < $b_len ) 
	{
		$len = $a_len;
		$thead = $b_len-$a_len;
	}
	else
	{
		$temp = $a;
		$a = $b;
		$b = $temp;
		$len = $b_len;
		$thead = $a_len - $b_len;
	}
	 $len2=strlen($b)-1;
	 $len_loop =$len;
	 $ex = substr($b,0,$thead);
	?>

	<? FOR ( $loop=0 ; $loop<$len_loop ; $loop++ ) : ?>
	<?
		
		 $hap = substr($a,$len-1,1) + substr($b,$len2,1) +$up;

		if( $hap >= 10 )
		{
			 $up	  = substr($hap,0,1);
			 $hap = substr($hap,1,1);
			 $ex = substr($b,0,$thead)+1;
		}
		else
		{
			$up = 0;
			$ex = substr($b,0,$thead);	 
		}

		$result[] = $hap;	
		$len--;
		$len2--;
	?>
	<? ENDFOR ?>
	<?

	echo $ex;

	$value=$len_loop;

	for($loop=0;$loop<=$len_loop;$loop++)
	{
		echo $result[$value];
		$value--;
	}

} // 전체

echo cal(252,2452);

?>

<br>
<br>

<?
function plus2( $a , $b )
{

	if( strlen($a) > strlen($b ) ) 
	{

		$temp = $a;
		$a = $b;
		$b = $temp;
	}

	$a_len = strlen($a);

	$b_len = strlen($b);
	$thread = $b_len-$a_len;

	$ex = substr($b,0,$thread);

	for ( $loop=$a_len -1 ; $loop>=0 ; $loop-- )
	{

		 $hap = substr($a,$loop,1) + substr($b,$loop + $thread,1) +$up;

		if( $hap >= 10 )
		{
			$up	  = 1;
			$hap = substr($hap,1,1);
			if( $loop==$a_len -1) $ex = substr($b,0,$thread)+1;
		}
		else
		{
			$up = 0;
			if( $loop==$len_loop -1) $ex = substr($b,0,$thread);	 
		}

		$result[] = $hap;	

	}

	for($loop=0;$loop<=$a_len;$loop++)
	{
		$rs .= $result[$a_len - $loop];
	}

	return "{$ex}{$rs}";

} // 전체

$rs =  plus2(252,2452);

echo "Result : $rs";

?>



<br>
<br>


<?
function minus( $a , $b )
{
	$a_len = strlen($a);
	$b_len = strlen($b);

if( strlen($a) > strlen($b) ) 
	{
		$thread =  strlen($a) - strlen($b);

		for($loop=0; $loop<$thread; $loop++)
		{
			$O .= "0";
		}
		$b = $O.$b;
	}

	for ( $loop=$a_len -1 ; $loop>=0 ; $loop-- )
	{

		   $cal = substr($a,$loop,1) - substr($b,$loop,1) - $send;
		 
		   $send = "";

		 if ( $cal < 0 )
		{
			 if ( substr($a_len,0,1) ==  substr($b_len,0,1) )
			{
				$cal = $cal + 0;
				$send = 0;
			}
			else
			{
				$cal = $cal + 10;
				$send = 1;
			}
		}
	
			$result[] = $cal;
		
	}



	for($loop=0;$loop<=$a_len;$loop++)
	{
		  if ( $result[$a_len-1] == '0' )  $result[$a_len-1] = '';
		   echo $result[$a_len - $loop];	
	}


} // 전체

echo minus(112,2);

?>