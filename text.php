<script src="http://lsp80.cafe24.com/js/jquery-1.8.3.min.js"></script>
<script>
function move (key) { 
	if (key=="�Ÿ�"){
		$("#image_�Ÿ�").show();
		$("#image_����").hide();
		$("#image_����").hide();				
	} else if (key=="����"){
		$("#image_�Ÿ�").hide();
		$("#image_����").show();
		$("#image_����").hide();			
	} else if (key=="����"){
		$("#image_�Ÿ�").hide();
		$("#image_����").hide();
		$("#image_����").show();
	}
} 
</script>
</script>

<form action="info_list.php" method="get" name="search" onSubmit="return searchi(this)">
            

  <table width="155" border="0" cellspacing="1" cellpadding="1">
	<tr>
	  <td width="93">
	  <select name="categoryi" id="categoryi" style="width:100">
		  <option value="" selected>--�Ź�����--</option>
		  <option value="91" >����/������</option>
		  <option value="90" >����/�Ӿ�</option>
		  <option value="95" >����</option>
		  <option value="93" >����Ʈ/����</option>
		  <option value="92" >����/â��</option>
		  <option value="94" >��Ÿ</option>   
	</select>     
	</td>
	</tr>                    
	<tr>
	  <td>
	  <select name="parti" onChange="move(this.value);" style="width:100">
		<option value="">--���ݱ���--</option>
		<option value="�Ÿ�" >�Ÿ�</option>	
		<option value="����" >����</option>
		<option value="����" >����</option>                        															
	  </select>
	  </td>
	</tr>
</table>


<span id = "image_�Ÿ�" style="display:none">
<table width="155" border="0" cellspacing="1" cellpadding="1">
<tr>
  <td><select name="maemae_moneyi" id="maemae_moneyi" style="width:100">
	<option value="" selected>--�ŸŰ�--</option>
	<option value="-5000" >5õ����</option>
	<option value="5000-10000" >5õ~1��</option>
	<option value="10000-20000" >1��~2��</option>
	<option value="20000-50000" >2��~5��</option>
	<option value="50000-100000" >5��~10��</option>
	<option value="100000-200000" >10��~20��</option>                                                
	<option value="200000-" >20���̻�</option> 
  </select></td>
</tr>
</table>
</span>


<span id = "image_����" style="display:none">
<table width="155" border="0" cellspacing="1" cellpadding="1">
<tr>
  <td><select name="jen_moneyi" id="jen_moneyi" style="width:100">
	<option value="" selected>--������--</option>
	<option value="-500" >5������</option>
	<option value="500-1000" >5��~1õ</option>
	<option value="1000-2000" >1õ~2õ</option>
	<option value="2000-5000" >2õ~5õ</option>
	<option value="5000-10000" >5õ~1��</option>
	<option value="10000-30000" >1��~3��</option>                                                
	<option value="30000-" >3���̻�</option> 
  </select></td>
</tr>
</table>
</span>


<span id = "image_����" style="display:none">
<table width="155" border="0" cellspacing="1" cellpadding="1">                                      
<tr>
  <td><select name="security_moneyi" id="security_moneyi" style="width:100">
	<option value="" selected>--������--</option>
	<option value="-500" >5������</option>
	<option value="500-1000" >5��~1õ</option>
	<option value="1000-2000" >1õ~2õ</option>
	<option value="2000-5000" >2õ~5õ</option>
	<option value="5000-10000" >5õ~1��</option>
	<option value="10000-30000" >1��~3��</option>                                                
	<option value="30000-" >3���̻�</option>                                                                                                                                                
  </select></td>
</tr>
<tr>
  <td><select name="month_moneyi" id="month_moneyi" style="width:100">
	<option value="" selected>--���Ӵ��--</option>
	<option value="-40" >40����</option>
	<option value="40-60" >40~60</option>
	<option value="60-80" >60~80</option>
	<option value="80-100" >80~100</option>
	<option value="100-150" >100~150</option>
	<option value="150-200" >150~200</option>                                                
	<option value="200-" >200�̻�</option>   
  </select></td>
</tr>
</table>                    
</span>
               
<img src="img/include/search3.gif" style="CURSOR: pointer" onMouseDown="javascript:searchi()">