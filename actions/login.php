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
        header('Location: ../index.php?error=Utilisateur ne peut pas être vide !');
        exit();
    } elseif (empty($pass)) {
        header('Location: ../index.php?error=Mot de passe ne peut pas être vide !');
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
                $_SESSION['last_activity'] = time();
                
                header('Location: ../home.php');
                LogAction($_SESSION['username'] . " c'est connectée");
                exit();

            }else{
                header("Location: ../index.php?error=Aucune information d'identification correspondante n'a été trouvée !");
                LogAction("Tentative de connexion échouée avec le nom d'utilisateur: $uname a partir de l'adresse IP: " . GetIP());
                exit();
            }

        }else{
            header("Location: ../index.php?error=Aucune information d'identification correspondante n'a été trouvée !");
            LogAction("Tentative de connexion échouée avec le nom d'utilisateur: $uname a partir de l'adresse IP: " . GetIP());
            exit();
        }
    }


} else {
    header('Location: ../index.php');
    exit();
}