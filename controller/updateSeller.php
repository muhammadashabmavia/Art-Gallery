<?php
include_once "../config/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sellerId = $_POST['sellerId'];
    $username = $_POST['editUsername'];
    $email = $_POST['editEmail'];
    $dateOfBirth = $_POST['editDateOfBirth'];
    $address = $_POST['editAddress'];
    $city = $_POST['editCity'];
    $country = $_POST['editCountry'];
    $cnic = $_POST['editCnic'];

    // Update seller details in the database
    $sql = "UPDATE seller SET 
                username = '$username', 
                Email = '$email', 
                dateofbirth = '$dateOfBirth', 
                Address = '$address', 
                city = '$city', 
                country = '$country', 
                cnic = '$cnic' 
            WHERE SELLER_ID = $sellerId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => 'Seller details updated successfully']);
    } else {
        echo json_encode(['error' => 'Error updating seller details23232']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
