<?php
require_once '../config/functions.php';

$users = display_users();


//session_start();

LoggedInOnly();
AdminOnly();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Administration</title>
</head>
<body class="bg-dark">
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Maisonnée D'Antan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../home.php">Menu Principale</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="./">Menu Administratif</a>
            </li>
            <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../whatsnew.php">Quoi de neuf ?</a>
            </li>
        </ul>
        <span class="navbar-text me-4 fs-6">Bonjour, <?php echo $_SESSION['username']; ?> </span>
        <a class="btn btn-outline-danger me-2" type="button" href="../config/logout.php">Déconnexion</a>
        </div>
    </div>
    </nav>

    <!-- NAVBAR END-->
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Administration Maisonnée D'Antan</h2>
                    </div>
                    <div class="card-body">

                        <?php if (isset($_GET['msg'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_GET['msg']; ?>
                            </div>
                        <?php } ?>

                        <div class="d-grid gap-2 mb-1">
                            <a href="./actions/add_new.php" class="btn btn-success">Ajouter</a>
                        </div>
                        <!-- <div class="d-grid gap-2 mb-3"> ITS UGLY
                            <a href="../home.php" class="btn btn-danger">Retour</a> 
                        </div> -->
                        <table class="table tablet-bordered text-center">
                            <tr class="bg-dark text-white">
                                <td>Identifiant</td>
                                <td>Nom d'utilisateur</td>
                                <td>Mot de passe</td>
                                <td>Permission</td>
                                <!-- <td>Modifications</td> -->
                                <td>Supprimer</td>
                            </tr>
                            <tr>
                                
                            <?php 
                                while($row = mysqli_fetch_assoc($users))
                                {
                            ?>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['username']?></td>
                            <td><?php echo $row['password']?></td>
                            <td><?php echo $row['perm']?></td>
                            
                            <td>
                                <a href="./actions/delete.php?id=<?php echo $row["id"] ?>">
                                    <button type="submit" class="btn btn-danger" <?php if ($row['perm'] == 'Technicien') { ?> disabled <?php } ?>>Supprimer</button>
                                </a>
                            </td>

                            </tr>

                            <?php
                                }
                            ?>
                            
                        </table>
                    </div>
                </div>

                <div class="card mt-5 mb-5 p-3">
                    <p class="fw-bold"> <?php GetLog();?> </p>
                    <div class="d-grid gap-2 mb-1">
                        <a href="./actions/resetLogs.php" class="btn btn-warning">Réinitialiser</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>