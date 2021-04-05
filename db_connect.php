<?php
$servername = "localhost";

$username = "root";
$password = "";
$databse = "chatroom";

// Creating db connection

$conn = mysqli_connect($servername, $username, $password, $databse);

//  Check Connection

if(!$conn)
{
    die("Failed to connect". mysqli_connect_error());
}

?>