<?
include_once("./_common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
?>
<script src="http://young2.iceserver.co.kr/js/jquery-1.12.4.min.js?ver=191202"></script>


<a href="javascript:;" onClick="tab_it2('<?=$Ymd?>', '서울')">서울</a>
<a href="javascript:;" onClick="tab_it2('<?=$Ymd?>', '인천')">인천</a>
<a href="javascript:;" onClick="tab_it2('<?=$Ymd?>', '부산')">부산</a>





<div class="sch_list" id="favorite_it2"></div>


<script>

function tab_it2(Ymd, area){
	//ajax load


	$("#favorite_it2").load('./ball_list.php?Ymd='+Ymd+'&area='+area);
}

$(document).ready(function() {
	var area = encodeURI('서을');
	tab_it2('<?=$Ymd?>', area);
});
</script>


<?
include_once(G5_THEME_PATH.'/tail.php');
?>