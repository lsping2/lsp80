<?

require_once "../../../include/include.php";

require_once "../../login/login_check.php";
login_check( $PHP_SELF );

$cd_order_no = $_POST['cd_order_no'];
if( !$cd_order_no ) $cd_order_no = $_GET['cd_order_no'];



?>
<html>
<head>
<title><?$HTML->Title( 'Admin' )?></title>
<link rel="stylesheet" href="../../admin_style.css" type="text/css">
<script language=javascript>
<!--
	function twinOrderNo( pos )
	{
		form = document.category;
		if( 1 == pos )
		{
			form.reg_cd_order_no2.value = form.reg_cd_order_no.value;
		}
		else if( 2 == pos )
		{
			form.reg_cd_order_no.value = form.reg_cd_order_no2.value;
		}
	}

	function checkSubmit()
	{
		form = document.category;
		form.target = 'category_hidden_frame';
		form.action = 'product_register_exec2.php';
		form.submit();

		form.target = '';
		form.action='<?=$_SERVER['PHP_SELF']?>';
	}

	function checkCategory()
	{
		form = document.category;
		form.target = 'category_hidden_frame';
		form.action='check_category.php';
		form.submit();
		
		form.target = '';
		form.action='<?=$_SERVER['PHP_SELF']?>';
		
	}

	function checkCdInfo()
	{

		form = document.category;
		form.target = '';
		form.action='<?=$_SERVER['PHP_SELF']?>';
		form.submit();		
	}

-->
</script>
</head>
<body>

