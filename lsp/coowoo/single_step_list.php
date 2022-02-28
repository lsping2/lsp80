<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );

$db = new mysql();
$db2 = new mysql();

$search_field	= request( 'search_field' , 'get' );
$search_key	= request( 'search_key' , 'get' );

?>
<html>
<head>
<title><?$HTML->Title( 'Admin' )?></title>
<link rel="stylesheet" href="../../admin_style.css" type="text/css">
<script language=javascript>
<!--

	function digit(c)
	{
		return ((c >= "0") && (c <= "9"));
	}

	function digitCheck( data, input_pos )
	{	
		for( i=0; i<data.length; i++)
		{
			var ch = data.charAt( i );
			if( false == digit( ch ) )
			{ 
				alert("숫자로만 입력해 주세요.");
				input_pos.focus();
				input_pos.select();
				return false;
			}
		}
		return true;
	}

	function empty( data )
	{
		if( !data ) return true;

		for( i=0; i<data.length; i++ )
		{
			if( data.substring( i, i+1 ) != ' ' )
				return false;
		}
		return true;
	}

	function download( image_no )
	{
		window.open( 'image_download.html?image_no=' + image_no , '_image_download', 'width=700, height=500, scrollbars=yes ' );
	}

	function checkForm( form )
	{
		if( empty( form.search_key.value ) )
		{
			alert( '검색어를 입력하세요.' );
			form.search_key.focus();
			return false;
		}

		return true;
	}

-->
</script>
</head>
<body>
<b><font size=3>* 싱글등록(자동) 목록 </font></b>


<?


$location = "search_field={$search_field}&search_key={$search_key}";

