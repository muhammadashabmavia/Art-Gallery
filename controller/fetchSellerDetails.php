<?php
include_once "../config/dbconnect.php";

if (isset($_POST['sellerId'])) {
    $sellerId = $_POST['sellerId'];

    // Fetch necessary seller details from the database
    $sql = "SELECT * FROM seller WHERE SELLER_ID = $sellerId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sellerDetails = $result->fetch_assoc();
        echo json_encode($sellerDetails);
    } else {
        echo json_encode(['error' => 'Seller not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
