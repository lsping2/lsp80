	<script type="text/javascript">
		document.domain = "<?=$_SERVER['HTTP_HOST']?>";

		window.onload = function() {
			var objParams = window.location.search.substring(1).split('&');

			var objHeight ="<?=$_REQUEST['height']?>";
			for(var i = 0, l = objParams.length; i < l; ++i) {
				var objParts = objParams[i].split('=');
				switch (objParts[0]) {
					case 'height':
						objHeight = parseInt(objParts[1]);
						break;
				}
			}
			if(typeof (objHeight) == 'number') {

				parent.parent.dreamcoinFrameResize(objHeight);
			}
		};
	</script>

