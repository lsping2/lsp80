<?

function request( $variable_name, $method = 'any' )
{

	$method = strtolower( $method );

	if( 'post' == $method )
	{
		if( isset( $_POST[ $variable_name ] ) )
		{
			return $_POST[ $variable_name ];
		}
		else
		{
			return '';
		}
	}
	elseif( 'get' == $method )
	{
		if( isset( $_GET[ $variable_name ] ) )
		{
			return $_GET[ $variable_name ];
		}
		else
		{
			return '';
		}
	}
	elseif( 'cookie' == $method )
	{
		if( isset( $_COOKIE[ $variable_name ] ) )
		{
			return $_COOKIE[ $variable_name ];
		}
		else
		{
			return '';
		}
	}
	elseif( 'session' == $method )
	{
		if( isset( $_SESSION[ $variable_name ] ) )
		{
			return $_SESSION[ $variable_name ];
		}
		else
		{
			return '';
		}
	}
	elseif( 'any' == $method )
	{
		if( isset( $_REQUEST[ $variable_name ] ) )
		{
			return $_REQUEST[ $variable_name ];
		}
	}
}

function make_httpvar( $except = '' )
{
	$httpvar = '';

	if( ( count( $_GET ) >= 1 ) )
	{
		foreach( $_GET as $key=>$value )
		{
			if( !in_array( $key , $except ) ) 
			{
				if( is_array( $value ) )
				{
					for( $i=0; $i<count( $value ); $i++ )
					{
						if( $value[$i] ) $httpvar .= "&" . $key . "[]=" . $value[$i];
					}
				}
				else
				{

						if( $value ) $httpvar .= "&" . $key . "=" . $value;
					
				}
			}
		}
	}

	if( count( $_POST ) >= 1 )
	{
		foreach( $_POST as $key=>$value )
		{
			if( !in_array( $key , $except ) ) 
			{
				if( is_array( $value ) )
				{
					for( $i=0; $i<count( $value ); $i++ )
					{
						if( $value[$i] ) $httpvar .= "&" . $key . "[]=" . $value[$i];
					}
				}
				else
				{
					if( $value ) $httpvar .= "&" . $key . "=" . $value;
				}
			}
		}
	}
	
		return substr( $httpvar, 1 );
}

function html_cache_disable()
{

	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

	// HTTP/1.1
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);

	// HTTP/1.0
	header("Pragma: no-cache");

}

function spec_trim( $string )
{
	$string = str_replace( "\t" , " " , $string );
	$string = str_replace( "\n" , " " , $string );

	while( ereg( "[[:space:]][[:space:]]" , $string ) ) $string= ereg_replace( "[[:space:]][[:space:]]", " ", $string );

	return trim( $string );
}

function substr_kr( $string, $string_length, $add_string )
{

    $string = trim( $string );

    if( $string_length >= strlen( $string ) ) return $string;
    $index = $string_length - 1;

    while( ord( $string[ $index ] ) & 0x80 ) $index--;

    return trim( substr( $string, 0, $string_length - (( $length + $index + 1 ) % 2 )) ) . $add_string;

} // end of function my_kr_substr

function my_filesize( $filesize )
{

	if($filesize < 1024) {
	$re_size = $filesize." Byte";
	} elseif($filesize >=1024 && $filesize < 1048576) {
	$re_size = sprintf("%d", $filesize/1024)." KB";
	} elseif($filesize >= 1048576) {
	$re_size = sprintf("%0.1f", $filesize/1048576)." MB";
	}

return $re_size;

}

function meta_go( $url_location)
{

    echo "<meta http-equiv='Refresh' content='0; URL=$url_location'>";
    exit;
}

function js_msg( $string )
{

    echo "<script language=javascript>";
    echo "alert( '$string' );";
    echo "</script>";

}

function js_code( $code )
{

    echo "<script language=javascript>";
    echo "$code";
    echo "</script>";

}

function js_go( $url )
{

    echo "<script language=javascript>";
    echo "location.href=\"$url\"";
    echo "</script>";

    exit;

}


function js_back( $string = '' )
{

    echo "<script language=javascript>";
	if( $string )
	{
		echo "alert( '$string' );";
	}
    echo "history.back();";
    echo "</script>";

    exit;

}

