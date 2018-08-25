<div class="header-col1">
	<?php
		if ($fx) {
			echo "	<a id=\"headerpic\" href=\"/\" onmouseover=\"mouseoversound.playclip()\">\n";
		} else {
			echo "	<a id=\"headerpic\" href=\"/\">\n";
		}
	?>
						<img src="pics/tutner4_299x200.jpg" alt="Gernot Tutner" />
					</a>
</div>

<div class="header-col2">
	<div class="sitetitle">Gernot Tutner</div>
	<div class="sitesubtitle">from disco to noise</div >
	<div class="headerplayer">
		<audio src="audio/tutner_-_nim_-_2014-08-27_-_section5.mp3" width="250" height="24" controls class="mejs__player" data-mejsoptions='{"features": ["playpause", "volume", "progress"]}'></audio>			
	</div>
	<div class="feature">
			<span class="feature-title">
				NEXT:
			</span>
			<span>
				<?php include 'data/next.txt'; ?>
			</span>			
	</div>
	<div>
		<div class="topnavi">
			<?php include 'top-navi.html'; ?>
		</div>
		<div class="header-buttons">
			<?php f_header_switches(); ?>
		</div>
	</div>
</div>

<div class="header-col3">
	<?php
		if ($konsole) {
		include 'konsole.php';
		}
	?>
</div>

<div class="seperator"></div>