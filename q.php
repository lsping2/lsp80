<?
ini_set("allow_url_fopen","1");
?>
<meta charset="utf-8">
<?
$url = "http://www.kma.go.kr/XML/weather/sfc_web_map.xml"; 

$xml = @simplexml_load_file($url); 
$weather = $xml->weather; 
foreach( $weather->local as $local) 
{ 
echo "<b>".$local."<br></b>"; 
foreach($local->attributes() as $a => $b) { 
    echo "$a=$b<br>"; 
} 
echo "----------------------------<br>"; 
} 
?>

	