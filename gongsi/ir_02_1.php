<html>
<head>
<script src="http://lsp80.cafe24.com/js/jquery-1.8.3.min.js"></script>
<script src="http://lsp80.cafe24.com/js/jquery.menu.js"></script>
<script src="http://lsp80.cafe24.com/js/common.js"></script>
<script src="http://lsp80.cafe24.com/js/wrest.js"></script>
<style>
#paging {width:740px;text-align:center;position:relative;}
#paging p {position:absolute;padding-left:150px;}
#ir_table {border-collapse:collapse;}
#ir_table tr {height:28px;}
#ir_table th {font-size:12px;color:#000099;border-top:2px solid #dddddd;border-bottom:1px solid #dddddd;}
#ir_table td {border-left:1px solid #dddddd;border-bottom:1px solid #dddddd;}
#ir_table .nlb {border-left:0px solid #dddddd;}
</style>
</head>
<body>
<table width="960" border="0" cellspacing="0" cellpadding="0">

<tr>
    <td>
        <table width="960" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="11"></td>
                </tr>
                <tr>
                    <td>
                        <table width="250" border="0" cellspacing="0" cellpadding="0">
                       <tr>
                            <td width="11">&nbsp;</td>
                            <td><a href="./ir_02.php"><img src="../images/ir/about01_tap01-.gif" width="125" height="29" /></a></td>
                            <td width="1">&nbsp;</td>
                            <td><a href="./ir_02_1.php"><img src="../images/ir/about01_tap02.gif" width="125" height="29" /></a></td>
                            <td width="1">&nbsp;</td>
                            <!--<td><a href="javascript:menu10sub2_2()"><img src="../images/ir/about01_tap03.gif" width="125" height="29" /></a></td>-->
                            <td width="1">&nbsp;</td>
                            <td width="125">
                                &nbsp;
                                <!--아래는 재무정보 -->
                                <!--<a href="#"><img src="../images/ir/about01_tap04.gif" width="125" height="29" /></a>-->
                            </td>
                            <td width="300">&nbsp;</td>
                        </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
				<div id="listing"></div>
				<div id="paging"></div>
            </td>
        </tr>
        </table>
    </td>
</tr>
</table>

</body>
</html>

