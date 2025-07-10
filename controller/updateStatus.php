<?php
include_once "../config/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artworkId = $_POST['artworkId'];
    $newStatus = $_POST['newStatus'];

    $sql = "UPDATE uploadartwork SET a_status = '$newStatus' WHERE Artwork_ID = $artworkId";
    
    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }

    $conn->close();
}
?>