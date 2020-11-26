<?php

$servername = "localhost"
$username = "root";
$password = "d0018eServer!"

//creat the connection
$conn = mysql_connect($servername, $username, $password);

//check connection
if(!$conn) {
	die("Connection failed ". mysqli_connect_error());
}
echo "connected successfully";

?>
