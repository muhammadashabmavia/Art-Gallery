<?php
// Include your database connection or config file
include_once "../config/dbconnect.php";

// Check if the sellerId parameter is set
if (isset($_POST['sellerId'])) {
    $sellerId = $_POST['sellerId'];

    // Perform the delete operation
    $sql = "DELETE FROM seller WHERE SELLER_ID = '$sellerId'";
    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }

    // Close the database connection
    $conn->close();
} else {
    echo 'error';
}
?>
