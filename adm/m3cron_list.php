<? // m3cron ver 1.10
include_once("./_common.php");
include_once(G5_PATH.'/lib/m3cron.lib.php');
include_once("admin.head.php");

// DB 없으면 생성
sql_query( "CREATE TABLE IF NOT EXISTS `$m3cron[config_table]` (
	`name` VARCHAR( 50 ) NOT NULL ,
	`descript` VARCHAR ( 255 ) NOT NULL ,
	`type` VARCHAR( 10 ) NOT NULL ,
	`d` TINYINT NOT NULL ,
	`w` TINYINT NOT NULL ,
	`h` TINYINT NOT NULL ,
	`lastrun` DATETIME NOT NULL ,
	`lastruntime` FLOAT NOT NULL ,
	`status` TINYINT NOT NULL ,
	`robot` TINYINT NOT NULL ,
	UNIQUE ( `name` )
)");

sql_query( "CREATE TABLE IF NOT EXISTS `$m3cron[log_table]` (
	`name` VARCHAR( 50 ) NOT NULL ,
	`datetime` DATETIME NOT NULL ,
	`runtime` FLOAT NOT NULL ,
	`ip` CHAR( 15 ) NOT NULL ,
	`robot` TINYINT NOT NULL ,
	`mb_id` VARCHAR( 50 ) NOT NULL ,
	INDEX (  `name` ,  `datetime` )
)" );
?>

<style>
#m3cron_div {line-height:1.6;}
.title_tr th { background-color:#FBF8EE; padding:5px; font-weight:700; color:#616161; height:30px; text-align:center; font-size:9pt; border-top:solid 2px #CCC; border-bottom: solid 1px #CCC; }
.m3cron_tbl {text-align:center; width:100%; border-bottom:solid 2px #CCC; border-collapse:collapse;}
.align_r {text-align:right;}
.inactive td {color:#CCC;}
.on {color:#3C3;}
.off {color:#C33;}
.pale {color:#CCC;}
</style>

<div id="m3cron_div">

<h1>m3cron 관리자</h1>

<?
echo "-->".$m3cron[path];
// 존재하는 파일 목록 가져오기
if (is_dir($m3cron[path])) {
	// php 파일 include
	$dir = dir($m3cron[path]);
	while ($entry = $dir->read()) {
		if(preg_match('/\.php$/i', $entry)) $m3cron['list'][] = $entry;
	}
}

// 이하는 m3cron 폴더에 파일이 있을 경우에만 실행
if($m3cron['list']) {

	// m3cron_config에 있지만 파일이 없는 놈들은 삭제
	$query = sql_query("select name from `$m3cron[config_table]`");
	while($row = sql_fetch_array($query)) {
		if(!in_array($row[name], $m3cron['list'])) sql_query("delete from `$m3cron[config_table]` where name='$row[name]' limit 1");
	}

	// m3cron_config에 입력하기. 에러 무시하면 unique가 걸려있으므로 새로운 녀석들만 들어감
	foreach($m3cron['list'] as $name) {
		@mysql_query("insert into `$m3cron[config_table]` set name='$name'");
	}

	// 목록 보이기 시작
	$query = sql_query("select * from `$m3cron[config_table]`");
	$cnt = mysql_num_rows($query);
	$temp = sql_fetch("select count(*) as cnt2 from `$m3cron[config_table]` where status='1'");
	$cnt2 = $temp[cnt2];
	$temp = sql_fetch("select count(*) as cnt3 from `$m3cron[config_table]` where status!='1'");
	$cnt3 = $temp[cnt3];
?>
총 프로그램 : <?=$cnt?> 개, <span class="on">실행 중 : <?=$cnt2?> 개</span>, <span class="off">비활성화 : <?=$cnt3?> 개</span><br />

<table class="m3cron_tbl">
<tr class="title_tr">
	<th>파일</th>
	<th width="40">주기</th>
	<th width="40">일</th>
	<th width="40">요일</th>
	<th width="40">시</th>
	<th width="100">마지막 실행</th>
	<th width="90">실행시간</th>
	<th width="50">로봇</th>
	<th width="50">상태</th>
	<th width="50">수정</th>
</tr>
<?	// 루프 돌리기
	while($prog = sql_fetch_array($query)) { ?>
<tr class="list<?=$list?> ht<?=$prog[status]?"":" inactive"?>">
	<td><span title="<?=$prog[descript]?>"><?=$prog[name]?></span></td>
	<td><?=$prog[type]?></td>
	<td<?=$prog[type]=="monthly"?"":" class='pale'"?>><?=$prog[d]?></td>
	<td<?=$prog[type]=="weekly"?"":" class='pale'"?>><?=$day_arr[$prog[w]]?></td>
	<td><?=$prog[h]?></td>
	<td><?=$prog[lastrun]?></td>
	<td class="align_r"><?=sprintf("%.3f", $prog[lastruntime]*1000)?> msec</td>
	<td><?=$robot_arr[$prog[robot]]?></td>
	<td><span class="<?=$status_arr[$prog[status]]?>"><?=$status_arr[$prog[status]]?></span></td>
	<td><a href="./m3cron_edit.php?name=<?=urlencode($prog[name])?>"><img src='./img/icon_modify.gif' title="설정 수정" /></a>
</td></tr>
<? $list=$list?0:1;
	} ?>
</table>
</div>
<? } 
include_once("admin.tail.php");
?>