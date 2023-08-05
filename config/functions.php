<?php

$ip = "localhost";
$uname = "root";
$password = "";

$db_name = "maisonee";

try {
	$conn = mysqli_connect($ip, $uname, $password, $db_name);
} catch (Exception $e) {
	die("Erreur Database - Veuiller contacter Felix");
}



function display_users(){
    global $conn;
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function display_rooms(){
    global $conn;
    $sql = "SELECT * FROM rooms";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function GetNotes($room) {
    global $conn;
    $sql = "SELECT * FROM notes WHERE id='$room' ORDER BY noteid DESC";
    $result = mysqli_query($conn, $sql);

    return $result;
}





function GetRoom($id) {
    global $conn;
    $sql = "SELECT * FROM rooms WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row;
}

function LoggedInOnly(){
    session_start();
    if (!isset($_SESSION['id']) && !isset($_SESSION['username'])){
        header('Location: ../index.php');
        exit();
    }
}

function AdminOnly(){
    if ($_SESSION['admin'] != 1){
        header('Location: ../index.php');
        exit();
    }
}

function IsAdmin(){
    if ($_SESSION['admin'] == 1){
        return true;
    } else {
        return false;
    }
}

function Logout(){
    header("Location: ../config/logout.php");
}
?>