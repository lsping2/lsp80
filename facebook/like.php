<script src='https://connect.facebook.net/en_US/all.js'></script>
<!-- Load javascript facebook connector -->
<script>
    FB.init({
            //appId : '207449892662791',
			appId :'161677497215358',
            status : true, // check login status
            cookie : true, // enable cookies to allow the server to access the session
            xfbml : true // parse XFBML
    });
</script>

<script type="text/javascript">
    function getToken(){
    FB.login(function(response) {
        if (response.authResponse) {
            var access_token = response.authResponse.accessToken;
            window.location="<?=$_SERVER['PHP_SELF'];?>?accessToken="+access_token;
        } else {
            return false;
        }
    }, {scope:'user_likes,friends_likes'});
}
</script>



<body onload="getToken()">
test
</body>