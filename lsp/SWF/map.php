
<?
	$link_url = "http://bigstar.inckorea.net/bbs/board.php?bo_table=$bo_table&ptype=$ptype";
	
	if( $s3 == "" ){ $s3 = "8"; }
	if( $s4 == "" ){ $s4 = ""; }
?>

<script>

function urlencode(str) {
	  str = (str + '')
	    .toString();

	  return encodeURIComponent(str)
	    .replace(/!/g, '%21')
	    .replace(/'/g, '%27')
	    .replace(/\(/g, '%28')
	    .
	  replace(/\)/g, '%29')
	    .replace(/\*/g, '%2A')
	    .replace(/%20/g, '+');
}

function testFc(p1,p2,p3,p4,p5){
	//alert(typeof(p1));
	var get_p1 = String(p1);
	/* 구 선택 */
	if( get_p1.indexOf(",") > 0 ){
		var get_p1_array = get_p1.split(",");

		/* 구 선택 */
		if( get_p1_array.length == 4 ){
			location.href="<?=$link_url?>&s1="+urlencode(get_p1_array[0])+"&s2="+urlencode(get_p1_array[1])+"&s3="+get_p1_array[2]+"&s4="+get_p1_array[3]+"&mv=1&mp=1";
		}
	}
	/* 시 선택 */
	else{

		if( get_p1 == "강원도" ){
			var s3 = "0";
		}else if( get_p1 == "경기도" ){
			var s3 = "1";
		}else if( get_p1 == "경상남도" ){
			var s3 = "2";
		}else if( get_p1 == "경상북도" ){
			var s3 = "3";
		}else if( get_p1 == "광주광역시" ){
			var s3 = "4";
		}else if( get_p1 == "대구광역시" ){
			var s3 = "5";
		}else if( get_p1 == "대전광역시" ){
			var s3 = "6";
		}else if( get_p1 == "부산광역시" ){
			var s3 = "7";
		}else if( get_p1 == "서울특별시" ){
			var s3 = "8";
		}else if( get_p1 == "울산광역시" ){
			var s3 = "9";
		}else if( get_p1 == "인천광역시" ){
			var s3 = "10";
		}else if( get_p1 == "전라남도" ){
			var s3 = "11";
		}else if( get_p1 == "전라북도" ){
			var s3 = "12";
		}else if( get_p1 == "제주시" ){
			var s3 = "13";
		}else if( get_p1 == "충청남도" ){
			var s3 = "14";
		}else if( get_p1 == "충청북도" ){
			var s3 = "15";
		}

		location.href="<?=$link_url?>&s1="+urlencode(get_p1)+"&s2=&s3="+s3+"&s4=&mv=1&mp=1";

	}
}

</script>

<script src=/SWF/flashObject.js></script>
<div style="text-align: center;">
	<script>flashObject("map_korea_detail.swf","stateNum=<?=$s3?>&cityNum=<?=$s4?>","740","332")</script>
</div>

<?

if(!$mp == 1){
?>
<!-- } 게시판 목록 끝 -->
</div>

</div>
</div>

		
<?
//include_once (G5_PATH . '/tail.php');
}
?>