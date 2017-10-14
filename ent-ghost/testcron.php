<?php
include 'cron_functions.php';
// set db access info as constants
// example:
define ('DB_USER','ghost');
define ('DB_PASSWORD','ghost1');
define ('DB_HOST','localhost');
define ('DB_NAME','ghostdb');

// make connection and select db
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysql_error() );

// Their cron_functions needs the name of the first player. Don't know why it's designed that way.
$result = $dbc->query('select name from gameplayers limit 1;');

$row = $result->fetch_assoc(); 
$playername = $row['name'];

$playername = gameTrack($dbc, $playername);

$dbc->query('delete from gameplayers;');

updateBan($dbc);

?>
