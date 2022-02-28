<?


require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );



$purchase_no	=  request( 'purchase_no' , 'post' );
$title 		=  request( 'title' , 'post' );
$product_no	=  request( 'product_no' , 'post' );
$cost  		=  request( 'cost' , 'post' );
$quantity 	=  request( 'quantity' , 'post' );
$seller 		=  request( 'seller' , 'post' );
$purchase_year	= request( 'purchase_year','post' );
$purchase_month	= request( 'purchase_month','post' );
$purchase_day	= request( 'purchase_day','post' );
$etc 			=  request( 'etc' , 'post' );


$purchase_date =  $purchase_year."-".$purchase_month."-".$purchase_day. " " . date("H:i:s" , time());

$cost = str_replace("," , "", $cost);

$db = new MYSQL;



  $query = "
			UPDATE	intranet.purchase_list SET
					title		   = '$title' ,
					product_no = '$product_no' ,
					cost		   = '$cost' ,
					quantity	   = '$quantity' ,
					seller	   = '$seller' ,
					etc		   = '$etc' ,
					reg_date 	   = '$purchase_date'
			WHERE	purchase_no  = '$purchase_no'

		";
	


$db->query( $query );

js_code( "opener.window.location.reload();" );
js_code( "window.close();" );


?>