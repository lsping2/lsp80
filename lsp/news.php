<?
require_once "./menu/include/include.php";
?>


<?
$db = new mysql();
 
$query = "SELECT	 bbs_uid,subject FROM	notice_bbs";
$db->query( $query );

$loop="0";
$half = round($db->total_record()/2);
?>
<? while( $loop<$db->total_record() ) : ?>
		
	<div id="meIt_<?=$loop?>" <? if ($loop > 0):?> style="display:none"  <?endif?> >

		<? for($i=0; $i<2; $i++ ) :?>
		<?
			$db->fetch();	
			$subject		= htmlspecialchars( $db->result( 'subject' ) );
			$bbs_uid	  =  $db->result( 'bbs_uid' );
		?>
				<div>. <a href='?bbs_uid=<?=$bbs_uid?>'><?=$subject?></a></div>
		<? endfor ?>
		<?
			$loop++;
		?>
	</div>


<? endwhile?>
<br>
	<div class="move">
		<a href="javascript:showPrevMItem()"><img src="/img/btn_left.gif" width="13" height="14" alt="이전"></a>					
		<a href="javascript:showNextMItem()"><img src="/img/btn_right.gif" width="13" height="14" alt="다음"></a>
	</div>



<script type="text/javascript">
var msize = "<?=$half?>";
var mcur = 0

var mLastSwapTime = 0
var mAutoSwapTime = -1 

function showNextMItem() {
 var newIdx = mcur + 1;
 if (newIdx >= msize) newIdx = 0;
 swapMItems(mcur, newIdx);
}

function showPrevMItem() {
 var newIdx = mcur - 1;
 if (newIdx < 0) newIdx = msize - 1;
 swapMItems(mcur, newIdx);
}

function swapMItems(oldIdx, newIdx) {
 window.document.getElementById('meIt_' + oldIdx).style.display='none';
 window.document.getElementById('meIt_' + newIdx).style.display='inline';
 mcur = newIdx
 mLastSwapTime = new Date().getTime();
}

function autoShowNextMItem() {
 if (mAutoSwapTime < 0 || mAutoSwapTime == mLastSwapTime) {
  showNextMItem();
 }
 mAutoSwapTime = mLastSwapTime
}

setInterval("autoShowNextMItem()", 2000);

</script>