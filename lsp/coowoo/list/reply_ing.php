<?
include "include/include.php";
html_cache_disable();




$category_gid				= request( 'category_gid', 'POST' );
$category_thread			= request( 'category_thread', 'POST' );
$category_title				= request( 'category_title', 'POST' );


$search_length = strlen( $category_thread ) + 3;


$db = new MYSQL();





$query = "
				SELECT	category_thread
				FROM	cd_category
				WHERE	length( category_thread ) = $search_length
				AND		category_thread LIKE '$category_thread%'
				AND		category_gid = $category_gid
				ORDER BY category_thread DESC
	
";

//ECHO $query;exit;

$db->query( $query );
//$db->fetch();





$exist_thread = '';
if( $db->total_record() )		// 셀렉트한 값이 존재하다면
	{
		$db->fetch();	
		 $exist_thread = $db->result( 'category_thread' );
		//echo "<br>";
	         $exist_thread=$exist_thread+1;
		//echo "<br>";
		
	}

	$exist_thread = $db->result( 'category_thread' );    





if( $exist_thread AND $category_thread )
	{
			
				 $parent_thread	= substr( $exist_thread, 0, strlen( $exist_thread ) -3 );  // 첫번째 부터  뒤에서 3자리뺸수까지 앞
				//echo "<br>";
				$last_thread = substr( $exist_thread, strlen( $exist_thread ) - 3 )+1;       //  뒤에서 3자리수까지  뒤	
				//echo "<br>";
				 $new_thread = $parent_thread . sprintf( "%03d", $last_thread );		// 앞 + 뒤 ( 3자리로 만들어서)

				 //exit;
				//echo $parent_thread;
				//echo "<br>";
				//echo $last_thread ;
				//exit;
	}
else
	{
				if( $category_thread )
				    {
					$new_thread = $category_thread . "001";
				    }
			       else
				    {
					$new_thread = "001";
				    }
	}


$query2="			INSERT INTO cd_category VALUES	(NULL , 
												'$category_gid' ,
												'$new_thread' ,
												'$category_title' ,
												'' ,
												'' ,
												'' ,
												now() )
";


$db->query( $query2 );

meta_go( "list.php" );

?>
