<?

require_once "../../../include/include.php";
require_once "../../login/login_check.php";
login_check( $PHP_SELF );

html_cache_disable();


$bbs_uid		= request( 'bbs_uid' , 'post' );
$page		= request( 'page' , 'post' );
$subject		= request( 'subject' , 'post' );
$comment	= request( 'comment' , 'post' );
$search_field	= request( 'search_field' , 'post' );
$search_key	= stripcslashes( request( 'search_key' , 'post' ) );
if( $search_key ) $location = "&search_field={$search_field}&search_key=". htmlspecialchars( $search_key ); else $location = '';


$db = new MYSQL();

$query = "
			SELECT	bbs_fid ,
					bbs_depth ,
					manufacture_code ,
					manufacture_name
			FROM	bbs_manufacture
			WHERE	bbs_uid = '$bbs_uid'
";

$db->query( $query );
$db->fetch();

$old_bbs_fid			= $db->result( 'bbs_fid' );
$old_bbs_depth		= $db->result( 'bbs_depth' );
$old_manufacture_code	= $db->result( 'manufacture_code' );
$old_manufacture_name	= $db->result( 'manufacture_name' );

 $query	="
			SELECT	max( bbs_depth ) as max_bbs_depth
			FROM	bbs_manufacture
			WHERE	bbs_fid = '$old_bbs_fid'
			AND		bbs_depth LIKE '$old_bbs_depth%'
			AND		length( bbs_depth ) = length( '$old_bbs_depth' ) + 3
";

$db->query( $query );
$db->fetch();

$max_bbs_depth = $db->result( 'max_bbs_depth' );

if( $max_bbs_depth )
{
	$new_bbs_depth = $old_bbs_depth . sprintf( "%03d" , substr( $max_bbs_depth, -3) + 1 );
}
else
{
	$new_bbs_depth = $old_bbs_depth . "001";
}

$query = "
				INSERT INTO	bbs_manufacture	
											(
												bbs_uid ,
												bbs_fid ,
												bbs_depth,
												manufacture_code ,
												manufacture_name ,
												user_id ,
												user_name ,
												subject ,
												comment ,
												reg_date  
											)
			
									VALUES	 (	
												NULL ,
												'$old_bbs_fid' ,
												'$new_bbs_depth' ,
												'$old_manufacture_code' ,
												'$old_manufacture_name' ,
												'$s_user_id' ,
												'$s_user_name' ,
												'$subject' ,
												'$comment' ,
												now() 
											)
";
$db->query( $query );
$db->close();

meta_go( "bbs.html?page={$page}{$location}" );
?>