<script type="text/javascript">
$(document).ready(function() 
{
	$.ajax({
		type: "GET",
		url: "./test.php?page_no=<?=$page_no?>",
		dataType: "xml",
		success: parseXml
	});
});
function parseXml(xml)
{
	var page_str = "";
	<? if ($page_no == "") { ?>
	var page_no = "";
	<? } else { ?>
	var page_no = <?=$page_no?>;
	<? } ?>
	var page_set = 15;
	var total_count = 0;
	var total_page = 0;
	var ff = cc = "";
	if (page_no == "" || page_no < 1) {
		page_no = 1;
	}
	if (page_no > 1) {
		wr_num = parseInt((page_no-1) * 15) + 1;
	} else {
		wr_num = 1;
	}
	var str = '<table width="740" cellspacing="0" cellpadding="0" border="0" id="ir_table"><colgroup><col width="6%" /><col width="15%" /><col width="47%" /><col width="15%" /><col width="10%" /><col width="8%" /></colgroup><thead><tr><th align="center">번호</th><th align="center">공시대상회사</th><th align="center">보고서명</th><th align="center">제출인</th><th align="center">접수일자</th><th align="center">비고</th></tr></thead>';
	$(xml).find("list").each(function()
	{
		var crp_cls = rmk_mark = "";
		var rmk = $(this).find("rmk").text();
		if ($(this).find("crp_cls").text() == "Y") {
			crp_cls = "<img src='/images/ir/ico_yuka.gif' />";
		} else if ($(this).find("crp_cls").text() == "K") {
			crp_cls = "<img src='/images/ir/ico_kosdaq.gif' />";
		} else if ($(this).find("crp_cls").text() == "N") {
			crp_cls = "<img src='/images/ir/ico_konex.gif' />";
		} else if ($(this).find("crp_cls").text() == "E") {
			crp_cls = "<img src='/images/ir/ico_kita.gif' />";
		}
		var rcp_dt = $(this).find("rcp_dt").text();
		var rcp_dt1 = rcp_dt.substr(0, 4);
		var rcp_dt2 = rcp_dt.substr(4, 2);
		var rcp_dt3 = rcp_dt.substr(6, 2);
		var rcp_dtt = rcp_dt1 + "." + rcp_dt2 + "." + rcp_dt3;
		var rmk = $(this).find("rmk").text();
		if (rmk.match(/유/i)) {
			rmk_mark += "<img src='/images/ir/remark01.gif' />&nbsp;";
		}
		if (rmk.match(/코/i)) {
			rmk_mark += "<img src='/images/ir/remark02.gif' />&nbsp;";
		}
		if (rmk.match(/채/i)) {
			rmk_mark += "<img src='/images/ir/remark03.gif' />&nbsp;";
		}
		if (rmk.match(/넥/i)) {
			rmk_mark += "<img src='/images/ir/remark04.gif' />&nbsp;";
		}
		if (rmk.match(/공/i)) {
			rmk_mark += "<img src='/images/ir/remark05.gif' />&nbsp;";
		}
		if (rmk.match(/연/i)) {
			rmk_mark += "<img src='/images/ir/remark06.gif' />&nbsp;";
		}
		if (rmk.match(/정/i)) {
			rmk_mark += "<img src='/images/ir/remark07.gif' />&nbsp;";
		}
		if (rmk.match(/철/i)) {
			rmk_mark += "<img src='/images/ir/remark08.gif' />&nbsp;";
		}
		str += "<tr><td class='nlb' align='center'>" + wr_num + "</td><td>&nbsp;" + crp_cls + "&nbsp;" + $(this).find("crp_nm").text() + "</td><td>&nbsp;<a href='#' onclick='openDart(" + $(this).find("rcp_no").text() + ");'>" + $(this).find("rpt_nm").text() + "</a></td><td>&nbsp;" + $(this).find("flr_nm").text() + "</td><td align='center'>" + rcp_dtt + "</td><td align='center'>&nbsp;" + rmk_mark + "</td></tr>";
		wr_num++;
	});
	str += '</table><br/>';
	$("#listing").append(str);

	//find every Tutorial and print the author
	$(xml).find("page_set").each(function() { page_set = $(this).text(); });
	$(xml).find("total_count").each(function() { total_count = $(this).text(); });
	$(xml).find("total_page").each(function() { total_page = $(this).text(); });

	if (page_no > 10) {
		page_str += "<a href='<?=$_SERVER[PHP_SELF]?>?page_no=1'><img src='/skin/board/basic/img/page_begin.gif'></a>&nbsp;";
	}
	if (page_no > 1) {
		page_str += "<a href='<?=$_SERVER[PHP_SELF]?>?page_no="+parseInt(page_no-1)+"'><img src='/skin/board/basic/img/page_prev.gif'></a>&nbsp;";
	}
	if (page_no > 10) {
		ff = parseInt(parseInt(page_no / 10) * 10) + 1;
		cc = parseInt(parseInt(page_no / 10) * 10) + 10;
		if (cc > total_page) {
			cc = total_page;
		}
	} else {
		ff = 1;
		cc = 10;
		if (cc > total_page) {
			cc = total_page;
		}
	}
	for (var i=ff; i <= cc; i++) {
		if (i == page_no) {
			page_str += "&nbsp;<a href='<?=$_SERVER[PHP_SELF]?>?page_no="+i+"'><span style='color:red;font-weight:bold;'>"+i+"</span></a>&nbsp;";
		} else {
			page_str += "&nbsp;<a href='<?=$_SERVER[PHP_SELF]?>?page_no="+i+"'>"+i+"</a>&nbsp;";
		}
	}
	if (total_page > page_no) {
		page_str += "&nbsp;<a href='<?=$_SERVER[PHP_SELF]?>?page_no="+page_no+1+"'><img src='/skin/board/basic/img/page_next.gif'></a>";
	}
	if (total_page > cc) {
		page_str += "&nbsp;<a href='<?=$_SERVER[PHP_SELF]?>?page_no="+total_page+"'><img src='/skin/board/basic/img/page_end.gif'></a>";
	}
	page_str += "<p class='page_info'>["+page_no+"/"+total_page+"] [총 "+total_count+" 건]</p>";
	$("#paging").append(page_str);
}
function openDart(val){
	window.open("http://dart.fss.or.kr/dsaf001/main.do?rcpNo="+val, '',  "width=1024,height=770,resizable=yes");
	return false;
}
</script>

