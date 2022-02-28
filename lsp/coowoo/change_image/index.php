  <link rel="stylesheet" href="css/style.css" type="text/css">
  <table width="366" border="0" cellpadding="0" cellspacing="0">
	<tr> 
	  <td>

<script language=javascript>
<!--


function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}


function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}






	function changeHotSale( no )
	{
		if( 1 == no )
		{
			HotSaleImage.src = 'images/main_0603/hot2_1.gif';
			HotSaleLink.href = "http://www.daum.net";
		}
		else if( 2 == no )
		{
			HotSaleImage.src = 'images/main_0603/hot2_2.gif';
			HotSaleLink.href = "http://www.naver.com";
		}
		else if( 3 == no )
		{
			HotSaleImage.src = 'images/main_0603/hot2_3.gif';
			HotSaleLink.href = "http://empas.com";
		}
	}



-->
</script>

	    <table width="366" border="0" cellpadding="0" cellspacing="0">
	      <tr>
		<td width="292"><img src="images/main_0603/hot1_1.gif" width="292" height="27"></td>
		<td width="19"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="changeHotSale(1);"><img name="Image69" border="0" src="images/main_0603/hot1_2_1.gif" width="19" height="27"></a></td>
		<td width="22"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="changeHotSale(2);"><img name="Image70" border="0" src="images/main_0603/hot1_3_1.gif" width="22" height="27"></a></td>
		<td width="20"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="changeHotSale(3);"><img name="Image71" border="0" src="images/main_0603/hot1_4_1.gif" width="20" height="27"></a></td>
		<td><img src="images/main_0603/hot1_5.gif" width="13" height="27"></td>
	      </tr>
	    </table>
	  </td>
	</tr>
	<tr> 
	  <td height="2"></td>
	</tr>
	<tr> 
	  <td><a href="#" name=HotSaleLink><img name="HotSaleImage"  src="images/main_0603/hot2_1.gif " style="cursor:hand" border=0></a></td>
	</tr>
      </table>



<BR>



<table width="229" border="0" cellpadding="0" cellspacing="0">
	<tr> 
		<td><img src="images/main_0603/event3_1.gif" width="229" height="38"></td>
	</tr>
</table>

<table width="229" border="0" cellpadding="0" cellspacing="0"  background="images/main_0603/event3_2.gif">
	<tr> 
		<td   width="215" height="172" >
		  
			<?

			$new_cd = array( 'DAJ352','ZZ015','KCD286','CAS011','ZZ016','NDX093','MS006','BXX329','IS169','IS297','IS406','ID076','MR162','MZ080','CD159');
			shuffle( $new_cd );

			?>

			<DIV  style="LEFT: 20px; OVERFLOW: hidden; WIDTH: 205px; POSITION: relative; TOP: 5px; HEIGHT: 150px"  width="206" height="124"> 
			<? for( $loop=0; $loop<count( $new_cd ); $loop++ ) : ?>


			<DIV id=RollingBanner style="LEFT: 0px; VISIBILITY: visible; WIDTH: 205px; POSITION: absolute; TOP: 0px; HEIGHT: 150px">

			<table width="190" height="130" border="0" cellpadding="0" cellspacing="0">
			     <tr> 
				   <td width="80"><a href="search/cd.html?cd_no=<?=$cd_no?>"><img src="http://www.coowoo.com/jacket/80/<?=$pc->jacket_pic?>" width="80" height="80" border="0"></a></td>
				   <td width="5">&nbsp;</td>
				   <td align=left><a href="search/cd.html?cd_no=<?=$cd_no?>"><font color=#000000><?=$new_cd[$loop]?></td>
			    </tr>
			    <tr>
				<td colspan=3 align=right>
					<table border=0>
						<tr>
							<td align=right>
								...
							</td>
							<td width=30>
							</td>
						</tr>
					</table>
				</td>
			    </tr>
			  </table>

			  </DIV>
			<? endfor ?>
			</DIV>
			<SCRIPT language=JavaScript1.2  src="js/Rolling_Banner.js"></SCRIPT> 

		  </td>
		  <td>
			<TABLE cellSpacing=0 cellPadding=0 width=7  border=0>
			<TBODY>
				<TR> 
					<TD height=3></TD>
			        </TR>
			        <TR> 
					<TD><A href="javascript:RollingUp()"><img src="images/main_0603/allow_up.gif" width="7" height="10" border="0"></a></TD>
			        </TR>
			        <TR> 
					<TD width=7 height=130 align=middle background="images/main_0603/scroll_bg.gif"></TD>
			        </TR>
			        <TR> 
					<TD><A href="javascript:RollingDown()"><img src="images/main_0603/allow_down.gif" width="7" height="10" border="0"></a></TD>
			        </TR>
			</TBODY>
			</TABLE>
		</td>
            </tr>
        </table>

