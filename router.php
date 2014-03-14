
<?php

	// http://www.php.net/manual/en/features.commandline.webserver.php
	// router for php internal webserver

	if (file_exists(__DIR__ . '' . $_SERVER['REQUEST_URI'])) {
		return false;  //serve the requested resource as-is.
	} else {
		include_once 'index.php';
	}

?>