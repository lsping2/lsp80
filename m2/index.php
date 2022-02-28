
<?php include_once('./head.php'); ?> 

<div id="wrapper">
	<div id="container">
	
	 <link rel=stylesheet href="http://dwlogis.kr/mobile/css/demo-slideshow.css">
	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	
		<!-- include Cycle2 -->
		<script src="http://dwlogis.kr/mobile/js/jquery.cycle2.js"></script>

		<!-- include one or more optional Cycle2 plugins -->
		<script src="http://dwlogis.kr/mobile/js/jquery.cycle2.swipe.js"></script>
		<script src="http://dwlogis.kr/mobile/js/ios6fix.js"></script>

		<style>
		#prev { position:absolute; top:140px; left:0px; color:#FFFFFF; padding:10px; z-index:300}
		#next { position:absolute; top:140px; right:0px; color:#FFFFFF; padding:10px; z-index:300}

		.maintextWrap {position:absolute; top:100px; z-index:1000; width:80%; margin:0 10%; text-align:center; font-family:'Noto Sans KR';color:#FFF;}
		.maintextWrap span {display:block}
		.maintext {padding-bottom:10px;text-align:center;font-size:20px; line-height:1.3em; font-weight:bold; text-shadow:0px 0px 5px rgba(0,0,0,0.5); }
		.maintext02 {text-align:center; font-size:19px; line-height:1.6em; text-shadow:0px 0px 5px rgba(0,0,0,0.5); }
		</style>


		<div class="cycle-slideshow" 
			data-cycle-swipe=true
			data-cycle-swipe-fx=scrollHorz
			data-cycle-fx=scrollHorz
			data-cycle-timeout=5000
			data-cycle-prev="#prev"
			data-cycle-next="#next"
			>
		<div class="maintextWrap">
			<span class="maintext"><p>드림원로지스는<br />최고의 종합물류기업을 지향합니다</p></span>
			<span class="maintext02"><p>물류사업 &nbsp; · &nbsp; 3PL &nbsp; · &nbsp; 부가사업</p></span>
		</div>
		<div class="cycle-caption"></div>
			<img src="http://dwlogis.kr/data/file/mainimg_mo/2038556930_YqCFVHLd_27f3d164bcc6fbde63a432a055c0f947bce331a1.jpg" class="on" onClick="javascript:location.href=''">
			<img src="http://dwlogis.kr/data/file/mainimg_mo/2038556930_dn078oAL_0adb88884251074ba1704f88b589cb541b5799d0.jpg" class="on" onClick="javascript:location.href=''">
		</div>

		<div class="center">
			<a href=# id="prev"><img src="http://dwlogis.kr/mobile/image/arr_lt.png" width="16px"/></a> 
			<a href=# id="next"><img src="http://dwlogis.kr/mobile/image/arr_rt.png" width="16px"/></a>
		</div>

		<div style=" position:relative; display:inline-block;padding:10px 2% 0px;">
			<ul>
				<li style="float:left; width:49%;margin-right:2%;"><a href="/bbs/board.php?bo_table=video"><img src="/kor/image/mcon01.jpg" width="100%"/></a></li>
				<li style="float:left; width:49%;"><a href="/bbs/board.php?bo_table=gallery01"><img src="/kor/image/mcon02.jpg" width="100%"/></a></li>
			</ul>
		</div>

		<div style=" position:relative; display:inline-block;padding:10px 2% 0px;">
			<ul>
				<li style="float:left; width:49%;margin-right:2%;"><a href="/bbs/board.php?bo_table=gallery02"><img src="/kor/image/mcon03.jpg" width="100%"/></a></li>
				<li style="float:left; width:49%;"><a href="/bbs/write.php?bo_table=online"><img src="/kor/image/mcon044.jpg" width="100%" /></a></li>
			</ul>
		</div>


		<div style="padding:10px 2% 10px">

			<div class="lt">
				<a href="http://dwlogis.kr/bbs/board.php?bo_table=notice" class="lt_title"><strong>공지사항</strong></a>
				<ul>
						<li>게시물이 없습니다.</li>
					</ul>
				<div class="lt_more"><a href="http://dwlogis.kr/bbs/board.php?bo_table=notice"><span class="sound_only">공지사항</span>더보기</a></div>
			</div>
		</div>


		<div style="padding:10px 2% 10px">
			<div class="lt">
				<a href="http://dwlogis.kr/bbs/board.php?bo_table=info_01" class="lt_title"><strong>차량 분양정보</strong></a>
				<ul>
						<li>
						<a href="http://dwlogis.kr/bbs/board.php?bo_table=info_01&amp;wr_id=26">[17톤 후축 윙바디] 서울,수도권~(전국) 쿠팡물류 …    </a>        </li>
						<li>
						<a href="http://dwlogis.kr/bbs/board.php?bo_table=info_01&amp;wr_id=25">[8.5톤 후축 윙바디] 서울,수도권~(전국) 쿠팡물류…    </a>        </li>
						</ul>
				<div class="lt_more"><a href="http://dwlogis.kr/bbs/board.php?bo_table=info_01"><span class="sound_only">차량 분양정보</span>더보기</a></div>
			</div>
		</div>

		<div style="padding:10px 2% 10px">

			<div class="lt">
				<a href="http://dwlogis.kr/bbs/board.php?bo_table=info_02" class="lt_title"><strong>지입차주 분양문의</strong></a>
				<ul>
						<li>게시물이 없습니다.</li>
					</ul>
				<div class="lt_more"><a href="http://dwlogis.kr/bbs/board.php?bo_table=info_02"><span class="sound_only">지입차주 분양문의</span>더보기</a></div>
			</div>
			</div>

		</div>


	<?php include_once('./inc/foot.php'); ?> 



</div>  <!-- container -->
</div>  <!-- wrapper -->





<?php include_once('./inc/menu.php'); ?> 




</body>
</html>
