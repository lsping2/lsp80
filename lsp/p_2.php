<html>
<head>
<script language="javascript">
    var testCnt = 1;
    var pop = new Array();
    function openChild() {
        for (var i = 0 ; i < testCnt ; i++) {
            pop[i] = window.open("./p_2.php", "ch"+i, "height=200,width=200");
        }
    }
    function closeChild() {
        for (var i = 0 ; i < pop.length ; i++) {
            if (pop[i] && pop[i].open && !pop[i].closed) {
                pop[i].close();
            }
        }
    }

	function init()
	{
		top.focus();
		alert();
	}
</script>
</head>
<body onUnload="closeChild();" onload=init();>
    <input type="button" value="ø¿«¬" onclick="openChild();" />

	<a href="./p_2.php">√¢¿Ãµø</a>
</body>
</html>
