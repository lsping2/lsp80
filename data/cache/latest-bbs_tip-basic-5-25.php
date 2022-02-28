<?php
if (!defined('_GNUBOARD_')) exit;
$bo_subject='팁';
$list=array (
  0 => 
  array (
    'wr_id' => '183',
    'wr_num' => '-183',
    'wr_reply' => '',
    'wr_parent' => '183',
    'wr_is_comment' => '0',
    'wr_comment' => '0',
    'wr_comment_reply' => '',
    'ca_name' => 'PHP',
    'wr_option' => '',
    'wr_subject' => '타임데이터피커',
    'wr_content' => '<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://barobus.kr/build/jquery.datetimepicker.css"/>
<script src="http://barobus.kr/build/jquery.datetimepicker.full.min.js"></script>

<input name="wr_5" id="wr_5"  type="text" placeholder="가는날" readonly required class="frm_input required datetimepicker" />



<script>
$.datetimepicker.setLocale(\'ko\');
$(\'.datetimepicker\').datetimepicker({
	format:\'Y-m-d H:i\',
	minDate:0,
	allowTimes:[
			\'00:00\', \'00:30\', \'01:00\', \'01:30\', \'02:00\', \'02:30\',
			\'03:00\', \'03:30\', \'04:00\', \'04:30\', \'05:00\', \'05:30\',
			\'06:00\', \'06:30\', \'07:00\', \'07:30\', \'08:00\', \'08:30\',
			\'09:00\', \'09:30\', \'10:00\', \'10:30\', \'11:00\', \'11:30\', \'12:00\',
		    \'12:30\', \'13:00\', \'13:30\', \'14:00\', \'14:30\', \'15:00\', \'15:30\',
		    \'16:00\', \'16:30\', \'17:00\', \'17:30\', \'18:00\', \'18:30\', \'19:00\',
		    \'19:30\', \'20:00\', \'20:30\', \'21:00\', \'21:30\', \'22:00\', \'22:30\',
		    \'23:00\', \'23:30\'
		    
		]
});

</script>',
    'wr_link1' => '',
    'wr_link2' => '',
    'wr_link1_hit' => '0',
    'wr_link2_hit' => '0',
    'wr_hit' => '57',
    'wr_good' => '0',
    'wr_nogood' => '0',
    'mb_id' => 'admin',
    'wr_password' => '*EC8A94DBC67C1054C3B247BDDA6550AC30D4B756',
    'wr_name' => '관리자',
    'wr_email' => 'lsping@naver.com',
    'wr_homepage' => '',
    'wr_datetime' => '2020-08-07 11:43:51',
    'wr_file' => '0',
    'wr_last' => '2020-08-07 11:43:51',
    'wr_ip' => '119.69.11.7',
    'wr_facebook_user' => '',
    'wr_twitter_user' => '',
    'wr_1' => '',
    'wr_2' => '',
    'wr_3' => '',
    'wr_4' => '',
    'wr_5' => '',
    'wr_6' => '',
    'wr_7' => '',
    'wr_8' => '',
    'wr_9' => '',
    'wr_10' => '',
    'is_notice' => false,
    'subject' => '타임데이터피커',
    'comment_cnt' => '',
    'datetime' => '2020-08-07',
    'datetime2' => '08-07',
    'last' => '2020-08-07',
    'last2' => '08-07',
    'name' => '<span class="sv_member">관리자</span>',
    'reply' => 0,
    'icon_reply' => '',
    'icon_link' => '',
    'ca_name_href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;sca=PHP',
    'href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;wr_id=183',
    'comment_href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;wr_id=183',
    'icon_new' => '',
    'icon_hot' => '',
    'icon_secret' => '',
    'link' => 
    array (
      1 => NULL,
      2 => NULL,
    ),
    'link_href' => 
    array (
      1 => 'http://lsp80.cafe24.com/bbs/link.php?bo_table=bbs_tip&amp;wr_id=183&amp;no=1',
      2 => 'http://lsp80.cafe24.com/bbs/link.php?bo_table=bbs_tip&amp;wr_id=183&amp;no=2',
    ),
    'link_hit' => 
    array (
      1 => 0,
      2 => 0,
    ),
    'file' => 
    array (
      'count' => '0',
    ),
  ),
  1 => 
  array (
    'wr_id' => '182',
    'wr_num' => '-182',
    'wr_reply' => '',
    'wr_parent' => '182',
    'wr_is_comment' => '0',
    'wr_comment' => '0',
    'wr_comment_reply' => '',
    'ca_name' => 'PHP',
    'wr_option' => '',
    'wr_subject' => '날짜 구간내 특정요일 추출',
    'wr_content' => '$start = strtotime(\'8/1/2020\');
$end = strtotime(\'8/31/2020\'); 
$result = array(); 
while ($start <= $end) {
	if (date(\'N\', $start) <= 5) {   //평일만 추출 요일처리가능
		$result[] = date(\'Y-m-d\', $start);
		//$result[$current] = \'\';
	}
	$start += 86400;
} 

for($i=0; $i<count($result); $i++){
	echo $result[$i];
	echo "<br>";
}',
    'wr_link1' => '',
    'wr_link2' => '',
    'wr_link1_hit' => '0',
    'wr_link2_hit' => '0',
    'wr_hit' => '49',
    'wr_good' => '0',
    'wr_nogood' => '0',
    'mb_id' => 'admin',
    'wr_password' => '*EC8A94DBC67C1054C3B247BDDA6550AC30D4B756',
    'wr_name' => '관리자',
    'wr_email' => 'lsping@naver.com',
    'wr_homepage' => '',
    'wr_datetime' => '2020-08-06 14:35:31',
    'wr_file' => '0',
    'wr_last' => '2020-08-06 14:35:31',
    'wr_ip' => '119.69.11.7',
    'wr_facebook_user' => '',
    'wr_twitter_user' => '',
    'wr_1' => '',
    'wr_2' => '',
    'wr_3' => '',
    'wr_4' => '',
    'wr_5' => '',
    'wr_6' => '',
    'wr_7' => '',
    'wr_8' => '',
    'wr_9' => '',
    'wr_10' => '',
    'is_notice' => false,
    'subject' => '날짜 구간내 특정요일 추출',
    'comment_cnt' => '',
    'datetime' => '2020-08-06',
    'datetime2' => '08-06',
    'last' => '2020-08-06',
    'last2' => '08-06',
    'name' => '<span class="sv_member">관리자</span>',
    'reply' => 0,
    'icon_reply' => '',
    'icon_link' => '',
    'ca_name_href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;sca=PHP',
    'href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;wr_id=182',
    'comment_href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;wr_id=182',
    'icon_new' => '',
    'icon_hot' => '',
    'icon_secret' => '',
    'link' => 
    array (
      1 => NULL,
      2 => NULL,
    ),
    'link_href' => 
    array (
      1 => 'http://lsp80.cafe24.com/bbs/link.php?bo_table=bbs_tip&amp;wr_id=182&amp;no=1',
      2 => 'http://lsp80.cafe24.com/bbs/link.php?bo_table=bbs_tip&amp;wr_id=182&amp;no=2',
    ),
    'link_hit' => 
    array (
      1 => 0,
      2 => 0,
    ),
    'file' => 
    array (
      'count' => '0',
    ),
  ),
  2 => 
  array (
    'wr_id' => '181',
    'wr_num' => '-181',
    'wr_reply' => '',
    'wr_parent' => '181',
    'wr_is_comment' => '0',
    'wr_comment' => '0',
    'wr_comment_reply' => '',
    'ca_name' => 'PHP',
    'wr_option' => '',
    'wr_subject' => '디데이 날짜',
    'wr_content' => 'function diff( $edate){
	$sdate = strtotime(date(\'Y-m-d\'));
	$edate = strtotime($edate);
	$diff = ($edate - $sdate) / (60 * 60 * 24);
	$diff =  $diff+1;
	if( $diff >= 1 ){
		return "D-DAY ".$diff."일";
	}else{
		return "<span class=\\"txt_red\\">만료</span>";
	}
}',
    'wr_link1' => '',
    'wr_link2' => '',
    'wr_link1_hit' => '0',
    'wr_link2_hit' => '0',
    'wr_hit' => '54',
    'wr_good' => '0',
    'wr_nogood' => '0',
    'mb_id' => 'admin',
    'wr_password' => '*EC8A94DBC67C1054C3B247BDDA6550AC30D4B756',
    'wr_name' => '관리자',
    'wr_email' => 'lsping@naver.com',
    'wr_homepage' => '',
    'wr_datetime' => '2020-08-04 09:38:13',
    'wr_file' => '0',
    'wr_last' => '2020-08-04 09:38:13',
    'wr_ip' => '119.69.11.7',
    'wr_facebook_user' => '',
    'wr_twitter_user' => '',
    'wr_1' => '',
    'wr_2' => '',
    'wr_3' => '',
    'wr_4' => '',
    'wr_5' => '',
    'wr_6' => '',
    'wr_7' => '',
    'wr_8' => '',
    'wr_9' => '',
    'wr_10' => '',
    'is_notice' => false,
    'subject' => '디데이 날짜',
    'comment_cnt' => '',
    'datetime' => '2020-08-04',
    'datetime2' => '08-04',
    'last' => '2020-08-04',
    'last2' => '08-04',
    'name' => '<span class="sv_member">관리자</span>',
    'reply' => 0,
    'icon_reply' => '',
    'icon_link' => '',
    'ca_name_href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;sca=PHP',
    'href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;wr_id=181',
    'comment_href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;wr_id=181',
    'icon_new' => '',
    'icon_hot' => '',
    'icon_secret' => '',
    'link' => 
    array (
      1 => NULL,
      2 => NULL,
    ),
    'link_href' => 
    array (
      1 => 'http://lsp80.cafe24.com/bbs/link.php?bo_table=bbs_tip&amp;wr_id=181&amp;no=1',
      2 => 'http://lsp80.cafe24.com/bbs/link.php?bo_table=bbs_tip&amp;wr_id=181&amp;no=2',
    ),
    'link_hit' => 
    array (
      1 => 0,
      2 => 0,
    ),
    'file' => 
    array (
      'count' => '0',
    ),
  ),
  3 => 
  array (
    'wr_id' => '180',
    'wr_num' => '-180',
    'wr_reply' => '',
    'wr_parent' => '180',
    'wr_is_comment' => '0',
    'wr_comment' => '0',
    'wr_comment_reply' => '',
    'ca_name' => 'ETC',
    'wr_option' => '',
    'wr_subject' => '씽굿-접수 참고(타사이트)',
    'wr_content' => '<script type="text/javascript">

	// 달력 설정
	if(typeof(calConfig) != \'undefined\') calConfig.max_year = parseInt(getDate(\'Y\'));

	// 팀체크 설정
	if(typeof(chk_team) == \'undefined\') var chk_team = true;

	// 중복 접수 체크
	function is_duplicate(uname, mobile) {
		// alert(uname+\'d\'+mobile);
		$.ajax({ 
			type: "POST", 
			url: "./check_duplicate.php", 
			data:{ "uname" : uname, "mobile" : mobile },
			async:false,
			success: function (response) { 
				// alert(response);
				m = response;
			},
			error: function (e) { 
				alert("서버 에러입니다."); 
			} 
		});
		return m;
	}

	var is_submit = false;

	//접수 시작
	function goSubmit(){
		if(is_submit){
			alert(\'처리중입니다. 잠시만 기다려주세요.\');
			return;
		}

		var uname  = $(\'[name=uname]\').val();
		var mobile = $(\'[name=mobile1]\').val()+"-"+$(\'[name=mobile2]\').val()+"-"+$(\'[name=mobile3]\').val();
		// var cate1  = $(\'[name=cate1]:checked\').val();

		//중복체크 
		var result_dupli_cnt = is_duplicate(uname, mobile); 
		// alert(\'result=\'+result_dupli_cnt);
		if(result_dupli_cnt > 2){
			alert(\'작품 접수는 최대 3개까지만 가능합니다. 더 이상 접수하실 수 없습니다.\');
			return;
		}

		var frm = document.form1;

		if(AF(frm)){
			
			var team = $(\'[name=form1] [name=team]:checked\').val() || $(\'[name=form1] [name=team]\').val();

			if(team == \'T\' && chk_team){
				if($(\'[name=form1] [name="team_contest_team_id[]"]\').length == 0){
					alert(\'팀원 정보를 입력해 주세요.\');
					return;
				}
			}

			is_submit = true;
			document.form1.action = \'proc.php\';
			document.form1.submit();
			//alert(\'섭밋ok\');
			return;
		}
	}

	//패스워드 체크
	function isStrongPassword(str){
		if(str.length < 6) return false;
		else if(str.match(/^[0-9]+$/g)) return false;
		else if(str.match(/^[a-z]+$/gi)) return false;
		else return true;
	}

	function isSameText(text1, text2){
		if(text1 == text2) return true;
		else return false;
	}

	function openZipSearch(el){
		new daum.Postcode({
			oncomplete: function(data) {
				var tar = $(el).closest(\'li\');
				$(\'[name*=zip]\', tar).val(data.zonecode); // 우편번호 (5자리)
				$(\'[name*=addr1]\', tar).val(data.address);
				$(\'[name*=addr2]\', tar).val(data.buildingName);
			}
		}).open();
	}

	// 팀원에 숫자 표시(넘버링)
	function showTeamNum(){
		var tar = $(\'[name=form1] [name="team_contest_team_id[]"]\').closest(\'#team_cnt\').find(\'h5:eq(0)\');
		var cnt	= 1;
		tar.each(function(){
		//	alert(cnt);
			$(this).html(\'팀원\' + cnt + \' 정보\');
			cnt++;
		});
	}

	// 팀원 추가
	function addTeam(){
		if($(\'[name=form1] [name="team_contest_team_id[]"]\').length >= team_limit){
			alert(team_limit_msg);
			return;
		}	
		
		var html = $(\'#preset\').html();

		$(\'#team_info\').append(html);

		if ($(\'[name=form1] [name="team_contest_team_id[]"]\').length == 1 ){ 
			$(\'[name=form1] [name="team_add_btn[]"]\').hide();
		} else {
			$(\'[name=form1] [name="team_add_btn[1]"]\').hide();
		}		
		showTeamNum();
	}
			
	// 팀원 삭제
	function deleteTeamMember(o){

		var table = $(o).closest(\'#team_cnt\');

		if(confirm(\'정말 삭제하시겠습니까?\')){
			if($(\'[name=form1] [name="team_contest_team_id[]"]\').length == 1 ){
				$(\'#team_info\').html(\'\');
				$(\'[name=team_ui]\').hide();

			} else if ($(\'[name=form1] [name="team_contest_team_id[]"]\').length == 2 ){
				$(\'[name=form1]\').append(\'<input type="hidden" name="del_contest_team_id[]" value="\' + table.find(\'[name="team_contest_team_id[]"]\').val() + \'">\');
				table.remove();
				$(\'[name=team_add_btn]\').hide();
				showTeamNum();

			} else {
				$(\'[name=form1]\').append(\'<input type="hidden" name="del_contest_team_id[]" value="\' + table.find(\'[name="team_contest_team_id[]"]\').val() + \'">\');
				table.remove();
				showTeamNum();
			}		
		}
	}
				
	// 팀 입력폼 컨트롤
	function chkTeamType(){
	//	alert(\'test\');
		var team = $(\'[name=team]:checked\').val() || $(\'[name=team]\').val();
		if(typeof team == \'undefined\') {
			return;
		}

		if(team == \'P\'){
			if($(\'[name=form1] [name="team_contest_team_id[]"]\').length > 0){
				if(!confirm(\'개인으로 변경시 입력한 팀원정보가 삭제됩니다.\\n\\n계속 하시겠습니까?\')){
					$(\'[name=team][value=T]\').prop(\'checked\', true);
					return false;
				}
			}
			$(\'#team_info\').html(\'\');
			$(\'[name=team_ui]\').hide();

		} else if(team == \'T\'){
			$(\'[name=team_ui]\').show();
			$(\'[name=team_add_btn]\').hide();

			addTeam()		
		}
	}

    // 글자수 체크
    function chkCharLen(el,type){
        //alert(type);
        if(type == "title") {
            $(el).parent().find(\'span1\').html(\'(\' + el.value.length + \'자 입력)\');
            if(el.value.length>500) {
                alert(\'500글자 이하로 입력하여 주세요.\');
                el.value = el.value.substring(0,500);  
                $(el).parent().find(\'span1\').html(\'(\' + el.value.length + \'자 입력)\');
                return;
            }
        } else if(type == "contents") {
            $(el).parent().find(\'span2\').html(\'(\' + el.value.length + \'자 입력)\');
            if(el.value.length>500) {
                alert(\'500글자 이하로 입력하여 주세요.\');
                el.value = el.value.substring(0,500);
                $(el).parent().find(\'span2\').html(\'(\' + el.value.length + \'자 입력)\');
                return;
            }
        }
    }

	// 팀원 수 제한
	var team_limit = 3;
	var team_limit_msg = \'팀 접수는 대표자를 포함한 최대 4인까지 가능합니다.\';

</script>


<!-- 프리셋 시작 class dn 감춤-->
<div id="preset" class="dn">
<div class="container">
	<div id="team_cnt">		
		<h5 class="txt-777 txt-700">팀원 1 정보</h5>
		<ul class="full-list">
			<li class="txt-0">
				<h6 class="title">성명</h6>
				<div class="container pd-v-2 txt-0">
					<input type="hidden" name="team_contest_team_id[]" value="">
					<input type="text" name="team_uname[]" value="" chk="필수|`팀원 성명`" maxlength="20" class="wd300" />
					<button type="button" name="team_add_btn[]" class="btn delete" onclick="deleteTeamMember(this)">
						<div class="bg"></div>
						<span class="caption">팀원 삭제</span>
					</button>
				</div>
			</li>
			<li class="txt-0">
				<h6 class="title">생년월일</h6>
				<div class="container pd-v-2 txt-0">
					<input type="text" class="wd300" name="team_birth[]" value="" chk="필수|`팀원 생년월일`" placeholder="※ 입력란을 클릭하시면 달력이 나옵니다." onclick="calMan.show(this)" dateformat="Y-m-d"  readonly /> 
				</div>
			</li>
			<li class="txt-0">
				<h6 class="title">주소</h6>
				<div class="container pd-v-2 txt-0">
					<input type="text" name="team_zip[]" value="" maxlength="5" class="text1 wd100" readonly chk="필수|`우편번호`" /> 
					<button type="button" class="btn zip mg-l-10" style="width:120px;" onclick="openZipSearch(this)">
						<div class="bg"></div>
						<span class="caption">우편번호검색</span>
					</button>
				</div>
				<div class="container pd-v-2 txt-0">
					<input type="text" name="team_addr1[]" value="" maxlength="100" class="w500" placeholder="기본주소" readonly chk="필수|`기본 주소`" />
				</div>
				<div class="container pd-v-2 txt-0">
					<input type="text" name="team_addr2[]" value="" maxlength="100" class="w500" placeholder="상세주소입력" chk="필수|`상세 주소`" />
				</div>
			</li>
			<li class="txt-0">
				<h6 class="title">연락처</h6>
				<div class="container pd-v-2 txt-0">
					<label class="select-item" style="width:100px;">
						<select name="team_tel1[]" class="wd100" chk="필수|`연락처`">
							<option value="">선택</option>
									<option value="02">02</option>
		<option value="031">031</option>
		<option value="032">032</option>
		<option value="033">033</option>
		<option value="041">041</option>
		<option value="042">042</option>
		<option value="043">043</option>
		<option value="044">044</option>
		<option value="051">051</option>
		<option value="052">052</option>
		<option value="053">053</option>
		<option value="054">054</option>
		<option value="055">055</option>
		<option value="061">061</option>
		<option value="062">062</option>
		<option value="063">063</option>
		<option value="064">064</option>
		<option value="070">070</option>
		<option value="070">0505</option>
								</select>
					</label>
					<input type="text" maxlength="4" name="team_tel2[]" value="" class="mg-l-10 wd80" chk="필수,숫자|`팀원 연락처`"> -
					<input type="text" maxlength="4" name="team_tel3[]" value="" class="mg-l-10 wd80" chk="필수,숫자|`팀원 연락처`">
				</div>
			</li>
			<li class="txt-0">
				<h6 class="title">휴대폰</h6>
				<div class="container pd-v-2 txt-0">
					<label class="select-item" style="width:100px;">
						<select name="team_mobile1[]" class="wd100" chk="필수|`휴대폰`">
							<option value="">선택</option>
									<option value="010">010</option>
		<option value="011">011</option>
		<option value="016">016</option>
		<option value="017">017</option>
		<option value="018">018</option>
		<option value="019">019</option>
								</select>
					</label>
					<input type="text" maxlength="4" name="team_mobile2[]" value="" class="mg-l-10 wd80" chk="필수,숫자|`팀원 휴대폰`"> -
					<input type="text" maxlength="4" name="team_mobile3[]" value="" class="mg-l-10 wd80" chk="필수,숫자|`팀원 휴대폰`">
				</div>
			</li>
			<li class="">
				<h6 class="title">이메일</h6>
				<div class="container pd-v-2">
					<input type="text" class="mg-l-0 wd150" name="team_email1[]" value="" maxlength="50" chk="필수|`이메일`">
					<div class="txt-12 pd-h-10 v-middle dp-inblock">@</div>
						<input type="text" class="wd150" name="team_email2[]" value=""maxlength="50"  chk="필수|`이메일`">
						<label class="select-item" style="width:150px; overflow:inherit !important;"  onchange="$(this).prev().val($(this).children(\'.select-item2\').val()).focus();">
							<select class="select-item2 wd150 mg-l-10">
								<option value="">선택</option>
										<option value="naver.com">naver.com</option>
		<option value="daum.com">daum.net</option>
		<option value="gmail.com">gmail.com</option>
		<option value="nate.com">nate.com</option>
		<option value="hanmail.net">hanmail.net</option>
		<option value="empas.com">empas.com</option>
		<option value="hotmail.com">hotmail.com</option>
		<option value="yahoo.co.kr">yahoo.co.kr</option>
		<option value="korea.kr">korea.kr</option>
		<option value="">직접입력</option>
									</select>
					</label>
				</div>
			</li> 
			<li class="txt-0">
				<h6 class="title">소속</h6>
				<div class="container pd-v-2 txt-0">
					<input type="text" class="dp-inblock respon-free-100" style="width:300px;" maxlength="50" name="team_sosok1[]" value="" chk="필수|`소속`">	
				</div>
				<span class="txt-12 txt-red v-middle">※ 소속 없을 시 \'없음\'으로 표기</span>
			</li>

		</ul>
	</div>
</div>
</div>
<!-- 프리셋 종료 -->

<div class="over-hidden narrow">

    <div class="container register-proccess">
        <ul>
            <li class="done">
                <div class="container">
                    <h5 class="txt-600">Step1</h5>
                    <h4 class="txt-nanum txt-700">이용동의</h4>
                </div>
            </li>
            <li class="on">
                <div class="container">
                    <h5 class="txt-600">Step2</h5>
                    <h4 class="txt-nanum txt-700">정보입력</h4>
                </div>
            </li>
            <li class="">
                <div class="container">
                    <h5 class="txt-600">Step3</h5>
                    <h4 class="txt-nanum txt-700">접수완료</h4>
                </div>
            </li>
        </ul>
    </div>

	<form name="form1" method="post" action="" enctype="multipart/form-data" class="container register-form-input">
	<!-- <input type="hidden" name="fileset_cnt" id="fileset_cnt" value="1"> -->

	<div class="container">
		<h2 class="pd-v-5"><span class="txt-18 txt-700 txt-aaa">Step2</span><br><span class="txt-nanum txt-900">접수정보입력</span></h2>
		<h6 class="txt-nanum txt-14 txt-500">모든 접수정보를 정확하게 기입해 주세요.</h6>
	</div>

	<input type="hidden" name="enc" value="71427fb8f26ae9c2e5de18d460673c1ff561cf84df17c7405ce2ea6aa4756b6ff01b6d16a6e5fec5cf"><input type="hidden" name="mode" value="I">
	<div id="reg_info" class="card mg-t-20">
		<div class="container">
			<h3 class="txt-nanum txt-700 txt-18">접수정보</h3>
			<ul class="full-list  pd-t-10">			
				<li class="txt-0">
					<h6 class="title">연령</h6>
					<div class="container pd-v-2 txt-0">
					
		<label class="radio-item">
			<input type="radio" name="cate1" value="A" chk="필수|연령을 선택해 주세요.">
			<div class="ripple dark" style="width: 209.124px; height: 209.124px; opacity: 0; left: 25px; top: 24px; transform: translateX(-50%) translateY(-50%) scaleX(1) scaleY(1);"></div>
			<div class="labelling">
					<div class="icons">
						<i class="material-icons">radio_button_unchecked</i>
						<i class="material-icons">check_circle</i>
					</div> -->
				<span class="caption">10대</span>
			</div>
		</label>
		<label class="radio-item">
			<input type="radio" name="cate1" value="B" chk="필수|연령을 선택해 주세요.">
			<div class="ripple dark" style="width: 209.124px; height: 209.124px; opacity: 0; left: 25px; top: 24px; transform: translateX(-50%) translateY(-50%) scaleX(1) scaleY(1);"></div>
			<div class="labelling">
					<div class="icons">
						<i class="material-icons">radio_button_unchecked</i>
						<i class="material-icons">check_circle</i>
					</div> -->
				<span class="caption">20대</span>
			</div>
		</label>
		<label class="radio-item">
			<input type="radio" name="cate1" value="C" chk="필수|연령을 선택해 주세요.">
			<div class="ripple dark" style="width: 209.124px; height: 209.124px; opacity: 0; left: 25px; top: 24px; transform: translateX(-50%) translateY(-50%) scaleX(1) scaleY(1);"></div>
			<div class="labelling">
					<div class="icons">
						<i class="material-icons">radio_button_unchecked</i>
						<i class="material-icons">check_circle</i>
					</div> -->
				<span class="caption">30대</span>
			</div>
		</label>
		<label class="radio-item">
			<input type="radio" name="cate1" value="D" chk="필수|연령을 선택해 주세요.">
			<div class="ripple dark" style="width: 209.124px; height: 209.124px; opacity: 0; left: 25px; top: 24px; transform: translateX(-50%) translateY(-50%) scaleX(1) scaleY(1);"></div>
			<div class="labelling">
					<div class="icons">
						<i class="material-icons">radio_button_unchecked</i>
						<i class="material-icons">check_circle</i>
					</div> -->
				<span class="caption">40대 이상</span>
			</div>
		</label>					</div>
				</li>
				<li class="txt-0">
					<h6 class="title">응모 구분</h6>
					<div class="container pd-v-2 txt-0">
					
		<label class="radio-item">
			<input type="radio" name="team" value="P" checked chk="필수|응모구분">
			<div class="ripple dark" style="width: 209.124px; height: 209.124px; opacity: 0; left: 25px; top: 24px; transform: translateX(-50%) translateY(-50%) scaleX(1) scaleY(1);"></div>
			<div class="labelling">
					<div class="icons">
						<i class="material-icons">radio_button_unchecked</i>
						<i class="material-icons">check_circle</i>
					</div> -->
				<span class="caption">개인</span>
			</div>
		</label>
		<label class="radio-item">
			<input type="radio" name="team" value="T" chk="필수|응모구분">
			<div class="ripple dark" style="width: 209.124px; height: 209.124px; opacity: 0; left: 25px; top: 24px; transform: translateX(-50%) translateY(-50%) scaleX(1) scaleY(1);"></div>
			<div class="labelling">
					<div class="icons">
						<i class="material-icons">radio_button_unchecked</i>
						<i class="material-icons">check_circle</i>
					</div> -->
				<span class="caption">팀</span>
			</div>
		</label>						<span class="txt-12 txt-red v-middle">※ 팀 접수는 대표자를 포함한 최대 3인까지 가능합니다. </span>						
					</div>
				</li>
			</ul>
		</div>
	</div>

    <div id="reg_info" class="card over-hidden mg-t-20">
        <div class="container">
            <h3 class="txt-nanum txt-700 txt-18">접수 대표자</h3>
            <ul class="full-list  pd-t-10">
                <li class="txt-0">
                    <h6 class="title">접수자명</h6>
                    <div class="container pd-v-2 txt-0">
                    <input type="text" name="uname" value="" class="dp-inblock respon-free-100" style="width:280px;" chk="필수|접수자명을 입력하세요." maxlength="20">
                    </div>
                </li>
                <li class="txt-0">
                    <h6 class="title">비밀번호</h6>
                    <div class="container pd-v-2 txt-0">
                        <input type="password" maxlength="30" class="dp-inblock respon-free-100 mg-r-10" style="width:280px;" name="pwd" placeholder="※ 영문+숫자 조합 6자 이상 작성해 주세요" chk="필수|암호를 입력하세요.\\n\\n(영문 숫자 조합 6자 이상)" func="isStrongPassword(this.value)">
                        <span class="txt-12 txt-red v-middle"></span>
                    </div>				
                </li>
                <li class="txt-0">
                    <h6 class="title">비밀번호 확인</h6>
                    <div class="container pd-v-2 txt-0">
                        <input type="password" maxlength="30" class="dp-inblock respon-free-100 mg-r-10" style="width:280px;" name="pwd2"  placeholder="※ 암호 확인을 위해 한 번 더 작성해주세요" chk="필수|입력한 암호와 암호확인이 일치하지 않습니다." func="isSameText({{pwd}}, {{pwd2}})">
                        <span class="dp-inblock txt-12 txt-red v-middle">※ 암호는 접수 확인 시 사용됩니다. 암호를 잊으셨을 경우 사무국(02-334-7005)로 연락 부탁드립니다.</span>
                    </div>					
                </li>
                <li class="txt-0">
                    <h6 class="title">생년월일</h6>
                    <div class="container pd-v-2 txt-0">
                        <input type="text" name="birth" value="" class="dp-inblock respon-free-100" style="width:280px;" chk="필수|`생년월일`" onclick="calMan.show(this)" dateformat="Y-m-d" placeholder="※ 입력란을 클릭하시면 달력이 나옵니다." readonly /> ※ 입력란을 클릭하시면 달력이 나옵니다.
                    </div>
                </li>
                <li class="txt-0">
                    <h6 class="title">주소</h6>
                    <div class="container pd-v-2 txt-0">
                        <input type="text" name="zip" value="" maxlength="5" class="text1 wd100" readonly chk="필수|`우편번호`" /> 
                        <button type="button" class="btn zip mg-l-10" style="width:120px;" onclick="openZipSearch(this)">
                            <div class="bg"></div>
                            <div class="ripple"></div>
                            <span class="caption">우편번호검색</span>
                        </button>
                    </div>
                    <div class="container pd-v-2 txt-0">
                        <input type="text" name="addr1" value="" maxlength="100" class="w500" placeholder="기본주소" readonly chk="필수|`기본 주소`" />
                    </div>
                    <div class="container pd-v-2 txt-0">
                        <input type="text" name="addr2" value="" maxlength="100" class="w500" placeholder="상세주소입력" chk="필수|`상세 주소`" />
                    </div>
                </li>
                <li class="txt-0">
                    <h6 class="title">연락처</h6>
                    <div class="container pd-v-2 txt-0">
                        <label class="select-item" style="width:100px;">
                            <select name="tel1" class="wd100" chk="필수|`연락처`">
                                <option value="">선택</option>
                                		<option value="02">02</option>
		<option value="031">031</option>
		<option value="032">032</option>
		<option value="033">033</option>
		<option value="041">041</option>
		<option value="042">042</option>
		<option value="043">043</option>
		<option value="044">044</option>
		<option value="051">051</option>
		<option value="052">052</option>
		<option value="053">053</option>
		<option value="054">054</option>
		<option value="055">055</option>
		<option value="061">061</option>
		<option value="062">062</option>
		<option value="063">063</option>
		<option value="064">064</option>
		<option value="070">070</option>
		<option value="070">0505</option>
		                            </select>
                        </label>
                        <input type="text" maxlength="4" name="tel2" value="" class="mg-l-10 wd80" chk="필수,숫자|`연락처`">
                        <input type="text" maxlength="4" name="tel3" value="" class="mg-l-10 wd80" chk="필수,숫자|`연락처`">
                    </div>
                </li>
                <li class="txt-0">
                    <h6 class="title">휴대폰</h6>
                    <div class="container pd-v-2 txt-0">
                        <label class="select-item" style="width:100px;">
                            <select name="mobile1" class="wd100" chk="필수|`휴대폰`">
                                <option value="">선택</option>
                                		<option value="010">010</option>
		<option value="011">011</option>
		<option value="016">016</option>
		<option value="017">017</option>
		<option value="018">018</option>
		<option value="019">019</option>
		                            </select>
                        </label>
                        <input type="text" maxlength="4" name="mobile2" value="" class="mg-l-10 wd80" chk="필수,숫자|`휴대폰`">
                        <input type="text" maxlength="4" name="mobile3" value="" class="mg-l-10 wd80" chk="필수,숫자|`휴대폰`">
                    </div>
                </li>
                <li class="txt-0">
                    <h6 class="title">이메일</h6>
                    <div class="container pd-v-2 txt-0">
                        <input type="text" class="mg-l-0 wd150" maxlength="50" name="email1" value="" chk="필수|`이메일`">
                        <div class="txt-12 pd-h-10 v-middle dp-inblock">@</div>								
                        <input type="text" class="wd150" maxlength="50" name="email2" value="" id="str_email02" chk="필수|`이메일`" > 
                        <label class="select-item" style="width:150px; overflow:inherit !important;" onchange="$(this).prev().val($(this).children(\'.select-item2\').val()).focus();">
                            <select class="select-item2 wd150 mg-l-10">
                                <option value="">선택</option>
                                		<option value="naver.com">naver.com</option>
		<option value="daum.com">daum.net</option>
		<option value="gmail.com">gmail.com</option>
		<option value="nate.com">nate.com</option>
		<option value="hanmail.net">hanmail.net</option>
		<option value="empas.com">empas.com</option>
		<option value="hotmail.com">hotmail.com</option>
		<option value="yahoo.co.kr">yahoo.co.kr</option>
		<option value="korea.kr">korea.kr</option>
		<option value="">직접입력</option>
		                            </select>
                        </label>
                    </div>
                </li>
                <li class="txt-0" id="sosok_ui" >
                    <h6 class="title">소속</h6>
                    <div class="container pd-v-2 txt-0">
                        <input type="text" id="sosok1" name="sosok1" class="dp-inblock respon-free-100" style="width:280px;" maxlength="50" name="sosok1" value="" chk="필수|`소속`">
                    </div>
                </li>			
            </ul>	
        </div>
    </div>
	<div id="team_box" class="card over-hidden mg-t-20" name="team_ui">	
		<div class="container">
			<h3 class="txt-nanum txt-700 txt-18">팀 정보</h3>
			<ul class="full-list">
				<li class="txt-0">
					<h6 class="title">팀명</h6>
					<div class="container pd-v-2 txt-0">
						<input type="text" name="team_name" value="" chk="|`팀명`" if="{{team}}==\'T\'" maxlength="50" class="text1 w300" />
					</div>
				</li>	
				<li class="txt-0">
					<div class="container pd-v-2 txt-0">
						<span class="txt-12 txt-red v-middle" name="team_ui">※ 팀 접수는 대표자를 포함한 최대 3인까지 가능합니다.</span>
					</div>
				</li>			
			</ul>
		</div>
		<div id="team_info">
					</div>	
		<div name="team_ui" class="team_ui pd-b-20">
			<button type="button" class="btn type2 mg-l-10 wd200" onclick="addTeam()">
				<div class="bg"></div>
					<div class="ripple"></div>
				<span class="caption">팀원추가</span>
			</button>
		</div>
	</div>

    <div id="content_file_box" name="content_file_box" class="card over-hidden mg-t-20">
        <div class="container">
            <h3 class="txt-nanum txt-700 txt-18">접수작 정보</h3>
            <ul class="full-list">
                <li>
                    <h6 class="title">작품 제목</h6>
                    <div class="container pd-v-2 txt-0">
                    <input type="text" id="title" name="title" onkeyup="chkCharLen(this,\'title\')" onfocus="chkCharLen(this,\'title\')" chk="필수|`작품 제목`" class="text1" />
                        <div class="container2 pd-v-2 txt-0">
                            <span class="txt-12 txt-111 v-middle">
                            <!-- ※  50자 이내로 입력(공백포함)  -->
                            <span1 class="silver"></span1>
							</span>
                        </div>
                    </div>
                </li>
                <li> 
                    <h6 class="title">작품 설명<br>(500자 이내)</h6>
                    <div class="container pd-v-2 txt-0">
                        <textarea id="contents" name="contents" rows="10" chk="필수|`작품 설명`" onkeyup="chkCharLen(this,\'contents\')" onfocus="chkCharLen(this,\'contents\')" class="text1 hauto"></textarea>
                        <div class="container2 pd-v-2 txt-0">
                            <span class="txt-12 txt-111 v-middle">
                                ※ 500자 이내로 입력(공백포함) 
                            <span2 class="silver"></span2> 
                            </span>
                        </div>
                    </div>
				</li>
				<li>
                    <h6 class="title">유투브 URL</h6>
                    <div class="container pd-v-2 txt-0">
                    <input type="text" id="title" id="youtube_url" name="youtube_url" chk="필수|`유투브 URL`" class="text1" />
                        <div class="container2 pd-v-2 txt-0">
                            <span class="txt-12 txt-111 v-middle">
                            <!-- ※  50자 이내로 입력(공백포함)  -->
							</span>
                        </div>
                    </div>
                </li>
				<li>
                    <h6 class="title">썸네일 업로드</h6>
                    <div name="upload1" class="container pd-v-2 txt-0 file_input">
                        <input type="file" class="" name="files1" id="files1" chk="필수|`썸네일`" contentEditable="false">
                    </div>
					<div class="container pd-v-10 txt-0" id="logo_file_ui">
                        <span class="txt-12 v-middle txt-lh-20 ">
                            &nbsp;&nbsp;&nbsp;- JPG, JPEG, PNG 파일
                        </span>
                    </div>
                </li>
                <li>
                    <h6 class="title">작품 업로드</h6>
                    <div name="upload1" class="container pd-v-2 txt-0 file_input">
                        <input type="file" class="" name="files2" id="files2" chk="필수|`작품`" contentEditable="false">
                    </div>
                    <div class="container pd-v-10 txt-0" id="logo_file_ui">
                        <span class="txt-12 v-middle txt-lh-20 ">
							<span class="txt-orange pd-t-5">※ 파일명: [평화정책 UCC 공모전] 이름(팀명)_영상제목 작성 </span><br>
							<span class="txt-orange pd-t-5">※ 파일 형식: 분량 제한 없음, 해상도 FULL HD(1920*1080), 2~3분 내외 </span><br>
							<span class="txt-orange pd-t-5">※ 참가신청서, 서약서 제출 필수 </span>                      
                        </span>
                    </div>
                </li>
				<li>
                    <h6 class="title">참가신청서 업로드</h6>
                    <div name="upload1" class="container pd-v-2 txt-0 file_input">
                        <input type="file" class="" name="files3" id="files3" chk="필수|`참가신청서`" contentEditable="false">
                    </div>
                    <div class="container pd-v-10 txt-0" id="logo_file_ui">
                        <span class="txt-12 v-middle txt-lh-20 ">
							<span class="txt-orange pd-t-5">※ 참가신청서, 서약서를 필히 업로드 부탁드립니다. </span><br>
							<span class="txt-orange pd-t-5">※ 업로드 누락 시 발생되는 문제는 참가자 본인에게 있습니다. </span>
                        </span>
                    </div>
                </li>
            </ul>
        </div>
    </div>

	<div id="reg_btn_box2" class="container pd-v-1u txt-center txt-0">
        <a href="javascript:goSubmit();" class="btn bg-444 mg-h-5">
            <div class="bg"></div>
            <div class="ripple"></div>
            <i class="material-icons txt-filament">create</i>
            <span class="caption txt-fff">접수하기</span>
        </a>
    </div>

    <!-- 접수폼 입력 -->
    <div style="padding-top:20px; text-align:right">
        	</div>
	</form>
</div>

<script>
	
    // 썸네일 첨부파일 확장자, 용량 체크
    $(\'input[id=files1]\').change(function(){

        if($(this).val() != ""){
            // 확장자 체크
            var ext = $(this).val().split(".").pop().toLowerCase();
            if($.inArray(ext, ["jpg","jpeg","png"]) == -1){
                alert("jpg, jpeg, png 파일만 업로드 해주세요.");
				// input[type=file] 초기화
                if (/(MSIE|Trident)/.test(navigator.userAgent)) {   // ie 일때 input[type=file] init.                     
                    $(this).replaceWith( $(this).clone(true) ); 
                } else {                                            // other browser 일때 input[type=file] init. 
                    $(this).val(""); 
                }
                return;
            }

			// 용량체크
			for (var i = 0; i<this.files.length; i++){
				var fileSize = this.files[i].size;
				var fSMB = (fileSize / (1024 * 1024)).toFixed(2);
				var maxSize = 1024 * 1024 * 5; // 첨부파일제한 5MB
				var mSMB = (maxSize / (1024 * 1024));
				if(fileSize > maxSize){
					alert(this.files[i].name + "(이)가 용량 5MB를 초과했습니다\\n\\n" + fSMB + "MB / " + mSMB + "MB");
					// input[type=file] 초기화
					if (/(MSIE|Trident)/.test(navigator.userAgent)) {   // ie 일때                      
						$(this).replaceWith( $(this).clone(true) ); 
					} else {                                            // other browser 일때 
						$(this).val(""); 
					}
				}
			}
		}
	});

	// 작품 확장자 용령 체크
	$(\'input[id=files2]\').change(function(){

		if($(this).val() != ""){
			// 확장자 체크
			var ext = $(this).val().split(".").pop().toLowerCase();
			if($.inArray(ext, ["mp4"]) == -1){
				alert("mp4 파일만 업로드 해주세요.");
				// input[type=file] 초기화
				if (/(MSIE|Trident)/.test(navigator.userAgent)) {   // ie 일때 input[type=file] init.                     
					$(this).replaceWith( $(this).clone(true) ); 
				} else {                                            // other browser 일때 input[type=file] init. 
					$(this).val(""); 
				}
				return;
			}

			// 용량체크
			for (var i = 0; i<this.files.length; i++){
				var fileSize = this.files[i].size;
				var fSMB = (fileSize / (1024 * 1024)).toFixed(2);
				var maxSize = 1024 * 1024 * 500; // 첨부파일제한 500MB
				var mSMB = (maxSize / (1024 * 1024));
				if(fileSize > maxSize){
					alert(this.files[i].name + "(이)가 용량 500MB를 초과했습니다\\n\\n" + fSMB + "MB / " + mSMB + "MB");
					// input[type=file] 초기화
					if (/(MSIE|Trident)/.test(navigator.userAgent)) {   // ie 일때                      
						$(this).replaceWith( $(this).clone(true) ); 
					} else {                                            // other browser 일때 
						$(this).val(""); 
					}
				}
			}
		}
	});

	// 참가신청서 확장자 용령 체크
	$(\'input[id=files3]\').change(function(){

		if($(this).val() != ""){
			// 확장자 체크
			var ext = $(this).val().split(".").pop().toLowerCase();
			if($.inArray(ext, ["hwp","docx","doc","pdf"]) == -1){
				alert("hwp, docx, doc, pdf 파일만 업로드 해주세요.");
				// input[type=file] 초기화
				if (/(MSIE|Trident)/.test(navigator.userAgent)) {   // ie 일때 input[type=file] init.                     
					$(this).replaceWith( $(this).clone(true) ); 
				} else {                                            // other browser 일때 input[type=file] init. 
					$(this).val(""); 
				}
				return;
			}

			// 용량체크
			for (var i = 0; i<this.files.length; i++){
				var fileSize = this.files[i].size;
				var fSMB = (fileSize / (1024 * 1024)).toFixed(2);
				var maxSize = 1024 * 1024 * 30; // 첨부파일제한 5MB
				var mSMB = (maxSize / (1024 * 1024));
				if(fileSize > maxSize){
					alert(this.files[i].name + "(이)가 용량 30MB를 초과했습니다\\n\\n" + fSMB + "MB / " + mSMB + "MB");
					// input[type=file] 초기화
					if (/(MSIE|Trident)/.test(navigator.userAgent)) {   // ie 일때                      
						$(this).replaceWith( $(this).clone(true) ); 
					} else {                                            // other browser 일때 
						$(this).val(""); 
					}
				}
			}
		}
	});

	$(\'[name=team]\').bind(\'click\', chkTeamType);
		chkTeamType();
		
	$(\'[name=cate1]\').bind(\'click\', chkCate1);
		init_cate1();

    // 주기적으로 파일을 호출하여 세션풀림을 막는다
    var inter1 = setInterval(function(){
        $.post(\'/session_keep.php\', function(rst){
            // window.status = \'OK\';
        });
    }, 60000);

</script>

<!-- footer -->


			</div>
		</div>
	</main>

	
	<!-- footer -->
		<footer>
			<div class="contain">

				<div class="fm_footer_info">
					평화정책 UCC 공모전 Tel : 031-8008-3294<br>
					Copyright since 평화정책 ucc 공모전. All rights reserved.
				</div>

				<!-- <div class="fm_footer_logo">
					<a href="http://www.nipa.kr/" target="_blank"><img src="/assets/img/footer_logo2.png"></a>
				</div> -->

				<div class="fm_footer_logo">
					<a href="" target="_blank"><img src="/assets/img/logo.png"></a>
				</div>

			</div>
		</footer>

	

	</body>


</html>',
    'wr_link1' => '',
    'wr_link2' => '',
    'wr_link1_hit' => '0',
    'wr_link2_hit' => '0',
    'wr_hit' => '72',
    'wr_good' => '0',
    'wr_nogood' => '0',
    'mb_id' => 'admin',
    'wr_password' => '*EC8A94DBC67C1054C3B247BDDA6550AC30D4B756',
    'wr_name' => '관리자',
    'wr_email' => 'lsping@naver.com',
    'wr_homepage' => '',
    'wr_datetime' => '2020-04-21 17:13:58',
    'wr_file' => '0',
    'wr_last' => '2020-04-21 17:13:58',
    'wr_ip' => '121.129.233.2',
    'wr_facebook_user' => '',
    'wr_twitter_user' => '',
    'wr_1' => '',
    'wr_2' => '',
    'wr_3' => '',
    'wr_4' => '',
    'wr_5' => '',
    'wr_6' => '',
    'wr_7' => '',
    'wr_8' => '',
    'wr_9' => '',
    'wr_10' => '',
    'is_notice' => false,
    'subject' => '씽굿-접수 참고(타사이트)',
    'comment_cnt' => '',
    'datetime' => '2020-04-21',
    'datetime2' => '04-21',
    'last' => '2020-04-21',
    'last2' => '04-21',
    'name' => '<span class="sv_member">관리자</span>',
    'reply' => 0,
    'icon_reply' => '',
    'icon_link' => '',
    'ca_name_href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;sca=ETC',
    'href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;wr_id=180',
    'comment_href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;wr_id=180',
    'icon_new' => '',
    'icon_hot' => '',
    'icon_secret' => '',
    'link' => 
    array (
      1 => NULL,
      2 => NULL,
    ),
    'link_href' => 
    array (
      1 => 'http://lsp80.cafe24.com/bbs/link.php?bo_table=bbs_tip&amp;wr_id=180&amp;no=1',
      2 => 'http://lsp80.cafe24.com/bbs/link.php?bo_table=bbs_tip&amp;wr_id=180&amp;no=2',
    ),
    'link_hit' => 
    array (
      1 => 0,
      2 => 0,
    ),
    'file' => 
    array (
      'count' => '0',
    ),
  ),
  4 => 
  array (
    'wr_id' => '179',
    'wr_num' => '-179',
    'wr_reply' => '',
    'wr_parent' => '179',
    'wr_is_comment' => '0',
    'wr_comment' => '0',
    'wr_comment_reply' => '',
    'ca_name' => 'ETC',
    'wr_option' => '',
    'wr_subject' => '씽굿-접수 참고(타사이트)',
    'wr_content' => '<script type="text/javascript">

	// 달력 설정
	if(typeof(calConfig) != \'undefined\') calConfig.max_year = parseInt(getDate(\'Y\'));

	// 팀체크 설정
	if(typeof(chk_team) == \'undefined\') var chk_team = true;

	// 중복 접수 체크
	function is_duplicate(uname, mobile) {
		// alert(uname+\'d\'+mobile);
		$.ajax({ 
			type: "POST", 
			url: "./check_duplicate.php", 
			data:{ "uname" : uname, "mobile" : mobile },
			async:false,
			success: function (response) { 
				// alert(response);
				m = response;
			},
			error: function (e) { 
				alert("서버 에러입니다."); 
			} 
		});
		return m;
	}

	var is_submit = false;

	//접수 시작
	function goSubmit(){
		if(is_submit){
			alert(\'처리중입니다. 잠시만 기다려주세요.\');
			return;
		}

		var uname  = $(\'[name=uname]\').val();
		var mobile = $(\'[name=mobile1]\').val()+"-"+$(\'[name=mobile2]\').val()+"-"+$(\'[name=mobile3]\').val();
		// var cate1  = $(\'[name=cate1]:checked\').val();

		//중복체크 
		var result_dupli_cnt = is_duplicate(uname, mobile); 
		// alert(\'result=\'+result_dupli_cnt);
		if(result_dupli_cnt > 2){
			alert(\'작품 접수는 최대 3개까지만 가능합니다. 더 이상 접수하실 수 없습니다.\');
			return;
		}

		var frm = document.form1;

		if(AF(frm)){
			
			var team = $(\'[name=form1] [name=team]:checked\').val() || $(\'[name=form1] [name=team]\').val();

			if(team == \'T\' && chk_team){
				if($(\'[name=form1] [name="team_contest_team_id[]"]\').length == 0){
					alert(\'팀원 정보를 입력해 주세요.\');
					return;
				}
			}

			is_submit = true;
			document.form1.action = \'proc.php\';
			document.form1.submit();
			//alert(\'섭밋ok\');
			return;
		}
	}

	//패스워드 체크
	function isStrongPassword(str){
		if(str.length < 6) return false;
		else if(str.match(/^[0-9]+$/g)) return false;
		else if(str.match(/^[a-z]+$/gi)) return false;
		else return true;
	}

	function isSameText(text1, text2){
		if(text1 == text2) return true;
		else return false;
	}

	function openZipSearch(el){
		new daum.Postcode({
			oncomplete: function(data) {
				var tar = $(el).closest(\'li\');
				$(\'[name*=zip]\', tar).val(data.zonecode); // 우편번호 (5자리)
				$(\'[name*=addr1]\', tar).val(data.address);
				$(\'[name*=addr2]\', tar).val(data.buildingName);
			}
		}).open();
	}

	// 팀원에 숫자 표시(넘버링)
	function showTeamNum(){
		var tar = $(\'[name=form1] [name="team_contest_team_id[]"]\').closest(\'#team_cnt\').find(\'h5:eq(0)\');
		var cnt	= 1;
		tar.each(function(){
		//	alert(cnt);
			$(this).html(\'팀원\' + cnt + \' 정보\');
			cnt++;
		});
	}

	// 팀원 추가
	function addTeam(){
		if($(\'[name=form1] [name="team_contest_team_id[]"]\').length >= team_limit){
			alert(team_limit_msg);
			return;
		}	
		
		var html = $(\'#preset\').html();

		$(\'#team_info\').append(html);

		if ($(\'[name=form1] [name="team_contest_team_id[]"]\').length == 1 ){ 
			$(\'[name=form1] [name="team_add_btn[]"]\').hide();
		} else {
			$(\'[name=form1] [name="team_add_btn[1]"]\').hide();
		}		
		showTeamNum();
	}
			
	// 팀원 삭제
	function deleteTeamMember(o){

		var table = $(o).closest(\'#team_cnt\');

		if(confirm(\'정말 삭제하시겠습니까?\')){
			if($(\'[name=form1] [name="team_contest_team_id[]"]\').length == 1 ){
				$(\'#team_info\').html(\'\');
				$(\'[name=team_ui]\').hide();

			} else if ($(\'[name=form1] [name="team_contest_team_id[]"]\').length == 2 ){
				$(\'[name=form1]\').append(\'<input type="hidden" name="del_contest_team_id[]" value="\' + table.find(\'[name="team_contest_team_id[]"]\').val() + \'">\');
				table.remove();
				$(\'[name=team_add_btn]\').hide();
				showTeamNum();

			} else {
				$(\'[name=form1]\').append(\'<input type="hidden" name="del_contest_team_id[]" value="\' + table.find(\'[name="team_contest_team_id[]"]\').val() + \'">\');
				table.remove();
				showTeamNum();
			}		
		}
	}
				
	// 팀 입력폼 컨트롤
	function chkTeamType(){
	//	alert(\'test\');
		var team = $(\'[name=team]:checked\').val() || $(\'[name=team]\').val();
		if(typeof team == \'undefined\') {
			return;
		}

		if(team == \'P\'){
			if($(\'[name=form1] [name="team_contest_team_id[]"]\').length > 0){
				if(!confirm(\'개인으로 변경시 입력한 팀원정보가 삭제됩니다.\\n\\n계속 하시겠습니까?\')){
					$(\'[name=team][value=T]\').prop(\'checked\', true);
					return false;
				}
			}
			$(\'#team_info\').html(\'\');
			$(\'[name=team_ui]\').hide();

		} else if(team == \'T\'){
			$(\'[name=team_ui]\').show();
			$(\'[name=team_add_btn]\').hide();

			addTeam()		
		}
	}

    // 글자수 체크
    function chkCharLen(el,type){
        //alert(type);
        if(type == "title") {
            $(el).parent().find(\'span1\').html(\'(\' + el.value.length + \'자 입력)\');
            if(el.value.length>500) {
                alert(\'500글자 이하로 입력하여 주세요.\');
                el.value = el.value.substring(0,500);  
                $(el).parent().find(\'span1\').html(\'(\' + el.value.length + \'자 입력)\');
                return;
            }
        } else if(type == "contents") {
            $(el).parent().find(\'span2\').html(\'(\' + el.value.length + \'자 입력)\');
            if(el.value.length>500) {
                alert(\'500글자 이하로 입력하여 주세요.\');
                el.value = el.value.substring(0,500);
                $(el).parent().find(\'span2\').html(\'(\' + el.value.length + \'자 입력)\');
                return;
            }
        }
    }

	// 팀원 수 제한
	var team_limit = 3;
	var team_limit_msg = \'팀 접수는 대표자를 포함한 최대 4인까지 가능합니다.\';

</script>


<!-- 프리셋 시작 class dn 감춤-->
<div id="preset" class="dn">
<div class="container">
	<div id="team_cnt">		
		<h5 class="txt-777 txt-700">팀원 1 정보</h5>
		<ul class="full-list">
			<li class="txt-0">
				<h6 class="title">성명</h6>
				<div class="container pd-v-2 txt-0">
					<input type="hidden" name="team_contest_team_id[]" value="">
					<input type="text" name="team_uname[]" value="" chk="필수|`팀원 성명`" maxlength="20" class="wd300" />
					<button type="button" name="team_add_btn[]" class="btn delete" onclick="deleteTeamMember(this)">
						<div class="bg"></div>
						<span class="caption">팀원 삭제</span>
					</button>
				</div>
			</li>
			<li class="txt-0">
				<h6 class="title">생년월일</h6>
				<div class="container pd-v-2 txt-0">
					<input type="text" class="wd300" name="team_birth[]" value="" chk="필수|`팀원 생년월일`" placeholder="※ 입력란을 클릭하시면 달력이 나옵니다." onclick="calMan.show(this)" dateformat="Y-m-d"  readonly /> 
				</div>
			</li>
			<li class="txt-0">
				<h6 class="title">주소</h6>
				<div class="container pd-v-2 txt-0">
					<input type="text" name="team_zip[]" value="" maxlength="5" class="text1 wd100" readonly chk="필수|`우편번호`" /> 
					<button type="button" class="btn zip mg-l-10" style="width:120px;" onclick="openZipSearch(this)">
						<div class="bg"></div>
						<span class="caption">우편번호검색</span>
					</button>
				</div>
				<div class="container pd-v-2 txt-0">
					<input type="text" name="team_addr1[]" value="" maxlength="100" class="w500" placeholder="기본주소" readonly chk="필수|`기본 주소`" />
				</div>
				<div class="container pd-v-2 txt-0">
					<input type="text" name="team_addr2[]" value="" maxlength="100" class="w500" placeholder="상세주소입력" chk="필수|`상세 주소`" />
				</div>
			</li>
			<li class="txt-0">
				<h6 class="title">연락처</h6>
				<div class="container pd-v-2 txt-0">
					<label class="select-item" style="width:100px;">
						<select name="team_tel1[]" class="wd100" chk="필수|`연락처`">
							<option value="">선택</option>
									<option value="02">02</option>
		<option value="031">031</option>
		<option value="032">032</option>
		<option value="033">033</option>
		<option value="041">041</option>
		<option value="042">042</option>
		<option value="043">043</option>
		<option value="044">044</option>
		<option value="051">051</option>
		<option value="052">052</option>
		<option value="053">053</option>
		<option value="054">054</option>
		<option value="055">055</option>
		<option value="061">061</option>
		<option value="062">062</option>
		<option value="063">063</option>
		<option value="064">064</option>
		<option value="070">070</option>
		<option value="070">0505</option>
								</select>
					</label>
					<input type="text" maxlength="4" name="team_tel2[]" value="" class="mg-l-10 wd80" chk="필수,숫자|`팀원 연락처`"> -
					<input type="text" maxlength="4" name="team_tel3[]" value="" class="mg-l-10 wd80" chk="필수,숫자|`팀원 연락처`">
				</div>
			</li>
			<li class="txt-0">
				<h6 class="title">휴대폰</h6>
				<div class="container pd-v-2 txt-0">
					<label class="select-item" style="width:100px;">
						<select name="team_mobile1[]" class="wd100" chk="필수|`휴대폰`">
							<option value="">선택</option>
									<option value="010">010</option>
		<option value="011">011</option>
		<option value="016">016</option>
		<option value="017">017</option>
		<option value="018">018</option>
		<option value="019">019</option>
								</select>
					</label>
					<input type="text" maxlength="4" name="team_mobile2[]" value="" class="mg-l-10 wd80" chk="필수,숫자|`팀원 휴대폰`"> -
					<input type="text" maxlength="4" name="team_mobile3[]" value="" class="mg-l-10 wd80" chk="필수,숫자|`팀원 휴대폰`">
				</div>
			</li>
			<li class="">
				<h6 class="title">이메일</h6>
				<div class="container pd-v-2">
					<input type="text" class="mg-l-0 wd150" name="team_email1[]" value="" maxlength="50" chk="필수|`이메일`">
					<div class="txt-12 pd-h-10 v-middle dp-inblock">@</div>
						<input type="text" class="wd150" name="team_email2[]" value=""maxlength="50"  chk="필수|`이메일`">
						<label class="select-item" style="width:150px; overflow:inherit !important;"  onchange="$(this).prev().val($(this).children(\'.select-item2\').val()).focus();">
							<select class="select-item2 wd150 mg-l-10">
								<option value="">선택</option>
										<option value="naver.com">naver.com</option>
		<option value="daum.com">daum.net</option>
		<option value="gmail.com">gmail.com</option>
		<option value="nate.com">nate.com</option>
		<option value="hanmail.net">hanmail.net</option>
		<option value="empas.com">empas.com</option>
		<option value="hotmail.com">hotmail.com</option>
		<option value="yahoo.co.kr">yahoo.co.kr</option>
		<option value="korea.kr">korea.kr</option>
		<option value="">직접입력</option>
									</select>
					</label>
				</div>
			</li> 
			<li class="txt-0">
				<h6 class="title">소속</h6>
				<div class="container pd-v-2 txt-0">
					<input type="text" class="dp-inblock respon-free-100" style="width:300px;" maxlength="50" name="team_sosok1[]" value="" chk="필수|`소속`">	
				</div>
				<span class="txt-12 txt-red v-middle">※ 소속 없을 시 \'없음\'으로 표기</span>
			</li>

		</ul>
	</div>
</div>
</div>
<!-- 프리셋 종료 -->

<div class="over-hidden narrow">

    <div class="container register-proccess">
        <ul>
            <li class="done">
                <div class="container">
                    <h5 class="txt-600">Step1</h5>
                    <h4 class="txt-nanum txt-700">이용동의</h4>
                </div>
            </li>
            <li class="on">
                <div class="container">
                    <h5 class="txt-600">Step2</h5>
                    <h4 class="txt-nanum txt-700">정보입력</h4>
                </div>
            </li>
            <li class="">
                <div class="container">
                    <h5 class="txt-600">Step3</h5>
                    <h4 class="txt-nanum txt-700">접수완료</h4>
                </div>
            </li>
        </ul>
    </div>

	<form name="form1" method="post" action="" enctype="multipart/form-data" class="container register-form-input">
	<!-- <input type="hidden" name="fileset_cnt" id="fileset_cnt" value="1"> -->

	<div class="container">
		<h2 class="pd-v-5"><span class="txt-18 txt-700 txt-aaa">Step2</span><br><span class="txt-nanum txt-900">접수정보입력</span></h2>
		<h6 class="txt-nanum txt-14 txt-500">모든 접수정보를 정확하게 기입해 주세요.</h6>
	</div>

	<input type="hidden" name="enc" value="71427fb8f26ae9c2e5de18d460673c1ff561cf84df17c7405ce2ea6aa4756b6ff01b6d16a6e5fec5cf"><input type="hidden" name="mode" value="I">
	<div id="reg_info" class="card mg-t-20">
		<div class="container">
			<h3 class="txt-nanum txt-700 txt-18">접수정보</h3>
			<ul class="full-list  pd-t-10">			
				<li class="txt-0">
					<h6 class="title">연령</h6>
					<div class="container pd-v-2 txt-0">
					
		<label class="radio-item">
			<input type="radio" name="cate1" value="A" chk="필수|연령을 선택해 주세요.">
			<div class="ripple dark" style="width: 209.124px; height: 209.124px; opacity: 0; left: 25px; top: 24px; transform: translateX(-50%) translateY(-50%) scaleX(1) scaleY(1);"></div>
			<div class="labelling">
					<div class="icons">
						<i class="material-icons">radio_button_unchecked</i>
						<i class="material-icons">check_circle</i>
					</div> -->
				<span class="caption">10대</span>
			</div>
		</label>
		<label class="radio-item">
			<input type="radio" name="cate1" value="B" chk="필수|연령을 선택해 주세요.">
			<div class="ripple dark" style="width: 209.124px; height: 209.124px; opacity: 0; left: 25px; top: 24px; transform: translateX(-50%) translateY(-50%) scaleX(1) scaleY(1);"></div>
			<div class="labelling">
					<div class="icons">
						<i class="material-icons">radio_button_unchecked</i>
						<i class="material-icons">check_circle</i>
					</div> -->
				<span class="caption">20대</span>
			</div>
		</label>
		<label class="radio-item">
			<input type="radio" name="cate1" value="C" chk="필수|연령을 선택해 주세요.">
			<div class="ripple dark" style="width: 209.124px; height: 209.124px; opacity: 0; left: 25px; top: 24px; transform: translateX(-50%) translateY(-50%) scaleX(1) scaleY(1);"></div>
			<div class="labelling">
					<div class="icons">
						<i class="material-icons">radio_button_unchecked</i>
						<i class="material-icons">check_circle</i>
					</div> -->
				<span class="caption">30대</span>
			</div>
		</label>
		<label class="radio-item">
			<input type="radio" name="cate1" value="D" chk="필수|연령을 선택해 주세요.">
			<div class="ripple dark" style="width: 209.124px; height: 209.124px; opacity: 0; left: 25px; top: 24px; transform: translateX(-50%) translateY(-50%) scaleX(1) scaleY(1);"></div>
			<div class="labelling">
					<div class="icons">
						<i class="material-icons">radio_button_unchecked</i>
						<i class="material-icons">check_circle</i>
					</div> -->
				<span class="caption">40대 이상</span>
			</div>
		</label>					</div>
				</li>
				<li class="txt-0">
					<h6 class="title">응모 구분</h6>
					<div class="container pd-v-2 txt-0">
					
		<label class="radio-item">
			<input type="radio" name="team" value="P" checked chk="필수|응모구분">
			<div class="ripple dark" style="width: 209.124px; height: 209.124px; opacity: 0; left: 25px; top: 24px; transform: translateX(-50%) translateY(-50%) scaleX(1) scaleY(1);"></div>
			<div class="labelling">
					<div class="icons">
						<i class="material-icons">radio_button_unchecked</i>
						<i class="material-icons">check_circle</i>
					</div> -->
				<span class="caption">개인</span>
			</div>
		</label>
		<label class="radio-item">
			<input type="radio" name="team" value="T" chk="필수|응모구분">
			<div class="ripple dark" style="width: 209.124px; height: 209.124px; opacity: 0; left: 25px; top: 24px; transform: translateX(-50%) translateY(-50%) scaleX(1) scaleY(1);"></div>
			<div class="labelling">
					<div class="icons">
						<i class="material-icons">radio_button_unchecked</i>
						<i class="material-icons">check_circle</i>
					</div> -->
				<span class="caption">팀</span>
			</div>
		</label>						<span class="txt-12 txt-red v-middle">※ 팀 접수는 대표자를 포함한 최대 3인까지 가능합니다. </span>						
					</div>
				</li>
			</ul>
		</div>
	</div>

    <div id="reg_info" class="card over-hidden mg-t-20">
        <div class="container">
            <h3 class="txt-nanum txt-700 txt-18">접수 대표자</h3>
            <ul class="full-list  pd-t-10">
                <li class="txt-0">
                    <h6 class="title">접수자명</h6>
                    <div class="container pd-v-2 txt-0">
                    <input type="text" name="uname" value="" class="dp-inblock respon-free-100" style="width:280px;" chk="필수|접수자명을 입력하세요." maxlength="20">
                    </div>
                </li>
                <li class="txt-0">
                    <h6 class="title">비밀번호</h6>
                    <div class="container pd-v-2 txt-0">
                        <input type="password" maxlength="30" class="dp-inblock respon-free-100 mg-r-10" style="width:280px;" name="pwd" placeholder="※ 영문+숫자 조합 6자 이상 작성해 주세요" chk="필수|암호를 입력하세요.\\n\\n(영문 숫자 조합 6자 이상)" func="isStrongPassword(this.value)">
                        <span class="txt-12 txt-red v-middle"></span>
                    </div>				
                </li>
                <li class="txt-0">
                    <h6 class="title">비밀번호 확인</h6>
                    <div class="container pd-v-2 txt-0">
                        <input type="password" maxlength="30" class="dp-inblock respon-free-100 mg-r-10" style="width:280px;" name="pwd2"  placeholder="※ 암호 확인을 위해 한 번 더 작성해주세요" chk="필수|입력한 암호와 암호확인이 일치하지 않습니다." func="isSameText({{pwd}}, {{pwd2}})">
                        <span class="dp-inblock txt-12 txt-red v-middle">※ 암호는 접수 확인 시 사용됩니다. 암호를 잊으셨을 경우 사무국(02-334-7005)로 연락 부탁드립니다.</span>
                    </div>					
                </li>
                <li class="txt-0">
                    <h6 class="title">생년월일</h6>
                    <div class="container pd-v-2 txt-0">
                        <input type="text" name="birth" value="" class="dp-inblock respon-free-100" style="width:280px;" chk="필수|`생년월일`" onclick="calMan.show(this)" dateformat="Y-m-d" placeholder="※ 입력란을 클릭하시면 달력이 나옵니다." readonly /> ※ 입력란을 클릭하시면 달력이 나옵니다.
                    </div>
                </li>
                <li class="txt-0">
                    <h6 class="title">주소</h6>
                    <div class="container pd-v-2 txt-0">
                        <input type="text" name="zip" value="" maxlength="5" class="text1 wd100" readonly chk="필수|`우편번호`" /> 
                        <button type="button" class="btn zip mg-l-10" style="width:120px;" onclick="openZipSearch(this)">
                            <div class="bg"></div>
                            <div class="ripple"></div>
                            <span class="caption">우편번호검색</span>
                        </button>
                    </div>
                    <div class="container pd-v-2 txt-0">
                        <input type="text" name="addr1" value="" maxlength="100" class="w500" placeholder="기본주소" readonly chk="필수|`기본 주소`" />
                    </div>
                    <div class="container pd-v-2 txt-0">
                        <input type="text" name="addr2" value="" maxlength="100" class="w500" placeholder="상세주소입력" chk="필수|`상세 주소`" />
                    </div>
                </li>
                <li class="txt-0">
                    <h6 class="title">연락처</h6>
                    <div class="container pd-v-2 txt-0">
                        <label class="select-item" style="width:100px;">
                            <select name="tel1" class="wd100" chk="필수|`연락처`">
                                <option value="">선택</option>
                                		<option value="02">02</option>
		<option value="031">031</option>
		<option value="032">032</option>
		<option value="033">033</option>
		<option value="041">041</option>
		<option value="042">042</option>
		<option value="043">043</option>
		<option value="044">044</option>
		<option value="051">051</option>
		<option value="052">052</option>
		<option value="053">053</option>
		<option value="054">054</option>
		<option value="055">055</option>
		<option value="061">061</option>
		<option value="062">062</option>
		<option value="063">063</option>
		<option value="064">064</option>
		<option value="070">070</option>
		<option value="070">0505</option>
		                            </select>
                        </label>
                        <input type="text" maxlength="4" name="tel2" value="" class="mg-l-10 wd80" chk="필수,숫자|`연락처`">
                        <input type="text" maxlength="4" name="tel3" value="" class="mg-l-10 wd80" chk="필수,숫자|`연락처`">
                    </div>
                </li>
                <li class="txt-0">
                    <h6 class="title">휴대폰</h6>
                    <div class="container pd-v-2 txt-0">
                        <label class="select-item" style="width:100px;">
                            <select name="mobile1" class="wd100" chk="필수|`휴대폰`">
                                <option value="">선택</option>
                                		<option value="010">010</option>
		<option value="011">011</option>
		<option value="016">016</option>
		<option value="017">017</option>
		<option value="018">018</option>
		<option value="019">019</option>
		                            </select>
                        </label>
                        <input type="text" maxlength="4" name="mobile2" value="" class="mg-l-10 wd80" chk="필수,숫자|`휴대폰`">
                        <input type="text" maxlength="4" name="mobile3" value="" class="mg-l-10 wd80" chk="필수,숫자|`휴대폰`">
                    </div>
                </li>
                <li class="txt-0">
                    <h6 class="title">이메일</h6>
                    <div class="container pd-v-2 txt-0">
                        <input type="text" class="mg-l-0 wd150" maxlength="50" name="email1" value="" chk="필수|`이메일`">
                        <div class="txt-12 pd-h-10 v-middle dp-inblock">@</div>								
                        <input type="text" class="wd150" maxlength="50" name="email2" value="" id="str_email02" chk="필수|`이메일`" > 
                        <label class="select-item" style="width:150px; overflow:inherit !important;" onchange="$(this).prev().val($(this).children(\'.select-item2\').val()).focus();">
                            <select class="select-item2 wd150 mg-l-10">
                                <option value="">선택</option>
                                		<option value="naver.com">naver.com</option>
		<option value="daum.com">daum.net</option>
		<option value="gmail.com">gmail.com</option>
		<option value="nate.com">nate.com</option>
		<option value="hanmail.net">hanmail.net</option>
		<option value="empas.com">empas.com</option>
		<option value="hotmail.com">hotmail.com</option>
		<option value="yahoo.co.kr">yahoo.co.kr</option>
		<option value="korea.kr">korea.kr</option>
		<option value="">직접입력</option>
		                            </select>
                        </label>
                    </div>
                </li>
                <li class="txt-0" id="sosok_ui" >
                    <h6 class="title">소속</h6>
                    <div class="container pd-v-2 txt-0">
                        <input type="text" id="sosok1" name="sosok1" class="dp-inblock respon-free-100" style="width:280px;" maxlength="50" name="sosok1" value="" chk="필수|`소속`">
                    </div>
                </li>			
            </ul>	
        </div>
    </div>
	<div id="team_box" class="card over-hidden mg-t-20" name="team_ui">	
		<div class="container">
			<h3 class="txt-nanum txt-700 txt-18">팀 정보</h3>
			<ul class="full-list">
				<li class="txt-0">
					<h6 class="title">팀명</h6>
					<div class="container pd-v-2 txt-0">
						<input type="text" name="team_name" value="" chk="|`팀명`" if="{{team}}==\'T\'" maxlength="50" class="text1 w300" />
					</div>
				</li>	
				<li class="txt-0">
					<div class="container pd-v-2 txt-0">
						<span class="txt-12 txt-red v-middle" name="team_ui">※ 팀 접수는 대표자를 포함한 최대 3인까지 가능합니다.</span>
					</div>
				</li>			
			</ul>
		</div>
		<div id="team_info">
					</div>	
		<div name="team_ui" class="team_ui pd-b-20">
			<button type="button" class="btn type2 mg-l-10 wd200" onclick="addTeam()">
				<div class="bg"></div>
					<div class="ripple"></div>
				<span class="caption">팀원추가</span>
			</button>
		</div>
	</div>

    <div id="content_file_box" name="content_file_box" class="card over-hidden mg-t-20">
        <div class="container">
            <h3 class="txt-nanum txt-700 txt-18">접수작 정보</h3>
            <ul class="full-list">
                <li>
                    <h6 class="title">작품 제목</h6>
                    <div class="container pd-v-2 txt-0">
                    <input type="text" id="title" name="title" onkeyup="chkCharLen(this,\'title\')" onfocus="chkCharLen(this,\'title\')" chk="필수|`작품 제목`" class="text1" />
                        <div class="container2 pd-v-2 txt-0">
                            <span class="txt-12 txt-111 v-middle">
                            <!-- ※  50자 이내로 입력(공백포함)  -->
                            <span1 class="silver"></span1>
							</span>
                        </div>
                    </div>
                </li>
                <li> 
                    <h6 class="title">작품 설명<br>(500자 이내)</h6>
                    <div class="container pd-v-2 txt-0">
                        <textarea id="contents" name="contents" rows="10" chk="필수|`작품 설명`" onkeyup="chkCharLen(this,\'contents\')" onfocus="chkCharLen(this,\'contents\')" class="text1 hauto"></textarea>
                        <div class="container2 pd-v-2 txt-0">
                            <span class="txt-12 txt-111 v-middle">
                                ※ 500자 이내로 입력(공백포함) 
                            <span2 class="silver"></span2> 
                            </span>
                        </div>
                    </div>
				</li>
				<li>
                    <h6 class="title">유투브 URL</h6>
                    <div class="container pd-v-2 txt-0">
                    <input type="text" id="title" id="youtube_url" name="youtube_url" chk="필수|`유투브 URL`" class="text1" />
                        <div class="container2 pd-v-2 txt-0">
                            <span class="txt-12 txt-111 v-middle">
                            <!-- ※  50자 이내로 입력(공백포함)  -->
							</span>
                        </div>
                    </div>
                </li>
				<li>
                    <h6 class="title">썸네일 업로드</h6>
                    <div name="upload1" class="container pd-v-2 txt-0 file_input">
                        <input type="file" class="" name="files1" id="files1" chk="필수|`썸네일`" contentEditable="false">
                    </div>
					<div class="container pd-v-10 txt-0" id="logo_file_ui">
                        <span class="txt-12 v-middle txt-lh-20 ">
                            &nbsp;&nbsp;&nbsp;- JPG, JPEG, PNG 파일
                        </span>
                    </div>
                </li>
                <li>
                    <h6 class="title">작품 업로드</h6>
                    <div name="upload1" class="container pd-v-2 txt-0 file_input">
                        <input type="file" class="" name="files2" id="files2" chk="필수|`작품`" contentEditable="false">
                    </div>
                    <div class="container pd-v-10 txt-0" id="logo_file_ui">
                        <span class="txt-12 v-middle txt-lh-20 ">
							<span class="txt-orange pd-t-5">※ 파일명: [평화정책 UCC 공모전] 이름(팀명)_영상제목 작성 </span><br>
							<span class="txt-orange pd-t-5">※ 파일 형식: 분량 제한 없음, 해상도 FULL HD(1920*1080), 2~3분 내외 </span><br>
							<span class="txt-orange pd-t-5">※ 참가신청서, 서약서 제출 필수 </span>                      
                        </span>
                    </div>
                </li>
				<li>
                    <h6 class="title">참가신청서 업로드</h6>
                    <div name="upload1" class="container pd-v-2 txt-0 file_input">
                        <input type="file" class="" name="files3" id="files3" chk="필수|`참가신청서`" contentEditable="false">
                    </div>
                    <div class="container pd-v-10 txt-0" id="logo_file_ui">
                        <span class="txt-12 v-middle txt-lh-20 ">
							<span class="txt-orange pd-t-5">※ 참가신청서, 서약서를 필히 업로드 부탁드립니다. </span><br>
							<span class="txt-orange pd-t-5">※ 업로드 누락 시 발생되는 문제는 참가자 본인에게 있습니다. </span>
                        </span>
                    </div>
                </li>
            </ul>
        </div>
    </div>

	<div id="reg_btn_box2" class="container pd-v-1u txt-center txt-0">
        <a href="javascript:goSubmit();" class="btn bg-444 mg-h-5">
            <div class="bg"></div>
            <div class="ripple"></div>
            <i class="material-icons txt-filament">create</i>
            <span class="caption txt-fff">접수하기</span>
        </a>
    </div>

    <!-- 접수폼 입력 -->
    <div style="padding-top:20px; text-align:right">
        	</div>
	</form>
</div>

<script>
	
    // 썸네일 첨부파일 확장자, 용량 체크
    $(\'input[id=files1]\').change(function(){

        if($(this).val() != ""){
            // 확장자 체크
            var ext = $(this).val().split(".").pop().toLowerCase();
            if($.inArray(ext, ["jpg","jpeg","png"]) == -1){
                alert("jpg, jpeg, png 파일만 업로드 해주세요.");
				// input[type=file] 초기화
                if (/(MSIE|Trident)/.test(navigator.userAgent)) {   // ie 일때 input[type=file] init.                     
                    $(this).replaceWith( $(this).clone(true) ); 
                } else {                                            // other browser 일때 input[type=file] init. 
                    $(this).val(""); 
                }
                return;
            }

			// 용량체크
			for (var i = 0; i<this.files.length; i++){
				var fileSize = this.files[i].size;
				var fSMB = (fileSize / (1024 * 1024)).toFixed(2);
				var maxSize = 1024 * 1024 * 5; // 첨부파일제한 5MB
				var mSMB = (maxSize / (1024 * 1024));
				if(fileSize > maxSize){
					alert(this.files[i].name + "(이)가 용량 5MB를 초과했습니다\\n\\n" + fSMB + "MB / " + mSMB + "MB");
					// input[type=file] 초기화
					if (/(MSIE|Trident)/.test(navigator.userAgent)) {   // ie 일때                      
						$(this).replaceWith( $(this).clone(true) ); 
					} else {                                            // other browser 일때 
						$(this).val(""); 
					}
				}
			}
		}
	});

	// 작품 확장자 용령 체크
	$(\'input[id=files2]\').change(function(){

		if($(this).val() != ""){
			// 확장자 체크
			var ext = $(this).val().split(".").pop().toLowerCase();
			if($.inArray(ext, ["mp4"]) == -1){
				alert("mp4 파일만 업로드 해주세요.");
				// input[type=file] 초기화
				if (/(MSIE|Trident)/.test(navigator.userAgent)) {   // ie 일때 input[type=file] init.                     
					$(this).replaceWith( $(this).clone(true) ); 
				} else {                                            // other browser 일때 input[type=file] init. 
					$(this).val(""); 
				}
				return;
			}

			// 용량체크
			for (var i = 0; i<this.files.length; i++){
				var fileSize = this.files[i].size;
				var fSMB = (fileSize / (1024 * 1024)).toFixed(2);
				var maxSize = 1024 * 1024 * 500; // 첨부파일제한 500MB
				var mSMB = (maxSize / (1024 * 1024));
				if(fileSize > maxSize){
					alert(this.files[i].name + "(이)가 용량 500MB를 초과했습니다\\n\\n" + fSMB + "MB / " + mSMB + "MB");
					// input[type=file] 초기화
					if (/(MSIE|Trident)/.test(navigator.userAgent)) {   // ie 일때                      
						$(this).replaceWith( $(this).clone(true) ); 
					} else {                                            // other browser 일때 
						$(this).val(""); 
					}
				}
			}
		}
	});

	// 참가신청서 확장자 용령 체크
	$(\'input[id=files3]\').change(function(){

		if($(this).val() != ""){
			// 확장자 체크
			var ext = $(this).val().split(".").pop().toLowerCase();
			if($.inArray(ext, ["hwp","docx","doc","pdf"]) == -1){
				alert("hwp, docx, doc, pdf 파일만 업로드 해주세요.");
				// input[type=file] 초기화
				if (/(MSIE|Trident)/.test(navigator.userAgent)) {   // ie 일때 input[type=file] init.                     
					$(this).replaceWith( $(this).clone(true) ); 
				} else {                                            // other browser 일때 input[type=file] init. 
					$(this).val(""); 
				}
				return;
			}

			// 용량체크
			for (var i = 0; i<this.files.length; i++){
				var fileSize = this.files[i].size;
				var fSMB = (fileSize / (1024 * 1024)).toFixed(2);
				var maxSize = 1024 * 1024 * 30; // 첨부파일제한 5MB
				var mSMB = (maxSize / (1024 * 1024));
				if(fileSize > maxSize){
					alert(this.files[i].name + "(이)가 용량 30MB를 초과했습니다\\n\\n" + fSMB + "MB / " + mSMB + "MB");
					// input[type=file] 초기화
					if (/(MSIE|Trident)/.test(navigator.userAgent)) {   // ie 일때                      
						$(this).replaceWith( $(this).clone(true) ); 
					} else {                                            // other browser 일때 
						$(this).val(""); 
					}
				}
			}
		}
	});

	$(\'[name=team]\').bind(\'click\', chkTeamType);
		chkTeamType();
		
	$(\'[name=cate1]\').bind(\'click\', chkCate1);
		init_cate1();

    // 주기적으로 파일을 호출하여 세션풀림을 막는다
    var inter1 = setInterval(function(){
        $.post(\'/session_keep.php\', function(rst){
            // window.status = \'OK\';
        });
    }, 60000);

</script>

<!-- footer -->


			</div>
		</div>
	</main>

	
	<!-- footer -->
		<footer>
			<div class="contain">

				<div class="fm_footer_info">
					평화정책 UCC 공모전 Tel : 031-8008-3294<br>
					Copyright since 평화정책 ucc 공모전. All rights reserved.
				</div>

				<!-- <div class="fm_footer_logo">
					<a href="http://www.nipa.kr/" target="_blank"><img src="/assets/img/footer_logo2.png"></a>
				</div> -->

				<div class="fm_footer_logo">
					<a href="" target="_blank"><img src="/assets/img/logo.png"></a>
				</div>

			</div>
		</footer>

	

	</body>


</html>',
    'wr_link1' => '',
    'wr_link2' => '',
    'wr_link1_hit' => '0',
    'wr_link2_hit' => '0',
    'wr_hit' => '46',
    'wr_good' => '0',
    'wr_nogood' => '0',
    'mb_id' => 'admin',
    'wr_password' => '*EC8A94DBC67C1054C3B247BDDA6550AC30D4B756',
    'wr_name' => '관리자',
    'wr_email' => 'lsping@naver.com',
    'wr_homepage' => '',
    'wr_datetime' => '2020-04-21 17:13:30',
    'wr_file' => '0',
    'wr_last' => '2020-04-21 17:13:30',
    'wr_ip' => '121.129.233.2',
    'wr_facebook_user' => '',
    'wr_twitter_user' => '',
    'wr_1' => '',
    'wr_2' => '',
    'wr_3' => '',
    'wr_4' => '',
    'wr_5' => '',
    'wr_6' => '',
    'wr_7' => '',
    'wr_8' => '',
    'wr_9' => '',
    'wr_10' => '',
    'is_notice' => false,
    'subject' => '씽굿-접수 참고(타사이트)',
    'comment_cnt' => '',
    'datetime' => '2020-04-21',
    'datetime2' => '04-21',
    'last' => '2020-04-21',
    'last2' => '04-21',
    'name' => '<span class="sv_member">관리자</span>',
    'reply' => 0,
    'icon_reply' => '',
    'icon_link' => '',
    'ca_name_href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;sca=ETC',
    'href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;wr_id=179',
    'comment_href' => 'http://lsp80.cafe24.com/bbs/board.php?bo_table=bbs_tip&amp;wr_id=179',
    'icon_new' => '',
    'icon_hot' => '',
    'icon_secret' => '',
    'link' => 
    array (
      1 => NULL,
      2 => NULL,
    ),
    'link_href' => 
    array (
      1 => 'http://lsp80.cafe24.com/bbs/link.php?bo_table=bbs_tip&amp;wr_id=179&amp;no=1',
      2 => 'http://lsp80.cafe24.com/bbs/link.php?bo_table=bbs_tip&amp;wr_id=179&amp;no=2',
    ),
    'link_hit' => 
    array (
      1 => 0,
      2 => 0,
    ),
    'file' => 
    array (
      'count' => '0',
    ),
  ),
)?>