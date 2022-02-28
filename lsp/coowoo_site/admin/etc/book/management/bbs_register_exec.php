<?

require_once "../../../../include/include.php";

require_once "../../../login/login_check.php";
login_check( $PHP_SELF );

html_cache_disable();

$table		= request( 'table' , 'post' );
$subject	= request( 'subject', 'post' );
$comment	= request( 'comment', 'post' );

$db = new MYSQL();

 $query = "
			SELECT	max( bbs_fid ) as max_bbs_fid
			FROM	{$table}
";

$db->query( $query );

$db->fetch();

$max_bbs_fid = $db->result( 'max_bbs_fid' ) + 1;

 $query = "	
			INSERT INTO {$table}	VALUES	(	'' ,
											'$max_bbs_fid' ,
											'001' ,
											'$s_user_id' ,
											'$subject' ,
											'$comment' ,
											'' ,
											now() 
											)
";



$db->query( $query );
$db->close();

meta_go( "bbs_list.html?table={$table}" );

?>