<?php
$servername = "localhost";
$username = "id15084806_teamlotus";
$password = "SlZ}Df1?-NeUt?>/";

$conn = mysqli_connect($servername, $username, $password, "id15084806_main_database");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";

?>
