<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    header('Location: ./home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./css/style.css"> 
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/90d534048f.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection</title>
</head>

<body class="bg-dark">
    <form action="./actions/login.php" method="post">
        <h2>Connexion</h2>

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_GET['error']; ?>
            </div>
        <?php } ?>

        <i class="fa-solid fa-user" style="color: #808080;"></i>
        <label>Utilisateur</label>
        <input type="text" name="uname" placeholder="Utilisateur"><br>

        <i class="fa-solid fa-key" style="color: #808080;"></i>
        <label>Mot de passe</label>
        <input type="password" name="password" placeholder="Mot de passe"><br>

        <button type="submit" class="btn btn-secondary me-1">Connexion</button>


    </form>
</body>

</html>