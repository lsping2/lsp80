<?
include "connect.php";

$no=$_POST[ no ];
$thread=$_POST[ thread ];
$fid=$_POST[ fid ];
$name=$_POST[ name ];
$title=$_POST[ title ];
$content=$_POST[ content ];
$passwd=$_POST[ passwd ];

$thread_length = strlen($thread);

++$thread_length;

// $thread_length ���� 2   ��ó�� ����ѱ� A �� �ִ� ���� �������� �ʱ�����
//  fid=$fid �׸��� thread (A)�� ���� thread�� ���̰� �����Ȱ��� ������
$select="select thread from exam where fid='$fid' AND thread LIKE '$thread%' AND length(thread)='$thread_length' order by fid desc , thread desc";



$query=mysql_query($select,$connect);
$row=mysql_num_rows($query);



//  AA ó�� �ڿ� ���� �־ ����Ʈ�� ���� �������ԵǸ�

if($row>0) 
{
	
	$row=mysql_fetch_row($query);
	
	 $len=strlen($thread); 

	$thread_head= substr($row[0], 0, $len);			// thread�� �տ��� A

	$thread_foot =  chr(ord(substr($row[0], -1))+1);		//chr( ord($row) +1  );				// thread�� �ڿ����� �ƽ��ڹ��ڷ� �ٲ� +1 �ѵ� �ٽ� ���ڿ��� ǥ�� B

	$new_thread = $thread_head . $thread_foot;		//�տ����� �ڿ����� ����  AB

echo $thread_head;
echo "<br>";
echo $thread_foot;
exit;

	
}

  
else { $new_thread = $thread . "A"; }   // AA




$insert= "insert into exam (no, name, title, content, pass, date,fid, thread) values ('', '$name', '$title', '$content', '$passwd',  now(), '$fid', '$new_thread')";


mysql_query($insert,$connect);
mysql_close($connect);

?>
<meta http-equiv='refresh' content='0; url=list.php'>

