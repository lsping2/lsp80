<?

function keyword_analysis( $search_keyword )
{

	global $basic_keyword;
	global $except_keyword;
	global $keyword_status;
	global $cache_filename;	

	$search_keyword  = trim( $search_keyword );
	$except_keyword = '';

	while( ereg( "\&", $search_keyword ) ) $search_keyword = ereg_replace( "\&", " ", $search_keyword );
	while( ereg( "[[:space:]][[:space:]]", $search_keyword ) ) $search_keyword = ereg_replace( "[[:space:]][[:space:]]", " ", $search_keyword );

	while( ereg( "[[:space:]]\+", $search_keyword ) ) $search_keyword = ereg_replace( "[[:space:]]\+", "+", $search_keyword );
	while( ereg( "\+[[:space:]]", $search_keyword ) ) $search_keyword = ereg_replace( "\+[[:space:]]", "+", $search_keyword );

	while( ereg( "[[:space:]]\-", $search_keyword ) )	$search_keyword = ereg_replace( "[[:space:]]\-", "-", $search_keyword );
	while( ereg( "\-[[:space:]]", $search_keyword ) )	$search_keyword = ereg_replace( "\-[[:space:]]", "-", $search_keyword );


	if( ereg( "-", $search_keyword ) )
	{
		$except_keyword = substr( $search_keyword, strpos( $search_keyword, "-" ) );
		$search_keyword = substr( $search_keyword, 0, strpos( $search_keyword, "-" ) );

		while( ereg( "-", $except_keyword ) )
		{
			$except_keyword = ereg_replace( "-", "", $except_keyword );
		}
	}

	// ?
	$keyword_status = 'BASIC';

	if( ereg( "\+" , $search_keyword ) )
	{
		$or_status = 'Yes';
		$keyword_status = 'OR';
	}
	if( ereg( "[[:space:]]" , $search_keyword ) )
	{
		$and_status = 'Yes';
		$keyword_status = 'AND';
	}

	if( 'Yes' == $or_status AND 'Yes' == $and_status )
	{
		$keyword_check = 'MIX';
		$keyword_status = 'AND';

		$tmp = explode( " " , $search_keyword );

		$search_keyword = '';
		for( $loop=0; $loop<count( $tmp ); $loop++ )
		{
			if( !ereg( "\+" , $tmp[$loop] ) ) $search_keyword .= " " . $tmp[$loop];
		}

	}
	else
	{
		$keyword_check = 'OK';
	}

	$basic_keyword = trim( $search_keyword );
	$except_keyword = trim( $except_keyword );	

} // end of function

function single_manufacutre_search( $manufacture_code , $refresh = FALSE )
{

	$db = new MYSQL;

	$main_query = "
							SELECT	image_no
							FROM	product_images
							WHERE	manufacture_code = '$manufacture_code'
							AND		NOT ( cd_order_no LIKE 'NDF%')
							AND		NOT ( cd_order_no LIKE 'NDY%')
							AND		NOT ( cd_order_no LIKE 'DAJES%')
							ORDER BY single_order_no DESC
	";
	$db->query( $main_query );

	$filename = "single_manufacture_{$manufacture_code}";

	$SINGLE_CACHE_DIR = "/home/coowoo/www/CACHE_FILE/SINGLE";

	$result_filename = md5( microtime() );

	if( is_file( "{$SINGLE_CACHE_DIR}/{$filename}" ) AND $refresh == FALSE )
	{
		copy( "{$SINGLE_CACHE_DIR}/{$filename}" , "/tmp/{$result_filename}" );
	}
	else
	{
		$fp = fopen( "{$SINGLE_CACHE_DIR}/{$filename}", "w" );

		for( $loop=0; $loop<$db->total_record(); $loop++ )
		{
			$db->fetch();
			$image_no = $db->result( 'image_no' );
			$image_no = sprintf( "%10s", $image_no );
			fputs( $fp, $image_no );
		}
		fclose( $fp );

		copy( "{$SINGLE_CACHE_DIR}/{$filename}" , "/tmp/{$result_filename}" );
	}

	return $result_filename;

}

