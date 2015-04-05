<?php

# DEFAULTS / SETUP / INIT

$pagesfolder = $a_settings['pagesfolder'];
$picsfolder = $a_settings['picsfolder'];
$datafolder = $a_settings['datafolder'];
$twitter = (boolean) $a_settings['twitter'];
$konsole = (boolean) $a_settings['konsole'];
$lang = $a_settings['lang'];
$fx = (boolean) $a_settings['fx'];

## Cookies
### Konsole
$konsole = (boolean) f_vargetcookie('konsole',$konsole);
### Twitter
$twitter = (boolean) f_vargetcookie('twitter',$twitter);
### Language
$lang = f_vargetcookie('lang',$lang);

/*
LIST OF FUNCTIONS

A descripion of the functions is at the end of this document.

f_vargetcookie ($x,$cv)					...	Retrieve or set Cookie
f_header_switches ()					...	Write HTML for header switches (Terminal, Twitter)
f_pageheader ()							...	Write HTML for page (article) header (title and language buttons on top)
f_pageswitches ($page)					...	Write HTML for page (article) switches (language)
f_insertpage ()							...	Insert page :)
f_audioplayer ($audiofile)				... Audio player
f_pagepic ()							...	Insert page image
f_getcsv ($csvfile)						...	Get data from dates.csv (events)
f_chron ()								... Process events data (sort, write HTML)
f_twitterwidget()						... Insert Twitter widget (or not)
f_konsole()								... Insert Konsole konsole.php (or not)
f_debug_vardump($array, $name, $mode)	... Ausgabe von Variablen und Arrays

*/

/*
if [isset[$_COOKIE['rock']]] {
	if [$_COOKIE['rock'] == 'roll'] {
		error_reporting[E_ALL];
		$konsole = 'on';
	}
}
*/

/* Pages */
$a_pages = f_getcsv("{$datafolder}/pages.csv");
foreach($a_pages as $key => $value) {
	$a_pages[$key] = array (
		"title" => $a_pages [$key][1],
		"de" => $a_pages[$key][2],
		"en" => $a_pages[$key][3],
		"pic" => $a_pages[$key][4]
	);
}

/* Pics */
$a_pics = f_getcsv("{$datafolder}/pics.csv");
foreach($a_pics as $key => $value) {
	$a_pics[$key] = array (
		"full" => $a_pics [$key][1],
		"small" => $a_pics[$key][2],
		"alt" => $a_pics[$key][3],
	);
}

/** Events **/

$a_eventmodel = array();
$a_eventmodel[0] = 'id';
$a_eventmodel[1] = 'cat';
$a_eventmodel[2] = 'location';
$a_eventmodel[3] = 'city';
$a_eventmodel[4] = 'event';

/** Page **/
if (isset($_GET['page'], $a_pages[$_GET['page']])) {
	$page = $_GET['page'];
} else {
	$page = 'frontpage';
}

/** Page Link **/
// Sprachen-Fallback
if ($a_pages[$page][$lang] != "") {
			$pagelink = $pagesfolder . '/' . $a_pages[$page][$lang];
		} else {
			if ($a_pages[$page]['de'] != "") {
				$pagelink = $pagesfolder . '/' . $a_pages[$page]['de'];
			} else {
				if ($a_pages[$page]['en'] != "") {
				$pagelink = $pagesfolder . '/' . $a_pages[$page]['en'];
				} else {
				$pagelink = "";
				}
			}
		}
		
/** pageexists **/
if ($pagelink == "") {
	$pageexists = 0;
	} elseif (file_exists($pagelink)) {
		$pageexists = 1;	
	} else {
		$pageexists = 0;
}

/** Page Title **/
if ($a_pages[$page]['title'] != "") {
	$pagetitle = $a_pages[$page]['title'];
} else {
	$pagetitle = "";
}

/** Page Header **/
if (($pagetitle != "") || (($a_pages[$page]['de'] != "") && (($a_pages[$page]['en'] != "")))) {
	$pageheader = 1;
} else {
	$pageheader = 0;
}

