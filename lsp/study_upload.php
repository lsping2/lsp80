<?
@mkdir('���丮��',777);		// @ �� ������ ���� ������ Ȥ�� ������ ���޼����� �Ⱥ��̰� ��
@rmdir('���丮��');			//����

$open=opendir('���丮��');    //���丮�� ����
readdir($open)					// ������� ���丮 �ȿ� �ִ� ������ ��������  (���丮�ڵ�)
while($data=readdir($open))
{
	echo $data;
	echo "<br>";
}

closedir($open);				//���丮�� �ݴ´�
	






$test=stat('test.txt');  // �迭�� ������ �����ϴ� �Լ�   ���Ұ� 7--> ������ ũ��
echo $test[7]; 


$test=stat('test.txt');  // �迭�� ������ �����ϴ� �Լ�   ���Ұ� 8--> ���������� ���ٵ� �ð� (���н�Ÿ�ӽ������� ǥ��)
echo $test[8]; 


$test=stat('test.txt');  // �迭�� ������ �����ϴ� �Լ�   ���Ұ� 9--> ���������� ������ �ð�
echo $test[9]; 


echo filesize('test.txt');		// ������ ũ�⸸ �����


echo fileatime('test.txt');		//  ������ ���ٽð�


echo filemtime('test.txt');		// ������ ���ٽð�




$a=fileperms('test.txt');	// ������ �۹̼��� ���Ҷ�  --->10������ ���� ����

echo base_convert($a);      // 10������ 8������
or
base_convert($a,10,8);




file_exists('text.txt');  // ���� ����



fopen('text.txt',r+);    // (�б⾲��+) ������ �����Լ�  rwx  �б�,����,����
fopen('text.txt',r);     // ����������ġ�� ���� ������ġ
fopen('text.txt',w+);    // ���Ͼ����� ���� ������ �б⾲��

fopen('text.txt',a);     // ��������  (��������ġ�� ������!)
$fp=fopen('text.txt',a+);    // �б⾲��


text.txt �ȿ� abc��� ���� ������  ����������
fgets($fp,2);   // ������� ���丮 �ȿ� �ִ� ������ �������� ----> ���� 2�� ù��° ���� ����!  a
fgets($fp,2);   // �� �������� ������   a,b
fgets($fp,2);   // �� �������� ������   a,b,c

.
.
.

echo feof($fp);  // ���������Ͱ� ������ �̵��ߴ��� Ȯ��  --> 1
fclose($fp);




$a=file('test.txt')				// �迭ȭ��--------> 0���� 2���� ���� ( 3���϶�)
$size=sizeof($a);				// �� �پ� �ν��� ���� ������,(�� �����ǹ迭�� ���մ��� �˱�����) --> �����϶� 3�� ����  
for($i=0;$i<$size;$i++)			// �迭 0,1,2 �����ϱ� size�� 3���� �۾ƾ���
{
	echo $a[$i];
}





echo fgetc('test.txt');   // fgets���� ������ ���̸�ŭ �о�� 1byte  ex) a




$fp=fopen('image.gif',r);   //����������
fgetss($fp,2);     // html , php ������ ���� ���� ������
fread($fp,2);  // �̹�������, ���������� �����ö�




$fp=fopen('test.txt',w);
fwrite($fp,'���Ͼȿ� ������');   // 2����Ʈ   �������ָ� ������
fclose($fp);
// ���Ͼȿ� ������ �̶�� ���� ����.


fputs == fwrite


���丮 ������  �������� ����ִ� �����丮�� 707 ������ ��
copy('text.txt','copy/text.txt');   // copy ��� ���丮 �ؿ� ����



unlink('copy/text.txt');			// ����



?>