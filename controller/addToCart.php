<?php
include_once "./config/dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $artworkID = isset($_POST['artwork_id']) ? $_POST['artwork_id'] : null;

    // Sanitize and validate the input before inserting into the database
    // ...

    // Insert data into the cart table
    $insertSql = "INSERT INTO cart (Artwork_ID, total_price) VALUES (?, ?)";
    $stmt = $conn->prepare($insertSql);
    $totalPrice = $row['a_price']; // You may need to adjust this based on your cart logic
    $stmt->bind_param($artworkID, $totalPrice);

    if ($stmt->execute()) {
        $response = ['success' => true, 'message' => 'Item added to cart successfully'];
    } else {
        $response = ['success' => false, 'message' => 'Error adding item to cart'];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
