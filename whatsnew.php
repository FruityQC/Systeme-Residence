<?php
require_once './config/functions.php';

$users = display_users();


//session_start();

LoggedInOnly();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
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
                        <a class="nav-link" aria-current="page" href="./home.php">Menu Principale</a>
                    </li>


                    <?php if ($_SESSION['admin'] == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./admin/">Menu Administratif</a>
                        </li>
                    <?php } ?>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./whatsnew.php">Quoi de neuf ?</a>
                    </li>

                </ul>
                <span class="navbar-text me-4 fs-6">Bonjour, <?php echo $_SESSION['username']; ?> </span>
                <a class="btn btn-outline-danger me-2" type="button" href="./config/logout.php">Déconnexion</a>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END-->
    <div class="container">
        <div class="row mt-5">
            <div class="col">

                <div class="card m-5 p-3 fs-5 fw-semibold"> <!-- ICI ################################################################################### -->

                    <p class="fs-5 fw-bold">A venir dans la version 1.1 🔮</p>
                    <p class="fs-2 fw-bold text-decoration-underline">Planification</p>
                    ❓ Système de suggestions a partir du site <br>
                    ❓ Possibilité de supprimer/ajouter des photos sur les chambres et les notes par vous meme<br>
                    <br><br><p class="fs-2 fw-bold text-decoration-underline">Suggestions</p>
                    ❓ Page de presentation de la maisonnée avec courriel personnaliser accessible par les patrons <br>
                </div>

                
                <div class="card m-5 p-3 fs-5 fw-semibold"> <!-- ICI ################################################################################### -->

                    <p class="fs-5 fw-bold">Version 1.0</p>
                    <p class="fs-2 fw-bold text-decoration-underline">Nouveautés 🤯</p>
                    ✅ Nouveau système de connexion <br>
                    ✅ Nouveau système de logs pour les administrateur <br>
                    ✅ Nouvelle page d'info quoi de neuf (elle en ce moment) <br>

                   
                    <br><br><p class="fs-2 fw-bold text-decoration-underline">Modifications 🔨</p>
                    ✏️ Modification de la page d'administration <br>
                    ✏️ Corrections erreurs de frappe / traduction <br>
                </div>
            </div>
        </div>
    </div>


</body>

</html>