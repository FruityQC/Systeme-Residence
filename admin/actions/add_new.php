<?php
include_once '../../config/functions.php';

LoggedInOnly();
AdminOnly();


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $perm = null;
    if ($_POST['admin'] == "yes") {
        $perm = "Administrateur";
        $admin = 1;
    } else {
        $perm = "Employée";
        $admin = 0;
    }

    $sql = "INSERT INTO `users`(`id`, `username`, `password`, `perm`, `admin`) VALUES (NULL,'$username','$password','$perm','$admin')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../index.php?msg=$perm '$username' créé avec succès");
        LogAction($_SESSION['username'] . " a ajouter l'utilisateur $username avec le role $perm");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5 bg-dark text-white">Administration Maisonnée D'Antan</nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Ajouter nouveau utilisateur</h3>
            <div class="text-muted">Veuillez remplir ci-dessous</div>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">

                    <div class="col">
                        <label class="form-label">Nom d'utilisateur:</label>
                        <input type="text" class="form-control" name="username" placeholder="Albert Einstein">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe:</label>
                    <input type="text" class="form-control" name="password" placeholder="Albert123">
                </div>

                <div class="form-group mb-3">
                    <input class="form-check-input" type="checkbox" value="yes" id="admin" name="admin"> &nbsp;
                    <label class="form-check-label" for="admin">
                        Administrateur
                    </label>
                </div>

                <button  type="submit" class="btn btn-success" name="submit">Sauvegarder</button >
                <a href="../index.php" class="btn btn-danger">Annuler</a>
            </form>
        </div>
    </div>
</body>
</html>