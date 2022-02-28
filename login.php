<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="imagetoolbar" content="no">
<title>로그인 | 부업나라</title>
<link rel="stylesheet" href="/login.css?ver=1202">

<!--[if lte IE 8]>
<script src="http://wclean.inckorea.net/js/html5.js"></script>
<![endif]-->


</head>
<body>

<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <div class="mbskin_box">
        <h1> 로그인</h1>
        <div class="mb_log_cate">
            <h2><span class="sound_only">회원</span>부업나라 로그인</h2>
          
        </div>
        <form name="flogin" action="/bbs/login_check.php" onsubmit="return flogin_submit(this);" method="post">
        <input type="hidden" name="url" value="">
        
        <fieldset id="login_fs">
            <legend>회원로그인</legend>
            <label for="login_id" class="sound_only">회원아이디<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" placeholder="아이디">
            <label for="login_pw" class="sound_only">비밀번호<strong class="sound_only"> 필수</strong></label>
            <input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20" placeholder="비밀번호">
            <button type="submit" class="btn_submit">로그인</button>
            
            
        </fieldset> 
        </form>
            </div>

        
	<!-- 주문하기, 신청하기 -->
	
        
</div>

<script>

function flogin_submit(f)
{
    if( $( document.body ).triggerHandler( 'login_sumit', [f, 'flogin'] ) !== false ){
        return true;
    }
    return false;
}
</script>
<!-- } 로그인 끝 -->




</body>
</html>
