<?
echo $_GET[ Sel ];
/*
$b = "a%5B%5D=a1&a%5B%5D=a2&a%5B%5D=a3&a%5B%5D=a4&a%5B%5D=a5";

echo urldecode( $b );
*/
?>

<HTML> 
<HEAD> 
<TITLE> New Document </TITLE> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- 
var cat1 = new Array("�ѱ�,1","�Ϻ�,2","�̱�,3"); 
var cat2 = new Array(); 

cat2[1] = new Array("����,1","�뱸,2","�λ�,3"); 
cat2[2] = new Array("����,1","����ī,2","�ƿ���,3"); 
cat2[3] = new Array("���𿡰�,1","����,2","�ػ罺,3"); 

function setCategory(){ 
    var mf = document.form1.category1; 
    var nOpt = ""; 

    for(i=0;i<cat1.length;i++){ 
        nOpt = document.createElement("OPTION"); 
        mf.options.add(nOpt); 
        nOpt.innerText = cat1[i].substring(0,cat1[i].indexOf(",")); 
        nOpt.value = cat1[i].substring(cat1[i].indexOf(",")+1); 
    } 
} 

function change_cat(){ 
    var mf1 = document.form1.category1; 
    var mf2 = document.form1.category2; 

    if(mf2.length > 0){ 
        while(mf2.length > 0){ 
            mf2.remove(0); 
        } 
    } 

    selCatValue = mf1.options[mf1.selectedIndex].value; 
    for(i=0;i<cat2[selCatValue].length;i++){ 
        nOpt = document.createElement("OPTION"); 
        mf2.options.add(nOpt); 
        nOpt.innerText = cat2[selCatValue][i].substring(0,cat2[selCatValue][i].indexOf(",")); 
        nOpt.value = cat2[selCatValue][i].substring(cat2[selCatValue][i].indexOf(",")+1); 
    } 
} 
//--> 
</SCRIPT> 
</HEAD> 

<BODY onLoad="javascript:setCategory();"> 
<form name="form1"> 
<select name="category1" onChange="javascript:change_cat();"> 
</select> 
<select name="category2"> 
</select> 
</form> 
</BODY> 
</HTML> 