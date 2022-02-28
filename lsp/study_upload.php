<?
@mkdir('디렉토리명',777);		// @ 는 기존에 값이 있을때 혹시 나오는 경고메세지를 안보이게 함
@rmdir('디렉토리명');			//삭제

$open=opendir('디렉토리명');    //디렉토리를 열때
readdir($open)					// 열어놓은 디렉토리 안에 있는 정보를 꺼내놓음  (디렉토리핸들)
while($data=readdir($open))
{
	echo $data;
	echo "<br>";
}

closedir($open);				//디렉토리를 닫는다
	






$test=stat('test.txt');  // 배열로 파일을 저장하는 함수   원소값 7--> 파일의 크기
echo $test[7]; 


$test=stat('test.txt');  // 배열로 파일을 저장하는 함수   원소값 8--> 마지막으로 접근된 시간 (유닉스타임스탬프로 표현)
echo $test[8]; 


$test=stat('test.txt');  // 배열로 파일을 저장하는 함수   원소값 9--> 마지막으로 수정된 시간
echo $test[9]; 


echo filesize('test.txt');		// 파일의 크기만 찍어줌


echo fileatime('test.txt');		//  마지막 접근시간


echo filemtime('test.txt');		// 마지막 접근시간




$a=fileperms('test.txt');	// 파일의 퍼미션을 구할때  --->10진수로 값이 나옴

echo base_convert($a);      // 10진수를 8진수로
or
base_convert($a,10,8);




file_exists('text.txt');  // 값의 유무



fopen('text.txt',r+);    // (읽기쓰기+) 파일을 여는함수  rwx  읽기,쓰기,실행
fopen('text.txt',r);     // 포인터의위치가 파일 시작위치
fopen('text.txt',w+);    // 파일없으면 새로 생성후 읽기쓰기

fopen('text.txt',a);     // 쓰기전용  (포인터위치가 마지막!)
$fp=fopen('text.txt',a+);    // 읽기쓰기


text.txt 안에 abc라는 값이 있을때  값을뽑을때
fgets($fp,2);   // 열어놓은 디렉토리 안에 있는 정보를 꺼내놓음 ----> 길이 2가 첫번째 값을 가짐!  a
fgets($fp,2);   // 그 다음값을 가져옴   a,b
fgets($fp,2);   // 그 다음값을 가져옴   a,b,c

.
.
.

echo feof($fp);  // 파일포인터가 끝까지 이동했는지 확인  --> 1
fclose($fp);




$a=file('test.txt')				// 배열화됨--------> 0부터 2까지 찍어라 ( 3줄일때)
$size=sizeof($a);				// 한 줄씩 인식의 값을 가져옴,(총 몇줄의배열로 되잇는지 알기위함) --> 세줄일땐 3이 찍힘  
for($i=0;$i<$size;$i++)			// 배열 0,1,2 까지니까 size값 3보다 작아야함
{
	echo $a[$i];
}





echo fgetc('test.txt');   // fgets에서 지정된 길이만큼 읽어옴 1byte  ex) a




$fp=fopen('image.gif',r);   //파일포인터
fgetss($fp,2);     // html , php 형식을 뺴고 값을 가져옴
fread($fp,2);  // 이미지파일, 실행파일을 가져올때




$fp=fopen('test.txt',w);
fwrite($fp,'파일안에 쓸내용');   // 2바이트   값을안주면 다찍힘
fclose($fp);
// 파일안에 쓸내용 이라는 값이 찍힘.


fputs == fwrite


디렉토리 권한은  각파일을 담고있는 데렉토리에 707 권한을 줌
copy('text.txt','copy/text.txt');   // copy 라는 디렉토리 밑에 복사



unlink('copy/text.txt');			// 삭제



?>