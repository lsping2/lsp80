<?
/*
header('Content-Type: text/xml');
$url = 'http://dart.fss.or.kr/api/search.xml?auth=a840b1613d24d00f66bdb62979268d9ffff7a597&crp_cd=123410&page_set=15&start_dt=20000101&page_no='.$page_no;
$timeout = 10; // 0으로 하면 시간제한이 없다.
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_BINARYTRANSFER, TRUE);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);

include "./parser_php4.php";
$xml = iconv("utf-8","euc-kr", curl_exec($curl));
$parser = new XMLParser($xml);
$parser->Parse();

curl_close($curl);
*/


function DaumKeyWord(){
    $Curl = curl_init();
    curl_setopt($Curl, CURLOPT_URL, "https://www.daum.net/");
    curl_setopt($Curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($Curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    $Result = curl_exec($Curl);
    $Rand[0] = explode("<span class=\"txt_issue\">", $Result);
    for($i=1; $i < count($Rand[0]); $i++){
    $Rand[1] = explode("</span>", $Rand[0][$i]);
        $ReturnData = trim(strip_tags($Rand[1][0]));
        if($ReturnData){
            $ReturnArray[] = $ReturnData;
        }
    }
    $ReturnArray = array_unique($ReturnArray);
    foreach($ReturnArray as $ReturnArray) $Return[] = $ReturnArray;
    return $Return;
}
$DaumKeyWord = DaumKeyWord();
print_r($DaumKeyWord);
?>	