사용설명서

사용중인 그누보드5 폴더에서

config.php 를 에디터로 열고 아래 구문을 적당한 위치에 추가 합니다.

define('G5_JSMENU_DIR',         'jsmenu');
define('G5_JSMENU_URL',         G5_URL.'/'.G5_JSMENU_DIR);
define('G5_JSMENU_PATH',       G5_PATH.'/'.G5_JSMENU_DIR);

그리고 최상위 폴더 즉 adm,bbs 폴더가 위치한 곳에 
다음 다운로드 받으신 메뉴의 압축을 풀어 jsmenu 폴더째 계정에 업로드 합니다.

그런후 head.php 파일을 에디터로 열고 108번째줄에서 152번째줄까지 모두 삭제 합니다.

<nav id="gnb">
  불라블라블라.......
</nav>

상단부분을 아래와 같이 수정 합니다. 참고 하단의 /js01/menu.php 의  js01 은 다운받은 파일의 번호 입니다.
<nav id="js00"> <--- 이부분은 수정 하시면 안됩니다.
	<?php include_once G5_JSMENU_PATH.'/js01/menu.php'?>
</nav>

위와 같이 수정 후에 저장 하시면 됩니다. 마지막으로 /css/default.css 파일을 에디터로 열고 
89번째줄의 #container 부분을 찾아서 z-index:4; 부분을 /*z-index:4;*/ 같이 주석 처리 하거나 삭제해 주시면 됩니다.

반듯이 위와 같은 작업을 선행 하셔야 JS메뉴들이 정상 작동 합니다.
어려운 부분이나 질문은  http://nanoomi.org , http://apachezone.com 또는 http://sir.co.kr  의 묻고 답하기 게시판을 이용해 주시면 감사 하겠습니다.
