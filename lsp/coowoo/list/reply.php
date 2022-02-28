<?
include "include/include.php";
html_cache_disable();

$category_gid				= request( 'category_gid', 'get' );
$category_thread			= request( 'category_thread', 'get' );


?>
<form name=frm method=post action=reply_ing.php>
category_title : <input type=text name="category_title"> <input type=submit value="µî·Ï">
	<input type=hidden name=category_gid  value=<?=$category_gid?>>
	<input type=hidden name=category_thread  value=<?=$category_thread?>>
</form>
