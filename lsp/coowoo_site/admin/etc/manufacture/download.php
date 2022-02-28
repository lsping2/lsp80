<?

require_once "../../../include/include.php";
//require_once "../../../include/login_proc.php";
//login_check( 'none' );

$bbs_uid = request( 'bbs_uid', 'get' );

$db = new mysql();
$query = "
			SELECT	real_filename ,
					tmp_filename ,
					filesize
			FROM	bbs_manufacture
			WHERE	bbs_uid = '$bbs_uid'
";

$db->query( $query );
$db->fetch();

$real_filename	= htmlspecialchars( $db->result( 'real_filename' ) );
$tmp_filename	= htmlspecialchars( $db->result( 'tmp_filename' ) );
$filesize		= $db->result( 'filesize' );

$full_filename = "download/{$tmp_filename}";

if( eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $_SERVER['HTTP_USER_AGENT']) )
{

  if( strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5.5") ) 
  { 

    header("Content-Type: doesn/matter"); 
    Header("Content-Length: ".(string)(filesize("$full_filename"))); 
    Header("Content-Disposition: filename=$real_filename");   
    Header("Content-Transfer-Encoding: binary");   
    Header("Pragma: no-cache");   
    Header("Expires: 0");   

  } 

  if( strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5.0") ) 
  { 

    Header("Content-type: file/unknown"); 
    header("Content-Disposition: attachment; filename=$real_filename"); 
    Header("Content-Description: PHP4 Generated Data"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 

  } 

  if( strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5.1") ) 
  { 

    Header("Content-type: file/unknown"); 
    header("Content-Disposition: attachment; filename=$real_filename"); 
    Header("Content-Description: PHP4 Generated Data"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 

  } 
  
  if( strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 6.0") )
  {

    Header("Content-type: application/x-msdownload"); 
    Header("Content-Length: ".(string)(filesize("$full_filename")));
    Header("Content-Disposition: attachment; filename=$real_filename");   
    Header("Content-Transfer-Encoding: binary");   
    Header("Pragma: no-cache");   
    Header("Expires: 0");   

  }

}
else
{
	
  Header("Content-type: file/unknown");     
  Header("Content-Length: ".(string)(filesize("$full_filename"))); 
  Header("Content-Disposition: $dn_yn; filename=$real_filename"); 
  Header("Content-Description: PHP4 Generated Data"); 
  Header("Pragma: no-cache"); 
  Header("Expires: 0"); 

} 

if( is_file( "$full_filename" ) )
{
	
  $fp = fopen( "$full_filename", "rb" ); 

  if ( !fpassthru( $fp ) )
  
  fclose( $fp ); 

}

?>
