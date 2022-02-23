<?

require_once "../../../include/include.php";
html_cache_disable();

$data_folder_no		= request( 'data_folder_no' , 'get' );
$cd_folder			= request( 'cd_folder' , 'get' );
$cd_folder_end		= request( 'cd_folder_end' , 'get' );
$pricelist_no			= request( 'pricelist_no' , 'get' );
$folder				= request( 'folder' , 'get' );

$license_code			= request( 'license_code', 'get');

$db = new MYSQL;
$db2 = new MYSQL;
$db3 = new MYSQL;

?>
<html>
<head>
<title><?$HTML->Title( 'Admin' )?></title>
<?=$HTML->Metatag()?>
<link rel="stylesheet" href="../../admin_style.css" type="text/css">

<body>
<table width=480 border=0 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td align=center height=50>
	<? if( FALSE == $dir_error ) : ?>
	<a href="cd2single2_step1.php?data_folder_no=<?=$data_folder_no?>&cd_order_no=<?=$cd_folder?>&pricelist_no=<?=$pricelist_no?>&license_code=<?=$license_code?>" onFocus='this.blur()'>[   완료   ]</a>
	<? endif ?>
	<a href="javascript:window.history.back()" onFocus='this.blur()'>[   돌아가기   ]</a>
	</td>
</tr>
</table>

<?

if( $cd_folder AND $cd_folder_end )
{
	$query = "
			SELECT	image_no ,
					single_order_no ,
					manufacture_code
			FROM	product_images
			WHERE	cd_order_no >= '$cd_folder'
			AND		cd_order_no <= '$cd_folder_end'
	";
}
elseif( $cd_folder )
{

	$query = "
			SELECT	image_no ,
					single_order_no ,
					manufacture_code
			FROM	product_images
			WHERE	cd_order_no = '$cd_folder'
	";

}

$db->query( $query );

for( $loop=0; $loop<$db->total_record(); $loop++ )
{

	$db->fetch();
	$image_no = $db->result( 'image_no' );
	$single_order_no = $db->result( 'single_order_no' );
	$manufacture_code = $db->result( 'manufacture_code' );

	$query = "
			DELETE FROM product_single WHERE image_no = '$image_no'
	";
	$db2->query( $query );

	$query = "
					UPDATE product_images SET single_sell_status = 'Yes' WHERE image_no = '$image_no'
	";
	$db2->query( $query );

	$query = "
					INSERT INTO product_single VALUES (		NULL ,
														'$single_order_no' ,
														'$image_no' ,
														'$data_folder_no' ,
														'$manufacture_code' ,
														'$pricelist_no' ,
														'$license_code'				)
	";
	echo "<font face=verdana style='font-size:7pt'>$query</font><br>";
	$db2->query( $query );

}

?>

<br>
<table width=480 border=0 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td align=center height=50>
	<? if( FALSE == $dir_error ) : ?>
	<a href="cd2single2_step1.php?data_folder_no=<?=$data_folder_no?>&cd_order_no=<?=$cd_folder?>&cd_order_no_end=<?=$cd_folder_end?>&pricelist_no=<?=$pricelist_no?>&license_code=<?=$license_code?>" onFocus='this.blur()'>[   완료   ]</a>
	<? endif ?>
	<a href="javascript:window.history.back()" onFocus='this.blur()'>[   돌아가기   ]</a>
	</td>
</tr>
</table>

</body>
</html>