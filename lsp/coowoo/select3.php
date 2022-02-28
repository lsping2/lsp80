<script language=javascript>
function gor(argSel,argRes)
{
formSel=eval("document.reg."+argSel);

j=formSel.length;

for(var i=0;i<document.reg.a.length;i++)
{
                if(document.reg.a.options[i].selected && document.reg.a.options[i].value)
                {
                document.reg.a.options[i].selected=false;

                chk_same=0;

                        for(var k=0;k<formSel.length;k++)
                        {
                                if(document.reg.a.options[i].value==formSel.options[k].value)
                                {
                                chk_same=1;                                
                                }        
                        }                        

                        if(!chk_same)
                        {
                        formSel.options[j]=new Option(document.reg.a.options[i].text,document.reg.a.options[i].value);

                        j++;
                        }
                }
}

get_result(argSel,argRes)
}

function gol(argSel,argRes)
{
formSel=eval("document.reg."+argSel);

buff=new Array();
j=0;

for(var i=formSel.length-1;i>=0;i--)
{
                if(formSel.options[i].selected && formSel.options[i].value)
                {
                formSel.options[i] = null;
                }
}

get_result(argSel,argRes);
}

function get_result(argSel,argRes)
{
formSel=eval("document.reg."+argSel);
formRes=eval("document.reg."+argRes);

res=new Array();

for(var i=0;i<formSel.length;i++)
{
res[i]=formSel.options[i].value;
}

res=res.join("@");
formRes.value=res;
}

function gou(argSel,argRes)
{
formSel                = eval("document.reg."+argSel);

        if(!formSel.value)
        {
        return;
        }

thisIndex        = formSel.selectedIndex;

        if(!thisIndex)
        {
        return;
        }

formSel.value=null;

prevIndex=thisIndex-1;

tempText=formSel.options[prevIndex].text;
tempValue=formSel.options[prevIndex].value;

formSel.options[prevIndex]        = new Option(formSel.options[thisIndex].text,formSel.options[thisIndex].value);

formSel.options[thisIndex]        = new Option(tempText,tempValue);

formSel.value=formSel.options[prevIndex].value;

get_result(argSel,argRes);
}

function god(argSel,argRes)
{
formSel                = eval("document.reg."+argSel);

        if(!formSel.value)
        {
        return;
        }

thisIndex        = formSel.selectedIndex;

        if(thisIndex+1>=formSel.length)
        {
        return;
        }

formSel.value=null;

prevIndex=thisIndex+1;

tempText=formSel.options[prevIndex].text;
tempValue=formSel.options[prevIndex].value;

formSel.options[prevIndex]        = new Option(formSel.options[thisIndex].text,formSel.options[thisIndex].value);

formSel.options[thisIndex]        = new Option(tempText,tempValue);

formSel.value=formSel.options[prevIndex].value;

get_result(argSel,argRes);
}
</script>



<table border=0 cellpadding=0 cellspacing=0>
<form name=reg>
<tr>
<td rowspan=6>
<select name=a size=20 style=width:200 multiple>
<option value='1'>Â¥Àå¸é</option>
<option value='2'>Â«»Í</option>
<option value='3'>ººÀ½¹ä</option>
<option value='4'>¶ó¸é</option>
<option value='5'>±èÄ¡</option>
<option value='6'>´Ü¹«Áö</option>
<option value='7'>°ø±â¹ä</option>
<option value='8'>±è¹ä</option>
<option value='9'>¶ó¸é</option>
<option value='10'>¹é¹Ý</option>
</select>
</td>
<td></td><td>¾ÆÄ§¸Þ´º</td><td></td>
</tr>
<tr>
<td>
&nbsp;<input class=button type=button value=' > ' onclick=gor('b1','res1')>&nbsp;
<br>
&nbsp;<input class=button type=button value=' < ' onclick=gol('b1','res1')>&nbsp;
</td>
<td>
<select name=b1 size=5 style=width:200>
</select>
</td>
<td>
&nbsp;<input class=button type=button value=' ¡è ' onclick=gou('b1','res1')>&nbsp;
<br>
&nbsp;<input class=button type=button value=' ¡é ' onclick=god('b1','res1')>&nbsp;
</td>
</tr>
<tr>
<td></td><td>Á¡½É¸Þ´º</td></td><td></td>
</tr>
<tr>
<td>
&nbsp;<input class=button type=button value=' > ' onclick=gor('b2','res2')>&nbsp;
<br>
&nbsp;<input class=button type=button value=' < ' onclick=gol('b2','res2')>&nbsp;
</td>
<td>
<select name=b2 size=5 style=width:200>
</select>
</td>
<td>
&nbsp;<input class=button type=button value=' ¡è ' onclick=gou('b2','res2')>&nbsp;
<br>
&nbsp;<input class=button type=button value=' ¡é ' onclick=god('b2','res2')>&nbsp;
</td>
</tr>

<tr>
<td></td><td>Àú³á¸Þ´º</td></td><td></td>
</tr>
<tr>
<td>
&nbsp;<input class=button type=button value=' > ' onclick=gor('b3','res3')>&nbsp;
<br>
&nbsp;<input class=button type=button value=' < ' onclick=gol('b3','res3')>&nbsp;
</td>
<td>
<select name=b3 size=5 style=width:200>
</select>
</td>
<td>
&nbsp;<input class=button type=button value=' ¡è ' onclick=gou('b3','res3')>&nbsp;
<br>
&nbsp;<input class=button type=button value=' ¡é ' onclick=god('b3','res3')>&nbsp;
</td>
</tr>
</table>

<br>
°á°ú°ª<br>
<input type=text name=res1 size=30><br>
<input type=text name=res2 size=30><br>
<input type=text name=res3 size=30><br>
</form> 