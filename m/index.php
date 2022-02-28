<?php include_once('./head.php'); ?> 

<hr>

<div id="wrapper">
    <div id="aside">
        
		<aside id="ol_before" class="ol">
			<h2>회원로그인</h2>
			<!-- 로그인 전 외부로그인 시작 -->
			<form name="foutlogin" action="http://spoonup.co.kr/bbs/login_check.php" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">
			<fieldset>
				<input type="hidden" name="url" value="%2F">
				<input type="text" name="mb_id" id="ol_id" placeholder="회원아이디(필수)" required class="required" maxlength="20">
				<input type="password" id="ol_pw" name="mb_password" placeholder="비밀번호(필수)" required class="required" maxlength="20">
				<input type="submit" id="ol_submit" value="로그인">
				<div id="ol_svc">
					<a href="http://spoonup.co.kr/bbs/register.php"><b>회원가입</b></a>
					<a href="http://spoonup.co.kr/bbs/password_lost.php" id="ol_password_lost">정보찾기</a>
				</div>
			</fieldset>
			</form>
		</aside>

		<script>

		function fhead_submit(f)
		{
			return true;
		}
		</script>
		<!-- 로그인 전 외부로그인 끝 -->
			</div>
    
	
	<!-- sub 슬라이드메뉴 -->
