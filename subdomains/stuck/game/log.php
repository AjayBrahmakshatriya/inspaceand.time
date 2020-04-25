<?php
	$time=date("M,d,Y h:i:s A");
	if(isset($_GET['name'])) {
		$name = $_GET["name"];
		file_put_contents("/var/www/html/subdomains/stuck/game/log.txt", $time . "\t" . $name . "\n", FILE_APPEND);
		//echo $time . "\t" . $name;
	} else {
		echo 'name not set';
	}
	
?>
