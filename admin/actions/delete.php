<?php
include_once "../../config/functions.php";

LoggedInOnly();
AdminOnly();

$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: ../index.php?msg=Utilisateur supprimer avec succès");
}
?>