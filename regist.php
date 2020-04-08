<?php
include 'connection.php';

session_start();

$username = $_POST["username_regst"];
$password = $_POST["password_regst"];
$username=htmlspecialchars($username);
$password=htmlspecialchars($password);

$query = "SELECT * FROM user WHERE username='$username'";
$result = @mysqli_query($conn, $query);
$cek = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if($cek > 0){
    echo 3;
} else {
    $sql = "INSERT INTO user (username, password, credit)
    VALUES ('$username', '$password','0')";
    mysqli_query($conn,$sql);
    echo 2;
}