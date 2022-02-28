<meta charset="utf-8">
<?
function Ncurrency() {
 
	# 데이터 호출
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://info.finance.naver.com/marketindex/exchangeList.nhn');
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	$res = iconv('euc-kr', 'UTF-8', $response); if(!$response) return 'false';
 
	# 파싱
	preg_match("/<tbody.*?>.*?<\/[\s]*tbody>/s", $res, $tbody); if(!is_array($tbody)) return 'false';
	preg_match_all('`<tr.*?>(.*?)<\/[\s]*tr>`s', $tbody[0], $tr); if(!is_array($tr)) return 'false';
 
	$Data = array();
	foreach($tr[0] as $k=>$v) {
 
		unset($td, $akey);
		preg_match_all('`<td.*?>(.*?)<\/td>`s', $v, $td);
		$td = $td[0];
		$akey = preg_replace('/([\xEA-\xED][\x80-\xBF]{2})+/', '', strip_tags($td[0]));
		$akey = trim(str_replace('JPY (100)', 'JPY', $akey));
		$akey = trim(str_replace(' 100', '', $akey)); if(!$akey) return 'false';
		$Data[$akey]['통화명'] = trim(strip_tags($td[0]));
		$Data[$akey]["매매기준율"] = str_replace(',', '', trim(strip_tags($td[1])));
		$Data[$akey]["현찰살때"] = str_replace(',', '', trim(strip_tags($td[2])));
		$Data[$akey]["현찰팔때"] = str_replace(',', '', trim(strip_tags($td[3])));
		$Data[$akey]["송금보낼때"] = str_replace(',', '', trim(strip_tags($td[4])));
		$Data[$akey]["송금받을때"] = str_replace(',', '', trim(strip_tags($td[5])));
		$Data[$akey]["환가료율"] = str_replace(',', '', trim(strip_tags($td[6])));
		$Data[$akey]["미화환산율"] = str_replace(',', '', trim(strip_tags($td[7])));
	}
 
	return $Data;
}

$Data = Ncurrency();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script language="JavaScript" src="/js/coin2.js"></script>

 <table bgcolor="#f6f6f6" border=0 class="datatable2" style="display:none" class="display" cellpadding="1" cellspacing="1" width="70%">
<thead>
    <tr >
        <th style="width:40px;text-align: center">순위  </th>
        <th style="width:100px;text-align: center">코인명  </th>
        <th style="width:100px;text-align: center">세계평균(원) </th>
        <th style="width:100px;text-align: left">세계평균(＄)  </th>
        <th style="text-align: right">가격(BTC)  </th>
        <th style="text-align: center">변동<br>1h</th>
        <th style="text-align: center">변동 <br>24h </th>
        <th style="text-align: center">변동 <br>7day</th>
    </tr>
</thead>
</table> 

 <table bgcolor="#f6f6f6" border=0 class="datatable" class="display" cellpadding="1" cellspacing="1" width="70%">
<thead>
    <tr>
        <th style="width:40px;text-align: center">순위  </th>
        <th style="width:100px;text-align: center">코인명  </th>
        <th style="width:100px;text-align: center">세계평균(원) </th>
        <th style="width:100px;text-align: left">세계평균(＄)  </th>
        <th style="text-align: right">가격(BTC)  </th>
        <th style="text-align: center">변동<br>1h</th>
        <th style="text-align: center">변동 <br>24h </th>
        <th style="text-align: center">변동 <br>7day</th>
    </tr>
</thead>
</table> 

<script>
 $(document).ready(function(){
	set_it('<?=$Data[USD][매매기준율]?>' , '<?=$nm?>' );
});
</script>