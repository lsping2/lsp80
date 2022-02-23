<?

$single_order_no	= $_GET[ 'single_order_no' ];
$data_folder		= $_GET[ 'data_folder' ];
$sub_folder		= $_GET[ 'sub_folder' ];
$size			= $_GET[ 'size' ];
$image_name		= $_GET[ 'image_name' ];
$watermark		= $_GET[ 'watermark' ];

$source = imagecreatefromjpeg( "/home/coowoo/www/thumbnail/{$data_folder}/{$sub_folder}/{$size}/{$image_name}" );


$tmp_image = md5( time() ) . time();

imagejpeg( $source, "/tmp/{$tmp_image}", 100 );

$full_filename = "/tmp/{$tmp_image}";
$rs_down_filename = "{$single_order_no}.jpg";

if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $_SERVER['HTTP_USER_AGENT']))
{ 
  if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5.5")) 
  { 
    header("Content-Type: doesn/matter"); 
    Header("Content-Length: ".(string)(filesize("$full_filename"))); 
    Header("Content-Disposition: filename=$rs_down_filename");   
    Header("Content-Transfer-Encoding: binary");   
    Header("Pragma: no-cache");   
    Header("Expires: 0");   

  } 

  if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5.0")) 
  { 
    Header("Content-type: file/unknown"); 
    header("Content-Disposition: attachment; filename=$rs_down_filename"); 
    Header("Content-Description: PHP4 Generated Data"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
  } 

  if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5.1")) 
  { 
    Header("Content-type: file/unknown"); 
    header("Content-Disposition: attachment; filename=$rs_down_filename"); 
    Header("Content-Description: PHP4 Generated Data"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
  } 
  
  if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 6.0"))
  {
    Header("Content-type: application/x-msdownload"); 
    Header("Content-Length: ".(string)(filesize("$full_filename")));
    Header("Content-Disposition: attachment; filename=$rs_down_filename");   
    Header("Content-Transfer-Encoding: binary");   
    Header("Pragma: no-cache");   
    Header("Expires: 0");   
  }
} else { 
  Header("Content-type: file/unknown");     
  Header("Content-Length: ".(string)(filesize("$full_filename"))); 
  Header("Content-Disposition: $dn_yn; filename=$rs_down_filename"); 
  Header("Content-Description: PHP4 Generated Data"); 
  Header("Pragma: no-cache"); 
  Header("Expires: 0"); 
} 

if (is_file("$full_filename")) { 
  $fp = fopen("$full_filename", "rb"); 

  if (!fpassthru($fp))
    fclose($fp); 

}

exit;

require_once "../../../include/image_function.php";

$single_order_no	= $_GET[ 'single_order_no' ];
$data_folder			= $_GET[ 'data_folder' ];
$sub_folder			= $_GET[ 'sub_folder' ];
$size						= $_GET[ 'size' ];
$image_name		= $_GET[ 'image_name' ];
$watermark			= $_GET[ 'watermark' ];


/* 

$source = imagecreatefromjpeg( "/home/coowoo/www/thumnail/{$data_folder}/{$sub_folder}/{$size}/{$image_name}" );


$tmp_image = md5( time() ) . time();

imagejpeg( $source, "/tmp/{$tmp_image}" );

$full_filename = "/tmp/{$tmp_image}";
$rs_down_filename = "{$single_order_no}.jpg";

*/

$full_filename = "/home/coowoo/www/thumnail/{$data_folder}/{$sub_folder}/{$size}/{$image_name}";
$rs_down_filename = "{$single_order_no}.jpg";


if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $_SERVER['HTTP_USER_AGENT']))
{ 
  if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5.5")) 
  { 
    header("Content-Type: doesn/matter"); 
    Header("Content-Length: ".(string)(filesize("$full_filename"))); 
    Header("Content-Disposition: filename=$rs_down_filename");   
    Header("Content-Transfer-Encoding: binary");   
    Header("Pragma: no-cache");   
    Header("Expires: 0");   

  } 

  if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5.0")) 
  { 
    Header("Content-type: file/unknown"); 
    header("Content-Disposition: attachment; filename=$rs_down_filename"); 
    Header("Content-Description: PHP4 Generated Data"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
  } 

  if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5.1")) 
  { 
    Header("Content-type: file/unknown"); 
    header("Content-Disposition: attachment; filename=$rs_down_filename"); 
    Header("Content-Description: PHP4 Generated Data"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
  } 
  
  if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 6.0"))
  {
    Header("Content-type: application/x-msdownload"); 
    Header("Content-Length: ".(string)(filesize("$full_filename")));
    Header("Content-Disposition: attachment; filename=$rs_down_filename");   
    Header("Content-Transfer-Encoding: binary");   
    Header("Pragma: no-cache");   
    Header("Expires: 0");   
  }
} else { 
  Header("Content-type: file/unknown");     
  Header("Content-Length: ".(string)(filesize("$full_filename"))); 
  Header("Content-Disposition: $dn_yn; filename=$rs_down_filename"); 
  Header("Content-Description: PHP4 Generated Data"); 
  Header("Pragma: no-cache"); 
  Header("Expires: 0"); 
} 

if (is_file("$full_filename")) { 
  $fp = fopen("$full_filename", "rb"); 

  if (!fpassthru($fp))
    fclose($fp); 

}

?>
