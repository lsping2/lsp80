<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );

$user_id			= request( 'user_id' , 'get' );
$working_date		= request( 'working_date', 'get' );

$db = new MYSQL;

$query = "
		SELECT	status_code
		FROM	intranet.calendar_duty 
		WHERE	user_id = '$user_id'
		AND		working_date = '$working_date'
";

$db->query( $query );
$db->fetch();

$rs_status_code	= $db->result( 'status_code' );

$query = "
		SELECT	user_name
		FROM	intranet.user_info
		WHERE	user_id = '$user_id'
";
$db->query( $query );
$db->fetch();

$rs_user_name	= $db->result( 'user_name' );

?>
<html>
<head>
<title><?$HTML->Title( 'Admin' )?></title>
<?=$HTML->Metatag()?>
<link rel="stylesheet" href="../../admin_style.css" type="text/css">
</head>

<body>

<form name=form method=post action=set_status_exec.php>
<table border=0>
<tr>
	<td>
<?
$query = "
			SELECT	DATE_FORMAT( lunar_date, '%m/%d' ) as lunar_date ,
					ganji
			FROM	intranet.lunar2solar
			WHERE	solar_date = '$working_date'
	";
$db->query( $query );
$db->fetch();
$rs_lunar_date	= $db->result( 'lunar_date' );


?>
	<?=$working_date?> <span style="font-family:tahoma; font-size:8pt; color=#AAAAAA">( <?=$rs_lunar_date?> )</span>&nbsp;[ <?=$rs_user_name?> ]

	<br>

	<table border=0 cellpadding=2 cellspacing=2 bgcolor=#EFEFEF>
	<tr bgcolor=#FFFFFF>
		<td width=100 align=center>
		근무상태
		</td>
		<td width=120 align=center>
		<select name=status_code style="width=80">
                <option value="0" <? if( !$rs_status_code ) echo "selected"; ?>>없음</option>
                <option value= "5" <? if( 5 == $rs_status_code ) echo "selected"; ?>>지각</option>
                <option value= "10" <? if( 10 == $rs_status_code ) echo "selected"; ?>>야근</option>
                <option value= "12" <? if( 12 == $rs_status_code ) echo "selected"; ?>>당직</option>
                <option value= "15" <? if( 15 == $rs_status_code ) echo "selected"; ?>>특근</option>
                <option value= "20" <? if( 20 == $rs_status_code ) echo "selected"; ?>>조퇴</option>
                <option value= "25" <? if( 25 == $rs_status_code ) echo "selected"; ?>>결근</option>
                <option value= "30" <? if( 30 == $rs_status_code ) echo "selected"; ?>>휴무</option>
                <option value= "35" <? if( 35 == $rs_status_code ) echo "selected"; ?>>휴가</option>
                <option value= "40" <? if( 40 == $rs_status_code ) echo "selected"; ?>>격월차</option>
		</select>
		</td>
	</tr>
	</table>
	<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td height=5>
		</td>
	</tr>
	</table>
	<input type=image src="images/btn_reg.gif">
	<input type=hidden name=user_id value="<?=$user_id?>">
	<input type=hidden name=working_date value="<?=$working_date?>">


	</td>
</tr>
</table>
</form>

</body>
</html>

