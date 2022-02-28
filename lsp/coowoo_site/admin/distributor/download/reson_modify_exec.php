<?
require_once "../../../include/include.php";
html_cache_disable();

$download_no =  request('download_no','any');
$manufacture = request('manufacture','post');
$reason = request('reason','post');



switch( $manufacture )
{
	case 'ndisc'		:
						$title = "NDisc";
						$menu = "ndisc_menu.html";
						$table_name = 'seller_download_ndisc';
						$folder_name = 'seller_ndisc_download';
						break;
	case 'daj'			:
						$title = "DAJ";
						$menu = "daj_menu.html";
						$table_name = 'seller_download_daj';
						$folder_name = 'seller_daj_download';
						break;
	case 'mixa'		:
						$title = "MIXA";
						$menu = "mixa_menu.html";
						$table_name = 'seller_download_mixa';
						$folder_name = 'seller_mixa_download';
						break;
	case 'naturalimage'	:
						$title = "Natural Image";
						$menu = "naturalimage_menu.html";
						$table_name = 'seller_download_naturalimage';
						$folder_name = 'seller_naturalimage_download';
						break;
	case 'ion'			:
						$title = "ION";
						$menu = "ion_menu.html";
						$table_name = 'seller_download_ion';
						$folder_name = 'seller_ion_download';
						break;
}




$db = new MYSQL;



$query = "

		UPDATE seller.{$table_name} SET	
							reason='$reason'
					WHERE	download_no = '$download_no'
";




$db->query( $query );

js_code( "opener.window.location.reload();" );
js_code( "window.close();" );



?>


}