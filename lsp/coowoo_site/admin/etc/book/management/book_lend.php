<?

require_once "../../../../include/include.php";

$book_no = request( 'book_no' , 'get' );

session_start();
$user_id = $_SESSION[ 'S_USER_ID' ];

$db = new MYSQL;

$query = "
		UPDATE intranet.book	SET		lend_status = 'Yes'
							WHERE	book_no = '$book_no'
";
$db->query( $query );

$query = "
		INSERT INTO intranet.book_lend	SET	lend_no = NULL ,
										book_no = '$book_no' ,
										user_id = '$user_id' ,
										lend_date = now()
";
$db->query( $query );
js_back();

?>
