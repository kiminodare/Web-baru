<?php
include 'connection.php';

session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = @mysqli_query($conn, $query);
$cek = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if ($cek > 0) {
    echo 0;
} else {
    echo 1;
}
