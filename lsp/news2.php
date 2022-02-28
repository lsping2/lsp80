



	
	
		
		
			<div id="meIt_0">
		
				<div class="thumb"><img src="http://static2.me2day.net/images/user/spotlight21c/profile.png?1256945296" width="44" height="44" alt="미투데이친구"></div>
				<div class="group">
					<p class="post"><a href='http://doday.net'>김경민</a>입니다. <span class="mechin">K</span></p>
			<!-- 
			
					<span class="tag"><a target="_blank" href="http://me2day.net/tag/deview">deview</a> </span>
			
			-->
				</div>
			</div>
		
	
		
		
			<div id="meIt_1" style="display:none">
		
				<div class="thumb"><img src="http://static1.me2day.net/images/user/0kmingi0/profile.png?1259391917" width="44" height="44" alt="미투데이친구"></div>
				<div class="group">
					<p class="post">252525252; <span class="mechin">골방철학자</span></p>
			<!-- 
			
					<span class="tag"><a target="_blank" href="http://me2day.net/tag/me2sms">me2sms</a> </span>
			
			-->
				</div>
			</div>
		
	
		
		
			<div id="meIt_2" style="display:none">
		
				<div class="thumb"><img src="http://static1.me2day.net/images/user/anon_3fa24a4e70fe26d9e4543764b35ecc64/profile.png?1259391917" width="44" height="44" alt="미투데이친구"></div>
				<div class="group">
					<p class="post">523424 <span class="mechin">3924</span></p>
			<!-- 
			
					<span class="tag"><a target="_blank" href="http://me2day.net/tag/me2sms">me2sms</a> </span>
			
			-->
				</div>
			</div>
		
	
		
		
			</div>
		
	
			<div class="move">
				<a href="javascript:showPrevMItem()"><img src="/img/btn_left.gif" width="13" height="14" alt="이전"></a>					
				<a href="javascript:showNextMItem()"><img src="/img/btn_right.gif" width="13" height="14" alt="다음"></a>
			</div>
			
		</div>
	
		


<script type="text/javascript">
var msize = 3;
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

setInterval("autoShowNextMItem()", 3000);

</script>

</body>
</html>