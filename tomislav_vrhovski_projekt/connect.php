<?php
header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$username = "root";
$password = "";
$basename = "projekt";

$dbc = mysqli_connect($servername, $username, $password, $basename);
if (!$dbc) {
    die('Error connecting to MySQL server.'.mysqli_connect_error());
}
mysqli_set_charset($dbc, "utf8");

if ($dbc) {

}
