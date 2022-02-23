<?

$WhatSelect =  $_GET[WhatSelect];
$keyword =	 $_GET[keyword];
?>
<script> 
function OpenSelect(SelectName) { 
    if (eval(SelectName +"SelectDisplay").style.display == 'none') { 
        eval(SelectName +"SelectDisplay").style.display = 'block'; 
    } 
    else { 
        eval(SelectName +"SelectDisplay").style.display = 'none'; 
    } 
} 
function InsertValue(FormName, SelectName, HtmlCode) { 
    if (HtmlCode.replace(/(.*?)<a (.*?)>(.*?)<\/a>/i, '$3')) { 
        eval(FormName +"."+ SelectName + "SelectValue").value = HtmlCode.replace(/(.*?)<a (.*?)>(.*?)<\/a>/i, '$3'); 
    } 
    else { 
        eval(FormName +"."+ SelectName + "SelectValue").value = HtmlCode.replace(/(.*?)<a (.*?)>(.*?)<\/a>/i, '$1'); 
    } 
    eval(SelectName + "FirstValue").innerHTML = HtmlCode.replace(/(.*?)<a (.*?)>(.*?)<\/a>/i, '$1'); 
    OpenSelect(SelectName); 
} 
function CreateSelect(FormName, SelectName) { 
    document.write("<table cellspacing='0' cellpadding='0' style='cursor: default;' onmouseover=\"" +SelectName+ "ArrowBar.style.color = 'FFFFFF';\" onmouseout=\"" +SelectName+ "ArrowBar.style.color = '868686';\">"); 
    document.write("<tr onclick=\"OpenSelect('" +SelectName+ "');\">"); 
    document.write("    <td style='border:1 solid #e6e6e6; font-size: 15;' id='" +SelectName+ "FirstValue'></td>"); 
    document.write("    <td id='" +SelectName+ "ArrowBar' bgcolor='e6e6e6' style='font-family: HY°ß°íµñ; font-size: 10; color: 868686;' align='center' width='14'>¡å</td>"); 
    document.write("</tr>"); 
    document.write("<tr>"); 
    document.write("    <td colspan='2'>"); 
    document.write("        <table width='100%' id='" +SelectName+ "SelectDisplay' bgcolor='FFFFFF' style='display: none; border:1 solid #e6e6e6; border-top: 0; position: absolute;'>"); 
    document.write("        <tr><td id='" +SelectName+ "SelectBar'></td></tr>"); 
    document.write("        </table>"); 
    document.write("    </td>"); 
    document.write("</tr>"); 
    document.write("</table>"); 
    document.write("<input type='hidden' name='" +SelectName+ "SelectValue'>"); 

    var strBarHtml = ""; 
    var intSaveLength = 0; 
    var intFontLength = 0; 
     
    for (i = 0; i < eval(FormName +"."+ SelectName).options.length; i++) { 
        intFontLength = 0; 
         
        strBarHtml += "<div onclick=\"InsertValue('" +FormName+ "', '" +SelectName+ "', this.innerHTML);\" style='font-size: 15;' onmouseover=\"this.style.backgroundColor = 'e6e6e6';\" onmouseout=\"this.style.backgroundColor = '';\">"; 
        if (eval(FormName +"."+ SelectName).options[i].text) strBarHtml += eval(FormName +"."+ SelectName).options[i].text; 
        else strBarHtml += "&nbsp;"; 
        strBarHtml += "<a style='display: none;'>" +eval(FormName +"."+ SelectName).options[i].value+ "</a>"; 
        strBarHtml += "</div>"; 
        intFontLength += eval(FormName +"."+ SelectName).options[i].text.replace(/[¤¡-¤¾¤¿-¤Ó°¡-ÆR]/g, '').length; 
        intFontLength += eval(FormName +"."+ SelectName).options[i].text.replace(/[^¤¡-¤¾¤¿-¤Ó°¡-ÆR]/g, '').length * 2; 
     
        if (intFontLength > intSaveLength) { 
            intSaveLength = intFontLength; 
        } 
    } 
     
    if (eval(FormName +"."+ SelectName).options[eval(FormName +"."+ SelectName).selectedIndex].text) eval(SelectName + "FirstValue").innerHTML = eval(FormName +"."+ SelectName).options[eval(FormName +"."+ SelectName).selectedIndex].text; 
    else eval(SelectName + "FirstValue").innerHTML = "&nbsp;"; 
     
    eval(SelectName + "FirstValue").style.width = intSaveLength * 8; 
     
    eval(SelectName + "SelectBar").innerHTML = strBarHtml; 
    eval(FormName +"."+ SelectName).style.display = 'none'; 
    eval(FormName +"."+ SelectName + "SelectValue").name = eval(FormName +"."+ SelectName).name; 
    eval(FormName +"."+ SelectName).disabled = true; 
    eval(FormName +"."+ SelectName).name = 'DumpName'; 
     
} 

location.href= 'selectbox_js2.php?WhatSelect=' +  SelectValue + 'keyword=' + keyword;

</script> 
<form name='f'> 

<table> 
<tr> 
    <td> 
        <select name='WhatSelect'> 
        <option value='aaaaaaa'  <? if( 'aaaaaaa' == $WhatSelect) echo ' selected';?>>aaaaaaa</option> 
        <option value='bbbbbbb' <? if( 'bbbbbbb' == $WhatSelect) echo ' selected';?>>bbbbbbb</option> 
        <option value='ccccccc' <? if( 'ccccccc' == $WhatSelect) echo ' selected';?>>ccccccc</option> 
        <option value='ddddddd' <? if( 'ddddddd' == $WhatSelect) echo ' selected';?>>ddddddd</option> 
        </select> 
        <script> 
        CreateSelect('f', 'WhatSelect'); 
        </script> 
    </td> 
    <td> 
        <input onfocus="OpenSelect('WhatSelect');" name=keyword> 
    </td> 
</tr> 
</table> 

<input type=submit>

</form> 