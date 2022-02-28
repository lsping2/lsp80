<?

require_once "include/include.php";
require_once "include/search_cache_class.php";
html_cache_disable();


?>

<html>
<head>
<title><?=$HTML->Title()?> - ??????</title>
<?=$HTML->Metatag()?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">


<!--############################# ????? ???????? ???? ####################################-->
<table border=0 cellpadding=0 cellspacing=0>
	<tr>
  <?

$db = new MYSQL;

$package_array = array( 'DAJES001','DAJES002','DAJES003','DAJES004','DAJES005','DAJES006','DAJES007','DAJES008','DAJES009','DAJES010','DAJES011','DAJES012' );

?>
<? FOR( $loop=0; $loop<count( $package_array ); $loop++ ) : ?>
<?
	
	$cd_order_no = $package_array[ $loop ];

	$query = "
			SELECT	cd_no ,
					cd_order_no ,
					name_kr ,
					name_eg ,
					jacket_pic
			FROM	product_cd
			WHERE	cd_order_no = '$cd_order_no'
	";

	$db->query( $query );
	$db->fetch();
	$rs_cd_no		= $db->result( 'cd_no' );
	$rs_cd_order_no	= $db->result( 'cd_order_no' );
	$rs_name_kr		= $db->result( 'name_kr' );
	$rs_name_eg		= $db->result( 'name_eg' );
	$rs_jacket_pic		= $db->result( 'jacket_pic' );
?>
		<td align=center width=115><a href="../search/cd.html?cd_order_no=<?=$rs_cd_order_no?>">
								<img src="../../jacket/80/<?=$rs_jacket_pic?>" width="80" height="80" border=0><br>
								<?=$rs_cd_order_no?><br>
								<font style="family:?????; font-size:8pt"><?=$rs_name_kr?></font></a>
		</td>
<? IF( ( $loop+1 ) % 6 == 0 ) : ?>
	</tr>
	<tr>
		<td height=10></td>
	</tr>
<? ENDIF ?>

<? ENDFOR ?>
</table>
<!--############################# ????? ???????? ???? ####################################-->



<!--#############################3 ??????? ????? ???####################################-->

<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=330>
			    
			<DIV style="LEFT: 0px; OVERFLOW: hidden; WIDTH: 311px; POSITION: relative; TOP: 0px; HEIGHT: 233px"> 

				<DIV id=RollingBanner style="LEFT: 0px; VISIBILITY: visible; WIDTH: 311px; POSITION: absolute; TOP: 0px; HEIGHT: 233px">
				<a href="http://www.coowoo.com/home/search/cd.html?location=search&keyword=ZZS002&search_option=&cd_no=7016"><img src="http://www.coowoo.com/home/clipart/images/clipart_0512/event1_3.gif" width="311" height="233" border="0"></a>
				</DIV>

				<DIV id=RollingBanner style="LEFT: 0px; VISIBILITY: visible; WIDTH: 311px; POSITION: absolute; TOP: 0px; HEIGHT: 233px">
				<a href="http://www.coowoo.com/home/search/cd.html?location=category2&parent_category_no=&category_no=275&cd_no=1689"><img src="http://www.coowoo.com/home/clipart/images/clipart_0512/event1_3_2.gif" width="311" height="233" border="0"></a>
				</DIV>
				
				<DIV id=RollingBanner style="LEFT: 0px; VISIBILITY: visible; WIDTH: 311px; POSITION: absolute; TOP: 0px; HEIGHT: 233px">
				<a href="http://www.coowoo.com/home/search/cd.html?location=category2&parent_category_no=&category_no=1093&cd_no=7555"><img src="http://www.coowoo.com/home/clipart/images/clipart_0512/event1_3_3.gif" width="311" height="233" border="0"></a>
				</DIV>

				<DIV id=RollingBanner style="LEFT: 0px; VISIBILITY: visible; WIDTH: 311px; POSITION: absolute; TOP: 0px; HEIGHT: 233px">
				<a href="http://www.coowoo.com/home/search/cd.html?location=category2&parent_category_no=&category_no=1108&cd_no=7556"><img src="http://www.coowoo.com/home/clipart/images/clipart_0512/event1_3_4.gif" width="311" height="233" border="0"></a>
				</DIV>

			</DIV>
		</td>
		<td>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr> 
			<td><a href="javascript:RollingUp()"><img src="image/allow_up.gif" width="7" height="10" border="0"></a>
			</td>
		</tr>
		<tr> 
			<td width=7 height=180 align=middle background="image/scroll_bg.gif"></td>
		</tr>
		<tr> 
			<td><a href="javascript:RollingDown()"><img src="image/allow_down.gif" width="7" height="10" border="0"></a>
			</td>
		</tr>
		</table>

		</td>
	</tr>
	</table>
<SCRIPT language=JavaScript1.2 src="js/Rolling_Banner.js"></SCRIPT>
<!--#############################3 ??????? ????? ???####################################-->
</body>
</html>