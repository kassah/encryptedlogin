<?php
// Provide 
$output = array();
$output['time'] = time();
$output['ipaddr'] = $_SERVER['REMOTE_ADDR'];

echo json_encode($output);
?>