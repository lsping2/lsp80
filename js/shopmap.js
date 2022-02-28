// 마커를 담을 배열입니다
var markers = [];

var mapContainer = document.getElementById('map'); // 지도를 표시할 div

var map = new daum.maps.Map(mapContainer, {
    center: new daum.maps.LatLng(36.75541, 127.889025),
    level: 13 // 지도의 확대 레벨
});  // 지도를 생성합니다

var imageSrc = 'http://ebabypark.co.kr/images/store/marker_blue.png', // 마커이미지의 주소입니다
    imageSize = new daum.maps.Size(28, 37), // 마커이미지의 크기입니다
    imageOption = {offset: new daum.maps.Point(14, 37)};
var markerImage = new daum.maps.MarkerImage(imageSrc, imageSize, imageOption);

// 마우스휠로 확대/축소 차단
map.setZoomable(false);

// 마커 클러스터러를 생성합니다
var clusterer = new daum.maps.MarkerClusterer({
    map: map, // 마커들을 클러스터로 관리하고 표시할 지도 객체
    averageCenter: true, // 클러스터에 포함된 마커들의 평균 위치를 클러스터 마커 위치로 설정
    disableClickZoom: true,
    minLevel: 10 // 클러스터 할 최소 지도 레벨
});

// 이벤트 헨들러로 cluster 객체가 넘어오지 않을 수도 있습니다
daum.maps.event.addListener(clusterer, 'clusterclick', function(cluster) {

    // 현재 지도 레벨에서 1레벨 확대한 레벨
    var level = map.getLevel()-1;

    // 지도를 클릭된 클러스터의 마커의 위치를 기준으로 확대합니다
    map.setLevel(level, {anchor: cluster.getCenter()});
});

// 지도를 재설정할 범위정보를 가지고 있을 LatLngBounds 객체를 생성합니다
var bounds = new daum.maps.LatLngBounds();

// 전체리스트 리스트업
placesSearchCB();

// 키워드 검색을 요청하는 함수
function searchPlaces() {

    var keyword = document.getElementById('keyword').value;

    // 전체검색을 위해서 삭제
    if (!keyword.replace(/^\s+|\s+$/g, '')) {
        location.reload();
        // alert('키워드를 입력해주세요!');
        return false;
    }

    // 장소검색 객체를 통해 키워드로 장소검색을 요청합니다
    placesSearchCB(keyword);
}

// 장소검색이 완료됐을 때 처리함수
function placesSearchCB(keyword) {

    // 데이터를 가져와 마커를 생성하고 클러스터러 객체에 넘겨줍니다
    hideMarkers();
    // 클래스터 초기화
    clusterer.clear();

    $.get("http://lsp80.cafe24.com/json/data.php", {keyword: keyword}, function (data) {

        // 데이터에서 좌표 값을 가지고 마커를 표시합니다
        // 마커 클러스터러로 관리할 마커 객체는 생성할 때 지도 객체를 설정하지 않습니다
        var markers = $(data.positions).map(function (i, position) {
            // LatLngBounds 객체에 좌표를 추가합니다
            bounds.extend(new daum.maps.LatLng(position.lat, position.lng));
            return addMarker(position, i)
        });

        // 클러스터러에 마커들을 추가합니다
        clusterer.addMarkers(markers);

        // 검색 목록을 생성합니다.
        displayPlaces(data.positions);
    });
}

// 검색 결과 목록과 마커를 표출하는 함수
function displayPlaces(places) {

    // 초기화
    var listEl = document.getElementById('placesList'),
        menuEl = document.getElementById('menu_wrap'),
        fragment = document.createDocumentFragment(),
        // bounds = new daum.maps.LatLngBounds(),
        listStr = '';
        shopInfo = '';

    // 검색 결과 목록에 추가된 항목들을 제거합니다
    removeAllChildNods(listEl);

    for (var i = 0; i < places.length; i++) {

        itemEl = getListItem(i, places[i]), // 검색 결과 항목 Element를 생성합니다
        shopInfo = places[i];

        // 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
        // LatLngBounds 객체에 좌표를 추가합니다
        fragment.appendChild(itemEl);
    }

    // 검색결과 항목들을 검색결과 목록 Elemnet에 추가합니다
    listEl.appendChild(fragment);
    menuEl.scrollTop = 0;
}

// 마커를 생성하고 지도 위에 마커를 표시하는 함수
function addMarker(places, idx) {

    marker = new daum.maps.Marker({
        map: map,
        image: markerImage,
        position: new daum.maps.LatLng(places.lat, places.lng),
        clickable: true,
    });

    overLaypView(places);

    return marker;
}

function overLaypView(places) {
    // 마커에 클릭이벤트를 등록합니다
    return daum.maps.event.addListener(marker, 'click', function () {
        overlay = new daum.maps.CustomOverlay({
            map: map,
            position: new daum.maps.LatLng(places.lat, places.lng),
            content: displayInfowindow(marker, places),
        }), panTo(places.lat, places.lng);
    });
}

