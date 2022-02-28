<?

require_once "../include/include.php";

//require_once "../login/login_check.php";
//login_check( $PHP_SELF );

$run = request( 'run', 'get' );
$class = request( 'class', 'get' );

$search_field	= request( 'search_field' , 'get' );
$search_key	= request( 'search_key' , 'get' );

$image			= request( 'image', 'get' );

$from_year	= request( 'from_year', 'get' );
$from_month = request( 'from_month', 'get' );
$from_day		= request( 'from_day', 'get' );

$image			= request( 'image', 'get' );
$to_year		= request( 'to_year', 'get' );
$to_month		= request( 'to_month', 'get' );
$to_day			= request( 'to_day', 'get' );

$from_date	= "{$from_year}-" . sprintf( "%02d", $from_month ) . "-" . sprintf( "%02d" , $from_day );
$to_date		= "{$to_year}-" . sprintf( "%02d", $to_month ) . "-" . sprintf( "%02d" , $to_day );

$fp = fopen( "download/order.csv", "w" );

?>
<html>
<head>
<title><?$HTML->Title( 'Admin' )?></title>
<?=$HTML->Metatag()?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../../admin_style.css" type="text/css">
<script language=javascript>
<!--
-->
</script>
</head>
<body>
<form name=searchForm action=<?=$_SERVER["PHP_SELF"]?> method=get>

<font style="font-size:9pt"><b>※ 엑셀데이터</b></font>
<br><br>

<table border=0 cellpadding=0 cellspacing=0>
<tr>
	<td>
	<table border=0 cellpadding=0 cellspacing=1  bgcolor="#CDCD9A">
	<tr>
		<td>
		<table border=0 cellpadding=0 cellspacing=4 bgcolor=#F0F0F0>
	<tr>
		<td width=100 align=right style="padding-right:5pt">
		가입일 :
		</td>
		<td colspan=3>

<?

$today_year = date( 'Y', time() );
$today_month = date( 'n' , time() );
$today_day = date( 'j' , time() );

?>

		<select name=from_year>
<? for( $loop=2004; $loop<=2006; $loop++ ) : ?>
		<option value=<?=$loop?> <? if( $loop == $from_year OR( !$from_year AND $loop == $today_year ) ) echo 'selected' ?>><?=$loop?></option>
<? endfor ?>
		</select>년
		<select name=from_month>
<? for( $loop=1; $loop<=12; $loop++ ) : ?>
		<option value=<?=$loop?> <? if( $loop == $from_month OR ( !$from_month AND $loop == $today_month ) ) echo 'selected' ?>><?=$loop?></option>
<? endfor ?>
		</select>월
		<select name=from_day>
<? for( $loop=1; $loop<=31; $loop++ ) : ?>
		<option value=<?=$loop?> <? if( $loop == $from_day) echo 'selected' ?>><?=$loop?></option>
<? endfor ?>
		</select>일 ~

		<select name=to_year>
<? for( $loop=2004; $loop<=2006; $loop++ ) : ?>
		<option value=<?=$loop?> <? if( $loop == $to_year OR ( !$to_year AND $loop == $today_year ) ) echo 'selected' ?>><?=$loop?></option>
<? endfor ?>
		</select>년
		<select name=to_month>
<? for( $loop=1; $loop<=12; $loop++ ) : ?>
		<option value=<?=$loop?> <? if( $loop == $to_month OR ( !$to_month AND $loop == $today_month ) ) echo 'selected' ?>><?=$loop?></option>
<? endfor ?>
		</select>월
		<select name=to_day>
<? for( $loop=1; $loop<=31; $loop++ ) : ?>
		<option value=<?=$loop?> <? if( $loop == $to_day OR ( !$to_day AND $loop == $today_day ) ) echo 'selected' ?>><?=$loop?></option>
<? endfor ?>
		</select>일
		</td>
		<td width=120 align=center>
		<input type=submit value="   보기  " class=btn_kr onFocus="this.blur()">
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
</td>
<? IF( 'Yes' == $run ) : ?>
	<td align=center width=250 >
	<input type=button value=" 엑셀(CSV) 다운로드  " style="height:25pt" onFocus="this.blur()" class=btn_kr onClick="window.open('download.php','_self')">
	</td>
<? ENDIF ?>
</tr>
</table>
<input type=hidden name=run value=Yes>

</form>

<br>

<? IF( 'Yes' == $run ) : ?>
<?

$db = new MYSQL;
$db2 = new MYSQL;

$query="		SELECT	category_no,
					category_gid,
					category_thread,
					category_name,
					reg_date
			FROM	cd_category
			WHERE	category_thread LIKE '$thread%'
			ORDER BY category_gid DESC , category_thread ASC
			LIMIT 10
	";


$db->query( $query );

$total_record = $db->total_record();

?>


<table border=0 cellpadding=0 cellspacing=1 bgcolor="#CDCD9A">
<? FOR( $loop=0; $loop<$total_record; $loop++ ) : ?>
<?
	$db->fetch();
		$rs_category_no		= $db->result( 'category_no' );
		$rs_category_name		= htmlspecialchars( $db->result( 'category_name' ) );
		$rs_category_gid		= $db->result( 'category_gid' );
		$rs_category_thread	= $db->result( 'category_thread' );
		$rs_reg_date			= $db->result( 'reg_date' );



	$put_csv = "$rs_category_no,\"$rs_category_name\",\"$rs_category_gid\",$rs_category_thread,$rs_reg_date	";

	fputs( $fp, $put_csv  . "\n");
?>
		<tr height=20 bgcolor=#FFFFFF>
			<td width=80>
			<?=$rs_category_no?>
			</td>
			<td width=100>
			<?=$rs_category_name?>
			</td>
			<td width=100>
			<?=$rs_category_gid?>
			</td>
			<td width=200>
			<?=$rs_category_thread?>
			</td>
			<td width=200>
			<?=$rs_reg_date?>
			</td>
		</tr>
		<tr>
			<td colspan=5 height=1 background="../../image/dot.gif">
			</td>
		</tr>
<? ENDFOR ?>
		</table>
<? ENDIF ?>


</body>
</html>

<?

fclose( $fp );

?>