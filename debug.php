<?php
include 'global.php';
include 'pagehead.html';
?>
<html>
<body class="debug">

	<?php
		#error_reporting(E_ALL);
		f_debug_vardump($a_pages, '$a_pages', 'md');
		f_debug_vardump($a_pics, '$a_pics', 'md');
		f_debug_vardump($a_settings, '$a_settings', '0');
		f_debug_vardump($twitter, '$twitter', '0');
		f_debug_vardump($fx, '$fx', '0');
		f_getdates();
		f_debug_vardump($a_events, '$a_events', 'md');
	?>

</body>
</html>