
<!--구글지도 스타일/지도크기 --> 

<style> 

#mgmap { width: 100%; height:500px; margin:0; padding: 0px; border: 0px; } 

</style> 


<!--구글지도 스타일 --> 

<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.exp&sensor=false&language=ko&region=kr"></script><!-- 수산나님 도움 지도에 동해로 나오게 변경 --> 


<script type="text/javascript"> 

    function mgminfomap(){ 

        var myOptions = { 
            zoom: 3, 

             //center: new google.maps.LatLng(27.3114655, 90.94384680000007), 

             mapTypeId: google.maps.MapTypeId.ROADMAP 

        } 

      var map = new google.maps.Map(document.getElementById('mgmap'), myOptions); 
        var locations = [ 

            <? for ($i=0; $i<count($list); $i++) { 
                $name1=strip_tags($list[$i][subject]); 
                $lat=('12.4124'); 
                $lng=('25.5235'); 
                $address=strip_tags('서울 공릉동'); 
                $mapnum=('4'); 
                $mtem="<table><tr><td width=100%><a href={$list[$i][href]}>$name1</a></td></tr><tr><td width=100%>{$address}</td></tr></table>"; 


            ?> 
            ['<?=$mtem?>', '<?=$lat?>', '<?=$lng?>', '<?=$mapnum?>'] 


                <? if ($i==count($list)-1) continue; ?> 

                , 

            <? } ?> 
 
        ]; 


      var infowindow = new google.maps.InfoWindow(); 
      var marker, i; 

        var bounds = new google.maps.LatLngBounds(); 


      for (i = 0; i < locations.length; i++) { 
            var myLatLng = new google.maps.LatLng(locations[i][1], locations[i][2]);  

             var marker = new google.maps.Marker({ 

                position: myLatLng, 

                map: map 

            }); 


            bounds.extend(myLatLng); 


            map.fitBounds(bounds); 


 


             google.maps.event.addListener(marker, 'click', (function(marker, i) { 



                return function() { 


                    infowindow.setContent(locations[i][0]); 


                   infowindow.open(map, marker); 

                } 

             })(marker, i)); 



        } 

        zoomChangeBoundsListener = google.maps.event.addListener(map, "bounds_changed",function(event){  

if(this.getZoom() > 20)  
this.setZoom(16);  
google.maps.event.removeListener(zoomChangeBoundsListener);  

});  


    // 성격파틴자님 조언 너무 가까이보일때 적용 

    } 


    google.maps.event.addDomListener(window, 'load', mgminfomap); 

</script> 




         <?php if ($is_list && $lat != 37.5665) { //리스트검색결과 없을때,주소없을 경우(서울시청 동일 위도) 리스트에 지도 숨김 ?> 

         <div id="mgmap" style="padding-top:20px;padding-left:20px;padding-bottom:20px;verticul-align:middle; text-align:left;border:10px solid #f3f3f3;"></div> 
         <?php } ?> 

         <br /> 


<!--구글지도 끝 ----------------> 