<script type="text/javascript" src="/mobile/inc/jquery.touchFlow.js"></script>
<style>
.nav_h_type { background:#eee; position:relative; overflow:hidden; }
.nav_h_type ul { float:left; display:block; font-size:0; white-space:nowrap; position:relative; padding:0 10px !important}
.nav_h_type li { -webkit-box-sizing:border-box; box-sizing:border-box; display:inline-block; padding:10px 20px; line-height:30px; vertical-align:top; text-align:center; font-size:13px; background:#eee; border-right:1px solid #f9f9f9; }
.nav_h_type li.on {font-weight:bold; color:#000; }
.nav_h_type.wide li {width:280px; }

.nav_v_type { width:200px; height:200px; margin:0 auto; background:#ccc; position:relative; overflow:hidden; }
.nav_v_type ul { display:block; position:relative; }
.nav_v_type li { -webkit-box-sizing:border-box; box-sizing:border-box; display:block; width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; background:#eee; border:1px solid #ccc; }
.nav_v_type li.on { font-weight:bold; color:#000 }

.contents_scroll { width:250px; height:300px; margin:0 auto; font-size:14px; background:#f5f5f5; position:relative; overflow:hidden; }
.contents_scroll .contents { position: relative; }
.contents_scroll p { padding:10px; }

.touchflow-scrollbar { background:rgba(0,0,0,0.1); transition:300ms; position:absolute; bottom:0; right:0; overflow:hidden; }
.touchflow-scrollbar div { background:rgba(0,0,0,0.2); position:absolute; top:0; left:0; }
</style>

<script>
//<![CDATA[
$(document).ready(function() {
	
	// 4 : axis:x, scrollbar:true, scrollbarAutoHide:false, apply multiple elements
	$(".nav_h_list").touchFlow({
		axis: "x",
		page: "li.on",
		scrollbar: true,
		scrollbarAutoHide: false
	});
	
});
//]]>
</script>

<div id="container">
	
        
<link rel=stylesheet href="http://spoonup.co.kr/mobile/css/demo-slideshow.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	
<!-- include Cycle2 -->
<script src="http://spoonup.co.kr/mobile/js/jquery.cycle2.js"></script>

<!-- include one or more optional Cycle2 plugins -->
<script src="http://spoonup.co.kr/mobile/js/jquery.cycle2.swipe.js"></script>
<script src="http://spoonup.co.kr/mobile/js/ios6fix.js"></script>


<style>
#prev { position:absolute; top:17px; left:0px; color:#FFFFFF; padding:10px; z-index:300}
#next { position:absolute; top:17px; right:0px; color:#FFFFFF; padding:10px; z-index:300}
</style>

		<div class="cycle-slideshow" 
			data-cycle-swipe=true
			data-cycle-swipe-fx=scrollHorz
			data-cycle-fx=scrollHorz
			data-cycle-timeout=5000
			data-cycle-prev="#prev"
			data-cycle-next="#next">

				<img src="http://spoonup.co.kr/data/file/banner01/2038556930_N5B0xg7n_3428d42bc3b75eba9f9a82a08a4f56bd0dcf43c9.jpg" class="on" onClick="javascript:location.href=''">
				<img src="http://spoonup.co.kr/data/file/banner01/2038556930_lBgWX0rc_3c0fbbb01cdc7360e620f04d9fe6325ef9b5906c.jpg" class="on" onClick="javascript:location.href=''">
				<img src="http://spoonup.co.kr/data/file/banner01/2038556930_R91rsK8t_505a0ec279365dc085993e6d43501a07f85b09be.jpg" class="on" onClick="javascript:location.href=''">
		</div>

		<div class="center">
			<a href=# id="prev"><img src="http://spoonup.co.kr/mobile/image/left.png" width="16px"/></a> 
			<a href=# id="next"><img src="http://spoonup.co.kr/mobile/image/right.png" width="16px"/></a>
		</div>





		<div class="lt_gallery">
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
		</div>


		<div class="lt_gallery">
			<a href="http://spoonup.co.kr/bbs/board.php?bo_table=certi" class="lt_title"><i class="fa fa-list-ul" aria-hidden="true"></i> <strong>손익인증</strong></a>
			<ul id="gall_ul">
					<li class="gall_li ">
					<div class="gall_li_wr">

					<a href="http://www.xn--9t4b80d47r.net/bbs/board.php?bo_table=certi&amp;wr_id=2" class='gall_img'><img src="http://spoonup.co.kr/data/file/certi/thumb-2038556930_nOEhUatB_1fa7c90e82884c6e9be7086d519486aea0dae4ce_300x200.jpg"></a>            
						<div class="gall_text_href">
												<a href="http://www.xn--9t4b80d47r.net/bbs/board.php?bo_table=certi&amp;wr_id=2" class="gall_li_tit">
								공릉동 라인닷컴 공릉동 라인닷컴 공릉동 라인닷…                    </a>
											
						</div>
					</div>
				</li>
				   <li class="gall_li ">
					<div class="gall_li_wr">

					<a href="http://www.xn--9t4b80d47r.net/bbs/board.php?bo_table=certi&amp;wr_id=2" class='gall_img'><img src="http://spoonup.co.kr/data/file/certi/thumb-2038556930_nOEhUatB_1fa7c90e82884c6e9be7086d519486aea0dae4ce_300x200.jpg"></a>            
						<div class="gall_text_href">
												<a href="http://www.xn--9t4b80d47r.net/bbs/board.php?bo_table=certi&amp;wr_id=2" class="gall_li_tit">
								공릉동 라인닷컴 공릉동 라인닷컴 공릉동 라인닷…                    </a>
											
						</div>
					</div>
				</li>
					</ul>
			<div class="lt_more"><a href="http://spoonup.co.kr/bbs/board.php?bo_table=certi"><span class="sound_only">손익인증</span>더보기</a></div>
		</div>



		

		<div class="lt">
			<a href="http://spoonup.co.kr/bbs/board.php?bo_table=notice" class="lt_title"><strong>공지사항</strong></a>
			<ul>
					<li>
					<a href="http://www.xn--9t4b80d47r.net/bbs/board.php?bo_table=notice&amp;wr_id=1">스푼업 홈페이지가 오픈되었습니다.    </a>        </li>
					</ul>
			<div class="lt_more"><a href="http://spoonup.co.kr/bbs/board.php?bo_table=notice"><span class="sound_only">공지사항</span>더보기</a></div>
		</div>




    </div> <!-- container -->
</div> <!--wrapper-->

<hr>


<hr>


<?php include_once('./inc/foot.php'); ?> 




</body>
</html>
