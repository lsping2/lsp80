<meta charset="utf-8">
<?php
ini_set("allow_url_fopen","1");
// example of how to use basic selector to retrieve HTML contents
include('./simple_html_dom.php');

 //https://www.isoaam.or.kr/release
//https://search.naver.com/search.naver?where=news&query=%ED%95%9C%EA%B5%AD%EB%B0%B1%ED%98%88%EB%B3%91%EC%86%8C%EC%95%84%EC%95%94%ED%98%91%ED%9A%8C&ie=utf8&sm=tab_srt&sort=1&photo=0&field=0&reporter_article=&pd=0&ds=&de=&docid=&nso=so%3Add%2Cp%3Aall%2Ca%3Aall&mynews=0&mson=0&refresh_start=0&related=0

// get DOM from URL or file
$html = file_get_html('https://search.naver.com/search.naver?where=news&query=%ED%95%9C%EA%B5%AD%EB%B0%B1%ED%98%88%EB%B3%91%EC%86%8C%EC%95%84%EC%95%94%ED%98%91%ED%9A%8C&ie=utf8&sm=tab_srt&sort=1&photo=0&field=0&reporter_article=&pd=0&ds=&de=&docid=&nso=so%3Add%2Cp%3Aall%2Ca%3Aall&mynews=0&mson=0&refresh_start=0&related=0');


foreach($html->find('dt > ._sp_each_title') as $article) {
   echo  $article;
   echo "<br>";
}






?>