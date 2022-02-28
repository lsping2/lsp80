<?

$curl = curl_init(); 

curl_setopt($curl, CURLOPT_URL, "http://www.apiorange.com/api/send/notice.do");  
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($parameters)); 
curl_setopt($curl, CURLOPT_POST, true); 
curl_setopt($curl, CURLOPT_NOSIGNAL, true); 
curl_setopt($curl, CURLOPT_VERBOSE, false); 
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
$response = curl_exec($curl); 

curl_close($curl); 

if($response){ 
    $decode = json_decode($response, true); 
    $curl_result_code = $decode['result_code'];  
    $curl_result_msg = $decode['result_msg']; 
 
} 

$json = json_decode($curl_result_code,true); 
   


?>