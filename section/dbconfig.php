<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "student";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/*
connect_error:
is property inside mysqli class,
It will have a value if an error occurs so ( if evaluate to true),
otherwise it will empty so ( if evaluate to false)

die:
close process and print message
*/
