<?
$url = 'https://api.bithumb.com/public/ticker/ALL'; 

$ch = curl_init(); 

curl_setopt ($ch, CURLOPT_URL, $url); 

curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5); 

curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); 


$contents = curl_exec($ch); 


curl_close($ch); 


$array = json_decode($contents, true); 


print_r($array); 

echo "<br><br>";
echo "==>".$array['data']['BTC']['opening_price'];
?>