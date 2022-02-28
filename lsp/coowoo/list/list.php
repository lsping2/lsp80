<?
require_once "../include/include.php";
html_cache_disable();



$db = new MYSQL();

$query1=	"		SELECT	category_thread
				FROM	cd_category

";
$db->query( $query1 );
$db->fetch();
$thread = $rs_category_thread = $db->result( 'category_thread' );


//$thread_length = strlen( $thread ) + 3;
//length( category_thread ) = $thread_length

$query="		SELECT	category_no,
					category_gid,
					category_thread,
					category_name,
					reg_date
			FROM	cd_category
			WHERE	category_thread LIKE '$thread%'
			ORDER BY category_gid DESC , category_thread ASC
	";


$db->query( $query );

//$thread=strlen($category_thread);

?>

<form name=frm method=post action=write.php>
category_title : <input type=text name="category_title"> <input type=submit value="등록">
</form>




	<table border=1 cellpadding=0 cellspacing=1>
		<tr>
			<td  width=80 height=25><b>category_gid</b></td>
			<td  width=200><b>category_thread</b></td>
			<td  width=300><b>category_name</b></td>
			<td  width=200><b>reg_date </b></td>
		</tr>





<? for( $loop=0; $loop<$db->total_record();$loop++ ) : ?>

<?
		$db->fetch();
		$rs_category_no		= $db->result( 'category_no' );
		$rs_category_name		= htmlspecialchars( $db->result( 'category_name' ) );
		$rs_category_gid		= $db->result( 'category_gid' );
		$rs_category_thread	= $db->result( 'category_thread' );
		$rs_reg_date			= $db->result( 'reg_date' );

		


		$thread=strlen($rs_category_thread)-3;//길이구함


			if ( $rs_category_gid > 0 ) //가상이미지로 넓이값지정하여 그만큼의 넓이를 띄어준다
				{
					$strIndent = "<img src='1.gif' border='0' align='absmiddle' width='".($thread*10)."' height='1'>";
				} 
			else {
					$strIndent = "";
				}


?>

		<tr>
			<td  width=80 height=25><?= $rs_category_gid ?></td>
			<td  width=200><?= $rs_category_thread ?></td>
			<td  width=300><a href="reply.php?category_gid=<?= $rs_category_gid  ?>&category_thread=<?= $rs_category_thread ?>"><?=$strIndent?><?= $rs_category_name ?></a></td>
			<td  width=200><?= $rs_reg_date ?></td>
		</tr>
<? endfor ?>



</table>

	