<?php
include '../config/functions.php';
session_start();

if (isset($_POST['uname']) && isset($_POST['password'])) {

    # Data validation
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    
    if (empty($uname)) {
        header('Location: ../index.php?error=Username required');
        exit();
    } elseif (empty($pass)) {
        header('Location: ../index.php?error=Password required');
        exit();
    }else{

        $sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['username'] === $uname && $row['password'] === $pass){
                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['admin'] = $row['admin'];
                
                header('Location: ../home.php');
                exit();

            }else{
                header('Location: ../index.php?error=Wrong Login');
                exit();
            }

        }else{
            header('Location: ../index.php?error=Wrong Login');
            exit();
        }
    }


} else {
    header('Location: ../index.php');
    exit();
}