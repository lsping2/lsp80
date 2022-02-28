<?

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );


$manufacture		= request( 'manufacture' , 'get' );
$filename			= request( 'filename' , 'get' );
$request_date		= request( 'request_date' , 'get' );
$seller_id  		= request( 'seller_id' , 'get' );


//$product_info  		= request( 'product_info' , 'get' );



if( 'daj' == $manufacture ) 
{
	$dir = $SERVER_CONFIG[ 'seller_daj_download' ] . "/{$seller_id}/{$request_date}";
	
}
elseif( 'ndisc' == $manufacture )
{
       $dir = $SERVER_CONFIG[ 'seller_ndisc_download' ] . "/{$seller_id}/{$request_date}";

}
elseif( 'mixa' == $manufacture )
{
	$dir = $SERVER_CONFIG[ 'seller_mixa_download' ] . "/{$seller_id}/{$request_date}";
}
elseif( 'naturalimage' == $manufacture )
{
	$dir = $SERVER_CONFIG[ 'seller_naturalimage_download' ] . "/{$seller_id}/{$request_date}";
}
elseif( 'ion' == $manufacture )
{
	$dir = $SERVER_CONFIG[ 'seller_ion_download' ] . "/{$seller_id}/{$request_date}";
}
elseif( 'samil' == $manufacture )
{
	$dir = $SERVER_CONFIG[ 'seller_samil_download' ] . "/{$seller_id}/{$request_date}";
}

 $full_filename = $dir . "/{$filename}";



//home/coowoo/www/seller/ndisc/download/coowoo/20051219/nx001100.jpg

if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $_SERVER['HTTP_USER_AGENT']))
{ 
  if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5.5")) 
  { 
    header("Content-Type: doesn/matter"); 
    Header("Content-Length: ".(string)(filesize("$full_filename"))); 
    Header("Content-Disposition: filename=$filename");   
    Header("Content-Transfer-Encoding: binary");   
    Header("Pragma: no-cache");   
    Header("Expires: 0");   

  } 

  if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5.0")) 
  { 
    Header("Content-type: file/unknown"); 
    header("Content-Disposition: attachment; filename=$filename"); 
    Header("Content-Description: PHP4 Generated Data"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
  } 

  if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5.1")) 
  { 
    Header("Content-type: file/unknown"); 
    header("Content-Disposition: attachment; filename=$filename"); 
    Header("Content-Description: PHP4 Generated Data"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
  } 
  
  if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 6.0"))
  {
    Header("Content-type: application/x-msdownload"); 
    Header("Content-Length: ".(string)(filesize("$full_filename")));
    Header("Content-Disposition: attachment; filename=$filename");   
    Header("Content-Transfer-Encoding: binary");   
    Header("Pragma: no-cache");   
    Header("Expires: 0");   
  }
} else { 
  Header("Content-type: file/unknown");     
  Header("Content-Length: ".(string)(filesize("$full_filename"))); 
  Header("Content-Disposition: $dn_yn; filename=$filename"); 
  Header("Content-Description: PHP4 Generated Data"); 
  Header("Pragma: no-cache"); 
  Header("Expires: 0"); 
} 

if (is_file("$full_filename")) { 
  $fp = fopen("$full_filename", "rb"); 

    while(!feof($fp)) { 
       echo fread($fp, 100*1024); 
       flush(); 
    }

}

?>
