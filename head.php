<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

// 상단 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_head'] && is_file(G5_PATH.'/'.$config['cf_include_head'])) {
    include_once(G5_PATH.'/'.$config['cf_include_head']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨 
//add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0); 
require_once(G5_PLUGIN_PATH.'/social_login/naver/naver_fun.php'); 
require_once(G5_PLUGIN_PATH.'/social_login/kakao/kakao_fun.php');
require_once(G5_PLUGIN_PATH.'/social_login/daum/daum_client.php');


$kakao = new Kakao(array( 
        "REST_ID" => KA_CONSUMER_KEY,        // (*필수)REST ID   
        "RETURN_URL" => G5_PLUGIN_URL."/social_login/kakao/kalogin.php"      // (*필수)콜백 URL 
         ) 
    ); 

$naver = new Naver(array( 
        "CLIENT_ID" => NV_CONSUMER_KEY,         

        "CLIENT_SECRET" => NV_CONSUMER_SECRET,         
        "RETURN_URL" => G5_PLUGIN_URL."/social_login/naver/naverlogin.php"      // (*필수)콜백 URL 
         ) 

    ); 
$daum = new Daum(array( 
        "CLIENT_ID" => DAUM_CONSUMER_KEY,         
        "CLIENT_SECRET" => DAUM_CONSUMER_SECRET,         
        "RETURN_URL" => G5_PLUGIN_URL."/social_login/daum/daumlogin.php"      // (*필수)콜백 URL 
 
         ) 
    ); 
$nvstate = $naver->generate_state(); 
$dastate = $daum->generate_state(); 
$kastate = $kakao->generate_state(); 


?> 




<script> 



function slogin(lt) { 
    if(lt =="naver") { 
        var win = window.open("<?=NAVER_OAUTH_URL?>authorize?client_id=<?=NV_CONSUMER_KEY?>&response_type=code&redirect_uri=<?=NV_OAUTH_CALLBACK?>&state=<?=$nvstate?>", "네이버 아이디로 로그인","width=620, height=480, toolbar=no, location=no");  
        var timer = setInterval(function() {    
            if(win.closed) {   
                window.location.reload(); 
            }   
        }, 500);  
    } 
    else if(lt =="tw") { 
        var win = window.open("<?=G5_PLUGIN_URL?>/social_login/tw/login.php", "twLogin","width=720, height=580, toolbar=no, location=no,resizable=yes");  
        var timer = setInterval(function() {    
            if(win.closed) {   
                window.location.reload(); 
            }   
        }, 500);  
    } 
    else if(lt =="fb") { 
        var win = window.open("<?=G5_PLUGIN_URL?>/social_login/fb/login.php", "fbLogin","width=620, height=600, toolbar=no, location=no,resizable=yes");  
        var timer = setInterval(function() {    
            if(win.closed) {   
                window.location.reload(); 
            }   
        }, 500);  
    } 
    else if(lt =="daum") { 
    var win = window.open("<?=DAUM_OAUTH_URL?>authorize?client_id=<?=DAUM_CONSUMER_KEY?>&response_type=code&redirect_uri=<?=DAUM_CALLBACK_URL?>&state=<?=$dastate?>", "다음 아이디로 로그인","width=520, height=700, toolbar=no, location=no");  
        var timer = setInterval(function() {     
            if(win.closed) {    
                window.location.reload(); 
            }   
        }, 500);  
    } 
    else if(lt =="kakao") { 
        var win = window.open("<?=KAKAO_OAUTH_URL?>authorize?client_id=<?=KA_CONSUMER_KEY?>&response_type=code&redirect_uri=<?=KA_OAUTH_CALLBACK?>&state=<?=$kastate?>", "kakaologin","width=320, height=480, toolbar=no, location=no");  
        var timer = setInterval(function() {    
            if(win.closed) {   
                window.location.reload(); 
            }   
        }, 500);  
    } 
    else if(lt =="gg") { 
        var win = window.open("<?=G5_PLUGIN_URL?>/social_login/gg/login.php", "ggLogin","width=720, height=580, toolbar=no, location=no,resizable=yes");  
        var timer = setInterval(function() {    
            if(win.closed) {   
                window.location.reload(); 
            }   
        }, 500);  
    } 
} 

</script> 

<script type="text/javascript" src="/js/jquery.sticky.js"></script>
  <script>
    $(window).load(function(){
      $("#js00").sticky({ topSpacing: 0 });
    });
  </script>




<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <div id="hd_wrapper">

        <div id="logo" >
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.jpg"  width="130" alt="<?php echo $config['cf_title']; ?>" align="absmiddle"></a>
        </div>

        <fieldset id="hd_sch">
            <legend>사이트 내 전체검색</legend>
            <form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);">
            <input type="hidden" name="sfl" value="wr_subject||wr_content">
            <input type="hidden" name="sop" value="and">
            <label for="sch_stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="stx" id="sch_stx" maxlength="20">
            <input type="submit" id="sch_submit" value="검색">
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
        </fieldset>

        <div id="text_size">
            <!-- font_resize('엘리먼트id', '제거할 class', '추가할 class'); -->
            <button id="size_down" onclick="font_resize('container', 'ts_up ts_up2', '');"><img src="<?php echo G5_URL; ?>/img/ts01.gif" alt="기본"></button>
            <button id="size_def" onclick="font_resize('container', 'ts_up ts_up2', 'ts_up');"><img src="<?php echo G5_URL; ?>/img/ts02.gif" alt="크게"></button>
            <button id="size_up" onclick="font_resize('container', 'ts_up ts_up2', 'ts_up2');"><img src="<?php echo G5_URL; ?>/img/ts03.gif" alt="더크게"></button>
        </div>

        <ul id="tnb">
            <?php if ($is_member) {  ?>
            <?php if ($is_admin) {  ?>
            <li><a href="<?php echo G5_ADMIN_URL ?>"><b>관리자</b></a></li>
            <?php }  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php"><b>로그인</b></a></li>
            <?php }  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/faq.php">FAQ</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/current_connect.php">접속자 <?php echo connect(); // 현재 접속자수  ?></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/new.php">새글</a></li>
        </ul>
    </div>

    <hr>



	<nav id="js00"> 
		<?php include_once G5_PATH.'/jsmenu/js18/menu.php'?>
	</nav>

