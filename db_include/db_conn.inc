<?
    $db_host = '211.196.153.6' ;
    $db_user = 'vcbank_wave' ;
    $db_passwd = 'wave2007' ;
    $db_name = 'vcbank_wave' ;

    $mylink = @mysql_connect($db_host, $db_user, $db_passwd);
    if (!$mylink) {
        die('Could not connect: ' . mysql_error());
    }

    @mysql_query("SET NAMES utf8",$mylink);
    @mysql_select_db($db_name);

    function debug_r($_xValue) {
        if($_SERVER["REMOTE_ADDR"] == "121.129.198.81" or $_SERVER["REMOTE_ADDR"] == "121.129.198.61") {
            echo "<xmp>debug_r()\r\n";
            print_r($_xValue);
            echo "</xmp>";
        } else {
            echo "<!-- +++ ";
            print_r($_xValue);
            echo " +++ -->";
        }
    }

?>