function displayInfowindow(marker, shopInfo) {

    // JSON.stringify(shopInfo, null, 2)

    var content = '<div class="wrap">' +
        '    <div class="info">' +
        '        <div class="title">' + shopInfo.place_name +
        '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
        '        </div>' +
        '        <div class="body">' +
        '            <div class="img">' +
        '                <img src="http://ebabypark.co.kr/images/main/bp.jpg" width="80" height="60">' +
        '           </div>' +
        '            <div class="desc">' +
        '                <div class="addr">' + shopInfo.road_address_name + '</div>' +
        '                <div class="jibun">' + shopInfo.address_name + '</div>' +
        '                <div class="tel"><a href="tel:' + shopInfo.phone + '">' + shopInfo.phone + '</a></div>' +
        '                <div class="info"><a href=javascript:getStoreDetail("'+ shopInfo.id +'");>상세정보</a></div>' +
        // '                <div class="info ellipsis"><a href="' + shopInfo.place_url + '" target="_blank">상세정보</a></div>' +
        '            </div>' +
        '        </div>' +
        '    </div>' +
        '</div>';

    return content;
}

// 검색결과 목록의 자식 Element를 제거하는 함수
function removeAllChildNods(el) {
    while (el.hasChildNodes()) {
        el.removeChild(el.lastChild);
    }
}

// 검색결과 항목을 Element로 반환하는 함수
function getListItem(index, places) {

    var el = document.createElement('li'),
        itemStr = '<span class="markerbg marker"></span>' +
            '<div class="info" onclick="panTo(' + places.lat + ',' + places.lng + ')">' +
            '   <h5>' + places.place_name + '</h5>';

    if (places.road_address_name) {
        itemStr += '    <span>' + places.road_address_name + '</span>' +
            '   <span class="jibun gray">' + places.address_name + '</span>';
    } else {
        itemStr += '    <span>' + places.address_name + '</span>';
    }

    itemStr += '  <span class="tel">' + places.phone + '</span>' +
        '</div>';

    el.innerHTML = itemStr;
    el.className = 'item';

    return el;
}

// 커스텀 오버레이를 닫기 위해 호출되는 함수
function closeOverlay() {
    overlay.setMap(null);
}

/* 클릭 중심을 이동 */
function panTo(locX, locY) {
    // 지도 레벨변경
    map.setLevel(2);

    // 마우스휠 확대 허용
    map.setZoomable(true);

    // 이동할 위도 경도 위치를 생성합니다
    var moveLatLon = new daum.maps.LatLng(locX, locY);

    // 지도 중심을 부드럽게 이동시킵니다
    // 만약 이동할 거리가 지도 화면보다 크면 부드러운 효과 없이 이동합니다
    map.panTo(moveLatLon);
}

function hideMarkers() {
    setMarkers(null);
}

// 배열에 추가된 마커들을 지도에 표시하거나 삭제하는 함수
function setMarkers(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

function setbounds() {
    // LatLngBounds 객체에 추가된 좌표들을 기준으로 지도의 범위를 재설정합니다
    // 이때 지도의 중심좌표와 레벨이 변경될 수 있습니다
    map.setBounds(bounds);
}



function rhtmlspecialchars(str) {
    if (typeof(str) == "string") {
        str = str.replace(/&gt;/ig, ">");
        str = str.replace(/&lt;/ig, "<");
        str = str.replace(/&#039;/ig, "'");
        str = str.replace(/&quot;/ig, '"');
        str = str.replace(/&amp;/ig, '&'); /* must do &amp; last */
    }
    return str;
}

/* id로 처리 검토 예정 */
// 검색결과 이지미 항목을 Element로 반환하는 함수입니다
function rimgHtml(id,data){
    var temp = rhtmlspecialchars(data);
    var temp_split;
    temp_split = temp.split("::");
    for (var i = 0; i < temp_split.length; i++) {
        temp += "<li data-thumb='"+temp_split[i]+"'><img src='"+temp_split[i]+"'></li>";
    }
    return temp;
}

// 매장 기본 정보 항목을 Element로 반환하는 함수입니다
function rinfoHtml(data){
    var temp = rhtmlspecialchars(data);
    var temp_split;
    temp_split = temp.split("::");

    var tempEl = '<dt>' + '매장소개' + '</dt>'
        + '<dd>' + temp_split[0] + '</dd>'
        + '<dt>' + '주차정보' + '</dt>'
        + '<dd>' + temp_split[1] + '</dd>'
        + '<dt>' + '매장행사' + '</dt>'
        + '<dd><a href="'+ temp_split[2] +'" target="_blank">이벤트 안내</dd>';

    return tempEl;
}

/* 매장오픈 시간테이블 */
function rtimeHtml(data){
    var temp = rhtmlspecialchars(data)
    temp_split = temp.split("::");

    var tempEl = '<dd class="panel">'
    + '<div class="date_time cafetimeWrap">'
    + '<dl class="date_time_left">'
        + '<dt>월요일</dt>' + '<dd>' + temp_split[0] + '</dd>'
        + '<dt>화요일</dt>' + '<dd>' + temp_split[1] + '</dd>'
        + '<dt>수요일</dt>' + '<dd>' + temp_split[2] + '</dd>'
    + '</dl>'
    + '<dl class="date_time_mid">'
        + '<dt>목요일</dt>' + '<dd>' + temp_split[3] + '</dd>'
        + '<dt>금요일</dt>' + '<dd>' + temp_split[4] + '</dd>'
        + '<dt>토요일</dt>' + '<dd>' + temp_split[5] + '</dd>'
    + '</dl>'
    + '<dl class="date_time_right">'
        + '<dt>일요일</dt>' + '<dd>' + temp_split[6] + '</dd>'
        + '<dt class="badge badge-pill badge-danger">휴무일</dt>' + '<dd>' + temp_split[7] + '</dd>'
    + '</dl>'
    + '</div>'
    + '</dd>';

    return tempEl
}