function single_search( $search_keyword , $manufacture_code = '' , $image_class = '' , $image_shape = '' , $refresh = FALSE )
{

	global $basic_keyword;
	global $except_keyword;
	global $keyword_status;
	
	$cache_lifetime = 3600 * 24 * 15;

	$db = new MYSQL;
	$db2 = new MYSQL;

	keyword_analysis( $search_keyword );

	$filename = urlencode( $basic_keyword ) . "_" . urlencode( $except_keyword );

	if( $manufacture_code )
	{
		if( is_array( $manufacture_code ) )
		{

			if( count( $manufacture_code ) > 1 )
			{
				
				sort( $manufacture_code );
				$filename .= "_" . implode( "-" , $manufacture_code );
				for( $loop=0; $loop<count( $manufacture_code ); $loop++ )
				{
					if( $manufacture_code[$loop] ) $manufacture_query .= " OR pi.manufacture_code = '$manufacture_code[$loop]'";

				}
				 $manufacture_query = " AND ( " . substr( $manufacture_query , 4 ) . " )";
			}
			else
			{
				$filename .= "_" . $manufacture_code[0];
				if( $manufacture_code[0] ) $manufacture_query = "	 AND pi.manufacture_code = '$manufacture_code[0]'";
			}

		}
		else
		{
				$filename .= "_" . $manufacture_code;
				$manufacture_query = "	 AND pi.manufacture_code = '$manufacture_code'";
		}

	}

	$search_query .= $manufacture_query;

	if( $image_class )
	{
		if( is_array( $image_class ) )
		{
			if( count( $image_class ) > 1 )
			{

				sort( $image_class );
				$filename .= "_" . implode( "-" , $image_class );

				for( $loop=0; $loop<count( $image_class ); $loop++ )
				{
					if( $image_class[$loop] ) 	$image_class_query .= " OR image_class = '$image_class[$loop]'";
				}
				 $image_class_query = " AND ( " . substr( $image_class_query , 4 ) . " )";
				 
			}
			else
			{
				$filename .= "_" . $image_class[0];
				if( $image_class[0] ) $image_class_query = "	 AND image_class = '$image_class[0]'";
			}
		}
		else
		{
				$filename .= "_" . $image_class;
				$image_class_query = "	 AND image_shape = '$image_class'";
		}
	}

	$search_query .= $image_class_query;

	if( $image_shape )
	{
		if( is_array( $image_shape ) )
		{
			if( count( $image_shape ) > 1 )
			{
				sort( $image_shape );
				$filename .= "_" . implode( "-" , $image_shape );

				for( $loop=0; $loop<count( $image_shape ); $loop++ )
				{
					if( $image_shape[$loop] ) $image_shape_query .= " OR image_shape = '$image_shape[$loop]'";
				}
				$image_shape_query = " AND ( " . substr( $image_shape_query , 4 ) . " )";
			}
			else
			{
				$filename .= "_" . $image_shape[0];
				if( $image_shape[0] ) $image_shape_query = "	 AND image_shape = '$image_shape[0]'";
			}

		}
		else
		{
				$filename .= "_" . $image_shape;
				$image_shape_query = "	 AND image_shape = '$image_shape'";
		}
	}

	$search_query .= $image_shape_query;


	$SINGLE_CACHE_DIR = "/home/coowoo/www/CACHE_FILE/SINGLE";

	$result_filename = md5( microtime() );
	if(			is_file( "{$SINGLE_CACHE_DIR}/{$filename}" ) 
		AND		$refresh == FALSE
		AND		time() - $cache_lifetime < filectime( "{$SINGLE_CACHE_DIR}/{$filename}" )
	)
	{
		copy( "{$SINGLE_CACHE_DIR}/{$filename}" , "/tmp/{$result_filename}" );
		return $result_filename;
		exit;
	}


	if( 'AND' == $keyword_status )
	{

			$keyword_array = explode( " ", $basic_keyword );

			for( $count=0; $count < count($keyword_array); $count++ )
			{
				$keyword_array[$count] = trim( $keyword_array[$count] );

				$com1_count = $count + 1;
				$com2_count = $count + 2;

				$group_keyword = $keyword_array[$count];

				// 키워드 그룹 확인
				$change_query = "
											SELECT	change_keyword
											FROM	keyword_change
											WHERE	keyword = '" . $keyword_array[$count] . "'
				";
				$db->query( $change_query );
				$db->fetch();
				$rs_change_keyword = $db->result( 'change_keyword' );

				if( $rs_change_keyword )
				{

					$change_query = "
												SELECT keyword
												FROM	keyword_change
												WHERE	change_keyword = '$rs_change_keyword'
					";
					$db->query( $change_query );
					for( $loop2=0; $loop2<$db->total_record(); $loop2++ )
					{
						$db->fetch();
						$rs_keyword = $db->result( 'keyword' );
						$group_keyword .= " " . $rs_keyword;
					}
		
				}


				// 키워드 그룹 확인
				$change_query = "
											SELECT	keyword
											FROM	keyword_group
											WHERE	group_keyword = '" . $keyword_array[$count] . "'
				";
				$db->query( $change_query );

				// 키워드 그룹이 있으면
				if( $db->total_record() )
				{		

					for( $loop=0; $loop<$db->total_record(); $loop++ )
					{
						$db->fetch();
						$group_keyword .= " " . $db->result( 'keyword' );
					}

				} 

				if( $group_keyword )
				{

					$keyword_group_array = explode( " ", trim( $group_keyword ) );

					$union_query = '';
					for( $count2=0; $count2<count( $keyword_group_array ); $count2++ )
					{
						$group1_count = $count2 + 1;
						$group2_count = $count2 + 2;

						$temporary_query = "
														CREATE TEMPORARY TABLE temp_group_result_{$count}{$group1_count } ( INDEX( image_no ) ) TYPE=HEAP
														SELECT	 SQL_CACHE
																ki.image_no, ki.marks
														FROM	keyindex_info as ki, keyword_no as kn
														WHERE	ki.index_no = kn.index_no
														AND		kn.keyword = '" . $keyword_group_array[$count2] . "'
						";
						$db->query( $temporary_query );

						// echo "<font face=tahoma style='font-size:7pt'>$temporary_query</font><br>";

						if( $count2 < count($keyword_group_array) )
						{
							$union_query .= " UNION SELECT * FROM temp_group_result_{$count}{$group1_count }";           
						}
						$db2->query( "SELECT * FROM temp_group_result_{$count}{$group1_count}" );
						// echo $db2->total_record() . "<br>";
					}

					$union_query = substr( $union_query, 6 );

					$temporary_query = "CREATE TEMPORARY TABLE temp_result_union_{$count} ( INDEX( image_no ) ) TYPE=HEAP $union_query";
					$db->query( $temporary_query );
					// echo "<font style='font-size:9pt'>$temporary_query</font><br>";

					$temporary_query = "
													CREATE TEMPORARY TABLE temp_result_{$com1_count} ( INDEX( image_no ) ) TYPE=HEAP
													SELECT	SQL_CACHE
																pi.image_no ,
																marks as marks
													FROM    product_images as pi ,  
																temp_result_union_{$count} as tru
													WHERE	pi.image_no = tru.image_no
													$search_query
					";
					$db->query( $temporary_query );				

				}
				else
				{

					$temporary_query = "
													CREATE TEMPORARY TABLE temp_result_{$com1_count} ( INDEX( image_no ) ) TYPE=HEAP
													SELECT	SQL_CACHE
																ki.image_no, ki.marks
													FROM	keyindex_info as ki, keyword_no as kn
													WHERE	ki.index_no = kn.index_no
													AND		kn.keyword = '" . $keyword_array[$count] . "'
					";
					$db->query( $temporary_query );

				}
				// echo "<font face=tahoma style='font-size:8pt'>$temporary_query</font><br>";

				if( $count < count($keyword_array) -1 )
				{
					$where_query .= " AND temp_result_{$com1_count}.image_no = temp_result_{$com2_count}.image_no";         
				}
				$from_query .= ", temp_result_{$com1_count}";
				$marks_query .= "+ temp_result_{$com1_count}.marks ";


			}

			$where_query    = substr( $where_query, 4 );
			$from_query     = substr( $from_query, 2 );
			$marks_query    = ", " . substr( $marks_query, 2 ) . "as sum_marks";

			$result_query = " 
									CREATE TEMPORARY TABLE temp_result_end ( INDEX( image_no ) ) TYPE=HEAP
									SELECT	SQL_CACHE
											DISTINCT pi.image_no ,
												cd_order_no ,
												single_order_no ,
												data_folder_no ,
												image_name ,
												image_class
												$marks_query
									FROM    product_images as pi , $from_query
									WHERE	pi.image_no = temp_result_1.image_no
									AND     $where_query
									$search_query
									ORDER BY sum_marks ASC, pi.image_class ASC, RAND()
							
			";
			$db->query( $result_query );

			$total_query = "
									SELECT	
												count(*)
									FROM    product_images as pi , $from_query
									WHERE   pi.image_no = temp_result_1.image_no
									AND     $where_query
									$search_query
			";		


	} // end if ( 'AND' == keyword_status )


	if( 'OR' == $keyword_status )
	{


			$keyword_array = explode( "+", $basic_keyword );

			for( $count=0; $count < count($keyword_array); $count++ )
			{
				$keyword_array[$count] = trim( $keyword_array[$count] );

				$com1_count = $count + 1;
				$com2_count = $count + 2;

				$group_keyword = '';

			// 키워드 그룹 확인
				$change_query = "
											SELECT	change_keyword
											FROM	keyword_change
											WHERE	keyword = '" . $keyword_array[$count] . "'
				";
				$db->query( $change_query );
				$db->fetch();
				$rs_change_keyword = $db->result( 'change_keyword' );

				if( $rs_change_keyword )
				{

					$change_query = "
												SELECT keyword
												FROM	keyword_change
												WHERE	change_keyword = '$rs_change_keyword'
					";
					$db->query( $change_query );
					for( $loop2=0; $loop2<$db->total_record(); $loop2++ )
					{
						$db->fetch();
						$rs_keyword = $db->result( 'keyword' );
						$group_keyword .= " " . $rs_keyword;
					}
		
				}


				// 키워드 그룹 확인
				$change_query = "
											SELECT	keyword
											FROM	keyword_group
											WHERE	group_keyword = '" . $keyword_array[$count] . "'
				";
				$db->query( $change_query );

				// 키워드 그룹이 있으면
				if( $db->total_record() )
				{		

					for( $loop=0; $loop<$db->total_record(); $loop++ )
					{
						$db->fetch();
						$group_keyword .= " " . $db->result( 'keyword' );
					}

				} 

				if( $group_keyword )
				{

					$keyword_group_array = explode( " ", trim( $group_keyword ) );

					$union_query = '';
					for( $count2=0; $count2<count( $keyword_group_array ); $count2++ )
					{
						$group1_count = $count2 + 1;
						$group2_count = $count2 + 2;

						$temporary_query = "
														CREATE TEMPORARY TABLE temp_group_result_{$count}{$group1_count } ( INDEX( image_no ) ) TYPE=HEAP
														SELECT	 SQL_CACHE
																ki.image_no, ki.marks
														FROM	keyindex_info as ki, keyword_no as kn
														WHERE	ki.index_no = kn.index_no
														AND		kn.keyword = '" . $keyword_group_array[$count2] . "'
						";
						$db->query( $temporary_query );

						// echo "<font face=tahoma style='font-size:7pt'>$temporary_query</font><br>";

						if( $count2 < count($keyword_group_array) )
						{
							$union_query .= " UNION SELECT * FROM temp_group_result_{$count}{$group1_count }";           
						}
						$db2->query( "SELECT * FROM temp_group_result_{$count}{$group1_count}" );
						// echo $db2->total_record() . "<br>";
					}

					$union_query = substr( $union_query, 6 );

					$temporary_query = "CREATE TEMPORARY TABLE temp_result_union_{$count} ( INDEX( image_no ) ) TYPE=HEAP $union_query";
					$db->query( $temporary_query );
					// echo "<font style='font-size:9pt'>$temporary_query</font><br>";

					$temporary_query = "
													CREATE TEMPORARY TABLE temp_result_{$com1_count} ( INDEX( image_no ) ) TYPE=HEAP
													SELECT	SQL_CACHE
																pi.image_no ,
																marks as marks
													FROM    product_images as pi ,  
																temp_result_union as tru
													WHERE	pi.image_no = tru.image_no
													$search_query
					";
					$db->query( $temporary_query );				

				}
				else
				{

					$temporary_query = "
													CREATE TEMPORARY TABLE temp_result_{$com1_count} ( INDEX( image_no ) ) TYPE=HEAP
													SELECT	SQL_CACHE
																ki.image_no, ki.marks
													FROM	keyindex_info as ki, keyword_no as kn
													WHERE	ki.index_no = kn.index_no
													AND		kn.keyword = '" . $keyword_array[$count] . "'
					";
					$db->query( $temporary_query );

				}
				// echo "<font face=tahoma style='font-size:8pt'>$temporary_query</font><br>";

				 $result_union_query .= " UNION SELECT * FROM temp_result_{$com1_count }";         
				// echo "<font face=tahoma style='font-size:8pt'>$result_union_query</font><br>";

			}
			
			$result_union_query = substr( $result_union_query, 6 );
			$temporary_query = "CREATE TEMPORARY TABLE temp_result_union_end ( INDEX( image_no ) ) TYPE=HEAP $result_union_query";
			$db->query( $temporary_query );

			 $result_query = " 
									CREATE TEMPORARY TABLE temp_result_end ( INDEX( image_no ) ) TYPE=HEAP
									SELECT	SQL_CACHE
												DISTINCT pi.image_no ,
												cd_order_no ,
												single_order_no ,
												data_folder_no ,
												image_name ,
												image_class ,
												tru.marks as sum_marks
									FROM    product_images as pi , temp_result_union_end as tru
									WHERE	pi.image_no = tru.image_no
										$search_query
									ORDER BY sum_marks ASC, pi.image_class ASC, RAND()
							
				";
				$db->query( $result_query );

	} // end if ( 'OR' == $keyword_status )


	if( 'BASIC' == $keyword_status )
	{

		// 키워드 그룹 확인
		$group_query = "
									SELECT	SQL_CACHE
											change_keyword
									FROM	keyword_change
									WHERE	change_keyword = '$basic_keyword'
									OR		keyword = '$basic_keyword'
		";
		$db->query( $group_query );
		$db->fetch();
		$change_keyword = $db->result( 'change_keyword' );

		// 키워드 그룹이 있으면
		if( $change_keyword )
		{
			$change_query = "
										SELECT	SQL_CACHE
												keyword
										FROM	keyword_change
										WHERE	change_keyword = '$change_keyword'
			";
			$db->query( $change_query );

			for( $loop=0; $loop<$db->total_record(); $loop++ )
			{
				$db->fetch();
				$change_keyword .= " " . $db->result( 'keyword' );
			}

			$keyword_group_array = explode( " ", trim( $change_keyword ) );

			$union_query = '';
			for( $count2=0; $count2<count( $keyword_group_array ); $count2++ )
			{
				$group1_count = $count2 + 1;
				$group2_count = $count2 + 2;

				$temporary_query = "
							CREATE TEMPORARY TABLE temp_group_result_{$group1_count } ( INDEX( image_no ) ) TYPE=HEAP
							SELECT	SQL_CACHE
										ki.image_no, ki.marks
							FROM    keyindex_info as ki, keyword_no as kn
							WHERE	ki.index_no = kn.index_no
							AND		kn.keyword = '" . $keyword_group_array[$count2] . "'
				";
				$db->query( $temporary_query );

				// echo "<font face=tahoma style='font-size:8pt'>$temporary_query</font><br>";

				if( $count2 < count($keyword_group_array) )
				{
					$union_query .= " UNION SELECT * FROM temp_group_result_{$group1_count }";           
				}
				$db2->query( "SELECT * FROM temp_group_result_{$group1_count}" );
				$db2->total_record();
			}

			$union_query = substr( $union_query, 6 );

			$temporary_query = "CREATE TEMPORARY TABLE temp_result_union ( INDEX( image_no ) ) TYPE=HEAP $union_query";
			$db->query( $temporary_query );
			// echo "<font style='font-size:9pt'>$temporary_query</font><br>";

			$temporary_query = "
								CREATE TEMPORARY TABLE temp_result_end ( INDEX( image_no ) ) TYPE=HEAP
								SELECT	SQL_CACHE
											DISTINCT pi.image_no ,
											pi.cd_order_no ,
											pi.single_order_no ,
											pi.data_folder_no ,
											pi.image_name ,
											pi.image_class ,
											marks as sum_marks
								FROM    product_images as pi ,  
											temp_result_union as tru
								WHERE	pi.image_no = tru.image_no
								AND		NOT ( pi.cd_order_no LIKE 'NDY%')
								$search_query
								ORDER BY sum_marks ASC, pi.image_class ASC, RAND()
			";
			$db->query( $temporary_query );	
			
		}
		else
		{
			$result_query = "
							CREATE TEMPORARY TABLE temp_result_end ( INDEX( image_no ) ) TYPE=HEAP
							SELECT	SQL_CACHE
									DISTINCT pi.image_no ,
									cd_order_no ,
									single_order_no ,
									data_folder_no ,
									image_name ,
									pi.image_class ,
									ki.marks as sum_marks
							FROM	product_images as pi ,
									keyindex_info as ki ,
									keyword_no as kn
							WHERE	pi.image_no = ki.image_no
							AND		ki.index_no = kn.index_no
							AND		kn.keyword = '$basic_keyword'
							AND		NOT ( cd_order_no LIKE 'NDY%')
							$search_query
							ORDER BY sum_marks ASC, pi.image_class ASC, RAND()
			";
			$db->query( $result_query );

			// echo "<font style='font-family:tahoma;font-size:9pt'>$result_query</font>";
		}

	} // end if


	// 제외할 키워드
	if( $except_keyword )
	{

		$except_keyword_array_temp = split( " " , $except_keyword );

		if( count( $except_keyword_array_temp ) > 1 )
		{
			for( $loop=0; $loop<count( $except_keyword_array_temp ); $loop++ )
			{
				$except_keyword_array[] = $except_keyword_array_temp[$loop];
			}
		}
		else
		{
			$except_keyword_array[] = $except_keyword_array_temp[0];
		}

		if( count( $except_keyword_array ) > 1 )
		{
			// 제외할 키워드가 여러개 이면 결과에서 각 키워드 제외
			for( $count=0; $count < count($except_keyword_array); $count++ )
			{
			   $temporary_query = "
								CREATE TEMPORARY TABLE temp_result_except_{$count} ( INDEX( image_no ) ) TYPE=HEAP
								SELECT	SQL_CACHE
											ki.image_no, ki.marks
								FROM	keyindex_info as ki, keyword_no as kn
								WHERE	ki.index_no = kn.index_no
								AND		kn.keyword = '" . $except_keyword_array[$count] . "'
				";
				$db->query( $temporary_query );
				// echo "<font style='font-size:9pt'>$temporary_query</font><br>";

				$delete_query = "
								DELETE	tre
								FROM	temp_result_end as tre ,
										temp_result_except_{$count} as ext
								WHERE	tre.image_no = ext.image_no
				";
				$db->query( $delete_query );
				// echo "<font style='font-size:9pt'>$delete_query</font><br>";
			}
		}
		else
		{

				$temporary_query = "
								CREATE TEMPORARY TABLE temp_result_except ( INDEX( image_no ) ) TYPE=HEAP
								SELECT	SQL_CACHE
											ki.image_no, ki.marks
								FROM	keyindex_info as ki, keyword_no as kn
								WHERE	ki.index_no = kn.index_no
								AND		kn.keyword = '" . $except_keyword . "'
				";
				$db->query( $temporary_query );
				// echo "<font style='font-size:9pt'>$temporary_query</font><br>";

				$query = "
						SELECT	image_no
						FROM	temp_result_except
				";
				$db->query( $query );

				for( $loop=0; $loop<$db->total_record(); $loop++ )
				{
					$db->fetch();
					$image_no = $db->result( 'image_no' );

					$delete_query = "DELETE FROM temp_result_end WHERE image_no = '$image_no'";
					$db2->query( $delete_query );
				}

				
/* Mysql 4.1 higher
				$delete_query = "
								DELETE	tre
								FROM	temp_result_end as tre ,
											temp_result_except as ext
								WHERE	tre.image_no = ext.image_no
				";
				// echo "<font style='font-size:9pt'>$delete_query</font><br>";
				$db->query( $delete_query );
*/
		}

	}

	// 이미지 주문번호
	$query = "
			INSERT INTO temp_result_end  (	image_no ,
										cd_order_no ,
										single_order_no ,
										data_folder_no ,
										image_name ,
										image_class
									)
				
			SELECT	pi.image_no ,
						cd_order_no ,
						single_order_no ,
						data_folder_no ,
						image_name ,
						pi.image_class
			FROM    product_images as pi
			WHERE single_order_no LIKE '$basic_keyword%'	
				$search_query
			AND		NOT ( cd_order_no LIKE 'NDY%')
	";
	$db->query( $query );

	$main_query = "
							SELECT	image_no ,
										cd_order_no ,
										single_order_no ,
										data_folder_no ,
										image_name ,
										sum_marks
							FROM    temp_result_end
	";
	$db->query( $main_query );


	$fp = fopen( "{$SINGLE_CACHE_DIR}/{$filename}", "w" );

	for( $loop=0; $loop<$db->total_record(); $loop++ )
	{
		$db->fetch();
		$image_no = $db->result( 'image_no' );
		$image_no = sprintf( "%10s", $image_no );
		fputs( $fp, $image_no );
	}
	fclose( $fp );

	copy( "{$SINGLE_CACHE_DIR}/{$filename}" , "/tmp/{$result_filename}" );

	return $result_filename;
}

