<HTML> 
<HEAD> 

<script> 

function modelesswin(url,mwidth,mheight){ 
if (document.all) //if ie5 
eval('window.showModelessDialog(url,"","help:0;dialogtop:110px;dialogleft:1px;scrollbars:0;resizable:0;status:0;dialogWidth:'+mwidth+'px;dialogHeight:'+mheight+'px")') 
else 
eval('window.open(url,"","top=23px,left=23px,width='+mwidth+'px,height='+mheight+'px,resizable=0,scrollbars=0,status=0")') 
} 

// ������ ������ URL�� ũ�⸦ ���� �� �ݴϴ� 
modelesswin("http://kelinkr.com.ne.kr/daum/daum_menu1.html",1024,136) 

// ��ũ�� �˾�â�� ���Ƿ��� ����ó�� �ۼ��մϴ� 
// <a href="javascript:modelesswin('�ּҶǴ� ����',���λ�����,���λ�����)">�׻����� �ִ� �˾� ����</a> 

</script> 


</HEAD> 
<BODY> 
</BODY>