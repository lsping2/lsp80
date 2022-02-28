<?php

require_once "./menu/include/include.php";
$db = new mysql();



$query = "SELECT	count(*) as cnt
			FROM	notice_bbs";
						
		$db->query( $query );
		$db->fetch();

?>
<!DOCTYPE html> 
<html lang="kr"> 
<head> 
<!-- <meta charset="utf8" /> -->
<meta name="app-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="apple-touch-fullscreen" content="YES" />
<meta name="viewport" content="width=device-width;initial-scale=1.0;;minimum-scale=1.0; maximun-scale=0;"/>
<title>lsp test</title> 

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a3/jquery.mobile-1.0a3.min.css" />
<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
<script src="http://code.jquery.com/mobile/1.0a3/jquery.mobile-1.0a3.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){ 
	setTimeout(scrollTo, 0, 0, 1); 
	$.extend(  $.mobile, { ajaxFormsEnabled: false });
});
</script>
</head> 
<body>
     <!-- Start of first page -->
    <div data-role="page" id="page_main" data-theme="b">
 
              <div data-role="header" >
                     <h1>test lsp</h1>
              </div><!-- /header -->
       
              <div data-role="content">
				<ul data-role="listview" data-inset="false" data-theme="d" data-split-theme="d" data-ajax="false">
						<li><a data-transition="flip" href="jisa_list.php">지사현황</a><span class="ui-li-count"><?=$db->result('cnt')?></span></li>
						<li><a data-transition="slideup" href="acess_list.php" data-ajax="false">접속자조회</a></li>
						<li><a data-transition="slideup" href="geo.php" data-ajax="false">지도</a></li>

                  </ul>
              </div><!-- /content -->       
             
			 <div data-role="footer" data-position="fixed">
				 <h4></h4>
			</div><!-- /header -->
       </div><!-- /page -->
    </div>
     
</body>
</html>