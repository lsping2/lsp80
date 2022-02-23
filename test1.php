AIzaSyA2k51f6wWzi37QM3rzZ5MayUmJVIlKB_E
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAn1v70BjVWYF3ytruJJ8cjMlw392NyHYU" type="text/javascript"></script>  

<script>
window.onload=function(){
var mymap=document.getElementById("map");
var latlng = null;
var country="2";

latlng =[

	[4.500418885346286,114.70792236621491," <strong>InnoCorr Offshore Sdn. Bhd. (1058983-K)</strong><br>No.3 Jalan Permata 9A/K59<br>Taman Perindustrian Air Hitam, 41200 Klang, Selangor<br>Malaysia<br>Contact. Mr.Ernest Lau<br><br>Tel. +60-3.3884.9680<br>Fax. +60-3.1700.810.962<br>Email ernest.lau@innocorroffshore.com<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sales@innocorroffshore.com<br>Website <a href='http://innocorroffshore.com' target='_blank'>https://www.innocorroffshore.com</a>"],

	[13.988655467909485,100.53522949805483," <strong>InnoCorr Offshore Sdn. Bhd. (1058983-K)</strong><br>No.3 Jalan Permata 9A/K59<br>Taman Perindustrian Air Hitam, 41200 Klang, Selangor<br>Malaysia<br>Contact. Mr.Ernest Lau<br><br>Tel. +60-3.3884.9680<br>Fax. +60-3.1700.810.962<br>Email ernest.lau@innocorroffshore.com<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sales@innocorroffshore.com<br>Website <a href='http://innocorroffshore.com' target='_blank'>https://www.innocorroffshore.com</a>"],


	[-2.2503001661734383,120.71711420081556," <strong>InnoCorr Offshore Sdn. Bhd. (1058983-K)</strong><br>No.3 Jalan Permata 9A/K59<br>Taman Perindustrian Air Hitam, 41200 Klang, Selangor<br>Malaysia<br>Contact. Mr.Ernest Lau<br><br>Tel. +60-3.3884.9680<br>Fax. +60-3.1700.810.962<br>Email ernest.lau@innocorroffshore.com<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sales@innocorroffshore.com<br>Website <a href='http://innocorroffshore.com' target='_blank'>https://www.innocorroffshore.com</a>"],

	[3.2069911288089674,101.82645263965241," <strong>InnoCorr Offshore Sdn. Bhd. (1058983-K)</strong><br>No.3 Jalan Permata 9A/K59<br>Taman Perindustrian Air Hitam, 41200 Klang, Selangor<br>Malaysia<br>Contact. Mr.Ernest Lau<br><br>Tel. +60-3.3884.9680<br>Fax. +60-3.1700.810.962<br>Email ernest.lau@innocorroffshore.com<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sales@innocorroffshore.com<br>Website <a href='http://innocorroffshore.com' target='_blank'>https://www.innocorroffshore.com</a>"],

	[1.3902932065679336,103.8534301891923," <strong>InnoCorr Offshore Sdn. Bhd. (1058983-K)</strong><br>No.3 Jalan Permata 9A/K59<br>Taman Perindustrian Air Hitam, 41200 Klang, Selangor<br>Malaysia<br>Contact. Mr.Ernest Lau<br><br>Tel. +60-3.3884.9680<br>Fax. +60-3.1700.810.962<br>Email ernest.lau@innocorroffshore.com<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sales@innocorroffshore.com<br>Website <a href='http://innocorroffshore.com' target='_blank'>https://www.innocorroffshore.com</a>"],

	[14.116545950391902,108.35749512305483," <strong>InnoCorr Offshore Sdn. Bhd. (1058983-K)</strong><br>No.3 Jalan Permata 9A/K59<br>Taman Perindustrian Air Hitam, 41200 Klang, Selangor<br>Malaysia<br>Contact. Mr.Ernest Lau<br><br>Tel. +60-3.3884.9680<br>Fax. +60-3.1700.810.962<br>Email ernest.lau@innocorroffshore.com<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sales@innocorroffshore.com<br>Website <a href='http://innocorroffshore.com' target='_blank'>https://www.innocorroffshore.com</a>"],


	[39.878723961791415,32.88044672014621," <b>T&T SYSTEMS LTD.</b><br>Contact: Mr. Levent Tuvan (Mr.) – Company Director<br>Engineering, Representation, Consultancy<br>“All About Pipelines”<br><a href='http://www.ttsistem.com' target='_blank'>http://www.ttsistem.com</a><br>Tel:  +90 312 496 15 98 -99<br>Fax +90 312 496 15 97<br>Address: Birlik Mah. 486 Sk. No:3/B Çankaya-ANKARA"]
   	];
var gmap=new google.maps.Map(
mymap,{zoom:2, left:new google.maps.LatLng(latlng[0][0], latlng[0][1]),center:new google.maps.LatLng(latlng[0][0], latlng[0][1]), mapTypeId:google.maps.MapTypeId.ROADMAP}
);


var infowindow = new google.maps.InfoWindow();

var marker, i;
for (i = 0; i < latlng.length; i++) {
marker=new google.maps.Marker({
position:new google.maps.LatLng(latlng[i][0], latlng[i][1]),
map:gmap, title:latlng[i][2]
});


google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(latlng[i][2]);
          infowindow.open(map, marker);
        }
      })(marker, i));


}
};

</script>
</head>
<body>
<div id="map" style="width:742px; height:420px;">
</div>

</script>

				
				<!--<img src="../images/01_05.jpg" width="740" height="3383">-->
		
				
				</td>
              </tr>
            </table></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="53" background="../images/bg_title.jpg">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="40" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="center"> 
      <?php include "../include_e/foot.php"; ?>
    </td>
  </tr>
</table>
</body>
</html>
<?
include_once("./_tail.php");
?>