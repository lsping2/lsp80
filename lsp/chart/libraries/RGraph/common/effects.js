// THIS FILE HAS BEEN MINIFIED

if(typeof(RGraph) == 'undefined') RGraph = {isRGraph:true,type:'common'};RGraph.Effects = {}
RGraph.Effects.Fade = {}; RGraph.Effects.jQuery = {}
RGraph.Effects.jQuery.HBlinds = {}; RGraph.Effects.jQuery.VBlinds = {}
RGraph.Effects.jQuery.Slide = {}; RGraph.Effects.Pie = {}
RGraph.Effects.Bar = {}; RGraph.Effects.Line = {}
RGraph.Effects.Line.jQuery = {}; RGraph.Effects.Fuel = {}
RGraph.Effects.Rose = {}; RGraph.Effects.Odo = {}
RGraph.Effects.Gauge = {}; RGraph.Effects.Meter = {}
RGraph.Effects.HBar = {}; RGraph.Effects.HProgress = {}
RGraph.Effects.VProgress = {}; RGraph.Effects.Radar = {}
RGraph.Effects.Waterfall = {}; RGraph.Effects.Gantt = {}
RGraph.Effects.Fade.In = function (obj)
{
var canvas = obj.canvas;canvas.style.opacity = 0;RGraph.Clear(obj.canvas);obj.Draw();for (var i=1; i<=10; ++i){
setTimeout('document.getElementById("' + canvas.id + '").style.opacity = ' + (i * 0.1), i * 50);}
if(typeof(arguments[2]) == 'function'){
setTimeout(arguments[2], 500);}
}
RGraph.Effects.Fade.Out = function (obj)
{
var canvas = obj.canvas;RGraph.Clear(obj.canvas);obj.Draw();for (var i=10; i>=0; --i){
setTimeout('document.getElementById("' + canvas.id + '").style.opacity = ' + (i * 0.1), (10 - i) * 50);}
if(typeof(arguments[2]) == 'function'){
setTimeout(arguments[2], 500);}
}
RGraph.Effects.jQuery.Expand = function (obj)
{
if(typeof(jQuery) == 'undefined'){
alert('[ERROR] Could not find jQuery object - have you included the jQuery file?');}
var canvas = obj.canvas;if(!canvas.__rgraph_div_placeholder__){
var div = RGraph.Effects.ReplaceCanvasWithDIV(canvas);canvas.__rgraph_div_placeholder__ = div;} else {
div = canvas.__rgraph_div_placeholder__;}
canvas.style.position = 'relative';canvas.style.top = (canvas.height / 2) + 'px';canvas.style.left = (canvas.width / 2) + 'px';canvas.style.width = 0;canvas.style.height = 0;canvas.style.opacity = 0;RGraph.Clear(obj.canvas);obj.Draw();
$('#' + obj.id).animate({
opacity: 1,
width: parseInt(div.style.width) + 'px',
height: parseInt(div.style.height) + 'px',
left: '-=' + (obj.canvas.width / 2) + 'px',
top: '-=' + (obj.canvas.height / 2) + 'px'
}, 1000);if(typeof(arguments[2]) == 'function'){
setTimeout(arguments[2], 1000);}
}
RGraph.Effects.ReplaceCanvasWithDIV = function (canvas)
{
if(!canvas.replacementDIV){
var div = document.createElement('DIV');div.style.width = canvas.width + 'px';div.style.height = canvas.height + 'px';div.style.cssFloat = canvas.style.cssFloat;div.style.left = canvas.style.left;div.style.top = canvas.style.top;div.style.display = 'inline-block';canvas.parentNode.insertBefore(div, canvas);canvas.parentNode.removeChild(canvas);div.appendChild(canvas);canvas.style.position = 'relative';canvas.style.left = (div.offsetWidth / 2) + 'px';canvas.style.top = (div.offsetHeight / 2) + 'px';canvas.style.cssFloat = '';canvas.replacementDIV = div;} else {
var div = canvas.replacementDIV;}
return div;}
RGraph.Effects.jQuery.Snap = function (obj)
{
var delay = 500;var div = RGraph.Effects.ReplaceCanvasWithDIV(obj.canvas);obj.canvas.style.position = 'absolute';obj.canvas.style.top = 0;obj.canvas.style.left = 0;obj.canvas.style.width = 0;obj.canvas.style.height = 0;obj.canvas.style.opacity = 0;var targetLeft = div.offsetLeft;var targetTop = div.offsetTop;var targetWidth = div.offsetWidth;var targetHeight = div.offsetHeight;RGraph.Clear(obj.canvas);obj.Draw();
$('#' + obj.id).animate({
opacity: 1,
width: targetWidth + 'px',
height: targetHeight + 'px',
left: targetLeft + 'px',
top: targetTop + 'px'
}, delay);if(typeof(arguments[2]) == 'function'){
setTimeout(arguments[2], delay + 50);}
}
RGraph.Effects.jQuery.Reveal = function (obj)
{
var opts = arguments[1] ? arguments[1] : null;var delay = 1000;var canvas = obj.canvas;var xy = RGraph.getCanvasXY(obj.canvas);obj.canvas.style.visibility = 'hidden';RGraph.Clear(obj.canvas);obj.Draw();var divs = [
['reveal_left', xy[0], xy[1], obj.canvas.width  / 2, obj.canvas.height],
['reveal_right',(xy[0] + (obj.canvas.width  / 2)),xy[1],(obj.canvas.width  / 2),obj.canvas.height],
['reveal_top',xy[0],xy[1],obj.canvas.width,(obj.canvas.height / 2)],
['reveal_bottom',xy[0],(xy[1] + (obj.canvas.height  / 2)),obj.canvas.width,(obj.canvas.height / 2)]
];for (var i=0; i<divs.length; ++i){
var div = document.createElement('DIV');div.id = divs[i][0];div.style.width =  divs[i][3]+ 'px';div.style.height = divs[i][4] + 'px';div.style.left = divs[i][1] + 'px';div.style.top = divs[i][2] + 'px';div.style.position = 'absolute';div.style.backgroundColor = opts && typeof(opts['color']) == 'string' ? opts['color'] : 'white';document.body.appendChild(div);}
obj.canvas.style.visibility = 'visible';
$('#reveal_left').animate({width: 0}, delay);
$('#reveal_right').animate({left: '+=' + (obj.canvas.width / 2),width: 0}, delay);
$('#reveal_top').animate({height: 0}, delay);
$('#reveal_bottom').animate({top: '+=' + (obj.canvas.height / 2),height: 0}, delay);setTimeout(
function ()
{
document.body.removeChild(document.getElementById("reveal_top"))
document.body.removeChild(document.getElementById("reveal_bottom"))
document.body.removeChild(document.getElementById("reveal_left"))
document.body.removeChild(document.getElementById("reveal_right"))
}
, delay);if(typeof(arguments[2]) == 'function'){
setTimeout(arguments[2], delay);}
}
RGraph.Effects.jQuery.Conceal = function (obj)
{
var opts = arguments[1] ? arguments[1] : null;var delay = 1000;var canvas = obj.canvas;var xy = RGraph.getCanvasXY(obj.canvas);var divs = [
['conceal_left', xy[0], xy[1], 0, obj.canvas.height],
['conceal_right',(xy[0] + obj.canvas.width),xy[1],0,obj.canvas.height],
['conceal_top',xy[0],xy[1],obj.canvas.width,0],
['conceal_bottom',xy[0],(xy[1] + obj.canvas.height),obj.canvas.width,0]
];for (var i=0; i<divs.length; ++i){
var div = document.createElement('DIV');div.id = divs[i][0];div.style.width =  divs[i][3]+ 'px';div.style.height = divs[i][4] + 'px';div.style.left = divs[i][1] + 'px';div.style.top = divs[i][2] + 'px';div.style.position = 'absolute';div.style.backgroundColor = opts && typeof(opts['color']) == 'string' ? opts['color'] : 'white';document.body.appendChild(div);}
$('#conceal_left').animate({width: '+=' + (obj.canvas.width / 2)}, delay);
$('#conceal_right').animate({left: '-=' + (obj.canvas.width / 2),width: (obj.canvas.width / 2)}, delay);
$('#conceal_top').animate({height: '+=' + (obj.canvas.height / 2)}, delay);
$('#conceal_bottom').animate({top: '-=' + (obj.canvas.height / 2),height: (obj.canvas.height / 2)}, delay);setTimeout(
function ()
{
document.body.removeChild(document.getElementById("conceal_top"))
document.body.removeChild(document.getElementById("conceal_bottom"))
document.body.removeChild(document.getElementById("conceal_left"))
document.body.removeChild(document.getElementById("conceal_right"))
}
, delay);setTimeout(function (){RGraph.Clear(obj.canvas);}, delay);if(typeof(arguments[2]) == 'function'){
setTimeout(arguments[2], delay);}
}
RGraph.Effects.jQuery.HBlinds.Open = function (obj)
{
var canvas = obj.canvas;var opts = arguments[1] ? arguments[1] : [];var delay = 1000;var color = opts['color'] ? opts['color'] : 'white';var xy = RGraph.getCanvasXY(canvas);var height = canvas.height / 5;RGraph.Clear(obj.canvas);obj.Draw();for (var i=0; i<5; ++i){
var div = document.createElement('DIV');div.id = 'blinds_' + i;div.style.width =  canvas.width + 'px';div.style.height = height + 'px';div.style.left = xy[0] + 'px';div.style.top = (xy[1] + (canvas.height * (i / 5))) + 'px';div.style.position = 'absolute';div.style.backgroundColor = color;document.body.appendChild(div);
$('#blinds_' + i).animate({height: 0}, delay);}
setTimeout(function (){document.body.removeChild(document.getElementById('blinds_0'));}, delay);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_1'));}, delay);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_2'));}, delay);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_3'));}, delay);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_4'));}, delay);if(typeof(arguments[2]) == 'function'){
setTimeout(arguments[2], delay);}
}
RGraph.Effects.jQuery.HBlinds.Close = function (obj)
{
var canvas = obj.canvas;var opts = arguments[1] ? arguments[1] : [];var delay = 1000;var color = opts['color'] ? opts['color'] : 'white';var xy = RGraph.getCanvasXY(canvas);var height = canvas.height / 5;for (var i=0; i<5; ++i){
var div = document.createElement('DIV');div.id = 'blinds_' + i;div.style.width =  canvas.width + 'px';div.style.height = 0;div.style.left = xy[0] + 'px';div.style.top = (xy[1] + (canvas.height * (i / 5))) + 'px';div.style.position = 'absolute';div.style.backgroundColor = color;document.body.appendChild(div);
$('#blinds_' + i).animate({height: height + 'px'}, delay);}
setTimeout(function (){RGraph.Clear(obj.canvas);}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_0'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_1'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_2'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_3'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_4'));}, delay + 100);if(typeof(arguments[2]) == 'function'){
setTimeout(arguments[2], delay);}
}
RGraph.Effects.jQuery.VBlinds.Open = function (obj)
{
var canvas = obj.canvas;var opts = arguments[1] ? arguments[1] : [];var delay = 1000;var color = opts['color'] ? opts['color'] : 'white';var xy = RGraph.getCanvasXY(canvas);var width = canvas.width / 10;RGraph.Clear(obj.canvas);obj.Draw();for (var i=0; i<10; ++i){
var div = document.createElement('DIV');div.id = 'blinds_' + i;div.style.width =  width + 'px';div.style.height = canvas.height + 'px';div.style.left = (xy[0] + (canvas.width * (i / 10))) + 'px';div.style.top = (xy[1]) + 'px';div.style.position = 'absolute';div.style.backgroundColor = color;document.body.appendChild(div);
$('#blinds_' + i).animate({width: 0}, delay);}
setTimeout(function (){document.body.removeChild(document.getElementById('blinds_0'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_1'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_2'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_3'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_4'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_5'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_6'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_7'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_8'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_9'));}, delay + 100);if(typeof(arguments[2]) == 'function'){
setTimeout(arguments[2], delay);}
}
RGraph.Effects.jQuery.VBlinds.Close = function (obj)
{
var canvas = obj.canvas;var opts = arguments[1] ? arguments[1] : [];var delay = 1000;var color = opts['color'] ? opts['color'] : 'white';var xy = RGraph.getCanvasXY(canvas);var width = canvas.width / 10;for (var i=0; i<10; ++i){
var div = document.createElement('DIV');div.id = 'blinds_' + i;div.style.width =  0;div.style.height = canvas.height + 'px';div.style.left = (xy[0] + (canvas.width * (i / 10))) + 'px';div.style.top = (xy[1]) + 'px';div.style.position = 'absolute';div.style.backgroundColor = color;document.body.appendChild(div);
$('#blinds_' + i).animate({width: width}, delay);}
setTimeout(function (){RGraph.Clear(obj.canvas, color);}, delay + 100);if(opts['remove']){
setTimeout(function (){document.body.removeChild(document.getElementById('blinds_0'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_1'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_2'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_3'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_4'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_5'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_6'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_7'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_8'));}, delay + 100);setTimeout(function (){document.body.removeChild(document.getElementById('blinds_9'));}, delay + 100);}
if(typeof(arguments[2]) == 'function'){
setTimeout(arguments[2], delay);}
}
RGraph.Effects.Pie.Grow = function (obj)
{
var canvas = obj.canvas;var opts = arguments[1] ? arguments[1] : [];var color = opts['color'] ? opts['color'] : 'white';var xy = RGraph.getCanvasXY(canvas);canvas.style.visibility = 'hidden';obj.Draw();var radius = obj.getRadius();RGraph.Clear(obj.canvas);canvas.style.visibility = 'visible';obj.Set('chart.radius', 0);RGraph.Effects.Animate(obj, {'chart.radius': radius}, arguments[2]);}
RGraph.Effects.Bar.Grow = function (obj)
{
obj.original_data = RGraph.array_clone(obj.data);obj.__animation_frame__ = 0;if(obj.Get('chart.ymax') == null){
var ymax = 0;for (var i=0; i<obj.data.length; ++i){
if(RGraph.is_array(obj.data[i]) && obj.Get('chart.grouping') == 'stacked'){
ymax = Math.max(ymax, Math.abs(RGraph.array_sum(obj.data[i])));} else {
ymax = Math.max(ymax, Math.abs(obj.data[i]));}
}
ymax = RGraph.getScale(ymax, obj)[4];obj.Set('chart.ymax', ymax);}
function Grow ()
{
var numFrames = 30;if(!obj.__animation_frame__){
obj.__animation_frame__ = 0;obj.__original_hmargin__ = obj.Get('chart.hmargin');obj.__hmargin__ = ((obj.canvas.width - obj.Get('chart.gutter.left') - obj.Get('chart.gutter.right')) / obj.data.length) / 2;obj.Set('chart.hmargin', obj.__hmargin__);}
for (var j=0; j<obj.original_data.length; ++j){
if(typeof(obj.data[j]) == 'object'){
for (var k=0; k<obj.data[j].length; ++k){
obj.data[j][k] = (obj.__animation_frame__ / numFrames) * obj.original_data[j][k];}
} else {
obj.data[j] = (obj.__animation_frame__ / numFrames) * obj.original_data[j];}
}
obj.Set('chart.hmargin', ((1 - (obj.__animation_frame__ / numFrames)) * (obj.__hmargin__ - obj.__original_hmargin__)) + obj.__original_hmargin__);RGraph.Clear(obj.canvas);obj.Draw();if(obj.__animation_frame__ < numFrames){
obj.__animation_frame__ += 1;if(location.href.indexOf('?settimeout') > 0){
setTimeout(Grow, 40);} else {
RGraph.Effects.UpdateCanvas(Grow);}
}
}
RGraph.Effects.UpdateCanvas(Grow);}
RGraph.Effects.UpdateCanvas = function (func)
{
if(typeof(window.requestAnimationFrame) == 'function'){
window.requestAnimationFrame(func);} else if(typeof(window.msRequestAnimationFrame) == 'function'){
window.msRequestAnimationFrame(func);} else if(typeof(window.webkitRequestAnimationFrame) == 'function'){
window.webkitRequestAnimationFrame(func);} else if(window.mozRequestAnimationFrame){
window.mozRequestAnimationFrame(func);} else {
setTimeout(func, 1000 / 60);}
}
RGraph.Effects.Fuel.Grow = function (obj)
{
var totalFrames = 30;var currentFrame = 0;var diff = obj.value - obj.currentValue;var increment = diff / totalFrames;var callback = arguments[2] ? arguments[2] : null;function Grow ()
{
if(currentFrame < totalFrames){
obj.value = obj.currentValue + increment;RGraph.Clear(obj.canvas);obj.Draw();currentFrame++;RGraph.Effects.UpdateCanvas(Grow);} else if(callback){
callback(obj);}
}
RGraph.Effects.UpdateCanvas(Grow);}
RGraph.Effects.Animate = function (obj, map)
{
obj.Draw();RGraph.Effects.__total_frames__ = (map && map['frames']) ? map['frames'] : 30;function Animate_Iterator (func)
{
var id = [obj.id +  '_' + obj.type];if(typeof(RGraph.Effects.__current_frame__ ) == 'undefined'){
RGraph.Effects.__current_frame__ = new Array();RGraph.Effects.__original_values__ = new Array();RGraph.Effects.__diffs__ = new Array();RGraph.Effects.__steps__ = new Array();RGraph.Effects.__callback__ = new Array();}
if(!RGraph.Effects.__current_frame__[id]){
RGraph.Effects.__current_frame__[id] = RGraph.Effects.__total_frames__;RGraph.Effects.__original_values__[id] = {};RGraph.Effects.__diffs__[id] = {};RGraph.Effects.__steps__[id] = {};RGraph.Effects.__callback__[id] = func;}
for (var i in map){
if(typeof(map[i]) == 'string' || typeof(map[i]) == 'number'){
if(RGraph.Effects.__current_frame__[id] == RGraph.Effects.__total_frames__){
RGraph.Effects.__original_values__[id][i] = obj.Get(i);RGraph.Effects.__diffs__[id][i] = map[i] - RGraph.Effects.__original_values__[id][i];RGraph.Effects.__steps__[id][i] = RGraph.Effects.__diffs__[id][i] / RGraph.Effects.__total_frames__;}
obj.Set(i, obj.Get(i) + RGraph.Effects.__steps__[id][i]);RGraph.Clear(obj.canvas);obj.Draw();}
}
if(--RGraph.Effects.__current_frame__[id] > 0){
RGraph.Effects.UpdateCanvas(Animate_Iterator);} else {
if(typeof(RGraph.Effects.__callback__[id]) == 'function'){
(RGraph.Effects.__callback__[id])(obj);}
RGraph.Effects.__current_frame__[id] = null;RGraph.Effects.__original_values__[id] = null;RGraph.Effects.__diffs__[id] = null;RGraph.Effects.__steps__[id] = null;RGraph.Effects.__callback__[id] = null;}
}
Animate_Iterator(arguments[2]);}
RGraph.Effects.jQuery.Slide.In = function (obj)
{
RGraph.Clear(obj.canvas);obj.Draw();var canvas = obj.canvas;var div = RGraph.Effects.ReplaceCanvasWithDIV(obj.canvas);var delay = 1000;div.style.overflow= 'hidden';var from = typeof(arguments[1]) == 'object' && typeof(arguments[1]['from']) == 'string' ? arguments[1]['from'] : 'left';canvas.style.position = 'relative';if(from == 'left'){
canvas.style.left = (0 - div.offsetWidth) + 'px';canvas.style.top = 0;} else if(from == 'top'){
canvas.style.left = 0;canvas.style.top = (0 - div.offsetHeight) + 'px';} else if(from == 'bottom'){
canvas.style.left = 0;canvas.style.top = div.offsetHeight + 'px';} else {
canvas.style.left = div.offsetWidth + 'px';canvas.style.top = 0;}
$('#' + obj.id).animate({left:0,top:0}, delay);if(typeof(arguments[2]) == 'function'){
setTimeout(arguments[2], delay);}
}
RGraph.Effects.jQuery.Slide.Out = function (obj)
{
var canvas = obj.canvas;var div = RGraph.Effects.ReplaceCanvasWithDIV(obj.canvas);var delay = 1000;div.style.overflow= 'hidden';var to = typeof(arguments[1]) == 'object' && typeof(arguments[1]['to']) == 'string' ? arguments[1]['to'] : 'left';canvas.style.position = 'relative';canvas.style.left = 0;canvas.style.top = 0;if(to == 'left'){
$('#' + obj.id).animate({left: (0 - canvas.width) + 'px'}, delay);} else if(to == 'top'){
$('#' + obj.id).animate({left: 0, top: (0 - div.offsetHeight) + 'px'}, delay);} else if(to == 'bottom'){
$('#' + obj.id).animate({top: (0 + div.offsetHeight) + 'px'}, delay);} else {
$('#' + obj.id).animate({left: (0 + canvas.width) + 'px'}, delay);}
if(typeof(arguments[2]) == 'function'){
setTimeout(arguments[2], delay);}
}
RGraph.Effects.Line.Unfold = function (obj)
{
obj.Set('chart.animation.factor', obj.Get('chart.animation.unfold.initial'));RGraph.Effects.Animate(obj, {'chart.animation.factor': 1}, arguments[2]);}
RGraph.Effects.Rose.Grow = function (obj)
{
var numFrames = 60;var currentFrame = 0;var original_margin = obj.Get('chart.margin');var margin = (360 / obj.data.length) / 2;var callback = arguments[2];obj.Set('chart.margin', margin);obj.Set('chart.animation.grow.factor', 0);function Grow_inner ()
{
if(currentFrame++ < numFrames){
obj.Set('chart.animation.grow.factor', currentFrame / numFrames);obj.Set('chart.margin', (currentFrame / numFrames) * original_margin);RGraph.Clear(obj.canvas);obj.Draw();RGraph.Effects.UpdateCanvas(Grow_inner);} else {
obj.Set('chart.animation.grow.factor', 1);obj.Set('chart.margin', original_margin);RGraph.Clear(obj.canvas);obj.Draw();if(typeof(callback) == 'function'){
callback(obj);}
}
}
RGraph.Effects.UpdateCanvas(Grow_inner);}
RGraph.Effects.Line.UnfoldFromCenter = function (obj)
{
var numFrames = 30;var original_opacity = obj.canvas.style.opacity;obj.canvas.style.opacity = 0;obj.Draw();var center_value = obj.scale[4] / 2;obj.Set('chart.ymax', Number(obj.scale[4]));RGraph.Clear(obj.canvas);obj.canvas.style.opacity = original_opacity;var original_data = RGraph.array_clone(obj.original_data);var original_blur = obj.Get('chart.shadow.blur');obj.Set('chart.shadow.blur', 0);var callback = arguments[2];if(!obj.__increments__){
obj.__increments__ = new Array();for (var dataset=0; dataset<original_data.length; ++dataset){
obj.__increments__[dataset] = new Array();for (var i=0; i<original_data[dataset].length; ++i){
obj.__increments__[dataset][i] = (original_data[dataset][i] - center_value) / numFrames;obj.original_data[dataset][i] = center_value;}
}
}
function UnfoldFromCenter ()
{
RGraph.Clear(obj.canvas);obj.Draw();for (var dataset=0; dataset<original_data.length; ++dataset){
for (var i=0; i<original_data[dataset].length; ++i){
obj.original_data[dataset][i] += obj.__increments__[dataset][i];}
}
if(--numFrames > 0){
RGraph.Effects.UpdateCanvas(UnfoldFromCenter);} else {
obj.original_data = RGraph.array_clone(original_data);obj.__increments__ = null;obj.Set('chart.shadow.blur', original_blur);RGraph.Clear(obj.canvas);obj.Draw();if(typeof(callback) == 'function'){
callback(obj);}
}
}
UnfoldFromCenter();}
RGraph.Effects.Line.FoldToCenter = function (obj)
{
var totalFrames = 30;var numFrame = totalFrames;obj.Draw();var center_value = obj.scale[4] / 2;obj.Set('chart.ymax', Number(obj.scale[4]));RGraph.Clear(obj.canvas);var original_data = RGraph.array_clone(obj.original_data);obj.Set('chart.shadow.blur', 0);var callback = arguments[2];function FoldToCenter ()
{
for (var i=0; i<obj.data.length; ++i){
if(obj.data[i].length){
for (var j=0; j<obj.data[i].length; ++j){
if(obj.original_data[i][j] > center_value){
obj.original_data[i][j] = ((original_data[i][j] - center_value) * (numFrame/totalFrames)) + center_value;} else {
obj.original_data[i][j] = center_value - ((center_value - original_data[i][j]) * (numFrame/totalFrames));}
}
}
}
RGraph.Clear(obj.canvas);obj.Draw();if(numFrame-- > 0){
RGraph.Effects.UpdateCanvas(FoldToCenter);} else if(typeof(callback) == 'function'){
callback(obj);}
}
RGraph.Effects.UpdateCanvas(FoldToCenter);}
RGraph.Effects.Odo.Grow = function (obj)
{
var numFrames = 30;var origValue = Number(obj.currentValue);var newValue = obj.value;var diff = newValue - origValue;var step = (diff / numFrames);var callback = arguments[2];function Grow_inner ()
{
if(obj.currentValue != newValue){
obj.value = Number(obj.currentValue) + step;}
RGraph.Clear(obj.canvas);obj.Draw();if(numFrames-- > 0){
RGraph.Effects.UpdateCanvas(Grow_inner);} else if(callback){
callback(obj);}
}
RGraph.Effects.UpdateCanvas(Grow_inner);}
RGraph.Effects.Meter.Grow = function (obj)
{
if(!obj.currentValue){
obj.currentValue = obj.min;}
var totalFrames = 60;var numFrame = 0;var diff = obj.value - obj.currentValue;var step = diff / totalFrames
var callback = arguments[2];function Grow_meter_inner ()
{
obj.value = obj.currentValue + step;RGraph.Clear(obj.canvas);obj.Draw();if(numFrame++ < totalFrames){
RGraph.Effects.UpdateCanvas(Grow_meter_inner);} else if(typeof(callback) == 'function'){
callback(obj);}
}
RGraph.Effects.UpdateCanvas(Grow_meter_inner);}
RGraph.Effects.HBar.Grow = function (obj)
{
obj.original_data = RGraph.array_clone(obj.data);obj.__animation_frame__ = 0;if(obj.Get('chart.xmax') == 0){
var xmax = 0;for (var i=0; i<obj.data.length; ++i){
if(RGraph.is_array(obj.data[i]) && obj.Get('chart.grouping') == 'stacked'){
xmax = Math.max(xmax, RGraph.array_sum(obj.data[i]));} else if(RGraph.is_array(obj.data[i]) && obj.Get('chart.grouping') == 'grouped'){
xmax = Math.max(xmax, RGraph.array_max(obj.data[i]));} else {
xmax = Math.max(xmax, RGraph.array_max(obj.data[i]));}
}
xmax = RGraph.getScale(xmax)[4];obj.Set('chart.xmax', xmax);}
if(obj.Get('chart.shadow.blur') > 0){
var __original_shadow_blur__ = obj.Get('chart.shadow.blur');obj.Set('chart.shadow.blur', 0);}
function Grow ()
{
var numFrames = 30;if(!obj.__animation_frame__){
obj.__animation_frame__ = 0;obj.__original_vmargin__ = obj.Get('chart.vmargin');obj.__vmargin__ = ((obj.canvas.height - obj.Get('chart.gutter.top') - obj.Get('chart.gutter.bottom')) / obj.data.length) / 2;obj.Set('chart.vmargin', obj.__vmargin__);}
for (var j=0; j<obj.original_data.length; ++j){
var easing = Math.pow(Math.sin((obj.__animation_frame__ * (90 / numFrames)) / (180 / Math.PI)), 4);if(typeof(obj.data[j]) == 'object'){
for (var k=0; k<obj.data[j].length; ++k){
obj.data[j][k] = (obj.__animation_frame__ / numFrames) * obj.original_data[j][k] * easing;}
} else {
obj.data[j] = (obj.__animation_frame__ / numFrames) * obj.original_data[j] * easing;}
}
obj.Set('chart.vmargin', ((1 - (obj.__animation_frame__ / numFrames)) * (obj.__vmargin__ - obj.__original_vmargin__)) + obj.__original_vmargin__);RGraph.Clear(obj.canvas);obj.Draw();if(obj.__animation_frame__ < numFrames){
obj.__animation_frame__ += 1;RGraph.Effects.UpdateCanvas(Grow);} else {
if(typeof(__original_shadow_blur__) == 'number' && __original_shadow_blur__ > 0){
obj.Set('chart.shadow.blur', __original_shadow_blur__);RGraph.Clear(obj.canvas);obj.Draw();}
}
}
RGraph.Effects.UpdateCanvas(Grow);}
RGraph.Effects.Line.jQuery.Trace = function (obj)
{
RGraph.Clear(obj.canvas);obj.Draw();var div = document.createElement('DIV');var xy = RGraph.getCanvasXY(obj.canvas);div.id = '__rgraph_trace_animation_' + RGraph.random(0, 4351623) + '__';div.style.left = xy[0] + 'px';div.style.top = xy[1] + 'px';div.style.width = obj.Get('chart.gutter.left');div.style.height = obj.canvas.height + 'px';div.style.position = 'absolute';div.style.overflow = 'hidden';document.body.appendChild(div);var id = '__rgraph_line_reveal_animation_' + RGraph.random(0, 99999999) + '__';var canvas2 = document.createElement('CANVAS');canvas2.width = obj.canvas.width;canvas2.height = obj.canvas.height;canvas2.style.position = 'absolute';canvas2.style.left = 0;canvas2.style.top = 0;canvas2.id = id;div.appendChild(canvas2);var reposition_canvas2 = function (e)
{
var xy = RGraph.getCanvasXY(obj.canvas);div.style.left = xy[0] + 'px';div.style.top = xy[1] + 'px';}
window.addEventListener('resize', reposition_canvas2, false)
var obj2 = new RGraph.Line(id, RGraph.array_clone(obj.original_data));for (i in obj.properties){
if(typeof(i) == 'string'){
obj2.Set(i, obj.properties[i]);}
}
obj2.Set('chart.labels', []);obj2.Set('chart.background.grid', false);obj2.Set('chart.ylabels', false);obj2.Set('chart.noaxes', true);obj2.Set('chart.title', '');obj2.Set('chart.title.xaxis', '');obj2.Set('chart.title.yaxis', '');obj2.Set('chart.filled.accumulative', obj.Get('chart.filled.accumulative'));obj.Set('chart.key', []);obj2.Draw();obj.Set('chart.line.visible', false);obj.Set('chart.colors', ['rgba(0,0,0,0)']);if(obj.Get('chart.filled')){
var original_fillstyle = obj.Get('chart.fillstyle');obj.Set('chart.fillstyle', 'rgba(0,0,0,0)');}
RGraph.Clear(obj.canvas);obj.Draw();
$('#' + div.id).animate({
width: obj.canvas.width + 'px'
}, arguments[2] ? arguments[2] : 1500, RGraph.Effects.Line.Trace_callback);RGraph.Effects.Line.Trace_callback = function ()
{
window.removeEventListener('resize', reposition_canvas2, false);div.parentNode.removeChild(div);div.removeChild(canvas2);obj.Set('chart.line.visible', true);obj.Set('chart.filled', RGraph.array_clone(obj2.Get('chart.filled')));obj.Set('chart.fillstyle', original_fillstyle);obj.Set('chart.colors', RGraph.array_clone(obj2.Get('chart.colors')));obj.Set('chart.key', RGraph.array_clone(obj2.Get('chart.key')));RGraph.Clear(obj.canvas);obj.Draw();}
}
RGraph.Effects.Pie.RoundRobin = function (obj)
{
var callback = arguments[2] ? arguments[2] : null;var opt = arguments[1];var currentFrame = 0;var numFrames = 90;var targetRadius =  typeof(obj.Get('chart.radius')) == 'number' ? obj.Get('chart.radius') : obj.getRadius();function RoundRobin_inner ()
{
obj.Set('chart.effect.roundrobin.multiplier', Math.pow(Math.sin((currentFrame * (90 / numFrames)) / (180 / Math.PI)), 2) * (currentFrame / numFrames) );if(!opt || opt['radius']){
obj.Set('chart.radius', targetRadius * obj.Get('chart.effect.roundrobin.multiplier'));}
RGraph.Clear(obj.canvas)
obj.Draw();if(currentFrame++ < numFrames){
RGraph.Effects.UpdateCanvas(RoundRobin_inner);} else if(callback){
callback(obj);}
}
RGraph.Effects.UpdateCanvas(RoundRobin_inner);}
RGraph.Effects.Pie.Implode = function (obj)
{
var numFrames = 90;var distance = Math.min(obj.canvas.width, obj.canvas.height);function Implode_inner ()
{
obj.Set('chart.exploded', Math.sin(numFrames / 57.3) * distance);RGraph.Clear(obj.canvas)
obj.Draw();if(numFrames > 0){
numFrames--;RGraph.Effects.UpdateCanvas(Implode_inner);} else {
obj.Set('chart.exploded', 0);RGraph.Clear(obj.canvas);obj.Draw();}
}
RGraph.Effects.UpdateCanvas(Implode_inner);}
RGraph.Effects.Gauge.Grow = function (obj)
{
var numFrames = 30;var origValue = Number(obj.currentValue);if(obj.currentValue == null){
obj.currentValue = obj.min;origValue = obj.min;}
var newValue = obj.value;var diff = newValue - origValue;var step = (diff / numFrames);function Grow ()
{
if(obj.currentValue != newValue){
obj.value = Number(obj.currentValue) + step;}
if(obj.value > obj.max){
obj.value = obj.max;}
if(obj.value < obj.min){
obj.value = obj.min;}
RGraph.Clear(obj.canvas);obj.Draw();if(numFrames-- > 0){
RGraph.Effects.UpdateCanvas(Grow);}
}
RGraph.Effects.UpdateCanvas(Grow);}
RGraph.Effects.Radar.Grow = function (obj)
{
var totalframes = 30;var framenum = totalframes;var data = RGraph.array_clone(obj.data);var callback = arguments[2];obj.original_data = RGraph.array_clone(obj.original_data);function Grow_inner ()
{
for (var i=0; i<data.length; ++i){
if(obj.original_data[i] == null){
obj.original_data[i] = [];}
for (var j=0; j<data[i].length; ++j){
obj.original_data[i][j] = ((totalframes - framenum)/totalframes)  * data[i][j];}
}
RGraph.Clear(obj.canvas);obj.Draw();if(framenum > 0){
framenum--;RGraph.Effects.UpdateCanvas(Grow_inner);} else if(typeof(callback) == 'function'){
callback(obj);}
}
RGraph.Effects.UpdateCanvas(Grow_inner);}
RGraph.Effects.Waterfall.Grow = function (obj)
{
var totalFrames = 45;var numFrame = 0;var data = RGraph.array_clone(obj.data);var callback = arguments[2];for (var i=0; i<obj.data.length; ++i){
obj.data[i] /= totalFrames;}
if(obj.Get('chart.ymax') == null){
var max = RGraph.getScale(obj.getMax(data))[4]
obj.Set('chart.ymax', max);}
obj.Set('chart.multiplier.x', 0);obj.Set('chart.multiplier.w', 0);function Grow_inner ()
{
for (var i=0; i<obj.data.length; ++i){
obj.data[i] = data[i] * (numFrame/totalFrames);}
var multiplier = Math.pow(Math.sin(((numFrame / totalFrames) * 90) / 57.3), 20);obj.Set('chart.multiplier.x', (numFrame / totalFrames) * multiplier);obj.Set('chart.multiplier.w', (numFrame / totalFrames) * multiplier);RGraph.Clear(obj.canvas);obj.Draw();if(numFrame++ < totalFrames){
RGraph.Effects.UpdateCanvas(Grow_inner);} else if(typeof(callback) == 'function'){
callback(obj);}
}
RGraph.Effects.UpdateCanvas(Grow_inner)
}
RGraph.Effects.Bar.Wave = function (obj)
{
var callback = arguments[2] ? arguments[2] : null;var max = 0;for (var i=0; i<obj.data.length; ++i){
if(typeof(obj.data[i]) == 'number'){
max = Math.max(max, obj.data[i])
} else {
if(obj.Get('chart.grouping') == 'stacked'){
max = Math.max(max, RGraph.array_sum(obj.data[i]))
} else {
max = Math.max(max, RGraph.array_max(obj.data[i]))
}
}
}
var scale = RGraph.getScale(max);obj.Set('chart.ymax', scale[4]);original_bar_data = RGraph.array_clone(obj.data);
__rgraph_bar_wave_object__ = obj;for (var i=0; i<obj.data.length; ++i){
if(typeof(obj.data[i]) == 'number'){
obj.data[i] = 0;} else {
obj.data[i] = new Array(obj.data[i].length);}
var totalFrames = 25;var delay = 25;setTimeout('RGraph.Effects.Bar.Wave_inner(' + i + ', ' + totalFrames + ', ' + delay + ')', i * 150);}
RGraph.Effects.Bar.Wave_inner = function  (idx, totalFrames, delay)
{
for (var k=0; k<=totalFrames; ++k){
setTimeout('RGraph.Effects.Bar.Wave_inner_iterator(__rgraph_bar_wave_object__, '+idx+', '+(k / totalFrames)+');', delay * k);}
}
setTimeout(callback, (i * 150) + (totalFrames * delay), totalFrames, delay);}
RGraph.Effects.Bar.Wave_inner_iterator = function (obj, idx, factor)
{
if(typeof(obj.data[idx]) == 'number'){
obj.data[idx] = original_bar_data[idx] * factor;} else {
for (var i=0; i<obj.data[idx].length; ++i){
obj.data[idx][i] = factor * original_bar_data[idx][i];}
}
RGraph.Clear(obj.canvas);obj.Draw();}
RGraph.Effects.HProgress.Grow = function (obj)
{
var canvas = obj.canvas;var context = obj.context;var diff = obj.value - Number(obj.currentValue);var numFrames = 30;var currentFrame = 0
var increment = diff  / numFrames;var callback = arguments[2] ? arguments[2] : null;function Grow_hprogress_inner ()
{
if(currentFrame++ < 30){
obj.value = obj.currentValue + increment;RGraph.Clear(obj.canvas);obj.Draw();RGraph.Effects.UpdateCanvas(Grow_hprogress_inner);} else if(callback){
callback(obj);}
}
RGraph.Effects.UpdateCanvas(Grow_hprogress_inner);}
RGraph.Effects.VProgress.Grow = function (obj)
{
var canvas = obj.canvas;var context = obj.context;var diff = obj.value - Number(obj.currentValue);var numFrames = 30;var currentFrame = 0
var increment = diff  / numFrames;var callback = arguments[2] ? arguments[2] : null;function Grow_vprogress_inner ()
{
if(currentFrame++ < 30){
obj.value = obj.currentValue + increment;RGraph.Clear(obj.canvas);obj.Draw();RGraph.Effects.UpdateCanvas(Grow_vprogress_inner);} else if(callback){
callback(obj);}
}
RGraph.Effects.UpdateCanvas(Grow_vprogress_inner);}
        
RGraph.Effects.Pie.Wave = function (obj)
{
var max = RGraph.array_max(obj.data);var scale = RGraph.getScale(max);obj.Set('chart.ymax', scale[4]);original_pie_data = RGraph.array_clone(obj.data);
__rgraph_pie_wave_object__ = obj;for (var i=0; i<obj.data.length; ++i){
obj.data[i] = 0;setTimeout('RGraph.Effects.Pie.Wave_inner(' + i + ')', i * 100);}
RGraph.Effects.Pie.Wave_inner = function  (idx)
{
var totalFrames = 25;for (var k=0; k<=totalFrames; ++k){
setTimeout('RGraph.Effects.Pie.Wave_inner_iterator(__rgraph_pie_wave_object__, '+idx+', '+(k / totalFrames)+');', 20 * k);}
}
}
RGraph.Effects.Pie.Wave_inner_iterator = function (obj, idx, factor)
{
obj.data[idx] = original_pie_data[idx] * factor;RGraph.Clear(obj.canvas);obj.Draw();}
RGraph.Effects.Bar.Wave2 = function (obj)
{
var callback = arguments[2] ? arguments[2] : null;var max = 0;for (var i=0; i<obj.data.length; ++i){
if(typeof(obj.data[i]) == 'number'){
max = Math.max(max, obj.data[i])
} else {
if(obj.Get('chart.grouping') == 'stacked'){
max = Math.max(max, RGraph.array_sum(obj.data[i]))
} else {
max = Math.max(max, RGraph.array_max(obj.data[i]))
}
}
}
var scale = RGraph.getScale(max);obj.Set('chart.ymax', scale[4]);original_bar_data = RGraph.array_clone(obj.data);
__rgraph_bar_wave_object__ = obj;for (var i=0; i<obj.data.length; ++i){
if(typeof(obj.data[i]) == 'number'){
obj.data[i] = 0;} else {
obj.data[i] = new Array(obj.data[i].length);}
setTimeout('a = new RGraph.Effects.Bar.Wave2.Iterator(__rgraph_bar_wave_object__, ' + i + ', 45); a.Animate();', i * 150);}
}
RGraph.Effects.Bar.Wave2.Iterator = function (obj, idx, frames)
{
this.obj = obj;this.idx = idx;this.frames = frames;this.curFrame = 0;}
RGraph.Effects.Bar.Wave2.Iterator.prototype.Animate = function ()
{
if(typeof(this.obj.data[this.idx]) == 'number'){
this.obj.data[this.idx] = (this.curFrame / this.frames) * original_bar_data[this.idx];} else if(typeof(this.obj.data[this.idx]) == 'object'){
for (var j=0; j<this.obj.data[this.idx].length; ++j){
this.obj.data[this.idx][j] = (this.curFrame / this.frames) * original_bar_data[this.idx][j];}
}
RGraph.Clear(this.obj.canvas);this.obj.Draw();if(this.curFrame < this.frames){
this.curFrame += 1;RGraph.Effects.UpdateCanvas(this.Animate.bind(this));}
}
RGraph.Effects.Gantt.Grow = function (obj)
{
var canvas = obj.canvas;var context = obj.context;var numFrames = 30;var currentFrame = 0
var callback = arguments[2] ? arguments[2] : null;var events = obj.Get('chart.events');var original_events = RGraph.array_clone(events);function Grow_gantt_inner ()
{
if(currentFrame < numFrames){
for (var i=0; i<events.length; ++i){
if(typeof(events[i][0]) == 'object'){
for (var j=0; j<events[i].length; ++j){
events[i][j][1] = (currentFrame / numFrames) * original_events[i][j][1];}
} else {
events[i][1] = (currentFrame / numFrames) * original_events[i][1];}
}
obj.Set('chart.events', events);RGraph.Clear(obj.canvas);obj.Draw();currentFrame++;RGraph.Effects.UpdateCanvas(Grow_gantt_inner);} else if(callback){            
callback(obj);}
}
RGraph.Effects.UpdateCanvas(Grow_gantt_inner);}
if(!Function.prototype.bind){  
Function.prototype.bind = function (oThis){  
if(typeof this !== "function"){  
throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");  
}  
var aArgs = Array.prototype.slice.call(arguments, 1),   
fToBind = this,   
fNOP = function (){},  
fBound = function (){  
return fToBind.apply(this instanceof fNOP  
? this  
: oThis || window,  
aArgs.concat(Array.prototype.slice.call(arguments)));  
};  
fNOP.prototype = this.prototype;  
fBound.prototype = new fNOP();  
return fBound;  
};  
}
RGraph.Effects.Rose.Explode = function (obj)
{
var canvas = obj.canvas;var opts = arguments[1] ? arguments[1] : [];var callback = arguments[2] ? arguments[2] : null;var frames = opts['frames'] ? opts['frames'] : 60;obj.Set('chart.exploded', 0);RGraph.Effects.Animate(obj, {'frames': frames, 'chart.exploded': Math.min(canvas.width, canvas.height)}, callback);}
RGraph.Effects.Rose.Implode = function (obj)
{
var canvas = obj.canvas;var opts = arguments[1] ? arguments[1] : [];var callback = arguments[2] ? arguments[2] : null;var frames = opts['frames'] ? opts['frames'] : 60;obj.Set('chart.exploded', Math.min(canvas.width, canvas.height));RGraph.Effects.Animate(obj, {'frames': frames, 'chart.exploded': 0}, callback);}