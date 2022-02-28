<?php
require_once './tcpdf_import.php';
 
$html = '<h1>안녕 친구들</h1>
<p style="color:#CC0000;">TCPDF 라이브러리 한글 예제</p>
<pre>1행			탭탭탭 엔터
2행			pre 테스트...</pre>';
 
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetFont('nanumgothic'); 
$pdf->SetDefaultMonospacedFont('nanumgothic_coding');
$pdf->AddPage();
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output( 'webtest1.pdf', 'D');

?>