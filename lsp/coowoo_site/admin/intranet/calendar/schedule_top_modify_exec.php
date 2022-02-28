<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$uid				= request( 'uid' );
$importance		= request( 'importance' );
$subject			= request( 'subject' );
$comment		= request( 'comment' );
$to				= request( 'to' );

if( in_array( '전체' , $to ) AND count( $to ) > 1 ) array_shift( $to );

for( $loop=0; $loop<count( $to ); $loop++ )
{
	$to_user_name .= "/" . $to[$loop];
}
$to_user_name = substr( $to_user_name , 1 );
if( !$to_user_name ) $to_user_name = '전체';


$db = new MYSQL;

$query = "
			UPDATE intranet.schedule_top	SET		to_user_name		= '$to_user_name' ,
												subject			= '$subject' ,
												comment			= '$comment' ,
												importance		= '$importance'
										WHERE	uid = $uid
";

$db->query( $query );



$query = "
				SELECT	sc.real_filename1 ,
						sc.tmp_filename1 ,
						sc.filesize1 ,
						sc.real_filename2 ,
						sc.tmp_filename2 ,
						sc.filesize2
				FROM	intranet.schedule_top
				WHERE	uid = '$uid'
";
$db->fetch();
$rs_real_filename1	= $db->result( 'real_filename1' );
$rs_tmp_filename1	= $db->result( 'tmp_filename1' );
$rs_filesize1		= $db->result( 'filesize1' );
$rs_real_filename2	= $db->result( 'real_filename2' );
$rs_tmp_filename2	= $db->result( 'tmp_filename2' );
$rs_filesize2		= $db->result( 'filesize2' );


// 첨부파일 1

$real_filename = $_FILES['file1']['name'];
$filesize = $_FILES['file1']['size'];

if( $real_filename )
{

	@unlink( "download/{$rs_tmp_filename1}" );

        $file_md5 = md5( microtime() ) . rand( 1 , 999 );

        $query = "
				UPDATE intranet.schedule_top	SET		real_filename1 = '$real_filename' ,
													tmp_filename1 = '$file_md5' ,
													filesize1 = '$filesize'
											WHERE	uid = '$uid'
        ";
        $db->query( $query );
	move_uploaded_file( $_FILES['file1']['tmp_name'] , "download/" . $file_md5 );
}

// 첨부파일 2

$real_filename = $_FILES['file2']['name'];
$filesize = $_FILES['file2']['size'];

if( $real_filename )
{
	@unlink( "download/{$rs_tmp_filename2}" );

        $file_md5 = md5( microtime() ) . rand( 1 , 999 );

        $query = "
				UPDATE intranet.schedule_top	SET		real_filename2 = '$real_filename' ,
													tmp_filename2 = '$file_md5' ,
													filesize2 = '$filesize'
											WHERE	uid = '$uid'
        ";
        $db->query( $query );
	move_uploaded_file( $_FILES['file2']['tmp_name'] , "download/" . $file_md5 );
}

js_code( "parent.window.history.go(-1)" );

?>