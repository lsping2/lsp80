<?
$loop=0;
?>
<? for($i=0;  $i<18  ;$i++) :?>

<?
if ( $i == 0 ){
?>

		
		<table width="780" border="0" cellspacing="0" cellpadding="0">
		<Tr>
<?
}
?>
			<td>
				<table width="350" border="0" cellspacing="0" cellpadding="0">
				<tr>	
					<td><?=$i?></td>
				<tr>
				</table>
			</td>


<?if($i%2==1){?> <?// [by lsp]?>
						</tr>
						<tr><td height="1" colspan="3" bgcolor="#e9e9e9"></td></tr>
						<tr>
<?}?>
<?if(18==$loop){?><?//마지막에 닫아주기?>
			<td width='' align='center'></td>
		</tr>

			</table>
<?
}
?>
<?
$loop++;
?>
<? endfor ?>