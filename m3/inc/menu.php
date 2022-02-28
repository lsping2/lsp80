<button type="button" id="hd_ct">분류</button>

<div id="category">
    <div class="ct_wr">
        <ul class="cate_tab">
            <li><a href="#" class="ct_tab_sl">CATEGORY</a></li>
            <li><a href="./sub1.php">MY PAGE</a></li>
            <li><a href="./sub2.php"">CART</a></li>
        </ul>
         <ul class="cate">
        	<li><a href="./sub1.php" style="color:#099">농장소개</a>
            	 <button class="sub_ct_toggle ct_op">2차메뉴열기</button>
            	<ul class="sub_cate sub_cate1">
                    <li><a href="./sub1.php">- 인사말</a></li>
                    <li><a href="./sub1.php">- 농장시설</a></li>
                    <li><a href="./sub1.php">- 찾아오시는길</a></li>
            
                </ul>
            </li>
        </ul>
        <ul class="cate">
        	<li><a href="./sub1.php" style="color:#099">아로니아란?</a>
          <button class="sub_ct_toggle ct_op">2차메뉴열기</button>
            	<ul class="sub_cate sub_cate1">
                    <li><a href="./sub1.php">- 아로니아란?</a></li>               
                </ul>
            </li>
        </ul>
         <ul class="cate">
        	<li><a href="./sub1.php" style="color:#099">아로니아열매</a>
			  <button class="sub_ct_toggle ct_op">2차메뉴열기</button>
            	<ul class="sub_cate sub_cate1">
                    <li><a href="./sub1.php">- 공지사항</a></li>
				</ul>
			</li>
        </ul>
        <ul class="cate">
        	<li><a href="./sub1.php" style="color:#099">아로니아분말</a>
            </li>
        </ul>
        <ul class="cate">
        	<li><a href="./sub1.php" style="color:#099">커뮤니티 </a>
            <button class="sub_ct_toggle ct_op">2차메뉴열기</button>
            	<ul class="sub_cate sub_cate1">
                    <li><a href="./sub1.php">- 공지사항</a></li>
                    <li><a href="./sub1.php">- 사용후기</a></li>

               </ul>
            </li>
        </ul>
        <button type="button" class="pop_close"><span class="sound_only">카테고리 </span>닫기</button>
    </div>
</div>

<script>
$(function (){
    var $category = $("#category");

    $("#hd_ct").on("click", function() {
        $category.css("display","block");
    });

    $("#category .pop_close").on("click", function(){
        $category.css("display","none");
    });

    $("button.sub_ct_toggle").on("click", function() {
        var $this = $(this);
        $sub_ul = $(this).closest("li").children("ul.sub_cate");

        if($sub_ul.size() > 0) {
            var txt = $this.text();

            if($sub_ul.is(":visible")) {
                txt = txt.replace(/닫기$/, "열기");
                $this
                    .removeClass("ct_cl")
                    .text(txt);
            } else {
                txt = txt.replace(/열기$/, "닫기");
                $this
                    .addClass("ct_cl")
                    .text(txt);
            }

            $sub_ul.toggle();
        }
    });
});
</script>