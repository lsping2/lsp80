<HTML> 
<HEAD> 

<script> 

function modelesswin(url,mwidth,mheight){ 
if (document.all) //if ie5 
eval('window.showModelessDialog(url,"","help:0;dialogtop:110px;dialogleft:1px;scrollbars:0;resizable:0;status:0;dialogWidth:'+mwidth+'px;dialogHeight:'+mheight+'px")') 
else 
eval('window.open(url,"","top=23px,left=23px,width='+mwidth+'px,height='+mheight+'px,resizable=0,scrollbars=0,status=0")') 
} 

// 열려는 문서의 URL과 크기를 지정 해 줍니다 
modelesswin("http://kelinkr.com.ne.kr/daum/daum_menu1.html",1024,136) 

// 링크로 팝업창을 띄우실려면 다음처럼 작성합니다 
// <a href="javascript:modelesswin('주소또는 파일',가로사이즈,세로사이즈)">항상위에 있는 팝업 띄우기</a> 

</script> 


</HEAD> 
<BODY> 
</BODY>