<?
include_once('../common.php');
?>
<meta charset="utf-8">
<?
  $sql = " insert into test
                set subject = '성공',
					  reg_date = now()
				";
 sql_query($sql);
?>