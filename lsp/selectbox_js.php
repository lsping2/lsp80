<script language="javascript"> 
<!-- 

function sum() 
{ 
	 var frm = eval("document.Form"); 

        if(frm.inp0.value && frm.inp1.value && frm.inp2.value && frm.inp3.value)
	{ 
            frm.sums.value = parseInt(frm.inp0.value) + parseInt(frm.inp1.value) + parseInt(frm.inp2.value) + parseInt(frm.inp3.value); 
        }
 } 

function addtext(){ 
    var i = document.all.sel.value; 

    var str = ""; 

    for(loop=1;loop<=i;loop++){ 
        str += "<input name='name"+loop+"' type='text' class='text'><br>"    ; 
    } 

    document.all.test.innerHTML = str; 
} 


function onsel()
{
	Form.sel.style.display="inline";	
}



//--> 
</script> 

<form name="Form" method="post"> 
<? FOR ($loop=0; $loop<4; $loop++) :?>

<input type="text" size=5 name="inp<?=$loop?>" onkeypress=sum(); onkeyup=sum();> 
<? ENDFOR ?>

<input type="text" name="sums">

<a href="#" onClick="onsel()"><input type=button value='생성'></a>


<select name="sel" onchange="addtext()"  style="display:none;"> 
  <option value="0">선택</option> 
  <option value="1">1개</option> 
  <option value="2">2개</option> 
  <option value="3">3개</option> 
  <option value="4">4개</option> 
</select> 



<br> 
<span id="test"></span> 

</form> 

<!-- --------------------------------------------셀렉트박스 이벤트---------------------------------------------------

<script language="javascript"> 
<!-- 
//////////////////////////////////////
//1.객체의 갯수를 구한다
//2.갯수만큼 루프를돌려 옵션을 출력한다
//////////////////////////////////////
function Send() 
{ 

		var frm = eval("document.Form"); 
		var Sum
		var arrInp      
	
		frm.sel.style.display="inline";	 //숨겼던 select박스 보이게 하기
		arrInpCount = document.getElementsByName("inp");			//박스 갯수구하기

		for(i=0;i<arrInpCount.length;i++)
			{
						
				AddOption = document.createElement("option");
				frm.sel.add(AddOption);			 //옵션영역 추가.
				frm.sel.options[i].text = frm.inp[i].value;	//실제 보이는 값
				frm.sel.options[i].value =frm.inp[i].value;//실제 name
			}
 } 

</script>	 

<form name="Form" method="post"> 
<table>
<tr>

	<td>
	<input type="text" name="inp"> 
	<input type="text" name="inp"> 
	<input type="text" name="inp"> 
	<input type="text" name="inp"> 
	</td>

	<td>
		<input type="button" value="전송"  onclick="Send()"> 
	</td>
</tr>
<tr>
<td>
<select name="sel" style="display:none;">
</select>
</td>
</tr>
</table>
</form> 
//--> 