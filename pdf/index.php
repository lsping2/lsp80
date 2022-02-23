<?php
include_once('./_common.php');
require_once 'tcpdf_import.php';
 /*
$html = '<h1>안녕 친구들</h1>
<p style="color:#CC0000;">TCPDF 라이브러리 한글 예제</p>
<p>하나 1. test</p>
<p>둘 2. test</p>
<p>셋 3. test</p>
';
*/

 $sql = " 
	select	bf_file
	from		g5_board_file
	where	bo_table ='area'
	and	wr_id = '3'
	";
$row = sql_fetch($sql);


$html = '<h2>HTML TABLE:</h2>
<table border="0" cellspacing="2" cellpadding="1" bgcolor="#efefef">
	<tr bgcolor="white">
		<th bgcolor="white">번호(no)</th>
		<th bgcolor="white" align="right">오른쪽 한글</th>
		<th bgcolor="white" align="left">LEFT align</th>
		<th bgcolor="white" >4A</th>
	</tr>
	<tr bgcolor="white">
		<td bgcolor="white">1</td>
		<td bgcolor="white" align="center" colspan="2">좋아요 좋아요
		감사해요<br>
		테스트<br>
		<img src="/data/file/area/'.$row['bf_file'].'" alt="test alt attribute" width="100" height="100" border="0" />
		<br>
		</td>
		<td bgcolor="white">'.date('Ymd H:i:s').'</td>
	</tr>
</table>';
 
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetFont('nanumbarungothicyethangul', '', 7);
//$pdf->SetDefaultMonospacedFont('nanumgothic_coding');
$pdf->AddPage();
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output( 'webtest1.pdf', 'D');

?>