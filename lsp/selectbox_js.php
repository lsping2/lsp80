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

<a href="#" onClick="onsel()"><input type=button value='����'></a>


<select name="sel" onchange="addtext()"  style="display:none;"> 
  <option value="0">����</option> 
  <option value="1">1��</option> 
  <option value="2">2��</option> 
  <option value="3">3��</option> 
  <option value="4">4��</option> 
</select> 



<br> 
<span id="test"></span> 

</form> 

<!-- --------------------------------------------����Ʈ�ڽ� �̺�Ʈ---------------------------------------------------

<script language="javascript"> 
<!-- 
//////////////////////////////////////
//1.��ü�� ������ ���Ѵ�
//2.������ŭ ���������� �ɼ��� ����Ѵ�
//////////////////////////////////////
function Send() 
{ 

		var frm = eval("document.Form"); 
		var Sum
		var arrInp      
	
		frm.sel.style.display="inline";	 //����� select�ڽ� ���̰� �ϱ�
		arrInpCount = document.getElementsByName("inp");			//�ڽ� �������ϱ�

		for(i=0;i<arrInpCount.length;i++)
			{
						
				AddOption = document.createElement("option");
				frm.sel.add(AddOption);			 //�ɼǿ��� �߰�.
				frm.sel.options[i].text = frm.inp[i].value;	//���� ���̴� ��
				frm.sel.options[i].value =frm.inp[i].value;//���� name
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
		<input type="button" value="����"  onclick="Send()"> 
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