<meta charset="utf-8">
<?php
// MSN 날씨 링크....
// http://weather.service.msn.com/data.aspx?weadegreetype=C&culture=ko-KR&weasearchstr=%EC%84%9C%EC%9A%B8
// 기상청 날씨 링크...
// http://www.kma.go.kr/XML/weather/sfc_web_map.xml

/* 참고사항

stn_id = 지역코드
icon = 기상청 아이콘 넘버.
desc = 날씨 description(설명문)
ta = 기온
rn_hr1 = 강수량(표시시에는 * 0.1을 해야함)
	
*/

/*
		기상청 아이콘 값
		01	맑음
		02	구름조금
		03	구름많음
		04	흐림
		05
		06
		07	소나기
		08	비
		09
		10
		11	눈
		12	비 또는 눈
		13	눈 또는 비
		14	천둥번개
		15	안개
		16	황사
		17	박무
		18	연무
		19
		20	가끔 비, 한때 비
		21	가끔 눈, 한때 눈
		22	가끔 비 또는 눈, 한때 비 또는 눈
		23	가끔 눈 또는 비, 한때 눈 또는 비  
*/


	function weather($area) {
		ini_set("always_populate_raw_post_data","true");
		
		$area_code = "";

		switch($area) {			
			case "속초":
				$area_code = 90;
				break;
			case "철원":
				$area_code = 95;
				break;
			case "동두천":
				$area_code = 98;
				break;
			case "파주": 
				$area_code = 99;
				break;
			case "대관령":
				$area_code = 100;
				break;
			case "춘천":
				$area_code = 101;
				break;
			case "백령도":
				$area_code = 102;
				break;
			case "북강릉":
				$area_code = 104;
				break;
			case "강릉":
				$area_code = 105;
				break;
			case "동해":
				$area_code = 106;
				break;
			case "서울": 
				$area_code = 108;
				break;
			case "인천":
				$area_code = 112;
				break;
			case "원주":
				$area_code = 114;
				break;
			case "울릉도":
				$area_code = 115;
				break;
			case "수원":
				$area_code = 119;
				break;
			case "영월":
				$area_code = 121;
				break;
			case "충주":
				$area_code = 127;
				break;
			case "서산":
				$area_code = 129;
				break;
			case "울진":
				$area_code = 130;
				break;
			case "청주":
				$area_code = 131;
				break;
			case "대전":
				$area_code = 133;
				break;
			case "추풍령":
				$area_code = 135;
				break;
			case "안동":
				$area_code = 136;
				break;
			case "상주":
				$area_code = 137;
				break;
			case "포항":
				$area_code = 138;
				break;
			case "군산":
				$area_code = 140;
				break;
			case "전주":
				$area_code = 146;
				break;
			case "울산":
				$area_code = 152;
				break;
			case "창원":
				$area_code = 155;
				break;
			case "광주":
				$area_code = 156;
				break;
			case "부산":
				$area_code = 159;
				break;
			case "통영":
				$area_code = 162;
				break;
			case "목포":
				$area_code = 165;
				break;
			case "여수":
				$area_code = 168;
				break;
			case "흑산도":
				$area_code = 169;
				break;
			case "완도":
				$area_code = 170;
				break;
			case "고창":
				$area_code = 172;
				break;
			case "순천":
				$area_code = 174;
				break;
			case "진도(첨찰산)":
				$area_code = 175;
				break;
			case "대구(기)":
				$area_code = 143;
				break;
			case "제주": 
				$area_code = 184;
				break;
			case "고산":
				$area_code = 185;
				break;
			case "성산":
				$area_code = 188;
				break;
			case "서귀포":
				$area_code = 189;
				break;
			case "진주":
				$area_code = 192;
				break;
			case "강화":
				$area_code = 201;
				break;
			case "양평":
				$area_code = 202;
				break;
			case "이천":
				$area_code = 203;
				break;
			case "인제":
				$area_code = 211;
				break;
			case "홍천":
				$area_code = 212;
				break;
			case "태백":
				$area_code = 216;
				break;
			case "정선군":
				$area_code = 217;
				break;
			case "제천":
				$area_code = 221;
				break;
			case "보은":
				$area_code = 226;
				break;
			case "천안":
				$area_code = 232;
				break;
			case "보령":
				$area_code = 235;
				break;
			case "부여":
				$area_code = 236;
				break;
			case "금산":
				$area_code = 238;
				break;
			case "부안":
				$area_code = 243;
				break;
			case "임실":
				$area_code = 244;
				break;
			case "정읍":
				$area_code = 245; 
				break;
			case "남원":
				$area_code = 247;
				break;
			case "장수":
				$area_code = 248;
				break;
			case "고창군":
				$area_code = 251;
				break;
			case "영광군":
				$area_code = 252;
				break;
			case "김해시":
				$area_code = 253;
				break;
			case "순창군":				
				$area_code = 254;
				break;
			case "북창원":
				$area_code = 255;
				break;
			case "양산시":
				$area_code = 257;
				break;
			case "보성군":
				$area_code = 258;
				break;
			case "강진군":
				$area_code = 259;
				break;
			case "장흥":
				$area_code = 260;
				break;
			case "해남":
				$area_code = 261;
				break;
			case "고흥":
				$area_code = 262;
				break;
			case "의령군":
				$area_code = 263;
				break;
			case "함양군":
				$area_code = 264;
				break;
			case "광양시":
				$area_code = 266;
				break;
			case "진도군":
				$area_code = 268;
				break;
			case "봉화":
				$area_code = 271;
				break;
			case "영주":
				$area_code = 272;
				break;
			case "문경":
				$area_code = 273;
				break;
			case "청송군":
				$area_code = 276;
				break;
			case "영덕":
				$area_code = 277;
				break;
			case "의성":
				$area_code = 278;
				break;
			case "구미":
				$area_code = 279;
				break;
			case "영천":
				$area_code = 281;
				break;
			case "경주시":
				$area_code = 283;
				break;
			case "거창":
				$area_code = 284;
				break;
			case "합천":
				$area_code = 285;
				break;
			case "밀양":
				$area_code = 288;
				break;
			case "산청":
				$area_code = 289;
				break;
			case "거제":
				$area_code = 294;
				break;
			case "남해":
				$area_code = 295;
				break;	
		}
			
		if (empty($area_code)) {			
			return false; 
			exit;
		}
	
		//XML 파싱
		$url = "www.kma.go.kr";
		$weather_url = "GET /";
		$weather_url.= "XML/weather/sfc_web_map.xml";
		$weather_url.= " HTTP/1.0\r\nHost:www.kma.go.kr\r\n\r\n";
	
		$fp = @fsockopen($url, 80, $errno, $errstr, 30);
		
		if (!$fp) {
			
			//echo "?   $errstr ($errno)<br />n";
			
		}
		else {
				
			fwrite($fp, $weather_url);		
			
			$i = 0;
			
			while(!feof($fp)) {			
				
				$list[$i] = fgets($fp, 1024);
				$list[$i] = trim($list[$i]); 
				$i++;
				
			}
		}	
		
		fclose($fp);
		
		// 데이터 변수에 담기
		for($q = 0, $w = 0; $q < sizeof($list); $q++) {
				
			if(strstr($list[$q], "<weather")) {
				$weather_time = $list[$q];
			}
		
			if(strstr($list[$q], "<local")) {
				$weather_data[$w] = $list[$q];
				$w++;
			}
		}
		
		//날짜 데이터
		$weather_time = str_replace("<weather ", "", $weather_time);
		$weather_time = str_replace(">", "", $weather_time);
		$weather_time = str_replace("\"", "", $weather_time);
		$weather_time = str_replace("year=", "", $weather_time);
		$weather_time = str_replace("month=", "", $weather_time);
		$weather_time = str_replace("day=", "", $weather_time);
		$weather_time = str_replace("hour=", "", $weather_time);
		$weather_time = explode(" ", $weather_time);
		
		$weather_time = array(
			"year" => $weather_time[0],
			"month" => $weather_time[1],
			"day" => $weather_time[2],
			"hour" => $weather_time[3],
		);
				
		//지역별 날씨 정보.
		for($e = 0; $e < sizeof($weather_data); $e++) {
			
			$weather_data[$e] = str_replace("<local ", "", $weather_data[$e]);
			$weather_data[$e] = str_replace("</local>", "", $weather_data[$e]);
			$weather_data[$e] = str_replace(">", " ", $weather_data[$e]);
			$weather_data[$e] = str_replace("\"", "", $weather_data[$e]);
			$weather_data[$e] = explode(" ", $weather_data[$e]);		

			$wd = explode("=", $weather_data[$e][0]);
			
			$area_name = $wd[1]; 

			$weather_area[$area_name] = $weather_data[$e];
			$wd_list = array();
			$weather_list = array();
			
			for($r = 0; $r < sizeof($weather_area[$area_name]); $r++) {
				
				$wd_lists = explode("=", $weather_area[$area_name][$r]); 
				
				array_push($wd_list, $wd_lists);
				
				for($t = 0; $t < sizeof($wd_list); $t++) {
					
					$key = $wd_list[$t][0];
					$value = $wd_list[$t][1];
					
					$weather_area[$area_name][$key] = $value;
					
				}
			
			}

		}

		return $weather_area[$area_code];

}
	
// 환율 주소..

// http://community.fxkeb.com/fxportal/jsp/RS/DEPLOY_EXRATE/fxrate_all.html
	

	$return = weather('서울');

	//print_r($return);
  	if (!$return['icon']) {
		$icon = "01";
	}else{
			switch ($return['icon'])
			{
				case  01 :
					$icon = "01";
				break;
				case  07 :
				case  08 :
					$icon = "03";
				case  11 :
				case  12 :
				case  13 :
					$icon = "04";
				default: 
					$icon = "02";
			}
	}
?>


<table width="273" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center"><strong><?=date('Y')?>. <?=date('m')?>. <?=date('d')?></strong></td>
    <td align="center" style="color:#202326; font-weight:bold"> 서울 </td>
    <td align="center"><span style="color:#F00"><?=iconv("UTF-8", "EUC-KR", $return['ta'])?>℃</span></td>
    <td align="center"><img src="/img/<?=$icon?>.jpg"></img></td>
    <td align="right" width="27">&nbsp;</td>
  </tr>
</table>