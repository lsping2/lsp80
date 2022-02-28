<? // m3cron ver 1.11
include_once("./_common.php");
include_once(G5_PATH.'/lib/m3cron.lib.php');

// 권한
if($member[mb_level]<10) alert("권한이 없습니다.");

// 저장하기
if($func=="u") {
	$descript = htmlspecialchars(trim($descript));
	sql_query("update `$m3cron[config_table]` set descript='$descript', type='$type', d='$d', w='$w', h='$h', robot='$robot', status='$status' where name='$name' LIMIT 1");
	header("location: ./m3cron_list.php");
	die();
}

// 변수 확인
if(!$name) die();

// 불러오기
$prog = sql_fetch("select * from `$m3cron[config_table]` where name='$name'");
if(!$prog) alert("내용이 존재하지 않는 파일입니다.");

include_once("admin.head.php");
?>
<style>
#m3cron_edit td {padding:3px;}
</style>
<h1>m3cron 관리자</h1>
<form action="<?=$_SERVER[PHP_SELF]?>" method="post">
<input type="hidden" name="func" value="u" />
<input type="hidden" name="name" value="<?=$prog[name]?>" />
<table id="m3cron_edit">
<tr>
	<td>파일명</td>
	<td><?=$prog[name]?></td>
</tr><tr>
	<td>파일 설명</td>
	<td><input type="text" name="descript" value="<?=$prog[descript]?>" size="50" /></td>
</tr><tr>
	<td>실행주기</td>
	<td><select name="type">
	<? foreach($type_arr as $type) {
		echo "<option value=\"$type\"";
		if($type == $prog[type]) echo " selected";
		echo ">$type</option>";
	}?></select> <b>monthly</b>: 한달에 한 번, <b>weekly</b>: 일주일에 한 번, <b>daily</b>: 하루에 한 번, <b>hourly</b>: n시간마다 한 번</td>
</tr><tr>
	<td>date of month</td>
	<td><select name="d">
	<? for($i=1; $i<=28; $i++) {
		echo "<option value=\"$i\"";
		if($i == $prog[d]) echo " selected";
		echo ">$i</option>";
	}?></select> <b>monthly</b>: 며칠날 실행할 것인지</td>
</tr><tr>
	<td>day of week</td>
	<td><select name="w">
	<? for($i=0; $i<7; $i++) {
		echo "<option value=\"$i\"";
		if($i == $prog[w]) echo " selected";
		echo ">{$day_arr[$i]}</option>";
	}?></select> <b>weekly</b>: 무슨 요일에 실행할 것인지</td>
</tr><tr>
	<td>hour</td>
	<td><select name="h">
	<? for($i=0; $i<=23; $i++) {
		echo "<option value=\"$i\"";
		if($i == $prog[h]) echo " selected";
		echo ">$i</option>";
	}?></select> <b>monthly</b>, <b>weekly</b>, <b>daily</b>: 몇시에 실행할 것인지, <b>hourly</b>: 몇시간마다 실행할 것인지 (0 = 매번 실행)</td>
</tr><tr>
	<td>로봇 실행</td>
	<td><input type="checkbox" name="robot"<?=$prog[robot]?" checked":""?> value="1" /> 체크하면 로봇이 접속한 경우만 실행 (실행시간이 길면 사람은 중간에 창을 닫을 수 있음)</td>
</tr><tr>
	<td>실행 여부</td>
	<td><input type="checkbox" name="status"<?=$prog[status]?" checked":""?> value="1" /> 체크 해제하면 실행 안함</td>
</tr><tr>
	<td colspan="2"><input type="submit" value="저장하기" accesskey="s" title="alt+s" /> <input type="button" value="목록" onclick="location.href='./m3cron_list.php'" accesskey="l" title="alt+l" /></td>
</tr>
</table>
</form>
<?
include_once("admin.tail.php");
?>