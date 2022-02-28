#! /usr/local/bin/php
<?


for($i=174;$i<=178;$i++)
{
 exec("mkdir TNG{$i}/thum");
 exec("mv TNG{$i}/* TNG{$i}/thum/");
 echo "mv TNG{$i}/* TNG{$i}/thum/\n";
}

?>
