<?
$T_URL = $_SERVER['DOCUMENT_ROOT'];
include($T_URL."/lsp/coowoo/include/include.php");

?>
<meta charset="utf-8">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
<script>
function mod_it(){


      serial=$('#SlideshowOne').sortable('serialize');
      $.ajax({
        url: "drag_exec.php",
        type:"post",
        data:serial,
        error:function(){
          alert("theres an error with AJAX")
        }
      })



}
</script>

 <script>
  $(function() {
    $( "#SlideshowOne" ).sortable({
      revert: true
    });
    
    $( "ul, li" ).disableSelection();
  });
  </script>
 <form name="form" method="post">
<ul id="SlideshowOne">
	<?php
	
$db = new MYSQL();

  $query = "select bbs_uid,subject 
				   from	tip_bbs 
			     ORDER BY bbs_uid";
								
		$db->query( $query );


for( $i=1; $i<=$db->total_record();$i++ ){
	$db->fetch();

			echo '<li id="p_headerimages_'.$db->result('bbs_uid').'" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span> '. $db->result('subject') .'----'. $db->result('bbs_uid').' </li>';



		}
?>
	</ul>

 <input type="button" onClick="mod_it()";>

 </form>
