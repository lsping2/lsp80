<script>

 function SU_cutString(str, maxSize)
{
	var l = 0;
	var idx = 0;
	for(idx=0; idx < str.length; idx++) {         
	    var c = escape(str.charAt(idx));                   
	    if( c.length==1 ) l ++;         
	    else if( c.indexOf("%u")!=-1 ) l += 2;         
	    else if( c.indexOf("%")!=-1 ) l += c.length/3;
	    if ( l > maxSize ) break;
	}
	return str.substr(0, idx); 
}

  function SU_byteLength(str)
{
    var l = 0;           
    for(var idx=0; idx < str.length; idx++) {         
        var c = escape(str.charAt(idx));                   
        if( c.length==1 ) l ++;         
        else if( c.indexOf("%u")!=-1 ) l += 2;         
        else if( c.indexOf("%")!=-1 ) l += c.length/3;     
    }           
    return l; 
}

function checkMsgSize() {
	var maxSize = 80;
	var f = document.writeForm;
	var size = SU_byteLength(f.msg.value);
	if ( size > maxSize ) {
		window.alert("메세지는 "+maxSize+"Bytes까지만 입력 가능합니다.   ");
		f.msg.value = SU_cutString(f.msg.value, maxSize);
		f.msgSize.value = SU_byteLength(f.msg.value);
	} else {
		f.msgSize.value = size;
	}
}

</script>
<form name="writeForm" method="post">
<table width="400" border="0" cellpadding="2" cellspacing="1" bgcolor="#cccccc" align="center">
			  <tr>
			    <td width="25%" class="td_head">발송번호</td>
			    <td width="75%" class="td_val"><input type="text" name="from" value="0261045828" style="width: 100px;"></td>
			  </tr>
			  <tr>
			    <td width="25%" class="td_head">SMS메세지</td>
			    <td width="75%" class="td_val"><?$msg="{name} 드림큐 회원님! 생일을축하드립니다 오늘 정회원 전환시 만원드립니다!http://dreamq.net";?>
			    	<textarea name="msg" onkeyup="checkMsgSize();" style="width: 250px; height: 45px;"><?=$msg?></textarea>
			    	<div><input type="text" name="msgSize" value="0" style="width: 20px" readonly> Bytes</div>
			    </td>
			  </tr>
			</table>		
			</form>