<form name=category method=post>
<table border=0>
<tr>
	<td valign=top>
	<table width=950 height=28 border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=320>
		<table width=320 border=0 cellpadding=4 cellspacing=2 bgcolor=#AEAE5B>
		<tr bgcolor=#CDCD9A>
			<td align=right>
			CD 주문번호 : <input type=text name=cd_order_no size=15 class=input_text value="<?=$cd_order_no?>">
			<input type=submit value=" CD 등록정보 " class="btn_kr">
			&nbsp;&nbsp;
			</td>
		</tr>
		</table>
		</td>
		<td align=center>
		<input type=button value="    현재 선택된 분류 보기    " class="btn_kr" onClick="checkCategory()">
		</td>
		<td width=320 align=right>
		<table width=320 border=0 cellpadding=4 cellspacing=2 bgcolor=#AEAE5B>
		<tr bgcolor=#CDCD9A>
			<td align=right>
			CD 주문번호 : <input type=text name=reg_cd_order_no size=15 class=input_text onChange="twinOrderNo('1')" value="<?=$cd_order_no?>">
			<input type=button value="    등록    " class="btn_kr" onClick="checkSubmit()">
			&nbsp;&nbsp;
			</td>
		</tr>
		</table>
		</td>
	</tr>
	</table>
	<table border=0 height=5><tr><td></td></tr></table>
	<?


	$db = new MYSQL;
	$db2 = new MYSQL;
	$db3 = new MYSQL;
	$db4 = new MYSQL;

	if( $cd_order_no )
	{

		$query = "
						SELECT	cd_no
						FROM	product_cd
						WHERE	cd_order_no = '$cd_order_no'
						AND		use_status = 'Yes'
		";
		$db->query( $query );
		if( !$db->total_record() )
		{
			js_msg( "사용중인 시디 주문번호가 아닙니다." );
		}

		$db->fetch();
		$rs_cd_no = $db->result( 'cd_no' );

	}

	// 기준 분류 번호
	$category_no = 13;

	$query = "
			SELECT	category_gid ,
					category_thread ,
					category_name
			FROM	coowoo.cd_category
			WHERE	category_no = '$category_no'
	";
	$db->query( $query );
	$db->fetch();
	$rs_category_gid		= $db->result( 'category_gid' );
	$rs_category_thread	= $db->result( 'category_thread' );
	$rs_category_name		= $db->result( 'category_name' );

	$thread_length = strlen( $rs_category_thread ) + 3;

	// 첫번째 단계 분류

	$query = "
			SELECT	category_no ,
					category_gid ,
					category_thread ,
					category_name
			FROM	coowoo.cd_category
			WHERE	category_gid = '$rs_category_gid'
			AND		category_thread LIKE '$rs_category_thread%'
			AND		length( category_thread ) = $thread_length
			ORDER BY	category_sort ASC
	";
	$db->query( $query );

	?>
	<table border=0 cellpadding=3 cellspacing=2 bgcolor="#CDCD9A">
	<tr bgcolor="#FFFFFF">
	<? FOR( $loop=0; $loop<$db->total_record(); $loop++ ) : ?>
	<?
		$db->fetch();
		$rs_category_no	= $db->result( 'category_no' );
		$rs_category_gid		= $db->result( 'category_gid' );
		$rs_category_thread	= $db->result( 'category_thread' );
		$rs_category_name		= $db->result( 'category_name' );

		$query = "
				SELECT	*
				FROM	cd_category_link
				WHERE	category_no = '$rs_category_no'
				AND		cd_no = '$rs_cd_no'
		";
		$db4->query( $query );

	?>
		<td width=150 valign=top>
		<input type=checkbox name=category_no[] value="<?=$rs_category_no?>" <? IF( $db4->total_record() ) echo "checked"; ?>><b><?=$rs_category_name?></b></a><br>

			<?

			$query = "
					SELECT	category_gid ,
							category_thread ,
							category_name
					FROM	coowoo.cd_category
					WHERE	category_no = '$rs_category_no'
			";
			$db2->query( $query );
			$db2->fetch();
			$rs_category_gid		= $db2->result( 'category_gid' );
			$rs_category_thread	= $db2->result( 'category_thread' );
			$rs_category_name		= $db2->result( 'category_name' );

			$thread_length = strlen( $rs_category_thread ) + 3;

			
			// 두번째 하위 분류
			$query = "
					SELECT	category_no ,
							category_gid ,
							category_thread ,
							category_name
					FROM	coowoo.cd_category
					WHERE	category_gid = '$rs_category_gid'
					AND		category_thread LIKE '$rs_category_thread%'
					AND		length( category_thread ) = $thread_length
					ORDER BY	category_sort ASC
			";
			$db2->query( $query );

			?>
			<? FOR( $loop2=0; $loop2<$db2->total_record(); $loop2++ ) : ?>
			<?
				$db2->fetch();
				$rs_category_no		= $db2->result( 'category_no' );
				$rs_category_gid		= $db2->result( 'category_gid' );
				$rs_category_thread	= $db2->result( 'category_thread' );
				$rs_category_name		= $db2->result( 'category_name' );

				$query = "
						SELECT	*
						FROM	cd_category_link
						WHERE	category_no = '$rs_category_no'
						AND		cd_no = '$rs_cd_no'
				";
				$db4->query( $query );

			?>
			&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"><input type=checkbox name=category_no[] value="<?=$rs_category_no?>" <? IF( $db4->total_record() ) echo "checked"; ?>><?=$rs_category_name?></a><br>

				<?

				$query = "
						SELECT	category_gid ,
								category_thread ,
								category_name
						FROM	coowoo.cd_category
						WHERE	category_no = '$rs_category_no'
				";
				$db3->query( $query );
				$db3->fetch();
				$rs_category_gid		= $db3->result( 'category_gid' );
				$rs_category_thread	= $db3->result( 'category_thread' );
				$rs_category_name		= $db3->result( 'category_name' );

				$thread_length = strlen( $rs_category_thread ) + 3;

				// 세번째 하위 분류
				$query = "
						SELECT	category_no ,
								category_gid ,
								category_thread ,
								category_name
						FROM	coowoo.cd_category
						WHERE	category_gid = '$rs_category_gid'
						AND		category_thread LIKE '$rs_category_thread%'
						AND		length( category_thread ) = $thread_length
						ORDER BY	category_sort ASC
				";
				$db3->query( $query );

				?>
				<? FOR( $loop3=0; $loop3<$db3->total_record(); $loop3++ ) : ?>
				<?
					$db3->fetch();
					$rs_category_no		= $db3->result( 'category_no' );
					$rs_category_gid		= $db3->result( 'category_gid' );
					$rs_category_thread	= $db3->result( 'category_thread' );
					$rs_category_name		= $db3->result( 'category_name' );

					$query = "
							SELECT	*
							FROM	cd_category_link
							WHERE	category_no = '$rs_category_no'
							AND		cd_no = '$rs_cd_no'
					";
					$db4->query( $query );

				?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:void(0)"><input type=checkbox name=category_no[] value="<?=$rs_category_no?>" <? IF( $db4->total_record() ) echo "checked"; ?>><?=$rs_category_name?></a><br>
				<? ENDFOR ?>


			<? ENDFOR ?>

		</td>
	<? IF( ( $loop+1 ) % 6 == 0 ) : ?>
	</tr>
	<tr bgcolor="#FFFFFF">
	<? ENDIF ?>
	<? ENDFOR ?>
	</table>

	<table border=0 height=5><tr><td></td></tr></table>
	<table width=950 height=28 border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=320>
		</td>
		<td align=center>
		<input type=button value="    현재 선택된 분류 보기    " class="btn_kr" onClick="checkCategory()">
		</td>
		<td width=320 align=right>
		<table width=320 border=0 cellpadding=4 cellspacing=2 bgcolor=#AEAE5B>
		<tr bgcolor=#CDCD9A>
			<td align=right>
			CD 주문번호 : <input type=text name=reg_cd_order_no2 size=20 class=input_text onChange="twinOrderNo('2')"  value="<?=$cd_order_no?>">
			<input type=button value="    등록    " class="btn_kr" onClick="checkSubmit()">
			&nbsp;&nbsp;
			</td>
		</tr>
		</table>
		</td>
	</tr>
	</table>
	</form>
