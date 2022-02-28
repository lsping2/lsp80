<?php

define('_INDEX_', true);
include_once('./_common.php');
echo "test1--2222";
/* 
$to = 'in2323a@naver.com'; //상대 메<cd class=""></cd>일주소 
$subject = 'the subject'; //제목 
$message = 'hello'; //본문 
$headers = 'From: webmaster@example.com' . "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion(); //헤더설정 
$result = mail($to, $subject, $message, $headers); //메일송신
echo "-->".$result;
*/
 
// 초기화면 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_index'] && is_file(G5_PATH.'/'.$config['cf_include_index'])) {
    include_once(G5_PATH.'/'.$config['cf_include_index']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}
 
include_once('./_head.php');
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-78740726-1', 'auto');
  ga('send', 'pageview');

</script>
<h2 class="sound_only">최신글</h2>
<!-- 최신글 시작 { -->
<?php 
//  최신글
$sql = " select bo_table
            from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
            where a.bo_device <> 'mobile' ";
if(!$is_admin)
    $sql .= " and a.bo_use_cert = '' ";
$sql .= " order by b.gr_order, a.bo_order ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($i%2==1) $lt_style = "margin-left:20px";
    else $lt_style = "";
?>
    <div style="float:left;<?php echo $lt_style ?>">
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        echo latest("basic", $row['bo_table'], 5, 25);
        ?>
    </div>
<?php
}
?>
<!-- } 최신글 끝 -->


<script>
    function postToFacebook() {
       
 FB.login(function(response) {
   if(response.authResponse) {
     FB.api('/me', function(response){
       alert(response.name);
     });
   }

var body = 'Reading JS SDK documentation';
FB.api('/me/feed', 'post', { message: body }, function(response) {
  if (!response || response.error) {
    alert('Error occured');
  } else {
    alert('Post ID: ' + response.id);
  }
});

 });g

    }
    </script>



<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '806628996049819',
      xfbml      : true,
      version    : 'v2.12'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";  //ko_KR
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>


<div class="fb-page" 
  data-tabs="timeline,events,messages"
  data-href="https://www.facebook.com/YoloBookStore"
  data-width="380" 
  data-hide-cover="false"></div>
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>


<?php
include_once('./_tail.php');
?>

<a href="http://shop.rebella.kr/shop/help/">[레퍼럴]</a>

<?
$s_datatime = "2019-06-25 10:00:00";
$e_datatime = "2019-06-27 10:30:00";


// 두개의 날자,시간을 비교 계산 일,시,분,초 단위로 경과시간 반환
function datetime_diff($sdate, $edate) {
	global $g5;
	$result = array();
	
	$s_arr = explode(" ", $sdate);
	$e_arr = explode(" ", $edate);
	$s_time = $s_arr[1];
	$e_time = $e_arr[1];
	$s_strtotime = strtotime($sdate);
	$e_strtotime = strtotime($edate);
	$sp_cha = $e_strtotime - $s_strtotime;
	$cha_a_hour = ceil($sp_cha / (60 * 60));
	$cha_a_min = ceil($sp_cha / 60);
	$cha_day = (int)($sp_cha / (60 * 60 * 24));
	$cha_hour = (int)($sp_cha / (60 * 60));
	$cha_min = (int)($sp_cha / 60);
	$que_day = " select DATEDIFF('$edate', '$sdate') as day ";
	$row_day = sql_fetch($que_day);
	$que_time = " select TIMEDIFF('$edate', '$sdate') as time ";
	$row_time = sql_fetch($que_time);
	$time_cha = explode(":", $row_time['time']);
	$x_day = $time_cha[0] - ($cha_day * 24);

	$result['aday'] = $row_day['day']; // 24시간 이전도 1
	$result['ahour'] = $cha_a_hour; // 소수점이하 올림으로 총 데이터
	$result['amin'] = $cha_a_min;
	$result['asec'] = $sp_cha;
	$result['fhour'] = $cha_hour;		// 소수점이하 버림 총 시간 데이터
	$result['fmin'] = $cha_min;		// 소수점이하 버림 총 분 데이터
	$result['day'] = $cha_day;		// 미만은 삭제된 데이터
	$result['hour'] = $x_day;			// 일자를 제외한 시간 차이
	$result['min'] = $time_cha[1];	// 일자,시간을 제외한 분 차이
	$result['sec'] = $time_cha[2];	// 일자,시간,분을 제외한 초 차이
	
    return $result;
}

$res = datetime_diff($s_datatime, $e_datatime);


echo "일-->".$res['day']."<br>";
echo "시간-->".(int)($res['hour'] + 1)."<br>";
echo "분-->".$res['min']."<br>";
?>

<script>
 $(document).ready(function(){    
     navigator.geolocation.getCurrentPosition(function(pos) {
         var latitude = pos.coords.latitude;
         var longitude = pos.coords.longitude;
         // alert("현재 위치는 : " + latitude + ", "+ longitude);
         
		 /*$.ajax({
             type:'POST',
             url:'GetLocation.php',
             data:'latitude='+latitude+'&longitude='+longitude
         });
		 */
     });
 });    
 </script>



  



 


<br><br>
<h2>

<a id="applink" href="naversearchapp://addshortcut?url=http://shop.agit.kr/myshop/good/&icon=http://shop.agit.kr/mobile/img/cate2.png&title=아지트샵&serviceCode=nstore&version=7">안드로이드 바탕화면 아이콘 생성</a>

</h2>
<br><br>



<!-- LightWidget WIDGET --><script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/caa1df7df1135358b058017b94b5b2d1.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:500px;border:0;overflow:hidden;"></iframe>