<!--
    <nav id="gnb">
        <h2>메인메뉴</h2>
        <ul id="gnb_1dul">
            <?php
            $sql = " select *
                        from {$g5['menu_table']}
                        where me_use = '1'
                          and length(me_code) = '2'
                        order by me_order, me_id ";
            $result = sql_query($sql, false);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

            for ($i=0; $row=sql_fetch_array($result); $i++) {
            ?>
            <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                <?php
                $sql2 = " select *
                            from {$g5['menu_table']}
                            where me_use = '1'
                              and length(me_code) = '4'
                              and substring(me_code, 1, 2) = '{$row['me_code']}'
                            order by me_order, me_id ";
                $result2 = sql_query($sql2);

                for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                    if($k == 0)
                        echo '<ul class="gnb_2dul">'.PHP_EOL;
                ?>
                    <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
                <?php
                }

                if($k > 0)
                    echo '</ul>'.PHP_EOL;
                ?>
            </li>
            <?php
            }

            if ($i == 0) {  ?>
                <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
            <?php } ?>
        </ul>
    </nav>
</div>

} 상단 끝 -->

<hr>
<?

?>
<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <div id="aside">
        <?php echo outlogin('basic'); // 외부 로그인  ?>
        <?php echo poll('basic'); // 설문조사  ?>
    </div>
    <div id="container">
        <?php if ((!$bo_table || $w == 's' ) && !defined("_INDEX_")) { ?><div id="container_title"><?php echo $g5['title'] ?></div><?php } ?>
