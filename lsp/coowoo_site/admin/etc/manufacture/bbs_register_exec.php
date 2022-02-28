<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check();

$SUserUid = request( 'S_USER_UID' , 'session' );
$SUserName = request( 'S_USER_NAME' , 'session' );

$subject 		 = request( 'subject' );
$comment	 = request( 'comment' );
$manufacture_code	 = request( 'manufacture_code' );
 $job_status	 = request( 'job_status' );


$db = new MYSQL;



 $query = "
			SELECT	manufacture_name 
			FROM	product_manufacture_code  
			WHERE	use_status = 'Yes'
			AND		manufacture_code = '$manufacture_code'
		";

$db->query( $query );


$db->fetch();
$manufacture_name		= $db->result( 'manufacture_name' );




$query = "
			SELECT	MAX( bbs_fid  ) + 1 as bbs_fid 
			FROM	 bbs_manufacture
";
$db->query( $query );
$db->fetch();
$rs_bbs_fid  = $db->result( 'bbs_fid' );

$query = "
		INSERT INTO bbs_manufacture(
										bbs_uid ,
										bbs_fid ,
										bbs_depth ,
										manufacture_code ,
										manufacture_name   ,
										user_id ,
										user_name ,
										subject ,
										comment ,
										reg_date
									)
									VALUES
									(
										NULL ,
										'$rs_bbs_fid' ,
										'001' ,
										'$manufacture_code' ,
										'$manufacture_name' ,
										'$s_user_id' ,
										'$SUserName' ,
										'$subject' ,
										'$comment' ,
										now()
									)
";


$db->query( $query );

$db->query( "SELECT LAST_INSERT_ID() as last_insert_id" );
$db->fetch();
$last_insert_id = $db->result( 'last_insert_id' );


// รทบฮฦฤภฯ 

$real_filename = $_FILES['file1']['name'];
$filesize = $_FILES['file1']['size'];

if( $real_filename )
{
        $file_md5 = md5( microtime() ) . rand( 1 , 999 );
	

        $query = "
				UPDATE bbs_manufacture	SET		real_filename = '$real_filename' ,
													tmp_filename = '$file_md5' ,
													filesize = '$filesize'
											WHERE	bbs_uid = '$last_insert_id'
        ";
        $db->query( $query );
	move_uploaded_file( $_FILES['file1']['tmp_name'] , "download/" . $file_md5 );
}



js_code( "window.history.go(-2)" );

?>