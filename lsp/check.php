<SCRIPT LANGUAGE="JavaScript">
<!--

function draw_check(form)
{
//	var value = document.getElementByName("draw_code[]");
//var check = document.getElementById("draw_code[]").checked==true
	var l = document.getElementsByName('draw_code[]');


			var del_id = '';			
					for (i = 0; i < l.length; i++)
					 {
							if (l[i].checked == true)
							{
							 del_id += l[i].value ;    
							}				
					 }
					if(del_id=="")
					{
						alert("체크하라요.")
						return false;
					}

	form = document.member;
	form.submit();
}
//-->
</SCRIPT>

<form name="member" method="post" action="check_act.php" style="margin:0px; padding:0px;">
<table width="690" border="0" cellpadding="0" cellspacing="0">
      <tr>
	<td width="230"><input type="checkbox" name="draw_code[]" value="a">
	배송불만</td>
	<td width="230"><input type="checkbox" name="draw_code[]" value="b">
	상품의 다양성 불만 </td>
	<td width="230"><input type="checkbox" name="draw_code[]" value="c">
	상품 가격 불만 </td>
      </tr>
      <tr>
	<td><input type="checkbox" name="draw_code[]" value="d">
	상품 품질 불만 </td>
	<td><input type="checkbox" name="draw_code[]" value="e">
	교환 / 환불 / 재작업 불만 </td>
	<td><input type="checkbox" name="draw_code[]" value="f">
	실질저거인 혜택 부족 </td>
      </tr>
      <tr>
	<td><input type="checkbox" name="draw_code[]" value="g">
	사용이 불편함 </td>
	<td> <input type="checkbox" name="draw_code[]" value="h">
	개인정보 유출 우려 </td>
	<td><input type="checkbox" name="draw_code[]" value="i">
	자주 사용하지 않음 </td>
      </tr>
      <tr>
	<td><input type="checkbox" name="draw_code[]" value="j">
	기타사유</td>
	<td><input type="checkbox" name="draw_code[]" value="k">
	고객서비스 불친절 </td>
	<td>&nbsp;</td>
      </tr>

	  <tr>
			  <td height="60" align="center"><img src="../images/mypage/btn_ok.gif" width="65" height="40" border="0" style='cursor:hand;' onclick="javascript:draw_check(this.form);"> &nbsp; <img src="../images/mypage/btn_cancel.gif" width="65" height="40" border="0" style='cursor:hand;' onclick="javascript:reset();"></td>
		 </tr>
  </table>
  </form>
