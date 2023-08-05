<?php
include_once './config/functions.php';

LoggedInOnly();

$id = $_GET['id'];

if (!isset($_GET['id'])) {
    header('Location: ./home.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <script src="https://kit.fontawesome.com/90d534048f.js" crossorigin="anonymous"></script>
    <title>Maisonnee D'Antan</title>
</head>
<body data-bs-theme="dark">
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
                        <a class="nav-link" aria-current="page" href="./home.php">Menu Principale</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Chambre <?php echo $id ?></a>
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

    <div class="container">
    <div class="row">
      <div class="col-md-3">
        <!-- This is the side div -->
        <div class="bg-primary text-white p-3 rounded">
            <h5 class="ms-1"> Chambre <?php echo $id ?> </h5>
            <h6 class="text-muted ms-1 mb-3"><?php echo GetRoom($id)['nom'] ?></h6>
            <img src="./img/room_<?php echo $id ?>.jpg" class="img-fluid rounded border border-2" alt="Responsive image">

            <h6 class="ms-1 mt-2">Modifications</h6>

            <form action="./actions/edit.php?id=<?php echo $id ?>" method="post" class="d-grid">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Statut:</span>
                    <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="status">
                        <option value="NORM"<?php if (GetRoom($id)['status'] == "NORM") {?> selected <?php }?>>Normal</option>
                        <option value="RDV"<?php if (GetRoom($id)['status'] == "RDV") {?> selected <?php }?>>En Rendez-vous</option>
                        <option value="HOS"<?php if (GetRoom($id)['status'] == "HOS") {?> selected <?php }?>>Hopital</option>
                        <option value="SORT"<?php if (GetRoom($id)['status'] == "SORT") {?> selected <?php }?>>En sortie</option>
                        <option value="OTH"<?php if (GetRoom($id)['status'] == "OTH") {?> selected <?php }?>>Autre</option>
                    </select>
                </div>
                <div class="input-group mt-2">
                    <span class="input-group-text" id="basic-addon1">Nom:</span>
                    <input type="text" class="form-control" value='<?php echo GetRoom($id)['nom'] ?>' aria-label="Username" name="username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-phone fa-xs"></i></span>
                    <input type="text" class="form-control" placeholder="Telephone" value="<?php echo GetRoom($id)['phone']?>" aria-label="Phone" name="phone" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-baby"></i></span>
                    <input type="text" class="form-control" placeholder="Date de naissance" value="<?php echo GetRoom($id)['dob']?>" aria-label="DOB" name="dob" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-address-card"></i></span>
                    <input type="text" class="form-control" placeholder="Assurance Maladie" value="<?php echo GetRoom($id)['ass']?>" aria-label="ASS" name="ass" aria-describedby="basic-addon1">
                </div>

                <button  type="submit" class="btn btn-success mt-3 width:100%" name="submit">Sauvegarder</button>
            </form>
        </div>
      </div>
      <div class="col-md-9">
        <!-- This is the main content area -->
        <?php if (isset($_GET['msg'])) { ?>
            <div class="alert alert-success mt-4 ms-4 me-4" role="alert">
                <?php echo $_GET['msg']; ?>
            </div>
        <?php } ?>
        <div class="p-3 rounded text-dark" data-bs-theme="light">
          <form action="./actions/add_note.php?id=<?php echo $id ?>" method="post">
            <div class="input-group form-floating" >
                    <textarea class="form-control" style="height: 100px;" name='note' id="floatingTextarea2" placeholder="Notes"></textarea>
                    <label for="floatingTextarea2">Nouvelle Note</label>
                    <button class="btn btn-success" type="submit" name="submit" id="button-addon2" style="width: 100px;">Ajouter</button>
            </div>
          </form>

                <?php $notes = GetNotes($id);
                
                while ($row = mysqli_fetch_assoc($notes)) { ?>

                    <form action="./actions/delete_note.php?id=<?php echo $id . "&noteid=" . $row['noteid'] ?>" method="post">
                    <div class="text-bg-secondary p-3 mt-3 rounded">
                        <div class="input-group mb-3">
                                <input readonly type="text" class="form-control" value="<?php echo $row['user'] . " - " . $row['time'] . " - " . $row ['noteid'] ?>" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-danger" type="delete" id="button-addon2">Supprimer</button>
                            </div>
                            <div class="input-group mt-2" data-bs-theme="light">
                                <textarea class="form-control" aria-label="With textarea" style="height: 150px;" name='notes' placeholder=<?php echo $row['note'] ?> readonly></textarea>
                            </div>
                        </div>
                    </form>
          
                <?php } ?>
        </div>
      </div>
    </div>
  </div>

</body>
</html>