function cd_product_class( $product_class , $refresh = FALSE )
{

	$cd_db = new MYSQL;

	if( 'cd' == $product_class )
	{
		$class_query = " AND cd_sell_status = 'Yes'";
	}
	elseif( 'vcd' == $product_class )
	{
		$class_query = " AND vcd_sell_status = 'Yes'";
	}

	$main_query = "
							SELECT	cd_no
							FROM	product_cd
							WHERE	1
							$class_query
							AND		NOT ( cd_order_no LIKE 'NDF%')
							AND		NOT ( cd_order_no LIKE 'NDY%')
							AND		NOT ( cd_order_no LIKE 'DAJES%')
							AND		use_status = 'Yes'
							ORDER BY cd_order_no DESC

	";
	$cd_db->query( $main_query );

	$filename = "cd_class_{$product_class}";

	$CD_CACHE_DIR = "/home/coowoo/www/CACHE_FILE/CD";

	$result_filename = md5( microtime() );

	if( is_file( "{$CD_CACHE_DIR}/{$filename}" ) AND $refresh == FALSE )
	{
		copy( "{$CD_CACHE_DIR}/{$filename}" , "/tmp/{$result_filename}" );
	}
	else
	{
		$fp = fopen( "{$CD_CACHE_DIR}/{$filename}", "w" );
		for( $loop=0; $loop<$cd_db->total_record(); $loop++ )
		{
			$cd_db->fetch();
			$cd_no = $cd_db->result( 'cd_no' );

			$cd_no = sprintf( "%10s", $cd_no );
			$keyword_count = sprintf( "%5s", '' );

			fputs( $fp, $cd_no . $keyword_count  );
		}
		fclose( $fp );

		copy( "{$CD_CACHE_DIR}/{$filename}" , "/tmp/{$result_filename}" );
	}

	return $result_filename;

}