function js_hidden_msg( $string = '' )
{
	echo "\n\n<!-- hidden_msg\n{$string}\n->\n\n";
}

function check_value( $value, $error_msg )
{

	if( $value )
	{
		return TRUE;
	}
	else
	{
		ERROR::error_msg( $error_msg );
		exit;
	}

}

function check_length( $string , $symbol, $length, $error_msg )
{

	switch( $symbol )
	{
		case '=='	:	if( $length != strlen( $string ) )
						{
							ERROR::error_msg( $error_msg );
							exit;
						}
						break;
		case '>='	:	if( $length > strlen( $string ) )
						{
							ERROR::error_msg( $error_msg );
							exit;
						}		
						break;
		case '<='	:	if( $length < strlen( $string ) )
						{
							ERROR::error_msg( $error_msg );
							exit;
						}	
						break;
	}

}


function my_random_string( $string_length, $mode = 5 )
{

    switch( $mode )
    {

        case '1' :
            $string = "23456789";
            break;
        case '2' :
            $string = "23456789abcdefghjklmnpqrstuvwxyz";
            break;
                case '3' :
            $string = "23456789ABCDEFGHKLMNPQRSTUVWXYZ";
            break;
                case '4' :
            $string = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
            break;
                case '5' :
            $string = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ~!@#$%^&*()_+";
            break;
                default  :
            $string = "23456789";

    } // end of switch

	$random_string = '';
    for( $loop=0; $loop<$string_length; $loop++ )
    {

        $index = rand( 0, strlen( $string) -1 );
        $random_string .= substr( $string, $index, 1 );

    } // end of for

    return $random_string;

} // end of function my_random_string


//
// 예전에 사용하던 함수들...
//

function my_js_back()
{

    echo "<script language=javascript>window.history.back();</script>";

} // end of function my_js_back();

function my_javascript( $javascript_code )
{

    echo "<script language=javascript>";
    echo "$javascript_code";
    echo "</script>";

} // end of function my_javascript

function my_meta_go( $url_location )
{

    echo "<meta http-equiv='Refresh' content='0; URL=$url_location'>";
    exit;

} // end of function my_meta_go

function my_js_target( $url_location, $frame = '_self' )
{

    echo "<script language=javascript>";
    echo "window.open('$url_location','$frame')";
    echo "</script>";

    exit;

} // end of function

function my_js_errorb( $string )
{

    echo "<script language=javascript>";
    echo "alert( '$string' );";
    echo "window.history.back();";
    echo "</script>";

    exit;

} // end of function my_js_errorb

function my_js_errors( $string )
{

    echo "<script language=javascript>";
    echo "alert( '$string' );";
    echo "</script>";

} // end of function my_js_errors

function my_smail( $send_name, $from_email, $returned_email, $to_email, $subject, $comment )
{

	/*
		$headers .= "X-Mailer: PHP\n";
		$headers .= "Return-Path: {$returned_email}\n";
		$headers .= "Content_Type: text/html; charset=EUC-KR\n";
		$headers .= "\n\n";

		$fp = popen( '/usr/sbin/sendmail -t -ba $to_email $from_email', "w" );
		if(!$fp) return false;

		fputs( $fp, "From: $send_name <{$from_email}>\r\n" );
		fputs( $fp, "To: {$To}\r\n" );
		fputs( $fp, "Subject: {$subject}\r\n" );
		fputs( $fp, "{$headers}\r\n" );
		fputs( $fp, "$comment" );
		fputs( $fp, "\r\n\r\n\r\n" );

		pclose( $fp );
	*/


	/*
		$headers = "From: $send_name <$from_email>\n";
		$headers .= "X-Sender: <$from_email>\n";
		$headers .= "X-Mailer: PHP ".phpversion()."\n";
		$headers .= "X-Priority: 3\n";
		$headers .= "Return-Path: <$from_email>\n";
		$headers .= "Content-Type: text/html; ";
		$headers .= "charset=ks_c_5601-1987\n";

		$headers = "$from\r\n$to\r\n$subject\r\n";
		$headers.= "MIME-Version: 1.0\r\n"; 
		$headers.= "Content-Type: multipart/mixed;boundary=\"$boundary\"\r\n\r\n";

		mail( $to_email, $subject, $comment, $headers );
	*/

	$to_email	 = ereg_replace( "\n", "", $to_email );

	$boundary = '=_'.md5(uniqid(time())); 

        $subject = base64_encode($subject);
        $subject = "Subject: =?ks_c_5601-1987?B?$subject?= ";
    
        $from = base64_encode( $send_name );
        $from = "From: =?ks_c_5601-1987?B?$from?= <webmaster@coowoo.com>";
                
        $to = base64_encode($to_email);
        $to = "To: =?ks_c_5601-1987?B?$to?= <$to_email>";
    
	$headers = "$from\r\n$to\r\n$subject\r\n";
        $headers.= "MIME-Version: 1.0\r\n"; 
        $headers.= "Content-Type: multipart/mixed;boundary=\"$boundary\"\r\n\r\n";
    
        $body = "--".$boundary."\r\n";
        $body.= "Content-Type: text/html; charset=\"euc-kr\"\r\n";
        $body.= "Content-Transfer-Encoding: base64\r\n\r\n"; 
        $body.= chunk_split(base64_encode($comment))."\r\n\r\n"; 
        $body.= '--'.$boundary."--\r\n\r\n"; 

        $MAILER="/usr/sbin/sendmail -t -i"; 
        $fp =popen($MAILER,"w");
                
        fputs($fp,$headers); 
        fputs($fp,$body);

        pclose($fp); 

	return true;

} // end of function my_smail



