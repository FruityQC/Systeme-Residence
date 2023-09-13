<?php
include '../config/functions.php';

LoggedInOnly();


if (isset($_POST['submit']) && isset($_GET['id'])) {
    $room = $_GET['id'];
    $user = $_SESSION['username'];
    $note = $_POST['note'];

    print_r($_POST);

    $sql = "INSERT INTO notes(id, user, note) VALUES ($room, '$user', '$note')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../view.php?id=$room&msg=Note ajoutée avec succès");
        LogAction($_SESSION['username'] . ' a ajouter une note a la chambre numero ' . $room);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

} else {
    header("Location: ../home.php?error=Erreur lors de la modification de la note");
}

?>