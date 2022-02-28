
<style>
.mome { font-size:25px; font-weight:bold; color:#FFF; margin-left:-0.5em; padding:6px 0 5px; border-bottom:rgba(255, 255, 255, 0.1) 1px solid}

</style>
<div id="motopmenu">
	<ul class="mome"><a href="/">MENU</a></ul>
	<ul class="cd-navigation">
		<li class="item-has-children">
			<a href="#0">회사소개</a>
			<ul class="sub-menu">
				<li><a href="./sub1.php">인사말</a></li>
				<li><a href="./sub2.php">연혁</a></li>
				<li><a href="./sub3.php">비전</a></li>
				<li><a href="./sub4.php">조직</a></li>
				<li><a href="./sub4.php">사업장 소개</a></li>
				<li><a href="./sub5.php">찾아오시는 길</a></li>
			</ul>
		</li>

		<li class="item-has-children">
			<a href="#0">사업분야</a>
			<ul class="sub-menu">
				<li><a href="./sub1.php">물류사업</a></li>
				<li><a href="./sub2.php">3PL</a></li>
				<li><a href="./sub3.php">부가사업</a></li>
			</ul>
		</li>
		
		<li class="item-has-children">
			<a href="#0">채용정보</a>
			<ul class="sub-menu">
				<li><a href="./sub1.php">차량 분양정보</a></li>
				<li><a href="./sub2.php">지입차주 분양문의</a></li>
				<li><a href="./sub3.php">인재상</a></li>
			</ul>
		</li>
		
		<li class="item-has-children">
			<a href="#0">홍보센터</a>
			<ul class="sub-menu">
				<li><a href="./sub1.php">홍보동영상</a></li>
				<li><a href="./sub2.php">드림원갤러리</a></li>
				<li><a href="./sub3.php">지입차주갤러리</a></li>
			</ul>
		</li>
		
		<li class="item-has-children">
			<a href="#0">고객지원</a>
			<ul class="sub-menu">
				<li><a href="./sub1.php">뉴스</a></li>
				<li><a href="./sub2.php">공지사항</a></li>
				<li><a href="./sub3.php">온라인문의</a></li>
			</ul>
		</li>

	</ul> <!-- cd-navigation -->
</div>
<script>
	$(".item-has-children>ul>li>a").click(function(){
		$(this).toggleClass("active");	
	});
</script>