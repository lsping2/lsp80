<?php
require 'aes.class.php';     // AES PHP implementation
//require 'aesctr.class.php';  // AES Counter Mode implementation


$GUID = "mechant_guid";
$KEY_ENC = "merchant_keyP";
$COMMON_ENC = "UTF-8";
$nonce = "20169";
$email = "test@provider.com";
$user = "홍길동";
$phone = "01052645212";

$ENCODE_PARAMS = "_method=POST&reqMemGuid=" . $GUID . "&nonce=".$nonce."&desc=desc&emailAddrss=" . $email . "&emailTp=PERSONAL&fullname=" . urlencode($user) . "&nmLangCd=ko&phoneCntryCd=KOR&phoneNo=" . $phone . "&phoneTp=MOBILE";

$cipher = AesCtr::encrypt($ENCODE_PARAMS, $KEY_ENC, 256);
$cipherEncoded = urlencode($cipher);
$requestString = "_method=POST&reqMemGuid=" . $GUID . "&encReq=" . $cipherEncoded;
$requestPath = "https://stg5.paygate.net/v5a/member/createMember?" . $requestString;

 
echo nl2br("====== Plain cipher ====== \n");
echo nl2br("$cipher \n");
echo nl2br("====== url encoded Cipher ====== \n");
echo nl2br("$cipherEncoded \n");
echo nl2br("====== Full request path & url encoded params ====== \n");
echo nl2br("$requestPath \n");
echo nl2br("=========================== CURL REQUEST ============================== \n");

$curl_handle = curl_init();
curl_setopt($curl_handle, CURLOPT_URL, $requestPath);
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, 0); //CURLOPT_SSL_VERIFYPEER is needed for https request.
curl_setopt($curl_handle, CURLOPT_USERAGENT, '   `https://stg5.paygate.net/v5a/member/createMember`  ');
$result = curl_exec($curl_handle);
curl_close($curl_handle);

echo nl2br("====== OUTPUT RESULT ====== \n");
echo nl2br("$result  \n");
?>