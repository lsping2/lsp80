<?
//���Ͼ��ε�
// 4.1.0 ������ PHP������, $_FILES ��ſ� $HTTP_POST_FILES��
// ����ؾ� �մϴ�.

$uploaddir = 'exceldown/'; //���ε��� ���丮
$uploadfile = $uploaddir . $_FILES['userfile']['name'];

print "<pre>";
if (move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile)) {
print "������ �����ϰ�, ���������� ���ε� �Ǿ����ϴ�.";
print "�߰� ����� �����Դϴ�:\n";
print_r($_FILES);
} else {
print "���� ���ε� ������ ���ɼ��� �ֽ��ϴ�! ����� �����Դϴ�:\n";
print_r($_FILES);
}
print "</pre>";

?>

