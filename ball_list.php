<?
include_once("./_common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
?>
<script src="http://young2.iceserver.co.kr/js/jquery-1.12.4.min.js?ver=191202"></script>

<?
 echo $sql = " 
	select	*
	from		 ball 
	where	where fdate = '$Ymd'
	and		area = '$area'
	";
$result = sql_query($sql);
?>


<?
include_once(G5_THEME_PATH.'/tail.php');
?>