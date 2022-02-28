<script>

var objPopup;

function goOpen(){
	objPopup = window.open("test.html","popup","width=200,height=250");
}

function closePopup()
{
		if( objPopup !=null) objPopup.close();
}
</script>

<body onunload="closePopup();"> 

<a href="#" onClick=goOpen()>ÆË¾÷</a>
</body>