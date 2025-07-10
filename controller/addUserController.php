<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    include_once "../config/dbconnect.php";

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact_no = substr($_POST['contact_no'], 0, 20); // Adjust length as per your database
    $user_address = $_POST['user_address'];
    $isAdmin = isset($_POST['isAdmin']) ? $_POST['isAdmin'] : 0; // Assuming default value if not set

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, contact_no, registered_at, isAdmin, user_address)
                            VALUES (?, ?, ?, ?, ?, NOW(), ?, ?)");
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $hashed_password, $contact_no, $isAdmin, $user_address);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../index.php");
    exit();
}
?>
