<?

require_once "../../../include/include.php";

$src = request( 'src', 'get' );
$src_image = "../../../jacket/200/{$src}";

$size = getimagesize( $src_image );

?>
<script language=javascript>
	window.resizeTo( <?=$size[0] + 10?>, <?=$size[1] + 46?> )
	window.focus();
</script>
<html>
<title>viewPic</title>
<script language="JavaScript"> 
<!-- 
function tmt_winCentre() { 
if (document.layers) { 
var sinist = screen.width / 2 - outerWidth / 2; 
var toppo = screen.height / 2 - outerHeight / 2; 
} else { 
var sinist = screen.width / 2 - document.body.offsetWidth / 2; 
var toppo = -75 + screen.height / 2 - document.body.offsetHeight / 2; 
} 
self.moveTo(sinist, toppo); 
}
-->
</script>
<body leftmargin=0 topmargin=0 onLoad="tmt_winCentre()">
<a href="javascript:self.close()"><img src="<?=$src_image?>" border=0></a>
</body>
</html>