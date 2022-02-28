/*
copyright (c) http://designblack.com | 배포 및 재판매를 금합니다.
문의 : webmaster@designblack.com
-------------------------------------------------------------------------------------------
-폰트변경시 화면밖 좌측의 텍스트필드로 들어가서 변경하세요
 전체폰트가 아닌 각 도,시,구,군 의 개별글자가 embed되었습니다
 그외 글자인경우 글자를 추가하여야합니다(텍스트필드선택>속성창>포함>포함할문자>직접타이핑)
-외부파라값으로 맵고정시 stageNum,cityNum 으로 고정됩니다
-맵사이즈를 조정할 경우 지도무비클립을 직접 조정하면 지명까지 모두 조정됩니다
 (지명을 제외할경우 지도 내부로 들어가서 지명레이어를 제외한 나머지는 전체선택하여 조정한후 지명을 재배치하는걸 권장합니다)
-------------------------------------------------------------------------------------------
*/
//xml외부경로(sample.swf?xmlURL=sample.xml)가 없으면 내부경로를이용합니다...
if (!xmlURL) {
	var xmlURL = "map_korea_detail.xml";
}
//                                                                                      
//색상변화속도(배경색상)
var alphaSpeed = 0.3;
//
//이동시적용속도(우맵등장,텍스트확대)
var moveSpeed = 0.3;
//
//마우스오버시 텍스트스케일
var textOverScale = 120;
//
//이동시 이동거리(+값을 아래에서 -값은 위에서)
var moveGap = 5;
//
////////////////////////////////////////// 이하 수정을 권장하지 않습니다
//
for (var i = 0; i<16; i++) {
	var mc = this["map"+i];
	mc._visible = 0;
	mc.startY = mc._y;
}
var stateNum;
var cityNum;
var stateVar;
var cityVar;
var initVar = 0;
map._visible = 0;
locationMc._visible = 0;
//
Stage.align = "t";
Stage.scaleMode = "noScale";
System.useCodepage = true;
var _this = this;
//
//
function loadEnd(success) {
	if (success) {
		var node = this.firstChild.childNodes;
		objNum = node.length;
		var att = this.firstChild.attributes;
		mapOutColor = att.mapColor.split("^")[0];
		mapOverColor = att.mapColor.split("^")[1];
		textOutColor = att.textColor.split("^")[0];
		textOverColor = att.textColor.split("^")[1];
		outLineColor = att.etcColor.split("^")[0];
		inLineColor = att.etcColor.split("^")[1];
		shadowColor = att.etcColor.split("^")[2];
		xmlObj = [];
		for (var i = 0; i<objNum; i++) {
			var _node = node[i].childNodes;
			var _state = node[i].nodeName;
			var _att = node[i].attributes;
			//
			changeColor(map.inside, inLineColor, 1);
			changeColor(map.outside, outLineColor, 1);
			changeColor(map.shadow, shadowColor, 1);
			//
			changeColor(_this["map"+i].inside, inLineColor, 1);
			changeColor(_this["map"+i].outside, outLineColor, 1);
			changeColor(_this["map"+i].shadow, shadowColor, 1);
			//
			var mcT = map["stateT"+i];
			mcT.tName.text = _state;
			mcT.tName.autoSize = "center";
			var format = new TextFormat();
			format.letterSpacing = -1;
			mcT.tName.setTextFormat(format);
			mcT._visible = 0;
			changeColor(mcT, textOverColor, 1);
			//
			var mc = map["state"+i];
			mc.i = i;
			mc.state = _state;
			mc.stateT = mcT;
			mc.link = _att.link;
			mc.target = _att.target;
			changeColor(mc, mapOutColor, 1);
			mc.onRollOver = function() {
				this.stateT._visible = 1;
				changeColor(this, mapOverColor, alphaSpeed);
			};
			mc.onRollOut = mc.onReleaseOutside=function () {
				if (stateVar != this.i) {
					this.stateT._visible = 0;
					changeColor(this, mapOutColor, alphaSpeed);
				}
			};
			mc.onRelease = function() {
				if (transBtn._visible) {
					transBtn._visible = 0;
				}
				setLocation(stateVar);
				//
				if (oldState != this) {
					showMap(this.i);
					stateVar = this.i;
					oldState.stateT._visible = 0;
					changeColor(oldState, mapOutColor, alphaSpeed);
					oldState = this;
				}
				changeColor(oldCity, mapOutColor, alphaSpeed);
				changeColor(oldCityT, textOutColor, alphaSpeed);
				changeScale(oldCityT, 100, alphaSpeed);
				cityVar = null;
				oldCity = null;
				oldCityT = null;
				//
				//
				if (this.link != "#" && initVar) {
					var _link = this.link.split(":");
					if (_link[0] == "js") {
						var fc = _link[1].split("(");
						var _para = fc[1].split(")");
						var para = _para[0].split(",");
						flash.external.ExternalInterface.call(fc[0], para);
					} else {
						getURL(this.link, this.target);
					}
				}
			};
			xmlObj[i] = [];
			for (var k = 0; k<_node.length; k++) {
				var att = node[i].childNodes[k].attributes;
				xmlObj[i][k] = {state:_state, city:node[i].childNodes[k].nodeName, link:att.link, target:att.target};
				//
				//
				var mcT = _this["map"+i]["cityT"+k];
				mcT.tName.text = xmlObj[i][k].city;
				mcT.tName.autoSize = "center";
				var format = new TextFormat();
				format.letterSpacing = -1;
				mcT.tName.setTextFormat(format);
				changeColor(mcT, textOutColor, 1);
				//
				var mc = _this["map"+i]["city"+k];
				mc.i = i;
				mc.k = k;
				mc.link = xmlObj[i][k].link;
				mc.target = xmlObj[i][k].target;
				changeColor(mc, mapOutColor, 1);
				mc.onRollOver = function() {
					changeColor(this, mapOverColor, alphaSpeed);
					changeColor(_this["map"+this.i]["cityT"+this.k], textOverColor, alphaSpeed);
					changeScale(_this["map"+this.i]["cityT"+this.k], textOverScale, alphaSpeed);
				};
				mc.onRollOut = mc.onReleaseOutside=function () {
					if (cityVar != this.k) {
						changeColor(this, mapOutColor, alphaSpeed);
						changeColor(_this["map"+this.i]["cityT"+this.k], textOutColor, alphaSpeed);
						changeScale(_this["map"+this.i]["cityT"+this.k], 100, alphaSpeed);
					}
				};
				mc.onRelease = function() {
					if (cityVar != this.k) {
						cityVar = this.k;
						setLocation(stateVar, cityVar);
						//
						oldCity.stateT._visible = 0;
						changeColor(oldCity, mapOutColor, alphaSpeed);
						changeColor(oldCityT, textOutColor, alphaSpeed);
						changeScale(oldCityT, 100, alphaSpeed);
						//
						oldCity = this;
						oldCityT = _this["map"+this.i]["cityT"+this.k];
						if (this.link != "#" && initVar) {
							var _link = this.link.split(":");
							if (_link[0] == "js") {
								var fc = _link[1].split("(");
								var _para = fc[1].split(")");
								var para = _para[0].split(",");
								flash.external.ExternalInterface.call(fc[0], para);
							} else {
								getURL(this.link, this.target);
							}
						}
					}
				};
			}
		}
		init();
	}
}
xmlData = new XML();
xmlData.onLoad = loadEnd;
xmlData.ignoreWhite = true;
xmlData.load(xmlURL);
//
//
showMap();
function init() {
	setLocation(null, null);
	locationMc._visible = 1;
	map._visible = 1;
	if (stateNum != null) {
		//맵고정
		var mc = map["state"+stateNum];
		mc.onRollOver();
		mc.onRelease();
		mc.onRollOut();
		var mc = _this["map"+stateNum]["city"+cityNum];
		mc.onRollOver();
		mc.onRelease();
		mc.onRollOut();
	} else {
		//시작할때 서울을 기본으로 띄움
		var mc = map8;
		mc._alpha = 30;
		mc._visible = 1;
		mc._y = mc.startY;
		transBtn.useHandCursor = false;
	}
	initVar = 1;
}
//
//
function changeColor(_mc, _color, _speed) {
	var color = new Color(_mc);
	var nowColor = color.getTransform();
	var red = (_color & 0xFF0000) >> 16;
	var green = (_color & 0x00FF00) >> 8;
	var blue = (_color & 0x0000FF);
	var mc = _mc.createEmptyMovieClip("colorMc", 0);
	mc.onEnterFrame = function() {
		nowColor.rb += _speed*(red-nowColor.rb);
		nowColor.gb += _speed*(green-nowColor.gb);
		nowColor.bb += _speed*(blue-nowColor.bb);
		color.setTransform(nowColor);
		var temp = Math.abs(nowColor.rb-red)+Math.abs(nowColor.gb-green)+Math.abs(nowColor.bb-blue);
		if (temp<1) {
			nowColor.rb = red;
			nowColor.gb = green;
			nowColor.bb = blue;
			color.setTransform(nowColor);
			delete this.onEnterFrame;
		}
	};
}
function changeScale(_mc, _scale, _speed) {
	var mc = _mc.createEmptyMovieClip("scaleMc", 1);
	mc.onEnterFrame = function() {
		_mc._xscale += _speed*(_scale-_mc._xscale);
		_mc._yscale = _mc._xscale;
		if (Math.abs(_scale-_mc._xscale)<1) {
			_mc._xscale = _mc._yscale=_scale;
			delete this.onEnterFrame;
		}
	};
}
function showMap(_i) {
	for (var i = 0; i<16; i++) {
		var mc = _this["map"+i];
		if (_i == i) {
			mc._visible = 1;
			mc._y = mc.startY+moveGap;
			mc.onEnterFrame = function() {
				this._y += moveSpeed*(this.startY-this._y);
				this._alpha += alphaSpeed*(105-this._alpha);
				if (this._alpha>=100) {
					delete this.onEnterFrame;
					//trace("showMap enter 삭제");
				}
			};
		} else {
			mc._visible = 0;
			mc._alpha = 0;
		}
	}
}
function setLocation(_stateVar, _cityVar) {
	locationMc.nameT.autoSize = "left";
	if (_stateVar == null && _cityVar == null) {
		locationMc.nameT.text = "전국";
	} else if (_cityVar == null) {
		locationMc.nameT.text = xmlObj[stateVar][0].state;
	} else {
		locationMc.nameT.text = xmlObj[stateVar][0].state+" > "+xmlObj[stateVar][cityVar].city;
	}
	locationMc.center._width = Math.round(locationMc.nameT._width+locationMc.nameT._x*2-locationMc.center._x*2);
	locationMc.right._x = locationMc.center._x+locationMc.center._width+locationMc.right._width;
}
