

<script language=javascript>
<!--

	String.prototype.number_format=function(){
		return this.replace(/(\d)(?=(?:\d{3})+(?!\d))/g,'$1,');
	}

	function checkPayment()
	{
		var form = document.ini;
		var sum = 0;

		// 에이블스톡
		for( loop=1; loop<5; loop++ )
		{
			if( true == form.ablestock[loop].checked )
			{
				sum = sum + parseInt( form.ablestock[loop].value);
			}
		}

		// 리퀴드라이브러리
		for( loop=1; loop<5; loop++ )
		{
			if( true == form.liquidlibrary[loop].checked )
			{
				sum = sum + parseInt( form.liquidlibrary[loop].value );
			}
		}

		
		form.price.value = sum;
		payment_sum.innerText = sum.toString().number_format();

	}
-->
</script>


<form name=ini method=post action="payment_exec.s" onSubmit="return pay(this)">
에이블스톡
<table width="300" border="1" cellpadding="0" cellspacing="0">
  <tr> 
    <td colspan=2><input type="radio" name="ablestock" value="0" onClick="checkPayment()" checked> 선택 안함</td>
  </tr>
  <tr> 
    <td><input type="radio" name="ablestock" value="100" onClick="checkPayment()" <? IF( 'ablestock1' == $membership ) { $price = 100; echo "checked"; } ?> 1개월</td>
    <td>100  USD</td>
  </tr>
  
  <tr> 
    <td><input type="radio" name="ablestock" value="200" onClick="checkPayment()" <? IF( 'ablestock2' == $membership ) { $price = 200; echo "checked"; } ?>3개월 </td>
    <td>200 USD</td>
  </tr>
  <tr> 
    <td><input type="radio" name="ablestock" value="600" onClick="checkPayment()" <? IF( 'ablestock3' == $membership ) { $price = 600; echo "checked"; } ?> 6개월</td>
    <td>600 USD</td>
  </tr>
  
  <tr> 
    <td><input type="radio" name="ablestock" value="1200" onClick="checkPayment()" <? IF( 'ablestock4' == $membership ) { $price = 1200; echo "checked"; } ?> 12개월</td>
    <td>1200 USD</td>
  </tr>
</table>


<br>

리퀴드라이브러리
<table width="300" border="1" cellpadding="0" cellspacing="0">
  <tr> 
    <td colspan=2><input type="radio" name="liquidlibrary" value="0" onClick="checkPayment()" checked> 선택 안함</td>
  </tr>
  <tr> 
    <td><input type="radio" name="liquidlibrary" value="100" onClick="checkPayment()" <? IF( 'ablestock1' == $membership ) { $price = 100; echo "checked"; } ?> 1개월</td>
    <td>100  USD</td>
  </tr>
  
  <tr> 
    <td><input type="radio" name="liquidlibrary" value="200" onClick="checkPayment()" <? IF( 'ablestock2' == $membership ) { $price = 200; echo "checked"; } ?>3개월 </td>
    <td>200 USD</td>
  </tr>
  <tr> 
    <td><input type="radio" name="liquidlibrary" value="600" onClick="checkPayment()" <? IF( 'ablestock3' == $membership ) { $price = 600; echo "checked"; } ?> 6개월</td>
    <td>600 USD</td>
  </tr>
  
  <tr> 
    <td><input type="radio" name="liquidlibrary" value="1200" onClick="checkPayment()" <? IF( 'ablestock4' == $membership ) { $price = 1200; echo "checked"; } ?> 12개월</td>
    <td>1200 USD</td>
  </tr>
</table>

<br>

<table>
    <tr>
	<td id=payment_sum >
	<font  color="#FF6600" style="font-family:tahoma; font-size:11pt"><b><?=number_format( (int)$price )?></b></font>
	</td>
    </tr>
 </table>


 <input type=hidden name=price value="<?=$price?>">
</form>
