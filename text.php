<script src="http://lsp80.cafe24.com/js/jquery-1.8.3.min.js"></script>
<script>
function move (key) { 
	if (key=="매매"){
		$("#image_매매").show();
		$("#image_전세").hide();
		$("#image_월세").hide();				
	} else if (key=="전세"){
		$("#image_매매").hide();
		$("#image_전세").show();
		$("#image_월세").hide();			
	} else if (key=="월세"){
		$("#image_매매").hide();
		$("#image_전세").hide();
		$("#image_월세").show();
	}
} 
</script>
</script>

<form action="info_list.php" method="get" name="search" onSubmit="return searchi(this)">
            

  <table width="155" border="0" cellspacing="1" cellpadding="1">
	<tr>
	  <td width="93">
	  <select name="categoryi" id="categoryi" style="width:100">
		  <option value="" selected>--매물구분--</option>
		  <option value="91" >전원/농가주택</option>
		  <option value="90" >토지/임야</option>
		  <option value="95" >원룸</option>
		  <option value="93" >아파트/빌라</option>
		  <option value="92" >공장/창고</option>
		  <option value="94" >기타</option>   
	</select>     
	</td>
	</tr>                    
	<tr>
	  <td>
	  <select name="parti" onChange="move(this.value);" style="width:100">
		<option value="">--가격구분--</option>
		<option value="매매" >매매</option>	
		<option value="전세" >전세</option>
		<option value="월세" >월세</option>                        															
	  </select>
	  </td>
	</tr>
</table>


<span id = "image_매매" style="display:none">
<table width="155" border="0" cellspacing="1" cellpadding="1">
<tr>
  <td><select name="maemae_moneyi" id="maemae_moneyi" style="width:100">
	<option value="" selected>--매매가--</option>
	<option value="-5000" >5천이하</option>
	<option value="5000-10000" >5천~1억</option>
	<option value="10000-20000" >1억~2억</option>
	<option value="20000-50000" >2억~5억</option>
	<option value="50000-100000" >5억~10억</option>
	<option value="100000-200000" >10억~20억</option>                                                
	<option value="200000-" >20억이상</option> 
  </select></td>
</tr>
</table>
</span>


<span id = "image_전세" style="display:none">
<table width="155" border="0" cellspacing="1" cellpadding="1">
<tr>
  <td><select name="jen_moneyi" id="jen_moneyi" style="width:100">
	<option value="" selected>--전세가--</option>
	<option value="-500" >5백이하</option>
	<option value="500-1000" >5백~1천</option>
	<option value="1000-2000" >1천~2천</option>
	<option value="2000-5000" >2천~5천</option>
	<option value="5000-10000" >5천~1억</option>
	<option value="10000-30000" >1억~3억</option>                                                
	<option value="30000-" >3억이상</option> 
  </select></td>
</tr>
</table>
</span>


<span id = "image_월세" style="display:none">
<table width="155" border="0" cellspacing="1" cellpadding="1">                                      
<tr>
  <td><select name="security_moneyi" id="security_moneyi" style="width:100">
	<option value="" selected>--보증금--</option>
	<option value="-500" >5백이하</option>
	<option value="500-1000" >5백~1천</option>
	<option value="1000-2000" >1천~2천</option>
	<option value="2000-5000" >2천~5천</option>
	<option value="5000-10000" >5천~1억</option>
	<option value="10000-30000" >1억~3억</option>                                                
	<option value="30000-" >3억이상</option>                                                                                                                                                
  </select></td>
</tr>
<tr>
  <td><select name="month_moneyi" id="month_moneyi" style="width:100">
	<option value="" selected>--월임대료--</option>
	<option value="-40" >40이하</option>
	<option value="40-60" >40~60</option>
	<option value="60-80" >60~80</option>
	<option value="80-100" >80~100</option>
	<option value="100-150" >100~150</option>
	<option value="150-200" >150~200</option>                                                
	<option value="200-" >200이상</option>   
  </select></td>
</tr>
</table>                    
</span>
               
<img src="img/include/search3.gif" style="CURSOR: pointer" onMouseDown="javascript:searchi()">