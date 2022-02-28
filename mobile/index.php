<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_MOBILE_PATH.'/_head.php');
?>

<!-- 메인화면 최신글 시작 -->
<?php
//  최신글
$sql = " select bo_table
            from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
            where a.bo_device <> 'pc' ";
if(!$is_admin)
    $sql .= " and a.bo_use_cert = '' ";
$sql .= " order by b.gr_order, a.bo_order ";

$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 스킨은 입력하지 않을 경우 관리자 > 환경설정의 최신글 스킨경로를 기본 스킨으로 합니다.

    // 사용방법
    // latest(스킨, 게시판아이디, 출력라인, 글자수);
    echo latest("basic", $row['bo_table'], 5, 25);
}
?>
<!-- 메인화면 최신글 끝 -->


<? if( strstr($userAgent,"iphone") || strstr($userAgent,"ipad")  ) :?>
		<a href="javascript:alert('아이폰 아이패드 계열은 [홈 화면에 추가]를 이용해 주시기 바랍니다.')">BOOKMARK</a>
<? else :?>
		<?
			if( !$home_img_url ) $home_img_url = "http://www.dreamq.net/mobile/img/r_logo.png";
			if( !$home_name ) $home_name = "dreammarket";
            $home_name = "드림마켓";
		?>
		<a id="applink" href="naversearchapp://addshortcut?url=mall.dream.net/<?=$mall_id?>&icon=<?=$home_img_url?>&title=<?=$home_name?>&serviceCode=nstore&version=7"  >BOOKMARK</a>
<? endif ?>

<a href="http://shop.rebella.kr/shop/help/">[레퍼럴]</a>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-analytics.js"></script>

<script>

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyDeDrVYWzrBJ5YD_hZ_ySesmYkd4xntONQ",
    authDomain: "lsp80-221704.firebaseapp.com",
    projectId: "lsp80-221704",
    storageBucket: "lsp80-221704.appspot.com",
    messagingSenderId: "94471790322",
    appId: "1:94471790322:web:4c83a2c1004d8ca5257a6b",
    measurementId: "G-MSJ91TTTJ1"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>


<?php
include_once(G5_MOBILE_PATH.'/_tail.php');
?>