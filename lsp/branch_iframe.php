<?
require_once "./menu/include/include.php";
$db = new mysql();


   $query = "select subject from tip_bbs where bbs_uid='$bbs_uid' ";
   $db->query( $query );

?>
<script language="javascript">
	
	function Clearall()
	{
		var count = parent.document.Frm1.sel_teacher.options.length;
		for(var i = 0; i < count; i++)
			parent.document.Frm1.sel_teacher.options.remove(1);
	}
	
	function AddOption(value, text)
	{
		var oOption = document.createElement("OPTION");
		oOption.text = text;
		oOption.value = value;
		parent.document.Frm1.sel_teacher.options.add(oOption);
	}
    
	Clearall();
	parent.document.Frm1.sel_teacher.disabled = false;

	<? 
    for( $loop=0; $loop<$db->total_record();$loop++ )
	{
		$db->fetch();
		$subject			= $db->result( 'subject' );
	?>
	AddOption("<?=$subject?>", "<?=$subject?>");
	<?
	}            //end Loop

	?>
</script>     	