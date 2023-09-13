<?php
include_once "../config/functions.php";

LoggedInOnly();

if (!isset($_GET['noteid'])) {
    header("Location: ../home.php?error=Erreur de suppression de la note");
}

$noteid = $_GET['noteid'];
$room = $_GET['id'];
$sql = "DELETE FROM notes WHERE noteid = '$noteid'";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: ../view.php?id=$room&msg=Note Supprimer avec succès");
    LogAction($_SESSION['username'] . ' a supprimer une note pour la chambre numero ' . $room);
}
?>