$search_query = $location = '';
if( $search_key )
{

	$search_query = '';
	switch( $search_field )
	{
		case 'ALL'		:	$query1 = "
										SELECT	count(*)
										FROM	product_cd as pc ,
												product_manufacture_code as pmc
										WHERE	pc.manufacture_code = pmc.manufacture_code
										AND		( cd_order_no LIKE '$search_key%' OR name_kr LIKE '$search_key%' OR name_eg LIKE '$search_key%' OR pmc.manufacture_name LIKE '$search_key%' )
							";

							$query2 = "
										SELECT	pc.cd_no ,
												pc.cd_order_no ,
												pc.name_eg ,
												pc.manufacture_code ,
												pmc.manufacture_name
										FROM	product_cd as pc ,
												product_manufacture_code as pmc
										WHERE	pc.manufacture_code = pmc.manufacture_code
										AND		( cd_order_no LIKE '$search_key%' OR name_kr LIKE '$search_key%' OR name_eg LIKE '$search_key%' OR pmc.manufacture_name LIKE '$search_key%' )
										 ORDER BY reg_date DESC
							";
							break;
		case 'CD_NO'	:	
								$query1 = "
												SELECT	count(*)
												FROM	product_images as pi
												WHERE   1
												AND pi.cd_order_no LIKE '$search_key%'
								";
												
								$query2 = "
													SELECT	pi.image_no ,
																pi.product_class ,
																pi.cd_order_no ,
																pi.single_order_no ,
																pi.data_folder_no ,
																df.data_folder_name ,
																pi.image_name ,
																pi.image_class ,
																pi.image_shape ,
																pi.manufacture_code ,
																pmc.manufacture_name ,
																pi.cd_sell_status ,
																pi.vcd_sell_status ,
																pi.single_sell_status ,
																pi.reg_date
													FROM	product_images as pi LEFT JOIN  product_manufacture_code as pmc ON pi.manufacture_code = pmc.manufacture_code ,
																data_folder as df
													WHERE	pi.data_folder_no = df.data_folder_no 
													AND pi.cd_order_no LIKE '$search_key%'
													 ORDER BY single_order_no DESC
								";
										break;
		case 'ORDER_NO'	:
								$query1 = "
												SELECT	count(*)
												FROM	product_images as pi
												WHERE   1
												AND pi.single_order_no LIKE '$search_key%'
								";										
								$query2 = "
													SELECT	pi.image_no ,
																pi.product_class ,
																pi.cd_order_no ,
																pi.single_order_no ,
																pi.data_folder_no ,
																df.data_folder_name ,
																pi.image_name ,
																pi.image_class ,
																pi.image_shape ,
																pi.manufacture_code ,
																pmc.manufacture_name ,
																pi.cd_sell_status ,
																pi.vcd_sell_status ,
																pi.single_sell_status ,
																pi.reg_date
													FROM	product_images as pi LEFT JOIN  product_manufacture_code as pmc ON pi.manufacture_code = pmc.manufacture_code ,
																data_folder as df
													WHERE	pi.data_folder_no = df.data_folder_no 
													AND pi.single_order_no LIKE '$search_key%'
													 ORDER BY reg_date DESC
								";
										break;
		case 'FILENAME'	:
								$query1 = "
												SELECT	count(*)
												FROM	product_images as pi
												WHERE   1
												AND pi.image_name LIKE '$search_key%'
								";										
								$query2 = "
													SELECT	pi.image_no ,
																pi.product_class ,
																pi.cd_order_no ,
																pi.single_order_no ,
																pi.data_folder_no ,
																df.data_folder_name ,
																pi.image_name ,
																pi.image_class ,
																pi.image_shape ,
																pi.manufacture_code ,
																pmc.manufacture_name ,
																pi.cd_sell_status ,
																pi.vcd_sell_status ,
																pi.single_sell_status ,
																pi.reg_date
													FROM	product_images as pi LEFT JOIN  product_manufacture_code as pmc ON pi.manufacture_code = pmc.manufacture_code ,
																data_folder as df
													WHERE	pi.data_folder_no = df.data_folder_no 
													AND pi.image_name LIKE '%$search_key%'
													 ORDER BY reg_date DESC
								";
										break;
		case 'MANUFACTURE'	:	
											$query1 = "
															SELECT	count(*)
															FROM	product_images as pi LEFT JOIN  product_manufacture_code as pmc ON pi.manufacture_code = pmc.manufacture_code
															WHERE   1
															AND pmc.manufacture_name LIKE '$search_key%'
											";
															
											$query2 = "
																SELECT	pi.image_no ,
																			pi.product_class ,
																			pi.cd_order_no ,
																			pi.single_order_no ,
																			pi.data_folder_no ,
																			df.data_folder_name ,
																			pi.image_name ,
																			pi.image_class ,
																			pi.image_shape ,
																			pi.manufacture_code ,
																			pmc.manufacture_name ,
																			pi.cd_sell_status ,
																			pi.vcd_sell_status ,
																			pi.single_sell_status ,
																			pi.reg_date
																FROM	product_images as pi LEFT JOIN  product_manufacture_code as pmc ON pi.manufacture_code = pmc.manufacture_code ,
																			data_folder as df
																WHERE	pi.data_folder_no = df.data_folder_no 
																AND pmc.manufacture_name LIKE '$search_key%'
																 ORDER BY reg_date DESC
											";
										break;
	}

	$location = "&search_field={$search_field}&search_key=" . htmlspecialchars( $search_key );

}
else
{

	$query1 = "
					SELECT	count(*)
					FROM	product_images as pi
					WHERE   1
	";

	$query2 = "
						SELECT	pi.image_no ,
									pi.product_class ,
									pi.cd_order_no ,
									pi.single_order_no ,
									pi.data_folder_no ,
									df.data_folder_name ,
									pi.image_name ,
									pi.image_class ,
									pi.image_shape ,
									pi.manufacture_code ,
									pmc.manufacture_name ,
									pi.cd_sell_status ,
									pi.vcd_sell_status ,
									pi.single_sell_status ,
									pi.reg_date
						FROM	product_images as pi LEFT JOIN  product_manufacture_code as pmc ON pi.manufacture_code = pmc.manufacture_code ,
									data_folder as df
						WHERE	pi.data_folder_no = df.data_folder_no
						ORDER BY reg_date DESC
	";

}

$db->query( $query1 );

$total_record = $db->is_count();

$max_show_page = 21;
$max_show_list  = 20;

page_calcu();

$query2 .= " LIMIT	$start, $max_show_list";
$db->query( $query2 );

?>
<form name=searchForm action=single_step_list.php method=get onSubmit="return checkForm( this )">
<table width=800 border=0 cellpadding=0 cellspacing=0>
<tr>
	<td align=center>
	<table border=0 cellpadding=0 cellspacing=3 bgcolor=#CDCD9A>
	<td width=60 align=center>
	<select name=search_field style="font-family:굴림체; font-size:9pt">
	<option value='CD_NO'<? if( $search_key AND 'CD_NO' == $search_field ) echo ' selected'; ?>>제품번호</option>
	<option value='ORDER_NO'<? if( $search_key AND 'ORDER_NO' == $search_field ) echo ' selected'; ?>>주문번호</option>
	<option value='FILENAME' <? if( $search_key AND 'FILENAME' == $search_field ) echo ' selected'; ?>>파일명</option>
	<option value='MANUFACTURE'<? if( $search_key AND 'MANUFACTURE' == $search_field ) echo ' selected'; ?>>제작사</option>
	</select>
	</td>
	<td>
	<input type=text size=16 style="font-family:굴림체; font-size:9pt" name=search_key <? if( $search_key ) echo "value=\"" . htmlspecialchars( $search_key ) . "\""; ?>>
	</td>
	<td>
	<input type=submit value="  검색  " class=btn_kr onFocus="this.blur()">
	</td>
