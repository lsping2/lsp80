<script language=javascript> 
function stack_in( num ) 
{ 
   for(loop=0;loop<num;loop++)
	{
	   arr[]=loop;
	   alert('arr[]');
	}
} 

</script>
<?
$arr =array();
$arr[0] = "0";
$arr[1] = "1";
$arr[2] = "2";
$arr[3] = "3";
$arr[4] = "4";
$arr[5] = "5";


$array_push	= array_push ($arr , "6");
$array_pop		= array_pop  ($arr);

 $array_unshift = array_unshift ($arr, "6");
 $array_shift		= array_shift ($arr);

// print_r( $arr );

?>

<form name=frm method=POST action=<?=$PHP_SELF?>>

<input type=button value='������' onClick=stack_in( <?=$array_push?> )> <br> 
<input type=button value='���þƿ�' onClick=stack_out( <?=$array_pop?> )> <br> 

<input type=button value='ť��' onClick=Q_in( <?=$array_unshift?> )> <br> 
<input type=button value='ť�ƿ�' onClick=Q_out( <?=$array_shift?> )> <br> 

</form>


