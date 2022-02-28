<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" type="text/css" href="/jsmenu/js18/css/hrBar.css" id="stylesheet" />
<style>

</style>

<script type="text/javascript" src="/jsmenu/js18/js/hrBar.js"></script>

<div id="menu" class="menu mcPurple">
<!-- class="mcPurple | mcViolet | mcOrange | mcGreen | mcGray"-->
	<div class="inset">
		<div class="major">
		<!-- class="major + (m1~m12)"-->
			<ul>
				<li><a href="<?php echo G5_URL?>"><span>메 인</span></a></li>
				<?php
					$sql = " select *
								from {$g5['menu_table']}
								where me_use = '1'
								  and length(me_code) = '2'
								order by me_order, me_id ";
					$result = sql_query($sql, false);
					$gnb_zindex = 999; // gnb_1dli z-index 값 설정용

					for ($i=0; $row=sql_fetch_array($result); $i++) {
						$num=$i+1;
				?>
				<li class="m<?php echo $num?>">
					<a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>">
					  <span><?php echo $row['me_name'] ?></span>
					</a>
					<div class="sub">
						<ul>	
							<?php
							$sql2 = " select *
									from {$g5['menu_table']}
									where me_use = '1'
									  and length(me_code) = '4'
									  and substring(me_code, 1, 2) = '{$row['me_code']}'
									order by me_order, me_id ";
							$result2 = sql_query($sql2);

							for ($k=0; $row2=sql_fetch_array($result2); $k++) {
							?>
							<li>
								<a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>">
									<span><?php echo $row2['me_name'] ?></span>
								</a>
							</li>
							 <?php } ?>	
						</ul>
					</div>					
				</li>
					<?php } ?>			
			</ul>
		</div>
		<div class="aside">
			<ul>
				<li class="m1"><a href="<?php echo G5_BBS_URL?>/content.php?co_id=company"><span>회사소개</span></a></li>
				<li class="m2"><a href="#"><span>정책안내</span></a>
					<div class="sub">
						<ul>
							<li><a href="<?php echo G5_BBS_URL?>/content.php?co_id=privacy"><span>정보방침</span></a></li>
							<li><a href="<?php echo G5_BBS_URL?>/content.php?co_id=provision"><span>이용약관</span></a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
		<span class="gradient"></span>
	</div>
	<span class="shadow"></span>
</div>