function cd_manufacture_search( $manufacture_code , $refresh = FALSE )
{

	$cd_db = new MYSQL;

	$main_query = "
							SELECT	cd_no
							FROM	product_cd
							WHERE	manufacture_code = '$manufacture_code'
							AND		NOT ( cd_order_no LIKE 'NDF%')
							AND		NOT ( cd_order_no LIKE 'NDY%')
							AND		NOT ( cd_order_no LIKE 'DAJES%')
							AND		use_status = 'Yes'
							ORDER BY cd_order_no DESC

	";
	$cd_db->query( $main_query );

	$filename = "cd_manufacture_{$manufacture_code}";

	$CD_CACHE_DIR = "/home/coowoo/www/CACHE_FILE/CD";

	$result_filename = md5( microtime() );

	if( is_file( "{$CD_CACHE_DIR}/{$filename}" ) AND $refresh == FALSE )
	{
		copy( "{$CD_CACHE_DIR}/{$filename}" , "/tmp/{$result_filename}" );
	}
	else
	{
		$fp = fopen( "{$CD_CACHE_DIR}/{$filename}", "w" );
		for( $loop=0; $loop<$cd_db->total_record(); $loop++ )
		{
			$cd_db->fetch();
			$cd_no = $cd_db->result( 'cd_no' );

			$cd_no = sprintf( "%10s", $cd_no );
			$keyword_count = sprintf( "%5s", '' );

			fputs( $fp, $cd_no . $keyword_count  );
		}
		fclose( $fp );

		copy( "{$CD_CACHE_DIR}/{$filename}" , "/tmp/{$result_filename}" );
	}

	return $result_filename;

}

