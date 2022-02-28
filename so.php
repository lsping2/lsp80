<script type='text/javascript' src='/js/jquery-1.8.3.min.js'></script>
<!--- sns 공유 start --->

    <?
    $http_host = $_SERVER['HTTP_HOST'];
    $request_uri = $_SERVER['REQUEST_URI'];
    $url = 'http://' . $http_host . $request_uri;
    $url_share = urlencode($url);
    $title = 'test';
    $title_share = urlencode($title);
    $img_url = $img_folder."/".$img_main_use_name;
    ?>
    <script src="/js/clipboard.min.js"></script>
    <script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
    <script>

    console.log(Kakao.isInitialized());

    function kakao_share() {
        alert('카톡');
      }

    function is_ie() {
    if(navigator.userAgent.toLowerCase().indexOf("chrome") != -1) return false;
    if(navigator.userAgent.toLowerCase().indexOf("msie") != -1) return true;
    if(navigator.userAgent.toLowerCase().indexOf("windows nt") != -1) return true;
    return false;
    }
    function copy_to_clipboard(str) {
        if( is_ie() ) {
            window.clipboardData.setData("Text", str);
            alert("복사되었습니다.");
            return false;
        }

        prompt("Ctrl+C를 눌러 복사하세요.", str);
    }

    </script>

    <input type="hidden" name="url" id="url" value="https://share.naver.com/web/shareView?url=<?=$url_share?>&title=<?=$title_share?>">
    <input type="hidden" name="title" id="title" value="<?=$title?>">

    <a href="javascript:;" class="btn_sns_share">[공유하기]</a>
    <br>내용내용내용내용내용내용내용내용내용내용
    <br>내용내용내용내용내용내용내용내용내용내용
    <br>내용내용내용내용내용내용내용내용내용내용
<style>
#sit_btn_opt {position:absolute;right:0;bottom:0}

#sit_btn_opt .btn_sns_share {float:left;background:transparent;width:35px;height:25px;border:0;color:#4b5259;font-size:1.6em;font-weight:bold}
#sit_btn_opt .btn_sns_share:hover {color:#3a8afd}
#sit_btn_opt .sns_area {display:none;top:45px;right:0;max-width:175px;text-align:center;background:#fff;border:1px solid #e2e2e2;padding:10px;z-index:10}
#sit_btn_opt .sns_area:before {content:"";position:absolute;top:-8px;right:13px;width:0;height:0;border-style:solid;border-width:0 6px 8px 6px;border-color:transparent transparent #e2e2e2 transparent}
#sit_btn_opt .sns_area:after {content:"";position:absolute;top:-7px;right:13px;width:0;height:0;border-style:solid;border-width:0 6px 8px 6px;border-color:transparent transparent #fff transparent}
#sit_star_sns .sns_area a 
</style>
<div id="sit_btn_opt">
<div class="sns_area">
						<!--  블로그,카페 -->
						<span>
							<script type="text/javascript" src="https://ssl.pstatic.net/share/js/naver_sharebutton.js"></script>
							<script type="text/javascript">
							new ShareNaver.makeButton({"type": "d"});
							</script>
						</span>
						<!--  밴드 -->
						<span>
							<script type="text/javascript" src="//developers.band.us/js/share/band-button.js?v=04062021"></script>
							<script type="text/javascript">
								new ShareBand.makeButton({"lang":"ko","type":"c"});
							</script>
						</span>
						<!--  카톡 -->
						<a href="javascript:;" onClick="kakao_share()"><img src="/images/icon/kakaotalk.png" border="0" id="kakao"></a>
						<!--  url -->
						<span style="cursor:pointer;" onclick="copy_to_clipboard('<?=$url?>')"><img src="/images/icon/url.png" border="0"></span>
</div>
</div>
						<!--- 공유 end --->

<script>
$(".btn_sns_share").click(function(){
    $(".sns_area").show();
});
$(document).mouseup(function (e){
    var container = $(".sns_area");
    if( container.has(e.target).length === 0)
    container.hide();
});
</script>