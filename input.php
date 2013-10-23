<?php
// Data to send
$output = array(
	'time' => time(),
	'ipaddr' => $_SERVER['REMOTE_ADDR']
);

// Prevent caching
header('Content-type: application/json');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

echo json_encode($output);
