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

// $thread_length 값은 2   젤처음 등록한글 A 만 있는 값도 가져오지 않기위해
//  fid=$fid 그리고 thread (A)가 들어가고 thread의 길이가 증가된값만 가져옴
$select="select thread from exam where fid='$fid' AND thread LIKE '$thread%' AND length(thread)='$thread_length' order by fid desc , thread desc";



$query=mysql_query($select,$connect);
$row=mysql_num_rows($query);



//  AA 처럼 뒤에 값이 있어서 셀렉트로 값을 가져오게되면

if($row>0) 
{
	
	$row=mysql_fetch_row($query);
	
	 $len=strlen($thread); 

	$thread_head= substr($row[0], 0, $len);			// thread의 앞에값 A

	$thread_foot =  chr(ord(substr($row[0], -1))+1);		//chr( ord($row) +1  );				// thread의 뒤에값을 아스코문자로 바꿔 +1 한뒤 다시 문자열로 표현 B

	$new_thread = $thread_head . $thread_foot;		//앞에값과 뒤에값을 조합  AB

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

