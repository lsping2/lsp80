<?

class Search extends MYSQL
{

	var $keyword;
	var $except_keyword;

	var $search_basic_record = 0;
	var $search_extend_record = 0;

	var $similar_record = 0;
	var $extend_first_record =0;
	var $extend_second_record = 0;
	var $all_keyword_record = 0;

	function Search()
	{
	}

	function keyword_analysis( $keyword )
	{

		$keyword  = trim( $keyword );
		$except_keyword = '';

		while( ereg( "\&", $keyword ) ) $keyword = ereg_replace( "\&", " ", $keyword );
		while( ereg( "[[:space:]][[:space:]]", $keyword ) ) $keyword = ereg_replace( "[[:space:]][[:space:]]", " ", $keyword );

		while( ereg( "[[:space:]]\+", $keyword ) ) $keyword = ereg_replace( "[[:space:]]\+", "+", $keyword );
		while( ereg( "\+[[:space:]]", $keyword ) ) $keyword = ereg_replace( "\+[[:space:]]", "+", $keyword );

		while( ereg( "[[:space:]]\-", $keyword ) )	$keyword = ereg_replace( "[[:space:]]\-", "-", $keyword );
		while( ereg( "\-[[:space:]]", $keyword ) )	$keyword = ereg_replace( "\-[[:space:]]", "-", $keyword );


		if( ereg( "-", $keyword ) )
		{
			$except_keyword = substr( $keyword, strpos( $keyword, "-" ) );
			$keyword = substr( $keyword, 0, strpos( $keyword, "-" ) );

			while( ereg( "-", $except_keyword ) )
			{
				$except_keyword = ereg_replace( "-", "", $except_keyword );
			}
		}

		// ±âº»°ª
		$this->keyword_status = 'BASIC';

		if( ereg( "\+" , $keyword ) )
		{
			$or_status = 'Yes';
			$this->keyword_status = 'OR';
		}
		if( ereg( "[[:space:]]" , $keyword ) )
		{
			$and_status = 'Yes';
			$this->keyword_status = 'AND';
		}

		if( 'Yes' == $or_status AND 'Yes' == $and_status )
		{
			$this->keyword_check = 'MIX';
			$this->keyword_status = 'AND';

			$tmp = explode( " " , $keyword );

			$keyword = '';
			for( $loop=0; $loop<count( $tmp ); $loop++ )
			{
				if( !ereg( "\+" , $tmp[$loop] ) ) $keyword .= " " . $tmp[$loop];
			}

		}
		else
		{
			$this->keyword_check = 'OK';
		}

		$this->keyword = trim( $keyword );
		$this->except_keyword = trim( $except_keyword );	

	}

	function search_basic( $keyword )
	{
		$query = "
						SELECT	count(*)
						FROM	keyword_no as kn ,
									keyindex_info as ki
						WHERE	kn.index_no = ki.index_no
						AND		kn.keyword = '$keyword'
		";
		$this->query( $query );
		$this->search_basic_record = $this->is_count();

	}

	function search_image( $keyword, $limit = 10 )
	{
		$query = "
						SELECT	ki.image_no
						FROM	keyword_no as kn ,
									keyindex_info as ki
						WHERE	kn.index_no = ki.index_no
						AND		kn.keyword = '$keyword'
						ORDER BY marks DESC
						LIMIT	$limit
		";
		$this->query( $query );

	}

	function similar( $similar_keyword )
	{
		$query = "
					SELECT	similar
					FROM	keyword_similar
					WHERE	binary( similar ) LIKE '%$similar_keyword%'
		";
		$this->query( $query );
		$this->similar_record = $this->total_record();

	}

	function extend_first( $extend_keyword )
	{
		$query = "
						SELECT	ki2.index_no1 ,
									ki2.index_no2 ,
									CONCAT( ki2.index_no1 , ki2.index_no2 ) as CONINDEX
						FROM	keyword_no as kn ,
									keyindex_info2 as ki2
						WHERE	kn.index_no = ki2.index_no1
						AND		kn.keyword = '$extend_keyword'
						GROUP BY CONINDEX
		";
		$this->query( $query );
		$this->extend_first_record = $this->total_record();
	}

	function extend_second( $extend_keyword )
	{
		$query = "
						SELECT	ki2.index_no1 ,
									ki2.index_no2 ,
									CONCAT( ki2.index_no1 , ki2.index_no2 ) as CONINDEX
						FROM	keyword_no as kn ,
									keyindex_info2 as ki2
						WHERE	kn.index_no = ki2.index_no2
						AND		kn.keyword = '$extend_keyword'
						GROUP BY CONINDEX
		";
		$this->query( $query );
		$this->extend_second_record = $this->total_record();
	}

	function all_keyword( $keyword )
	{

		$query = "
					SELECT	similar
					FROM	keyword_similar
					WHERE	binary( similar ) LIKE '%$keyword%'
		";
		$this->query( $query );
		$this->all_keyword_record = $this->total_record();
	}

}
