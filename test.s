#!/usr/local/php/bin/php
<?
$filename = $argv[1];
if( !$filename )
{
        echo "Error : Filename\n";
        exit;
}
$cd1 = $argv[2];
$cd2 = $argv[3];
if( !$cd1 )
{
        echo "Error : CdOrderNo\n";
        exit;
}
if( !$cd2 ) $cd2 = $cd1;


require_once "../../include/include.php";

$db = new MYSQL;
$db2 = new MYSQL;

$fp = fopen( $filename , "w" );

$query = "
                                SELECT  image_no ,
                                        cd_order_no ,
                                        single_order_no
                                FROM    product_images
                                WHERE   cd_order_no >= '$cd1'
                                AND     cd_order_no <= '$cd2'
                                ORDER BY single_order_no ASC

";
$db->query( $query );

?>

<? for( $loop=0; $loop<$db->total_record(); $loop++ ) : ?>
<?

    $db->fetch();
    $rs_image_no 		= $db->result( 'image_no' );
    $rs_cd_order_no 	= $db->result( 'cd_order_no' );   
 $rs_single_order_no 	= $db->result( 'single_order_no' );

$query2 = "
                                SELECT  folder_no ,
                                        size_width ,
                                        size_height
                                FROM    product_single_download
                                WHERE   image_no = '$rs_image_no'
                                ORDER BY folder_no DESC
                                LIMIT   1
";
$db2->query( $query );

$db2->fetch();

$src_folder_no          = $db2->result( 'folder_no' );
$src_size_width         = $db2->result( 'size_width' );
$src_size_height        = $db2->result( 'size_height' );
?>
<? endfor ?>

<?      
   
   echo $string = "$rs_image_no,$rs_cd_order_no,$rs_single_order_no" . "\n";
        fputs( $fp, $string );
     

?>


