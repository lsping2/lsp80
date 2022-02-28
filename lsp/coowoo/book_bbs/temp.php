<?
require_once "../include/include.php";



$db = new MYSQL();
$db2 = new MYSQL();



$query = "
													CREATE  TABLE temp_result 
													(
														order_no 
													)
													VALUES
													(
													
													INDEX( image_no ) 
													SELECT	S
																ki.image_no
													FROM	member.keyindex_info_sort as ki, member.keyword_no as kn
													WHERE	ki.index_no = kn.index_no
													AND		kn.keyword = '" . $keyword_array[$count] . "'
";
$db->query( $query );
$db->fetch();

$old_bbs_fid		= $db->result( 'bbs_fid' );

create table aaa select * from board_kke
create table aaa select name from board_kke
create table aaa select * from board_kke where name='김경은'
create table aaa type=heap select name,pass from board_kke where name='김경은';
CREATE TABLE aaa  ( product_class enum('membership', 'single') ) TYPE=HEAP


?>