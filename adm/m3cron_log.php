<? // m3cron ver 1.10
include_once("./_common.php");
include_once(G5_PATH.'/lib/m3cron.lib.php');
include_once("admin.head.php");
?>

<h1>m3cron 실행 기록</h1>

<style>
.title_tr th { background-color:#FBF8EE; padding:5px; font-weight:700; color:#616161; height:30px; text-align:center; font-size:9pt; border-top:solid 2px #CCC; border-bottom: solid 1px #CCC; }
.m3cron_tbl {text-align:center; width:100%; border-bottom:solid 2px #CCC; border-collapse:collapse;}
.align_r {text-align:right;}
.inactive {text-decoration:line-through;}
</style>

<?
// 파일명 지정된 경우 "전체 파일 로그 보기" 링크
if($name) echo "<a href=\"$_SERVER[PHP_SELF]\">전체 파일 로그 보기</a><br />";
?>

<table class="m3cron_tbl">
<tr class="title_tr">
	<th>파일</th>
	<th>실행</th>
	<th>실행시간</th>
	<th>ip</th>
	<th>로봇</th>
	<th>mb_id</th>
</tr>
<?
// 파일명 지정시 조건문 만들기
if($name) {
	str_replace(array("\"", "\'"), "", $name); // 주사지랄방지
	$where = "where name = '$name'";
}
// 로그 가져오기
$cut = 20;
$temp = sql_fetch("select count(*) as cnt from `$m3cron[log_table]` $where");
$total_rows = $temp[cnt];
$max_page = ceil($total_rows / $cut);
if(!$max_page) $max_page = 1;
if(!$page) $page = 1;
if($page > $max_page) $page = $max_page;
$cur_max_page = ceil($page / 10) * 10;
$cur_min_page = $cur_max_page - 9;
if($cur_max_page > $max_page) $cur_max_page = $max_page;
$limit = ($page - 1) * $cut;
$query = sql_query("select * from `$m3cron[log_table]` $where order by datetime DESC limit $limit, $cut");
while($row = sql_fetch_array($query)) {
?>
<tr class="list<?=$list?> ht">
	<td><a href="<?=$_SERVER[PHP_SELF]?>?name=<?=$row[name]?>"><?=$row[name]?></a></td>
	<td><?=$row[datetime]?></td>
	<td class="align_r"><?=sprintf("%.3f", $row[runtime]*1000)?> msec</td>
	<td><?=$row[ip]?></td>
	<td><?=$row[robot]?></td>
	<td><?=$row[mb_id]?></td>
</tr>
<?
$list=$list?0:1;
}
?>
</table>
<?
if($cur_min_page > 10) echo "<a href='$_SERVER[PHP_SELF]?page=".($cur_min_page-1)."&name=$name'>[Prev]</a> ";
for($i=$cur_min_page; $i<=$cur_max_page; $i++) {
	if($i == $page) echo "<a href='$_SERVER[PHP_SELF]?page=$i&name=$name'><b>[{$i}]</b></a> ";
	else echo "<a href='$_SERVER[PHP_SELF]?page=$i&name=$name'>[{$i}]</a> ";
}
if($cur_max_page < $max_page) echo "<a href='$_SERVER[PHP_SELF]?page=".($cur_max_page+1)."&name=$name'>[Next]</a> ";

include_once("./admin.tail.php");
?>