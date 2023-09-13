<?php

//Settings



date_default_timezone_set('America/New_York'); // Set to your desired time zone

$logFileName = $_SERVER['DOCUMENT_ROOT'] . "/resisys/config/logs.log";;

$conn = include('database.php');





// Settings END ################################################################################################

function IsInactive() {
    $maxInactiveTime = 60 * 60;
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $maxInactiveTime) {
        session_unset(); 
        session_destroy(); 
        header('Location: ../index.php?error=Session expirée, veuillez vous reconnecter.');
        exit();
    }
}


// Display functions ################################################################################################

function display_users(){
    global $conn;
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function display_rooms(){
    global $conn;
    $sql = "SELECT * FROM rooms";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function GetNotes($room) {
    global $conn;
    $sql = "SELECT * FROM notes WHERE id='$room' ORDER BY noteid DESC";
    $result = mysqli_query($conn, $sql);

    return $result;
}


function GetRoom($id) {
    global $conn;
    $sql = "SELECT * FROM rooms WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row;
}


function GetHumanDate($date) {
    $dateString = $date;
    $timestamp = strtotime($dateString);

    if ($timestamp !== false) {
        $monthNames = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];

        $dayNames = [
            'dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'
        ];

        $day = strftime('%w', $timestamp);
        $month = strftime('%m', $timestamp) - 1; // Adjust for 0-based array

        $humanDate = strftime("%d {$monthNames[$month]} %Y", $timestamp);

    } else {
        return "Format de date invalide";
    }

    return $humanDate;
}

// Display functions END #############################################################################################

// LOGGING START ####################################################################################################

function LogAction($log) {
    // Put logs in a file
    global $logFileName;
    $file = fopen("$logFileName", "a");
    fwrite($file, "[" . date("Y-m-d H:i:s") . "] " . $log . PHP_EOL);
    fclose($file);
}

function GetLog() {
    global $logFileName;

    // Read the log file into an array
    $logLines = file($logFileName);
    
    // Reverse the order of the array elements
    $logLinesReversed = array_reverse($logLines);
    
    // Output the reversed log content with HTML line breaks
    foreach ($logLinesReversed as $line) {
        echo htmlspecialchars($line) . '<br>';
    }
    
}

function ResetLogs() {
    global $logFileName;
    $file = fopen("$logFileName", "w");
    fwrite($file, "");
    fclose($file);
}

function GetIP(){
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $clientIP = $_SERVER['HTTP_CLIENT_IP'];
    } else {
        $clientIP = $_SERVER['REMOTE_ADDR'];
    }
    
    return $clientIP;    
}

// LOGGING END ######################################################################################################



// Session functions #################################################################################################

function LoggedInOnly(){
    session_start();

    IsInactive();
    $_SESSION['last_activity'] = time();

    if (!isset($_SESSION['id']) && !isset($_SESSION['username'])){
        header('Location: ../index.php');
        exit();
    }
}

function AdminOnly(){
    if ($_SESSION['admin'] != 1){
        header('Location: ../index.php');
        exit();
    }
}

function IsAdmin(){
    if ($_SESSION['admin'] == 1){
        return true;
    } else {
        return false;
    }
}

function Logout(){
    header("Location: ../config/logout.php");
}

// Session functions END #############################################################################################

?>