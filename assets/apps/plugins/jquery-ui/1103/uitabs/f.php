
<!DOCTYPE html>
<html>
<head>
<title>Tab</title>
<link rel="stylesheet" href="jquery-ui-1.8.16.custom.css">
</head>
<body>
	<div id="tabku">
		<ul>
			<li><a href="#a">Tab 1</a></li>
			<li><a href="#b">Tab 2</a></li>
		</ul>
		<div id="a">Ini isi dari tab 1 yang dilink dari Tab 1</div>
		<div id="b">Ini isi dari tab2 yang akan muncul jika Tab 2  diklik</div>
	</div><!--end of tabku-->
	
	<script src="jquery-1.6.2.js">
	</script>
	<script src="jquery.ui.core.js">
	</script>
	<script src="jquery.ui.widget.js">
	</script>
	<script src="jquery.ui.tabs.js">
	</script>
	<script>
	(function($){
		$("#tabku").tabs();
	})(jQuery);
	</script>

</body>
</html>