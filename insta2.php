<?
//ini_set("allow_url_fopen","1");
?>
<style type="text/css">  

		img {width:181px;height:181px}
		.insta-box {  
		 position: relative;  
		 width: 181px;  
		 height: 181px;  
		 float: left;  
		 margin: 2px;  
		 border: none;  
		}  
</style>
<script src='//code.jquery.com/jquery-1.11.0.min.js'></script>
<script type="text/javascript">  

$(function(){
    
        var tocken = "6614370.f3df65e.ba309f50d8bf41f2948484b37a9c3dcb"; /* Access Tocken 입력 */  
        var count = "16";  
        $.ajax({  
            type: "GET",  
            dataType: "jsonp",  
            cache: false,  
            url: "https://api.instagram.com/v1/users/self/media/recent/?access_token=" + tocken + "&count=" + count,  
            //resolution : "standard_resolution",
            success: function(response) {  

             if ( response.data.length > 0 ) {  
                  for(var i = 0; i < response.data.length; i++) { 
                       var insta = '<div class="insta-box">';  
                       insta += "<a target='_blank' href='" + response.data[i].link + "'>";  
                       insta += "<div class'image-layer'>";  
                       insta += '<img src="' + response.data[i].images.thumbnail.url + '" style="width:100%">';  
                       insta += "</div>";  
                       if ( response.data[i].caption !== null ) {  
                            insta += "<div class='caption-layer'>";  
                            if ( response.data[i].caption.text.length > 0 ) {  
                                 insta += "<p class='insta-caption'>" + response.data[i].caption.text + "</p>"  
                            }  
                            insta += "<span class='insta-likes'>" + response.data[i].likes.count + "Like</span>";  
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
                  //$(this).find(".caption-layer").css({"display":"none"});  
             });  
            }  
           });
    });

</script>

<div id="instaPics"></div>