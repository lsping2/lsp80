<?

class MYSQL
{

	var $hostname	= "localhost";
	var $dbname		= "lsp80";
	var $userid		= "lsp80";
	var $passwd		= "dldks1006";

	var $db_connect;
	var $record_set;
	var $row;

	var $fetch_pos;
	var $connect_flag;
	var $transaction_flag;

	var $confirm_flag;
	var $total_record;

	function MYSQL()
	{
		$this->mysql_open();
	}

	function mysql_open()
	{
		if( FALSE == $this->connect_flag )
		{
			$this->db_connect = mysql_connect( $this->hostname, $this->userid, $this->passwd );

			if( $this->db_connect )
			{
				if( mysql_select_db( $this->dbname, $this->db_connect ) )
				{
					$connect_flag = TRUE;	
				}
			}
			else
			{
				exit;
			}
		}
	}

	function query( $query )
	{
		if( $this->record_set = mysql_query( $query ) ) 
		{
			$this->confirm_flag = TRUE;
			$this->total_record = 0;
		}
		else
		{
			$this->confirm_flag = FALSE;
			$this->total_record = 0;
			echo mysql_errno() . " : " . mysql_error() . "<br><br>$query";
		}
	}
	/* json 구조로 배열을 만들때 결과값을 리턴할때 사용 */
	function query2( $query )
	{
		$rs = mysql_query( $query ); 
		return $rs;
	}
	/* insert, update, delete일 경우 실행 여부 결과를 리턴 성공:1, 에러:에러메세지 */ 
	function executeUpdate( $query )
	{
		if( $this->record_set = mysql_query( $query ) ) 
		{
			$this->confirm_flag = TRUE;
			$this->total_record = 0;
			return "1";
		}
		else
		{
			$this->confirm_flag = FALSE;
			$this->total_record = 0;
			return mysql_errno() . " : " . mysql_error() . "<br><br>$query";
		}
	}

	function transaction()
	{
		if( mysql_query( "BEGIN" ) )
		{
			$this->transaction_flag = TRUE;
		}
	}

	function commit()
	{	
		if( mysql_query( "COMMIT" ) )
		{
			$this->transaction_flag = FALSE;
		}
	}

	function rollback()
	{
		if( mysql_query( "ROLLBACK" ) )
		{
			$this->transaction_flag = FALSE;
		}
	}

	function is_count()
	{
		$count = mysql_result( $this->record_set, 0, 0 );
		if( $count > 0 )
		{
			return $count;
		}
		else
		{
			return FALSE;
		}
	}

	function fetch()
	{
		$this->row = mysql_fetch_array( $this->record_set );
	}

	function start()
	{
		mysql_data_seek( $this->record_set, 0 );
	}

	function result( $field )
	{
		return $this->row[ $field ];
	}

	function total_record()
	{
		if( $this->total_record )
		{
			return $this->total_record;
		}
		else
		{
			return $this->total_record = mysql_num_rows( $this->record_set );
		}
	}

	function close()
	{
		if( $this->connect_flag )
		{
			if( TRUE == $this->transaction_flag )
			{
				mysql_query( "ROLLBACK" );
			}

			mysql_close( $this->db_connect );
		}
	}

}

?>
