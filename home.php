<?php
include_once './config/functions.php';

LoggedInOnly();
$rooms = display_rooms();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <script src="https://kit.fontawesome.com/90d534048f.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maisonnee D'Antan</title>
</head>

<body class="bg-dark">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Maisonnee D'Antan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./home.php">Menu Principale</a>
                    </li>

                    <?php if ($_SESSION['admin'] == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./admin/">Menu Administratif</a>
                        </li>
                    <?php } ?>

                </ul>
                <span class="navbar-text me-4 fs-6">Bonjour, <?php echo $_SESSION['username']; ?> </span>
                <a class="btn btn-outline-danger me-2" type="button" href="./config/logout.php">Deconnexion</a>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END-->
    <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-warning mt-4 ms-4 me-4" role="alert">
                <?php echo $_GET['error']; ?>
            </div>
    <?php } ?>

    <?php if (isset($_GET['msg'])) { ?>
            <div class="alert alert-success mt-4 ms-4 me-4" role="alert">
                <?php echo $_GET['msg']; ?>

            </div>
    <?php } ?>

<!-- CHAMBRE 1 -->

  
<div class="row row-cols-1 row-cols-md-3 m-3 g-4"> <!--Container -->
<?php while ($room = mysqli_fetch_assoc($rooms)) { 
$id = $room['id'];    
?>

  <div class="col" style="width: 15rem">
    <div class="card h-100">
      <img src="./img/bg.JPG" class="card-img-top" alt="...">
      <div class="card-body">
                <?php
                    if (GetRoom($id)['status'] == "NORM"){
                        echo '<span class="badge rounded-pill text-bg-info mb-1"><i class="fa-solid fa-home me-1"></i>Normal</span>';
                    } elseif (GetRoom($id)['status'] == "RDV") {
                        echo '<span class="badge rounded-pill text-bg-dark text-white mb-1"><i class="fa-solid fa-people-group me-1"></i>Rendez-Vous</span>';
                    } elseif (GetRoom($id)['status'] == "HOS") {
                        echo '<span class="badge rounded-pill text-bg-danger mb-1"><i class="fa-solid fa-star-of-life me-1"></i>Hopital</span>';
                    } elseif (GetRoom($id)['status'] == "SORT") {
                        echo '<span class="badge rounded-pill text-bg-warning mb-1"><i class="fa-solid fa-car-side me-1"></i>En Sortie</span>';
                    } elseif (GetRoom($id)['status'] == "OTH") {
                        echo '<span class="badge rounded-pill text-bg-success mb-1">Autre</span>';
                    }

                ?>
            
                <h5 class="card-title">Chambre <?php echo $id ?></h5> 
                <h6 class="text-muted"><?php echo GetRoom($id)['nom'] ?></h6>
            
                <h6 class="card-text"><i class="fa-solid fa-baby-carriage me-2"></i><?php echo GetRoom($id)['dob'] ?></h6>
                <h6 class="card-text"><i class="fa-solid fa-address-card me-2"></i><?php echo GetRoom($id)['ass'] ?></h6>

                <div class="d-grid gap-2 mt-3">
                    <a href="./view.php?id=<?php echo $id ?>" class="btn btn-primary">Ouvrir</a>
                </div>
      </div>
    </div>
  </div>

  <?php } ?>
</div>


    

</html>





<!-- <div class="card m-3" style="width: 18rem;">
            <img src="./img/bg.JPG" class="card-img-top" alt="...">
            <div class="card-body">
            <?php
                    if (GetRoom(1)['status'] == "NORM"){
                        echo '<span class="badge rounded-pill text-bg-info mb-1"><i class="fa-solid fa-home me-1"></i>Normal</span>';
                    } elseif (GetRoom(1)['status'] == "RDV") {
                        echo '<span class="badge rounded-pill text-bg-dark text-white mb-1"><i class="fa-solid fa-people-group me-1"></i>Rendez-Vous</span>';
                    } elseif (GetRoom(1)['status'] == "HOS") {
                        echo '<span class="badge rounded-pill text-bg-danger mb-1"><i class="fa-solid fa-star-of-life me-1"></i>Hopital</span>';
                    } elseif (GetRoom(1)['status'] == "SORT") {
                        echo '<span class="badge rounded-pill text-bg-warning mb-1"><i class="fa-solid fa-car-side me-1"></i>En Sortie</span>';
                    } elseif (GetRoom(1)['status'] == "OTH") {
                        echo '<span class="badge rounded-pill text-bg-success mb-1">Autre</span>';
                    }

                ?>
            
                <h5 class="card-title">Chambre 1</h5> 
                <h6 class="text-muted"><?php echo GetRoom(1)['nom'] ?></h6>
            
                <h6 class="card-text"><i class="fa-solid fa-baby-carriage me-2"></i><?php echo GetRoom(1)['dob'] ?></h6>
                <h6 class="card-text"><i class="fa-solid fa-address-card me-2"></i><?php echo GetRoom(1)['ass'] ?></h6>

                <div class="d-grid gap-2 mt-3">
                    <a href="./view.php?id=1" class="btn btn-primary">Ouvrire</a>
                </div>
            </div>
        </div> -->