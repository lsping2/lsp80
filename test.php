<?
ini_set("allow_url_fopen","1");
include_once('./lib/snoopy/Snoopy.class.php'); 
include_once('./simple_html_dom.php'); 
?>
<meta charset="utf-8">
<?
//https://www.isoaam.or.kr/release
//http://gsdt.kr/sample.html

$url="http://search.naver.com/search.naver?where=news&query=%ED%95%9C%EA%B5%AD%EB%B0%B1%ED%98%88%EB%B3%91%EC%86%8C%EC%95%84%EC%95%94%ED%98%91%ED%9A%8C&ie=utf8&sm=tab_srt&sort=1&photo=0&field=0&reporter_article=&pd=0&ds=&de=&docid=&nso=so%3Add%2Cp%3Aall%2Ca%3Aall&mynews=0&mson=0&refresh_start=0&related=0";


$snoopy = new Snoopy;
$snoopy->referer = "http://search.naver.com";
$snoopy->fetch($url);

$html =new simple_html_dom();
$html->load($snoopy->results);
$lists=$html->find('dt > ._sp_each_title');
 
foreach($lists as $list){
    echo $list;
	echo "<br>";
}

?>

