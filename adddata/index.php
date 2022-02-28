<?
include_once('../common.php');
?>
<script src="http://lsp80.cafe24.com/js/jquery-1.8.3.min.js"></script>
<?

$sql = " select count(*) as total from User_Info";
$row = sql_fetch($sql);
$total = $row['total'];

if ( !$start) $start =0; 
$sql = " select * from User_Info limit 0, 2";
$result = sql_query($sql);
 for($i=0; $i<$row=sql_fetch_array($result); $i++)  {
	$list_append .=  "<li>".$row[user_id]."</li><br>"; 
 }
 echo $list_append;
?>

<div id="appendbox"></div> 


 <div class="li_more" style="display:none"> 
        <p id="item_load_msg"><img src="http://hbj.co.kr/mobile/shop/img/loading.gif" alt="로딩이미지" ><br>잠시만 기다려주세요.</p>  
   </div> 

	<div class="li_more_btn"> 
		<button type="button" onClick="append_list()" >더보기</button> 
	</div> 


<script> 


var start=2; 
var list = '2'; 
var loop=0;
function append_list(){ 
	$.post('data.php',{start:start,list:list},function(data){ 
		$("#appendbox").append(data); 
		start +=2; 
		loop +=2;
		$(".li_more").show(); 
		setTimeout(function(){ 
			$(".li_more").hide(); 
		},100); 

		if( loop > '<?=(int)$total?>')  {
			$(".li_more_btn").hide(); 
		}
	}); 
	
} 

</script> 
