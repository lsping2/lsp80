<!doctype html>
 <head>
 <meta charset="utf-8">
<script src="/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/js/sojaeji.js"></script>
  <title>Document</title>
 </head>
 <body>
 <form name="fwrite" id="fwrite" action="/area_new_exec.php" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
  <table>
  <tr>
	<th>주소</th>
	<td>
		<select name="mb_addr1" id="sido"></select>
		<select name="mb_addr2" id="gugun"></select>
		<select name="mb_addr3" id="dong"></select>
	<input type="text" name="wr_4" id="wr_4" required class="bowrite_in" style="width:18%;" placeholder="나머지 주소">
	</td>				
</tr>			
</table>

<div class="btn_confirm">
	<input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
	<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
</div>

</form>


 </body>

<script>
$(document).ready(function(){
	var s = new sojaeji('sido', 'gugun', 'dong');
    s.update_all("부산","북구","금곡동");
 });
</script>

</html>