</td>
<td valign=top style="padding-left:10pt">
<? IF( $cd_order_no ) : ?>
<?
	
	for( $loop=0; $loop<strlen( $cd_order_no ); $loop++ )
	{
		$ch = substr( $cd_order_no, $loop, 1 );
		if( $ch >= '0' AND $ch <= '9' ) break; else $cd_str .= $ch;
	}

	$query = "
				SELECT	cd_no ,
						cd_order_no
				FROM	product_cd
				WHERE	cd_order_no LIKE '$cd_str%'
				ORDER BY cd_order_no DESC
	";
	$db->query( $query );

	for( $loop=0; $loop<$db->total_record(); $loop++ )
	{

		$db->fetch();

		$rs_cd_no		= $db->result( 'cd_no' );
		$rs_cd_order_no	= $db->result( 'cd_order_no' );

		
		 // 주제별 분류에 등록된 갯수 확인
		$query = "
					SELECT	* 
					FROM	cd_category as cc
							LEFT JOIN cd_category_link as ccl
							ON cc.category_no = ccl.category_no
					WHERE	ccl.cd_no = '$rs_cd_no'
					AND		cc.category_gid = '1'
					AND		cc.category_thread LIKE '001%'
		";
		$db2->query( $query );
		$total_record = $db2->total_record();

?>
	<a href="<?=$_SERVER[PHP_SELF]?>?cd_order_no=<?=$rs_cd_order_no?>">
	<? IF( $total_record ) : ?>
		<? IF( $cd_order_no == $rs_cd_order_no ) : ?>
			<b><?=$rs_cd_order_no?> ( <?=$total_record?> )</b>
		<? ELSE : ?>
		<?=$rs_cd_order_no?> ( <?=$total_record?> )
		<? ENDIF ?>
	<? ELSE : ?>
		<font color=#FF9966><?=$rs_cd_order_no?> ( 0 )</font>
	<? ENDIF ?>
	</a>
	
	<? IF( ( $loop+1 ) % 2 == 0 ) : ?>
	<br>
	<? ENDIF ?>
<?
	}
?>
<? ENDIF ?>
</td>
</tr>
</table>
<iframe name=category_hidden_frame border=0 width=0 height=0></iframe>

</body>
</html>