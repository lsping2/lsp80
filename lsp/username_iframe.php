<?
require_once "./menu/include/include.php";
$db = new mysql();


   $query = "select bbs_uid from tip_bbs where user_id='$user_id' ";
   $db->query( $query );

?>
<script language="javascript">
	
	function Clearall()
	{
		var count = parent.document.Frm1.sel_branch.options.length;
		for(var i = 0; i < count; i++)
			parent.document.Frm1.sel_branch.options.remove(1);
	}
	
	function AddOption(value, text)
	{
		var oOption = document.createElement("OPTION");
		oOption.text = text;
		oOption.value = value;
		parent.document.Frm1.sel_branch.options.add(oOption);
	}
    
	Clearall();
	parent.document.Frm1.sel_branch.disabled = false;
    

	<? 
    for( $loop=0; $loop<$db->total_record();$loop++ )
	{
		$db->fetch();
		$bbs_uid			= $db->result( 'bbs_uid' );
	?>
	AddOption("<?=$bbs_uid?>", "<?=$bbs_uid?>");
	<?
	}            //end Loop

	?>
</script>     	