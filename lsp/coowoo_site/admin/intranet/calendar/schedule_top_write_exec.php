<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$SUserUid = request( 'S_USER_UID' , 'session' );
$SUserName = request( 'S_USER_NAME' , 'session' );

$schedule_date = request( 'schedule_date' );
$importance = request( 'importance' );
$subject = request( 'subject' );
$comment = request( 'comment' );
$to = request( 'to' );

if( in_array( '전체' , $to ) AND count( $to ) > 1 ) array_shift( $to );

for( $loop=0; $loop<count( $to ); $loop++ )
{
	$to_user_name .= "/" . $to[$loop];
}
$to_user_name = substr( $to_user_name , 1 );
if( !$to_user_name ) $to_user_name = '전체';


$db = new MYSQL;

$query = "
			SELECT	MAX( fid ) + 1 as fid
			FROM	intranet.schedule
";
$db->query( $query );
$db->fetch();
$rs_fid = $db->result( 'fid' );

$query = "
		INSERT INTO intranet.schedule_top	 (
										uid ,
										fid ,
										to_user_name ,
										from_user_uid ,
										schedule_date ,
										subject ,
										comment ,
										importance ,
										reg_date
									)
									VALUES
									(
										NULL ,
										'$rs_fid' ,
										'$to_user_name' ,
										'$SUserUid' ,
										'$schedule_date' ,
										'$subject' ,
										'$comment' ,
										'$importance' ,
										now()
									)
";
$db->query( $query );

$db->query( "SELECT LAST_INSERT_ID() as last_insert_id" );
$db->fetch();
$last_insert_id = $db->result( 'last_insert_id' );


// 첨부파일 1

$real_filename = $_FILES['file1']['name'];
$filesize = $_FILES['file1']['size'];

if( $real_filename )
{
        $file_md5 = md5( microtime() ) . rand( 1 , 999 );

        $query = "
				UPDATE intranet.schedule_top	SET		real_filename1 = '$real_filename' ,
													tmp_filename1 = '$file_md5' ,
													filesize1 = '$filesize'
											WHERE	uid = '$last_insert_id'
        ";
        $db->query( $query );
	move_uploaded_file( $_FILES['file1']['tmp_name'] , "download/" . $file_md5 );
}

// 첨부파일 2

$real_filename = $_FILES['file2']['name'];
$filesize = $_FILES['file2']['size'];

if( $real_filename )
{
        $file_md5 = md5( microtime() ) . rand( 1 , 999 );

        $query = "
				UPDATE intranet.schedule_top	SET		real_filename2 = '$real_filename' ,
													tmp_filename2 = '$file_md5' ,
													filesize2 = '$filesize'
											WHERE	uid = '$last_insert_id'
        ";
        $db->query( $query );
	move_uploaded_file( $_FILES['file2']['tmp_name'] , "download/" . $file_md5 );
}

js_code( "window.history.go(-1)" );

?>