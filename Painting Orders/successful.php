<?php
$host = //Taken out for git
$user = //Taken out for git
$pass = //Taken out for git
$dbname = //Taken out for git
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection Failed.");
}

$paintingName = isset($_POST["paintingName"]) ? $conn->real_escape_string($_POST["paintingName"]):"";
$paintingID = isset($_POST["paintingID"]) ? $conn->real_escape_string($_POST["paintingID"]):"";
$name = isset($_POST["name"]) ? $conn->real_escape_string($_POST["name"]):"";
$phone = isset($_POST["phone-number"]) ? $conn->real_escape_string($_POST["phone-number"]):"";
$email = isset($_POST["email"]) ? $conn->real_escape_string($_POST["email"]):"";
$address = isset($_POST["postal-address"]) ? $conn->real_escape_string($_POST["postal-address"]):"";

if (empty($name)) { die ("You need to provide a name");}

$sql  = "INSERT INTO `Orders` (`name`, `phone`, `email`, `address`, `painting_name`, `painting_id`, `ID`) VALUES".
    "('$name', '$phone', '$email', '$address', '$paintingName', '$paintingID', NULL)";

if($conn->query($sql)===true){
    header("location: listart.php");
} else {
    echo"Error on insert".$conn->error;
}

?>