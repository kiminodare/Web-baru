<?php
include 'connection.php';
include 'curl.php';
include 'middleware/session.php';
include 'Log_activity/log.php';

date_default_timezone_set('Asia/Jakarta');
$api_curl = new gate();
$log = new LogActivity();
// $session = new Checksession();
$query = "SELECT * FROM user'";
$hoho = @mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($hoho);

if ($row['credit'] != 0) {
    $post_cc = $_POST['cc'];
    $gate = $_POST['gate_checker'];
    $results = [];
    $die = [];
    $cc = explode(PHP_EOL, $post_cc);
    foreach ($cc as $key => $d) {
        $isi = str_replace('/', '|', $d);
        $space = str_replace(' ', '', $isi);
        $delimeter = "|";
        $anu = explode($delimeter, $space);
        $cc = $anu[0];
        $month = $anu[1];
        $year = substr($anu[2], -4);
        $cvv = $anu[3];
        $bin = $api_curl->bin_curl($cc);
        if ($gate == "gate2") {
            $check = $api_curl->gate_1usd($cc, $month, $year, $cvv, $d, $bin);
            // print_r($check);
        } elseif ($gate == "gate3") {
            $check = $api_curl->gate_1($cc, $month, $year, $cvv, $d, $bin);
        } elseif ($gate == "gate1") {
            $check = $api_curl->gatefirst($cc, $month, $year, $cvv, $d, $bin);
        }
        if ($check['status_check']) {
            $e = $_SESSION['username'];
            $db = "SELECT * FROM user WHERE username='$e'";
            $result = @mysqli_query($koneksi, $db);
            $row = mysqli_fetch_assoc($result);
            $a = $row['credit'] - 2;
            $query = "UPDATE user SET credit='$a' WHERE username='$e'";
            $sql = "INSERT INTO log_activity (ip, date, history)
        VALUES ('$ip', '$date', '$history')";
            mysqli_query($koneksi, $sql);
            $date = date('Y-m-d H:i:s');
            $ip = $_SERVER['REMOTE_ADDR'];
            $history = "Cre Live digunakan $username";
            $log->InsertHistory($ip, $date, $history, $koneksi);
            array_push($results, $check);
        } elseif ($check['status'] == "Your card's expiration year is invalid." || "Your card's expiration month is invalid.") {
            $e = $_SESSION['username'];
            $db = "SELECT * FROM user WHERE username='$e'";
            $result = @mysqli_query($koneksi, $db);
            $row = mysqli_fetch_assoc($result);
            $a = $row['credit'];
            $query = "UPDATE user SET credit='$a' WHERE username='$e'";
            $sql = "INSERT INTO log_activity (ip, date, history)
        VALUES ('$ip', '$date', '$history')";
            mysqli_query($koneksi, $sql);
            $date = date('Y-m-d H:i:s');
            $ip = $_SERVER['REMOTE_ADDR'];
            $history = "Cre Die digunakan $username";
            $log->InsertHistory($ip, $date, $history, $koneksi);
            array_push($die, $check);
        } else {
            $e = $_SESSION['username'];
            $db = "SELECT * FROM user WHERE username='$e'";
            $result = @mysqli_query($koneksi, $db);
            $row = mysqli_fetch_assoc($result);
            $a = $row['credit'] - 1;
            $query = "UPDATE user SET credit='$a' WHERE username='$e'";
            $sql = "INSERT INTO log_activity (ip, date, history)
        VALUES ('$ip', '$date', '$history')";
            mysqli_query($koneksi, $sql);
            $date = date('Y-m-d H:i:s');
            $ip = $_SERVER['REMOTE_ADDR'];
            $history = "Cre Die digunakan $username";
            $log->InsertHistory($ip, $date, $history, $koneksi);
            array_push($die, $check);
        }
    }
    mysqli_query($koneksi, $query);
    $array = ["live" => $results, "die" => $die];
    echo json_encode($array);
} else {
    $array = ["error" => true, "msg" => "Token Tidak cukup"];

    echo json_encode($array);
}
