<?php
include_once "../config/dbconnect.php";

if (isset($_POST['artworkId'])) {
    $artworkId = $_POST['artworkId'];

    // Fetch necessary seller details from the database
    $sql = "SELECT * from uploadartwork, category WHERE uploadartwork.cat_id=category.cat_id And Artwork_ID = $artworkId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $artworkDetails = $result->fetch_assoc();
        echo json_encode($artworkDetails);
    } else {
        echo json_encode(['error' => 'Artwork not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
