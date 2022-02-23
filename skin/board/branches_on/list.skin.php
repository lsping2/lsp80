<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script src="'.$board_skin_url.'/d3.min.js"></script>', 0);
?>
<!-- <h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>==?

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
	<div class="cate_map_wrap">
	<?php include_once('branches.map.php');?>
	<div class="cate_search_wrap">
<!-- 게시판 검색 시작 { -->
      <h1>매장찾기</h1>
<fieldset id="bo_sch">
	<h2>01. 주소/매장명 검색</h2>
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>매장명</option>
        <option value="wr_1"<?php echo get_selected($sfl, 'wr_1'); ?>>주소</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" size="15" maxlength="20">
    <input type="submit" value="검색" id="btn_submit" class="btn_submit">
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
		<h2>02. 시도별 매장안내</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
	</div>
	</div> <!-- cate_map_wrap 끝-->
    <!-- } 게시판 카테고리 끝 -->

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <?php if ($is_checkbox) { ?>
            <th scope="col">
                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            </th>
            <?php } ?>
            <th scope="col">지역</th>
            <th scope="col">매장명</th>
            <th scope="col">주소</th>
            <th scope="col">전화번호</th>
            <th scope="col">상세보기</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
         ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
            <?php if ($is_checkbox) { ?>
            <td class="td_chk">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            </td>
            <?php } ?>
            <td class="td_date"><?php echo $list[$i]['ca_name'] ?></td>
            <td class="td_date"><?php echo $list[$i]['wr_subject'] ?></td>
            <td class="td_subject"><?php echo $list[$i]['wr_1'] ?></td>
            <td class="td_date"><?php echo $list[$i]['wr_2'] ?></td>
            <td class="td_date"><a href="<?php echo $list[$i]['href'] ?>">자세히보기</a></td>
        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>


<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}


  /*가맹점 지도*/
  $(".cate_map_in svg").mouseover(function(event) {
    var _path = event.target;
    var city_name = _path.id;
	//alert(city_name);
    var new_p = document.createElement('p');
    var province = $(_path).parent()[0].id;
    d3.select(_path).style("fill", "#cbc3ac");
    //console.log(province);
    //console.log(city_name);
  }).mouseout(function(event) {
    var _path = event.target;
    d3.select(_path).style("fill", "#fff");
  });

  function go_branch(city_do) {
    var Arr = Array("sejong","chungnam","jeju","gyeongnam","gyeongbuk","jeonbuk","chungbuk","gangwon","gyeonggi","jeonnam","ulsan","busan","daegu","daejeon","incheon","seoul","gwangju");
    var strArr = Array("세종","충청남도","제주","경상남도","경상북도","전라북도","충청북도","강원도","경기도","전라남도","울산","부산","대구","대전","인천","서울","광주");
    //alert(city_do);
    var idx = Arr.indexOf(city_do);
    //alert(strArr[idx]);
    location.href="./board.php?bo_table=branch&sca="+strArr[idx];
  }

  /*가맹점 지도 색칠*/
  $(document).ready(function(){
    var mapCondition = '<?=$stx?>';
    var mapCondition2 = '<?=$sca?>';
    if (mapCondition == '세종' || mapCondition2 == '세종') {
      $('#sejong').css("fill", "#cbc3ac");
    }else if (mapCondition == '충청남도' || mapCondition2 == '충청남도') {
      $('#chungnam').css("fill", "#cbc3ac");
    }else if (mapCondition =='제주' || mapCondition2 == '제주') {
      $('#jeju').css("fill", "#cbc3ac");
    }else if (mapCondition =='경상남도' || mapCondition2 == '경상남도') {
      $('#gyeongnam').css("fill", "#cbc3ac");
    }else if (mapCondition == '경상북도' || mapCondition2 == '경상북도') {
      $('#gyeongbuk').css("fill", "#cbc3ac");
    }else if (mapCondition =='전라북도' || mapCondition2 == '전라북도') {
      $('#jeonbuk').css("fill", "#cbc3ac");
    }else if (mapCondition =='충청북도' || mapCondition2 == '충청북도') {
      $('#chungbuk').css("fill", "#cbc3ac");
    }else if (mapCondition =='경기도' || mapCondition2 == '경기도') {
      $('#gyeonggi').css("fill", "#cbc3ac");
    }else if (mapCondition == '전라남도' || mapCondition2 == '전라남도') {
      $('#jeonnam').css("fill", "#cbc3ac");
    }else if (mapCondition =='울산' || mapCondition2 == '울산') {
      $('#ulsan').css("fill", "#cbc3ac");
    }else if (mapCondition =='부산' || mapCondition2 == '부산') {
      $('#busan').css("fill", "#cbc3ac");
    }else if (mapCondition == '대구' || mapCondition2 == '대구') {
      $('#daegu').css("fill", "#cbc3ac");
    }else if (mapCondition =='대전' || mapCondition2 == '대전') {
      $('#daejeon').css("fill", "#cbc3ac");
    }else if (mapCondition =='인천' || mapCondition2 == '인천') {
      $('#incheon').css("fill", "#cbc3ac");
    }else if (mapCondition =='서울' || mapCondition2 == '서울') {
      $('#seoul').css("fill", "#cbc3ac");
    }else if (mapCondition =='광주' || mapCondition2 == '광주') {
      $('#gwangju').css("fill", "#cbc3ac");
    }
});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->


<div id="map" style="width:100%;height:350px;"></div>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=b3f856bba74b2366109f98fcedf178b8&libraries=services"></script>

<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div  
    mapOption = { 
        center: new daum.maps.LatLng(37.624883, 127.071759), // 지도의 중심좌표
        level: 10// 지도의 확대 레벨
    };

var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
 
// 마커를 표시할 위치와 내용을 가지고 있는 객체 배열입니다 


var positions = [
    {
        content: '<div>서울 공릉점</div>', 
        latlng: new daum.maps.LatLng(37.624883, 127.071759)
    },
    {
        content: '<div>서울 태릉점</div>', 
        latlng: new daum.maps.LatLng(37.617871, 127.075354)
    },
    {
        content: '<div>서울 논현</div>', 
        latlng: new daum.maps.LatLng(37.511083, 127.020824)
    }
];

for (var i = 0; i < positions.length; i ++) {
    // 마커를 생성합니다
    var marker = new daum.maps.Marker({
        map: map, // 마커를 표시할 지도
        position: positions[i].latlng // 마커의 위치
    });

    // 마커에 표시할 인포윈도우를 생성합니다 
    var infowindow = new daum.maps.InfoWindow({
        content: positions[i].content // 인포윈도우에 표시할 내용
    });

    // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
    // 이벤트 리스너로는 클로저를 만들어 등록합니다 
    // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
    daum.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
    daum.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
}

// 인포윈도우를 표시하는 클로저를 만드는 함수입니다 
function makeOverListener(map, marker, infowindow) {
    return function() {
        infowindow.open(map, marker);
    };
}

// 인포윈도우를 닫는 클로저를 만드는 함수입니다 
function makeOutListener(infowindow) {
    return function() {
        infowindow.close();
    };
}

</script>