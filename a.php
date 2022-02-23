<?
phpinfo();
$T_URL = $_SERVER['DOCUMENT_ROOT'];
include($T_URL."/db_include/include.php");

$PLINE= 2;

$db = new MYSQL();

 $query = "select count(*) as cnt
		   from g5_member a
		   where 1=1
		   $add";

$db->query( $query );

$total_record = $db->is_count();

$max_show_list = $PLINE;
		$max_show_page = 10;

		$total_page = @ceil( $total_record / $max_show_list );

		if( $page <= 0 ) $page = 1;
		if( $total_page < $page ) $page = $total_page;

		$start = $max_show_list * ( $page - 1 );
		if( $start<0 ) $start=0;

		//sf_code_nm('1','COM007',idc) as idc
		$query = "select *
				   from g5_member
			       where 1=1
				   LIMIT $start, $max_show_list";

		$db->query( $query );
?>
<script src="/js/jquery-1.8.3.min.js"></script>
<Script>
function vote(){

	var formData = $("#frm").serialize();

	$.ajax({
			type: "POST",
			url: "a_ajax.php",
			data:formData,
			success: function(data) {
				if (data == 1) {
					//alert();
				}else if ( data == 2){
					alert('�̹� ��ǥ�ϼ̽��ϴ�.');
				}else{
					alert(data);
					return false;
				}
			}
		});
}

</script>
<form name="frm" id="frm" method="post">
   <table class="boardList">
			<thead>
				<tr class="gline">
					<th>No</th>
					<th width="50">ID</th>
					<th>Ȯ��</th>
				</tr>
			</thead>
			<tbody>
			<? if($db->total_record() == 0){ ?>
				<tr>
					<td colspan="20" height="30"><font color="red">�� �ش� �����Ͱ� �����ϴ�.</font></td>
				</tr>
			<?
			}else{
				for( $i=0; $i<$db->total_record();$i++ ){
				$db->fetch();
			?>
				<tr >
					<td ><?=$total_record - ( ( $page - 1 ) * $max_show_list ) - $i?></td>
					<td width="50"><?=$db->result('mb_id')?></td>
					<td><a href="javascript:;" onClick="vote()">[Ȯ��]</a></td>

		        </tr>
			<?
			}
		  }
			?>
		</tbody>
	</table>


	<div class="paging tMar20">
		  <table border="0" cellspacing="0" cellpadding="0" width="600" align="center">
			<tr>
			  <td align="center"><? page_list( $_SERVER["PHP_SELF"], $location ); ?></td>
			</tr>
		  </table>
	</div>

	</form>