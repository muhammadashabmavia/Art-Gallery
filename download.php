<?php
// Get the email from the query parameter
$pEmail = isset($_GET['email']) ? $_GET['email'] : '';

// Validate and sanitize the email if needed

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artwork";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the artworks associated with the user's email from the Purchase table
$sql = "SELECT a.a_image
        FROM purchase p
        JOIN uploadartwork a ON p.Artwork_ID = a.Artwork_ID
        WHERE p.p_email = '$pEmail'";
$result = $conn->query($sql);

// Create a zip file to store the images
$zip = new ZipArchive();
$zipFileName = "artwork_images.zip";
$zip->open($zipFileName, ZipArchive::CREATE);

// Add each image to the zip file
while ($row = $result->fetch_assoc()) {
    $imagePath = "uploads/" . $row['a_image'];
    $zip->addFile($imagePath, basename($imagePath));
}

// Close the zip file
$zip->close();

// Provide the download link for the zip file
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename=artwork_images.zip');
header('Content-Length: ' . filesize($zipFileName));
readfile($zipFileName);

// Delete the zip file after download
unlink($zipFileName);

// Close the database connection
$conn->close();
?>
