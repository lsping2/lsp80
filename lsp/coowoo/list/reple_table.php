<?
include "include/include.php";

$db = new mysql();


$query	="			CREATE TABLE cd_category 
					( category_no  int(10) auto_increment,
					  category_gid  int(10),
					  category_thread  varchar(100),
					  category_name  varchar(50),
					  category_keyword  varchar(50),
					  category_title  varchar(100),
					  category_sort  int(10),
					  reg_date  datetime defalut'0000-00-00 00:00:00'
					)

";



$db->query( $query );

?>

