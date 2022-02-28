<?

require_once "../../../include/include.php";

$db = new MYSQL;

$query = "
	SELECT	cd_no ,
			cd_order_no ,
			cd_sell_status ,
			cd_sell_price ,
			cd_discount_rate ,
			cd_discount_price ,
			vcd_sell_status ,
			vcd_sell_price ,
			vcd_discount_rate ,
			vcd_discount_price
	FROM		coowoo.product_cd as pc
	WHERE		use_status = 'No'
";
$db->query( $query );
$db->set();

echo $db->cd_order_no;
?>