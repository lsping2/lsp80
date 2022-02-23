<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$bbs_uid 			= request( 'bbs_uid' , 'post');
$subject			= request( 'subject' );
$comment		= request( 'comment' );
$manufacture_code = request( 'manufacture_code' ,'post');

$db = new MYSQL;
$db2 = new MYSQL;

$query = "
			SELECT	manufacture_code  ,
					manufacture_name 
			FROM	product_manufacture_code 
			WHERE	use_status = 'Yes'
			AND		manufacture_code = '$manufacture_code'
		";

$db2->query( $query );

$db2->fetch();
$rs_manufacture_code	= $db2->result( 'manufacture_code' );
$rs_manufacture_name	= $db2->result( 'manufacture_name' );


$query = "
			SELECT	user_id 
			FROM	bbs_manufacture
			WHERE	bbs_uid = '$bbs_uid'
";

$db->query( $query );
$db->fetch();
$user_id		= $db->result( 'user_id' );


if ( $user_id == $s_user_id )
{


	$query = "
				UPDATE bbs_manufacture  	SET		manufacture_code	= '$rs_manufacture_code' ,
												manufacture_name	= '$rs_manufacture_name' ,
												subject			= '$subject' ,
												comment			= '$comment' 
										WHERE	bbs_uid			= $bbs_uid 
	";


$db->query( $query );



	$query = "
					SELECT	
							real_filename  ,
							tmp_filename ,
							filesize 
					FROM	bbs_manufacture
					WHERE	bbs_uid = '$bbs_uid'
	";
	$db->fetch();
	$rs_real_filename	= $db->result( 'real_filename ' );
	$rs_tmp_filename	= $db->result( 'tmp_filename' );
	$rs_filesize 		= $db->result( 'filesize ' );



	// 첨부파일 1

	 $real_filename = $_FILES['file1']['name'];
	 $filesize = $_FILES['file1']['size'];


	if( $real_filename )
	{

		@unlink( "download/{$rs_tmp_filename}" );

		$file_md5 = md5( microtime() ) . rand( 1 , 999 );

		 $query = "
					UPDATE bbs_manufacture	SET		
														real_filename = '$real_filename' ,
														tmp_filename = '$file_md5' ,
														filesize = '$filesize'
												WHERE	bbs_uid = '$bbs_uid'
		";

		$db->query( $query );
		move_uploaded_file( $_FILES['file1']['tmp_name'] , "download/" . $file_md5 );
	}

}

else 
{
	js_msg("작성자만 수정할수 있습니다.");
}

js_code( "parent.window.history.go(-2)" );

?>