<?php
include_once "../config/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["catId"])) {
    $catId = $_POST["catId"];

    // Perform the category deletion
    $sql = "DELETE FROM category WHERE CAT_ID = '$catId'";
    $result = $conn->query($sql);

    if ($result) {
        // Return a success response
        echo "Category deleted successfully";
    } else {
        // Return an error response
        echo "Error deleting category: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>