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
// �� $asdf  ������ o ��� ���� ���� 
//$asdf  ������  o,a,b,c �ϋ� ���� $asdf1,$asdf2,$asdf3,$asdf4 ������ on �̶� ���� �ִ´�.


?>