<?
//파일업로드
// 4.1.0 이전의 PHP에서는, $_FILES 대신에 $HTTP_POST_FILES를
// 사용해야 합니다.

$uploaddir = 'exceldown/'; //업로드할 디렉토리
$uploadfile = $uploaddir . $_FILES['userfile']['name'];

print "<pre>";
if (move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile)) {
print "파일이 존재하고, 성공적으로 업로드 되었습니다.";
print "추가 디버깅 정보입니다:\n";
print_r($_FILES);
} else {
print "파일 업로드 공격의 가능성이 있습니다! 디버깅 정보입니다:\n";
print_r($_FILES);
}
print "</pre>";

?>

