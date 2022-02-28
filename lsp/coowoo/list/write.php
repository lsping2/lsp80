<?
include "include/include.php";
html_cache_disable();

$category_title					= request( 'category_title', 'POST' );


$db = new MYSQL();




$query = "SELECT MAX(category_no) as max FROM cd_category";
$db->query( $query );
$db->fetch();


$max				= $db->result( 'max' );


$rsRs=$max + 1;



$query2="insert into cd_category  values( ''  ,  '$rsRs'  ,  '001'  ,  '$category_title'  ,  ''  ,  ''  ,  ''  ,  now() )";
$db->query( $query2);

js_back();
?>