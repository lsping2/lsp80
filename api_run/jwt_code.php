<?
$secret_key = "180779819238403";

$tokenId			=  base64_encode($row['mb_id']);
$issuedAt		= time(); // issued at
$notbefore		= $issuedAt; //not before in seconds   
$expire			= $issuedAt + (60 * 60); // expire time in seconds --1시간
$severName	= "col";
?>