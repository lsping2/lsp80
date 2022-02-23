<?
header('Access-Control-Allow-Origin : {https://api.flextalk.co.kr/auth/local}'); // 예시. header('Access-Control-Allow-Origin : http://client.google.com');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
header("Content-type:text/html;charset=utf-8");
?>
<!DOCTYPE html>

<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<!-- <script src="/js/jquery-1.8.3.min.js?ver=<?=date('His')?>"></script> -->

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>

<head>
<!--[if lt IE 9]>
<script src="IE7.js"></script>
<![endif]-->
</head>

<form name="login" method="post" >
<table align="center" cellpadding="0" cellspacing="0" border="0">
<tr><td height="4"></td></tr>
<tr>
	<td bgcolor="ffffff"><input type="text" name="mid" id="identifier"  tabindex="1"  value="lsp@nate.com"   maxlength="50"  style="font:9pt 굴림; line-height:120%; background-color:#ffffff; color:#555555; border:1px solid #cccccc; height:22px; padding:3px 3px 0px 3px; "></td>
	<td rowspan="2" width="4"></td>
	<td rowspan="2"><input type="button" onClick="login_app();" value="로그인"></td>
</tr>
<tr>
	<td  bgcolor="ffffff"><input type="password" name="passwd"  id="password"  style="width:105px;height:22px" class="login_pw" maxlength="50" tabindex="2"  value="1234" ></td>
</tr>
</table>
</form>


<script>
//alert($.browser.version);
function login_app()
{
	$.support.cors = true;
	$.ajax({
		url: "https://api.flextalk.co.kr/auth/local",
		type: "POST",
		dataType: 'json',
		crossDomain: true,

		data: {
			identifier: $("#identifier").val(),
			password: $("#password").val(),
		},
		success: function(data) {
			alert('로그인성공--' + data['user']['username']);

			console.log(data);
		} ,
		error: function(err) {
            if(err.status == 400) {
                var err_data = JSON.parse(err.responseText);
                console.log(err_data);
                console.log(err_data.data[0]['messages'][0]['id']);
                console.log(err_data.data[0]['messages'][0]['message']);
                alert( err_data.data[0]['messages'][0]['message']);
            } else {
                console.log(err);
            }
        }
	});

}
</script>



</html>