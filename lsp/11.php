




<!-- 시간 체크 관련 -->
<script>

function init(){
	CheckStart();		
}
window.onload = CheckStart;


var total_time = 30;	// 제한 시간 600

var timer = 0;
var cur_time = 0;

function NumFormat(n, digits) {
  var zero = '';
  n = n.toString();

  if (n.length < digits) {
    for (var i = 0; i < digits - n.length; i++)
      zero += '0';
  }
  return zero + n;
}

function SetTime(sec)
{
	var m = Math.floor(sec/60);
	var s = sec%60;
	var str = NumFormat(m,2)+':'+NumFormat(s,2);	



	document.getElementById('time').innerHTML = str;	
}


function CheckTime()
{
	cur_time--;
	SetTime(cur_time);
	if( cur_time == 0 )
	{
		clearInterval(timer);
		//CheckEnd('true');
	}
}

function CheckStart(set_time)
{
	if( timer ) clearInterval(timer);
	cur_time = total_time;
	SetTime(cur_time);
	timer = setInterval("CheckTime()", 1000);	
}


function check_it()
{
  SetTime(30);
  alert(getAttribute('time'));
  

}
</script>
<!-- 시간 체크 관련 end -->



<div id="Quiz">
 <div class="left"></div>
 <div class="center">


 <form name="form" >
<table width="134" border="0" cellpadding="0" cellspacing="0" background="../../img/quiz_time.gif">
<tr>
  <td width="75" height="30">&nbsp;</td>
  <td align="center" class="quiz_txtTime"><span id="time">00:00</span></td>
</tr>
</table>
 </form>

 <img src="../../img/btn_next.gif" onClick="check_it()"; />

