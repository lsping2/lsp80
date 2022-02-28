<?php

class ERROR
{

	function ERROR()
	{

		error_reporting( E_ALL ^E_COMPILE_WARNING );
	}

	function error_handler( $error_no, $error_string, $error_file, $error_line )
	{

		$debug_array = debug_backtrace();

		$error_type = array (
					1    => "Error",
					2    => "Warning",
					4    => "Parsing Error",
					8    => "Notice",
					16   => "Core Error",
					32   => "Core Warning",
					64   => "Compile Error",
					128  => "Compile Warning",
					256  => "User Error",
					512  => "User Warning",
					1024 => "User Notice"
					);
		echo "
				<table border=0 cellpadding=0 cellspacing=5 bgcolor='#EFEFEF'>
				<tr>
					<td>
					<table border=0 cellpadding=0 cellspacing=0 bgcolor='#FFFFFF'>
					<tr>
						<td align=center width=160>
						<font style='font-family:verdana;font-size:9pt'>ERROR NO (TYPE)</font>
						</td>
						<td width=300>
						<font style='font-family:verdana;font-size:9pt'>$error_no (" . $error_type[ $error_no ] . ")</font>
						</td>
					</tr>
					<tr>
						<td align=center width=100>
						<font style='font-family:verdana;font-size:9pt'>STRING</font>
						</td>
						<td width=300>
						<font style='font-family:verdana;font-size:9pt'>$error_string</font>
						</td>
					</tr>
					<tr>
						<td align=center width=100>
						<font style='font-family:verdana;font-size:9pt'>FILE</font>
						</td>
						<td width=300>
						<font style='font-family:verdana;font-size:9pt'>" . $error_file . "</font>
						</td>
					</tr>
					<tr>
						<td align=center width=100>
						<font style='font-family:verdana;font-size:9pt'>LINE</font>
						</td>
						<td width=300>
						<font style='font-family:verdana;font-size:9pt'> $error_line</font>
						</td>
					</tr>
					</table>
					</td>
				</tr>
				</table>
				<br>
		";


	}


	function error_msg( $string )
	{

		echo "
				<br><br><br><br><br>
				
				<table align=center border=0 cellpadding=0 cellspacing=5 bgcolor='#EFEFEF'>
				<tr>
					<td align=center height=40>
					<font style='font-family: verdana; font-size:9pt; color: #FF0000'><b>ERROR</b></font>
					<table border=0 cellpadding=0 cellspacing=0 bgcolor='#FFFFFF'>
					<tr>
						<td align=center width=500 height=100>
						<font style='font-family: verdana; font-size:9pt'> $string </font>
						</td>
					</tr>
					<tr>
						<td align=center height=50>
						<a href='javascript:window.history.back()' style='font-size:9pt'>돌아가기</a>
						</td>
					</tr>
					</table>
					</td>
				</tr>
				</table>
				<br>
		";


	}

}

$error = new ERROR();
set_error_handler( array( $error, 'error_handler' ) );

?>

