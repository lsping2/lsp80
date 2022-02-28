<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker2.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

//&& $_SERVER['REMOTE_ADDR'] != "58.234.212.41"


//unlink(G5_DATA_PATH.'/file/'.$bo_table.'/PW09220001.jpg');
/*
 $aaa = "../data/file/request/TAI08090005.pdf";
  $dst = "../data/file/request/TAI08090002.pdf";
echo "cp ".$aaa." ".$dst."" ;
		exec("cp ".$aaa." ".$dst."");
	*/

if ( $_SERVER['REMOTE_ADDR'] != "121.129.233.2" && $_SERVER['REMOTE_ADDR'] != "58.234.212.13" && $_SERVER['REMOTE_ADDR'] != "172.16.4.97"  && $_SERVER['REMOTE_ADDR'] != "125.128.68.193"){
	//alert('접수기간이 아닙니다. ', '/');
}

?>

<section id="bo_w">
    <!-- <h2 id="container_title"><?php echo $g5['title'] ?></h2> -->

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
	<input type="hidden" name="wr_1_db" value="<?php echo $wr_1 ?>">
	 

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
    
    
    <div class="agree_box_wrap">
      <h4>개인정보 수집 및 이용에 관한 사항</h4>
      <div class="agree_box">
        
        <!--약관내용{-->
        <?php echo nl2br($config['cf_stipulation']) ?>
		
        <!--약관내용{-->
      
        <!--}약관내용-->        
      </div>
      <div class="agree_check">
      <span><input type="checkbox" name="agree_it" id="agree_id" value="Y" onclick="chkClick(this);" > <label for="agree_id">동의합니다.</label></span>
      <span><input type="checkbox" name="agree_it" id="agree_id22"  value="N" onclick="chkClick(this);"> <label for="agree_id22">동의하지 않습니다.</label></span>
      </div>
    </div>

	<div class="agree_box_wrap">
      <h4>저작권안내(Copyright)</h4>
      <div class="agree_box">
        
        <!--약관내용{-->
        <?php echo nl2br($config['cf_privacy']) ?>
		
      </div>
      <div class="agree_check" style="text-align:center">
	   <font color='red'  style="font-size:15px">본인은 <b> ‘2019년 일본군＇위안부＇피해자 관련 학생·청소년 작품 공모전’</b>의 <br>
요강 및 유의사항, 개인정보취급방침, 저작권 사항을 확인하였습니다.</font>
		  <br><br>
	 </div>
	
	 <div class="agree_check">
	<span><input type="checkbox" name="agree_it2" id="agree_id2" value="Y" onclick="chkClick2(this);" > <label for="agree_id2">동의합니다.</label></span>
      <span><input type="checkbox" name="agree_it2" id="agree_id222"  value="N" onclick="chkClick2(this);"> <label for="agree_id222">동의하지 않습니다.</label></span>
      </div>
    </div>


    <div class="line"></div>
    
    <div class="cols">
      <h4 class="first">&nbsp;&nbsp;접수정보 <font color='red' class="txt" style="display:none"> (수정불가)</font></h4> 
      <div class="tbl_frm01 tbl_wrap">
  
          <table>
          <tbody>
  
           <?php if ($option && $is_admin) { ?>
          <tr>
              <th scope="row">옵션</th>
              <td colspan="3"><?php echo $option ?></td>
          </tr>
          <?php } ?>
  
          <?php if ($is_category) { ?>
          <tr>
              <th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
              <td colspan="3">
                  <select name="ca_name" id="ca_name" required class="required" >
                      <option value="">선택하세요</option>
                      <?php echo $category_option ?>
                  </select>
              </td>
          </tr>
          <?php } ?>
  
		

		<tr>
              <th scope="row">응모분야<strong class="sound_only">필수</strong></th>
              <td colspan="3">
                   <input type="radio" name="wr_7"  id="wr_7a" class="wr_7"  value="미술분야"  checked <? if($write[wr_7] == '미술분야') echo "checked"?> onClick="part_it('미술분야')"> <label for="wr_7a">미술분야</label>&nbsp;&nbsp;

					<input type="radio" name="wr_7"  id="wr_7b" class="wr_7"  value="음악분야"  <? if($write[wr_7] == '음악분야') echo "checked"?> onClick="part_it('음악분야')"> <label for="wr_7b">음악분야</label>&nbsp;&nbsp;
					
              </td>
          </tr>

		  <tr>
              <th scope="row">상세부문<strong class="sound_only">필수</strong></th>
              <td colspan="3">
			  <div class="art" >
                   <input type="radio" name="wr_4"  id="wr_4a" class="wr_4"  required  value="디자인"  <? if($write['wr_4'] == '디자인') echo "checked"?> > <label for="wr_4a">디자인</label>&nbsp;&nbsp;

				  <input type="radio" name="wr_4"  id="wr_4b"  class="wr_4" required value="손그림"  <? if($write['wr_4'] == '손그림') echo "checked"?> > <label for="wr_4b">손그림</label>&nbsp;&nbsp;

				   <input type="radio" name="wr_4"  id="wr_4c" class="wr_4" required  value="만화"  <? if($write['wr_4'] == '만화') echo "checked"?> > <label for="wr_4c">만화</label>&nbsp;&nbsp;

				  <input type="radio" name="wr_4"  id="wr_4d"  class="wr_4" required  value="공예"  <? if($write['wr_4'] == '공예') echo "checked"?> > <label for="wr_4d">공예</label>
					&nbsp;&nbsp;

				  <input type="radio" name="wr_4"  id="wr_4e" class="wr_4" required  value="기타"  <? if($write['wr_4'] == '기타') echo "checked"?> > <label for="wr_4e">기타</label>&nbsp;&nbsp;
			</div>
			 <div class="music" style="display:none">
				  <input type="radio" name="wr_4"  id="wr_4f"  class="wr_4" required  value="공연"  <? if($write['wr_4'] == '공연') echo "checked"?> > <label for="wr_4f">공연</label>&nbsp;&nbsp;

				   <input type="radio" name="wr_4"  id="wr_4f"  class="wr_4" required  value="영상"  <? if($write['wr_4'] == '영상') echo "checked"?> > <label for="wr_4f">영상</label>&nbsp;&nbsp;
			</div>
				
		</span>
				
              </td>
          </tr>
			
			  <tr>
              <th scope="row">응모구분<strong class="sound_only">필수</strong></th>
              <td colspan="3">
              <input type="radio" name="wr_1"  id="wr_1a" class="wr_1"  value="개인"  <? if($write[wr_1] == '개인') echo "checked"?> onClick="stat_it('개인')" checked> <label for="wr_1a">개인</label>&nbsp;&nbsp;

				<input type="radio" name="wr_1"   id="wr_1b" class="wr_1"  value="팀" <? if($write[wr_1] == '팀') echo "checked"?>  onClick="stat_it('팀')"> <label for="wr_1b">팀</label>&nbsp;&nbsp;

				<input type="radio" name="wr_1"   id="wr_1c" class="wr_1"  value="단체" <? if($write[wr_1] == '단체') echo "checked"?>  onClick="stat_it('단체')"> <label for="wr_1c">단체</label>
					
				<br><br>
				※ '팀' 응모 : 여러 청소년이 하나의 작품을 함께 준비하여 제출<br>
				※ '단체' 응모 : 여러 개인이나 팀이 각자의 작품을 준비하되 지도교사가 한번에 일괄제출<br><br>

				 ※ 팀으로 신청시 상장, 상금은 팀명으로 수여합니다.<br>
				 ※ 단체로 지원하는 경우, 단체접수양식 다운로드 후 제출<br>
     
              </td>
          </tr>

		   <tr id="sit_ov_btn3" style="display:none">
				<th scope="row">팀명</th>
				<td ><input type="text" name="wr_8" value="<?php echo $wr_8 ?>" id="wr_8"  class="frm_input" size="20" maxlength="30"> <br> <font color="#a8a8a8" style="letter-spacing:-0.1em">※ 예시 : 대학교명+학과 또는 동아리명</font></td>

				<th scope="row">팀원수</th>
				<td ><input type="text" name="wr_10" value="<?php echo $wr_10 ?>" id="wr_10"  class="frm_input" size="20" maxlength="30"> <br> <font color="#a8a8a8" style="letter-spacing:-0.1em">※ 팀장을 포함한 전체 참여자수 (팀원수 제한없음)</font></td>
		  </tr>


		    <tr>
              <th scope="row">소속구분<strong class="sound_only">필수</strong></th>
              <td colspan="3">
           
				  <input type="radio" name="wr_5"  id="wr_5b"  required  value="초등학생"  <? if($write[wr_5] == '초등학생') echo "checked"?> > <label for="wr_5b">초등학생</label>&nbsp;&nbsp;

				  <input type="radio" name="wr_5"  id="wr_5c"   required value="중학생"  <? if($write[wr_5] == '중학생') echo "checked"?> > <label for="wr_5c">중학생</label>&nbsp;&nbsp;

				   <input type="radio" name="wr_5"  id="wr_5d"  required  value="고등학생"  <? if($write[wr_5] == '고등학생') echo "checked"?> > <label for="wr_5d">고등학생</label>&nbsp;&nbsp;

				  <input type="radio" name="wr_5"  id="wr_5g"   required  value="대학생"  <? if($write[wr_5] == '대학생') echo "checked"?> > <label for="wr_5g">대학생</label>
				  <br><br>
				   <span class="txt_red"> ※ 대표자 기준의 동 연령대로 선택해주시면 됩니다.</span><br>
				   <span class="txt_red"> ※ 학교 밖 청소년(만24세까지)의 경우도 동연령대로 선택후 접수 가능합니다..</span>
              </td>
          </tr>
		

  
  
          <?php if ($is_password) { ?>
          <tr>
              <th rowspan="2" scope="row" ><label for="wr_password">암호설정<strong class="sound_only">필수</strong></label></th>
              <td colspan="3">
              
              <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20" >
              <span class="txt_red ">※ 6자 이상</span>
              </td>
          </tr>
          
          <tr>
              <td colspan="3">
                <input type="password" name="wr_password2" id="wr_password2" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20">
                
                <span class="txt_red" style="line-height:1.8em;">※ 암호 확인으로 한번 더 작성해주세요.<br>
                ※ 암호는 접수확인시 사용됩니다. 암호를 잊어버리면 확인할 수 없으니 꼭 기억해 두세요.</span>
              </td>
          </tr>
  
      
  
          <?php } ?>
  
          </tbody>
          </table>
  
      </div>  
    
    </div>
    
    
    <div class="cols">

        <h4>&nbsp;&nbsp;접수자 정보 <font color='red' class="txt" style="display:none">(수정불가)</font></h4> 

        <div class="tbl_frm01 tbl_frm02 tbl_wrap">
            <table >
            <tbody>
            <tr>
                <th scope="row" style="width:100px"><label for="wr_name">대표자 성명<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
    
                 <th scope="row"><label for="wr_2">생년월일<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="wr_2" value="<?php echo $write['wr_2']; ?>" readonly id="wr_2" required class="frm_input required" size="12" maxlength="12">
                </td>
            </tr>

			<tr>
                <th scope="row"><label for="wr_9">소속정보<br>(학교/회사)<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
				<input type="text" name="wr_9" value="<?php echo $wr_9 ?>" id="wr_9" required class="frm_input required" size="30" maxlength="30"> 
                </td>
            </tr>
			<tr>
                <th scope="row"><label for="wr_13">소속정보<br>(학년/부서/학과)<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
				<input type="text" name="wr_13" value="<?php echo $write['wr_13'] ?>" id="wr_13" required class="frm_input required" size="30" maxlength="30"> 
                </td>
            </tr>

		

              <tr>
                <th scope="row"><label for="mb_addr">주소</label></th>
                <td colspan="3" style="line-height:2em;">
                    <label for="reg_mb_zip" class="sound_only">우편번호<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
                    <input type="text" name="mb_zip"  required value="<?php echo $write['mb_zip']; ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input required" size="5" maxlength="6">
                    <button type="button" class="btn_frmline" onclick="win_zip('fwrite', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
                    <input type="text" name="mb_addr1" value="<?php echo $write['mb_addr1'] ?>" id="reg_mb_addr1" required  class="frm_input frm_address required" size="50">
                    <label for="reg_mb_addr1">기본주소<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label><br>
                    <input type="text" name="mb_addr2" value="<?php echo $write['mb_addr2'] ?>" id="reg_mb_addr2" class="frm_input frm_address" size="50">
                    <label for="reg_mb_addr2">상세주소</label>
                    <br>
                    <input type="hidden" name="mb_addr3" value="<?php echo $write['mb_addr3'] ?>" id="reg_mb_addr3" class="frm_input frm_address" size="50" readonly="readonly">
                   
                    <input type="hidden" name="mb_addr_jibeon" value="<?php echo $write['mb_addr_jibeon']; ?>">
                </td>
            </tr>

             <tr>
                <th scope="row"><label for="wr_3">연락처<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
    <?
    list($wr_3_1, $wr_3_2, $wr_3_3) = explode("-",$write[wr_3]);
    ?>
                  <select name='wr_3_1' class="frm_input"   itemname='연락처' required >
                    <option value='02'  selected <? if($wr_3_1=='02') echo "selected";?>>02</option>
                    <option value='031' <? if($wr_3_1=='031') echo "selected";?>>031</option>
                    <option value='032' <? if($wr_3_1=='032') echo "selected";?>>032</option>
                    <option value='033' <? if($wr_3_1=='033') echo "selected";?>>033</option>
                    <option value='041' <? if($wr_3_1=='041') echo "selected";?>>041</option>
                    <option value='042' <? if($wr_3_1=='042') echo "selected";?>>042</option>
                    <option value='043' <? if($wr_3_1=='043') echo "selected";?>>043</option>
                    <option value='051' <? if($wr_3_1=='051') echo "selected";?>>051</option>
                    <option value='052' <? if($wr_3_1=='052') echo "selected";?>>052</option>
                    <option value='053' <? if($wr_3_1=='053') echo "selected";?>>053</option>
                    <option value='054' <? if($wr_3_1=='054') echo "selected";?>>054</option>
                    <option value='055' <? if($wr_3_1=='055') echo "selected";?>>055</option>
                    <option value='061' <? if($wr_3_1=='061') echo "selected";?>>061</option>
                    <option value='062' <? if($wr_3_1=='062') echo "selected";?>>062</option>
                    <option value='063' <? if($wr_3_1=='063') echo "selected";?>>063</option>
                    <option value='064' <? if($wr_3_1=='064') echo "selected";?>>064</option>
                    <option value='0505' <? if($wr_3_1=='0505') echo "selected";?>>0505</option>
                    <option value='070' <? if($wr_3_1=='070') echo "selected";?>>070</option>
					<option value='010' <? if($wr_3_1=='010') echo "selected";?>>010</option>
                  </select> -
                  <input name='wr_3_2' class="frm_input required"   style="IME-MODE:disabled;"   onkeyPress="InpuOnlyNumber(this);" type='text' size='7' maxlength='4' numeric  itemname='연락처 두번째자리' required value="<?=$wr_3_2?>">  -
                  <input name='wr_3_3'  class="frm_input required"   style="IME-MODE:disabled;"   onkeyPress="InpuOnlyNumber(this);" type='text' size='7' maxlength='4' numeric  itemname='연락처 세번째자리' required value="<?=$wr_3_3?>"/>	
                </td>
            </tr>
  			<th scope="row"><label for="wr_6">휴대폰<strong class="sound_only">필수</strong></label></th>
            <td colspan="3">
<?
list($wr_6_1, $wr_6_2, $wr_6_3) = explode("-",$write[wr_6]);
?>
                <select name='wr_6_1' class="frm_input"  itemname='휴대전화' required >
                    <option value='010' selected <? if($wr_6_1=='010') echo "selected";?>>010</option>
                    <option value='011' <? if($wr_6_1=='011') echo "selected";?>>011</option>
                    <option value='016' <? if($wr_6_1=='016') echo "selected";?>>016</option>
                    <option value='017' <? if($wr_6_1=='017') echo "selected";?>>017</option>
                    <option value='018' <? if($wr_6_1=='018') echo "selected";?>>018</option>
                    <option value='019' <? if($wr_6_1=='019') echo "selected";?>>019</option>
              </select> -
              <input name='wr_6_2'  class="frm_input required" style="IME-MODE:disabled;"   onkeyPress="InpuOnlyNumber(this);" type='text' size='7' maxlength='4' numeric  itemname='휴대전화 두번째자리'  required value="<?=$wr_6_2?>">  -
              <input name='wr_6_3'  class="frm_input required"  style="IME-MODE:disabled;"   onkeyPress="InpuOnlyNumber(this);" type='text' size='7' maxlength='4' numeric  itemname='휴대전화 세번째자리'  required value="<?=$wr_6_3?>">
            </td>
        </tr>  
            <tr>
                <th scope="row"><label for="wr_email">이메일</label></th>
                <td colspan="3">
    <?
    list($wr_email1, $wr_email2) = explode("@",$write[wr_email]);
    ?>
                <input name='wr_email1' style="IME-MODE:disabled;"  class="frm_input required"   type='text' itemname='이메일' required value="<?php echo $wr_email1; ?>"> 
                @
                <span class="sel2">
                <select name='wr_email2'   id="wr_email2" class="frm_input"  itemname='이메일' onChange="set_mail(this.value)">
                    <option selected value=''>이메일 선택</option>
                    <option value='chollian.net'  <? if($wr_email2=='chollian.net') echo "selected";?>>chollian.net</option>
                    <option value='dreamwiz.com' <? if($wr_email2=='dreamwiz.com') echo "selected";?>>dreamwiz.com</option>
                    <option value='empal.com' <? if($wr_email2=='empal.com') echo "selected";?>>empal.com</option>
                    <option value='freechal.com' <? if($wr_email2=='freechal.com') echo "selected";?>>freechal.com</option>
                    <option value='gmail.com' <? if($wr_email2=='gmail.com') echo "selected";?>>gmail.com</option>
                    <option value='hanmail.net' <? if($wr_email2=='hanmail.net') echo "selected";?>>hanmail.net</option>
                    <option value='hotmail.com' <? if($wr_email2=='hotmail.com') echo "selected";?>>hotmail.com</option>
                    <option value='hanafos.com' <? if($wr_email2=='hanafos.com') echo 
                    "selected";?>>hanafos.com</option>
                    <option value='kebi.com' <? if($wr_email2=='kebi.com') echo "selected";?>>kebi.com</option>
                    <option value='korea.com' <? if($wr_email2=='korea.com') echo "selected";?>>korea.com</option>
                    <option value='lycos.co.kr' <? if($wr_email2=='lycos.co.kr') echo "selected";?>>lycos.co.kr</option>
                    <option value='nate.com'  <? if($wr_email2=='nate.com') echo "selected";?>>nate.com</option>
                    <option value='naver.com'  <? if($wr_email2=='naver.com') echo "selected";?>>naver.com</option>
                    <option value='netian.com'  <? if($wr_email2=='netian.com') echo "selected";?>>netian.com</option>
                    <option value='paran.com'   <? if($wr_email2=='paran.com') echo "selected";?>>paran.com</option>
                    <option value='yahoo.co.kr' <? if($wr_email2=='yahoo.co.kr') echo "selected";?>>yahoo.co.kr</option>
                    <option value='' >직접입력</option>
                </select> 
                </span>
                <input name='wr_email3' class="frm_input required"  style="IME-MODE:disabled;"  required type='text' itemname='이메일' value="<?=$wr_email2?>">	
                
                </td>
            </tr>

			<tr>
                <th scope="row"><label for="wr_11">지도교사 성명<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
				<input type="text" name="wr_11" value="<?php echo $write['wr_11'] ?>" id="wr_11" required class="frm_input required" size="20" maxlength="30"> 
				※ 지도교사가 없는 경우 없음 이라고 적어주세요
                </td>
            </tr>

			<tr class="su" style="display:none">
                <th scope="row"><label for="wr_14">작품수<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
				<input type="text" name="wr_14" value="<?php echo $write['wr_14'] ?>" id="wr_14"  class="frm_input " size="20" maxlength="30"> 
                </td>
            </tr>


            </td>
        </tr>  
            
            </tbody>
            </table>
        </div>  
    </div>
    
	
        
        
    <div class="cols">        
        <h4>&nbsp;&nbsp;작품정보 <font color='red' class="txt" style="display:none"> (수정불가)</font></h4> 
        <div class="tbl_frm01 tbl_wrap">
            <table>
            <tbody>
            <tr>
                <th scope="row"><label for="wr_subject">
				작품제목
				<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <div id="autosave_wrapper">
                        <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" size="50" maxlength="255"  onkeyup="chkCharLen(this,'title')">

<span1 class="silver"></span1> 
                        
                    </div>
                </td>
            </tr>



			<tr class="art2" >
                <th scope="row"><label for="wr_12">
				작품실물 사이즈
				<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <div id="autosave_wrapper">
                        <input type="text" name="wr_12" value="<?php echo $write['wr_12'] ?>" id="wr_12"  class="frm_input" size="30" maxlength="50" placeholder="예) 가로 50cm 세로 40cm">
                        
                    </div>
                </td>
            </tr>


			  <tr>
                <th scope="row"><label for="wr_content">작품설명<br>(500자이내)<strong class="sound_only">필수</strong></label></th>
                <td class="wr_content" colspan="3">
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
    

          
         

 
   <th scope="row" style="width:120px;">
				작품업로드				
				</th>
                <td colspan="3">
                    <input type="file" name="bf_file[0]" id="files2" title="파일첨부 1 : 용량 210,000,000 바이트 이하만 업로드 가능" class="frm_file frm_input">
                                                    
		 <?php if($w == 'u' && $file[0]['file']) { ?>
                    <?php echo $file[0]['source'].'('.$file[0]['size'].')';  ?>  
		<?php } ?>
					

						<p class="txt_red ">
						<span class="filetxt" style="line-height:1.8em;">
						※ 파일형식 : jpg, jpeg, png, hwp ( <b>응모구분이 "단체" 일경우 zip</b> )<br>
						※ 작품 실물 규격 : 가로x세로x높이 = 1㎥ 이하 <br>
						※ 미술분야 ‘만화부문’ 제출시 제공된 양식 내 삽입 후 제출<br>
						※ 추후 본선심사 필요에 따라 원본을 요청할 수 있습니다.

						<a href="/bbs/download.php?bo_table=admin_down&wr_id=5&no=0" class="btn_cancel"><b>만화양식 다운로드</b></button></a>
						</span>	


						<span class="filetxt" style="display:none;line-height:1.8em;">
						※ 파일형식 : wmv, mpeg, avi, mp4 ( <b>응모구분이 "단체" 일경우 zip</b> )<br>
						※ 용량이 큰 경우 업로딩 시간이 충분히 필요합니다. 접수가 완료될 때까지 기다려주세요.
						</span>
						</p>


						
                    
                </td>
            </tr>


            <tr class="files" style="display:none;">
                <th scope="row" style="width:130px;">
				<span class="files_txt">
				팀
				</span>
				<span class="files_txt">
				단체
				</span>
				
				접수 양식 업로드				
				</th>
                <td colspan="3">
                    <input type="file" class="bf_file" name="bf_file[1]" title="파일첨부 2 : 용량 210,000,000 바이트 이하만 업로드 가능" class="frm_file frm_input">
                     
	<?php if($w == 'u' && $file[1]['file']) { ?>
                    <?php echo $file[1]['source'].'('.$file[1]['size'].')';  ?>  
		<?php } ?>
						<br>

						<span  class="files_txt2" style="display:none; line-height:1.8em;">
						※ 응모 구분이 <span class="txt_red ">팀일 경우에만</span> 첨부해주세요.<br>
						※ 파일형식 : xls, xlsx <br>
						 <a href="/bbs/download.php?bo_table=admin_down&wr_id=4&no=0" class="btn_cancel"><b>팀양식 다운로드</b></button></a>
						</span>	

						<span  class="files_txt2" style="display:none; line-height:1.8em;">
						※ 응모 구분이 <span class="txt_red ">단체일 경우에만</span> 첨부해주세요.<br>
						※ 파일형식 : xls, xlsx <br>
						<a href="/bbs/download.php?bo_table=admin_down&wr_id=3&no=0" class="btn_cancel"><b>단체양식 다운로드</b></button></a>
						</span>	

						
						
                    
                </td>
            </tr>







            </tbody>
            </table>
    
    
        </div>


	</div>    
	
    
	<br />
	<div id="upload_msg" style="text-align:center">
		<font color="#0a1e92">작성완료 버튼을 누른후, 접수번호를 확인하기 전까지 페이지를 이동하지 말아주세요.<br>
		용량이 큰경우 업로드에 시간이 소요됩니다.</font><br><br>
	</div>
	

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">&nbsp;
        <a href="javascript:;" onClick="fwrite.reset()"; class="btn_cancel">취소</a>
        &nbsp;
        <? if($is_admin) { ?>
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">목록</a>
		<? } ?>

    </div>


    </form>

    <script>

	$(function(){ // 날짜 입력
		$("#wr_2,#wr_2_1, #wr_2_2, #wr_2_3").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true }); 
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
		
		if (  $(':radio[name="wr_7"]:checked').val() =='미술분야'){

			if (f.wr_12.value == "") {
				alert("작품 실물사이즈를 입력해 주세요.");
				f.wr_12.focus();
				return false;
			}
		}

		if (  $(':radio[name="wr_1"]:checked').val() =='팀'){

			if (f.wr_8.value == "") {
				alert("팀명 정보를 입력해 주세요.");
				f.wr_8.focus();
				return false;
			}

			if (f.wr_10.value == "") {
				alert("팀원수 정보를 입력해 주세요.");
				f.wr_10.focus();
				return false;
			}
		}

	



		if ( '<?=$w?>' == '' ){

			if ($("input:radio[name='wr_4']:checked").length < 1) {
				alert("작품 상세부문을 선택해 주세요.");
				return false;
			}


			filebox0 = document.getElementsByName('bf_file[0]');

			if (filebox0[0].value==""){
				alert('파일을 업로드하여주세요.'); 
				return false;
			}

			
			
			if (  $(':radio[name="wr_7"]:checked').val() =='미술분야'){

				fileboxv0 = filebox0[0].value;
					if (  $(':radio[name="wr_1"]:checked').val() =='단체'){
						if (! fileboxv0.toLowerCase().match(/.(zip)$/i)) {
								alert("단체일경우 파일은 zip 파일로 형식에 맞게 업로드 가능합니다.");
								return false;
						}
					}else{
						if (! fileboxv0.toLowerCase().match(/.(jpg|jpeg|png|hwp)$/i)) {
								alert("파일은 jpg, jpeg, png, hwp 파일로 형식에 맞게 업로드 가능합니다.");
								return false;
						}
					}
			}

			if (  $(':radio[name="wr_7"]:checked').val() =='음악분야'){
				fileboxv0 = filebox0[0].value;
				if (  $(':radio[name="wr_1"]:checked').val() =='단체'){
					if (! fileboxv0.toLowerCase().match(/.(zip)$/i)) {
							alert("단체일경우 파일은 zip 파일로 형식에 맞게 업로드 가능합니다.");
							return false;
					}
				}else{
					if (! fileboxv0.toLowerCase().match(/.(wmv|mpeg|avi|mp4)$/i)) {
							alert("파일은 wmv, mpeg, avi, mp4 파일로 형식에 맞게 업로드 가능합니다.");
							return false;
					}
				}
			}


			if (  $(':radio[name="wr_1"]:checked').val() =='팀'){
				filebox1 = document.getElementsByName('bf_file[1]');
				fileboxv1 = filebox1[0].value;
				if (filebox1[0].value==""){
					alert('팀 접수양식 파일을 업로드하여주세요.'); 
					return false;
				}
				if (! fileboxv1.toLowerCase().match(/.(xls|xlsx)$/i)) {
					alert("팀 접수양식 파일은 xls, xlsx 파일로 형식에 맞게 업로드 가능합니다.");
					return false;
				}
			}

			if (  $(':radio[name="wr_1"]:checked').val() =='단체'){
				filebox1 = document.getElementsByName('bf_file[1]');
				fileboxv1 = filebox1[0].value;
				if (filebox1[0].value==""){
					alert('단체 접수 양식 파일을 업로드하여주세요.'); 
					return false;
				}
				if (! fileboxv1.toLowerCase().match(/.(xls|xlsx)$/i)) {
					alert("단체 접수파일은 xls, xlsx 파일로 형식에 맞게 업로드 가능합니다.");
					return false;
				}
			}
		
	
			
				
		}else{ //수정시
			filebox0 = document.getElementsByName('bf_file[0]');
            filebox1 = document.getElementsByName('bf_file[1]');
				if (filebox0[0].value !=""){
				fileboxv0 = filebox0[0].value;

					if (  $(':radio[name="wr_7"]:checked').val() =='미술분야'){
						if (  $(':radio[name="wr_1"]:checked').val() =='단체'){
							if (! fileboxv0.toLowerCase().match(/.(zip)$/i)) {
								alert("단체 접수파일은 zip 파일로 형식에 맞게 업로드 가능합니다.");
								return false;
							}
						}else{
							if (! fileboxv0.toLowerCase().match(/.(jpg|jpeg|png|hwp)$/i)) {
								alert("파일은 jpg, jpeg, png, hwp 파일로 형식에 맞게 업로드 가능합니다.");
								return false;
							}
						}
					}

					if (  $(':radio[name="wr_7"]:checked').val() =='음악분야'){
						if (  $(':radio[name="wr_1"]:checked').val() =='단체'){
							if (! fileboxv0.toLowerCase().match(/.(zip)$/i)) {
									alert("단체 접수파일은 zip 파일로 형식에 맞게 업로드 가능합니다.");
									return false;
							}
						}else{
							if (! fileboxv0.toLowerCase().match(/.(wmv|mpeg|avi|mp4)$/i)) {
									alert("파일은 wmv, mpeg, avi, mp4 파일로 형식에 맞게 업로드 가능합니다.");
									return false;
							}
						}
					}
					
				}

			if (filebox1[0].value !=""){
					if (  $(':radio[name="wr_1"]:checked').val() =='팀'){
						filebox1 = document.getElementsByName('bf_file[1]');
						fileboxv1 = filebox1[0].value;
						if (! fileboxv1.toLowerCase().match(/.(xls|xlsx)$/i)) {
							alert("팀 접수양식 파일은  xls, xlsx 파일로 형식에 맞게 업로드 가능합니다.");
							return false;
						}
					}


					if (  $(':radio[name="wr_1"]:checked').val() =='단체'){
						filebox1 = document.getElementsByName('bf_file[1]');
						fileboxv1 = filebox1[0].value;
						if (! fileboxv1.toLowerCase().match(/.(xls|xlsx)$/i)) {
							alert("단체 접수파일은 xls, xlsx  파일로 형식에 맞게 업로드 가능합니다.");
							return false;
						}
					}

			}
		}

		if (  $(':radio[name="wr_1"]:checked').val() =='단체'){
			if (f.wr_14.value == "") {
				alert("작품수를 입력해 주세요.");
				f.wr_14.focus();
				return false;
			}
		}

		if (  !$("#agree_id").is(":checked") )
		{
			alert('개인정보 취급방침에 동의하셔야 합니다.');
			$("#agree_id").focus();
			return false;
		}

		if ( !$("#agree_id2").is(":checked") )
		{
			alert('저작권안내 방침에 동의하셔야 합니다.');
			$("#agree_id2").focus();
			return false;
		}


		if (f.wr_password.value.length <6) {
			alert("비밀번호는 6자 이상으로 입력해 주세요.");
			f.wr_password.focus();
			return false;
		}

		if (f.wr_password2.value.length <6) {
			alert("비밀번호는 6자 이상으로 입력해 주세요.");
			f.wr_password2.focus();
			return false;
		}

		if (f.wr_password.value != f.wr_password2.value) {
				alert("비밀번호가 서로 다릅니다.");
				f.wr_password2.focus();
				return false;
		}


		/*
		if ( '<?=$w?>' != 'u' && $(':radio[name="wr_1"]:checked').val() =='개인'){
			if(!confirm('개인으로 등록시 기존에 추가등록했던 팀원정보는 삭제됩니다. 계속 진행하시겠습니까?')){
				return false;
			}
		}
		*/
		
		
		
		$("#upload_msg").show(); // 안내문구

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

        <?php //echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
		
		
        document.getElementById("btn_submit").disabled = "disabled";

		
		//$(".btn_confirm").hide(); // 글쓰기버튼 제거
		
		return true;
       // return true;
    }


function chkClick(a){
	if(a.value =='N'){
		alert('개인정보수집 동의에 체크해주세요.');
	}
   var obj = document.getElementsByName("agree_it");
	for(var i=0; i<obj.length; i++){
		if(obj[i] != a){
			obj[i].checked = false;
		}
	}
 } 

function chkClick2(a){
	if(a.value =='N'){
		alert('저작권안내 동의에  체크해주세요.');
	}
   var obj = document.getElementsByName("agree_it2");
	for(var i=0; i<obj.length; i++){
		if(obj[i] != a){
			obj[i].checked = false;
		}
	}
 } 


function set_mail(val){
	if (val =='')
	{
		fwrite.wr_email3.value="";
		fwrite.wr_email3.focus();
	}else{
		fwrite.wr_email3.value = fwrite.wr_email2.value;
	}
}




if ( '<?=$w?>' == 'u')
{
	part_it('<?=$write[wr_7]?>');
	stat_it('<?=$write[wr_1]?>');
	$('input:radio[name=wr_4]:input[value=<?=$write[wr_4]?>]').attr("checked", true); //초기화후 재세팅

	$("input[name='wr_7']").attr('disabled',true);
	$("input[name='wr_1']").attr('disabled',true);
	$("input[name='wr_4']").attr('disabled',true);
	$("input[name='wr_5']").attr('disabled',true);
	$('#agree_id').attr('checked', true);
	$('#agree_id2').attr('checked', true);
}



function stat_it(val){
	if (val == '개인' || val == '단체')
	{
		if ( '<?=$w?>' == ''){
			if(!confirm('개인 혹은 단체로 변경시 등록된 팀원정보가 삭제됩니다.\n\n계속 하시겠습니까?')){
				$('input[name=wr_1]:eq(1)').attr('checked', 'checked');
				return false;
			}
		}
		// 팀명.팀원수 제거
		$("#wr_8").val("");
		$("#wr_10").val("");
		$("#sit_ov_btn3").hide();
	}else{
		$("#sit_ov_btn3").show();
	}
	  $(".su").hide();
	  $(".files").hide();
	  $(".files_txt").hide();
	  $(".files_txt2").hide();
	  $("#bf_file").val("");
	  if (val == '팀'){
		  $(".files").show();
		  $(".files_txt").eq(0).show();
		  $(".files_txt2").eq(0).show();
	  }
	  if (val == '단체'){
		  $(".files").show();
		  $(".files_txt").eq(1).show();
		  $(".files_txt2").eq(1).show();
		  $(".su").show();
	  }
}


function part_it(val){
		$('.wr_4').attr('checked', false);
		$(".art2").hide();
	if (val == '미술분야'){
		$(".music").hide();
		$(".art").show();
		$(".art2").show(); //규격
		$(".filetxt").hide();
		$(".filetxt").eq(0).show();
	}else if(val == '음악분야'){
		$(".music").show();
		$(".art").hide();
		$(".art2").hide(); //규격
		$(".filetxt").hide();
		$(".filetxt").eq(1).show();
		$("#wr_12").val("");
	}
}


$('input[id=files2]').change(function(){

		if($(this).val() != ""){
			// 확장자 체크
			var ext = $(this).val().split(".").pop().toLowerCase();
			if($.inArray(ext, ["jpg"]) == -1){
				alert("jpg 파일만 업로드 해주세요.");
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
					alert(this.files[i].name + "(이)가 용량 500MB를 초과했습니다\n\n" + fSMB + "MB / " + mSMB + "MB");
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



	  // 글자수 체크
    function chkCharLen(el,type){
        //alert(type);
        if(type == "title") {
            $(el).parent().find('span1').html('(' + el.value.length + '자 입력)');
            if(el.value.length>500) {
                alert('500글자 이하로 입력하여 주세요.');
                el.value = el.value.substring(0,500);  
                $(el).parent().find('span1').html('(' + el.value.length + '자 입력)');
                return;
            }
        } else if(type == "contents") {
            $(el).parent().find('span2').html('(' + el.value.length + '자 입력)');
            if(el.value.length>500) {
                alert('500글자 이하로 입력하여 주세요.');
                el.value = el.value.substring(0,500);
                $(el).parent().find('span2').html('(' + el.value.length + '자 입력)');
                return;
            }
        }
    }

    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->