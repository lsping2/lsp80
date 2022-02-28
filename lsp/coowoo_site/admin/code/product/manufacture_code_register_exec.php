<?

require_once "../../../include/include.php";
html_cache_disable();

$manufacture_code = request( 'manufacture_code' , 'post' );
$manufacture_name = request( 'manufacture_name' , 'post' );
$watermark_code	= request( 'watermark_code' , 'post' );
$use_status = request( 'use_status' , 'post' );

check_length( $manufacture_code, '==', 3, '코드는 3자리로 입력하세요.' );
check_length( $manufacture_name, '<=', 100, '제작사는 100자 이하로 입력하세요.' );

$query = "
					INSERT INTO product_manufacture_code	(
															manufacture_code ,
															manufacture_name ,
															watermark_code ,
															sort ,
															use_status
														)
														VALUES
														( 
															'$manufacture_code' ,
															'$manufacture_name' ,
															'$watermark_code' ,
															0 ,
															'$use_status' 
														)
";

$db = new MYSQL();

$db->query( $query );
$db->close();

meta_go( 'manufacture_code.html' );



?>
