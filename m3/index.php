<?php include_once('./head.php'); ?> 


<script src="http://eujinflower.co.kr/js/swipe.js"></script>
<script src="http://eujinflower.co.kr/js/shop.mobile.main.js"></script>


<div id="main_bn" class="swipe">
<ul class="slide-wrap bn_img">
<li class="bn_first">
<img src="http://eujinflower.co.kr/data/banner/3" width="640" alt="1"></li>
<li>
<img src="http://eujinflower.co.kr/data/banner/4" width="640" alt="2"></li>
</ul>
<div class="bn_silde_btn"><button type="button" class="bn_sl">1 배너이미지</button>
<button type="button">2 배너이미지</button>
</div>
</div>

<script>
$(function() {
    $("#main_bn").bannerSlide({
        wrap: ".slide-wrap",
        slides: ".slide-wrap > li",
        buttons: ".bn_silde_btn > button",
        btnActive: "bn_sl",
        startSlide: 0,
        auto: 0
    });
});
</script>




<div class="tbl_head01 tbl_wrap">
	<table>
	<thead>
	<tr>
		<th scope="col">제목</th>
		<th scope="col">날짜</th>
	</tr>
	</thead>
	<tbody>
		<tr class="">
			<td class="td_subject">
				유통시장 급변, 택배업종 인수 합병 '지각변동'   
			</td>
			<td class="td_date">04-04</td>
		</tr>
		<tr class="">
			<td class="td_subject">
				유통시장 급변, 택배업종 인수 합병 '지각변동'   
			</td>
			<td class="td_date">04-04</td>
		</tr>
		<tr class="">
			<td class="td_subject">
				유통시장 급변, 택배업종 인수 합병 '지각변동'   
			</td>
			<td class="td_date">04-04</td>
		</tr>

	</tbody>
	</table>
</div>




<div class="bottom_wrap">
	<div class="cs">
		<h4>문의 및 상담안내</h4>
		<p class="call">010-7152-7576</p>
		<span>평일 09:00~18:00<br />
		점심 12:00~13:00<br />휴무 토요일, 일요일, 공휴일</span>
	</div>


   <div class="bank">
		<h4>무통장입금안내</h4>
		<p class="call2">
			<span>우리은행</span> 120-07-103253<br />
			<span>예금주</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;박세봉
		</p>
		<div id="fam">
			<select name="formselect2" onChange='if(this.selectedIndex) { this.blur(); window.open(options[selectedIndex].value); }'>
				<option value="" selected="selected">인터넷뱅킹 바로가기</option>
				<option value="https://www.kbstar.com/">국민은행</option>
				<option value="https://www.kebhana.com/">KEB하나은행</option>
				<option value="http://www.standardchartered.co.kr/np/kr/Intro.jsp">SC제일은행</option>
				<option value="https://www.wooribank.com/">우리은행</option>
				<option value="http://www.epost.go.kr/main.retrieveMainPage.comm">우체국</option>
				<option value="https://www.shinhan.com/index.jsp">신한은행</option>
				<option value="https://www.ibk.co.kr/">기업은행</option>
				<option value="http://www.nonghyup.com/Main/main.aspx">농협</option>  
			 </select>
		</div>
	</div>
</div>



<div class="ft_ul_wrap">
		<span style="border:none"><a href="/theme/basic/sub/sub01_01.php?ptype=sub01_01">회사소개</a></span>
		<span><a href="http://eujinflower.co.kr/bbs/content.php?co_id=provision">서비스이용약관</a></span>
		<span><a href="http://eujinflower.co.kr/bbs/content.php?co_id=privacy">개인정보처리방침</a></span>
</div>    





<?php include_once('./inc/foot.php'); ?> 


<?php include_once('./inc/menu.php'); ?> 



</body>
</html>
