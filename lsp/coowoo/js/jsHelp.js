  var x = 0;
  var y = 0;
  var snow = 0;
  var sw = 0;
  var cnt = 0;
  var dir = 1;
  var offsetx = 3;
  var offsety = 3;
  var width = 180;
  var height = 50;

  over = overDiv.style;
  document.onmousemove = mouseMove;

  function drs(text, title) {dts(1,text);}

  function nd() {
    if ( cnt >= 1 ) { sw = 0 };
    if ( sw == 0 ) { snow = 0; hideObject(over); }
    else { cnt++; }
  }

  function dts(d,text) {
    txt = "<TABLE WIDTH=230 STYLE=\"border:1 #e9e9e9 solid\" CELLPADDING=5 CELLSPACING=0 BORDER=0><TR><TD BGCOLOR=#ffffff><FONT COLOR=#555555>"+text+"</FONT></TD></TR></TABLE>"
    layerWrite(txt);
    dir = d;
    disp();
  }

  function disp() {
    if (snow == 0) {
      if (dir == 2) { moveTo(over,x+offsetx-(width/2),y+offsety); } // Center
      if (dir == 1) { moveTo(over,x+offsetx,y+offsety); } // Right
      if (dir == 0) { moveTo(over,x-offsetx,y+offsety); } // Left
      showObject(over);
      snow = 1;
    }
  }

  function mouseMove(e) {
    x=event.x + document.body.scrollLeft+10
    y=event.y + document.body.scrollTop
    if (x+width-document.body.scrollLeft > document.body.clientWidth) x=x-width-25;
    if (y+height-document.body.scrollTop > document.body.clientHeight) y=y-height;

    if (snow) {
      if (dir == 2) { moveTo(over,x+offsetx-(width/2),y+offsety); } // Center
      if (dir == 1) { moveTo(over,x+offsetx,y+offsety); } // Right
      if (dir == 0) { moveTo(over,x-offsetx,y+offsety); } // Left
    }
  }

  function cClick() { hideObject(over); sw=0; }
  function layerWrite(txt) { document.all["overDiv"].innerHTML = txt; }
  function showObject(obj) { obj.visibility = "visible"; }
  function hideObject(obj) { obj.visibility = "hidden"; }
  function moveTo(obj,xL,yL) { obj.left = xL; obj.top = yL; }
