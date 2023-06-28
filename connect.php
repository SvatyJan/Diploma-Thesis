<?php
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "bp";

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);

/*function Connect(){
    $conn = mysqli_connect("localhost", "root", "", "bp");
    return $conn;
}*/

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

