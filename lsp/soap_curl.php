<?php
  $soap_request  = "<?xml version=\"1.0\"?>\n";
  $soap_request .= "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:head=\"http://apache.org/headers\" xmlns:soap=\"http://soap.electron.po.acrc/\">\n";
  $soap_request .= "   <soapenv:Header>\n";
  $soap_request .= "      <head:ComMsgHeader>\n";
  $soap_request .= "         <RequestMsgID></RequestMsgID>\n";
  $soap_request .= "         <ServiceKey>sgfl9j65wOgk2QIoSz21hJKEKx3ISbXoYhbxmqXCu2g+aab2sntZ7Hp8Z6Z7HfcTnMGNWSyxaVeeI54C101uUA==</ServiceKey>\n";
  $soap_request .= "         <!--Optional:-->\n";
  $soap_request .= "         <RequestTime></RequestTime>\n";
  $soap_request .= "         <!--Optional:-->\n";
  $soap_request .= "         <CallBackURI></CallBackURI>\n";
  $soap_request .= "      </head:ComMsgHeader>\n";
  $soap_request .= "   </soapenv:Header>\n";
  $soap_request .= "   <soapenv:Body>\n";
  $soap_request .= "      <soap:getElectronPublicHearingItem>\n";
  $soap_request .= "         <!--Optional:-->\n";
  $soap_request .= "         <ElectronItemRequest>\n";
  $soap_request .= "            <appNo>$appNo</appNo>\n";
  $soap_request .= "         </ElectronItemRequest>\n";
  $soap_request .= "      </soap:getElectronPublicHearingItem>\n";
  $soap_request .= "   </soapenv:Body>\n";
  $soap_request .= "</soapenv:Envelope>";
  
  $header = array(
  	"Accept-Encoding: gzip,deflate",
  	"Content-Type: text/xml;charset=UTF-8",
  	"SOAPAction: run",
  	"Content-length: ".strlen($soap_request),
  	"Host: api.epeople.go.kr",
  	"Connection: Keep-Alive",
  	"User-Agent: Apache-HttpClient/4.1.1 (java 1.5)"
  );
  
  $soap_do = curl_init();
  curl_setopt($soap_do, CURLOPT_URL, "http://api.epeople.go.kr/soap/GetElectronPublicHearingService" );
  curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
  curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
  curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($soap_do, CURLOPT_POST,           true );
  curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $soap_request);
  curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header);
  
  $soap_response = curl_exec($soap_do);
  
  if(curl_exec($soap_do) === false) {
  	
    $err = 'Curl error: ' . curl_error($soap_do);
    curl_close($soap_do);
    print $err;
    
  }else {
  	
    curl_close($soap_do);
	
	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = false;
	$doc->loadXML( $soap_response );
	
	$xpath = new DOMXpath( $doc);

	$xpath->registerNamespace('atom', "http://www.w3.org/2005/Atom");
	
	$items = $doc->getElementsByTagName('ElectronItemResponse');
	$Fileitems = $doc->getElementsByTagName('fileList');
	
	//view
	foreach( $items as $item) {
		$title = $xpath->query( 'title', $item)->item(0)->nodeValue; //제목
		$startDate = $xpath->query( 'startDate', $item)->item(0)->nodeValue; //포럼일정from
		$endDate = $xpath->query( 'endDate', $item)->item(0)->nodeValue; //포럼일정to
		$nm = $xpath->query( 'nm', $item)->item(0)->nodeValue; //발제자
		$summary = $xpath->query( 'summary', $item)->item(0)->nodeValue; //발제요약
		$content = $xpath->query( 'content', $item)->item(0)->nodeValue; //발제정보
		$subAncName = $xpath->query( 'subAncName', $item)->item(0)->nodeValue; //산하기관명
		$appntGubun = $xpath->query( 'appntGubun', $item)->item(0)->nodeValue; //공청회구분
		
	}
	

  }

?>

<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/soap/style.css">

<div class="tbl_frm01 tbl_wrap">
	<table border="0" cellpadding="0" cellspacing="0">
      <tbody>  
        <tr>
            <th width="150" align="center">제목</th>
            <td align="left" colspan="3"><?=$title?></td>
        </tr>         
        <tr>
            <th width="150" align="center">예고일자</th>
            <td align="left"><?=$startDate?></td>
            <th width="150" align="center">마감일자</th>
            <td align="left"><?=$endDate?></td>            
        </tr>	
        <tr>
            <th width="150" align="center">소관부처</th>
            <td align="left" colspan="3"><?=$nm?></td>         
        </tr>
        <tr>
            <th width="150" align="center">발제요약</th>
            <td align="left" colspan="3"><?=nl2br($summary)?></td>
        </tr>        
        <tr>
            <th width="150" align="center">내용</th>
            <td align="left" colspan="3"><?=nl2br($content)?></td>
        </tr>	
        <tr>
            <th width="150" align="center">첨부파일</th>
            <td align="left" colspan="3">
            <? 
            //fileview
            foreach( $Fileitems as $item) {
            
            	$fileName = $xpath->query( 'fileName', $item)->item(0)->nodeValue; //파일경로
            	$newFileName = $xpath->query( 'newFileName', $item)->item(0)->nodeValue; //파일명
            	$docId = $xpath->query( 'docId', $item)->item(0)->nodeValue; //파일인덱스            
            ?>
            	<a href="javascript:alert('파일을 다운받으시려면 국민신문고로 이동해주시길 바랍니다.');"><?=$newFileName?></a><br>
            <? } ?>
            </td>
        </tr>	        
      </tbody>
	</table>
</div>

<a href="javascript:history.back();" class="btn_b02">목록</a>

