<?
echo  phpinfo();
$email ="lsp80@nate.com";
		$add_header = "From: 관리자<lsp80@nate.com> \n";	//나 보내는 사람
		$add_header .= "Reply-To: 이승표<lsp80@nate.com> \n";
		$add_header .= "Content-Type:text/html;charset=EUC-KR";

		$subject = "님의 이승표의 LG전자 아이디/비밀번호 확인 메일입니다.";			  
		$comment = "비밀번호는 입니다.";//메일내용

		//mail( $email, $subject, $comment, $add_header );

?>
