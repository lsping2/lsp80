<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=1240">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">
<meta name="HandheldFriendly" content="true">
<meta name="format-detection" content="telephone=no">



<title>스푼업 SPOONUP</title>
<link rel="stylesheet" href="http://spoonup.co.kr/css/mobile.css?ver=161020">
<link rel="stylesheet" href="http://spoonup.co.kr/mobile/skin/connect/basic/style.css?ver=161020">
<link rel="stylesheet" href="http://spoonup.co.kr/mobile/skin/outlogin/basic/style.css?ver=161020">
<link rel="stylesheet" href="http://spoonup.co.kr/mobile/skin/latest/gallery/style.css?ver=161020">
<link rel="stylesheet" href="http://spoonup.co.kr/mobile/skin/latest/basic/style.css?ver=161020">
<link rel="stylesheet" href="http://spoonup.co.kr/mobile/skin/popular/basic/style.css?ver=161020">
<link rel="stylesheet" href="http://spoonup.co.kr/mobile/skin/visit/basic/style.css?ver=161020">
<!--[if lte IE 8]>
<script src="http://spoonup.co.kr/js/html5.js"></script>
<![endif]-->


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

</head>
<body>

<header id="hd">
    <h1 id="hd_h1">스푼업</h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

   
    <div id="hd_wrapper">

        <div id="logo">
            <a href="http://lsp80.cafe24.com/m"><img src="http://spoonup.co.kr/kor/image/logo.gif" width="120"></a>
        </div>

       



<?php include_once('./inc/menu.php'); ?> 



        <button type="button" id="hd_sch_open" class="hd_opener">검색<span class="sound_only"> 열기</span></button>

        <div id="hd_sch" class="hd_div">
            <h2>사이트 내 전체검색</h2>
            <form name="fsearchbox" action="http://spoonup.co.kr/bbs/search.php" onsubmit="return fsearchbox_submit(this);" method="get">
            <input type="hidden" name="sfl" value="wr_subject||wr_content">
            <input type="hidden" name="sop" value="and">
            <input type="text" name="stx" id="sch_stx" placeholder="검색어(필수)" required class="required" maxlength="20">
            <input type="submit" value="검색" id="sch_submit">
            </form>

            <script>
            function fsearchbox_submit(f)
            {
                if (f.stx.value.length < 2) {
                    alert("검색어는 두글자 이상 입력하십시오.");
                    f.stx.select();
                    f.stx.focus();
                    return false;
                }

                // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
                var cnt = 0;
                for (var i=0; i<f.stx.value.length; i++) {
                    if (f.stx.value.charAt(i) == ' ')
                        cnt++;
                }

                if (cnt > 1) {
                    alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
                    f.stx.select();
                    f.stx.focus();
                    return false;
                }

                return true;
            }
            </script>
            <button type="button" id="sch_close" class="hd_closer"><span class="sound_only">검색 </span>닫기</button>
        </div>

        <script>
        $(function () {
            $(".hd_opener").on("click", function() {
                var $this = $(this);
                var $hd_layer = $this.next(".hd_div");

                if($hd_layer.is(":visible")) {
                    $hd_layer.hide();
                    $this.find("span").text("열기");
                } else {
                    var $hd_layer2 = $(".hd_div:visible");
                    $hd_layer2.prev(".hd_opener").find("span").text("열기");
                    $hd_layer2.hide();

                    $hd_layer.show();
                    $this.find("span").text("닫기");
                }
            });

            $(".hd_closer").on("click", function() {
                var idx = $(".hd_closer").index($(this));
                $(".hd_div:visible").hide();
                $(".hd_opener:eq("+idx+")").find("span").text("열기");
            });
        });
        </script>

  

    </div>
</header>