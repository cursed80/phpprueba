<?php
$GLOBALS['startTime'] = microtime(true);

$mant = true;



if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} 
elseif (isset($_SERVER['HTTP_VIA'])) {
   $ip = $_SERVER['HTTP_VIA'];
} 
elseif (isset($_SERVER['REMOTE_ADDR'])) {
   $ip = $_SERVER['REMOTE_ADDR'];
}
else { 
   $ip = "unknown";
}

if (!$mant Or $ip == $allowIp)
{
	// Specify your config section here

	include 'application/bootstrap.php';
	$bootstrap = new Bootstrap();
	$bootstrap->runApp();
}
else {
	// Mantenimiento
	header("HTTP/1.1 503 Service Unavailable");
	header("Retry-After: 3600");
	include("mantenimiento.html");
}

?>
