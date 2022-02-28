<?php 
     define("GOOGLE_API_KEY", "AAAAFf71HvI:APA91bH_4tCoT7suIbN6KIWf2aBC-SMWHvuXtRqJHnpDUXo1FdC-gUzKVuKEiH1Zj2IZQq0p4N-rzHHVhjnszdJw_vMDTfwwcTTQIvdwJUfupxPMQ1Oa1l1Eks2khf_UnIAMYz80OSEV"); 

    function send_notification ($tokens, $message)
     {
     $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array(
          'registration_ids' => $tokens,
          'data'             => $message
     );
  
     $headers = array(
         'Authorization:key =' .GOOGLE_API_KEY,
         'Content-Type: application/json'
     );

            $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
             curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
             $result = curl_exec($ch);

            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
             }

            curl_close($ch);

            return $result;
     }
     

$tokens = array("사용자토큰값");
$myMessage = "testssssssssssssssssssssssssssssss";

$message = array(
     "title"     => "testest",
     "body"   => $myMessage
 );
 $message_status = send_notification($tokens, $message);

 echo $message_status;
  ?>




<?php
/*

if($_SESSION['dtkn']) {
sql_query("INSERT INTO users(Token, mb_id) Values ('{$_SESSION['dtkn']}', '{$mb['mb_id']}') ON DUPLICATE KEY UPDATE Token = '{$_SESSION['dtkn']}', mb_id = '{$mb['mb_id']}'");
}

require_once 'dbconnect.php'; // db접속
//데이터베이스에 접속해서 토큰들을 가져와서 FCM에 발신요청
$sql = "select tokenID From member_data where LENGTH(tokenID)>63";
$result = mysqli_query($dbconn,$sql);
$tokens = array();
if(mysqli_num_rows($result) > 0 ){
    while ($row = mysqli_fetch_assoc($result)) {
        $tokens[] = $row['tokenID'];
    }
} else {
    echo 'There are no Transfer Datas';
    exit;
}

mysqli_close($dbconn);

$title = isset($_POST['title'])? $_POST['title'] : "★타이틀 직접 입력★";
$message = isset($_POST['message'])? $_POST['message'] : "★타이틀 직접 입력★";

$arr = array();
$arr['title'] = $title;
$arr['message'] = $message;

$message_status = Android_Push($tokens, $arr);
//echo $message_status;
// 푸시 전송 결과 반환.
$obj = json_decode($message_status);

// 푸시 전송시 성공 수량 반환.
$cnt = $obj->{"success"};

echo $cnt;

function Android_Push($tokens, $message) {
    $url = 'https://fcm.googleapis.com/fcm/send';
    $apiKey = "AAAAFf71HvI:APA91bH_4tCoT7suIbN6KIWf2aBC-SMWHvuXtRqJHnpDUXo1FdC-gUzKVuKEiH1Zj2IZQq0p4N-rzHHVhjnszdJw_vMDTfwwcTTQIvdwJUfupxPMQ1Oa1l1Eks2khf_UnIAMYz80OSEV";

    $fields = array('registration_ids' => $tokens,'data' => $message);
    $headers = array('Authorization:key='.$apiKey,'Content-Type: application/json');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}
*/
?>