function cd_search( $search_keyword , $manufacture_code = '' , $image_class = '' , $image_shape = '' , $refresh = FALSE )
{

	global $basic_keyword;
	global $except_keyword;
	global $keyword_status;	
	
	$cd_db = new MYSQL;
	$cd_db2 = new MYSQL;

	keyword_analysis( $search_keyword );

	$filename = urlencode( $basic_keyword ) . "_" . urlencode( $except_keyword );

	if( $manufacture_code )
	{
		if( is_array( $manufacture_code ) )
		{

			if( count( $manufacture_code ) > 1 )
			{
				
				sort( $manufacture_code );
				$filename .= "_" . implode( "-" , $manufacture_code );
				for( $loop=0; $loop<count( $manufacture_code ); $loop++ )
				{
					if( $manufacture_code[$loop] ) $manufacture_query .= " OR pi.manufacture_code = '$manufacture_code[$loop]'";

				}
				 $manufacture_query = " AND ( " . substr( $manufacture_query , 4 ) . " )";
			}
			else
			{
				$filename .= "_" . $manufacture_code[0];
				if( $manufacture_code[0] ) $manufacture_query = "	 AND pi.manufacture_code = '$manufacture_code[0]'";
			}

		}
		else
		{
				$filename .= "_" . $manufacture_code;
				$manufacture_query = "	 AND pi.manufacture_code = '$manufacture_code'";
		}

	}

	$search_query .= $manufacture_query;

	if( $image_class )
	{
		if( is_array( $image_class ) )
		{
			if( count( $image_class ) > 1 )
			{

				sort( $image_class );
				$filename .= "_" . implode( "-" , $image_class );

				for( $loop=0; $loop<count( $image_class ); $loop++ )
				{
					if( $image_class[$loop] ) 	$image_class_query .= " OR image_class = '$image_class[$loop]'";
				}
				 $image_class_query = " AND ( " . substr( $image_class_query , 4 ) . " )";
				 
			}
			else
			{
				$filename .= "_" . $image_class[0];
				if( $image_class[0] ) $image_class_query = "	 AND image_class = '$image_class[0]'";
			}
		}
		else
		{
				$filename .= "_" . $image_class;
				$image_class_query = "	 AND image_shape = '$image_class'";
		}
	}

	$search_query .= $image_class_query;

	if( $image_shape )
	{
		if( is_array( $image_shape ) )
		{
			if( count( $image_shape ) > 1 )
			{
				sort( $image_shape );
				$filename .= "_" . implode( "-" , $image_shape );

				for( $loop=0; $loop<count( $image_shape ); $loop++ )
				{
					if( $image_shape[$loop] ) $image_shape_query .= " OR image_shape = '$image_shape[$loop]'";
				}
				$image_shape_query = " AND ( " . substr( $image_shape_query , 4 ) . " )";
			}
			else
			{
				$filename .= "_" . $image_shape[0];
				if( $image_shape[0] ) $image_shape_query = "	 AND image_shape = '$image_shape[0]'";
			}

		}
		else
		{
				$filename .= "_" . $image_shape;
				$image_shape_query = "	 AND image_shape = '$image_shape'";
		}
	}

	$search_query .= $image_shape_query;


	$CD_CACHE_DIR = "/home/coowoo/www/CACHE_FILE/CD";

	$result_filename = md5( microtime() );

	if( is_file( "{$CD_CACHE_DIR}/{$filename}" ) AND $refresh == FALSE )
	{
		copy( "{$CD_CACHE_DIR}/{$filename}" , "/tmp/{$result_filename}" );
		return $result_filename;
	}



	if( 'AND' == $keyword_status )
	{

			$keyword_array = explode( " ", $basic_keyword );

			for( $count=0; $count < count($keyword_array); $count++ )
			{
				$keyword_array[$count] = trim( $keyword_array[$count] );

				$com1_count = $count + 1;
				$com2_count = $count + 2;

				$group_keyword = $keyword_array[$count];

				// 키워드 그룹 확인
				$change_query = "
											SELECT	change_keyword
											FROM	keyword_change
											WHERE	keyword = '" . $keyword_array[$count] . "'
				";
				$cd_db->query( $change_query );
				$cd_db->fetch();
				$rs_change_keyword = $cd_db->result( 'change_keyword' );

				if( $rs_change_keyword )
				{

					$change_query = "
												SELECT keyword
												FROM	keyword_change
												WHERE	change_keyword = '$rs_change_keyword'
					";
					$cd_db->query( $change_query );
					for( $loop2=0; $loop2<$cd_db->total_record(); $loop2++ )
					{
						$cd_db->fetch();
						$rs_keyword = $cd_db->result( 'keyword' );
						$group_keyword .= " " . $rs_keyword;
					}
		
				}

				// 키워드 그룹 확인
				$change_query = "
											SELECT	keyword
											FROM	keyword_group
											WHERE	group_keyword = '" . $keyword_array[$count] . "'
				";
				$cd_db->query( $change_query );

				// 키워드 그룹이 있으면
				if( $cd_db->total_record() )
				{		

					for( $loop=0; $loop<$cd_db->total_record(); $loop++ )
					{
						$cd_db->fetch();
						$group_keyword .= " " . $cd_db->result( 'keyword' );
					}

				} 

				if( $group_keyword )
				{

					$keyword_group_array = explode( " ", trim( $group_keyword ) );

					$union_query = '';
					for( $count2=0; $count2<count( $keyword_group_array ); $count2++ )
					{
						$group1_count = $count2 + 1;
						$group2_count = $count2 + 2;

						$temporary_query = "
														CREATE TEMPORARY TABLE temp_group_result_{$count}{$group1_count } ( INDEX( image_no ) ) TYPE=HEAP
														SELECT	 SQL_CACHE
																	ki.image_no, ki.marks
														FROM    keyindex_info as ki, keyword_no as kn
														WHERE	ki.index_no = kn.index_no
														AND		kn.keyword = '" . $keyword_group_array[$count2] . "'
						";
						$cd_db->query( $temporary_query );

						// echo "<font face=tahoma style='font-size:8pt'>$temporary_query</font><br>";

						if( $count2 < count($keyword_group_array) )
						{
							$union_query .= " UNION SELECT * FROM temp_group_result_{$count}{$group1_count }";           
						}
						$cd_db2->query( "SELECT * FROM temp_group_result_{$count}{$group1_count}" );
						$cd_db2->total_record();
					}

					$union_query = substr( $union_query, 6 );

					$temporary_query = "CREATE TEMPORARY TABLE temp_result_union_{$count} ( INDEX( image_no ) ) TYPE=HEAP $union_query";
					$cd_db->query( $temporary_query );
					// echo "<font style='font-size:9pt'>$temporary_query</font><br>";

					$temporary_query = "
													CREATE TEMPORARY TABLE temp_result_{$com1_count} ( INDEX( image_no ) ) TYPE=HEAP
													SELECT	SQL_CACHE
																pi.image_no ,
																marks as marks
													FROM    product_images as pi ,  
																temp_result_union_{$count} as tru
													WHERE	pi.image_no = tru.image_no
													$search_query
					";
					$cd_db->query( $temporary_query );				

				}
				else
				{

					$temporary_query = "
													CREATE TEMPORARY TABLE temp_result_{$com1_count} ( INDEX( image_no ) ) TYPE=HEAP
													SELECT	SQL_CACHE
																ki.image_no, ki.marks
													FROM	keyindex_info as ki, keyword_no as kn
													WHERE	ki.index_no = kn.index_no
													AND		kn.keyword = '" . $keyword_array[$count] . "'
					";
					$cd_db->query( $temporary_query );

				}
				// echo "<font face=tahoma style='font-size:8pt'>$temporary_query</font><br>";

				if( $count < count($keyword_array) -1 )
				{
					$where_query .= " AND temp_result_{$com1_count}.image_no = temp_result_{$com2_count}.image_no";         
				}
				$from_query .= ", temp_result_{$com1_count}";
				$marks_query .= "+ temp_result_{$com1_count}.marks ";

			}

			$where_query    = substr( $where_query, 4 );
			$from_query     = substr( $from_query, 2 );
			$marks_query    = substr( $marks_query, 2 );

			$result_query = " 
							CREATE TEMPORARY TABLE temp_result_cd_end ( INDEX( cd_order_no ) ) TYPE=HEAP
							SELECT	pc.cd_no ,
									pc.cd_order_no ,
									count( DISTINCT( pi.image_no ) ) as keyword_count ,
									sum( $marks_query ) as sum_marks
							FROM	product_cd as pc ,
									product_images as pi ,
									$from_query
							WHERE	pi.image_no = temp_result_1.image_no
							AND		$where_query
							AND		pi.cd_order_no = pc.cd_order_no
							AND		cd_no <> ''
							AND		NOT ( pc.cd_order_no LIKE 'NDY%')
							$search_query
							GROUP BY	pc.cd_order_no
							ORDER BY	keyword_count DESC
							
			";
			$cd_db->query( $result_query );

	} // end if ( 'AND' == keyword_status )

	if( 'OR' == $keyword_status )
	{


			$keyword_array = explode( "+", $basic_keyword );

			for( $count=0; $count < count($keyword_array); $count++ )
			{
				$keyword_array[$count] = trim( $keyword_array[$count] );

				$com1_count = $count + 1;
				$com2_count = $count + 2;

				$group_keyword = '';

				// 키워드 그룹 확인
				$change_query = "
											SELECT	change_keyword
											FROM	keyword_change
											WHERE	keyword = '" . $keyword_array[$count] . "'
				";
				$cd_db->query( $change_query );
				$cd_db->fetch();
				$rs_change_keyword = $cd_db->result( 'change_keyword' );

				if( $rs_change_keyword )
				{

					$change_query = "
												SELECT keyword
												FROM	keyword_change
												WHERE	change_keyword = '$rs_change_keyword'
					";
					$cd_db->query( $change_query );
					for( $loop2=0; $loop2<$cd_db->total_record(); $loop2++ )
					{
						$cd_db->fetch();
						$rs_keyword = $cd_db->result( 'keyword' );
						$group_keyword .= " " . $rs_keyword;
					}
		
				}

				// 키워드 그룹 확인
				$change_query = "
											SELECT	keyword
											FROM	keyword_group
											WHERE	group_keyword = '" . $keyword_array[$count] . "'
				";
				$cd_db->query( $change_query );

				// 키워드 그룹이 있으면
				if( $cd_db->total_record() )
				{		

					for( $loop=0; $loop<$cd_db->total_record(); $loop++ )
					{
						$cd_db->fetch();
						$group_keyword .= " " . $cd_db->result( 'keyword' );
					}

				} 

				if( $group_keyword )
				{

					$keyword_group_array = explode( " ", trim( $group_keyword ) );

					$union_query = '';
					for( $count2=0; $count2<count( $keyword_group_array ); $count2++ )
					{
						$group1_count = $count2 + 1;
						$group2_count = $count2 + 2;

						$temporary_query = "
														CREATE TEMPORARY TABLE temp_group_result_{$group1_count } ( INDEX( image_no ) ) TYPE=HEAP
														SELECT	 SQL_CACHE
																	ki.image_no, ki.marks
														FROM    keyindex_info as ki, keyword_no as kn
														WHERE	ki.index_no = kn.index_no
														AND		kn.keyword = '" . $keyword_group_array[$count2] . "'
						";
						$cd_db->query( $temporary_query );

						// echo "<font face=tahoma style='font-size:8pt'>$temporary_query</font><br>";

						if( $count2 < count($keyword_group_array) )
						{
							$union_query .= " UNION SELECT * FROM temp_group_result_{$group1_count }";           
						}
						$cd_db2->query( "SELECT * FROM temp_group_result_{$group1_count}" );
						$cd_db2->total_record();
					}

					$union_query = substr( $union_query, 6 );

					$temporary_query = "CREATE TEMPORARY TABLE temp_result_union ( INDEX( image_no ) ) TYPE=HEAP $union_query";
					$cd_db->query( $temporary_query );
					// echo "<font style='font-size:9pt'>$temporary_query</font><br>";

					$temporary_query = "
													CREATE TEMPORARY TABLE temp_result_{$com1_count} ( INDEX( image_no ) ) TYPE=HEAP
													SELECT	SQL_CACHE
																pi.image_no ,
																marks as marks
													FROM    product_images as pi ,  
																temp_result_union as tru
													WHERE	pi.image_no = tru.image_no
													$search_query
					";
					$cd_db->query( $temporary_query );				

				}
				else
				{

					$temporary_query = "
													CREATE TEMPORARY TABLE temp_result_{$com1_count} ( INDEX( image_no ) ) TYPE=HEAP
													SELECT	SQL_CACHE
																ki.image_no, ki.marks
													FROM	keyindex_info as ki, keyword_no as kn
													WHERE	ki.index_no = kn.index_no
													AND		kn.keyword = '" . $keyword_array[$count] . "'
					";
					$cd_db->query( $temporary_query );

				}
				// echo "<font face=tahoma style='font-size:8pt'>$temporary_query</font><br>";

				 $result_union_query .= " UNION SELECT * FROM temp_result_{$com1_count }";         
				// echo "<font face=tahoma style='font-size:8pt'>$result_union_query</font><br>";

			}
			
			$result_union_query = substr( $result_union_query, 6 );
			$temporary_query = "CREATE TEMPORARY TABLE temp_result_union_end ( INDEX( image_no ) ) TYPE=HEAP $result_union_query";
			$cd_db->query( $temporary_query );

			$result_query = " 
							CREATE TEMPORARY TABLE temp_result_cd_end ( INDEX( cd_order_no ) ) TYPE=HEAP
							SELECT	pc.cd_no ,
									pc.cd_order_no ,
									count( DISTINCT( pi.image_no ) ) as keyword_count ,
									marks as sum_marks
							FROM	product_cd as pc ,
									product_images as pi ,
									temp_result_union_end as tru
							WHERE	pi.image_no = tru.image_no
							AND		pi.cd_order_no = pc.cd_order_no
							AND		pc.cd_order_no <> ''
							AND		NOT ( pc.cd_order_no LIKE 'NDY%')
							$search_query
							GROUP BY	pc.cd_order_no
							ORDER BY	keyword_count DESC
							
			";
			$cd_db->query( $result_query );



	} // end if ( 'OR' == $keyword_status )

	if( 'BASIC' == $keyword_status )
	{

		$query = "		CREATE TEMPORARY TABLE temp_result_cd_end ( INDEX( keyword_count ) ) TYPE=HEAP
						SELECT		pc.cd_no ,
									pc.cd_order_no ,
									count( DISTINCT( pi.image_no ) ) as keyword_count ,
									sum( ki.marks ) as sum_marks
						FROM		product_cd as pc ,
									product_images as pi ,
									keyword_no as kn ,
									keyindex_info as ki
						WHERE		pc.cd_order_no = pi.cd_order_no		
						AND			pi.image_no = ki.image_no		
						AND			ki.index_no = kn.index_no
						AND			kn.keyword  = '$basic_keyword'
						AND			cd_no <> ''
						AND			NOT ( pc.cd_order_no LIKE 'NDY%')
						$search_query
						GROUP BY	pc.cd_order_no
						ORDER BY	keyword_count DESC
		";
		$cd_db->query( $query );

	}

	$query = "
				SELECT	cd_no ,
						cd_order_no
				FROM	product_cd
				WHERE	cd_order_no LIKE '$basic_keyword%'
				AND		NOT (cd_order_no LIKE 'NDY%')
	";
	$cd_db->query( $query );
	for( $i=0; $i<$cd_db->total_record(); $i++ )
	{
		$cd_db->fetch();
		$rs_cd_no = $cd_db->result( 'cd_no' );
		$rs_cd_order_no = $cd_db->result( 'cd_order_no' );

		$query = "INSERT INTO temp_result_cd_end VALUES ( '$rs_cd_no' , '$rs_cd_order_no', '', '' )";
		$cd_db2->query( $query );
	}

	$main_query = "
							SELECT	cd_no ,
									cd_order_no ,
									keyword_count ,
									sum_marks
							FROM	temp_result_cd_end
	";
	$cd_db->query( $main_query );



	$fp = fopen( "{$CD_CACHE_DIR}/{$filename}", "w" );
	for( $loop=0; $loop<$cd_db->total_record(); $loop++ )
	{
		$cd_db->fetch();
		$cd_no = $cd_db->result( 'cd_no' );
		$keyword_count = $cd_db->result( 'keyword_count' );

		$cd_no = sprintf( "%10s", $cd_no );
		$keyword_count = sprintf( "%5s", $keyword_count );

		fputs( $fp, $cd_no . $keyword_count  );
	}
	fclose( $fp );

	copy( "{$CD_CACHE_DIR}/{$filename}" , "/tmp/{$result_filename}" );


	return $result_filename;

}

?>