<? if( $search_key ) : ?>
	<td>
	<input type=button value="전체보기" class=btn_kr onFocus="this.blur()" onClick="window.open( 'single_step_list.php', '_self' )">
	</td>
<? endif ?>
	</table>
	</td>
</tr>
</table>
</form>

<table width=800 border=0 cellpadding=0 cellspacing=0>
<tr>
	<td>
	등록된 전체 이미지 : <?=(int)$total_record?> 개
	</td>
	<td align=right>
	<?=$page?> / <?=$total_page?> page
	</td>
</tr>
<tr>
	<td align=center height=40 colspan=2>
	<? page_list( 'single_step_list.php', $location ); ?>
	</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=3 bgcolor="#CDCD9A">
<tr>
	<td>
	<table width=100% border=0 cellpadding=0 cellspacing=0 border=0 bgcolor="#FFFFFF">
	<tr>
		<td align=center width=90 height=22>
		<font color=#666666 face=verdana><b>이미지</b></font>
		</td>
		<td align=center width=60>
		<font color=#666666 face=verdana><b>분류</b></font>
		</td>
		<td align=center width=100>
		<font color=#666666 face=verdana><b>제품번호</b></font>
		</td>
		<td align=center width=220>
		<font color=#666666 face=verdana><b>주문번호, 제작사</b></font>
		</td>
		<td align=center width=110>
		<font color=#666666 face=verdana><b>구분/모양</b></font>
		</td>
		<td align=center width=70>
		<font color=#666666 face=verdana><b>다운로드</b></font>
		</td>
		
	</tr>
	</table>
	</td>
</tr>

<tr>
	<td>
	<table width=100% border=0 cellpadding=0 cellspacing=0 border=0 bgcolor="#FFFFFF">
<? for( $loop=0; $loop<$db->total_record(); $loop++ ) : ?>
<?

$db->fetch();
$rs_image_no				= $db->result( 'image_no' );
$rs_product_class			= $db->result( 'product_class' );
$rs_cd_order_no			= $db->result( 'cd_order_no' );
$rs_single_order_no		= $db->result( 'single_order_no' );
$rs_data_folder_no			= $db->result( 'data_folder_no' );
$rs_data_folder_name	= $db->result( 'data_folder_name' );
$rs_image_name			= $db->result( 'image_name' );
$rs_image_class				= $db->result( 'image_class' );
$rs_image_shape			= $db->result( 'image_shape' );
$rs_manufacture_code	= $db->result( 'manufacture_code' );
$rs_manufacture_name	= $db->result( 'manufacture_name' );
$rs_cd_sell_status			= $db->result( 'cd_sell_status' );
$rs_vcd_sell_status		= $db->result( 'vcd_sell_status' );
$rs_single_sell_status		= $db->result( 'single_sell_status' );
$rs_reg_date					= $db->result( 'reg_date' );

$image_class_array = explode( "," , $rs_image_class );

?>
	<tr onMouseOver=this.style.backgroundColor="#EFEFEF" onMouseOut=this.style.backgroundColor="">
		<td width=90 height=90 align=center>

		<img src="../../image.php?data_folder=<?=$rs_data_folder_name?>&sub_folder=<?=$rs_cd_order_no?>&size=80&image_name=<?=$rs_image_name?>" border=1 style="border-color:#AAAAAA">
		<!--
		<img src="http://www.coowoo.com/thumnail/<?=$rs_data_folder_name?>/<?=$rs_cd_order_no?>/80/<?=$rs_image_name?>" border=1 style="border-color:#AAAAAA">		-->
		</td>

		<td width=60 align=center>
	<? if( 'cd' == $rs_product_class ) : ?>
		<font face=verdana style="font-size:8pt" color=#0000FF><?=$rs_product_class?></font>
	<? else : ?>
		<font face=verdana style="font-size:8pt" color=#EC0000><?=$rs_product_class?></font>
	<? endif ?>
		</td>
		<td width=100 align=center>
		<?=$rs_cd_order_no?>
		</td>
		<td width=220 align=center style="padding-left:5px">
		<font size=2 color=#FF9966><?=$rs_single_order_no?></font><br>
		<br><font face=verdana style="font-size:8pt" color=#666666><?=$rs_image_name?><br><?=$rs_manufacture_name?></font>
		</td>
		<td width=110 align=center>
		<font color=#666666>
	<? if( in_array( 'real' , $image_class_array )) : ?>
		포토
	<? endif ?>
	<? if( in_array( 'illust' , $image_class_array ) ) : ?>
		일러스트
	<? endif ?>
	<? if( in_array( 'cg' , $image_class_array ) ) : ?>
		CG
	<? endif ?>
	<? if( in_array( 'compo' , $image_class_array ) ) : ?>
        합성이미지
	<? endif ?>
	/
	<? if( 'vertical' == $rs_image_shape ) : ?>
	가로
	<? elseif( 'horizon' == $rs_image_shape ) : ?>
	세로
	<? elseif( 'square' == $rs_image_shape ) : ?>
	정사각형
	<? else : ?>
	?
	<? endif ?>
		</font>
		</td>
		<td width=70 align=center>
