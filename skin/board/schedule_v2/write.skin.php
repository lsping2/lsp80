<?php
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php'); 
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($w=='' && $_GET['f_date']) {
	$wr_1 = $_GET['f_date'];
	$wr_2= $_GET['f_date'];  
}
$wr_3 = substr($wr_3,0,strlen($wr_3)-3);
$wr_4 = substr($wr_4,0,strlen($wr_4)-3);
$wr_5 = substr($wr_5,0,strlen($wr_5)-3);
$wr_6 = substr($wr_6,0,strlen($wr_6)-3);

if ( !$wr_1) {
	$wr_1 = $wr_2 = date('Ymd');
}
?>

<link rel="stylesheet" href="<?php echo $board_skin_url ?>/style.css">

<section id="bo_w">
    <h2 id="container_title"><?php echo $g5['title'] ?> <font color="blue">  *  15만원의 경우 150입력, -15만원일 경우 -150입력 (단위 천원)</font> </h2>

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="wr_subject">
	<input type="hidden" name="wr_content">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <tbody>
        <?php if ($is_name) { ?>
        <tr>
            <th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_password) { ?>
        <tr>
            <th scope="row"><label for="wr_password">패스워드<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_email) { ?>
        <tr>
            <th scope="row"><label for="wr_email">이메일</label></th>
            <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email" size="50" maxlength="100"></td>
        </tr>
        <?php } ?>

        <?php if ($is_homepage) { ?>
        <tr>
            <th scope="row"><label for="wr_homepage">홈페이지</label></th>
            <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" size="50"></td>
        </tr>
        <?php } ?>
<!--
        <?php if ($option) { ?>
        <tr>
            <th scope="row">옵션</th>
            <td><?php echo $option ?></td>
        </tr>
        <?php } ?>
-->
        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
            <td>
                <select name="ca_name" id="ca_name" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>
            </td>
        </tr>
        <?php } ?>

		<tr>
			<th scope="row"><label for="wr_1">날짜<strong class="sound_only">필수</strong></label></th>
			<td>
				<input type="text" name="wr_1" value="<?php echo $wr_1 ?>" readonly id="wr_1" required class="frm_input required" size="12" maxlength="8"> 
				
				   <input type="text" name="wr_2" value="<?php echo $wr_2 ?>" readonly id="wr_2" required class="frm_input required" size="12" maxlength="8" onkeyup="fn_Duration();">


<input type="text" name="hope_term" id="hope_term" value="0" style="width:40px;"  onfocus="fn_Duration();"  class="input_basic" readonly

				<label for="wr_2" style="display:none">종료일<strong class="sound_only">필수</strong></label>
			</td>
		</tr>
		<tr>
            <th scope="row"><label for="wr_3">마감자산<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_3" value="<?php echo $wr_3 ?>" id="wr_3"  class="frm_input " size="12" maxlength="20"  onkeyPress="InpuOnlyNumber(this);">
			</td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_4"><font color="green">당일손익</font><strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_4" value="<?php echo $wr_4 ?>" id="wr_4"  class="frm_input " size="12" maxlength="20" onkeyPress="InpuOnlyNumber(this);">
			
				<font color="#a2a2a2">당일손익= 실현손익+평가손익</font>
			</td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_5">보유잔고<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_5" value="<?php echo $wr_5 ?>" id="wr_5"  class="frm_input " size="12" maxlength="20"  onkeyPress="InpuOnlyNumber(this);"></td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_6">평가손익<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_6" value="<?php echo $wr_6 ?>" id="wr_6"  class="frm_input " size="12" maxlength="20"  onkeyPress="InpuOnlyNumber(this);"></td>
        </tr>
<!--
        <tr>
            <th scope="row"><label for="wr_subject">제목<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" size="50" maxlength="255">
                    <?php if ($is_member) { // 임시 저장된 글 기능 ?>
                    <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                    <button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>
                    <div id="autosave_pop">
                        <strong>임시 저장된 글 목록</strong>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                        <ul></ul>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                    </div>
                    <?php } ?>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_content">내용<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content">
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
                <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?>
            </td>
        </tr>

		<tr>
			<th scope="row"><label for="wr_3">아이콘</label></th>
			<td>
			  <TABLE cellSpacing=0 cellPadding=0 border=0>
			  <!--아이콘은 슈퍼보드의 아이콘을 사용하였습니다. http://superboard.com
			  <? for ($j=1 ; $j<=3 ; $j++) {
				  echo "<TR>" ;
				  for ( $i=$j*10-9 ; $i<=$j*10 ; $i++ ){
					  echo "<TD style='border:0'><INPUT type=radio value=bull_".$i." name=wr_3 " ; 
					  if($write[wr_1] == "bull_".$i)  
						  echo "checked ";
					  echo "><img src='$board_skin_url/img/bull_".$i.".gif' border=0> &nbsp;</TD>" ;	
					  }
					  echo "</TR>" ;
				}?>
			  </TABLE>
			</td>
		</tr>

        <?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">링크 #<?php echo $i ?></label></th>
            <td><input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input" size="50"></td>
        </tr>
        <?php } ?>
-->
        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">파일 #<?php echo $i+1 ?></th>
            <td>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> :  용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo $file[$i]['bf_content'];  ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="글쓰기" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
    </div>
    </form>

    <script>
	$(function(){ // 날짜 입력
		$("#wr_1, #wr_2").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yymmdd", showButtonPanel: true }); 
	});

    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
		f.wr_subject.value = f.wr_1.value + " 작성게시물";
	    f.wr_content.value =".";
		f.wr_2.value =  f.wr_1.value;

        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }




	
   function fn_Duration(){

      var s_day = document.getElementById("wr_1").value;
      var e_day = document.getElementById("wr_2").value;
      
 
     
         if (s_day==e_day){
      	  	 var s_year  = s_day.substring(0,4);
            var s_month = s_day.substring(5,7);
            var s_day   = s_day.substring(8,10);
            var e_year  = e_day.substring(0,4);
            var e_month = e_day.substring(5,7);
            var e_day   = e_day.substring(8,10);
  
            a1=new Date(s_year,s_month-1,s_day).getTime(); 
            a2=new Date(e_year,e_month-1,e_day).getTime();

            iAddDays=parseInt((a2-a1)/(1000*60*60*24),10);
            document.fwrite.hope_term.value = iAddDays+1;

      	  }else{

            var s_year  = s_day.substring(0,4);
            var s_month = s_day.substring(4,6);
            var s_day   = s_day.substring(6,8);
            var e_year  = e_day.substring(0,4);
            var e_month = e_day.substring(4,6);
            var e_day   = e_day.substring(6,8);
            a1=new Date(s_year,s_month-1,s_day).getTime(); 
            a2=new Date(e_year,e_month-1,e_day).getTime();

            iAddDays=parseInt((a2-a1)/(1000*60*60*24),10);
            document.fwrite.hope_term.value = iAddDays;
         }
         
          //fn_calu();
   



   }

    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->