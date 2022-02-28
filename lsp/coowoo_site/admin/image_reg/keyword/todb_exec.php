<?
require_once "../../../include/include.php";

$filename = $_FILES['file1']['name'];


if( !$filename )
{
        echo "Error : Filename\n";
        js_back();
}


set_time_limit(0);

$marks = 1;

$sd = new MYSQL;
$sd2 = new MYSQL;

$db = new MYSQL;

$fp = fopen( "download/".$filename, 'r' );
if( !$fp ) exit;

while( !feof( $fp ) )
{

	$line = fgets( $fp , 4096 );
	$temp = explode( "," , $line );
	$cd_order_no = trim( $temp[0] );
	$image = trim( $temp[2] );
	$keyword = trim( $temp[4] );

	if( $image )
	{

 		$query = "
					SELECT	SQL_NO_CACHE image_no
					FROM	coowoo.product_images
					WHERE	image_name LIKE '$image%'
					AND	cd_order_no = '$cd_order_no'
		";

		$sd2->query( $query );
		$sd2->fetch();
		$image_no = $sd2->result( 'image_no' );

		$key_array = explode( " " , $keyword );

	}

	if( $image_no )
	{

	$query = "
			DELETE FROM keyindex_info WHERE image_no = '$image_no'
	";
	//$sd2->query( $query );

for( $loop=0; $loop<count( $key_array ); $loop++ )
{

echo		$key = trim( $key_array[ $loop ] );



if( eregi( "[a-zA-Z]" , $key ) ) continue;
			$query = "
					SELECT	index_no
					FROM	keyword_no
					WHERE	keyword = '$key'
			";
			$sd2->query( $query );
			if( $sd2->total_record() )
			{
				$sd2->fetch();
				$index_no = $sd2->result( 'index_no' );

				$query = "
							SELECT * FROM keyindex_info WHERE index_no = '$index_no' AND image_no = '$image_no'
				";
				$sd2->query( $query );
				// if( $sd2->total_record() ) break;

				$insert_query = "
								INSERT INTO keyindex_info VALUES( '$index_no', '$image_no', '$marks' );
				";
				//$sd2->query( $insert_query );

			}
			else
			{
				$insert_query = "
								INSERT INTO keyword_no VALUES( NULL, '$key', '' );
				";

				//$sd2->query( $insert_query );
				$sd2->query( "SELECT LAST_INSERT_ID() as last_insert_id" );
				$sd2->fetch();
				$last_insert_id = $sd2->result( 'last_insert_id' );

				$insert_query = "
								INSERT INTO keyindex_info VALUES( '$last_insert_id', '$image_no', '$marks' );
				";
				//$sd2->query( $insert_query );
			}
				

			echo $insert_query . "\n";
			echo "[$loop]";

		}

	}
	
echo "<<<" . $c++ . ">>>";

}


?>

