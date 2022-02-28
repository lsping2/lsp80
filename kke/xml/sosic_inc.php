<?
$url="http://www.1wonad.com/coin/sosic/sosic_height.xml";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$g = curl_exec($ch);
curl_close($ch);
$parser = new XMLParser($g);
$parser->Parse();
$sosic_height=$parser->document->tagChildren[0]->tagData; //광고소식높이
$buy_height = $parser->document->tagChildren[1]->tagData;//구매내역높이
?>