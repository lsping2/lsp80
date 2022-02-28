<meta charset="utf-8">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
function change_it(key){
	//ajax load
	$("#favorite_it").load('ss.php?key='+key+'&ver=<?=date("YmdHis")?>') ;
}


$(document).ready(function(){ 
// onload 대신
});

</script>

<a href="javascript:;" onCLick="change_it('3')">저장</a>

<div id="favorite_it"></div>




