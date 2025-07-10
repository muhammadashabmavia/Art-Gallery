<?php
// deleteCartItem.php

if (isset($_GET['cartId'])) {
    $cartId = $_GET['cartId'];

    // Assuming you have a database connection established
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "artwork";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform the deletion
    $sql = "DELETE FROM cart WHERE Cart_ID = $cartId";
    $result = $conn->query($sql);

    // Close the database connection
    $conn->close();

    // Send a response (you can customize this based on your needs)
    if ($result) {
        echo "Item deleted successfully";
    } else {
        echo "Error deleting item";
    }
} else {
    echo "Invalid request";
}
?>
