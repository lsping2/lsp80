<?
require_once "../../../include/include.php";
html_cache_disable();


$db = new MYSQL;
$db2 = new MYSQL;

$search_field	= request( 'search_field' , 'get' );			// 주문번호 셀렉트 값
$search_key	= request( 'search_key' , 'get' );			// 검색어의 값
$show		= request( 'show', 'get' );				//  라디오 버턴의 값


?>

<html>
<head>
<title><?$HTML->Title( 'Admin' )?></title>
<link rel="stylesheet" href="../../admin_style.css" type="text/css">
<head>


<script language=javascript>

function show2(link)   {
   
   var new_url= "<?="$_SERVER[PHP_SELF]?search_field=$search_field&search_key=$search_key&show=" ?>" + link; 


   if (  (new_url != "")  &&  (new_url != null)  )

          window.location=new_url;
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


</script>


</head>
<body>



<?

//$location = "search_field={$search_field}&search_key={$search_key}";


$search_query = $location = '';

if( $search_key )
{

	$search_query = '';
	switch( $search_field )
	{
		case 'CD_NO'			:	$search_query = " WHERE  pi.cd_order_no LIKE '$search_key%' ";
											break;


		case 'FILENAME'		:	$search_query = " WHERE  pi.image_name LIKE '$search_key%' ";
											break;


		case 'ORDER_NO'		:	$search_query = " WHERE  pi.single_order_no LIKE '$search_key%' ";
											break;		

											
	}

}

//################### 전체이미지별  다운로드이미지별 라디오버튼 선택부분 쿼리 ########################

if( $show == "ALL" )
{
	
	$FROM = "FROM product_images as pi LEFT JOIN product_cd_images as pci";


}

else
{
	$FROM = "FROM product_cd_images as pci LEFT JOIN  product_images as pi ";

}

//############################################################################



$query = "
			SELECT	count(*)
			$FROM

			ON		pi.image_no = pci.image_no
			LEFT JOIN data_folder as df
			ON		pi.data_folder_no=df.data_folder_no
			$search_query
								
";

//ORDER BY pi.single_order_no DESC

$db->query( $query );
$total_record = $db->is_count();

$max_show_list = 15;
$max_show_page = 20;

page_calcu();



$query2 = "	
			SELECT	pi.cd_order_no,
					pi.single_order_no,
					pi.data_folder_no,
					pci.cd_image_no,
					pci.image_no,
					pci.download_folder,
					pi.image_name,
					DATE_FORMAT( pci.reg_date, '%Y/%m/%d' ) as reg_date ,
					df.data_folder_name
			$FROM

			ON		pi.image_no = pci.image_no
			LEFT JOIN data_folder as df
			ON		pi.data_folder_no=df.data_folder_no
			$search_query
			ORDER BY reg_date DESC
			LIMIT	 $start, $max_show_list



";
//ORDER BY pi.single_order_no DESC


$db2->query( $query2 );


// 페이징 이후에도 값들을 유지하기위한 변수
$location = "&search_field={$search_field}&search_key=" . htmlspecialchars( $search_key )."&show={$show}";

?>


<table border=0 width=70%>
	<tr>
		<td width=35%></td>
		<td >		
			<form name=searchForm  action=download_register_list.php method=get onSubmit="return checkForm( this )">     
			<table width="70%" border=0 cellpadding=0 cellspacing=0>
			<tr>
				<td>
				<table border=0 cellpadding=0 cellspacing=3 bgcolor=#CDCD9A>
				<td width=60 align=center>
				<select name=search_field style="font-family:굴림체; font-size:9pt">
					<option value='CD_NO'<? if( $search_key AND 'CD_NO' == $search_field ) echo ' selected'; ?>>주문번호</option>
					<option value='FILENAME' <? if( $search_key AND 'FILENAME' == $search_field ) echo ' selected'; ?>>파일명</option>
					<option value='ORDER_NO'<? if( $search_key AND 'ORDER_NO' == $search_field ) echo ' selected'; ?>>한컷주문번호</option>
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
				<input type=button value="전체보기" class=btn_kr onFocus="this.blur()" onClick="window.open( 'download_register_list.php', '_self' )">
				</td>
			<? endif ?>
				</table>
				</td>
				
			</tr>
			</table>
		
		</td>
	
	</tr>
</table>




<table width="70%" border=0 cellpadding=0 cellspacing=0>
<tr>
	<td width=36%></td>
	<td>기준 :</td>
	<td><input type=radio name=show value='ALL' <? if ($show=='ALL') echo 'checked';  ?>  onclick="show2('ALL')"> 전체등록 이미지</td>
	<td><input type=radio name=show value='DOWNLOAD' <? if ($show=='DOWNLOAD' OR $show=="" ) echo 'checked'; ?> onclick="show2('DOWNLOAD')" > 다운로드 이미지</td>
	<td width=28%></td>
</tr>
</table>
</form>	



<table width="70%" border=0 cellpadding=0 cellspacing=0>
<tr>
	<td width=25%>등록된 전체 이미지 : <?=(int)$total_record?> 개</td>
	<td width=50%></td>
	<td width=10%> <?=$page?> / <?=$total_page?> page</td>
</tr>
</table>


<!--#############################	페이징  #################################### -->
				<table width="70%" height=50 border="0" cellspacing="0" cellpadding="0">
				      <tr> 
	
						<td align="center">
						<? if( $db->total_record() ) : ?>
						  <? page_list( $_SERVER['PHP_SELF'], $location); ?>
						<? endif ?>		
						</td>
	
				      </tr>
				    </table>
<!--#############################	페이징  #################################### -->





    <table width="70%" border="0" cellpadding="0" cellspacing="0">
	<tr bgcolor="#569BD3"> 

		
		<td width="112" align="center" bgcolor="#569BD3"><font color="#FFFFFF">NO</font></td>
		<td width="1" valign="top"> 
			<table width="1" height="10" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
				<tr> 
					 <td> </td>
				</tr>
			</table>
		</td>


		<td width="1" height="23" valign="top">&nbsp; </td>
		<td width="118" align="center"><font color="#FFFFFF">이미지</font></td>
		<td width="1" valign="top"> 
			<table width="1" height="10" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
				<tr> 
					<td> </td>
				</tr>
			</table>
		</td>
		<td width="112" align="center" bgcolor="#569BD3"><font color="#FFFFFF">image_name</font></td>
		<td width="1" valign="top"> 
			<table width="1" height="10" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
				<tr> 
					 <td> </td>
				</tr>
			</table>
		</td>
		<td width="151" align="center"><font color="#FFFFFF">cd_order_no</font></td>
		<td width="1" valign="top"> 
			<table width="1" height="10" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
				<tr> 
					<td> </td>
				</tr>
			</table>
		</td>
		<td width="115" align="center"><font color="#FFFFFF">sing_order_no</font></td>
		<td width="1" valign="top"> 
			<table width="1" height="10" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			    <tr> 
					<td> </td>
			    </tr>
			 </table>
		<td width="115" align="center"><font color="#FFFFFF">data_folder_name</font></td>
		<td width="1" valign="top"> 
			<table width="1" height="10" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			    <tr> 
					<td> </td>
			    </tr>
			 </table>
		<td width="115" align="center"><font color="#FFFFFF">download</font></td>
		<td width="1" valign="top"> 
			<table width="1" height="10" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			    <tr> 
					<td> </td>
			    </tr>
			 </table>
		</td>
		<td width="110" align="center"><font color="#FFFFFF">등록일</font></td>
		<td width="1" valign="top"> 
			<table width="1" height="10" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
				<tr> 
					<td> </td>
				</tr>
			</table>
		</td>
	</tr>

<?	if ( $total_record == 0) :  ?>
		<table width=70% border=0 cellpadding=0 cellspacing=0>
			<tr><td height=20></td></tr>
			<tr><td align=center><font color=blue><?= $search_key ?></font> 는 존재하지 않습니다.</td></tr>
		</table>
<? endif ?>



<? for( $loop=0; $loop<$db2->total_record(); $loop++ ) : ?>
<?



$db2->fetch();


$rs_cd_image_no				= $db2->result( 'cd_image_no' );
$rs_image_no					= $db2->result( 'image_no' );
$rs_download_folder			= $db2->result( 'download_folder' );
$rs_single_order_no			= $db2->result( 'single_order_no' );
$rs_image_name				= $db2->result( 'image_name' );
$rs_reg_date 					= $db2->result( 'reg_date' );


$rs_image_no 					= $db2->result( 'image_no' );
$rs_product_class				= $db2->result( 'product_class' );
$rs_cd_order_no 				= $db2->result( 'cd_order_no' );
$rs_single_order_no 			= $db2->result( 'single_order_no' );
$rs_data_folder_no				= $db2->result( 'data_folder_no' );
$rs_data_folder_name			= $db2->result( 'data_folder_name' );



?>


               <tr onMouseOver=this.style.backgroundColor='#F5F5F5' onMouseOut=this.style.backgroundColor='#ffffff' height=80> 
			
			<td align="center"><?=$total_record - ( ( $page - 1 ) * $max_show_list ) - $loop?></td>
			<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center" style="padding:5 0 5 0;">
			<img src="../../image.php?data_folder=<?=$rs_data_folder_name?>&sub_folder=<?=$rs_cd_order_no?>&size=80&image_name=<?=$rs_image_name?>" border=1 style="border-color:#AAAAAA">
			</td>
			<td align="center">&nbsp;</td>
			<td align="center"><?=$rs_image_name?></td>
			<td align="center">&nbsp;</td>
			<td align="center"><font size=2 color=#FF9966><?=$rs_cd_order_no?></font></td>
			<td align="center">&nbsp;</td>
			<td align="center"><?=$rs_single_order_no?></td>
			<td align="center">&nbsp;</td>
			<td align="center"><?=$rs_data_folder_name?></td>
			<td align="center">&nbsp;</td>
			<td align="center"><? if( $rs_image_no == "") echo "<font  color=#EC0000>NO</font>";  else echo "<font color=#0000FF>YES</font>"; ?></td>
			<td align="center">&nbsp;</td>
			<td align="center"><? if( !$rs_image_no == "") echo $rs_reg_date;  else echo "NO"; ?></td>
              </tr>
              <tr> 	
			<td height="1" colspan="16" bgcolor="#569BD3"></td>
              </tr>
<? endfor ?>
          </table>
<!--#############################	페이징  #################################### -->
	  <table width="70%" height=50 border="0" cellspacing="0" cellpadding="0">
              <tr> 
			<td align="center">
			<? if( $db->total_record() ) : ?>
			  <? page_list( $_SERVER['PHP_SELF'], $location); ?>
			<? endif ?>		
			</td>
              </tr>
            </table>
<!--#############################	페이징  #################################### -->
</body>
</html>