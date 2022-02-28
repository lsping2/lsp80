<?
//ini_set("allow_url_fopen","1");
//https://instagram.com/oauth/authorize/?client_id=f3df65e941b948ac8c79cf538051ef9a&redirect_uri=http://lsp80.cafe24.com&response_type=token
//http://lsp80.cafe24.com/#access_token=6734102224.ad09518.85c0f6120b514f2d80d31e2ca2730896
//인스타계정 lsping@naver.com

  $curl = curl_init("6614370.f3df65e.ba309f50d8bf41f2948484b37a9c3dcb");    
  curl_setopt($curl,CURLOPT_POST,true); 
  curl_setopt($curl,CURLOPT_POSTFIELDS,array(
          'client_id'                =>     ' 	f3df65e941b948ac8c79cf538051ef9a',
          'client_secret'            =>     'b37761a5a99c42c8934fbebecb9b3b14',
          'grant_type'               =>     'authorization_code',
          'redirect_uri'             =>     'http://lsp80.cafe24.com/',
          'code'                     =>     $_GET['code']
  )); 
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($curl);
  curl_close($curl);

  $result = json_decode($result,true);
  

  print_r( $result[access_token] );
  // 아래만 등록해도 가능

  ?>
<html>
	<head>	
	<meta http-equiv="Content-Type" conent="text/html"; charset="euc-kr">
	<title>.</title>
	<style type="text/css">  
		#instaPics {  
		 max-width: 1100px;  
		 overflow: hidden;  
		} 
		img {width:181px;height:181px}
		.insta-box {  
		 position: relative;  
		 width: 181px;  
		 height: 181px;  
		 float: left;  
		 margin: 2px;  
		 border: none;  
		}  
		.image-layer {  
		 overflow: hidden;  
		 width: 100%;  
		 height: 100%;  
		}  
		.image-layer img {  
		 max-width: 100%;  
		}  
		.caption-layer {  
		 display: none;  
		 position: absolute;  
		 top: 0;  
		 background: rgba(255,255,255,0.8);  
		 height: 100%;  
		 width: 100%;  
		 padding: 10px;  
		 box-sizing: border-box;  
		 font-size: 9px;  
		 color: #333;  
		}  
		.insta-likes {  
		 float: right;  
		}  
	</style> 
	<script src='//code.jquery.com/jquery-1.11.0.min.js'></script>
	<script type="text/javascript">  
		 jQuery(function($) {  
		 var tocken = "6614370.f3df65e.ba309f50d8bf41f2948484b37a9c3dcb"; 	
		 var count = "30";  
		 $.ajax({  
		  type: "GET",  
		  dataType: "jsonp",  
		  cache: false,  
		  url: "https://api.instagram.com/v1/users/self/media/recent/?access_token=" + tocken + "&count=" + count, success: function(response) {  
		   if ( response.data.length > 0 ) {  
			 for(var i = 0; i < response.data.length; i++) {  
			   var insta = '<div class="insta-box">';  
			   insta += "<a target='_blank' href='" + response.data[i].link + "'>";  
			   insta += "<div class'image-layer'>";  
			   //insta += "<img src='" + response.data[i].images.thumbnail.url + "'>";  
			   insta += '<img src="' + response.data[i].images.thumbnail.url + '">';  
			   insta += "</div>";  
			   //console.log(response.data[i].caption.text);  
			   if ( response.data[i].caption !== null ) {  
			  insta += "<div class='caption-layer'>";  
			  if ( response.data[i].caption.text.length > 0 ) {  
				insta += "<p class='insta-caption'>" + response.data[i].caption.text + "</p>"  //내용
			  }  
			 // insta += "<span class='insta-likes'>" + response.data[i].comments.count + "댓글 " + response.data[i].likes.count + " Likes</span>";  //comment=댓글, likes=좋아요
			  insta += "</div>";  
			   }  
			   insta += "</a>";  
			   insta += "</div>";  
			   $("#instaPics").append(insta);  
			 }  
		   }  
		   $(".insta-box").hover(function(){  
			 $(this).find(".caption-layer").css({"backbround" : "rgba(255,255,255,0.7)", "display":"block"});  
		   }, function(){  
			 $(this).find(".caption-layer").css({"display":"none"});  
		   });  
		  }  
			});  
		});  
	</script>  
	</head>
	<body>
		<div id="instaPics"></div>
	</body>
</html>

