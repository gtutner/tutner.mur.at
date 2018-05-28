<div class="konsole">
	<div class="konsole-header">
		<img class="konsole-header" src="styles/terminal.png" />
		<span class="konsole-header">tutner.mur.at - Konsole</span>
		<div class="konsole-header-windowctrl">
			<ul class="konsole-header-windowctrl">
				<li class="konsole-header-windowctrl">_</li>
				<li class="konsole-header-windowctrl"><a href="debug.php">-</a></li>
				<li class="konsole-header-windowctrl">X</li>
			</ul>
		</div>
	</div>
	<div class="konsole-body">
		<div class="konsole-line">login as: anonymous</div>
		<div class="konsole-line">Password:</div>
		<div class="konsole-line"></div>
		<div class="konsole-line">anonymous@tutner.mur.at:~$ variables.sh</div>
		<div class="konsole-line"></div>
		<div class="konsole-line"></div>
		<div class="konsole-line">error_reporting = <?php echo error_reporting(); ?></div>
		<div class="konsole-line">$konsole = <?php echo $konsole; ?></div>
		<div class="konsole-line">$lang = <?php echo $lang; ?></div>
		<div class="konsole-line">$pagesfolder = <?php echo $pagesfolder; ?></div>
		<div class="konsole-line">$picsfolder = <?php echo $picsfolder; ?></div>
		<div class="konsole-line">$page = <?php echo $page; ?></div>
		<div class="konsole-line">$pagelink = <?php echo $pagelink; ?></div>
		<div class="konsole-line">$pageexists = <?php echo $pageexists; ?></div>
		<div class="konsole-line">$pagefilename = <?php echo $pagefilename; ?></div>
		<div class="konsole-line">$pagetitle = <?php echo $pagetitle; ?></div>
		<div class="konsole-line">$pageheader = <?php echo $pageheader; ?></div>
		<div class="konsole-line">$pagepic = <?php echo $pagepic; ?></div>
		<div class="konsole-line">$pagepiclink = <?php echo $pagepiclink; ?></div>
		<div class="konsole-line">$pagepicexists = <?php echo $pagepicexists; ?></div>
		<div class="konsole-line">$pagepicalt = <?php echo $pagepicalt; ?></div>
		<div class="konsole-line">$twitter = <?php echo $a_settings['twitter']; ?></div>
		<div class="konsole-line">default time zone: <?php echo date_default_timezone_get(); ?></div>
		<!--
		<div class="konsole-line">date from id1 = <?php echo strtotime($a_events[1][1]); ?></div>
		-->
		<div class="konsole-line"></div>
		<div class="konsole-line">anonymous@tutner.mur.at:~$ cookies.sh</div>
		<div class="konsole-line"></div>
		<div class="konsole-line">
			<?php
				echo "rock = ";
				if (isset($_COOKIE['rock'])) {
					echo $_COOKIE['rock'];
				} else {
					echo "NOTSET";
				}
			?>
		</div>
		<div class="konsole-line">
			<?php
				echo "lang = ";
				if (isset($_COOKIE['lang'])) {
					echo $_COOKIE['lang'];
				} else {
					echo "NOTSET";
				}
			?>
		</div>
		<div class="konsole-line">
			<?php
				echo "konsole = ";
				if (isset($_COOKIE['konsole'])) {
					echo $_COOKIE['konsole'];
				} else {
					echo "NOTSET";
				}
			?>
		</div>
		<div class="konsole-line">
			<?php
				echo "twitter = ";
				if (isset($_COOKIE['twitter'])) {
					echo $_COOKIE['twitter'];
				} else {
					echo "NOTSET";
				}
			?>
		</div>
	</div>
</div>