<?
include_once('./_common.php');
 $sql = " select gugun  from zipcode      where sido = '".$sido."' group by gugun order by gugun";
$result = sql_query($sql);
?>

<script>
function change_it2(sido,sbjt){
	sido = encodeURI(sido);
	sbjt = encodeURI(sbjt);
	$("#favorite_it2").load('area_sub2.php?sido='+ sido+'&sbjt='+sbjt);

}
</script>
<table>
<tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++)
{
?>
	<td>
		<input type="checkbox" name="gugun_val" class="gugun_val" value="<?=$row['gugun']?>" <? if(in_array($row['gugun'] ,$gugun_arr)) echo "checked";?> onClick="change_it2('<?=$sido?>','<?=$row['gugun']?>');"><?=$row['gugun']?>
	</td>

<?
}
?>
</tr>
</table>

<div id="favorite_it2"></div>


