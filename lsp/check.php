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
						alert("üũ�϶��.")
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
	��ۺҸ�</td>
	<td width="230"><input type="checkbox" name="draw_code[]" value="b">
	��ǰ�� �پ缺 �Ҹ� </td>
	<td width="230"><input type="checkbox" name="draw_code[]" value="c">
	��ǰ ���� �Ҹ� </td>
      </tr>
      <tr>
	<td><input type="checkbox" name="draw_code[]" value="d">
	��ǰ ǰ�� �Ҹ� </td>
	<td><input type="checkbox" name="draw_code[]" value="e">
	��ȯ / ȯ�� / ���۾� �Ҹ� </td>
	<td><input type="checkbox" name="draw_code[]" value="f">
	���������� ���� ���� </td>
      </tr>
      <tr>
	<td><input type="checkbox" name="draw_code[]" value="g">
	����� ������ </td>
	<td> <input type="checkbox" name="draw_code[]" value="h">
	�������� ���� ��� </td>
	<td><input type="checkbox" name="draw_code[]" value="i">
	���� ������� ���� </td>
      </tr>
      <tr>
	<td><input type="checkbox" name="draw_code[]" value="j">
	��Ÿ����</td>
	<td><input type="checkbox" name="draw_code[]" value="k">
	������ ��ģ�� </td>
	<td>&nbsp;</td>
      </tr>

	  <tr>
			  <td height="60" align="center"><img src="../images/mypage/btn_ok.gif" width="65" height="40" border="0" style='cursor:hand;' onclick="javascript:draw_check(this.form);"> &nbsp; <img src="../images/mypage/btn_cancel.gif" width="65" height="40" border="0" style='cursor:hand;' onclick="javascript:reset();"></td>
		 </tr>
  </table>
  </form>
