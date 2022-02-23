<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script>
function change_it(s_div,sbjt){
	sbjt = encodeURI(sbjt);
	$("#favorite_it").load('area_sub.php?sido='+ sbjt);

}

 function fwrite_submit(f){

	 //구군
		var isCheck = $('.gugun_val').is(':checked') ? 1 : 0;
		if ( isCheck == 0 )
		{
			alert('모집분야를 선택해주세요.');
			 return false;
		}
		var f =  document.fwrite; 
		var items = f['gugun_val'];
		var gugun = "";
		for ( var i=0; i<items.length; i++ ) {
			if ( items[i].checked ==true ) {
				gugun += items[i].value;
				gugun += ",";
			}
		}
		gugun=gugun.substring(0, gugun.lastIndexOf(","));
		f.gugun.value = gugun;



		var items2 = f['dong_val'];
		var dong = "";
		for ( var i=0; i<items2.length; i++ ) {
			if ( items2[i].checked ==true ) {
				dong += items2[i].value;
				dong += ",";
			}
		}
		dong=dong.substring(0, dong.lastIndexOf(","));
		f.dong.value = dong;
}

</script>

  <title>Document</title>
 </head>
 <body>
  <div class="sub_roadmap" style="border:1px solid #d9d9d9">
	<ul>
		<li class="part1"><a href="javascript:change_it(1,'서울');">서울</a></li>
		<li class="part2"><a href="javascript:change_it(2,'경기')">경기</a></li>
		<li class="part3"><a href="javascript:change_it(3,'제주')">제주</a></li>
	
	</ul>
</div>

<form name="fwrite" id="fwrite" action="/area_exec.php" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
<input type="text" name="gugun" size="60"><br><br>
<input type="text" name="dong" size="60">
<div id="favorite_it"></div>



<div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
    </div>
</form>
 </body>
</html>
