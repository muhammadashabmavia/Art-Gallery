<?php
include_once "../config/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["artwork_id"])) {
    $artwork_id = $_POST["artwork_id"];

    // Perform the delete operation, assuming your table has a column named artwork_id
    $deleteSql = "DELETE FROM uploadartwork WHERE artwork_id = $artwork_id";
    $conn->query($deleteSql);

    // You may want to add error handling and validation here

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>