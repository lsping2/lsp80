<meta charset="utf-8">
<?
$name1 = array("김","이","최","장","임","권","이","김","이","김");
$name2 = array("정","영","우","성","민","진","태","승","예","서");
$name3 = array("호","미","혜","지","용","수","현","재","선","주","근","연","남","철");

shuffle($name1);
shuffle($name2);
shuffle($name3);
$name = $name1[0].$name2[0].$name3[0];
echo $name ;
?>
