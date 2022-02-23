 <?
include_once('./_common.php');
$sql = " select dong  from zipcode      where sido = '".$sido."' and gugun= '".$sbjt."'  order by gugun";
$result = sql_query($sql);
?>

<table>
<tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++)
{
?>
	<td>
		<input type="checkbox" name="dong_val" class="dong_val" value="<?=$row['dong']?>" <? if(in_array($row['gugun'] ,$dong_arr)) echo "checked";?>><?=$row['dong']?>
	</td>

<?
}
?>
</tr>
</table>

<div id="favorite_it2"></div>


