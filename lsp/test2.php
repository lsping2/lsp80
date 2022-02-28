<?
$db_host = 'localhost' ;
$db_user = 'lsp80' ;
$db_passwd = 'lovelove' ;
$db_name = 'lsp80' ;

$db_conn = mysql_connect("$db_host","$db_user","$db_passwd");
mysql_select_db ("$db_name", $db_conn);

echo $query="select * from  test3  order by  c_id desc, depth asc" ;
$result=mysql_query($query, $db_conn);


?>
<!-- bgproperties="fixed" oncontextmenu="return false" ondragstart="return false" onselectstart="return false" -->
<BODY topmargin="0" leftmargin="0" > 


<TABLE border="1"  cellspacing="0" cellpadding="0" width="300" height="300" bgcolor="#BBBBBB">
<tr  valign="top">
<td>
<TABLE border="1" cellspacing="0" cellpadding="0" width="300" height="50">

</table>
<TABLE  border="1" valign="top" cellspacing="0" cellpadding="0" width="300" height="300">
<?
while($row=mysql_fetch_array($result))
{

$query2="select board_idx as max from test3 where c_id = '$row[c_id]' and level> $row[level] and depth =  '$row[depth]' group by c_id " ; 
$result2=mysql_query($query2, $db_conn);
$row2 = mysql_fetch_array($result2);


?>
  <tr><td>

<?
  if($row["level"]>0)// ' 레벨이 0보다 크다면 즉 질문글이 아닌 답변글이라면   
  {
   for($j =1;$j<=$row["level"];$j++)// ' 레벨수만큼 들여쓰기   
    {
      
    echo "&nbsp;";
    }
    if ( $row2['max']  ){
  echo "|";
    }else{
      echo "@  ";
    }

  }else
  {
  echo "|";

  }
?>
  <?=$row[name]?>
  </td>
  </tr>
  <?
}
?>
</table>
</td>
</tr>
</TABLE>