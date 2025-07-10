<?php
include_once "../config/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $artworkId = $_POST['artworkId'];
    $editArtworkName = $_POST['editArtworkName'];
    $editArtworkDescription = $_POST['editArtworkDescription'];
    $editCategoryName = $_POST['editCategoryName'];
    $editPrice = $_POST['editPrice'];

    // Update artwork details in the database
    $sql = "UPDATE uploadartwork SET 
                                a_name = '$editArtworkName', 
                                a_decs = '$editArtworkDescription', 
                                a_price = $editPrice,
                                a_status = 'Under Revision'
                            WHERE Artwork_ID = $artworkId and a_status != 'Rejected'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => 'Artwork details updated successfully']);
    } else {
        echo json_encode(['error' => 'Error updating Artwork details']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>