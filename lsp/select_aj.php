<?
require_once "./menu/include/include.php";
?>
<script>
function CallScript1()
			{
			var Frm1 =document.Frm1;
			Frm1.sel_branch.value='';
			var user_id = document.Frm1.username.options[document.Frm1.username.selectedIndex].value;
			CallBackFra1.location.href = "username_iframe.php?user_id=" + user_id;
			//window.frames["CallBackFra1"].location.href =  "username_iframe.php?user_id=" + user_id;
}

function CallScript2()
			{
				var Frm1 =document.Frm1;
				Frm1.sel_teacher.value='';
				var bbs_uid = document.Frm1.sel_branch.options[document.Frm1.sel_branch.selectedIndex].value;
				//CallBackFra2.location.href = "branch_iframe.php?bbs_uid=" + bbs_uid;
				window.frames["CallBackFra2"].location.href =  "branch_iframe.php?bbs_uid=" + bbs_uid;
}
</script>

  <form name="Frm1" method="post">
<select name="username" onchange="CallScript1()">
	<option value="">회원을 선택해주세요</option>
	<?
			$db = new mysql();
			$query = "SELECT	 user_id,user_name
				FROM	 User_Info
				WHERE	use_status = 'Yes'";
			$db->query( $query );
	?>
<? for( $loop=0; $loop<$db->total_record();$loop++ ) : ?>
			<?	 
			$db->fetch();
			$user_id			= $db->result( 'user_id' );
			$user_name		= $db->result( 'user_name' );
			?>
				<option value="<?=$user_id?>"> <?=$user_name?></option>
<? endfor?>
  </select>		

<select name="sel_branch" onchange="CallScript2()">
					<option value="">전체</option>
		  </select>
<IFRAME name="CallBackFra1" id="CallBackFra1" width="10" Height="5" style="display:none"  ></IFRAME>
  
  
  
<select id="sel_teacher" NAME="sel_teacher" >
							<option value="">선택</option>
							</select>
  <IFRAME name="CallBackFra2" id="CallBackFra2" width="10" Height="5" style="display:none"  ></IFRAME>
  </form>