<?php 
if (strpos($_SERVER['REQUEST_URI'], '/subdomains/buildit.so') === 0) {
	$no_main_header = 1;
	$no_gpg_key = 1;
	$link_to_main = 1;
	$no_flat_icons = 1;
}
?>
