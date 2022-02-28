<?


require_once "../include/include.php";

require_once "../login/login_check.php";
login_check( $PHP_SELF );

html_cache_disable();

$table		= request( 'table' , 'post' );
$id		    = request( 'id' , 'post' );
$subject	= request( 'subject', 'post' );
$comment	= request( 'comment', 'post' );

//$upload = request( 'upload' , 'post' );
$db = new MYSQL();


 if($upload_name)//업로드파일이 있을때
        {

	

          $user_id2="files";
          if(!is_dir($user_id2)) { //아이디로 된 폴더생성 
          @mkdir('files',0777);  
          }
        copy($upload,$DOCUMENT_ROOT."/lsp/coowoo/book_bbs/files/$upload_name");	  
		 $File_name =$upload_name;
		 $File_size	=$upload_size;
        }


 $query = "
			SELECT	max( bbs_fid ) as max_bbs_fid
			FROM	{$table}
";

$db->query( $query );

$db->fetch();

$max_bbs_fid = $db->result( 'max_bbs_fid' ) + 1;

  $query = "	
			INSERT INTO {$table}	
								        	(
											 bbs_uid ,
											 bbs_fid ,
											 bbs_depth,
											 user_id ,
											 subject ,
											 comment ,
											 File_name ,
											 File_size ,
											 show_count ,
											 reg_date 

										)
										VALUES
										(	'',
											'$max_bbs_fid' ,
											'001' ,
											'$id' ,
											'$subject' ,
											'$comment' ,
											'$File_name' ,
											'$File_size' ,
											'' ,
											now() 
										)
";


$db->query( $query );
$db->close();

meta_go( "bbs_list.html?table={$table}" );

?>
