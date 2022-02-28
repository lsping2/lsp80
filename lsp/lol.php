<?
$asdf1 = $asdf2 = $asdf3 = $asdf4 = "off";
$asdf = substr(basename($_SERVER['SCRIPT_NAME']),-6,1);
switch($asdf) {
  case "o":
    $asdf1 = "on"; break;
  case "a":
    $asdf2 = "on"; break;
  case "b":
    $asdf3 = "on"; break;
  case "c":
    $asdf4 = "on"; break;
}

echo $asdf;

// basename($_SERVER['SCRIPT_NAME']) ------>  lol.php
// substr(basename($_SERVER['SCRIPT_NAME']),-6,1)  -----> o
// 즉 $asdf  변수에 o 라는 값이 들어가고 
//$asdf  변수가  o,a,b,c 일떄 각각 $asdf1,$asdf2,$asdf3,$asdf4 변수에 on 이란 값을 넣는다.


?>