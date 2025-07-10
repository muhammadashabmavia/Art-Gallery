<?php
// Ensure the user ID is set and it's a number (to prevent SQL injection)
if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
    // Include your database connection
    include_once "../config/dbconnect.php";

    // Get the user ID to remove
    $user_id = $_GET['user_id'];

    // Prepare and execute the query
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // User removed successfully
        header("Location: ../users.php"); // Redirect to users page
        exit();
    } else {
        // Error in removing user
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect if user ID is not set or invalid
    header("Location: ../users.php"); // Redirect to users page
    exit();
}
?>