/** Page Pic **/
$pagepiclink = 'none';
$pagepicalt = 'pic';
$pagepicexists = 0;
if (isset($a_pages[$page]['pic'])) {
	$pagepic = $a_pages[$page]['pic'];
} else {
	$pagepic = 'none';
}

/** Audio Player ID **/
$audioplayerid = 0;

/*************/
/* FUNCTIONS */
/*************/

function f_vargetcookie ($x,$cv) {
	if (isset($_GET[$x])) {
		setcookie($x, $_GET[$x]);
		return($_GET[$x]);
	} elseif (isset($_COOKIE[$x])) {
		return($_COOKIE[$x]);
	} else {
		return($cv);
	}
}

function f_header_switches () {
	global $page, $twitter, $konsole, $fx;
	echo "		<ul>\n";
	echo "			<li>\n";
	if ($twitter) {
		echo "			<a href=\"?page={$page}&twitter=0\">\n";
		echo "				<img src=\"styles/button_header_twitter_blink.gif\" title=\"TWITTER OFF\" />\n";
	} else {
		echo "			<a href=\"?page={$page}&twitter=1\">\n";
		echo "				<img src=\"styles/button_header_twitter.png\" title=\"TWITTER ON\"/ >\n";
	}
	echo "				</a>\n";
	echo "			</li>\n";
	echo "			<li>\n";
	if ($fx) {
		echo "			<img id=\"b_speaker\" src=\"styles/button_speaker_on.png\" title=\"FX OFF\"/ onclick=\"fx(0)\" >\n";
	} else {
		echo "			<img id=\"b_speaker\" src=\"styles/button_speaker_off.png\" title=\"FX ON\"/ onclick=\"fx(1)\" />\n";
	}
	echo "			</li>\n";
	echo "			<li>\n";
	if ($konsole) {
		echo "			<a href=\"?page={$page}&konsole=0\">\n";
		echo "				<img src=\"styles/terminal_big_blink.gif\" title=\"KONSOLE OFF\"/ />\n";
	} else {
		echo "			<a href=\"?page={$page}&konsole=1\">\n";
		echo "				<img src=\"styles/terminal_big.png\" title=\"KONSOLE ON\"/ />\n";
	}
	echo "				</a>\n";
	echo "			</li>\n";
}

function f_pageheader () {
	global $pageheader, $page, $pagetitle;
	
	if ($pageheader) {
		
		echo "<div class=\"pageheader\">\n";
		
		if ($pagetitle != 'none') {
			echo "<div class=\"title\">\n";
			echo "file: /{$pagetitle}";
			echo "</div>\n";
		}
		
		f_pageswitches($page);
		
		echo "</div>\n";		
	}
}

function f_pageswitches ($page) {
	global $a_pages, $lang;
	if (($a_pages[$page]['de'] != "") && ($a_pages[$page]['en'] != "")) {
		// Language Switches
		echo "<div class=\"page-lang\">\n";
		echo "	<ul class=\"page-lang\">\n";
		echo "		<li class=\"page-lang-active\">\n";
		echo "			{$lang}\n";
		echo "		</li>\n";
		if ($lang == 'de') {
			echo "	<li class=\"page-lang\">\n";
			echo "		<a class=\"page-lang\" href=\"?page={$page}&lang=en\">en</a>\n";
		} else {
			echo "	<li class=\"page-lang\">\n";
			echo "		<a class=\"page-lang\" href=\"?page={$page}&lang=de\">de</a>\n";
		}
		echo "	</ul>\n";
		echo "</div>\n";
	}
}

function f_insertpage () {
	global $pagelink, $pageexists;
	
	f_pagepic();
	
	if (($pagelink != 'none') && $pageexists) {
		include $pagelink;
	} else {
		echo "file not found";
	}
}

function f_audioplayer ($audiofile) {
	global $audioplayerid;
	
	$audioplayerid = $audioplayerid + 1;
	
	echo "	<p id=\"audioplayer{$audioplayerid}\"></p>\n";
	echo "	<script type=\"text/javascript\">\n";
	echo "		AudioPlayer.embed(\"audioplayer{$audioplayerid}\", {soundFile: '{$audiofile}'});\n";
	echo "	</script>";
}

