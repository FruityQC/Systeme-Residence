<?php
include_once "../../config/functions.php";

LoggedInOnly();
AdminOnly();

ResetLogs();
LogAction($_SESSION['username'] . " a réinitialiser les logs");
header("Location: ../index.php?msg=Logs réinitialiser avec succès")
?>