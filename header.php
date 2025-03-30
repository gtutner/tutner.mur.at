<div class="header-col1">
	<?php
		if ($fx) {
			echo "	<a id=\"headerpic\" href=\"/\" onmouseover=\"mouseoversound.playclip()\">\n";
		} else {
			echo "	<a id=\"headerpic\" href=\"/\">\n";
		}
	?>
						<!-- <img src="pics/tutner4_299x200.jpg" alt="Gernot Tutner" /> -->
						<img src="pics/tutner2008_merged_3_tutner_299x200.jpg" alt="T Noise" />
					</a>
</div>

<div class="header-col2">
	<div class="sitetitle">
		<object type="image/svg+xml" data="styles/NOTUTNER.svg"></object>
	</div>
	<div class="sitesubtitle">from disco to noise</div >
	<div class="headerplayer">
		<audio src="audio/Drones-are-feeding-my-back-to-keep-me-straight_website-cut.mp3" width="250" height="24" controls class="mejs__player" data-mejsoptions='{"features": ["playpause", "volume", "progress"]}'></audio>			
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