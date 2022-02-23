function flashObject(file_name,flashVar,width,height){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="' + width + '" height="' + height + '">');
  document.write('<param name="movie" value="' + file_name + '">');
  document.write('<param name=FlashVars value="' + flashVar + '">');
  document.write('<param name="quality" value="high">');
  document.write('<param name="bgcolor" value="#ffffff">');
  document.write('<param name="wmode" value="transparent">');
  document.write('<param name="allowScriptAccess" value="always">');
  document.write('<param name="base" value=".">');
  document.write('<embed src="' + file_name +'" FlashVars="' + flashVar +'" width="' + width + '" height="' + height + '" quality="high" bgcolor="#ffffff" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent" allowScriptAccess="always" allowNetworking="all" base="."></embed>');
  document.write('</object>');
}
