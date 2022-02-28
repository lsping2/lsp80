<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">
<meta name="HandheldFriendly" content="true">
<meta name="format-detection" content="telephone=no">
<meta name="robots" content="ALL">
<link rel="canonical" href="eujinflower.co.kr">
<meta name="title" content="유진농원 아로니아농장" />
<meta name="keywords" content="유진농원, 아로니아, 유진아로니아, 아로니아열매, 아로니아분말, 유기농아로니아">
<meta name="description" content="유진농원, 아로니아, 유진아로니아, 아로니아열매, 아로니아분말, 유기농아로니아">
<meta property="og:title" content="유진농원 아로니아농장">
<meta property="og:type" content="website">
<meta property="og:site_name" content="유진농원 아로니아농장">
<meta property="og:url" content="eujinflower.co.kr">
<meta property="og:description" content="유진농원, 아로니아, 유진아로니아, 아로니아열매, 아로니아분말, 유기농아로니아">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>아로니아농장 유진농원</title>
<link rel="stylesheet" href="http://eujinflower.co.kr/theme/basic/css/mobile_shop.css?ver=161020">
<link rel="stylesheet" href="http://eujinflower.co.kr/mobile/skin/shop/basic/style.css?ver=161020">
<link rel="stylesheet" href="http://eujinflower.co.kr/theme/basic/mobile/skin/latest/ask_basic/style.css?v=new1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css?ver=161020">
<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css?ver=161020">
<!--[if lte IE 8]>
<script src="http://eujinflower.co.kr/js/html5.js"></script>
<![endif]-->

<script src="http://eujinflower.co.kr/js/jquery-1.8.3.min.js"></script>

</head>
<body>

<header id="hd">
    <h1>아로니아농장 유진농원</h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    
		
<ul id="hd_tnb">
		<li><a href="http://eujinflower.co.kr/bbs/login.php?url=%2F%3Fdevice%3Dmobile">LOGIN</a></li>
		 <li><a href="http://eujinflower.co.kr/bbs/register.php" id="snb_join">JOIN</a></li>
	   <li><a href="http://eujinflower.co.kr/shop/mypage.php">MY PAGE</a></li>
		<li><a href="tel:010-9559-7980" style="color:#F36;border-right:1px solid #e9e9e9" >전화하기</a></li>
		<li><a href="http://eujinflower.co.kr/shop/cart.php" class="tnb_cart"><span></span>CART</a></li>
</ul>


    <div id="logo"><a href="http://lsp80.cafe24.com/m3/"><img src="http://eujinflower.co.kr/data/common/mobile_logo_img" alt="아로니아농장 유진농원 메인"></a></div>

<button type="button" id="hd_sch_open">검색<span class="sound_only"> 열기</span></button>

<form name="frmsearch1" action="http://eujinflower.co.kr/shop/search.php" onsubmit="return search_submit(this);">
<aside id="hd_sch">
	<div class="sch_inner">
		<h2>상품 검색</h2>
		<label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
		<input type="text" name="q" value="" id="sch_str" required class="frm_input">
		<input type="submit" value="검색" class="btn_submit">
		<button type="button" class="pop_close"><span class="sound_only">검색 </span>닫기</button>
	</div>
</aside>
</form>
<script>
	$(function (){
	var $hd_sch = $("#hd_sch");
	$("#hd_sch_open").click(function(){
		$hd_sch.css("display","block");
	});
	$("#hd_sch .pop_close").click(function(){
		$hd_sch.css("display","none");
	});
});

function search_submit(f) {
	if (f.q.value.length < 2) {
		alert("검색어는 두글자 이상 입력하십시오.");
		f.q.select();
		f.q.focus();
		return false;
	}

	return true;
}

</script>

<ul id="hd_mb">
	<li><a href="./sub1.php">농장소개</a></li>
	<li><a href="./sub2.php">아로니아란?</a></li>
	<li><a href="./sub3.php">아로니아열매</a></li>
	<li><a href="./sub4.php">아로니아분말</a></li>
	<li><a href="./sub4.php">커뮤니티</a></li>
</ul>

</header>