<?

$query2 = "
				SELECT	*
				FROM	keyindex_info
				WHERE	image_no = '$rs_image_no'
";
$db2->query( $query2 );



?>
	<? if( $db2->total_record() ) : ?>
		<font face=verdana style="font-size:8pt" color=#0000FF>등록</font>
	<? else : ?>
		<font face=verdana style="font-size:8pt" color=#EC0000>비등록</font>
	<? endif ?>
		</td>


<!------------------------------ 다운로드 정보가 유무에 따른 경우------------------------------------------------------------->
		<td align=center width=140 style="padding-left:5px">


		<? if( $db2->total_record() ) : ?>
		<a href="javascript:download( <?=$rs_image_no?> )" style='font-size:9pt' onFocus="this.blur()">[ 다운로드 정보  ]</a>
		<? else : ?>
			NO
		<? endif ?>
		</td>
<!------------------------------ 다운로드 정보가 유무에 따른 경우------------------------------------------------------------->

<?

$query = "
				SELECT	cd_order_no ,
							single_order_no ,
							image_name ,
							manufacture_code ,
							single_sell_status ,
							data_folder_no
				FROM	product_images
				WHERE	image_no = '$rs_image_no'
";			
$db2->query( $query );
$db2->fetch();

$rs_cd_order_no			= $db2->result( 'cd_order_no' );
$rs_single_order_no		= $db2->result( 'single_order_no' );
$rs_image_name			= $db2->result( 'image_name' );
$rs_manufacture_code	= $db2->result( 'manufacture_code' );
$rs_single_sell_status		= $db2->result( 'single_sell_status' );
$rs_data_folder_no			= $db2->result( 'data_folder_no' );

$query = "
				SELECT	pmc.manufacture_name ,
							pwc.watermark_folder
				FROM	product_manufacture_code as pmc ,
							product_watermark_code as pwc
				WHERE	pmc.watermark_code = pwc.watermark_code
				AND		pmc.manufacture_code = '$rs_manufacture_code'
";
	
$db2->query( $query );
$db2->fetch();

$rs_manufacture_name	= $db2->result( 'manufacture_name' );
$rs_watermark_folder	= $db2->result( 'watermark_folder' );

$query = "
			SELECT	data_folder_name
			FROM	data_folder
			WHERE	data_folder_no = '$rs_data_folder_no'
";
$db2->query( $query );
$db2->fetch();

$rs_data_folder_name	= $db2->result( 'data_folder_name' );

?>
		
	</tr>
	<? if( $db->total_record() > 1 AND $loop != $db->total_record() - 1 ) : ?>
	<tr>
		<td colspan=8 height=1 background="../../image/dot.gif">
		</td>
	</tr>
	<? endif ?>
<? endfor ?>
<? if( !$db->total_record() ) : ?>
	<tr>
		<td height=100 align=center>
	<? if( $search_key ) : ?>
		<font color=#3333CC>검색된 시디가 없습니다.</font>
	<? else : ?>
		<font color=#FF9966>등록된 시디가 없습니다.</font>
	<? endif ?>
		</td>
	</tr>
<? endif ?>
	</table>
	</td>
</tr>
</table>

<? if( $db->total_record() ) : ?>
<table width=800 border=0>
<tr>
	<td height=40 align=center>
	<? page_list( 'single_step_list.php', $location ); ?>
	</td>
</tr>
</table>
<? endif ?>

</form>

</body>
</html>
