<?php
include 'settings.php';
include 'global.php';

include 'pagehead.html';
?>

<body>

<div class="header">
<?php include 'header.php'; ?>
</div>

<div id="main">
	<div id="main-left">
		<?php f_pageheader(); ?>
		<?php f_insertpage(); ?>
	</div>
	
	<div class="main-right">
		<?php f_twitterwidget(); ?>
	</div>
			
</div>
	
<div class="footer">
	<?php include 'footer.html'; ?>
</div>

</body>
</html>