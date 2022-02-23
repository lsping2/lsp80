// THIS FILE HAS BEEN MINIFIED

if(typeof(RGraph) == 'undefined') RGraph = {isRGraph:true,type:'common'};RGraph.tooltips = {};RGraph.tooltips.padding = '3px';RGraph.tooltips.font_face = 'Tahoma';RGraph.tooltips.font_size = '10pt';RGraph.Tooltip = function (canvas, text, x, y, idx)
{
if(typeof(canvas.__object__.Get('chart.tooltips.override')) == 'function'){
return canvas.__object__.Get('chart.tooltips.override')(canvas, text, x, y, idx);}
text = RGraph.getTooltipTextFromDIV(text);var timers = RGraph.Registry.Get('chart.tooltip.timers');if(timers && timers.length){
for (i=0; i<timers.length; ++i){
clearTimeout(timers[i]);}
}
RGraph.Registry.Set('chart.tooltip.timers', []);if(canvas.__object__.Get('chart.contextmenu')){
RGraph.HideContext();}
if(canvas.__object__.Get('chart.tooltips.highlight')){
RGraph.Redraw(canvas.id);}
var effect = canvas.__object__.Get('chart.tooltips.effect').toLowerCase();if(effect == 'snap' && RGraph.Registry.Get('chart.tooltip') && RGraph.Registry.Get('chart.tooltip').__canvas__.id == canvas.id){
if(   canvas.__object__.type == 'line'
|| canvas.__object__.type == 'radar'
|| canvas.__object__.type == 'scatter'
|| canvas.__object__.type == 'rscatter'
){
var tooltipObj = RGraph.Registry.Get('chart.tooltip');tooltipObj.style.width = null;tooltipObj.style.height = null;tooltipObj.innerHTML = text;tooltipObj.__text__ = text;RGraph.Registry.Get('chart.tooltip').style.width = RGraph.getTooltipWidth(text, canvas.__object__) + 'px';RGraph.Registry.Get('chart.tooltip').style.height = RGraph.Registry.Get('chart.tooltip').offsetHeight + 'px';if(typeof(jQuery) == 'function' && typeof($) == 'function'){
$('#' + tooltipObj.id).animate({
opacity: 1,
width: tooltipObj.offsetWidth + 'px',
height: tooltipObj.offsetHeight + 'px',
left: x + 'px',
top: (y - tooltipObj.offsetHeight) + 'px'
}, 300);} else {
var currentx = parseInt(RGraph.Registry.Get('chart.tooltip').style.left);var currenty = parseInt(RGraph.Registry.Get('chart.tooltip').style.top);var diffx = x - currentx - ((x + RGraph.Registry.Get('chart.tooltip').offsetWidth) > document.body.offsetWidth ? RGraph.Registry.Get('chart.tooltip').offsetWidth : 0);var diffy = y - currenty - RGraph.Registry.Get('chart.tooltip').offsetHeight;setTimeout('RGraph.Registry.Get("chart.tooltip").style.left = "' + (currentx + (diffx * 0.2)) + 'px"', 25);setTimeout('RGraph.Registry.Get("chart.tooltip").style.left = "' + (currentx + (diffx * 0.4)) + 'px"', 50);setTimeout('RGraph.Registry.Get("chart.tooltip").style.left = "' + (currentx + (diffx * 0.6)) + 'px"', 75);setTimeout('RGraph.Registry.Get("chart.tooltip").style.left = "' + (currentx + (diffx * 0.8)) + 'px"', 100);setTimeout('RGraph.Registry.Get("chart.tooltip").style.left = "' + (currentx + (diffx * 1.0)) + 'px"', 125);setTimeout('RGraph.Registry.Get("chart.tooltip").style.top = "' + (currenty + (diffy * 0.2)) + 'px"', 25);setTimeout('RGraph.Registry.Get("chart.tooltip").style.top = "' + (currenty + (diffy * 0.4)) + 'px"', 50);setTimeout('RGraph.Registry.Get("chart.tooltip").style.top = "' + (currenty + (diffy * 0.6)) + 'px"', 75);setTimeout('RGraph.Registry.Get("chart.tooltip").style.top = "' + (currenty + (diffy * 0.8)) + 'px"', 100);setTimeout('RGraph.Registry.Get("chart.tooltip").style.top = "' + (currenty + (diffy * 1.0)) + 'px"', 125);}
} else {
alert('[TOOLTIPS] The "snap" effect is only supported on the Line, Rscatter, Scatter and Radar charts (tried to use it with type: ' + canvas.__object__.type);}
RGraph.FireCustomEvent(canvas.__object__, 'ontooltip');return;}
RGraph.HideTooltip();var tooltipObj = document.createElement('DIV');tooltipObj.className = canvas.__object__.Get('chart.tooltips.css.class');tooltipObj.style.display = 'none';tooltipObj.style.position = 'absolute';tooltipObj.style.left = 0;tooltipObj.style.top = 0;tooltipObj.style.backgroundColor = 'rgba(255,255,239,0.9)';tooltipObj.style.color = 'black';if(!document.all) tooltipObj.style.border = '';tooltipObj.style.visibility = 'visible';tooltipObj.style.paddingLeft = RGraph.tooltips.padding;tooltipObj.style.paddingRight = RGraph.tooltips.padding;tooltipObj.style.fontFamily = RGraph.tooltips.font_face;tooltipObj.style.fontSize = RGraph.tooltips.font_size;tooltipObj.style.zIndex = 3;tooltipObj.style.borderRadius = '5px';tooltipObj.style.MozBorderRadius = '5px';tooltipObj.style.WebkitBorderRadius = '5px';tooltipObj.style.WebkitBoxShadow = 'rgba(96,96,96,0.5) 0 0 15px';tooltipObj.style.MozBoxShadow = 'rgba(96,96,96,0.5) 0 0 15px';tooltipObj.style.boxShadow = 'rgba(96,96,96,0.5) 0 0 15px';tooltipObj.style.filter = 'progid:DXImageTransform.Microsoft.Shadow(color=#666666,direction=135)';tooltipObj.style.opacity = 0;tooltipObj.style.overflow = 'hidden';tooltipObj.innerHTML = text;tooltipObj.__text__ = text;tooltipObj.__canvas__ = canvas;tooltipObj.style.display = 'inline';tooltipObj.id = '__rgraph_tooltip_' + canvas.id + '_' + idx;if(typeof(idx) == 'number'){
tooltipObj.__index__ = idx;if(canvas.__object__.type == 'line'){
var index2 = idx;while (index2 >= canvas.__object__.data[0].length){
index2 -= canvas.__object__.data[0].length;}
tooltipObj.__index2__ = index2;}
}
document.body.appendChild(tooltipObj);var width = tooltipObj.offsetWidth;var height = tooltipObj.offsetHeight;if((y - height - 2) > 0){
y = y - height - 2;} else {
y = y + 2;}
tooltipObj.style.width = width + 'px';if( (x + width) > document.body.offsetWidth ){
x = x - width - 7;var placementLeft = true;if(canvas.__object__.Get('chart.tooltips.effect') == 'none'){
x = x - 3;}
tooltipObj.style.left = x + 'px';tooltipObj.style.top = y + 'px';} else {
x += 5;tooltipObj.style.left = x + 'px';tooltipObj.style.top = y + 'px';}
if(effect == 'expand'){
tooltipObj.style.left = (x + (width / 2)) + 'px';tooltipObj.style.top = (y + (height / 2)) + 'px';leftDelta = (width / 2) / 10;topDelta = (height / 2) / 10;tooltipObj.style.width = 0;tooltipObj.style.height = 0;tooltipObj.style.opacity = 1;RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) - leftDelta) + 'px' }", 25));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) - leftDelta) + 'px' }", 50));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) - leftDelta) + 'px' }", 75));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) - leftDelta) + 'px' }", 100));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) - leftDelta) + 'px' }", 125));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) - leftDelta) + 'px' }", 150));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) - leftDelta) + 'px' }", 175));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) - leftDelta) + 'px' }", 200));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) - leftDelta) + 'px' }", 225));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) - leftDelta) + 'px' }", 250));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) - topDelta) + 'px' }", 25));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) - topDelta) + 'px' }", 50));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) - topDelta) + 'px' }", 75));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) - topDelta) + 'px' }", 100));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) - topDelta) + 'px' }", 125));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) - topDelta) + 'px' }", 150));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) - topDelta) + 'px' }", 175));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) - topDelta) + 'px' }", 200));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) - topDelta) + 'px' }", 225));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) - topDelta) + 'px' }", 250));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 0.1) + "px'; }", 25));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 0.2) + "px'; }", 50));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 0.3) + "px'; }", 75));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 0.4) + "px'; }", 100));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 0.5) + "px'; }", 125));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 0.6) + "px'; }", 150));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 0.7) + "px'; }", 175));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 0.8) + "px'; }", 200));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 0.9) + "px'; }", 225));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + width + "px'; }", 250));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 0.1) + "px'; }", 25));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 0.2) + "px'; }", 50));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 0.3) + "px'; }", 75));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 0.4) + "px'; }", 100));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 0.5) + "px'; }", 125));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 0.6) + "px'; }", 150));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 0.7) + "px'; }", 175));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 0.8) + "px'; }", 200));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 0.9) + "px'; }", 225));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + height + "px'; }", 250));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').innerHTML = RGraph.Registry.Get('chart.tooltip').__text__; }", 250));} else if(effect == 'contract'){
tooltipObj.style.left = (x - width) + 'px';tooltipObj.style.top = (y - (height * 2)) + 'px';tooltipObj.style.cursor = 'pointer';leftDelta = width / 10;topDelta = height / 10;tooltipObj.style.width = (width * 5) + 'px';tooltipObj.style.height = (height * 5) + 'px';tooltipObj.style.opacity = 0.2;RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) + leftDelta) + 'px' }", 25));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) + leftDelta) + 'px' }", 50));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) + leftDelta) + 'px' }", 75));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) + leftDelta) + 'px' }", 100));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) + leftDelta) + 'px' }", 125));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) + leftDelta) + 'px' }", 150));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) + leftDelta) + 'px' }", 175));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) + leftDelta) + 'px' }", 200));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) + leftDelta) + 'px' }", 225));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = (parseInt(RGraph.Registry.Get('chart.tooltip').style.left) + leftDelta) + 'px' }", 250));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) + (topDelta*2)) + 'px' }", 25));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) + (topDelta*2)) + 'px' }", 50));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) + (topDelta*2)) + 'px' }", 75));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) + (topDelta*2)) + 'px' }", 100));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) + (topDelta*2)) + 'px' }", 125));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) + (topDelta*2)) + 'px' }", 150));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) + (topDelta*2)) + 'px' }", 175));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) + (topDelta*2)) + 'px' }", 200));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) + (topDelta*2)) + 'px' }", 225));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = (parseInt(RGraph.Registry.Get('chart.tooltip').style.top) + (topDelta*2)) + 'px' }", 250));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 5.5) + "px'; }", 25));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 5.0) + "px'; }", 50));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 4.5) + "px'; }", 75));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 4.0) + "px'; }", 100));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 3.5) + "px'; }", 125));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 3.0) + "px'; }", 150));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 2.5) + "px'; }", 175));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 2.0) + "px'; }", 200));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + (width * 1.5) + "px'; }", 225));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.width = '" + width + "px'; }", 250));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 5.5) + "px'; }", 25));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 5.0) + "px'; }", 50));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 4.5) + "px'; }", 75));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 4.0) + "px'; }", 100));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 3.5) + "px'; }", 125));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 3.0) + "px'; }", 150));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 2.5) + "px'; }", 175));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 2.0) + "px'; }", 200));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + (height * 1.5) + "px'; }", 225));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.height = '" + height + "px'; }", 250));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').innerHTML = RGraph.Registry.Get('chart.tooltip').__text__; }", 250));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.cursor = 'default'; }", 275));} else if(effect == 'snap'){
for (var i=1; i<=10; ++i){
RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.left = '" + (x * 0.1 * i) + "px'; }", 15 * i));RGraph.Registry.Get('chart.tooltip.timers').push(setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.top = '" + (y * 0.1 * i) + "px'; }", 15 * i));}
tooltipObj.style.left = 0 - tooltipObj.offsetWidth + 'px';tooltipObj.style.top = 0 - tooltipObj.offsetHeight + 'px';} else if(effect != 'fade' && effect != 'expand' && effect != 'none' && effect != 'snap' && effect != 'contract'){
alert('[COMMON] Unknown tooltip effect: ' + effect);}
if(effect != 'none'){
setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.opacity = 0.1; }", 25);setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.opacity = 0.2; }", 50);setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.opacity = 0.3; }", 75);setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.opacity = 0.4; }", 100);setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.opacity = 0.5; }", 125);setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.opacity = 0.6; }", 150);setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.opacity = 0.7; }", 175);setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.opacity = 0.8; }", 200);setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.opacity = 0.9; }", 225);}
setTimeout("if(RGraph.Registry.Get('chart.tooltip')){ RGraph.Registry.Get('chart.tooltip').style.opacity = 1;}", effect == 'none' ? 50 : 250);tooltipObj.onmousedown = function (e)
{
e = RGraph.FixEventObject(e)
e.stopPropagation();}
tooltipObj.onclick = function (e)
{
if(e.button == 0){
e = RGraph.FixEventObject(e);e.stopPropagation();}
}
document.body.onmousedown = function (event)
{
var tooltip = RGraph.Registry.Get('chart.tooltip');if(tooltip){
RGraph.HideTooltip();if(tooltip.__canvas__.__object__.Get('chart.tooltips.highlight')){
RGraph.Redraw();}
}
}
window.onresize = function ()
{
var tooltip = RGraph.Registry.Get('chart.tooltip');if(tooltip){
tooltip.parentNode.removeChild(tooltip);tooltip.style.display = 'none';                
tooltip.style.visibility = 'hidden';RGraph.Registry.Set('chart.tooltip', null);if(canvas.__object__.Get('chart.tooltips.highlight')){
RGraph.Clear(canvas);canvas.__object__.Draw();}
}
}
RGraph.Registry.Set('chart.tooltip', tooltipObj);RGraph.FireCustomEvent(canvas.__object__, 'ontooltip');}
RGraph.getTooltipTextFromDIV = function (text)
{
var result = /^id:(.*)/.exec(text);if(result && result[1] && document.getElementById(result[1])){
text = document.getElementById(result[1]).innerHTML;} else if(result && result[1]){
text = '';}
return text;}
RGraph.parseTooltipText = function (tooltips, idx)
{
if(typeof(tooltips) == 'function'){
var text = tooltips(idx);} else if(typeof(tooltips) == 'object' && tooltips && typeof(tooltips[idx]) == 'function'){
var text = tooltips[idx](idx);} else if(typeof(tooltips) == 'object' && tooltips){
var text = String(tooltips[idx]);} else {
var text = '';}
if(text == 'undefined'){
text = '';} else if(text == 'null'){
text = '';}
return RGraph.getTooltipTextFromDIV(text);}
RGraph.getTooltipWidth = function (text, obj)
{
var div = document.createElement('DIV');div.className = obj.Get('chart.tooltips.css.class');div.style.paddingLeft = RGraph.tooltips.padding;div.style.paddingRight = RGraph.tooltips.padding;div.style.fontFamily = RGraph.tooltips.font_face;div.style.fontSize = RGraph.tooltips.font_size;div.style.visibility = 'hidden';div.style.position = 'absolute';div.style.top = '300px';div.style.left = 0;div.style.display = 'inline';div.innerHTML = RGraph.getTooltipTextFromDIV(text);document.body.appendChild(div);return div.offsetWidth;}
RGraph.HideTooltip = function ()
{
var tooltip = RGraph.Registry.Get('chart.tooltip');if(tooltip){
tooltip.parentNode.removeChild(tooltip);tooltip.style.display = 'none';                
tooltip.style.visibility = 'hidden';RGraph.Registry.Set('chart.tooltip', null);}
}
RGraph.InstallBarTooltipEventListeners = function (obj)
{
var window_onclick_func = function (){RGraph.Redraw();};window.addEventListener('click', window_onclick_func, false);RGraph.AddEventListener('window_' + obj.id, 'click', window_onclick_func);var canvas_onmousemove = function (e)
{
e = RGraph.FixEventObject(e);var canvas = document.getElementById(e.target.id);var obj = canvas.__object__;if(obj.__bar__){
var lineObj = obj;obj = obj.__bar__;obj.__line__ = lineObj;}
var barCoords = obj.getBar(e);if(barCoords && barCoords[4] > 0 && RGraph.parseTooltipText(obj.Get('chart.tooltips'), barCoords[5])){
var text = RGraph.parseTooltipText(obj.Get('chart.tooltips'), barCoords[5]);if(text){
canvas.style.cursor = 'pointer';} else {
canvas.style.cursor = 'default';}
if(   RGraph.Registry.Get('chart.tooltip')
&& RGraph.Registry.Get('chart.tooltip').__canvas__.id != obj.id
&& obj.Get('chart.tooltips.event') == 'onmousemove'){
RGraph.Redraw();RGraph.HideTooltip();}
if(   obj.Get('chart.tooltips.event') == 'onmousemove'
&& (
(RGraph.Registry.Get('chart.tooltip') && RGraph.Registry.Get('chart.tooltip').__index__ != barCoords[5])
|| !RGraph.Registry.Get('chart.tooltip')
)
&& text){
RGraph.Redraw(obj);if(obj.Get('chart.tooltips.highlight')){
obj.context.beginPath();obj.context.strokeStyle = obj.Get('chart.highlight.stroke');obj.context.fillStyle = obj.Get('chart.highlight.fill');obj.context.strokeRect(AA(this, barCoords[1]), barCoords[2], barCoords[3], barCoords[4]);obj.context.fillRect(AA(this, barCoords[1]), barCoords[2], barCoords[3], barCoords[4]);obj.context.stroke();obj.context.fill();}
RGraph.Tooltip(canvas, text, e.pageX, e.pageY, barCoords[5]);}
} else if(obj.__line__ && obj.__line__.getPoint && obj.__line__.getPoint(e)){
var point = obj.__line__.getPoint(e);var mouseCoords = RGraph.getMouseXY(e);var mouseX = mouseCoords[0];var mouseY = mouseCoords[1];if(   mouseX > (point[0] - 5)
&& mouseX < (point[0] + 5)
&& mouseY > (point[1] - 5)
&& mouseY < (point[1] + 5) ){
canvas.style.cursor = 'pointer';}
} else {
canvas.style.cursor = 'default';}
}
RGraph.AddEventListener(obj.id, 'mousemove', canvas_onmousemove);obj.canvas.addEventListener('mousemove', canvas_onmousemove, false);if(obj.Get('chart.tooltips.event') == 'onclick'){
var canvas_onclick = function (e)
{
var e = RGraph.FixEventObject(e);if(e.button != 0) return;e = RGraph.FixEventObject(e);var canvas = document.getElementById(this.id);var obj = canvas.__object__;if(obj.__bar__){
obj = obj.__bar__;}
var barCoords = obj.getBar(e);RGraph.Redraw();if(barCoords){
var text = RGraph.parseTooltipText(obj.Get('chart.tooltips'), barCoords[5]);if(text && text != 'undefined'){
if(obj.Get('chart.tooltips.highlight')){
obj.context.beginPath();obj.context.strokeStyle = obj.Get('chart.highlight.stroke');obj.context.fillStyle = obj.Get('chart.highlight.fill');obj.context.strokeRect(AA(this, barCoords[1]), AA(this, barCoords[2]), barCoords[3], barCoords[4]);obj.context.fillRect(AA(this, barCoords[1]), AA(this, barCoords[2]), barCoords[3], barCoords[4]);obj.context.stroke();obj.context.fill();}
RGraph.Tooltip(canvas, text, e.pageX, e.pageY, barCoords[5]);}
}
e.stopPropagation();}
RGraph.AddEventListener(obj.id, 'click', canvas_onclick);obj.canvas.addEventListener('click', canvas_onclick, false);}
}
RGraph.InstallLineTooltipEventListeners = function (obj)
{
var canvas_onclick_func = function (e)
{
e = RGraph.FixEventObject(e);var canvas = e.target;var context = canvas.getContext('2d');var obj = canvas.__object__;var point = obj.getPoint(e);var mouseCoords = RGraph.getMouseXY(e);var mouseX = mouseCoords[0]
var mouseY = mouseCoords[1]
if(obj.Get('chart.tooltips.highlight')){
RGraph.Register(obj);}
if(   point
&& typeof(point[0]) == 'object'
&& typeof(point[1]) == 'number'
&& typeof(point[2]) == 'number'
&& typeof(point[3]) == 'number'
){
var xCoord = point[1];var yCoord = point[2];var idx = point[3];if((obj.Get('chart.tooltips')[idx] || typeof(obj.Get('chart.tooltips')) == 'function')){
var text = RGraph.parseTooltipText(obj.Get('chart.tooltips'), idx);if(   mouseX > (xCoord - 5)
&& mouseX < (xCoord + 5)
&& mouseY > (yCoord - 5)
&& mouseY < (yCoord + 5)
&& text){
canvas.style.cursor = 'pointer';} else {
canvas.style.cursor = 'default';}
if(   RGraph.Registry.Get('chart.tooltip')
&& RGraph.Registry.Get('chart.tooltip').__index__ == idx
&& RGraph.Registry.Get('chart.tooltip').__canvas__.id == canvas.id
&& RGraph.Registry.Get('chart.tooltip').__event__
&& RGraph.Registry.Get('chart.tooltip').__event__ == 'mousemove'){
return;}
if(obj.Get('chart.tooltips.highlight') || obj.__bar__){
RGraph.Redraw();if(obj.__bar__){
RGraph.Clear(obj.canvas);obj.__bar__.Draw();}
}
RGraph.Tooltip(canvas, text, e.pageX, obj.Get('chart.tooltips.hotspot.xonly') ? (point[2] + RGraph.getCanvasXY(canvas)[1]) : e.pageY, idx);if(typeof(obj.Get('chart.tooltips.override')) != 'function'){
RGraph.Registry.Get('chart.tooltip').__index__ = Number(idx);while (idx >= obj.data[0].length){
idx -= obj.data[0].length
}
RGraph.Registry.Get('chart.tooltip').__index2__ = idx;RGraph.Registry.Get('chart.tooltip').__event__ = 'mousemove';if(obj.Get('chart.tooltips.highlight')){
context.beginPath();context.moveTo(xCoord, yCoord);context.arc(xCoord, yCoord, 2, 0, 6.28, 0);context.strokeStyle = obj.Get('chart.highlight.stroke');context.fillStyle = obj.Get('chart.highlight.fill');context.stroke();context.fill();}
}
e.stopPropagation();return;}
}
canvas.style.cursor = 'default';}
obj.canvas.addEventListener('click', canvas_onclick_func, false);RGraph.AddEventListener(obj.id, 'click', canvas_onclick_func);if(obj.Get('chart.tooltips.event') == 'onmousemove'){
var canvas_onmousemove_func = function (e)
{
e = RGraph.FixEventObject(e);var canvas = e.target;var context = canvas.getContext('2d');var obj = canvas.__object__;var point = obj.getPoint(e);if(point && point.length > 0){
var text = RGraph.parseTooltipText(obj.Get('chart.tooltips'), point[3]);if(text){
canvas.style.cursor = 'pointer';canvas_onclick_func(e);}
} else {
canvas.style.cursor = 'default';}
}
obj.canvas.addEventListener('mousemove', canvas_onmousemove_func, false);RGraph.AddEventListener(obj.id, 'mousemove', canvas_onmousemove_func);} else {
var canvas_onmousemove_func = function (e)
{
e = RGraph.FixEventObject(e);var canvas = e.target;var context = canvas.getContext('2d');var obj = canvas.__object__;var point = obj.getPoint(e);if(point && point.length > 0){
var text = RGraph.parseTooltipText(obj.Get('chart.tooltips'), point[3]);if(text){
canvas.style.cursor = 'pointer';}
} else {
canvas.style.cursor = 'default';}
}
obj.canvas.addEventListener('mousemove', canvas_onmousemove_func, false);RGraph.AddEventListener(obj.id, 'mousemove', canvas_onmousemove_func);}
}
RGraph.PreLoadTooltipImages = function (obj)
{
var tooltips = obj.Get('chart.tooltips');if(obj.type == 'rscatter'){
tooltips = [];for (var i=0; i<obj.data.length; ++i){
tooltips.push(obj.data[3]);}
}
for (var i=0; i<tooltips.length; ++i){
var div = document.createElement('DIV');div.style.position = 'absolute';div.style.opacity = 0;div.style.top = '-100px';div.style.left = '-100px';div.innerHTML = tooltips[i];document.body.appendChild(div);var img_tags = div.getElementsByTagName('IMG');for (var j=0; j<img_tags.length; ++j){
if(img_tags && img_tags[i]){
var img = document.createElement('IMG');img.style.position = 'absolute';img.style.opacity = 0;img.style.top = '-100px';img.style.left = '-100px';img.src = img_tags[i].src
document.body.appendChild(img);setTimeout(function (){document.body.removeChild(img);}, 250);}
}
document.body.removeChild(div);}
}