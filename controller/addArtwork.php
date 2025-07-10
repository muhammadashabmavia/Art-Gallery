<?php
include_once "../config/dbconnect.php"; // Database connection

header('Content-Type: application/json'); // Set the header for JSON response

$response = array('status' => 'error'); // Default response

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $name = $_POST['p_name'];
    $price = $_POST['p_price'];
    $desc = $_POST['p_desc'];
    $category = $_POST['category'];
    $status = 'Under Revision'; // Default status
    $seller_id = 1; // Assuming the seller's ID is 1 (you can modify this to be dynamic)

    // Handle the image upload
    if (isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] == 0) {
        // Get the image file data
        $imageData = addslashes(file_get_contents($_FILES['imageFile']['tmp_name']));

        // Prepare the SQL query
        $sql = "INSERT INTO uploadartwork (a_name, a_price, a_decs, Cat_ID, Seller_ID, a_image, a_status) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind parameters
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('sdssiss', $name, $price, $desc, $category, $seller_id, $imageData, $status);

            // Execute the statement and check for success
            if ($stmt->execute()) {
                $response['status'] = 'success'; // Update response status
            } 

            // Close the prepared statement
            $stmt->close();
        } 
    } 
}

echo json_encode($response); // Output JSON response
?>
<div class="container mt-4">
  <h2 class="text-center">Upload Artwork</h2>
  
  <!-- Show success or error message -->
  <div id="message"><?php echo $message; ?></div>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="form-container sign-in-admin">
        <form enctype="multipart/form-data" id="uploadForm" method="POST">
          <!-- Your form fields remain the same -->
        </form>
      </div>
    </div>
  </div>
</div>




