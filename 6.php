<?
header('Access-Control-Allow-Origin : {https://api.flextalk.co.kr}'); // 예시. header('Access-Control-Allow-Origin : http://client.google.com');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
header("Content-type:text/html;charset=utf-8");
?>
<!DOCTYPE html>

<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
 -->
<script type="text/javascript" src="/js/jquery-1.12.4.min.js"></script>
<head>
<!--[if lt IE 9]>
    <script type="text/javascript" src="경로/html5shiv.js"></script>
<![endif]-->
</head>

<form name="login" method="post" >
<table align="center" cellpadding="0" cellspacing="0" border="0">
<tr><td height="4"></td></tr>
<tr>
	<td bgcolor="ffffff"><input type="text" name="mid" id="identifier"  tabindex="1"  value="lsp@nate.com"   maxlength="50"></td>
	<td rowspan="2" width="4"></td>
	<td rowspan="2"><a href="javascript:login_app();">로그인</a></td>
</tr>
<tr>
	<td  bgcolor="ffffff"><input type="password" name="passwd"  id="password" class="login_pw" maxlength="50" tabindex="2" value="1234"  ></td>
</tr>
</table>
</form>


<script>

function login_app()
{


	axios.post('https://api.flextalk.co.kr/auth/local', {
				identifier: $("#identifier").val(),
				password: $("#password").val(),

   // crossDomain: true,
		  })

		  .then(function (response) {
			 alert('로그인 되었습니다.');
			 console.log(response);
		  })
		  .catch(function (error) {
			  alert('로그인 정보가 맞지않습니다.');
			  console.log(error);
		  });

}



</script>