function f_pagepic () {
	
	global $pagepic, $a_pics, $pagepiclink, $picsfolder, $pagepicexists, $pagepicalt;
	
	if ($pagepic != 'none' && isset($a_pics[$pagepic]['small'])) {
		$pagepiclink = $picsfolder . '/' . $a_pics[$pagepic]['small'];
		if (file_exists($pagepiclink)) {
			$pagepicexists = 1;
			if (isset($a_pics[$pagepic]['alt'])) {
				$pagepicalt = $a_pics[$pagepic]['alt'];
			} else {
				$pagepicalt = 'pic';
			}
		} else {
			$pagepicexists = 0;
		}
	}
	if ($pagepicexists) {
		echo "<div class=\"page-img\">\n";
		echo "	<img class=\"page-img\" src=\"{$pagepiclink}\" alt=\"{$pagepicalt}\" />\n";
		echo "</div>\n";
	}
}

function f_getcsv ($csvfile) {
	if (($handle = fopen($csvfile, "r")) !== FALSE) {
		fgetcsv($handle, ","); // to skip first row
		$i = 0;
		while (($a_data[$i] = fgetcsv($handle, ",")) !== FALSE) {
			$a_data_id[$i] = $a_data[$i][0];
			unset($a_data[$i][0]);
			$i++;
		}
		fclose($handle);
		array_splice($a_data, -1); //remove last row
		$a_data = array_combine($a_data_id, $a_data);
		return $a_data;
	}
}

function f_getdates () {
	global $a_events;
	$i = 0;
	if (($handle = fopen("data/dates.csv", "r")) !== FALSE) {
		fgetcsv($handle, ","); // to skip first row
		while (($a_events[$i] = fgetcsv($handle, ",")) !== FALSE) {
			$i++;
		}
		fclose($handle);
		array_splice($a_events, -1); //remove last row
	}
}

function f_chron () {
	global $a_events;
	f_getdates();
	foreach ($a_events as $key => $row) {
		$a_events[$key][0] = DateTime::createFromFormat('Y-m-d',$a_events[$key][0]);
		$a_events[$key][0] = date_format($a_events[$key][0], 'Y-m-d');
		//$datefrom[$key] = $row[1];
	}
	$rows = count($a_events);
	echo "<table class=\"page-main\">\n";
	echo "	<tbody>\n";
	for ($r=0; $r < $rows; $r++) {
		echo "	<tr class=\"page-main\">\n";
		$fields = count($a_events[$r]);
		for ($f=0; $f < $fields; $f++) {
			echo "	<td class=\"page-main\">{$a_events[$r][$f]}</td>\n";
		}
		echo "	</tr>\n";
	}
	echo "	</tbody>";
	echo "</table>";
}

function f_twitterwidget() {
	global $twitter;
	if ($twitter) {
		include 'twitter-widget__g_tutner.html';
	}
}

function f_konsole() {
	global $a_settings;
	if ($a_settings['konsole'] == 'on') {
		include 'konsole.php';
	}
}

function f_debug_vardump($array, $name, $mode) {
	echo '<p>$mode = ',$mode,'</p>';
	echo "<p><b>Ausgabe {$name}:</b></p>";
	$rows = count($array);
	echo "<p>{$rows} rows</p>";
	echo "<p><b>var_dump({$name}):</b><br>";
	echo var_dump($array);
	echo "</p>";
	if ($mode == 'md') {
		echo "<p><b>foreach {$name}:</b><br>";
		foreach ($array as $value) {
			foreach ($value as $value2) {
				echo "{$value2}, ";
			}
		}
		echo "</p>";
	}
	echo "<hr>";
}

/*
GLOBALS

$twitter		...	Display Twitter. Boolean.

*/

/*
DESCRIPTION OF THE FUNCTIONS

f_vargetcookie [$x]			...	Retrieve or set Cookie.
	If the cookie/variable is passed through the URL paramter, set the cookie. If not try to retrieve it from saved cookies.

f_getcsv [$csvfile]			... Read a csv-file [>1 columns] into a multi-dim. array and process it.
	First row is skipped. Keys from 1st column.	
	
f_chron []					... Process events data [sort, write HTML].
	
	global $a_events;
	
	
*/
?>