function my_days_count( $year, $month )
{

    $odd_check  = ( $month % 2 ) ? 0 : 1;
    $where      = ( $month - 7 > 0 ) ? 1 : 0;
    $days       = $odd_check ? 30 : 31;

    if( $where )
    {

        $days = $odd_check ? 31 : 30;

    } // end of if

    if( 2 == $month )
    {

        $days  = 28;
        $days += ( $year % 4 ) ? 0 : 1;
        $days -= ( $year % 100 ) ? 0 : 1;
        $days += ( $year % 400 ) ? 0 : 1;

    } // end of if

    return $days;

} // end of function

function my_storage_size( $storage_fullname )
{

    $storage_unit_array = array( "MB", "GB", "TB" );

    if( @is_dir( $storage_fullname ) ) {

        $free_space = disk_total_space( $storage_fullname ) / 1024;

        if( $free_space < 1024 ) {

            $free_space = "<font color=#FF3300>뷮</font>";

        } else {

            for( $unit_loop=0; $unit_loop<count( $storage_unit_array ); $unit_loop++ ) {

                if( $free_space > 1024 ) {

                    $free_space /= 1024;
                    continue;

                } elseif( $unit_loop == count( $storage_unit_array ) - 1 ) {

                    $pos = $unit_loop;
                    break;

                } else {

                    $pos = $unit_loop;

                } // end of if
                break;

            } // end of for

            $unit       = $storage_unit_array[ $pos - 1 ];
            $free_space = sprintf( "%0.1f", $free_space );

        } // end of if

		return "$free_space $unit";

    } // end of if
	else
	{

		return "<font color=#FF0000>NOT EXIST</font>";

	}

} // end of function my_store_total_size

function my_storage_freesize( $storage_fullname )
{

    $storage_unit_array = array( "MB", "GB", "TB" );

    if( @is_dir( $storage_fullname ) ) {

        $free_space = diskfreespace( $storage_fullname ) / 1024;

        if( $free_space < 1024 ) {

            $free_space = "<font color=#FF3300>뷮</font>";

        } else {

            for( $unit_loop=0; $unit_loop<count( $storage_unit_array ); $unit_loop++ ) {

                if( $free_space > 1024 ) {

                    $free_space /= 1024;
                    continue;

                } elseif( $unit_loop == count( $storage_unit_array ) - 1 ) {

                    $pos = $unit_loop;
                    break;

                } else {

                    $pos = $unit_loop;

                } // end of if
                break;

            } // end of for

            $unit       = $storage_unit_array[ $pos - 1 ];
            $free_space = sprintf( "%0.1f", $free_space );

        } // end of if

		return "$free_space $unit";

    } // end of if
	else
	{

		return "<font color=#FF0000>NOT EXIST</font>";

	}

} // end of function my_store_freesize

?>
