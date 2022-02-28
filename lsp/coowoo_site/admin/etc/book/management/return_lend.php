<?

require_once "../../../../include/include.php";

$book_no		= request( 'book_no' , 'get' );
$lend_no		= request( 'lend_no' , 'get' );

session_start();
$user_id = $_SESSION[ 'S_USER_ID' ];

$db = new MYSQL;

$query = "
		UPDATE intranet.book	SET		lend_status = 'No'
							WHERE	book_no = '$book_no'
";
$db->query( $query );

$query = "
		UPDATE intranet.book_lend	SET		return_date = now()
								WHERE	lend_no = '$lend_no'
								AND		user_id = '$user_id'
";
$db->query( $query );
js_back();

?>
